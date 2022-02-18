<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

   	function __construct(){
        parent::__construct();
        $this->load->model('banner_model');
		$this->load->model('pages_model');
        $this->load->model('afterbefore_model');
		$this->load->model('gallery_model');
		$this->load->model('testimonial_model');
		$this->load->model('product_model');		
		$this->load->model('category_model');		
		$this->load->model('brand_model');		
     }



   public function index()
   {

	    $this->data['page_title'] = 'Galorebay';
		$this->data['extracss']='';
		$this->data['extrajs']='';
		$this->data['banner'] = $this->banner_model->selectdata("*",array('status'=>'active'),"ORDER BY banner_id ASC");
		//$this->data['testimonials'] = $this->banner_model->selectdata("*",array('status'=>'active'),"ORDER BY banner_id ASC");
		$this->data['afterbefore'] = $this->afterbefore_model->selectdata("*",array('status'=>'active'),"ORDER BY afterbefore_id ASC");
		$this->data['gallery'] = $this->gallery_model->selectdata("*",array('status'=>'active'),"ORDER BY gallery_id ASC");
		$this->data['testimonials'] = $this->testimonial_model->selectdata("*", array('status' => 'active'), "ORDER BY testimonial_id DESC");
		//$this->data['clients'] = $this->client_model->selectdata("*", array('status' => 'active'), "ORDER BY client_id DESC");
		$this->data['clients']=0;
		$this->data['pages'] = $this->pages_model->selectdata("*",array('pages_id'=>'1','status'=>'active'),"ORDER BY pages_id ASC");

		$this->data['products'] = $this->product_model->selectdata("*",array('status'=>'active','featured'=>1),"ORDER BY pid ASC LIMIT 15");

		$this->data['products_hot'] = $this->product_model->selecthotdata("*",array('status'=>'active','hot'=>1),"ORDER BY pid ASC LIMIT 15");

		$this->data['categories'] = $this->category_model->selectdata("*",array('status'=>'active','featured'=>1),"ORDER BY cat_id ASC");
		$this->data['brands'] = $this->brand_model->selectdata("*",array('status'=>'active','featured'=>1),"ORDER BY sort_no ASC");
		$meta=getMeta(1);
		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';

 		$this->load->view('public/home/home_view',$this->data);

	}



   function test(){
	$this->render('public/cart/success');

   }

	public function newsletter(){

		$this->load->library('My_PHPMailer');

		$response=array();

		$response['token']=$this->security->get_csrf_token_name();

		$response['hash']=$this->security->get_csrf_hash();		

		$name=isset($_POST['name'])?$this->input->post('name'):'';

		$email=isset($_POST['email'])?$this->input->post('email'):'';

		$phone=isset($_POST['phone'])?$this->input->post('phone'):'';

 		$message=isset($_POST['message'])?$this->input->post('message'):'';

 		//$enquiry_type=isset($_POST['enquiry_type'])?$this->input->post('enquiry_type'):'';  

  		



 	    $subject="Keep me informed Enquiry";

 	    $msg="<table width=\"96%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";

		$msg.="<tr><td> Dear Admin,<br><br></td></tr>";

		$msg.="<tr><td>Name: ".$name."</td></tr>";

		$msg.="<tr><td>Email: ".$email."</td></tr>";

		$msg.="<tr><td>Phone: ".$phone."</td></tr>";

 		$msg.="<tr><td>Message: ".$message."</td></tr>";

		$msg.="<tr><td><br><br>Thank You,<br> RG Team</td></tr>";

		$msg.="</tbody></table>";



		if(!empty($email)){
			//Save data

			 $col=array();

			 $col['name']=$name;

			 $col['email']=$email;

			 $col['phone']=$phone;

			 $col['message']=$message;

 			 $col['enquiry_type']=2;   //0:contact 1:trip

			 $this->db->insert('tbl_enquiry',$col);



			//Send Email

	 		$mail = new PHPMailer(); // create a new object

	  		$mail->IsHTML(true);

	 		//$mail->SetFrom($this->dbsettings->COMPLIANCE_ALERT_EMAILS,"Abhishek");

	 		$mail->SetFrom($email,$name);

	 		//$mail->ReplyTo("support@modernbazaar.co.in","Modern Bazaar");

	 		$mail->Subject = $subject;

	 		$mail->Body = $msg;

	 		$mail->AddAddress($this->dbsettings->ENQUIRY_EMAIL);

	 		$mail->send();



 	 		$response['status']="success";

			$response['msg']="Your request has been submitted successfully. We will get in touch with you very soon.";

		}else{

			$response['status']="error";

			$response['msg']="Invalid request";

		}

		echo json_encode($response,JSON_PRETTY_PRINT);

	}

}



