<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller

{

  protected $data = array();
  function __construct()
  {
    parent::__construct();
    $this->data['page_title'] = '';
  }

 

  protected function render($the_view = NULL,$template_path = NULL, $template = 'master')
  {
    if($template == 'json' || $this->input->is_ajax_request())
    {
      header('Content-Type: application/json');
      echo json_encode($this->data);
    }
    elseif(is_null($template))
    {
      $this->load->view($the_view,$this->data);
    }
    else
    {
      $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view,$this->data, TRUE);
      $this->load->view($template_path.'/'.$template.'_view', $this->data);
    }
  }
}

class Admin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
    $this->load->library('ion_auth');
   

		if (!$this->ion_auth->logged_in())
		{
      //$this->session->set_userdata('referred_from', current_url());
			//redirect them to the login page
			//redirect('sysadmin/login', 'refresh');
		}else {
		 /*$groups=$this->ion_auth->get_users_groups($this->session->userdata('user_id'))->result();
		 if($groups[0]->id!='1'){
  			 redirect(base_url()); 
		  }	*/
		if(!$this->ion_auth->in_group('admin'))
        {
        //$this->session->set_flashdata('message','You are not allowed to visit the Groups page');
        //redirect(base_url(),'refresh');
          //User Module Authentication
          $controller = $this->router->fetch_class();
          $action = $this->router->method;
          $authenticate = authenticateModule($controller, $action);
          if (!$authenticate) {
            redirect('pagenotfound', 'refresh');
          }
        }

      $this->data['modulesname'] = array('dashboard' => 'Dashboard', 'form' => 'Form');
      $this->data['allowedpermissions'] = array('pr_view' => 'View', 'pr_create' => 'Add', 'pr_edit' => 'Edit', 'pr_delete' => 'Delete');
      $this->data['current_user'] = $this->ion_auth->user()->row();
      $this->data['page_title'] = 'Admin Panel';
       
    }

	

	}

	protected function render($the_view = NULL,$template_path='templates', $template = 'admin_master'){
		parent::render($the_view,$template_path,$template);
	}
}


class Public_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		//pr($this->ion_auth->user()->row());die;
    /*if (!$this->ion_auth->logged_in())
    {
      redirect('login', 'refresh');
    }*/    
    $this->data['page_title'] = 'Galorebay';
 	}

	protected function render($the_view = NULL,$template_path='templates', $template = 'master'){
	 parent::render($the_view,$template_path,$template);
	} 
}


class Publicusers_Controller extends MY_Controller
{
  function __construct()
  {
    parent::__construct();

    /* if ($this->session->has_userdata('user_id')) {
      $user_id = $this->session->userdata('user_id');
    } else {
      redirect('');
    } */
    $this->data['page_title'] = 'Dbamy';
  }

  protected function render($the_view = NULL, $template_path = 'templates', $template = 'master')
  {
    parent::render($the_view, $template_path, $template);
  }
}