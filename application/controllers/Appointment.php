<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Appointment extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
    }

   public function index(){
	    $this->data['page_title'] = 'Contact us';
		$this->data['extracss']='<link href="'.FRONT_ASSETS_PATH.'css/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']= '<script src="'.FRONT_ASSETS_PATH.'js/jquery.datetimepicker.min.js"></script><script src="'.FRONT_ASSETS_PATH.'js/validate.js"></script><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\',minDate: "1"});</script>';

		$meta=getMeta(6);
 		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
 		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
 
  		$this->render('public/pages/appointment');
	}

	public function submitenquiry(){

		$this->load->library('My_PHPMailer');

		$response = array();
 
		$name = isset($_POST['name']) ? $this->input->post('name') : '';
		$email = isset($_POST['email']) ? $this->input->post('email') : '';
		$phone = isset($_POST['phone']) ? $this->input->post('phone') : '';
		$message = isset($_POST['message']) ? $this->input->post('message') : '';
		$appointment_date = isset($_POST['appointment_date']) ? daet('Y-m-d',strtotime($this->input->post('appointment_date'))): '';
		$appointment_time = isset($_POST['appointment_time']) ? $this->input->post('appointment_time') : '';
   
		$subject = "Contactus - Enquiry";

		$msg = "<table width=\"96%\" cellspacing=\"0\" cellpadding=\"2\" border=\"0\"><tbody>";
		$msg .= "<tr><td> Dear Admin,<br><br></td></tr>";
 		$msg .= "<tr><td>Name: " . $name . "</td></tr>";
		$msg .= "<tr><td>Email: " . $email . "</td></tr>";
		$msg .= "<tr><td>Phone: " . $phone . "</td></tr>";
		$msg .= "<tr><td>Appointment Date: " . $appointment_date . "</td></tr>";
		$msg .= "<tr><td>Appointment Time: " . $appointment_time . "</td></tr>";
		$msg .= "<tr><td>Message: " . $message . "</td></tr>";
		$msg .= "<tr><td><br><br>Thank You,<br>Team HAIR STUDIO TOWN</td></tr>";
		$msg .= "</tbody></table>";



		if (!empty($email) && !empty($phone)) {
			//Save data
			$col = array();
			$col['name'] = $name;
			$col['email'] = $email;
			$col['phone'] = $phone;
			$col['appointment_date'] = $appointment_date;
			$col['appointment_time'] = $appointment_time;
			$col['message'] = $message;
 			$this->db->insert('tbl_appointment', $col);

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
			if (!$mail->send()) {
				$response['status'] = "error";
				$response['msg'] = "Something went wrong :( Please try again later";
				$response['mailerror']= $mail->ErrorInfo;
			} else {
				$response['status'] = "success";
				$response['msg'] = "Your request has been submitted successfully. We will get in touch with you very soon.";
			}


			
		} else {
			$response['status'] = "error";
			$response['msg'] = "Invalid request";
		}

		echo json_encode($response, JSON_PRETTY_PRINT);
	}


}

