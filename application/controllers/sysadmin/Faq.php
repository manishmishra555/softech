<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('faq_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Faq';
 		
   		$this->data['total_record'] = $this->faq_model->selectdata("*",array(),"ORDER BY faq_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'faq/page/';
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
		$this->data['faq'] = $this->faq_model->selectdata("*",array(),'ORDER BY faq_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->load->view('sysadmin/faq/list',$this->data);
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
        $this->form_validation->set_rules('faq_title','Faq title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Faq description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$name=$this->input->post('faq_title');
            $column['faq_title'] = $name;
            $column['faq_desc'] = $this->input->post('faq_desc');
 			$column['url_slug']=get_valid_name($name);
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->faq_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Faq created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($faq_id = NULL)
    {
		$faq_id = $this->input->post('faq_id') ? $this->input->post('faq_id') : $faq_id;
        $this->data['page_title'] = 'Faq';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('faq_title','Faq title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$faq =$this->faq_model->selectdata("*",array('faq_id'=>$faq_id),"ORDER BY faq_id DESC");
            if(count($faq)>0)
            {
                $this->data['faq'] = $faq;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Faq doesn\'t exist.');
                redirect('sysadmin/faq', 'refresh');
            }
            $this->load->view('sysadmin/faq/edit',$this->data);
        }
        else
        {
			$name=$this->input->post('faq_title');
            $column['faq_title'] = $name;
            $column['faq_desc'] = $this->input->post('faq_desc');
 			$column['url_slug']=get_valid_name($name);
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->faq_model->updatedata($column,array('faq_id'=>$faq_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/faq','refresh');
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
		$this->faq_model->updatedata($columns,$conditions);
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
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		
	    $column=array();
		$column['faq_id']=$this->input->post('id');
	    $deleted = $this->faq_model->deletedata($column);
		if($deleted){
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		echo json_encode($response);
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
		$list=$this->faq_model->selectdata("*",array()," ".$cond." ORDER BY faq_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->faq_id;
			 $col['faq_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}