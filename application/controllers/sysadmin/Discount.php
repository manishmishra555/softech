<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Discount extends Admin_Controller

{



    function __construct()

    {
		parent::__construct();
		$this->load->model('discount_model');		
 		$this->load->model('product_model');
		$this->load->model('category_model');
     }



    public function index()

    {

		$this->load->library('pagination');
		$this->data['page_title'] = 'Discount';
		$total_record = $this->discount_model->selectdata("COUNT(*) as total_record",array(),"ORDER BY did DESC");
		$this->data['total_record'] =$total_record[0]->total_record;
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'discount/page/';
		$config['total_rows'] = $total_record[0]->total_record;
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

		$this->data['total_discount']  = $page;

		$this->data['discount'] = $this->discount_model->selectdata("*",array(),'ORDER BY did DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';

		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';

        $this->load->view('sysadmin/discount/list',$this->data);

	}

	

	public function page()

   {

      $this->index();

   }



	public function create()

	{

		$this->data['page_title'] = 'Add Discount';
		$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY category_name ASC');
		$this->data['products'] = $this->product_model->selectdata("*", array('status' => 'active'), 'ORDER BY product_name ASC');
		
		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';
		$this->load->view('sysadmin/discount/add', $this->data);

	}





    public function add()

    {

		$response = array();

		$response['token'] = $this->security->get_csrf_token_name();

		$response['hash'] = $this->security->get_csrf_hash();



         $this->form_validation->set_rules('discount_name','Discount Name','trim|required');

        //$this->form_validation->set_rules('consultant_description','Discount description','trim|required');

        if($this->form_validation->run()===FALSE)

        {

           	 $response['status']='haserror';

			 $response['error']=validation_errors();

        }

        else

        {

			$discount_name=$this->input->post('discount_name');
            $column['discount_name'] = $discount_name;            			  
			$column['discount_on'] = $this->input->post('discount_on');
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;
            $column['product_id'] = !empty($_POST['product_id'])?implode(',',$this->input->post('product_id')):NULL;			
			$column['discount_type'] = $this->input->post('discount_type');
			$column['discount_value'] = $this->input->post('discount_value');
			$column['discount_value_limit'] = $this->input->post('discount_value_limit');
 			 
  			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');
			$this->discount_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Discount added successfully.";		
         }

		echo json_encode($response); 

		exit;

    }



    public function edit($did = NULL){
		$did = $this->input->post('did') ? $this->input->post('did') : $did;

		//Gallery
		$this->load->model('media_model');
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
  	
        $this->data['page_title'] = 'Discount';
 		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';

        $this->form_validation->set_rules('discount_name','Discount Name','trim|required');
        if($this->form_validation->run() === FALSE)
        {
			$discount =$this->discount_model->selectdata("*",array('did'=>$did),"ORDER BY did DESC");
            if(count($discount)>0)
            {
				$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY cat_id DESC');
				$this->data['products'] = $this->product_model->selectdata("*", array('status' => 'active'), 'ORDER BY product_name ASC');
				
				$this->data['discount'] = $discount;
             }else{
                $this->session->set_flashdata('message', 'The Discount doesn\'t exist.');
                redirect('sysadmin/discount', 'refresh');
            }
            $this->load->view('sysadmin/discount/edit',$this->data);
        }
        else
        {
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;

 			$discount_name=$this->input->post('discount_name');
            $column['discount_name'] = $discount_name;            			  
			$column['discount_on'] = $this->input->post('discount_on');
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;
            $column['product_id'] = !empty($_POST['product_id'])?implode(',',$this->input->post('product_id')):NULL;			
			$column['discount_type'] = $this->input->post('discount_type');
			$column['discount_value'] = $this->input->post('discount_value');
			$column['discount_value_limit'] = $this->input->post('discount_value_limit');
			$column['date_modified'] = date('Y-m-d H:i:s');
            //pr($column); die;
            $this->discount_model->updatedata($column,array('did'=>$did));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/discount','refresh');
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

		$conditions['did']=$id;

		$this->discount_model->updatedata($columns,$conditions);

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

		$column['did']=$this->input->post('id');

	    $deleted = $this->discount_model->deletedata($column);

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

		 $cond= "AND discount_name LIKE '%".$searchkey."%'";

		}else{

		 $cond='';	

		}

		$list=$this->discount_model->selectdata("*",array()," ".$cond." ORDER BY did DESC");

		if(count($list)>0){

			foreach($list as $l){
			   
				$PImages = json_decode($l->image_fids);
   	   		    $col=array();
				$col['id']=$l->did;
				$col['pimage']= count($PImages) > 0?$this->media->getThumbPathById($PImages[0], '65x49'):'';
				$col['discount_name']=$l->discount_name;
				$col['status']=$l->status;		 	
			 array_push($response['data'],$col);

			}

		}
		echo json_encode($response);
		exit;

	}

	

}