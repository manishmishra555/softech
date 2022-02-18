<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Login extends Publicusers_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
		$this->load->model('users_model');    
		if($this->session->has_userdata('userId')) {
			redirect('user/info');
		}    
   }

   public function index()
   {
	    $this->data['page_title'] = 'Login';
		$this->data['extracss']='';
		$this->data['extrajs']='';
  		 
		$meta = getMeta(0);
		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Login';
		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
		$this->render('public/login/loginpage');
	}
	
	function validatelogin(){
		$response=array();
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run()===FALSE){
			$response['status']='haserror';  
		    $response['error']=validation_errors();
	  	}else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$user_info = $this->users_model->selectdata("*",array('email'=>$email,'password'=>$password),"ORDER BY id DESC LIMIT 1");
			if(count($user_info)>0){
			    if($user_info[0]->status == 'inactive'){
			        $response['status']='haserror'; 
				    $response['error']="Your Account is under Review...You will be notified soon once verification is completed.";
				    echo json_encode($response); 
            		$_SESSION['msg'] = $response;
            		redirect('/login');
			    }else{
			        $this->session->set_userdata('userId', $user_info[0]->id);				 
				    $response['status']='success'; 
				    $response['error']="Login Successful !!";
				    echo json_encode($response); 
            		$_SESSION['msg'] = $response;
            		redirect('/');
			    }
				
			}else{
				$response['status']='haserror';  
				$response['error']="Invalid Email ID or Password !!";	
				echo json_encode($response); 
        		$_SESSION['msg'] = $response;
        		redirect('/login');
			}
		}

	}
	
	function recoverPassword(){
		$response=array();
		$tokenId =  $this->uri->segment(2);
        
			$user_info = $this->users_model->selectdata("*",array('token'=>$tokenId,'status'=>'active'),"ORDER BY id DESC LIMIT 1");
			if(count($user_info)>0){	
			    $auth_date = $user_info[0]->otp_date;
			    $today_dt = date("Y-m-d H:i:s");
			    if (strtotime($today_dt) < strtotime($auth_date)) {
			        $this->data['page_title'] = 'Update Password';
            		$this->data['extracss']='';
            		$this->data['extrajs']='';
            		
            		
            		$this->data['token']=$tokenId;
            		$this->data['email']=$user_info[0]->email;
              		 
            		$meta = getMeta(0);
            		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Register';
            		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
            		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
            		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
            		$this->render('public/login/recover_pwd');
			    }else{
		            $response['status']='haserror';  
    				$response['error']="This Link has expired..Please try again !!";	
    				$_SESSION['msg'] = $response;
    		        redirect('/forgot-password');
			    }
		
			}else{
				$response['status']='haserror';  
				$response['error']="Invalid Email ID !!";	
				$_SESSION['msg'] = $response;
		        redirect('/forgot-password');
			}
			
	}
	
	function validateforgotupdatePwd(){
		$response=array();
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('token','Invalid Link','required');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','required');

		if($this->form_validation->run()===FALSE){
			$response['status']='haserror';  
		    $response['error']=validation_errors();
    		$_SESSION['msg'] = $response;
    		redirect('/forgot-password');
	  	}else{
			$token=$this->input->post('token');
			$password = $this->input->post('password');
			$confirmpassword = $this->input->post('confirmpassword');
			if($password != $confirmpassword){
			    $response['status']='haserror';  
    			$response['error']="Password and Confirm Password Should Match !!";	
			
        		echo json_encode($response); 
        		$_SESSION['msg'] = $response;
        		redirect('/recover-password/'.$token);
			}else{
			    $email=$this->input->post('email');
			    $column['password']=md5($this->input->post('password'));
			    
                $column['email_verification']=1;

                $this->db->where('email', $email);
                $this->db->where('token', $token);
                $this->db->update('tbl_customer', $column);
                
                $response['status']='success';  
    			$response['error']="Password Updated Successfully !!";	
			
        		echo json_encode($response); 
        		$_SESSION['msg'] = $response;
        		redirect('/login');
			}
		}

	}

	function validateforgotPwd(){
		$response=array();
        $this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');

		if($this->form_validation->run()===FALSE){
			$response['status']='haserror';  
		    $response['error']=validation_errors();
	  	}else{
			$email = $this->input->post('email');
			$password = md5($this->input->post('password'));
			$user_info = $this->users_model->selectdata("*",array('email'=>$email),"ORDER BY id DESC LIMIT 1");
			if(count($user_info)>0){
			    if($user_info[0]->status == 'inactive'){
			        $response['status']='haserror'; 
				    $response['error']="Your Account is under Review...You will be notified soon once verification is completed.";
			    }else{
			    $uname = $user_info[0]->name;
			    $subject = "Forgot Password - Galorebay Optix India";
			    $length = 78;
		        $token = bin2hex(random_bytes($length));
			    $today_dt = date("Y-m-d H:i", strtotime('+1 hour'));
			    $message = '<table border="0" cellpadding="0" cellspacing="0" style="background:#f6f6f6;font-size:15px;line-height:25px;font-family:Arial,Helvetica,sans-serif;padding:25px;border:1px solid #ccc" width="700">
                    	    <tbody>
                    	        <tr>
                    	            <td align="right" valign="top"><img alt="logo" src="https://www.galorebayoptix.com/assets/front/images/menu/logo/logo-2.png?id='.$token.'" class="CToWUd"></td>
                    	        </tr>
                    	        <tr>
                    	            <td align="left" valign="top">Dear '.$uname.',<br>
                    	            <br>
                    	            You have requested to reset your password. Please use the link below to access our secure password reset function.<br>
                    	            <br>
                    	            <span style="background:#224275;color:#fff;padding:5px 15px;border-radius:5px"><a href="https://www.galorebayoptix.com/recover-password/'.$token.'" style="color:#fff;text-decoration:none" target="_blank" >Reset Password</a></span><br><br>
                                The above link will be valid for 1 hour from the time of the request.<br>
                    	            <br>
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
                        $config['mailtype'] = 'html';
                        $this->email->initialize($config);
                        $this->email->from('info@galorebayoptix.com', 'Galorebay Optix India');
                        $this->email->to($email);
                        // $this->email->cc('another@another-example.com');
                        // $this->email->bcc('them@their-example.com');
                        
                        $this->email->subject($subject);
                        $this->email->message($message);
                        
 
                if($this->email->send()){	 
                    
                    $column['token']=$token;
                    $column['otp_date']=$today_dt;
                    //$column['email_verification']=1;

                    $this->db->where('email', $email);
                    $this->db->update('tbl_customer', $column);
                
                    
    				$response['status']='success'; 
    				$response['error']="Please Check your mail, We have sent you a Password recovery Process !!";
                }else{
                    $response['status']='haserror';  
				    $response['error']="SOmething Went Wrong, Please Contact toAdministrator.!!";	
                }
			}
			}else{
				$response['status']='haserror';  
				$response['error']="Invalid Email ID !!";				 
			}
		}
		
		echo json_encode($response); 
		$_SESSION['msg'] = $response;
		redirect('/forgot-password');

	}

	function logout(){
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('msg');
		redirect('login');
	}

	function register(){
		$this->data['page_title'] = 'Register';
		$this->data['extracss']='';
		$this->data['extrajs']='';
  		 
		$meta = getMeta(0);
		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Register';
		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
		$this->render('public/login/registration');
	}

	function submitregistration(){
		$response=array();
        $this->load->library('form_validation');

		$this->form_validation->set_rules('otp_validate','One Time Password','trim|required');

		if($this->form_validation->run()===FALSE){
      		$response['status']='haserror';  
		    $response['error']=validation_errors();
        }else{
			$name1 = $this->input->post('uname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$password = md5($this->input->post('password'));
			$comp_name = $this->input->post('comp_name');
			$comp_gst = $this->input->post('comp_gst');
			$pan_no = $this->input->post('pan_no');
			
			
			$addr_name_comp = $this->input->post('addr_name_comp');
			$addr_mobile_comp = $this->input->post('addr_mobile_comp');
			$addr_line1_comp = $this->input->post('addr_line1_comp');
			$addr_line2_comp = $this->input->post('addr_line2_comp');
			$addr_city_comp = $this->input->post('addr_city_comp');
			$addr_state_comp = $this->input->post('addr_state_comp');
			$addr_pincode_comp = $this->input->post('addr_pincode_comp');
			
			$otp_validate = $this->input->post('otp_validate');
			$flag = 0;
			
			$user_info = $this->users_model->selectdata("*",array('email'=>$email,'status'=>'inactive'),"ORDER BY id DESC LIMIT 1");
		
			if(count($user_info)>0){	
			    $auth_date = $user_info[0]->otp_date;
			    $otp = $user_info[0]->otp;
			    $today_dt = date("Y-m-d H:i:s");
			    if (strtotime($today_dt) < strtotime($auth_date)) {
			        if($otp != $otp_validate){
			            $response['status']='haserror';
		                $response['error']='*Wrong OTP Entered.';
			        }else{
			            $flag = 1;
			        }
			    }else{
			        $response['status']='haserror';
		            $response['error']='*OTP Expired. Please Try Again..';
			    }
			    
			}
			
			if($flag == 1){

			$column1['adr_name_res']=$addr_name_comp;
			$column1['mobile_res']=$addr_mobile_comp;
			$column1['addressline1_res']=$addr_line1_comp;
			$column1['addressline2_res']=$addr_line2_comp;
			$column1['city_res']=$addr_city_comp;
			$column1['state_res']=$addr_state_comp;
			$column1['zipcode_res']=$addr_pincode_comp;
			$column1['date_added']=date('Y-m-d H:i:s');
			$column1['date_modified']=date('Y-m-d H:i:s');
			
			$this->db->where('email',$email);
			$this->db->where('mobile',$mobile);
			$this->db->update('tbl_customer',array('mobile_verification'=>'1','email_verification'=>'1','verified'=>'1'));
			

			$user_info = $this->users_model->selectdata("max(id) as dd",array(),"");
			$max_id = $user_info[0]->dd;
			$column1['uid']=$max_id;
			
			$length = 78;
		    $token = bin2hex(random_bytes($length));

			if($this->db->insert('tbl_address',$column1)){
			    $subject = 'New Registration - Galorebay Optix India';
			    $message = '<table border="0" cellpadding="0" cellspacing="0" style="background:#f6f6f6;font-size:15px;line-height:25px;font-family:Arial,Helvetica,sans-serif;padding:25px;border:1px solid #ccc" width="700">
                    	    <tbody>
                    	        <tr>
                    	            <td align="center" valign="top"><img alt="logo" src="https://www.galorebayoptix.com/assets/front/images/menu/logo/logo-2.png?id='.$token.'" class="CToWUd"></td>
                    	        </tr>
                    	        <tr>
                    	            <td align="left" valign="top">New Registration - Galorebay Optix India<br>
                    	            <p style="font-size: 18px;font-weight: 600;color: #1d4276;">Customer Info</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Name</b> : '.$name1.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Email ID</b> : '.$email.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Contact No.</b> : '.$mobile.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Company Name</b> : '.$comp_name.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>GST No.</b> : '.$comp_gst.'</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;"><b>Pan No.</b> : '.$pan_no.'</p>
                    	            <br>
                    	            <p style="margin: unset;font-size: 18px;font-weight: 600;color: #1d4276;">Customer Address</p>
                    	            <p style="margin: unset;font-size: 14px;color: #636363;">'.$addr_line1_comp.','.$addr_line2_comp.','.$addr_city_comp.','.$addr_state_comp.' - '.$addr_pincode_comp.'</p>
                    	            <br>
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
                $config['mailtype'] = 'html';
                // $config['protocol'] = 'smtp';
                // $config['smtp_host'] = 'smtpout.secureserver.net';
                // $config['smtp_user'] = 'info@galorebayoptix.com';
                // $config['smtp_pass'] = 'Galorebay@9897';
                // $config['SMTPSecure'] = 'ssl';
                // $config['smtp_port'] = 25;
                // $config['SMTPDebug'] = 1;
                // $config['SMTPAuth'] = false;
                
                
                $this->email->initialize($config);
                $this->email->from($email, $name1);
                $this->email->to('info@galorebayoptix.com');
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                $this->email->subject($subject);
                $this->email->message($message);
                $this->email->send();
                
                
                
                $subject1 = 'Registration Successful - Galorebay Optix India';
			    $message1 = '<table border="0" cellpadding="0" cellspacing="0" style="background:#f6f6f6;font-size:15px;line-height:25px;font-family:Arial,Helvetica,sans-serif;padding:25px;border:1px solid #ccc" width="700">
                    	    <tbody>
                    	        <tr>
                    	            <td align="center" valign="top"><img alt="logo" src="https://www.galorebayoptix.com/assets/front/images/menu/logo/logo-2.png?id='.$token.'" class="CToWUd"></td>
                    	        </tr>
                    	        <tr>
                    	            <td align="left" valign="top">Dear '.$name1.',<br><br>
                    	            Thanks for registering at Galorebay Optix India, Our Team will contact you soon.
                    	            <br>
                    	            <br>
                    	            <br>
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
                $this->email->from('info@galorebayoptix.com', 'Galorebay Optix India');
                $this->email->to($email);
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                $this->email->subject($subject1);
                $this->email->message($message1);
                $this->email->send();
                
                
			    $response['status']='success';
		        $response['error']='Registration Successful. We will contact you soon..!';
			}else{
			    $response['status']='haserror';  
			    $response['error']='Something Went wrong, Please Contact Administrator..!';
			}
			
			    
			}
			
		}
		echo json_encode($response); 
	}
	
	function forgotPassword(){
	    $this->data['page_title'] = 'Forgot Password';
		$this->data['extracss']='';
		$this->data['extrajs']='';
  		 
		$meta = getMeta(0);
		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Register';
		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
		$this->render('public/login/forget_pwd');
	}
	function resend_register_otp(){
	        $name1 = $this->input->post('uname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$comp_name = $this->input->post('comp_name');
			$comp_gst = $this->input->post('comp_gst');
			$pan_no = $this->input->post('pan_no');
			
			$length = 78;
		    $token = bin2hex(random_bytes($length));
            $today_dt = date("Y-m-d H:i", strtotime('+1 hour'));
            $ccode = rand(1000,9999);
 
			$column['status']='inactive';
			$column['token']=$token;
			$column['otp']=$ccode;
			$column['otp_date']=$today_dt;



			
			$this->db->where('email', $email);
            $this->db->update('tbl_customer', $column);


			    $subject = 'Account Verification - Galorebay Optix India';
			    $mail_content = 'Dear <b>'.$name1.'</b>,<br>This is our system generated mail that is being sent out to you with regard to your account at <a href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a><br><br>For Enhance security of your account, you need to verify your email address <b><a href="'.$email.'"></b>'.$email.'</a><br><br>Please Enter this OTP to activate your account :<br>
                                                                <p style="text-align: center;font-size: 18px;background-color: #61ba5e;font-weight: 800;width: fit-content;margin: 0 auto;   padding: 10px;">'.$ccode.'</p>
                                                                <p><span style="color: red;font-size: 12px;">Note:</span> This OTP will be valid for 1 hours.</p>
                                                                <p>After you verfy your email address, you can start Query for products on <a href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a> </p>';
                $mail_header = 'Your <a style="color: white;font-weight: 700;text-decoration: none;" href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a> Account Verification';
        
        
                #Mail content
                $subject="Account Verification - Galorebay Optix India";
                $en_msg = file_get_contents(FRONT_ASSETS_PATH . 'reg_email.html');
                $en_msg = str_replace('$mail_header', $mail_header, $en_msg);
                $en_msg = str_replace('$mail_content', $mail_content, $en_msg);
        
                $this->load->library('email');
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('info@galorebayoptix.com', 'Galorebay Optix India');
                $this->email->to($email);
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                
                $this->email->subject($subject);
                $this->email->message($en_msg);
                $this->email->send();
                        
        	    $response['status']='success';
                $response['error']='Please Enter an OTP Sent on your Email ID and Phone to activate your account..!';
			echo json_encode($response); 
	}
	
	function registration_check(){
		$response=array();
        $this->load->library('form_validation');

		$this->form_validation->set_rules('uname','User name','trim|required');
		$this->form_validation->set_rules('mobile','Mobile No.','trim|required');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required');
		
		$this->form_validation->set_rules('addr_name_comp','Name','trim|required');
		$this->form_validation->set_rules('addr_mobile_comp','Mobile Number','trim|required');
		$this->form_validation->set_rules('addr_line1_comp','Address Line 1','trim|required');
		$this->form_validation->set_rules('addr_city_comp','City','trim|required');
		$this->form_validation->set_rules('addr_state_comp','State','trim|required');
		$this->form_validation->set_rules('addr_pincode_comp','Pincode','trim|required|min_length[6]');

		

		if($this->form_validation->run()===FALSE){
      		$response['status']='haserror';  
		    $response['error']=validation_errors();
        }else{
			$name1 = $this->input->post('uname');
			$email = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$password = md5($this->input->post('password'));
			$comp_name = $this->input->post('comp_name');
			$comp_gst = $this->input->post('comp_gst');
			$pan_no = $this->input->post('pan_no');
			
			$length = 78;
		    $token = bin2hex(random_bytes($length));
            $today_dt = date("Y-m-d H:i", strtotime('+1 hour'));
            $ccode = rand(1000,9999);
 
			$column['name']=$name1;
			$column['email']=$email;
			$column['mobile']=$mobile;
			$column['password']=$password;
			$column['company_name']=$comp_name;
			$column['gst_no']=$comp_gst;
			$column['pan_no']=$pan_no;
			$column['status']='inactive';
			$column['token']=$token;
			$column['otp']=$ccode;
			$column['otp_date']=$today_dt;


			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');

			
			$user_chk = $this->users_model->selectdata("*",array('email'=>$email,'status'=>'active'),"ORDER BY id DESC");
			if(count($user_chk)>0){
			    $response['status']='haserror';
		        $response['error']='Email ID already exists..! Please try again with another Email ID..';
			}else{
			    
			    $user_chk1 = $this->users_model->selectdata("*",array('email'=>$email,'status'=>'inactive'),"ORDER BY id DESC");
			    if(count($user_chk1)>0){
			        
                    $this->db->where('email', $email);
                    $this->db->delete('tbl_customer');
			    }
			    
		    	$this->db->insert('tbl_customer',$column);


			    $subject = 'Account Verification - Galorebay Optix India';
			    $mail_content = 'Dear <b>'.$name1.'</b>,<br>This is our system generated mail that is being sent out to you with regard to your account at <a href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a><br><br>For Enhance security of your account, you need to verify your email address <b><a href="'.$email.'"></b>'.$email.'</a><br><br>Please Enter this OTP to activate your account :<br>
                                                                <p style="text-align: center;font-size: 18px;background-color: #61ba5e;font-weight: 800;width: fit-content;margin: 0 auto;   padding: 10px;">'.$ccode.'</p>
                                                                <p><span style="color: red;font-size: 12px;">Note:</span> This OTP will be valid for 1 hours.</p>
                                                                <p>After you verfy your email address, you can start Query for products on <a href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a> </p>';
                $mail_header = 'Your <a style="color: white;font-weight: 700;text-decoration: none;" href="https://www.galorebayoptix.com/" target="_blank">galorebayoptix.com</a> Account Verification';
        
        
                #Mail content
                $subject="Account Verification - Galorebay Optix India";
                $en_msg = file_get_contents(FRONT_ASSETS_PATH . 'reg_email.html');
                $en_msg = str_replace('$mail_header', $mail_header, $en_msg);
                $en_msg = str_replace('$mail_content', $mail_content, $en_msg);
        
                $this->load->library('email');
                $config['mailtype'] = 'html';
                $this->email->initialize($config);
                $this->email->from('info@galorebayoptix.com', 'Galorebay Optix India');
                $this->email->to($email);
                // $this->email->cc('another@another-example.com');
                // $this->email->bcc('them@their-example.com');
                
                $this->email->subject($subject);
                $this->email->message($en_msg);
                $this->email->send();
                        
        	    $response['status']='success';
                $response['error']='Please Enter an OTP Sent on your Email ID and Phone to activate your account..!';
			}
		}
		echo json_encode($response); 
	}
	
	 
}

