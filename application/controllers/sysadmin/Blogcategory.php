<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogcategory extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('blogcategory_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Blogcategory';
 		
   		$this->data['total_record'] = $this->blogcategory_model->selectdata("*",array(),"ORDER BY bcat_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'blogcategory/page/';
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
		$this->data['blogcategory'] = $this->blogcategory_model->selectdata("*",array(),'ORDER BY bcat_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/blogcategory/list_blogcategory_view');
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
        $this->form_validation->set_rules('bcat_name','Blog category name','trim|required');
        //$this->form_validation->set_rules('consultant_description','Blogcategory description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$bcat_name=$this->input->post('bcat_name');
            $column['bcat_name'] = $bcat_name;
 			$column['url_slug']=get_valid_name($bcat_name);
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->blogcategory_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Blogcategory created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($blogcategory_id = NULL)
    {
		$blogcategory_id = $this->input->post('blogcategory_id') ? $this->input->post('blogcategory_id') : $blogcategory_id;
        $this->data['page_title'] = 'Blogcategory';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('bcat_name','Blogcategory bcat_name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$blogcategory =$this->blogcategory_model->selectdata("*",array('bcat_id'=>$blogcategory_id), "ORDER BY bcat_id DESC");
            if(count($blogcategory)>0)
            {
                $this->data['blogcategory'] = $blogcategory;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Blogcategory doesn\'t exist.');
                redirect('sysadmin/blogcategory', 'refresh');
            }
            $this->render('sysadmin/blogcategory/edit_blogcategory_view');
        }
        else
        {
			$bcat_name=$this->input->post('bcat_name');
            $column['bcat_name'] = $bcat_name;
 			$column['url_slug']=get_valid_name($bcat_name);
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->blogcategory_model->updatedata($column,array('bcat_id'=>$blogcategory_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/blogcategory','refresh');
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
		$conditions['bcat_id']=$id;
		$this->blogcategory_model->updatedata($columns,$conditions);
		//$msg = "Expense bcat_name Status Successfully Updated.";
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
	    
	    $column['bcat_id']=$this->input->post('id');
	    $deleted = $this->blogcategory_model->deletedata($column);
	    
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
		 $cond="AND bcat_name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->blogcategory_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['bcat_id']=$l->id;
			 $col['bcat_name']=$l->bcat_name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}