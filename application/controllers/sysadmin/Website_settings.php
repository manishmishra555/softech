<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Website_settings extends MY_Controller {



	public function __construct()
 	{
 		parent::__construct();  
		$this->load->model('website_settings_model');
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in() && !$this->ion_auth->in_group('admin')) {
			//redirect them to the login page
			redirect('sysadmin/login', 'refresh');
		}
		 
 	}





    public function index()

    {

		$this->load->library('pagination');

        $this->data['page_title'] = 'Manage Website Setting';

 		

   		$this->data['total_record'] = $this->website_settings_model->selectdata("*",array(),"ORDER BY id DESC");

 		$this->load->library('pagination');

 		$config['base_url'] = MAINSITE_MADMIN_URL.'website_settings/page/';

		$config['total_rows'] = count($this->data['total_record']);

		$config['per_page'] = RECORD_PER_PAGE;

		$config["uri_segment"] = PAGINATION_URI_SEGMENT;

 		$config['attributes'] = array('class' => 'page-link');

 		//$config['use_page_numbers']=true;

		$config['full_tag_open'] = '<nav><ul class="pagination">';

        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = false;

        $config['last_link'] = false;

        $config['first_tag_open'] = '<li class="page-item pagination-first">';

        $config['first_tag_close'] = '</li>';

        $config['prev_link'] = '';

        $config['prev_tag_open'] = '<li class="page-item pagination-prev">';

        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = '';

        $config['next_tag_open'] = '<li class="page-item pagination-next">';

        $config['next_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page-item pagination-last">';

        $config['last_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';

        $config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(PAGINATION_URI_SEGMENT)) ? $this->uri->segment(PAGINATION_URI_SEGMENT) : 0;

		$this->data['total_pages']  = $page;

		$this->data['results'] = $this->website_settings_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);

		$this->data['pageing_link'] = $this->pagination->create_links();

		$this->data['extracss']='';

		$this->data['extrajs']='';

        $this->render('sysadmin/setting/website_settings_list', 'templates', 'admin_master');

	}



	public function page()

	{

	  $this->index();

	}

	

	public function create()

    {

		$response=array();

		$response['token']=$this->security->get_csrf_token_name();

		$response['hash']=$this->security->get_csrf_hash();

        $rules = array(

                array(

                     'field'   => 'var_title',

                     'label'   => 'Title',

                     'rules'   => 'required|min_length[2]'

                  ),

				  array(

                     'field'   => 'var_name',

                     'label'   => 'Name',

                     'rules'   => 'required|min_length[2]'

                  ),

                  array(

                     'field'   => 'setting_value',

                     'label'   => 'Value',

                     'rules'   => 'required'

                  )

            );

		   

		   $messages = array(

                 'var_title'  => array('required' => "Variable title is required",'min_length'  => "Please enter more then 2 char Variable title"),

				 'var_name'  => array('required' => "Variable name is required",'min_length'  => "Please enter more then 2 char Variable name"),

				 'setting_value' => array('required' => "Setting value is required")

            );

		

		$this->form_validation->set_rules($rules);

		$this->form_validation->set_rules($messages);

        if($this->form_validation->run()===FALSE)

        {

           	 $response['status']='haserror';

			 $response['error']=validation_errors();

        }

        else

        {

			$data = array(

				'var_title'=>$this->input->post('var_title'),

				'var_name'=>$this->input->post('var_name'),

				'setting_value'=>$this->input->post('setting_value'),

				'old_setting_value'=>$this->input->post('setting_value'),

				'date_added'=>date('Y-m-d H:i:s'),

				'date_modified'=>date('Y-m-d H:i:s'),

				);			

			$this->website_settings_model->insertdata($data);

 			$response['status']='success';	

			$response['msg']="Setting created successfully.";		

         }

		echo json_encode($response); 

		exit;

    }

  	

	public function edit($setting_id = NULL)

    {

         $this->data['page_title'] = 'Website Setting';

 		$this->data['extracss']='';

		$this->data['extrajs']='';



        $rules = array(

                array(

                     'field'   => 'var_title',

                     'label'   => 'Title',

                     'rules'   => 'required|min_length[2]'

                  ),

                  array(

                     'field'   => 'setting_value',

                     'label'   => 'Value',

                     'rules'   => 'required'

                  )

            );

		   

		   $messages = array(

                 'var_title'  => array('required' => "Variable title is required",'min_length'  => "Please enter more then 2 char Variable title"),

				 'setting_value' => array('required' => "Setting value is required")

            );

		

		$this->form_validation->set_rules($rules);

		$this->form_validation->set_rules($messages);

        if($this->form_validation->run() === FALSE)

        {

			$setting =$this->website_settings_model->selectdata("*",array('id'=>$setting_id),"ORDER BY id DESC");

            if(count($setting)>0)

            {

                $this->data['setting'] = $setting;

             }

            else

            {

                $this->session->set_flashdata('message', 'The setting doesn\'t exist.');

                redirect('sysadmin/website_settings', 'refresh');

            }

			//$this->render('sysadmin/setting/edit_settings_view', 'templates', 'admin_master');
			$this->load->view('sysadmin/setting/edit_settings_view',$this->data);

        }

        else

        {

           $data = array(

				'var_title'=>$this->input->post('var_title'),

 				'setting_value'=>$this->input->post('setting_value'),

 				'date_modified'=>date('Y-m-d H:i:s'),

				);

            $this->website_settings_model->updatedata($data,array('id'=>$setting_id));

            //$this->session->set_flashdata('message',$this->ion_auth->messages());

            redirect('sysadmin/website_settings','refresh');

        }

    }

	

		/************** Website Settings Starts **************/

	public function restore($data_id="")

	{

	if(!empty($data_id))

	{

	

	$this->load->model('sysadmin/website_settings_model');

	$data['data_list']= $this->website_settings_model->get_website_settings($data_id);

	$old_setting_value = $data['data_list']['old_setting_value'];

	$this->db->update('tbl_website_setting',array('setting_value' => $old_setting_value), array('id' => $data_id));

	//print_r($data['data_list']['old_setting_value']);

	//exit;

	$data['message'] = "Successfully Restore";

		

		$this->session->set_flashdata('message',$data['message']);

	 redirect(MAINSITE_MADMIN_URL . 'website_settings', 'refresh');

	}

	 

	

	

	}

	

	

	public function delete($data_id="")

	{  

		$data_id = $this->uri->segment(4);

		$page_no = $this->uri->segment(5);

		if(!empty($data_id))

		{

			$data['form_error'] = ""; 

			$this->load->helper('form');			

			$this->load->model('sysadmin/website_settings_model');

			$data['data_list']= $this->website_settings_model->delete_website_settings($data_id);

			$data['message'] = "Successfully Deleted";

		    $this->session->set_flashdata('message',$data['message']);

			

			 redirect(MAINSITE_MADMIN_URL . 'website_settings', 'refresh');

		}

		else

		{

			 redirect(MAINSITE_MADMIN_URL.'website_settings/'.$page_no);

			 exit;

		}

		

	}

	

	

	

	

	public function change_password()

	{

		$this->load->model('sysadmin/users_model');

		$data['page_title']="Change Password";

		$data['page_heading']="Change Password";  

		if($_POST)

		{

			//print_r($_POST);exit;

			$this->form_validation->set_rules('old_password', 'Old password', 'trim|required');

			$this->form_validation->set_rules('new_password', 'New password', 'trim|required|min_length[6]|max_length[20]|callback_passwordCheck');

			$this->form_validation->set_rules('confirm_password', 'Confirm password', 'trim|required|matches[new_password]');

	  if($this->form_validation->run()== FALSE)

      {

        //$this->session->set_userdata("SuccessMessage",'Please correct all errors');

      }

      else

      {

				$old_password = md5($this->input->post('old_password'));

				$new_password = md5($this->input->post('new_password'));

				$confirm_password = $this->input->post('confirm_password');

				

				if($this->users_model->change_password($old_password,$new_password))

				{

					 

					 $this->session->set_userdata("SuccessMessage",'<font color=green>Password changed successfully.</font>');

					 redirect(MAINSITE_MADMIN_URL.'dashboard/');

				}

				else

				{

					//$this->session->set_userdata("SuccessMessage",'<font color=error_msg>Incorrect old password.</font>');

				}

			}

		}

	

		$this->load->view('sysadmin/setting/change_password',$data);

	}

	

	public function passwordCheck($str)

	{

		//!preg_match("/^.*(?=.{8,})(?=.*[A-Z])(?=.*[\d])(?=.*[\W]).*$/i", $str)

		if(!preg_match("/^.*.*$/i", $str))

		{

			$this->form_validation->set_message('passwordCheck', 'Your password should be minimum 6 characters.');

			return FALSE;

		}

		else

		{

			return TRUE; 

		}

		//return ( ! preg_match("/^.*(?=.{8,})(?=.*[A-Z])(?=.*[\d])(?=.*[\W]).*$/i", $str)) ? FALSE : TRUE;

	}

	

	

}

