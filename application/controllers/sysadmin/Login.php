<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends MY_Controller
{
  function __construct()
  {
    parent::__construct();
	$this->load->library('ion_auth');
   }
  
 public function index()
  {
	  
	if ($this->ion_auth->logged_in())
    {
      //redirect them to the login page
      redirect('sysadmin/dashboard', 'refresh');
    }else{
    $this->data['page_title'] = 'Login';
    if($this->input->post())
     {
     //here we will verify the inputs;
		$this->load->library('form_validation');
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		//$this->form_validation->set_rules('remember','Remember me','integer');
		if($this->form_validation->run()===TRUE)
		{
		  //$remember = (bool) $this->input->post('remember');
		  if ($this->ion_auth->adminlogin($this->input->post('identity'), $this->input->post('password')))
		  {
						$uid = $this->ion_auth->user()->row()->id;
						$group = $this->ion_auth->get_users_groups()->result();
						if (!empty($group)) {
							foreach ($group as $g) {
								$group_id[] = $g->id;
							}
						}
						//pr($group_id); die;

						$allowed_modules = array();
						$menu_items = array();
						$modules = getModules($uid, $group_id);
						foreach ($modules as $m) {
							//echo $m->module_code.": ".$m->pr_create." | ".	$m->pr_edit." | ".$m->pr_delete." | ".$m->pr_view;
							//CHeck individual module for the permmissions
							if ($m->pr_create == 0 && $m->pr_edit == 0 && $m->pr_delete == 0 && $m->pr_view == 0) { } else {
								$allowed_modules[$m->module_code] = array();

								$parent = $m->parent;
								$module_code = "sysadmin/".$m->module_code;
								if ($parent == 0 && !empty($module_code)) {
									$menu_items[$module_code] = $m->module_name;
								} else {
									//Get Parent Name
									$moduleinfo = getModuleInfo($m->parent);
									$new_module_name = $moduleinfo[0]->module_name;
									//$new_module_name=get_valid_name($module_name);
									if (array_key_exists($new_module_name, $menu_items)) {
										//array_push($menu_items[$new_module_name], array($module_code=>$m->module_name));
										$newmenu = $module_code . "~" . $m->module_name;
										array_push($menu_items[$new_module_name], $newmenu);
									} else {
										$menu_items[$new_module_name] = array();
										$newmenu = $module_code . "~" . $m->module_name;
										array_push($menu_items[$new_module_name], $newmenu);
									}
								}

								//$allmodules = array();

								if ($m->pr_create == 1) {
									$pr_create = !empty($m->mod_create) ? explode(',', $m->mod_create) : array();
									if (count($pr_create) > 0) {
										foreach ($pr_create as $mo) {
											array_push($allowed_modules[$m->module_code], $mo);
										}
									}
								}
								if ($m->pr_edit == 1) {
									$pr_edit = !empty($m->mod_edit) ? explode(',', $m->mod_edit) : array();
									if (count($pr_edit) > 0) {
										foreach ($pr_edit as $mo) {
											array_push($allowed_modules[$m->module_code], $mo);
										}
									}
								}
								if ($m->pr_delete == 1) {
									$pr_delete = !empty($m->mod_delete) ? explode(',', $m->mod_delete) : array();
									if (count($pr_delete) > 0) {
										foreach ($pr_delete as $mo) {
											array_push($allowed_modules[$m->module_code], $mo);
										}
									}
								}
								if ($m->pr_view == 1) {
									$pr_view = !empty($m->mod_view) ? explode(',', $m->mod_view) : array();
									if (count($pr_view) > 0) {
										foreach ($pr_view as $mo) {
											array_push($allowed_modules[$m->module_code], $mo);
										}
									}
								}
							}
						}
						// pr($allowed_modules);
						// pr($menu_items); die;

						//Default landing page
						$default_page = !empty($group[0]->default_page) ? 'sysadmin/'.$group[0]->default_page : 'defaultpage';
						$this->session->set_userdata('allowed_modules', $allowed_modules);
						$this->session->set_userdata('menu_items', $menu_items);
						$this->session->set_userdata('default_page', $default_page);
 						redirect($default_page, 'refresh');
		  }
		  else
		  {
			$this->session->set_flashdata('message',$this->ion_auth->errors());
			redirect('sysadmin/login', 'refresh');
		  }
		}
     }
     $this->load->view('sysadmin/login_view');
	}
  }

public function logout(){
   $this->ion_auth->logout();
   redirect('sysadmin/login', 'refresh');
}

}
