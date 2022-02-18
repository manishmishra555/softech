<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tests extends Public_Controller {
   function __construct(){
        parent::__construct();
  		$this->load->model('testcatalogue_model');
       }

   public function index()
   {
	    $this->data['page_title'] = 'Tests - Nobel Health Care';
		$this->data['extracss']='';
		$this->data['extrajs']='';

		$test_url=$this->uri->segment(2); 
		if(!empty($package_url)){
			$this->data['tests'] = $this->testcatalogue_model->selectdata("*",array('url_slug'=>$test_url,'status'=>'active'),'ORDER BY test_id ASC');
			$this->data['related_test'] = $this->testcatalogue_model->selectdata("*",array('status'=>'active'),'ORDER BY rand()');
			$this->render('public/packages/packages_detail');
		}else{
			$this->data['total_record'] = $this->testcatalogue_model->selectdata("*",array('status'=>'active'),'ORDER BY test_id ASC');
		    $this->load->library('pagination');
		    $config['base_url'] = MAINSITE_URL.'tests/page/';
			$config['total_rows'] = count($this->data['total_record']);
			$config['per_page'] = FRONT_RECORD_PER_PAGE;
			$config["uri_segment"] = FRONT_PAGINATION_URI_SEGMENT;
	 		$config['attributes'] = array('class' => 'page-numbers');
	 		//$config['use_page_numbers']=true;
			$config['full_tag_open'] = '<nav class="pagination"><div class="nav-links clearfix">';
	        $config['full_tag_close'] = '</div></nav>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '';
	        $config['first_tag_close'] = '';
	        $config['prev_link'] = '';
	        $config['prev_tag_open'] = '<span class="page-numbers prev">';
	        $config['prev_tag_close'] = '</span>';
	        $config['next_link'] = '';
	        $config['next_tag_open'] = '<span class="page-numbers next">';
	        $config['next_tag_close'] = '</span>';
	        $config['last_tag_open'] = '';
	        $config['last_tag_close'] = '';
	        $config['cur_tag_open'] = '<span class="page-numbers current">';
	        $config['cur_tag_close'] = '</span>';
	        $config['num_tag_open'] = '';
	        $config['num_tag_close'] = '';
			$this->pagination->initialize($config);
			$page = ($this->uri->segment(FRONT_PAGINATION_URI_SEGMENT)) ? $this->uri->segment(FRONT_PAGINATION_URI_SEGMENT) : 0;
			$this->data['total_pages']  = $page;			
   		    $this->data['tests'] = $this->testcatalogue_model->selectdata("*",array('status'=>'active'),'ORDER BY test_id ASC',$page,$config["per_page"]);
   		    $this->data['pageing_link'] = $this->pagination->create_links();
		    $this->render('public/tests/tests_list');
		}
	}

   public function page(){
      $this->index();
   }

   function getTestDetails(){
   	 $response=array();
	 $response['data']=array();
	 $response['token']=$this->security->get_csrf_token_name();
	 $response['hash']=$this->security->get_csrf_hash();
	 $test_id=isset($_POST['id'])?$this->input->post('id'):'';
	 if(!empty($test_id)){
	 	$test = $this->testcatalogue_model->selectdata("*",array('test_id'=>$test_id,'status'=>'active'),'ORDER BY test_id ASC');
	 	if(count($test)>0){
	 		$response['data']=$test;
	 	}
	 	$response['status']="success";
	 }else{
		$response['status']="haserror";
		$response['msg']="Something went wrong :(";			
	 }
	 echo json_encode($response,JSON_PRETTY_PRINT);
   }
   
	 
}

