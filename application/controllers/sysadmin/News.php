<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('news_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'News';
 		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

   		$this->data['total_record'] = $this->news_model->selectdata("*",array(),"ORDER BY nid DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'news/page/';
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
		$this->data['news'] = $this->news_model->selectdata("*",array(),'ORDER BY nid DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->load->view('sysadmin/news/list_view',$this->data);
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
        $this->form_validation->set_rules('n_title','News title','trim|required');
        //$this->form_validation->set_rules('consultant_description','News description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$n_title=$this->input->post('n_title');
            $column['n_title'] = $n_title;
            $column['n_desc'] =isset($_POST['n_desc'])?$this->input->post('n_desc'):NULL;
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));

  			$column['url_slug']=isset($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($n_title);
 			$column['h1_tag'] =isset($_POST['h1_tag'])?$this->input->post('h1_tag'):NULL;
 			$column['meta_title'] =isset($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] =isset($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			$column['additional_tag'] =isset($_POST['additional_tag'])?$this->input->post('additional_tag'):NULL;
  			$column['image_title'] =isset($_POST['image_title'])?$this->input->post('image_title'):NULL; 			
 			$column['image_alt'] =isset($_POST['image_alt'])?$this->input->post('image_alt'):NULL; 			 			 

			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->news_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="News created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($news_id = NULL)
    {
		$news_id = $this->input->post('news_id') ? $this->input->post('news_id') : $news_id;
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class'=>'btn btn-primary btn-block btn-large');
        $this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

        $this->data['page_title'] = 'News';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('n_title','News title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$news =$this->news_model->selectdata("*",array('nid'=>$news_id),"ORDER BY nid DESC");
            if(count($news)>0)
            {
                $this->data['news'] = $news;
             }
            else
            {
                $this->session->set_flashdata('message', 'The News doesn\'t exist.');
                redirect('sysadmin/news', 'refresh');
            }
            $this->load->view('sysadmin/news/edit_view',$this->data);
        }
        else
        {
   			$n_title=$this->input->post('n_title');
  			$column['n_title'] = $n_title;
            $column['n_desc'] =isset($_POST['n_desc'])?$this->input->post('n_desc'):NULL;
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));

  			$column['url_slug']=isset($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($n_title);
 			$column['h1_tag'] =isset($_POST['h1_tag'])?$this->input->post('h1_tag'):NULL;
 			$column['meta_title'] =isset($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] =isset($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			$column['additional_tag'] =isset($_POST['additional_tag'])?$this->input->post('additional_tag'):NULL;
 			$column['image_title'] =isset($_POST['image_title'])?$this->input->post('image_title'):NULL; 			
 			$column['image_alt'] =isset($_POST['image_alt'])?$this->input->post('image_alt'):NULL; 			 			 
            
            $this->news_model->updatedata($column,array('nid'=>$news_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/news','refresh');
        }
    }

public function status()
	{   
	    $response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
 	    $id=$this->input->post('nid');
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
		$conditions['nid']=$id;
		$this->news_model->updatedata($columns,$conditions);
		//$msg = "Expense n_title Status Successfully Updated.";
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
		$column['nid']=$this->input->post('nid');
	    $deleted = $this->news_model->deletedata($column);
		if($deleted){
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		echo json_encode($response); 
		//redirect($this->input->get('url'));
	}
	
	public function search(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $searchkey=$this->input->post('searchkey');
		if(!empty($searchkey)){
		 $cond="AND n_title LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->news_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['nid']=$l->id;
			 $col['n_title']=$l->n_title;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}