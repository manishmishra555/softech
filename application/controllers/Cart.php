<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends Public_Controller {
   function __construct(){
        parent::__construct();
		$this->load->model('product_model');
		$this->load->model('users_model');  
		$this->load->model('promocode_model');
		$this->load->model('wallet_model'); 
		$this->load->model('customers_model'); 
		$this->load->model('productcolor_model'); 
		     	
    }

   public function index(){
  
	    $this->data['page_title'] = 'View Cart';
		$this->data['extracss']='';
		$this->data['extrajs']= '';


		$meta=getMeta(6);
 		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
 		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
 
  		$this->render('public/cart/viewcart');
	}

	public function checkout(){
		
		//$promodata=applyPromocode('XYZPOP');
		//pr($promodata);die;

		//$this->session->unset_userdata('promocode'); die;

	    $this->data['page_title'] = 'Checkout';
		$this->data['extracss']='';
		$this->data['extrajs']= '';

		// $cart=getCart();
		// pr($cart); die;
		$this->data['selected_address']='';
		$this->data['address']=array();
		if ($this->session->has_userdata('userId')) {
			$user_id = $this->session->userdata('userId');
			$customer_id = !empty($user_id) ? $user_id : '';
			$customers = $this->customers_model->selectdata("*", array('id' => $customer_id), "ORDER BY id DESC LIMIT 1");

			$this->data['billing_name']=$customers[0]->name;
			$this->data['phone']=$customers[0]->mobile;
			$this->data['email']=$customers[0]->email;

		}
 			 
			
			$meta=getMeta(0);
			$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
			$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
			$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
			$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
	
			$this->load->view('public/cart/checkout',$this->data);
 		

		
	}

	function extractCookie()
    {
        $cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
        $data   = json_decode($cookie);
        foreach ($data as $key => $value) {
            //echo "Item ID: ".$key;
            pr($value);
            echo $value->qty . " " . $value->itemtype;
        }
	}
	

	

	function addItem(){
		$response =array();    
		$response["products"]=array();

		$pid=$this->input->post('id', true);   
		$qnty=$this->input->post('qty', true);  
		$psize=$this->input->post('size', true);  
		$pcolor=$this->input->post('color', true);
		$pshape=$this->input->post('shape', true);
		$p_all = $pid.'-'.$qnty.'-'.$psize.'-'.$pcolor.'-'.$pshape;
		
		$total_price = 0;
		//Check Stock code

		// initialize empty cart items array
		$cart_items=array();
	  
		// add new item on array
		$cart_items[$p_all]=$pid;
		  
		// read the cookie
  		 $cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
		 $cookie = stripslashes($cookie);
		 $saved_cart_items = json_decode($cookie, true);

		// if $saved_cart_items is null, prevent null error
		if(!$saved_cart_items){
			$saved_cart_items=array();
		}

		// check if the item is in the array, if it is, do not add
		if(array_key_exists($pid, $saved_cart_items)){
			// redirect to product list and tell the user it was already added to the cart
			$response['status']="exist";
 		}else{
			// if cart has contents
			if(count($saved_cart_items)>0){
				foreach($saved_cart_items as $key=>$value){
					// add old item to array, it will prevent duplicate keys
					$cart_items[$key]=$value;
				}
			  }
			  
			//Fetch Product Details
			$cart_subtotal=0;
			$actualcart_subtotal=0;			
			$total_discount=0;
			foreach($cart_items as $key=>$value){
				$product= $this->product_model->selectdata("*", array('pid'=> $value,'status'=>'active'), "ORDER BY pid DESC");
				$pid = $product[0]->pid;
				$cat_id=$product[0]->cat_id;
				$item_name = $product[0]->product_name;
 				$item_link = site_url('product/') . $product[0]->url_slug;
				$PImages = json_decode($product[0]->image_fids);
				$image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '600x800/') : FRONT_ASSETS_PATH . "images/default_product.png";
				$item_price=$product[0]->price;

				//Calculate discount
				$discount_status=0;
				$discount_price=0;
				$discount=getDiscount($cat_id,$pid);
				if($discount['discount_status']){
					$discount_status=1;
					$discount_price= $item_price - $discount['discounted_value'];
					$total_price += $discount_price;
				}else{
					$total_price += $item_price;
				}
				$p_qty = explode('-', $key);
				
				$pcolor= $this->productcolor_model->selectdata("*", array('color_id'=> $p_qty[3],'status'=>'active'), "ORDER BY color_id DESC");

				$col= array();
				$col['itemid']    = $value;
				$col['itemqty']    = (int)$p_qty[1];
				$col['itemname']  = $item_name;
				$col['itemlink']  = $item_link;
				$col['itemprice'] = $item_price;
				$col['itemimage'] = $image;
				$col['color']=$p_qty[3];
				$col['colorcode']=$pcolor[0]->color_value1;
				$col['shape']=$p_qty[4];
				$col['size']=$p_qty[2];
				array_push($response['products'], $col);				
			}
			$response['status']      = "added";
            $response['totalitems']  = count($cart_items);
            $response['total_price'] = $total_price;
            $json                    = json_encode($cart_items, true);
            setcookie('cart_items_cookie', $json, time() + 2592000, "/");
}
		
        echo json_encode($response, JSON_PRETTY_PRINT);
	} 

	function updateQnty(){
		$response =array();     
 
		$pid=$this->input->post('id', true);   
		$qnty=$this->input->post('qty', true);
		$total_price = 0;
		//Check Stock code
		// initialize empty cart items array
		$cart_items=array();
	  
// 		// add new item on array
// 		$cart_items[$pid]=$qnty;
$pr_id = '';
		
		// read the cookie
  		 $cookie = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
		 $cookie = stripslashes($cookie);
		 $saved_cart_items = json_decode($cookie, true);
		foreach($saved_cart_items as $key=>$value){
			$val_cookie = explode('-', $key);
			$size = $val_cookie[2];
			$qty = $val_cookie[1];
			$proid = $val_cookie[0];
			$color = $val_cookie[3];
			$shape = $val_cookie[4];
			if($pid == $key){
			    $cart_items[$proid."-".$qnty."-".$size."-".$color."-".$shape]=$value;	
			}else{
			    $cart_items[$key]=$value;
			}
			$pr_id = $value;
		}
		
		$json = json_encode($cart_items, true);
		setcookie('cart_items_cookie', $json, time() + 2592000, "/");
		
		//Get details of updated product
		$product= $this->product_model->selectdata("*", array('pid'=> $pr_id,'status'=>'active'), "ORDER BY pid DESC");
		$cat_id=$product[0]->cat_id;
		$item_price=$product[0]->price;
		
		$item_subtotal = $item_price*$qnty;   
		//Get Updated Cart
		$cart=getnewCart($cart_items);
		//$response["products"]=$cart['products'];
		$response['item_subtotal'] = $item_subtotal;
		$response['total_items']=$cart['total_items'];
		$response['cart_subtotal']=$cart['cart_subtotal'];
		$response['cart_total']=$cart['cart_total'];

 		echo json_encode($response,JSON_PRETTY_PRINT); 
	 }


	 function removeItem(){
		$response =array();    
		$pid=$this->input->post('id', true);
		// read
		$cookie = $_COOKIE['cart_items_cookie'];
		$cookie = stripslashes($cookie);
		$saved_cart_items = json_decode($cookie, true);

		// remove the item from the array
		if(array_key_exists($pid, $saved_cart_items)){
			unset($saved_cart_items[$pid]);
		}
		$json = json_encode($saved_cart_items, true);
		setcookie('cart_items_cookie', $json, time() + 2592000, "/");
		
		//Get Updated Cart
		$cart=getnewCart($saved_cart_items);
  		$response['total_items']=$cart['total_items'];
		$response['cart_subtotal']=$cart['cart_subtotal'];
		$response['cart_total']=$cart['cart_total'];

		echo json_encode($response,JSON_PRETTY_PRINT); 		 
	 }

	 

	 function setAddress(){
		 $response =array();    
		 $adid=$this->input->post('adid');
		if ($this->session->has_userdata('userId') && !empty($adid)) {
			$this->session->set_userdata('selected_address', $adid);
			$response['status']="success";
		}else{
			$response['status'] = 'haserror';
            $response['error'] = 'Invalid Request';
		}
		echo json_encode($response);
	 }
	 
	 function validatepromo(){
		//$this->load->model('promocode_model');   
		$response=array();   
		$promocode=$this->input->post('promocode');
		if ($this->session->has_userdata('userId')) {
			$promodata=applyPromocode($promocode);
			if($promodata['status']=='success'){
				$response['promo_discounted_amount']=$promodata['promo_discounted_amount'];
				$response['promo_applied_cart_total']=$promodata['promo_applied_cart_total'];
				$response['status']="success";
			}else{
				$response['status'] = 'haserror';
				$response['error'] = $promodata['msg'];
			}
 		}else{
			$response['status'] = 'haserror';
            $response['error'] = 'Invalid Request';
		}
		echo json_encode($response);
	 }

	function removepromocode(){
		$response=array();
		if ($this->session->has_userdata('userId')) {
			$this->session->unset_userdata('promocode');
			$response['status']="success";
		}else{
			$response['status'] = 'haserror';
            $response['error'] = 'Invalid Request';
		}
		echo json_encode($response);
	}

	function completeOrder(){
		$response=array();   
 
		$data=array();
		$payment_method='cod';
		$selected_address=1;

 			
			$cookie           = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
			$cookie           = stripslashes($cookie);
			$saved_cart_items = json_decode($cookie, true);

			$cart_subtotal=0;
			$cart_total=0;$total = 0;
			$shipping_amount=0;
			$total_discount=0;$item_subtotal = 0;
			if (count($saved_cart_items) > 0) {
				foreach ($saved_cart_items as $key => $value) {
						$product= $this->product_model->selectdata("*", array('pid'=> $value,'status'=>'active'), "ORDER BY pid DESC");
						$p_qty = explode('-', $key);
						$pid = $product[0]->pid;
						$qnty = (int)$p_qty[1];
						$cat_id=$product[0]->cat_id;
						$item_name = $product[0]->product_name;
						$item_link = site_url('product/') . $product[0]->url_slug;
						$PImages = json_decode($product[0]->image_fids);
						$image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '600x800') : FRONT_ASSETS_PATH . "images/default_product.png";
						$item_price=$product[0]->price;
						
						$item_subtotal = $item_price*$qnty;                     
						
						
						$gst = 0;
                        if($cat_id == '9'){
                            $gst = '18';
                        }if($cat_id == '6'){
                            $gst = '12';
                        }
                        $gst_total = ($item_subtotal*$gst)/100;
                        $cart_subtotal = $item_subtotal+$gst_total;
                        $total += $cart_subtotal;

						

						$col= array();
						$col['itemid']    = $value;
						$col['itemname']  = $item_name;
						$col['itemlink']  = $item_link;
						$col['itemimage'] = $image;
						$col['itemprice'] = $item_price;
						$col['item_subtotal'] = $item_subtotal;

						$col['color']=$p_qty[3];
						$col['shape']=$p_qty[4];
						$col['size']=$p_qty[2];
						$col['itemqnty']  = $p_qty[1];
						$col['item_tax']=$gst;
					
						//$col['itemqty']=$itemqty;
						array_push($data, $col);
				}

				$cart_total=$total;


			$total_items=count($saved_cart_items);
			$total_discount=$total_discount;
			$shipping_amount=$shipping_amount;
			$total_amount=$cart_total+$shipping_amount;
		
			if ($this->session->has_userdata('userId')) {
				$user_id = $this->session->userdata('userId');
			}else{
				$user_id = '';
			}
			$invoice_no=randomstring();
			$uname = $this->input->post('first_name').' '.$this->input->post('last_name');
			//Add order 
			$order_details=array('invoice_no'=>$invoice_no,
				'uid'=>$user_id,
				'address_id'=>$selected_address,
				'total_items'=>$total_items,
				'order_subtotal'=>$cart_total,
				'total_amount'=>$total_amount,
				'payment_method'=>$payment_method,
				'uname'=>$uname,
				'uemail'=>$this->input->post('uemail'),
				'uphone'=>$this->input->post('uphone'),
				'ucompany'=>$this->input->post('company_name'),
				'udescription'=>$this->input->post('about_order'),
				'date_added'=>date("Y-m-d H:i:s"),
				'date_modified'=>date("Y-m-d H:i:s")
			);
			//pr($order_details); 
			$this->db->insert('tbl_order',$order_details);
			$order_id=$this->db->insert_id();
			//$order_id=1;

			$itemlist = '';

			//Insert Order items
			if (count($data) > 0) {
				foreach ($data as $items) {
					$co= array();
					$co['order_id']=$order_id;					 
					$co['item_id']=$items['itemid'] ;
					$co['item_name']=$items['itemname'];
					$co['item_price']=$items['itemprice'];
					$co['item_qnty']=$items['itemqnty'];
					$co['item_size']=$items['size'];
					$co['item_color']=$items['color'];
					$co['item_shape']=$items['shape'];
					$co['item_tax']=$items['item_tax'];
					$co['date_added']=date('Y-m-d H:i:s');
					
					//pr($co);
					$this->db->insert('tbl_order_items',$co);
				}

				//Save Order Status
				$order_status_data=array(
					'order_id'=>$order_id,
					'order_status '=>0,
					'created_at'=>date('Y-m-d H:i:s'),                
					'updated_at'=>date('Y-m-d H:i:s')
				);
                $this->db->insert('tbl_order_status',$order_status_data);
					
				}
				
				$cart=getCart(); $final_total = 0;
				$cart_subtotal=0;
                $cart_total=0;
                $item_subtotal=0;
                if(count($cart['products'])>0){
                    foreach($cart['products'] as $pr){
                        $item_subtotal=0;
                        $itemname=$pr['itemname'];
                        $price=$pr['itemprice'];
                        $qnty=$pr['itemqnty'];
                        $item_subtotal = $price*$qnty;  
                        $gst = '';
                        if($cat_id == '9'){
                            $gst = '18';
                        }if($cat_id == '6'){
                            $gst = '12';
                        }
                        $gst_total = ($item_subtotal*$gst)/100;
                        $total = $item_subtotal+$gst_total;
                        $final_total += $total;
                        
                        $itemlist .= '<tr>';
                        $itemlist .= '<td style="padding:5px;width: 35%;text-align:center;background:rgba(128,128,128,0.18)">' . $itemname . '</td>';
                        $itemlist .= '<td style="padding:5px;width: 30%;text-align:center;background:rgba(128,128,128,0.18)">Size : ' . $pr['size'] . '<br>Color : ' . $pr['color'] . '<br>Shape : ' . $pr['shape'] . '</td>';
                        $itemlist .= '<td style="padding:5px;width: 20%;text-align:center;background:rgba(128,128,128,0.18)">' . $qnty . '</td>';
                        if($this->session->has_userdata('userId')){
                            $itemlist .= '<td style="padding:5px;text-align:center;width: 15%;background:rgba(128,128,128,0.18)">Price : ₹' . $price . '<br> GST :' . $gst . '%<br> TOTAL : ₹'.$total.' </td>';
                        }else{
                            $itemlist .= '<td style="padding:5px;text-align:center;width: 15%;background:rgba(128,128,128,0.18)">GST :' . $gst . '%</td>';
                        }
                        $itemlist .= '</tr>';
                        
                    }
                }
                $order_date = date("d F Y",strtotime(date('Y-m-d')));
                $order_status = 'New Products Enquiry - Galorebay Optix India';
				$usrmail = $this->input->post('uemail');
				#Mail content
                $subject="New Products Enquiry - Galorebay Optix India";
                $en_msg = file_get_contents(FRONT_ASSETS_PATH . 'enquiry_mail.html');
                $en_msg = str_replace('$customer_name', $uname, $en_msg);
                $en_msg = str_replace('$customer_phone', $this->input->post('uphone'), $en_msg);
                $en_msg = str_replace('$customer_company', $this->input->post('company_name'), $en_msg);
                $en_msg = str_replace('$order_items', $itemlist, $en_msg);
                $en_msg = str_replace('$order_date', $order_date, $en_msg);
                $en_msg = str_replace('$order_status', $order_status, $en_msg);
 
                $this->load->library('email');
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('info@galorebayoptix.com', 'Galorebay Optix India');
                $this->email->to($usrmail);
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                
                $this->email->subject($subject);
                $this->email->message($en_msg);
                $this->email->send();
                
                $length = 78;
		        $token = bin2hex(random_bytes($length));
                
                
                $subject = $order_status;
			    $message = '<table border="0" cellpadding="0" cellspacing="0" style="background:#f6f6f6;font-size:15px;line-height:25px;font-family:Arial,Helvetica,sans-serif;padding:25px;border:1px solid #ccc" width="700">
                    	    <tbody>
                    	        <tr>
                    	            <td align="center" valign="top"><img alt="logo" src="https://www.galorebayoptix.com/assets/front/images/menu/logo/logo-2.png?id='.$token.'" class="CToWUd"></td>
                    	        </tr>
                    	        <tr>
                    	            <td align="left" valign="top">'.$subject.'<br>
                    	            <p style="font-size: 18px;font-weight: 600;color: #1d4276;">Customer Info</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Name</b> : '.$uname.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Email ID</b> : '.$usrmail.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Contact No.</b> : '.$this->input->post('uphone').'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Company Name</b> : '.$this->input->post('company_name').'</p><br>
                    	            <div style="width:100%;">
                                    <table style="width:100%;background-color:#f9f9f9;">
                                        <colgroup style="width:100%">
                                            <col width="112">
                                            <col width="112">
                                            <col width="112">
                                            <col width="112">
                                        </colgroup>
                                        <tbody>
                                            <tr style="font-family:Helvetica,Arial,sans-serif;color:#585858;overflow:hidden;height:40px;border-bottom:solid 1px #e8e8e8;background-color:#f9f9f9">
                                                <td style="font-family:Helvetica,Arial,sans-serif;width:35%;font-weight:bold;font-size:14px;text-align:left;padding-left:15px">Item Description</td>
                                                <td style="font-family:Helvetica,Arial,sans-serif;width:30%;font-weight:bold;font-size:14px;text-align:left;padding:0px">Product Info</td>
                                                <td style="font-family:Helvetica,Arial,sans-serif;width:20%;font-weight:bold;font-size:14px;text-align:left;padding:0px">Quantity</td>
                                                <td style="font-family:Helvetica,Arial,sans-serif;width:15%;font-weight:bold;font-size:14px;text-align:left;padding:0px">Price Info</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <table style="width:100%;border-collapse:collapse;border-bottom:solid 1px #e8e8e8;border-spacing:0px">
                                    <tbody>'.$itemlist.'</tbody>
                                </table><br><br>
                    	            Thanks &amp; Regards<br>
                    	            TEAM - <a href="https://www.galorebayoptix.com/" target="_blank">Galorebay Optix India</a><br>
                    	            &nbsp;</td>
                    	        </tr>
                    	        <tr>
                    	            <td align="center" style="background:#224275;color:#fff;padding:15px;font-size:17px;font-weight:bold">For further inquiries call us on : +91-6363406363<br>
                    	            Mail us on <a href="mailto:info@galorebayoptix.com" style="color:#fff;text-decoration:none" target="_blank">info@galorebayoptix.com</a></td>
                    	        </tr>
                    	    </tbody>
                    	</table>';
			    
			    $this->load->library('email');
                $config1['mailtype'] = 'html';
                $this->email->initialize($config1);
                $this->email->from($usrmail, $uname);
                $this->email->to('info@galorebayoptix.com');
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
                    
				$this->session->set_userdata('message',"Your Query has been submitted successfully.");
				setcookie('cart_items_cookie','',time() + 2592000, "/");
				$this->session->unset_userdata('promocode');
				 
				$response['status'] = 'success';
				$response['error'] = 'Your Query has been submitted successfully.';

		}else{
			$response['status'] = 'haserror';
            $response['error'] = 'Invalid Request';
		}
		echo json_encode($response);
	}


	function success(){
		$this->data['page_title'] = 'View Cart';
		$this->data['extracss']='';
		$this->data['extrajs']= '';

		$data=array();
		$selected_address=$this->session->userdata('selected_address');
		$payment_method='razorpay';
		   
		if ($this->session->has_userdata('userId') && !empty($payment_method) && $this->session->has_userdata('transaction_data')) {
 			
			$transaction_data=$this->session->userdata('transaction_data');
			$invoice_no=$transaction_data['order_id']; 
			
			$cookie           = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
			$cookie           = stripslashes($cookie);
			$saved_cart_items = json_decode($cookie, true);
 
			$cart_subtotal=0;
			$cart_total=0;
			$shipping_amount=0;
			$total_discount=0;
			if (count($saved_cart_items) > 0) {
				foreach ($saved_cart_items as $key => $value) {
						$product= $this->product_model->selectdata("*", array('pid'=> $value,'status'=>'active'), "ORDER BY pid DESC");
						
						$pid = $product[0]->pid;
						$qnty = $value;
						$cat_id=$product[0]->cat_id;
						$item_name = $product[0]->product_name;
						$brand_name = $product[0]->brand_name;
						$item_link = site_url('product/') . $product[0]->url_slug;
						$PImages = json_decode($product[0]->image_fids);
						$image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '600x800') : FRONT_ASSETS_PATH . "images/default_product.png";
						$item_price=$product[0]->price;

						//Calculate discount
						$discount_status=0;
						$discount_price=0;
						$discount=getDiscount($cat_id,$pid);
						if($discount['discount_status']){
							$discount_status=1;
							$discount_price= $item_price - $discount['discounted_value'];
							$item_subtotal = $discount_price*$qnty;                     
						}else{
							$item_subtotal = $item_price*$qnty;                     
						}

						$cart_subtotal+=$item_subtotal;

						$col= array();
						$col['itemid']    = $value;
						$col['itemqnty']  = $value;
						$col['itemname']  = $item_name;
						$col['itemlink']  = $item_link;
						$col['itemimage'] = $image;
						$col['itemprice'] = $item_price;
						$col['brand_name']=$brand_name;
						$col['item_discount_price'] = $discount_price;
						$col['item_subtotal'] = $item_subtotal;
					
						//$col['itemqty']=$itemqty;
						array_push($data, $col);
				}

				$min_order_value=$this->dbsettings->MIN_CART_VALUE_DELIVERY;
				if($cart_subtotal<$min_order_value){
					$shipping_amount= $this->dbsettings->DELIVERY_CHARGES;
				}
				$cart_total=$cart_subtotal+$shipping_amount;

				$promocode=NULL;
				$promo_type=NULL;
				$promo_value=NULL;
				$promo_value_limit=NULL;
				
				if($this->session->has_userdata('promocode')){
					$promocode = $this->session->userdata('promocode');
					$promodata=validatePromocode($promocode,$saved_cart_items);
					if($promodata['status']=='success'){
						$cart_total=$promodata['promo_applied_cart_total'];
						$total_discount =$promodata['promo_discounted_amount'];
						$promo_type =$promodata['promo_type'];
						$promo_value =$promodata['promo_value'];
						$promo_value_limit =$promodata['promo_value_limit'];
					}
				}
			}

			$total_items=count($saved_cart_items);
			$cart_subtotal=$cart_subtotal;
			$total_discount=$total_discount;
			$shipping_amount=$shipping_amount;
			$total_amount=$cart_total+$shipping_amount;

			$order_wallet_amount=0;
			if($this->session->has_userdata('use_wallet')){
				$use_wallet=$this->session->userdata('use_wallet');
				if($use_wallet==1){
					$order_wallet_amount=getWallet();
					$total_amount=$total_amount-$order_wallet_amount;
				}
			}
			
			//$invoice_no=randomstring();
			$user_id = $this->session->userdata('userId');


			//Add order 
			$order_details=array('invoice_no'=>$invoice_no,
				'uid'=>$user_id,
				'address_id'=>$selected_address,
				'total_items'=>$total_items,
				'order_subtotal'=>$cart_subtotal,
				'shipping_amount'=>$shipping_amount,
				'promocode'=>$promocode,
				'promocode_type'=>$promo_type,
				'promocode_value'=>$promo_value,
				'promocode_value_limit'=>$promo_value_limit,
				'wallet_amount'=>$order_wallet_amount,
				'discount_amount'=>$total_discount,
				'total_amount'=>$total_amount,
				'payment_method'=>$payment_method,
				'date_added'=>date("Y-m-d H:i:s"),
				'date_modified'=>date("Y-m-d H:i:s")
			);

			//pr($order_details); 
			$this->db->insert('tbl_order',$order_details);
			$order_id=$this->db->insert_id();
			//$order_id=1;
			//Transaction data
			$transaction_data['d_order_id']=$order_id;
			$this->db->insert('tbl_transaction',$transaction_data);
 
			//Insert Order address
			$address= $this->users_model->selectaddress("*", array('id' => $selected_address, 'uid' => $user_id), "ORDER BY id DESC");
			if (count($address) > 0) {
				foreach ($address as $ad) {
					$addressdata=array(
						'order_id'=> $order_id,
						'addressline' => $ad->addressline,
						'addressline2' => $ad->addressline2,
						'city' => $ad->city,
						'state' => $ad->state,
						'zipcode' => $ad->zipcode,
						'mobile'=>$ad->mobile,
						'date_added' => date("Y-m-d H:i:s"),
						'date_modified' => date("Y-m-d H:i:s")
					);
					$this->db->insert('tbl_order_address', $addressdata);
				}
			}

			//Insert Order items
			if (count($data) > 0) {
				foreach ($data as $items) {
					$co= array();
					$co['order_id']=$order_id;					 
					$co['item_id']=$items['itemid'] ;
					$co['item_name']=$items['itemname'];
					$co['item_price']=$items['itemprice'];
					$co['item_discounted_price']=$items['item_discount_price'];
					$co['item_qnty']=$items['itemqnty'];
					$co['date_added']=date('Y-m-d H:i:s');

					//pr($co);
					$this->db->insert('tbl_order_items',$co);
				}

				//Save Order Status
				$order_status_data=array(
					'order_id'=>$order_id,
					'order_status '=>0,
					'created_at'=>date('Y-m-d H:i:s'),                
					'updated_at'=>date('Y-m-d H:i:s')
				);
                $this->db->insert('tbl_order_status',$order_status_data);

				
				//Add rewards points on order
				$wallet= $this->wallet_model->selectdata("*", array('uid' => $user_id,'status'=>'active'), "ORDER BY id DESC LIMIT 1");     
				if(count($wallet)>0){
					$wallet_id=$wallet[0]->id;
					
					$current_wallet_amount=$wallet[0]->amount;
					//Insert Wallet transaction if wallet amount used in order
					if($this->session->has_userdata('use_wallet') && $this->session->userdata('use_wallet')==1 && !empty($wallet_id)){
						$this->session->unset_userdata('use_wallet');					
						$wt_data=array(
							'wallet_id'=>$wallet_id,
							'amount'=>$order_wallet_amount,
							'order_id'=>$order_id,
							'amount_type'=>'order',
							'operation' =>1,
							'status'=>'active',
							'date_added'=>date('Y-m-d H:i:s'),
							'date_modified'=>date('Y-m-d H:i:s')
						);
						$this->db->insert('tbl_wallet_transactions',$wt_data);		

						$current_wallet_amount=$current_wallet_amount-$order_wallet_amount;
						$this->db->where('id',$wallet_id);
						$this->db->update('tbl_wallet',array('amount'=>$current_wallet_amount));
					}
					
					$wallet_amount=($total_amount*$this->dbsettings->REWARD_POINTS_ON_ORDER)/100;
					$w_transaction=array(
						'uid'=>$user_id,
						'wallet_id'=>$wallet_id,
						'amount'=>$wallet_amount,
						'amount_type'=>'order',
						'operation' => 0,
						'status'=>'inactive',
						'date_added'=>date('Y-m-d H:i:s'),
						'date_modified'=>date('Y-m-d H:i:s')
					);
					$this->db->insert('tbl_wallet_transactions',$w_transaction);		
				}
											 
				$this->session->set_userdata('message',"Your order has been placed successfully.");
				
				setcookie('cart_items_cookie','',time() + 2592000, "/");
				$this->session->unset_userdata('promocode');
				$this->session->unset_userdata('transaction_data');

			 }
			 
			$this->data['invoice_no']=$invoice_no;
			$this->render('public/cart/success');

		}else{
			 redirect('user/orders');
		}
 
  	}
	
	function usewallet(){
		$response=array();
		$use_wallet=$this->input->post('use_wallet');
		//$cart_total=$this->input->post('cart_total');

		if($use_wallet==1){
 			$this->session->set_userdata('use_wallet','1');			
		}else {
			$this->session->unset_userdata('use_wallet');
		}

		$response['status']='success';
		echo json_encode($response);
	}

}

