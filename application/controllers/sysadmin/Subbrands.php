<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subbrands extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('sub_brand_model');
 		$this->load->model('brand_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Sub Brands';
		//Gallery
		$this->load->library('gallery');
		$attr = array('class' => 'btn btn-primary btn-block btn-large');
		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics', $attr);
		
   		$this->data['total_record'] = $this->sub_brand_model->selectdata("COUNT(*) as totalrecords",array(),"ORDER BY id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'subbrands/page/';
		$config['total_rows'] = $this->data['total_record'][0]->totalrecords;
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
		$this->data['sub_brand'] = $this->sub_brand_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['brand'] = $this->brand_model->selectdata("*", array('status' => 'active'), " ORDER BY id DESC");
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
        $this->render('sysadmin/subbrands/list_subbrands_view');
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
        $this->form_validation->set_rules('sub_brand_name','Brand Category name','trim|required');
        //$this->form_validation->set_rules('consultant_description','Category description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
        	$brand_s = $this->input->post('brand');
			$sub_brand_name=$this->input->post('sub_brand_name');
			$column['brand_name'] = $this->input->post('brand');
			$column['sub_brand_name'] = ucfirst($sub_brand_name);
             $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
			$brand_slug = $this->brand_model->selectdata("url_slug", array('status' => 'active','id' => $brand_s), 'ORDER BY id DESC');

			
  			$column['url_slug']=$brand_slug[0]->url_slug.'/'.get_valid_name($sub_brand_name);
  			$column['meta_title'] = !empty($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] = !empty($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			
 
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->sub_brand_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Brand Category created successfully.";		
         }
		//echo json_encode($response); 
            redirect('sysadmin/subbrands','refresh');
    }

    public function edit($brand_id = NULL)
    {
		$subbrand_id = $this->input->post('subbrand_id') ? $this->input->post('subbrand_id') : $brand_id;
        $this->data['page_title'] = 'Sub Brands';
		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
		//Gallery
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class' => 'btn btn-primary btn-block btn-large');
		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics', $attr);

        $this->form_validation->set_rules('sub_brand_name','Brand Category Name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$subbrand =$this->sub_brand_model->selectdata("*",array('id'=>$brand_id),"ORDER BY id DESC");
			
            if(count($subbrand)>0)
            {
                $this->data['subbrand'] = $subbrand;
                $this->data['brands'] = $this->brand_model->selectdata("*", array('status' => 'active'), " ORDER BY id DESC");
             }
            else
            {
                $this->session->set_flashdata('message', 'The Brand Category doesn\'t exist.');
                redirect('sysadmin/subbrands', 'refresh');
            }
            $this->render('sysadmin/subbrands/edit_sub_brands_view');
        }
        else
        {
			$brand_s = $this->input->post('brand');
			$sub_brand_name=$this->input->post('sub_brand_name');

			$column['brand_name'] = ucfirst($this->input->post('brand'));
			$column['sub_brand_name'] = ucfirst($sub_brand_name);
			
			$column['image_fids'] = trim(json_encode($this->input->post('post_pics')));

			$brand_slug = $this->brand_model->selectdata("url_slug", array('status' => 'active','id' => $brand_s), 'ORDER BY id DESC');

			
  			$column['url_slug']=$brand_slug[0]->url_slug.'/'.get_valid_name($sub_brand_name);

        	$brand_s = $this->input->post('brand');

			$column['meta_title'] = !empty($_POST['meta_title']) ? $this->input->post('meta_title') : NULL;
			$column['meta_desc'] = !empty($_POST['meta_desc']) ? $this->input->post('meta_desc') : NULL;
			

			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');		

            $this->sub_brand_model->updatedata($column,array('id'=>$brand_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/subbrands','refresh');
        }
    }

    public function delete()
	{  
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		 
	    $column=array();
		$column['id']=$this->input->post('id');
	    $deleted = $this->sub_brand_model->deletedata($column);
		if($deleted){
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		echo json_encode($response); 
		//redirect($this->input->get('url'));
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
		$this->sub_brand_model->updatedata($columns,$conditions);
		//$msg = "Expense brand_name Status Successfully Updated.";
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


	public function search(){
		$response=array();
		$response['data']=array();
        $brand_id=$this->input->post('searchkey');
		
		$list=$this->sub_brand_model->selectdata("*",array('brand_name'=>$brand_id)," ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['sub_brand_name']=$l->sub_brand_name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
	}

	
}