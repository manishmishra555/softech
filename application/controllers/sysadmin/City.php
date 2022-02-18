<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('city_model');
 		$this->load->model('country_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'City';
 		
   		$this->data['total_record'] = $this->city_model->selectdata("*",array(),"ORDER BY id DESC");
		$this->data['country'] = $this->country_model->selectdata("*",array('status'=>'active'),"ORDER BY id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'city/page/';
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
		$this->data['city'] = $this->city_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/city/list_city_view');
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
        $this->form_validation->set_rules('name','City name','trim|required');
        //$this->form_validation->set_rules('consultant_description','City description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$name=$this->input->post('name');
            $column['name'] = $name;
			$column['country_id'] =$this->input->post('country');
 			$column['url_slug']=isset($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($name);
 			$column['h1_tag'] =isset($_POST['h1_tag'])?$this->input->post('h1_tag'):NULL;
 			$column['meta_title'] =isset($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] =isset($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			$column['additional_tag'] =isset($_POST['additional_tag'])?$this->input->post('additional_tag'):NULL;
 			$column['sort_order'] =isset($_POST['sort_order'])?$this->input->post('sort_order'):NULL; 			 			 

			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->city_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="City created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function addsub(){  	 
	$data['form_error'] = ""; 
	$data['page_title']="Add Sublocation";
	$data['page_heading']="Add Sublocation";
    if(isSet($_POST) && !empty($_POST))
	{
		//pr($_POST); die;
	    $column['name'] = $this->security->xss_clean(trim($this->input->post('subcatName')));
        $column['image_fids'] = $this->security->xss_clean(trim(json_encode($this->input->post('post_pics'))));
		$column['url_name'] = $this->security->xss_clean(get_valid_name($this->input->post('subcatName')));
		$column['parent']=$this->security->xss_clean(trim($this->input->post('catid')));
		$column['status']='active';
		$column['createdat']=date('Y-m-d H:i:s');
		$data=$this->category_model->insertdata($column);
 	}
   redirect(MAINSITE_MADMIN_URL.'category');
}

    public function edit($city_id = NULL)
    {
		$city_id = $this->input->post('city_id') ? $this->input->post('city_id') : $city_id;
        $this->data['page_title'] = 'City';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('name','City name','trim|required');
		$this->form_validation->set_rules('country','Select Country','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$city =$this->city_model->selectdata("*",array('id'=>$city_id),"ORDER BY id DESC");
            if(count($city)>0)
            {
                $this->data['city'] = $city;
				$this->data['country'] = $this->country_model->selectdata("*",array('status'=>'active'),"ORDER BY id DESC");
             }
            else
            {
                $this->session->set_flashdata('message', 'The City doesn\'t exist.');
                redirect('sysadmin/city', 'refresh');
            }
            $this->render('sysadmin/city/edit_city_view');
        }
        else
        {
			$name=$this->input->post('name');
            $column['name'] = $name;
			$column['country_id'] =$this->input->post('country');
 			$column['url_slug']=isset($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($name);
 			$column['h1_tag'] =isset($_POST['h1_tag'])?$this->input->post('h1_tag'):NULL;
 			$column['meta_title'] =isset($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] =isset($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			$column['additional_tag'] =isset($_POST['additional_tag'])?$this->input->post('additional_tag'):NULL;
 			$column['sort_order'] =isset($_POST['sort_order'])?$this->input->post('sort_order'):NULL; 
			$column['status']=$this->input->post('status');
 			$column['date_modified']=date('Y-m-d H:i:s');			
           
            $this->city_model->updatedata($column,array('id'=>$city_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/city','refresh');
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
		$this->city_model->updatedata($columns,$conditions);
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
		$column['id']=$this->input->post('id');
	    $deleted = $this->city_model->deletedata($column);
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
		$list=$this->city_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['name']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
	public function cityByCountry(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
		$country_id=$this->input->post("country_id");
		if(!empty($country_id)){
		  $city =$this->city_model->selectdata("*",array('country_id'=>$country_id),"ORDER BY id DESC");
		  if(count($city)>0){
		    foreach($city as $c){
			   $col=array();
			   $col['id']=$c->id;
			   $col['name']=$c->name;
			   array_push($response['data'],$col);
			}
		  }
		  $response['status']="success";
		}else{
	      $response['status']='haserror';
		  $response['error']="Invalid request.";
 	    }
		echo json_encode($response,JSON_PRETTY_PRINT);
		exit;
	}
	
}