<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->model('career_model');
		//$this->load->model( 'hospitals_model');  		 
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Career';
 		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
		//$this->data['hospitals'] = $this->hospitals_model->selectdata("*", array('status'=>'active'), 'ORDER BY hid DESC');
   		$this->data['total_record'] = $this->career_model->selectdata("COUNT(*) as totalrecords",array(),"ORDER BY cid DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'career/page/';
		$config['total_rows'] = $this->data['total_record'][0]->totalrecords;
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
		$this->data['total_page']  = $page;
		$this->data['career'] = $this->career_model->selectdata("*",array(),'ORDER BY cid DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';
        $this->render('sysadmin/careerenquiries/list_view');
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
        $this->form_validation->set_rules('career_title','career title','trim|required');
        //$this->form_validation->set_rules('consultant_description','career description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$career_title=$this->input->post( 'career_title');
			$column['career_title'] = $career_title;
			$column['hosp_id'] = !empty($_POST['hosp_id']) ? implode(',', $this->input->post('hosp_id')) : '';			
			$column[ 'designation'] = $this->input->post( 'designation');
			$column['qualification'] = $this->input->post('qualification');			
            $column[ 'department'] = $this->input->post( 'department');
			$column[ 'experience'] = $this->input->post( 'experience');
			$column[ 'total_opening'] = $this->input->post( 'total_opening');
 			$column[ 'job_decription'] = $this->input->post( 'job_decription');
			$column[ 'contact_details'] = $this->input->post( 'contact_details');
			$column['meta_title'] = isset($_POST['meta_title']) ? $this->input->post('meta_title') : NULL;
			$column['meta_desc'] = isset($_POST['meta_desc']) ? $this->input->post('meta_desc') : NULL;
			$column['additional_tag'] = isset($_POST['additional_tag']) ? $this->input->post('additional_tag') : NULL;
			$column['url_slug'] = isset($_POST['url_slug']) ? $this->input->post('url_slug') : get_valid_name($career_title);
			$column['sort_order'] = isset($_POST['sort_order']) ? $this->input->post('sort_order') : NULL;
  			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');
						
			$this->career_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Career created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function view($cid = NULL)
    {
		$cid = $this->input->post('cid') ? $this->input->post('cid') : $cid;
       		
        $this->data['page_title'] = 'career';
 		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';

        $this->form_validation->set_rules( 'career_title','career title','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$career =$this->career_model->selectdata("*",array('cid'=>$cid),"ORDER BY cid DESC");
            if(count($career)>0)
            {
				// $this->data['hospitals'] = $this->hospitals_model->selectdata("*", array('status' => 'active'), 'ORDER BY hid DESC');
                 $this->data['career'] = $career;
             }
            else
            {
                $this->session->set_flashdata('message', 'The career data doesn\'t exist.');
                redirect('sysadmin/careerenquiries', 'refresh');
            }
            $this->render('sysadmin/careerenquiries/view_career_page');
        }
        else
        {
 			$career_title = $this->input->post('career_title');
			$column['career_title'] = $career_title;
			$column['hosp_id'] = !empty($_POST['hosp_id']) ? implode(',', $this->input->post('hosp_id')) : '';
			$column['designation'] = $this->input->post('designation');
			$column['department'] = $this->input->post('department');
			$column['qualification'] = $this->input->post('qualification');
			$column['experience'] = $this->input->post('experience');
			$column['total_opening'] = $this->input->post('total_opening');
			$column['job_decription'] = $this->input->post('job_decription');
			$column['contact_details'] = $this->input->post('contact_details');
			$column['meta_title'] = isset($_POST['meta_title']) ? $this->input->post('meta_title') : NULL;
			$column['meta_desc'] = isset($_POST['meta_desc']) ? $this->input->post('meta_desc') : NULL;
			$column['additional_tag'] = isset($_POST['additional_tag']) ? $this->input->post('additional_tag') : NULL;
			$column['url_slug'] = isset($_POST['url_slug']) ? $this->input->post('url_slug') : get_valid_name($career_title);
			$column['sort_order'] = isset($_POST['sort_order']) ? $this->input->post('sort_order') : NULL;
			$column['status'] = $this->input->post('status');
 			$column['date_modified'] = date('Y-m-d H:i:s');
 
            //pr($column); die;
            
            $this->career_model->updatedata($column,array('cid'=>$cid));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/career','refresh');
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
		$conditions['cid']=$id;
		$this->career_model->updatedata($columns,$conditions);
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
		$column['cid']=$this->input->post('id');
	    $deleted = $this->career_model->deletedata($column);
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
		$list=$this->career_model->selectdata("*",array()," ".$cond." ORDER BY cid DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->cid;
			 $col['blog_title']=$l->name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	

	public function applicantslist($cid = NULL){
		$cid = $this->input->post('cid') ? $this->input->post('cid') : $cid;

		$career = $this->career_model->selectdata("*", array('cid' => $cid), "ORDER BY cid DESC");
		$career_title=$career[0]->career_title;
		$this->data['page_title'] = $career_title." - Applicants List";
		$this->data['extracss'] = '';
		$this->data['extrajs'] = '';
 
		$this->data['total_record'] = $this->career_model->applicants("COUNT(*) AS totalrecords", array('career_id' => $cid), " ORDER BY cid DESC");
		$this->load->library('pagination');
		$config['base_url'] = MAINSITE_MADMIN_URL . 'career/applicantslist/page/';
		$config['total_rows'] = $this->data['total_record'][0]->totalrecords;
		$config['per_page'] = RECORD_PER_PAGE;
		$config["uri_segment"] = SUBPAGE_PAGINATION_URI_SEGMENT;
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
		$page = ($this->uri->segment(SUBPAGE_PAGINATION_URI_SEGMENT)) ? $this->uri->segment(SUBPAGE_PAGINATION_URI_SEGMENT) : 0;
		$this->data['total_page']  = $page;
		$this->data['applicants'] = $this->career_model->applicants("*", array('career_id' => $cid), 'ORDER BY cid DESC', $page, $config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
 		$this->load->view('sysadmin/career/applicantslist', $this->data);
	}
	
	public function pages()
	{
		$this->applicantslist();
	}

// 	public function applicantdetails()
// 	{
// 		$response = array();
// 		$response['data']=array();
// 		$response['token'] = $this->security->get_csrf_token_name();
// 		$response['hash'] = $this->security->get_csrf_hash();
// 		$applicant_id=isset($_POST['applicant_id'])?$this->input->post('applicant_id'):'';
// 		 if ($applicant_id) {
// 			$ad = $this->career_model->applicants("*", array('cid' => $applicant_id), " ORDER BY cid DESC");
// 			$cv_file='';
// 			if (file_exists(CV_FILES_PATH . $ad[0]->file_name)) {
// 				$cv_file= CV_FILES_URL . $ad[0]->file_name;
// 			}
			
// 			$hosp = $this->hospitals_model->selectdata("hosp_name", array('hid' => $ad[0]->location), "ORDER BY hid DESC");
// 			$hospital_name = isset($hosp[0]->hosp_name) ? $hosp[0]->hosp_name : '';

// 			$col=array();
// 			$col['applicant_name']=$ad[0]->name;
// 			$col['email'] = $ad[0]->email;
// 			$col['phone'] = $ad[0]->phone;
// 			$col['file_path'] = $cv_file;			
// 			$col['hospital_name']= $hospital_name;
// 			$col['additional_information'] = $ad[0]->additional_information;
// 			$col['date_added'] = date('d-M-Y',strtotime($ad[0]->date_added));
			
// 			array_push($response['data'],$col);

// 			$response['status'] = "success";
// 		} else {
// 			$response['status'] = 'haserror';
// 			$response['error'] = "Invalid request.";
// 		}
// 		echo json_encode($response);
// 	}
}