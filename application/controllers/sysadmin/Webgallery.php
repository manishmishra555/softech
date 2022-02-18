<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webgallery extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('gallery_model');
     }

    public function index()
    {
		$this->load->library('pagination');
		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
		//$this->data['post_pics2'] = $this->gallery->getMediaGallery2('post_pics2', $attr);

 		$this->data['page_title'] = 'Gallery';
   		$this->data['total_record'] = $this->gallery_model->selectdata("*",array(),"ORDER BY gallery_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'gallery/page/';
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
		$this->data['gallery'] = $this->gallery_model->selectdata("*",array(),'ORDER BY gallery_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/gallery/list');
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
        $this->form_validation->set_rules('gallery_title','Gallery Title','trim|required');
        //$this->form_validation->set_rules('consultant_description','Gallery description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
            $column['gallery_title'] = $this->input->post('gallery_title');
/*             $column['gallery_desc'] = $this->input->post('gallery_desc');
            $column['gallery_link'] = $this->input->post('gallery_link'); */
			$column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
			//$column['mobile_gallery'] = trim(json_encode($this->input->post('post_pics2')));
			
 			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->gallery_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Gallery created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($gallery_id = NULL)
    {
		$gallery_id = $this->input->post('gallery_id') ? $this->input->post('gallery_id') : $gallery_id;
		
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class'=>'btn btn-primary btn-block btn-large');
        $this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
		//$this->data['post_pics2'] = $this->gallery->getMediaGallery2('post_pics2', $attr);

        $this->data['page_title'] = 'Gallery';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('gallery_title','Gallery title','trim');

        if($this->form_validation->run() === FALSE)
        {
			$gallery =$this->gallery_model->selectdata("*",array('gallery_id'=>$gallery_id),"ORDER BY gallery_id DESC");
            if(count($gallery)>0)
            {
                $this->data['gallery'] = $gallery;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Gallery doesn\'t exist.');
                redirect('sysadmin/gallery', 'refresh');
            }
            $this->render('sysadmin/gallery/edit');
        }
        else
        {
            $column['gallery_title'] = $this->input->post('gallery_title');
            /* $column['gallery_desc'] = $this->input->post('gallery_desc');
            $column['gallery_link'] = $this->input->post('gallery_link'); */
			$column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
			//$column['mobile_gallery'] = trim(json_encode($this->input->post('post_pics2')));
			
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->gallery_model->updatedata($column,array('gallery_id'=>$gallery_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/gallery','refresh');
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
		$conditions['gallery_id']=$id;
		$this->gallery_model->updatedata($columns,$conditions);
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
		$column['gallery_id']=$this->input->post('id');
	    $deleted = $this->gallery_model->deletedata($column);
	    if($deleted){
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		//redirect($this->input->get('url'));
		echo json_encode($response); 
 	}
	
	public function search(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $searchkey=$this->input->post('searchkey');
		if(!empty($searchkey)){
		 $cond="AND gallery_title LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->gallery_model->selectdata("*",array()," ".$cond." ORDER BY gallery_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['gallery_id']=$l->id;
			 $col['gallery_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}