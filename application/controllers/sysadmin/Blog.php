<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('blog_model');
 		$this->load->model('author_model');
 		$this->load->model('blogcategory_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Blog';
 		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
 		$this->data['blog_category'] = $this->blogcategory_model->selectdata("*",array(),"ORDER BY bcat_id DESC");
 		$this->data['author'] = $this->author_model->selectdata("*",array(),"ORDER BY author_id DESC");

   		$this->data['total_record'] = $this->blog_model->selectdata("*",array(),"ORDER BY blog_id DESC");
 		$config['base_url'] = MAINSITE_MADMIN_URL.'blog/page/';
		$config['total_rows'] = count($this->data['total_record']);
		$config['per_page'] = RECORD_PER_PAGE;
		$config["uri_segment"] = PAGINATION_URI_SEGMENT;
 		$config['attributes'] = array('class' => 'page-link');
 		//$config['use_page_numbers']=true;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = false;
        $config['last_link'] =  false;
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
		$this->data['total_blog']  = $page;
		$this->data['blog'] = $this->blog_model->selectdata("*",array(),'ORDER BY blog_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';
        $this->load->view('sysadmin/blog/list',$this->data);
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
        $this->form_validation->set_rules('blog_title','Blog title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Blog description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$blog_title=$this->input->post('blog_title');
            $column['blog_title'] = $blog_title;
            $column['blog_brief'] = $this->input->post('blog_brief');
            $column['blog_post'] = $this->input->post('blog_post');
            $column['blog_category'] = $this->input->post('blog_category');
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
            $column['related_article']=!empty($_POST['related_article'])?implode(',',$this->input->post('related_article')):'';
 			$column['url_slug']=$_POST['url_slug'];
 			$column['author'] = 'Galorebay';
            $column['h1_tag'] = $this->input->post('h1_tag'); 			
 			$column['meta_title'] = $this->input->post('meta_title');
 			$column['meta_description'] = $this->input->post('meta_description');
 			$column['image_title'] = $this->input->post('image_title');
 			$column['image_alt'] = $this->input->post('image_alt');
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->blog_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Page created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($blog_id = NULL)
    {
		$blog_id = $this->input->post('blog_id') ? $this->input->post('blog_id') : $blog_id;
		//Gallery
		$this->load->model('media_model');
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
 		$this->data['blog_category'] = $this->blogcategory_model->selectdata("*",array(),"ORDER BY bcat_id DESC");
 		$this->data['author'] = $this->author_model->selectdata("*",array(),"ORDER BY author_id DESC");
 		
        $this->data['page_title'] = 'Blog';
 		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';

        $this->form_validation->set_rules('blog_title','Blog title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$blog =$this->blog_model->selectdata("*",array('blog_id'=>$blog_id),"ORDER BY blog_id DESC");
            if(count($blog)>0)
            {	
            	$this->data['blogs'] = $this->blog_model->selectdata("*",array(),"ORDER BY blog_id DESC");
                $this->data['blog'] = $blog;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Blog doesn\'t exist.');
                redirect('sysadmin/blog', 'refresh');
            }
            $this->load->view('sysadmin/blog/edit',$this->data);
        }
        else
        {
			$blog_title=$this->input->post('blog_title');
            $column['blog_title'] = $blog_title;
            $column['blog_brief'] = $this->input->post('blog_brief');
            $column['blog_post'] = $this->input->post('blog_post');
            $column['blog_category'] = $this->input->post('blog_category');
            $column['author'] = 'Galorebay';
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
            $column['related_article']=!empty($_POST['related_article'])?implode(',',$this->input->post('related_article')):'';
 			$column['url_slug']=$this->input->post('url_slug');
 			$column['meta_title'] = $this->input->post('meta_title');
 			$column['meta_description'] = $this->input->post('meta_description');
            $column['h1_tag'] = $this->input->post('h1_tag'); 			 			
 			$column['image_title'] = $this->input->post('image_title');
 			$column['image_alt'] = $this->input->post('image_alt');
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
            
            //pr($column); die;
            
            $this->blog_model->updatedata($column,array('blog_id'=>$blog_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/blog','refresh');
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
		$conditions['blog_id']=$id;
		$this->blog_model->updatedata($columns,$conditions);
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
		$column['blog_id']=$this->input->post('id');
	    $deleted = $this->blog_model->deletedata($column);
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
		$list=$this->blog_model->selectdata("*",array()," ".$cond." ORDER BY blog_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->blog_id;
			 $col['blog_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}