<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productenquiries extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('product_model');
 		$this->load->model('category_model');
  
    }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Enquiries';
 		
   		$this->data['total_record'] = $this->product_model->selectenquiry("*",array(),"ORDER BY eid DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'productenquiries/page/';
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
		$this->data['productenquiries'] = $this->product_model->selectenquiry("*",array(),'ORDER BY eid DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/productenquiries/list_view');
	}
	
	public function page()
   {
      $this->index();
   }

    
    
	
	public function search(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $searchkey=$this->input->post('searchkey');
		if(!empty($searchkey)){
		 $cond="AND bcat_name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->product_model->selectenquiry("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['eid']=$l->id;
			 $col['bcat_name']=$l->bcat_name;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}


	function enqdetails(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $id=$this->input->post('id');
        if(!empty($id)){
        	$enquiry=$this->product_model->selectenquiry("*",array('eid'=>$id),"ORDER BY eid DESC");
			$pid=!empty($enquiry[0]->pid)? $enquiry[0]->pid:'';
			if(!empty($pid)){
			$product_detail = $this->product_model->selectdata("*", array('pid' => $pid, 'status' => 'active'), "ORDER BY pid DESC");
			$pname = $product_detail[0]->product_name;
			$cat_id =$product_detail[0]->cat_id;

			$category = $this->category_model->selectdata("*",array('cat_id'=> $cat_id), " ORDER BY cat_id DESC");
			$cat_name=$category[0]->category_name;

			$proname=$pname." - ". $cat_name;

			$purl = site_url('product') . "/" . $product_detail[0]->url_slug;
			}else{
				$proname='';
				$purl='';
			}

         	$col=array();
        	$col['name']=$enquiry[0]->name;
        	$col['phone']=$enquiry[0]->phone;
        	$col['email']=$enquiry[0]->email;
			$col['message'] = $enquiry[0]->message;
			$col['qty'] = $enquiry[0]->qty;
			$col['proname'] = $proname;
			$col['purl'] = $purl;
			

         	array_push($response['data'], $col);
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		echo json_encode($response);
	}

	
}