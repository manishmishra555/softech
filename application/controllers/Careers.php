<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Careers extends Public_Controller {
   function __construct(){
        parent::__construct();
		$this->load->model('career_model');
     }

   public function index(){
	    $this->data['page_title'] = 'Career';
		$this->data['extracss']='';
		$this->data['extrajs'] = '<script src="' . FRONT_ASSETS_PATH . 'js/validate.js"></script>';

		//pr($this->data['career']);
		$meta=getMeta(4);
		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';

		$this->render('public/career/career');
  		//$this->load->view( 'public/career/career',$this->data);
	}

    

	function submitcareer()
	{
		//$this->load->library('My_PHPMailer');		

		$response = array();
		if (isset($_POST) && !empty($_POST)) {

			$this->load->library('form_validation');
			$rules = array(
				array(
					'field' => 'firstname',
					'label' => 'First Name',
					'rules' => 'required'
				),
				array(
					'field' => 'lastname',
					'label' => 'Last Name',
					'rules' => 'required'
				),				 		 
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required'
				),
				array(
					'field' => 'phone',
					'label' => 'Contact No',
					'rules' => 'required|numeric|exact_length[10]'
				), array(
					'field' => 'currentcity',
					'label' => 'Current City',
					'rules' => 'required'
				), array(
					'field' => 'designation',
					'label' => 'Designation',
					'rules' => 'required'
				), array(
					'field' => 'currentcompany',
					'label' => 'Current Company',
					'rules' => 'required'
				), array(
					'field' => 'currentctc',
					'label' => 'Current CTC',
					'rules' => 'required'
				),				
			);
			$messages = array(
				'firstname' => array('required' => "Please enter first name"),
				'lastname' => array('required' => "Please enter last name"),
 				'email' => array('required' => "Email is required"),
				'phone' => array('required' => "Contact No is required", 'exact_length' => "Please enter valid phone number"),
				'currentcity' => array('required' => "Please enter Current City"),
				'designation' => array('required' => "Please enter Designation"),
				'currentcompany' => array('required' => "Please enter Current Company name"),
				'currentctc' => array('required' => "Please enter your Current CTC")
 			);

			$this->form_validation->set_rules($rules);
			$this->form_validation->set_rules($messages);

			if ($this->form_validation->run() == FALSE) {
				//$this->form_data = array("hospital" => $_POST['hospital'], "deparment" => $_POST['deparment'], "treatment" => $_POST['treatment'],"patient_name" => $_POST['patient_name'],"age" => $_POST['age'],"gender" => $_POST['gender'],"email" => $_POST['email'],"phone" => $_POST['phone'], "comments" => $_POST['comments']);
				$this->form_error = validation_errors();
				$response['status'] = "haserror";
				$response['msg'] = validation_errors();
			} else {

				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');

				$name=$firstname." ".$lastname;

  				$email = $this->input->post('email');
				$phone = $this->input->post('phone');
				$currentcity = $this->input->post('currentcity');
				$designation = $this->input->post('designation');
				$currentcompany = $this->input->post('currentcompany');
				$currentctc = $this->input->post('currentctc');

 				$timestamp = time();

				$final_filename = '';
				$file_path = '';

				if (isset($_FILES['cv_file_upload']['name']) && !empty($_FILES['cv_file_upload']['name'])) {
					$original_filename = $_FILES['cv_file_upload']['name'];
					$_FILES['userfile']['name']     = $_FILES['cv_file_upload']['name'];
					$_FILES['userfile']['type']     = $_FILES['cv_file_upload']['type'];
					$_FILES['userfile']['tmp_name'] = $_FILES['cv_file_upload']['tmp_name'];
					$_FILES['userfile']['error']    = $_FILES['cv_file_upload']['error'];
					$_FILES['userfile']['size']     = $_FILES['cv_file_upload']['size'];

					$filename = $timestamp . "_" . preg_replace("/[_]+/", "_", strtolower(preg_replace('/[^a-zA-Z0-9.]/', "_", $_FILES['cv_file_upload']['name'])));
					$targetFile = CV_FILES_PATH;

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

				$attachment_link = CV_FILES_URL . $final_filename;



				$msg = "<table width=\"96%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
				$msg .= "<tr><td> Dear Admin,<br><br></td></tr>";				 
				$msg .= "<tr><td>Name: " . $name . "</td></tr>";
				$msg .= "<tr><td>Email: " . $email . "</td></tr>";
				$msg .= "<tr><td>Phone: " . $phone . "</td></tr>";
				$msg .= "<tr><td>Current City: " . $currentcity . "</td></tr>";
				$msg .= "<tr><td>Designation: " . $designation . "</td></tr>";
				$msg .= "<tr><td>Current Company: " . $currentcompany . "</td></tr>";
				$msg .= "<tr><td>Current CTC: " . $currentctc . "</td></tr>";
				$msg .= "<tr><td>Attachment Link: " . $attachment_link . "</td></tr>";


				$msg .= "<tr><td><br><br>Thank You,<br>Team Tuoren</td></tr>";
				$msg .= "</tbody></table>";

				$data = array(
					'name' => $name,
 					'email' => $email,
					'phone' => $phone,
					'currentcity' => $currentcity,
					'file_name' => $final_filename,
					'designation' => $designation,
					'currentcompany' => $currentcompany,
					'currentctc' => $currentctc,
					'date_added' => date('Y-m-d H:i:s'),
 				);
				$this->db->insert('tbl_careerenquiry', $data);


				//Send Email
				// $mail->AddAddress('amit75965@gmail.com');
				// $subject="New Career Enquiry";
				// $mail = new PHPMailer();   
				// $mail->IsHTML(true);
 			// 	$mail->SetFrom($email, $name);
				// $mail->Subject = $subject;
				// $mail->Body = $msg;
				//$mail->AddAddress($this->dbsettings->CAREER_EMAIL, $this->dbsettings->CAREER_NAME);
				//$mail->AddAddress($this->dbsettings->CAREER_EMAIL, $this->dbsettings->CAREER_NAME);				
				//$mail->AddBCC('abhishek.k@doorsstudio.com');
				//$mail->send();

				//Send Mail
				/* $mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->Mailer = "smtp";
				$mail->SMTPDebug  = 1;
				$mail->SMTPAuth   = TRUE;
				$mail->SMTPSecure = "ssl";
				$mail->Port       = 465;
				$mail->Host       = "smtp.gmail.com";
				$mail->Username   = "rohin.mathews05@gmail.com";
				$mail->Password   = "tuo123##";

				$mail->IsHTML(true);
				$mail->AddAddress($this->dbsettings->CAREER_EMAIL, $this->dbsettings->CAREER_NAME);
				$mail->SetFrom($email, $name);
				$mail->Subject = $subject;
				$mail->Body = $msg; */
  		// 		if (!$mail->Send()) {
				// 	$response['status'] = "haserror";
				// 	$response['msg'] = "Something went wrong :( Please try again later.";
				// 	//$response['error']= $mail;
				// 	//var_dump($mail);
				// } else {
					$response['status'] = "success";
					$response['msg'] = "Thank you for submitting your information and We will get back to you very soon.";
				// }
 

 				
			}
		} else {
			$response['status'] = "haserror";
			$response['msg'] = "Invalid Request";
		}
		//echo json_encode($response, JSON_PRETTY_PRINT);
		//redirect('careers');
		$_SESSION['msg'] = $response;
		redirect('/careers');
	}

}

