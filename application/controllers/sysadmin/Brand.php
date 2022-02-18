<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('brand_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Brand';
		//Gallery
		$this->load->library('gallery');
		$attr = array('class' => 'btn btn-primary btn-block btn-large');
		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics', $attr);

		$this->data['parent_brand'] = $this->brand_model->selectdata("*", array('status'=>'active'), 'ORDER BY id DESC');
		
   		$this->data['total_record'] = $this->brand_model->selectdata("COUNT(*) as totalrecords",array(),"ORDER BY id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'brand/page/';
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
		$this->data['brand'] = $this->brand_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
        $this->render('sysadmin/brands/list_brands_view');
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
        $this->form_validation->set_rules('brand_name','Brand name','trim|required');
        //$this->form_validation->set_rules('consultant_description','Category description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$brand_name=$this->input->post('brand_name');
			$column['brand_name'] = ucfirst($brand_name);
			$column['featured'] = isset($_POST['featured']) ? $this->input->post('featured') : 0;
             $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));

			
  			$column['url_slug']=get_valid_name($brand_name);
 			
 
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->brand_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Brand created successfully.";		
         }
		//echo json_encode($response); 
            redirect('sysadmin/brand','refresh');
    }

    public function edit($brand_id = NULL)
    {
		$brand_id = $this->input->post('brand_id') ? $this->input->post('brand_id') : $brand_id;
        $this->data['page_title'] = 'Brand';
		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
		//Gallery
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class' => 'btn btn-primary btn-block btn-large');
		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics', $attr);

        $this->form_validation->set_rules('brand_name','Brand brand_name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$brand =$this->brand_model->selectdata("*",array('id'=>$brand_id),"ORDER BY id DESC");
			
            if(count($brand)>0)
            {
                $this->data['brand'] = $brand;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Brand doesn\'t exist.');
                redirect('sysadmin/brand', 'refresh');
            }
            $this->render('sysadmin/brands/edit_brands_view');
        }
        else
        {
			$brand_name = $this->input->post('brand_name');
			$column['brand_name'] = ucfirst($brand_name);
			
			$column['featured'] = isset($_POST['featured']) ? $this->input->post('featured') : 0;

			$column['image_fids'] = trim(json_encode($this->input->post('post_pics')));

			$column['url_slug'] = get_valid_name($brand_name);
			

			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');		

            $this->brand_model->updatedata($column,array('id'=>$brand_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/brand','refresh');
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
		$this->brand_model->updatedata($columns,$conditions);
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

    public function delete()
	{  
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		 
	    $column=array();
		$column['id']=$this->input->post('id');
	    $deleted = $this->brand_model->deletedata($column);
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
		 $cond="AND brand_name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->brand_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['brand_name']=$l->brand_name;
			 $col['status']=$l->status;		 	
			 $f_status = '';
            if ($l->featured == 1) {
                $f_status = 'yes';
            }else{
            	$f_status = 'no';
          	}
			$col['featured']=$f_status;	
			
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}