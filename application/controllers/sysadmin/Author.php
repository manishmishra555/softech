<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('author_model');
     }

    public function index()
    {
		$this->load->library('pagination');
		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

 		$this->data['page_title'] = 'Author';
   		$this->data['total_record'] = $this->author_model->selectdata("*",array(),"ORDER BY author_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'author/page/';
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
		$this->data['author'] = $this->author_model->selectdata("*",array(),'ORDER BY author_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/author/list');
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
        $this->form_validation->set_rules('author_title','Author Title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Author description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
            $column['author_title'] = $this->input->post('author_title');
            $column['author_desc'] = $this->input->post('author_desc');            
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
 			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->author_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Author created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($author_id = NULL)
    {
		$author_id = $this->input->post('author_id') ? $this->input->post('author_id') : $author_id;
		
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class'=>'btn btn-primary btn-block btn-large');
        $this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

        $this->data['page_title'] = 'Author';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('author_title','Author title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$author =$this->author_model->selectdata("*",array('author_id'=>$author_id),"ORDER BY author_id DESC");
            if(count($author)>0)
            {
                $this->data['author'] = $author;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Author doesn\'t exist.');
                redirect('sysadmin/author', 'refresh');
            }
            $this->render('sysadmin/author/edit');
        }
        else
        {
            $column['author_title'] = $this->input->post('author_title');
            $column['author_desc'] = $this->input->post('author_desc');
            
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->author_model->updatedata($column,array('author_id'=>$author_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/author','refresh');
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
		$conditions['author_id']=$id;
		$this->author_model->updatedata($columns,$conditions);
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
		$column['author_id']=$this->input->post('id');
	    $deleted = $this->author_model->deletedata($column);
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
		$list=$this->author_model->selectdata("*",array()," ".$cond." ORDER BY author_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['author_id']=$l->id;
			 $col['name']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}