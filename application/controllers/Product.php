<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Product extends Public_Controller {
   function __construct(){
        parent::__construct();
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('sub_brand_model');
		$this->load->model('productcolor_model');
		$this->load->model('productsize_model');
		$this->load->model('producttype_model');
		$this->load->model('productshape_model');
		$this->load->model('productmaterial_model');
    }

   public function index() 
   {
		$this->data['extracss']='';
		$this->data['extrajs']= '';
 
		$prod_url = $this->uri->segment(2);
		$condition= array('status' => 'active');
		if($prod_url == 'page' || $prod_url == ''){
			
			$category = $this->category_model->selectdata("*", $condition, " ORDER BY cat_id DESC");
			$cat_id = isset($category[0]->cat_id) ? $category[0]->cat_id : '';
			$hasChild = isset($category[0]->hasChild) ? $category[0]->hasChild : '';


			$brands = $this->brand_model->selectdata("*", $condition, " ORDER BY id DESC");

			$colors = $this->productcolor_model->selectdata("*", $condition, " ORDER BY color_id ASC");
	 		$size = $this->productsize_model->selectdata("*", $condition, " ORDER BY id DESC");
	 		$type = $this->producttype_model->selectdata("*", $condition, " ORDER BY type_id DESC");
	 		$shape = $this->productshape_model->selectdata("*", $condition, " ORDER BY id DESC");
 			$material = $this->productmaterial_model->selectdata("*", $condition, " ORDER BY id DESC");
			


			$this->data['brands'] = $brands;
			$this->data['selected_category'] = $category;
			$this->data['colors'] = $colors;
			$this->data['size'] = $size;
			$this->data['type'] = $type;
			$this->data['shape'] = $shape;
			$this->data['material'] = $material;


			$this->data['total_record'] = $this->product_model->selectdata("count(*) as total_records",array('status' => 'active'),"ORDER BY pid DESC");

	 		$this->load->library('pagination');
	 		$config['base_url'] = MAINSITE_URL.'product/page/';
			$config['total_rows'] = $this->data['total_record'][0]->total_records;
			$config['per_page'] = RECORD_PER_PAGE;
			$config["uri_segment"] = 3;
	 		$config['attributes'] = array('class' => 'page-link');
	 		//$config['use_page_numbers']=true;
			$config['full_tag_open'] = '<nav><ul class="pagination pag_all" style="width:100%;">';
	        $config['full_tag_close'] = '</ul></nav>';
	        $config['first_link'] = false;
	        $config['last_link'] =  false;
	        $config['first_tag_open'] = '<li class="page-item pagination-first">First';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Prev';
	        $config['prev_tag_open'] = '<li class="page-item pagination-prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = 'Next&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i>';
	        $config['next_tag_open'] = '<li class="page-item pagination-next">';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li class="page-item pagination-last">Last';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li class="page-item">';
	        $config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			$this->data['total_product']  = $page;
			$this->data['productlist'] = $this->product_model->selectdata("*",$condition,'ORDER BY pid DESC',$page,$config["per_page"]);
			$this->data['pageing_link'] = $this->pagination->create_links();

			$meta = getMeta(0);
			$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Products';
			$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : 'Products';
			$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : 'Products';
			$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
			
			$this->render('public/product/all_product_list');  
		}else{	

			$product_detail= $this->product_model->selectdata("*", array('url_slug'=> $prod_url,'status'=>'active'), "ORDER BY pid DESC");
			$this->data['detail'] = $product_detail[0];
 			$pid=$product_detail[0]->pid;
			$cat_id=$product_detail[0]->cat_id;
			

			$categorydetails = $this->category_model->selectdata("category_name,url_slug", array('cat_id' => $cat_id), " ORDER BY cat_id DESC");
			$cat_url = isset($categorydetails[0]->url_slug) ? site_url('category/'.$categorydetails[0]->url_slug) : '';
			$cat_name = isset($categorydetails[0]->category_name) ? $categorydetails[0]->category_name : ''; 

			$this->data['cat_url'] = $cat_url;
			$this->data['cat_name'] = $cat_name;
			$similar_products= $this->product_model->selectdata("*",array('cat_id'=>$cat_id, 'status' => 'active'),'AND pid!='.$pid.' ORDER BY pid DESC');
			$this->data['similar_products']=$similar_products;

			$productlist = $this->product_model->selectdata("*", array('status' => 'active'), "ORDER BY pid ASC LIMIT 10");
			$this->data['products'] = $productlist; 

			//For static pages (like home,contact us, about us..) fetch meta details from pages meta 
			//ID:3 for category in pagesmeta table.

			$meta = $product_detail;
			$this->data['meta_title'] = (isset($meta[0]->meta_title) && !empty($meta[0]->meta_title)) ? $meta[0]->meta_title : '';
			$this->data['meta_desc'] = (isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc)) ? $meta[0]->meta_desc : '';
 			$this->render('public/product/product_detail');
			//$this->load->view('public/product/product_detail',$this->data);
		}   	 
	}

	public function page()

   {

      $this->index();

   }





	public function submitquote()
	{

		$this->load->library('My_PHPMailer');

		$response = array();

		$pid = isset($_POST['product_id']) ? $this->input->post('product_id') : '';
		$company = isset($_POST['company']) ? $this->input->post('company') : '';
		$name = isset($_POST['name']) ? $this->input->post('name') : '';
		$email = isset($_POST['email']) ? $this->input->post('email') : '';
		$phone = isset($_POST['phone']) ? $this->input->post('phone') : '';
		$message = isset($_POST['message']) ? $this->input->post('message') : '';
		//$enquiry_type=isset($_POST['enquiry_type'])?$this->input->post('enquiry_type'):'';  

		$subject = "Get a quote - ";

		$product_detail = $this->product_model->selectdata("*", array('pid'=>$pid, 'status' => 'active'), "ORDER BY pid DESC");
		$pname=$product_detail[0]->product_name;
		$cat_id = $product_detail[0]->cat_id;

		$category = $this->category_model->selectdata("*", array('cat_id' => $cat_id), " ORDER BY cat_id DESC");
		$cat_name = $category[0]->category_name;

		$proname = $pname . " - " . $cat_name;
		$purl=site_url('product')."/".$product_detail[0]->url_slug;
 
		$msg = "<table width=\"96%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
		$msg .= "<tr><td> Dear Admin,<br><br></td></tr>";
		$msg .= "<tr><td>Product Name : <a href='".$purl."' target='_blank'>". $proname."</a></td></tr>";
		$msg .= "<tr><td>Company / Hospital: " . $company . "</td></tr>";
		$msg .= "<tr><td>Name: " . $name . "</td></tr>";
		$msg .= "<tr><td>Email: " . $email . "</td></tr>";
		$msg .= "<tr><td>Phone: " . $phone . "</td></tr>";
		$msg .= "<tr><td>Message: " . $message . "</td></tr>";
		$msg .= "<tr><td><br><br>Thank You,<br>Team Tuoren</td></tr>";
		$msg .= "</tbody></table>";



		if (!empty($email) && !empty($phone)) {
			//Save data
			$col = array();
			$col['pid']=$pid;
			$col['company'] = $company;
			$col['name'] = $name;
			$col['email'] = $email;
			$col['phone'] = $phone;
			$col['message'] = $message;
			$this->db->insert('tbl_productenquiry', $col);

			//Send Email
			$mail = new PHPMailer(); // create a new object
			$mail->IsHTML(true);
			//$mail->SetFrom($this->dbsettings->COMPLIANCE_ALERT_EMAILS,"Abhishek");
			$mail->SetFrom($email, $name);
			$mail->Subject = $subject;
			$mail->Body = $msg;
			$mail->AddAddress($this->dbsettings->ENQUIRY_EMAIL, $this->dbsettings->ENQUIRY_NAME);
			//$mail->AddAddress('abhishek.k@doorsstudio.com');
			$mail->AddBCC('abhishek.k@doorsstudio.com');
			$mail->send();

			$response['status'] = "success";
			$response['msg'] = "Your request has been submitted successfully. We will get in touch with you very soon.";
		} else {
			$response['status'] = "error";
			$response['msg'] = "Invalid request";
		}

		echo json_encode($response, JSON_PRETTY_PRINT);
	}


	 
	function getProductData(){ 
        
        //Get product data by ID
        $response = array();
        $response['data']='';
        $pro_id = $_POST['proid']; 

        $product_data= $this->product_model->selectProductsbyid("*", array('pid'=>$pro_id), "");    
        $response['data'] = $product_data;       
       
        echo json_encode($response);
    }

    function getProductSearchData(){
        
        //Get product data by ID
        $response = array();
        $response['data']=array();
        $pro_id = $_POST['seachData']; 

        $subbrands_data= $this->product_model->getSubbrandSearchData("tbl_subbrands.sub_brand_name,tbl_subbrands.url_slug AS subbrand_url", array('sub_brand_name'=>$pro_id), " order by sub_brand_name ASC LIMIT 3");  
        
        $brands_data= $this->product_model->getBrandSearchData("brand_name,url_slug", array('brand_name'=>$pro_id), " order by brand_name ASC LIMIT 2");  

        $product_data= $this->product_model->getProductSearchData("product_name,url_slug", array('product_name'=>$pro_id), " order by product_name ASC LIMIT 5");  

        
        if(count($subbrands_data)>0){
        	foreach ($subbrands_data as $sb) {
        		 $col=array();
        		 $col['name']=$sb->sub_brand_name;
        		 $col['url']=site_url('brands/'.$sb->subbrand_url);
        		 array_push($response['data'], $col);
        	}
        }
        if(count($brands_data)>0){
        	foreach ($brands_data as $sb) {
        		 $col=array();
        		 $col['name']=$sb->brand_name;
        		 $col['url']=site_url('brands/'.$sb->url_slug);
        		 array_push($response['data'], $col);
        	}
        }
        if(count($product_data)>0){
        	foreach ($product_data as $sb) {
        		 $col=array();
        		 $col['name']=$sb->product_name;
        		 $col['url']=site_url('product/'.$sb->url_slug);
        		 array_push($response['data'], $col);
        	}
        }
       

        echo json_encode($response);
    }

    

	 
}

