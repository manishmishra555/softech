<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producttype extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('producttype_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Product Type';
 		
   		$this->data['total_record'] = $this->producttype_model->selectdata("*",array(),"ORDER BY type_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'producttype/page/';
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
		$this->data['producttype'] = $this->producttype_model->selectdata("*",array(),'ORDER BY type_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/producttype/list_producttype_view');
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
        $this->form_validation->set_rules('producttype_name','Product Type name','trim|required');
        //$this->form_validation->set_rules('consultant_description','Product Type description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {
			$name=$this->input->post('producttype_name');
            $column['producttype_name'] = $name;
 			$column['url_slug']=get_valid_name($name);
			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');			
			$this->producttype_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Product Type created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($producttype_id = NULL)
    {
		$producttype_id = $this->input->post('producttype_id') ? $this->input->post('producttype_id') : $producttype_id;
        $this->data['page_title'] = 'Product Type';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('producttype_name','Product Type name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$producttype =$this->producttype_model->selectdata("*",array('type_id'=>$producttype_id),"ORDER BY type_id DESC");
            if(count($producttype)>0)
            {
                $this->data['producttype'] = $producttype;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Product Type doesn\'t exist.');
                redirect('sysadmin/producttype', 'refresh');
			}
			//pr(validation_errors());die;
			$this->render('sysadmin/producttype/edit_producttype_view');
			
        }
        else
        {
			$name=$this->input->post('producttype_name');
            $column['producttype_name'] = $name;
 			$column['url_slug']=!empty($_POST['url_slug'])?$this->input->post('url_slug'):get_valid_name($name);
			$column['status']=$this->input->post('status');
			 $column['date_modified']=date('Y-m-d H:i:s');		
			 
			 
           
            $this->producttype_model->updatedata($column,array('type_id'=>$producttype_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/producttype','refresh');
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
		$conditions['type_id']=$id;
		$this->producttype_model->updatedata($columns,$conditions);
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
		$column['type_id']=$this->input->post('id');
	    $deleted = $this->producttype_model->deletedata($column);
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
		$list=$this->producttype_model->selectdata("*",array()," ".$cond." ORDER BY type_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['producttype_name']=$l->producttype_name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}