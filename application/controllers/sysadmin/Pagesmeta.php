<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagesmeta extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('pagesmeta_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Page Meta';
 		
   		$this->data['total_record'] = $this->pagesmeta_model->selectdata("*",array(),"ORDER BY page_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'pagesmeta/page/';
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
		$this->data['pagesmeta'] = $this->pagesmeta_model->selectdata("*",array(),'ORDER BY page_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/pagesmeta/list');
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
        $this->form_validation->set_rules('pagesmeta_title','Page Meta title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Page Meta description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$name=$this->input->post('page_name');
			$column['page_name']=$name;
            $column['pagesmeta_title'] = $this->input->post('pagesmeta_title');
            $column['pagesmeta_desc'] = $this->input->post('pagesmeta_desc');
            $column['h1_text']=$this->input->post('h1_text');
 			$column['url_slug']=get_valid_name($name);
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->pagesmeta_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Page Meta created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($page_id = NULL)
    {
		$page_id = $this->input->post('page_id') ? $this->input->post('page_id') : $page_id;
        $this->data['page_title'] = 'Page Meta';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('pagesmeta_title','Page Meta title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$pagesmeta =$this->pagesmeta_model->selectdata("*",array('page_id'=>$page_id),"ORDER BY page_id DESC");
            if(count($pagesmeta)>0)
            {
                $this->data['pagesmeta'] = $pagesmeta;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Page Meta doesn\'t exist.');
                redirect('sysadmin/pagesmeta', 'refresh');
            }
            $this->render('sysadmin/pagesmeta/edit');
        }
        else
        {
			/*$name=$this->input->post('page_name');
			$column['page_name']=$name;*/
            $column['pagesmeta_title'] = $this->input->post('pagesmeta_title');
            $column['pagesmeta_desc'] = $this->input->post('pagesmeta_desc');
            $column['h1_text']=$this->input->post('h1_text');
 			//$column['url_slug']=get_valid_name($name);
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->pagesmeta_model->updatedata($column,array('page_id'=>$page_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/pagesmeta','refresh');
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
		$this->pagesmeta_model->updatedata($columns,$conditions);
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
		$column['page_id']=$this->input->post('id');
	    $deleted = $this->pagesmeta_model->deletedata($column);
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
		$list=$this->pagesmeta_model->selectdata("*",array()," ".$cond." ORDER BY page_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->page_id;
			 $col['pagesmeta_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}