<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('pages_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Pages';
 		
   		$this->data['total_record'] = $this->pages_model->selectdata("*",array(),"ORDER BY pages_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'pages/page/';
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
		$this->data['pages'] = $this->pages_model->selectdata("*",array(),'ORDER BY pages_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->load->view('sysadmin/pages/list',$this->data);
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
        $this->form_validation->set_rules('pages_title','Pages title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Pages description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$name=$this->input->post('pages_title');
            $column['pages_title'] = $name;
            $column['pages_desc'] = $this->input->post('pages_desc');
 			$column['url_slug']=get_valid_name($name);
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->pages_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Page created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($pages_id = NULL)
    {
		$pages_id = $this->input->post('pages_id') ? $this->input->post('pages_id') : $pages_id;
        $this->data['page_title'] = 'Pages';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('pages_title','Pages title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$pages =$this->pages_model->selectdata("*",array('pages_id'=>$pages_id),"ORDER BY pages_id DESC");
            if(count($pages)>0)
            {
                $this->data['pages'] = $pages;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Pages doesn\'t exist.');
                redirect('sysadmin/pages', 'refresh');
            }
            $this->load->view('sysadmin/pages/edit',$this->data);
        }
        else
        {
			$name=$this->input->post('pages_title');
            $column['pages_title'] = $name;
            $column['pages_desc'] = $this->input->post('pages_desc');
 			$column['url_slug']=get_valid_name($name);
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->pages_model->updatedata($column,array('pages_id'=>$pages_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/pages','refresh');
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
		$conditions['page_id']=$id;
		$this->pages_model->updatedata($columns,$conditions);
		//$msg = "Expense name Status Successfully Updated.";
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
		$column['pages_id']=$this->input->post('id');
	    $deleted = $this->pages_model->deletedata($column);
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
		 $cond="AND name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->pages_model->selectdata("*",array()," ".$cond." ORDER BY pages_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->pages_id;
			 $col['pages_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}