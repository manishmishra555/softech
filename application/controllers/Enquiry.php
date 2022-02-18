<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Enquiry extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
  		//$this->load->modal('enquiry_model');
    	$this->load->library('form_validation');
		$this->load->library('My_PHPMailer');
		$this->load->model('enquiries_model');
		$this->load->model('hospitals_model');  

   }

  function submit(){
  $response=array();
  if(isset($_POST) && !empty($_POST)){
	
	$this->load->library('form_validation');
        $rules = array(
            array(
                'field' => 'hospital',
                'label' => 'Hospital / Clinic',
                'rules' => 'required'
            ),
			 array(
                'field' => 'patient_name',
                'label' => 'Patient Name ',
                'rules' => 'required|min_length[4]'
            ),
			 array(
                'field' => 'age',
                'label' => 'Age',
                'rules' => 'required|numeric|integer'
            ),
			 array(
                'field' => 'gender',
                'label' => 'Gender',
                'rules' => 'required'
            ), 
			array(
                'field' => 'qemail',
                'label' => 'Email',
                'rules' => 'required|valid_email'
            ),
			 array(
                'field' => 'phone',
                'label' => 'Contact No',
                'rules' => 'required|numeric|exact_length[10]'
            ),
			 array(
                'field' => 'comments',
                'label' => 'Message',
                'rules' => 'required'
            )
        );
        $messages = array(
            'hospital' => array('required' => "Please Select Hospital / Clinic"),
 			'patient_name' => array('required' => "Patient Name is required",'min_length' => "Please enter more then 4 char Requirement"),
			'age' => array('required' => "Age is required"),
			'gender' => array('required' => "Gender is required"),
			'qemail' => array('required' => "Email is required",'valid_email'=>'Invalid Email ID'),
			'phone' => array('required' => "Contact No is required",'exact_length' => "Please enter valid phone number"),
			'comments' => array('required' => "Message is required")
        );
        
		$this->form_validation->set_rules($rules);
        $this->form_validation->set_rules($messages);

        if ($this->form_validation->run() == FALSE) {
            //$this->form_data = array("hospital" => $_POST['hospital'], "deparment" => $_POST['deparment'], "treatment" => $_POST['treatment'],"patient_name" => $_POST['patient_name'],"age" => $_POST['age'],"gender" => $_POST['gender'],"email" => $_POST['email'],"phone" => $_POST['phone'], "comments" => $_POST['comments']);
            $this->form_error = validation_errors();
			$response['status']="haserror";
            $response['msg']=validation_errors();	  
        } else { 
		
		 $patient_name = $this->security->xss_clean($this->input->post('patient_name'));
		 $age = $this->security->xss_clean($this->input->post('age'));
		 $gender = $this->security->xss_clean($this->input->post('gender'));
		 $email = $this->security->xss_clean($this->input->post('qemail'));
		 $phone = $this->security->xss_clean($this->input->post('phone'));
		 $comments = $this->security->xss_clean($this->input->post('comments'));
		 $hospital = $this->security->xss_clean($this->input->post('hospital'));
		 $timestamp=time();

		$final_filename = '';
		$file_path = '';

 		if(isset($_FILES['pdf_file_upload']['name']) && !empty($_FILES['pdf_file_upload']['name']))
				{ 	
				    $original_filename=$_FILES['pdf_file_upload']['name'];		
					$_FILES['userfile']['name']     = $_FILES['pdf_file_upload']['name'];
					$_FILES['userfile']['type']     = $_FILES['pdf_file_upload']['type'];
					$_FILES['userfile']['tmp_name'] = $_FILES['pdf_file_upload']['tmp_name'];
					$_FILES['userfile']['error']    = $_FILES['pdf_file_upload']['error'];
					$_FILES['userfile']['size']     = $_FILES['pdf_file_upload']['size'];
					
                    $filename=$timestamp. "_" . preg_replace("/[_]+/", "_", strtolower(preg_replace('/[^a-zA-Z0-9.]/', "_", $_FILES['pdf_file_upload']['name']))); 	
                    $targetFile = ENQUIRY_FILES_PATH;
 
					$config['file_name']=$filename;
 					$config['upload_path']   = $targetFile; 
 					$config['allowed_types'] = 'pdf|jpg|png|jpeg|docx|doc'; 
 					$config['max_size']      = 2024; 
 					$this->load->library('upload', $config);
 					$this->upload->initialize($config);
 
					 if(!$this->upload->do_upload('userfile')) {
 					    //$error = array('error' => $this->upload->display_errors()); 
 						//print_r($error);
						$response['status']="haserror";
                        $response['msg']=$this->upload->display_errors();	
						echo json_encode($response,JSON_PRETTY_PRINT); 
						exit;
 					 } else { 
 						$is_file_uploaded=$this->upload->data();
 						$final_filename=$is_file_uploaded['file_name'];
 						$file_path=$is_file_uploaded['full_path'];
  					 } 			
			} 
			
  		
		 
		 $data = array( 
		 	    'hid'=>$hospital,	
 				'patient_name'=>$patient_name,
 				'age'=>$age,
				'gender'=>$gender,
				'email'=>$email,
				'phone'=>$phone,
				'comments'=>$comments,
				'file_name'=>$final_filename,
				'status'=>1,
				'parent'=>0,
				'date_added'=>date('Y-m-d H:i:s'),
				'date_modified'=>date('Y-m-d H:i:s')
				);
		     $this->db->insert('tbl_enquiry',$data);
			 $enq_id=$this->db->insert_id();	
 
				#Mail Block
				$mail = new PHPMailer;

				#hospital Name
				$hospital_detail= getHospitals($hospital);
				$hosp_name= count($hospital_detail[0])>0? $hospital_detail[0]->hosp_name:'';

				#enquiry Link
				$enquiry_link = site_url('sysadmin/enquiries/reply/') . $enq_id;

				#Get selected location user 
				$userdata=getuserbylocation($hospital);
				if(count($userdata)>0){
					foreach($userdata as $ud){
						$name=$ud->first_name." ".$ud->last_name;						
						$receiver_email = $ud->email;

						#Mail content
						$en_msg = file_get_contents(ALL_ASSETS_PATH . 'branch_mail.html');
						$en_msg = str_replace('$username', $name, $en_msg);
						$en_msg = str_replace('$location_name', $hosp_name, $en_msg);
						$en_msg = str_replace('$enquiry_link', $enquiry_link, $en_msg);

						#send Mail
						$mail->IsHTML(true);
						$mail->SetFrom($email, $patient_name);
						$mail->Subject = 'New Enquiry | RG Hospitals';
						$mail->Body = $en_msg;
						$mail->AddAddress($receiver_email);
						$mail->AddBCC($this->dbsettings->ENQUIRY_EMAIL, $this->dbsettings->ENQUIRY_NAME);
						$mail->send();

						$mail->ClearAllRecipients();
					}
				}else{
					//IF no user found for the selected location
					
					#Mail content
					$en_msg = file_get_contents(ALL_ASSETS_PATH . 'branch_mail.html');
					$en_msg = str_replace('$username', "Admin", $en_msg);
					$en_msg = str_replace('$location_name', $hosp_name, $en_msg);
					$en_msg = str_replace('$enquiry_link', $enquiry_link, $en_msg);

					#send Mail
					$mail->IsHTML(true);
					$mail->SetFrom($email, $patient_name);
					$mail->Subject = 'New Enquiry | RG Hospitals';
					$mail->Body = $en_msg;
					$mail->AddAddress($this->dbsettings->ENQUIRY_EMAIL, $this->dbsettings->ENQUIRY_NAME);
 					$mail->send();
				}			
		 

   		 $response['status']="success";    
		 $response['msg']="We have received your enquiry and We’ll get back to you very soon. For urgent enquiries please call us on one of the telephone numbers on website.";    
   }
  
  }else{
   $response['status']="haserror";
   $response['msg']="Invalid Request";	  
 }
  echo json_encode($response,JSON_PRETTY_PRINT); 

}
		

function reply($reply_code){
	$this->data['page_title'] = 'Enquiry Reply';
	$this->data['extracss'] = '';
	$this->data['extrajs'] = '';
  
	//$reply_code= $this->uri->segment(3);
	//echo $reply_code;
	$enquiry = $this->enquiries_model->selectdata("*", array('reply_code' => $reply_code), "ORDER BY eid DESC LIMIT 1");
	if(count($enquiry)>0){
		$hid = $enquiry[0]->hid;
		$hosp = $this->hospitals_model->selectdata("*", array('hid' => $hid), "ORDER BY hid DESC");
		$this->data['enquiry'] = $enquiry;	
		$this->data['hospital_name'] = $hosp[0]->hosp_name;
		$this->load->view('public/enquiry/reply',$this->data);
	}else{
		 redirect();
	}
}


function submitreply(){
		$response = array();
		$eid = $this->input->post('eid');
		if (isset($_POST) && !empty($_POST) && !empty($eid)) {

			$this->load->library('form_validation');
			$rules = array(
 				array(
					'field' => 'comments',
					'label' => 'Message',
					'rules' => 'required'
				)
			);
			$messages = array(
 				'comments' => array('required' => "Message is required")
			);

			$this->form_validation->set_rules($rules);
			$this->form_validation->set_rules($messages);

			if ($this->form_validation->run() == FALSE) {
				//$this->form_data = array("hospital" => $_POST['hospital'], "deparment" => $_POST['deparment'], "treatment" => $_POST['treatment'],"patient_name" => $_POST['patient_name'],"age" => $_POST['age'],"gender" => $_POST['gender'],"email" => $_POST['email'],"phone" => $_POST['phone'], "comments" => $_POST['comments']);
				$this->form_error = validation_errors();
				$response['status'] = "haserror";
				$response['msg'] = validation_errors();
			} else {

				 
				$comments = $this->input->post('comments');				
				$timestamp = time();
				$final_filename = '';
				$file_path = '';

				if (isset($_FILES['pdf_file_upload']['name']) && !empty($_FILES['pdf_file_upload']['name'])) {
					//$original_filename = $_FILES['pdf_file_upload']['name'];
					$_FILES['userfile']['name']     = $_FILES['pdf_file_upload']['name'];
					$_FILES['userfile']['type']     = $_FILES['pdf_file_upload']['type'];
					$_FILES['userfile']['tmp_name'] = $_FILES['pdf_file_upload']['tmp_name'];
					$_FILES['userfile']['error']    = $_FILES['pdf_file_upload']['error'];
					$_FILES['userfile']['size']     = $_FILES['pdf_file_upload']['size'];

					$filename = $timestamp . "_" . preg_replace("/[_]+/", "_", strtolower(preg_replace('/[^a-zA-Z0-9.]/', "_", $_FILES['pdf_file_upload']['name'])));
					$targetFile = ENQUIRY_FILES_PATH;

					$config['file_name'] = $filename;
					$config['upload_path']   = $targetFile;
					$config['allowed_types'] = 'pdf|jpg|png|jpeg|docx|doc';
					$config['max_size']      = 2024;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (!$this->upload->do_upload('userfile')) {
						//$error = array('error' => $this->upload->display_errors()); 
					
						//print_r($error);
						$response['status'] = "haserror";
						$response['msg'] = $this->upload->display_errors();
						echo json_encode($response, JSON_PRETTY_PRINT);
						exit;
					} else {
						$is_file_uploaded = $this->upload->data();
						$final_filename = $is_file_uploaded['file_name'];
						$file_path = $is_file_uploaded['full_path'];
					}
				}



				$data = array(
 					'comments' => $comments,
					'file_name' => $final_filename,
 					'parent' => $eid,
					'date_added' => date('Y-m-d H:i:s'),
					'date_modified' => date('Y-m-d H:i:s')
				);
				$this->db->insert('tbl_enquiry', $data);


				//Enquiry Details

				//Set Email content
			/* 	$message = file_get_contents(ALL_ASSETS_PATH . 'branch_mail.html');
				$message = str_replace('$patient_name', $patient_name, $message);
				$message = str_replace('$hospital_name', $hospital_name, $message); */
				

				//Send Mail
				
 
				$response['status'] = "success";
				$response['replydata']= array('reply_comments'=> $comments,'reply_date'=>date('d/m/Y'),'reply_time'=>date('H:i'));
				$response['msg'] = "We have received your enquiry and We’ll get back to you very soon. For urgent enquiries please call us on one of the telephone numbers on website.";
			}
		} else {
			$response['status'] = "haserror";
			$response['msg'] = "Invalid Request";
		}
		echo json_encode($response, JSON_PRETTY_PRINT); 
}
 
	 
}

