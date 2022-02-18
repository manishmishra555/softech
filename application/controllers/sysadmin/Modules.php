<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
 		$this->load->model('modules_model');
 		$this->load->model('menulabel_model');
		$this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Modules';

 		$this->data['menulabel'] = $this->modules_model->selectdata("*",array('parent'=>0,'status'=>'active'),"ORDER BY id DESC");
   		$this->data['total_record'] = $this->modules_model->selectdata("*",array(),"ORDER BY id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'modules/page/';
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
		$this->data['modules'] = $this->modules_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
        $this->render('sysadmin/modules/list_modules_view');
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
        $this->form_validation->set_rules('module_name','Module name','trim|required');
        //$this->form_validation->set_rules('module_code','Module code','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
        	$menu_type=$this->input->post('menu_type');
			$module_name=$this->input->post('module_name');
            $column['module_name'] = $module_name;
			$column['module_code'] = !empty($_POST['module_code'])?$this->input->post('module_code'):NULL;			
			$column['mod_create'] = !empty($_POST['pr_create'])?implode(',',$_POST['pr_create']):NULL;
			$column['mod_edit'] = !empty($_POST['pr_edit'])?implode(',',$_POST['pr_edit']):NULL;
			$column['mod_delete'] = !empty($_POST['pr_delete'])?implode(',',$_POST['pr_delete']):NULL;
			$column['mod_view'] = !empty($_POST['pr_view'])?implode(',',$_POST['pr_view']):NULL;
			$column['parent'] = ($menu_type==1)?$this->input->post('parent'):0;
			$column['orderno'] =  !empty($_POST['orderno'])?$this->input->post('orderno'):NULL;
 			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->modules_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Module created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($module_id = NULL)
    {
        $module_id = $this->input->post('module_id') ? $this->input->post('module_id') : $module_id;
        $this->data['page_title'] = 'Module';
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';

        $this->form_validation->set_rules('module_name','Module name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$module =$this->modules_model->selectdata("*",array('id'=>$module_id),"ORDER BY id DESC");
            if(count($module)>0)
            {
                $this->data['module'] = $module;
                $this->data['menulabel'] = $this->modules_model->selectdata("*",array('parent'=>0,'status'=>'active'),"ORDER BY id DESC");
             }
            else
            {
                $this->session->set_flashdata('message', 'The module doesn\'t exist.');
                redirect('sysadmin/modules', 'refresh');
            }
            $this->render('sysadmin/modules/edit_modules_view');
        }
        else
        {
			$menu_type=$this->input->post('menu_type');
			$module_name=$this->input->post('module_name');
            $column['module_name'] = $module_name;
			$column['module_code'] = !empty($_POST['module_code'])?$this->input->post('module_code'):NULL;			
			$column['mod_create'] = !empty($_POST['pr_create'])?implode(',',$_POST['pr_create']):NULL;
			$column['mod_edit'] = !empty($_POST['pr_edit'])?implode(',',$_POST['pr_edit']):NULL;
			$column['mod_delete'] = !empty($_POST['pr_delete'])?implode(',',$_POST['pr_delete']):NULL;
			$column['mod_view'] = !empty($_POST['pr_view'])?implode(',',$_POST['pr_view']):NULL;
			$column['orderno'] =  !empty($_POST['orderno'])?$this->input->post('orderno'):NULL;
			$column['parent'] = ($menu_type==1)?$this->input->post('parent'):0;
 			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
            //pr($column); die;
            $this->modules_model->updatedata($column,array('id'=>$module_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('modules','refresh');
        }
    }

public function status()
	{   
	    $response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
 	    $id=$this->input->post('id');
		$status=$this->input->post('status');
 	    if($id!=''){
	    if($status=='active'){
			$status='inactive';
			}else if($status=='inactive'){
			 $status='active';
			}
	    $columns=array();
		$columns['status']=$status;
		$conditions=array();
		$conditions['id']=$id;
		$this->modules_model->updatedata($columns,$conditions);
		//$msg = "Expense module_name Status Successfully Updated.";
		//$this->session->set_flashdata('msg', $msg);
		//redirect($this->input->get('url'));
		 $response['status_changed']=$status;
		 $response['status']='success';
		}else{
	     $response['status']='haserror';
		 $response['error']="Invalid request.";
		}
	  echo json_encode($response); 
	  exit;	
	}

    public function delete()
	{   
	    $column=array();
		$column['id']=$this->input->post('id');
	    $deleted = $this->modules_model->deletedata($column);
		$msg = "Data Successfully Deleted.";
		$this->session->set_flashdata('msg', $msg);
		//redirect($this->input->get('url'));
	}
	
	public function search(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $searchkey=$this->input->post('searchkey');
		if(!empty($searchkey)){
		 $cond="AND module_name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->modules_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['module_name']=$l->module_name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
	public function listMethods(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $module_code=$this->input->post('module_code');
		if(!empty($module_code))
		{
			$allmethods=loadClassMethods($module_code);
			if(count($allmethods)>0){
		 	$response['data']=$allmethods;
			$response['status']="success";
			}else{
 			$response['status']="haserror";
			$response['error']="No module found by this name.";
			}
		}else{
			$response['status']="haserror";
			$response['error']="Invalid Request";
		}
		echo json_encode($response);
	}

 	
}