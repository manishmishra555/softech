<?php 
 /* Check category and product for discount */
 function getDiscount($cat_id=null,$pid=null){

	 $CI = & get_instance();
	 $CI->load->model('discount_model');
	 $return=array();
	 $product_detail='';
	 $cond='';
	 $final_price=0;

	 
	//$category= $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY category_name ASC');
	$cond="AND ( FIND_IN_SET('".$cat_id."',`category_id`) OR FIND_IN_SET('".$pid."',`product_id`) )";
	$discount_details = $CI->discount_model->selectdata("*",array('status'=>'active'),$cond." ORDER BY did DESC LIMIT 1");	

	 if(count($discount_details)>0){
			$discount_type=$discount_details[0]->discount_type;  //flat or percent
			$discount_value=$discount_details[0]->discount_value; 
			$discount_value_limit=$discount_details[0]->discount_value_limit; 

			//Get Product Details
			$product_detail = $CI->product_model->selectdata("*", array('pid'=>$pid,'status' => 'active'), 'ORDER BY pid ASC');		
			$product_price=$product_detail[0]->price;
			$final_price=$product_price;
			if($discount_type=='flat'){
				$final_price=$product_price - $discount_value;				
			}else{
				$new_discount_value=($discount_value/100)*$product_price;
				if($new_discount_value>$discount_value_limit){
					$new_discount_value=$discount_value_limit;
				}
				$discount_value=$new_discount_value;
				$final_price=$product_price - $new_discount_value;
			}
			$return['discount_status']=true;
			$return['discount_type']=$discount_type;
			$return['discounted_value']=$discount_value;
			$return['discounted_per']=$discount_details[0]->discount_value;
 
	 	 }else{
			$return['discount_status']=false;			
		 }	 
  	 return $return;
 }

 function applyPromocode($promocode){
	$CI = &get_instance();
	$response = array();
	if($CI->session->has_userdata('promocode')){
		$response['status'] = "invalid";
		$response['msg'] = "Promocode already applied";
	}else{
		$response=validatePromocode($promocode);
	}
	return $response;
}

function getPromocodeData($promocode){
	return validatePromocode($promocode);
}

 function validatePromocode($promocode,$saved_cart_items=NULL){
	#Validate promocode (-Promocode exist -category -products -usagelimit -limit per user -daterange)
	$CI = &get_instance();
	$CI->load->model('product_model');
	$CI->load->model('promocode_model');

	$response = array();
	
	$promo_discounted_total=0;
	$promo_discounted_amount=0;
 
		//Validate Promocode
		$promo = $CI->promocode_model->selectdata("*", array('promocode_name' => $promocode, 'status' => 'active'), "AND (NOW()>=`start_date` AND NOW()<=`expiry_date`) ORDER BY id DESC LIMIT 1");
		//pr($promo);die;
		if (count($promo) > 0) {
 			//Check promocode usage limit
			// $promolimit=0;
			// if(count($promolimit)>0){			
			// 	//Show promocode expired message
			// }

			//Check promocode usage limit per user from th
			// $promolimitper_user = 0;
			// if (count($promolimitper_user) > 0) {
			// 	//Show promocode limit usage

			// }

			$promo_on = $promo[0]->promocode_on;
			$promo_type=$promo[0]->promocode_type;   //percentage or flat
			$promo_value = $promo[0]->promocode_value;
			$promo_value_limit = $promo[0]->promocode_value_limit;
	

			if(empty($saved_cart_items)){
				$cookie           = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
				$cookie           = stripslashes($cookie);
				$saved_cart_items = json_decode($cookie, true);
			}
			$cart_subtotal = 0;
			$cart_total = 0;
			$shipping = 0;

			if (count($saved_cart_items) > 0) {
				foreach ($saved_cart_items as $key => $value) {
					$product = $CI->product_model->selectdata("*", array('pid' => $key, 'status' => 'active'), "ORDER BY pid DESC");

					$qnty = 0;

					$pid = $product[0]->pid;
					$qnty = $value;
					$cat_id = $product[0]->cat_id;
					
					$item_price = $product[0]->price;

					//Calculate discount
					$discount_status = 0;
					$discount_price = 0;
					$discount = getDiscount($cat_id, $pid);
					if ($discount['discount_status']) {
						$discount_status = 1;
						$discount_price = $item_price - $discount['discounted_value'];
						$item_subtotal = $discount_price * $qnty;
					} else {
						$item_subtotal = $item_price * $qnty;
					}

					$cart_subtotal += $item_subtotal;
				}
				$cart_total = $cart_subtotal + $shipping;
			}

			//echo $cart_subtotal." ".$cart_total; 

			//Add promo to whole cart value
			if($promo_type=='percent'){
				$promo_discounted_amount=($cart_total*$promo_value)/100;
				if($promo_discounted_amount> $promo_value_limit){
					$promo_discounted_amount=$promo_value_limit;
				}
				$promo_applied_cart_total=$cart_total- $promo_discounted_amount;

				//echo $promo_discounted_amount;die;
			}else if($promo_type=='flat'){
				//Didn't check the limit value in flat
				$promo_discounted_amount=$promo_value;
				$promo_applied_cart_total=$cart_total- $promo_discounted_amount;
			}


			/*
			if ($promo_on == 'all') {
				
			} else if ($promo_on == 'product') {
				//Add promo to selected items in cart
				
			} else if ($promo_on == 'category') {
				//Add promo to selected category items in cart
			} */
			
			//Check Wallet Applied
			$wallet_amount=0;
			if($CI->session->has_userdata('use_wallet')){
				$use_wallet=$CI->session->userdata('use_wallet');
				if($use_wallet==1){
					$wallet_amount=getWallet();
					$promo_applied_cart_total=$promo_applied_cart_total-$wallet_amount;
				}
			}
			
			//Set session of promocode
			$CI->session->set_userdata('promocode',$promocode);

			$response['promo_discounted_amount']=$promo_discounted_amount;
			$response['promo_type']=$promo_type;
			$response['promo_value']=$promo_value;
			$response['promo_value_limit']=$promo_value_limit;

			$response['promo_discounted_amount']=$promo_discounted_amount;
			$response['promo_applied_cart_total']=$promo_applied_cart_total;
			$response['status'] = "success";
		} else {
			$response['status'] = "invalid";
			$response['msg'] = "Invalid Coupon";
		}
	
	return $response;

 }

 function getCart(){
	$CI = & get_instance();
	$CI->load->model('product_model');
	$CI->load->model('brand_model');
	$CI->load->model('productsize_model');
	$CI->load->model('productcolor_model');
	$CI->load->model('productshape_model');

	$response=array();
	$response['products'] =array();
	$saved_cart_items=array();

    //$_COOKIE['cart_items_cookie']='';
	$cookie           = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
	$cookie           = stripslashes($cookie);
	$saved_cart_items = json_decode($cookie, true);

	if(empty($saved_cart_items)){
		$saved_cart_items=array();
	}
	$cart_subtotal=0;
	$cart_total=0;
	$shipping_amount=0;
	$total_discount=0;
	if (count($saved_cart_items) > 0) {
		foreach ($saved_cart_items as $key => $value) {
				$product= $CI->product_model->selectdata("*", array('pid'=> $value,'status'=>'active'), "ORDER BY pid DESC");

				$brand= $CI->brand_model->selectdata("*", array('id'=> $product[0]->brand_name,'status'=>'active'), "ORDER BY id DESC");

				$pcookie_id = $key;
				$qnty = 0;
				$p_qty = explode('-', $key);
				
				$pid = $product[0]->pid;
				$qnty = $p_qty[0];
				$cat_id=$product[0]->cat_id;
				$brand_name=$brand[0]->brand_name;
				$item_name = $product[0]->product_name;
 				$item_link = site_url('product/') . $product[0]->url_slug;
				$PImages = json_decode($product[0]->image_fids);
				$image = !empty($PImages[0]) ? $CI->media->getThumbPathById($PImages[0], '600x800/') : FRONT_ASSETS_PATH . "images/default_product.png";
				$item_price=$product[0]->price;


				$psize= $CI->productsize_model->selectdata("*", array('id'=> $p_qty[2],'status'=>'active'), "ORDER BY id DESC");
				$pcolor= $CI->productcolor_model->selectdata("*", array('color_id'=> $p_qty[3],'status'=>'active'), "ORDER BY color_id DESC");
				$pshape= $CI->productshape_model->selectdata("*", array('id'=> $p_qty[4],'status'=>'active'), "ORDER BY id DESC");

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
				$col['itemqnty']    = (int)$p_qty[1];
				$col['itemname']  = $item_name;
				$col['itemlink']  = $item_link;
				$col['itemimage'] = $image;
				$col['itemprice'] = $item_price;
				$col['brand_name']=$brand_name;
				$col['color']=$pcolor[0]->color_name;
				$col['colorcode']=$pcolor[0]->color_value1;
				$col['shape']=$pshape[0]->product_shape;
				$col['size']=$psize[0]->product_size;
				$col['item_subtotal'] = $item_subtotal;
				$col['pcookie_id'] = $pcookie_id;
			
				//$col['itemqty']=$itemqty;
				array_push($response['products'], $col);
		}
		
		$min_order_value=$CI->dbsettings->MIN_CART_VALUE_DELIVERY;
		if($cart_subtotal<$min_order_value){
			$shipping_amount=$CI->dbsettings->DELIVERY_CHARGES;
		}
		$cart_total=$cart_subtotal+$shipping_amount;
		if($CI->session->has_userdata('promocode')){
			$promocode = $CI->session->userdata('promocode');
			$promodata=validatePromocode($promocode,$saved_cart_items);
			if($promodata['status']=='success'){
				$cart_total=$promodata['promo_applied_cart_total'];
				$total_discount =$promodata['promo_discounted_amount'];
			}
 		}
	}

	$wallet_amount=0;
	if($CI->session->has_userdata('use_wallet') && $CI->session->userdata('use_wallet')==1){
		$use_wallet=$CI->session->userdata('use_wallet');
		if($use_wallet==1){
			$wallet_amount=getWallet();
			$cart_total=$cart_total-$wallet_amount;
		}
	}
	
	$response['total_items']=count($saved_cart_items);
	$response['cart_subtotal']=$cart_subtotal;
	$response['total_discount']=$total_discount;
	$response['wallet_amount']=$wallet_amount;
	$response['shipping_amount']=$shipping_amount;
	$response['cart_total']=$cart_total;

	return $response;

 }



 function getnewCart($cart_items){
	$CI = & get_instance();
	$CI->load->model('product_model');

	$response=array();
	$response['products'] =array();
	/* $cookie           = isset($_COOKIE['cart_items_cookie']) ? $_COOKIE['cart_items_cookie'] : '';
	$cookie           = stripslashes($cookie);
	$saved_cart_items = json_decode($cookie, true); */
 
	$cart_subtotal=0;
	$cart_total=0;
	$shipping_amount=0;
	$total_discount=0;
	if (count($cart_items) > 0) {
		foreach ($cart_items as $key => $value) {
				$product= $CI->product_model->selectdata("*", array('pid'=> $value,'status'=>'active'), "ORDER BY pid DESC");
				$p_qty = explode('-', $key);
				
				$pid = $product[0]->pid;
				$qnty = $p_qty[0];
				$cat_id=$product[0]->cat_id;
				$item_name = $product[0]->product_name;
 				$item_link = site_url('product/') . $product[0]->url_slug;
				$PImages = json_decode($product[0]->image_fids);
				$image = !empty($PImages[0]) ? $CI->media->getThumbPathById($PImages[0], '600x800') : FRONT_ASSETS_PATH . "images/default_product.png";
				$item_price=$product[0]->price;

				//Calculate discount
				$discount_status=0;
				$discount_price=0;
				$discount=getDiscount($cat_id,$pid);
				if($discount['discount_status']){
					$discount_status=1;
					$discount_price= $item_price;
                    $item_subtotal = $discount_price*$qnty;                     
 				}else{
                    $item_subtotal = $item_price*$qnty;                     
 				}

				$cart_subtotal+=$item_subtotal;

				$col= array();
				$col['itemid']    = $key;
				$col['itemqnty']  = $qnty;
				$col['itemname']  = $item_name;
				$col['itemlink']  = $item_link;
				$col['itemimage'] = $image;
				$col['itemprice'] = $item_price;
				$col['item_discount_status']=$discount_status;
				$col['item_discount_price'] = $discount_price;
				$col['item_subtotal'] = $item_subtotal;
			
				//$col['itemqty']=$itemqty;
				array_push($response['products'], $col);
		}
		$min_order_value=$CI->dbsettings->MIN_CART_VALUE_DELIVERY;
		
		$cart_total=$cart_subtotal;

		if($CI->session->has_userdata('promocode')){
			$promocode = $CI->session->userdata('promocode');
			$promodata=validatePromocode($promocode,$cart_items);
			if($promodata['status']=='success'){
				$cart_total=$promodata['promo_applied_cart_total'];
				$total_discount =$promodata['promo_discounted_amount'];
			}
 		}

	}

	$wallet_amount=0;
	if($CI->session->has_userdata('use_wallet') && $CI->session->userdata('use_wallet')==1){
		$use_wallet=$CI->session->userdata('use_wallet');
		if($use_wallet==1){
			$wallet_amount=getWallet();
			$cart_total=$cart_total-$wallet_amount;
		}
	}

	$response['total_items']=count($cart_items);
	$response['cart_subtotal']=$cart_subtotal;
	$response['total_discount']=$total_discount;
	$response['wallet_amount']=$wallet_amount;
	$response['shipping_amount']=$shipping_amount;
	$response['cart_total']=$cart_total;

	return $response;
 }


 function getWallet(){
	$CI = &get_instance();
	$CI->load->model('wallet_model');

	$use_order_wallet_amount=0;
    $wallet_percentage=$CI->dbsettings->WALLET_USE_PERCENTAGE;

	if($CI->session->has_userdata('userId')){
		$uid=$CI->session->userdata('userId');
		$wallet= $CI->wallet_model->selectdata("*", array('uid'=> $uid,'status'=>'active'), "ORDER BY id DESC LIMIT 1");
		$wallet_amount=isset($wallet[0])?$wallet[0]->amount:0;

		$use_order_wallet_amount=($wallet_percentage*$wallet_amount)/100;
	}
	return round($use_order_wallet_amount,2);

 }