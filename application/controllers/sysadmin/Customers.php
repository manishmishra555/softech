<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('customers_model');
 		$this->load->model('users_model');
     }

    public function index()
    {
		$this->load->library('pagination');
		//Gallery
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

 		$this->data['page_title'] = 'customers';
   		$this->data['total_record'] = $this->customers_model->selectdata("*",array(),"ORDER BY id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'customers/page/';
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
		$this->data['customers'] = $this->customers_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        //$this->render('sysadmin/customers/list');
        $this->load->view('sysadmin/customers/list',$this->data);

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
        $this->form_validation->set_rules('customers_title','customers Title','trim|required');
        //$this->form_validation->set_rules('consultant_description','customers description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
            $column['customers_title'] = $this->input->post('customers_title');
            $column['customers_desc'] = $this->input->post('customers_desc');
            $column['designation'] = $this->input->post('designation');
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
            $column['url_slug']=isset($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($name);
 			$column['h1_tag'] =isset($_POST['h1_tag'])?$this->input->post('h1_tag'):NULL;
 			$column['meta_title'] =isset($_POST['meta_title'])?$this->input->post('meta_title'):NULL;
 			$column['meta_desc'] =isset($_POST['meta_desc'])?$this->input->post('meta_desc'):NULL;
 			$column['additional_tag'] =isset($_POST['additional_tag'])?$this->input->post('additional_tag'):NULL;
 			$column['sort_order'] =isset($_POST['sort_order'])?$this->input->post('sort_order'):NULL; 
 			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->customers_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="customers created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($customers_id = NULL)
    {
		$customers_id = $this->input->post('customers_id') ? $this->input->post('customers_id') : $customers_id;
		
		$this->load->model('media_model'); 
		$this->load->library('gallery');
		$attr = array('class'=>'btn btn-primary btn-block btn-large');
        $this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);

        $this->data['page_title'] = 'customers';
 		$this->data['extracss']='';
		$this->data['extrajs']=''; 

        $this->form_validation->set_rules('customers_title','customers title','trim|required');
        
        if($this->form_validation->run() === FALSE) 
        {
			$customers =$this->customers_model->selectdata("*",array('id'=>$customers_id),"ORDER BY id DESC");
			$address =$this->users_model->selectaddressbyid("*",array('uid'=>$customers_id),"ORDER BY id DESC");
            if(count($customers)>0)
            {
                $this->data['customers'] = $customers;
                $this->data['address'] = $address;
             }
            else
            {
                $this->session->set_flashdata('message', 'The customers doesn\'t exist.');
                redirect('sysadmin/customers', 'refresh');
            }
            //$this->render('sysadmin/customers/edit');
      	  $this->load->view('sysadmin/customers/edit',$this->data);

        }
        else
        {
            $column['name'] = $this->input->post('customers_title');
            $column['email'] = $this->input->post('email');
            $column['mobile'] = $this->input->post('mobile');
			$column['status']=$this->input->post('status');
			$column['company_name']=$this->input->post('company_name');
			$column['gst_no']=$this->input->post('gst_no');
			$column['pan_no']=$this->input->post('pan_no');
 			$column['date_modified']=date('Y-m-d H:i:s');	


 			$column1['uid'] = $this->input->post('adr_cust_id');
 			$column1['adr_name'] = $this->input->post('adr_name');
            $column1['mobile'] = $this->input->post('mobile');
            $column1['addressline1'] = $this->input->post('addressline1');
            $column1['addressline2'] = $this->input->post('addressline2');
            $column1['city'] = $this->input->post('city');
            $column1['state'] = $this->input->post('state');
            $column1['zipcode'] = $this->input->post('zipcode');

            $column1['adr_name_res'] = $this->input->post('adr_name_res');
            $column1['mobile_res'] = $this->input->post('mobile_res');
            $column1['addressline1_res'] = $this->input->post('addressline1_res');
            $column1['addressline2_res'] = $this->input->post('addressline2_res');
            $column1['city_res'] = $this->input->post('city_res');
            $column1['state_res'] = $this->input->post('state_res');
            $column1['zipcode_res'] = $this->input->post('zipcode_res');



           
            $this->customers_model->updatedata($column,array('id'=>$customers_id));
            $this->customers_model->updatecustAddr($column1,array('uid'=>$customers_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/customers','refresh');
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
		$this->customers_model->updatedata($columns,$conditions);
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
		$column['id']=$this->input->post('id');
	    $deleted = $this->customers_model->deletedata($column);
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
		$list=$this->customers_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['customers_id']=$l->id;
			 $col['name']=$l->name;
			 $col['status']=$l->status;	
			 $col['email']=$l->email;		
			 $col['mobile']=$l->mobile;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}