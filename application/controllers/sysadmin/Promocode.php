<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Promocode extends Admin_Controller

{



    function __construct()

    {
		parent::__construct();
		$this->load->model('promocode_model');		
 		$this->load->model('product_model');
		$this->load->model('category_model');
     }



    public function index()

    {

		$this->load->library('pagination');
		$this->data['page_title'] = 'Promocode';
		$total_record = $this->promocode_model->selectdata("COUNT(*) as total_record",array(),"ORDER BY id DESC");
		$this->data['total_record'] =$total_record[0]->total_record;
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'promocode/page/';
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

		$this->data['total_promocode']  = $page;

		$this->data['promocode'] = $this->promocode_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';

        $this->load->view('sysadmin/promocode/list',$this->data);

	}

	

	public function page()

   {

      $this->index();

   }



	public function create()

	{

		$this->data['page_title'] = 'Add Promocode';
		$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY category_name ASC');
		$this->data['products'] = $this->product_model->selectdata("*", array('status' => 'active'), 'ORDER BY product_name ASC');
		
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"></script><script>$(\'.date-picker\').datetimepicker({timepicker:true,format:\'d-m-Y H:i\'});</script>';
		$this->load->view('sysadmin/promocode/add', $this->data);

	}





    public function add()

    {

		$response = array();

		$response['token'] = $this->security->get_csrf_token_name();

		$response['hash'] = $this->security->get_csrf_hash();



         $this->form_validation->set_rules('promocode_name','Promocode Name','trim|required');

        //$this->form_validation->set_rules('consultant_description','Promocode description','trim|required');

        if($this->form_validation->run()===FALSE)

        {

           	 $response['status']='haserror';

			 $response['error']=validation_errors();

        }

        else

        {

			$promocode_name=$this->input->post('promocode_name');
            $column['promocode_name'] = $promocode_name;            			  
			$column['promocode_on'] = $this->input->post('promocode_on');
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;
            $column['product_id'] = !empty($_POST['product_id'])?implode(',',$this->input->post('product_id')):NULL;			
			$column['promocode_type'] = $this->input->post('promocode_type');
			$column['promocode_value'] = $this->input->post('promocode_value');
			$column['promocode_value_limit'] = $this->input->post('promocode_value_limit');
			//$column['usage_limit'] = $this->input->post('usage_limit');
			//$column['usage_limit_per_user'] = $this->input->post('usage_limit_per_user');
			$column['start_date']=date('Y-m-d H:i:s',strtotime($this->input->post('start_date')));
			$column['expiry_date']=date('Y-m-d H:i:s',strtotime($this->input->post('expiry_date')));
  			 
  			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');
			$this->promocode_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Promocode added successfully.";		
         }

		echo json_encode($response); 

		exit;

    }



    public function edit($id = NULL){
		$id = $this->input->post('id') ? $this->input->post('id') : $id;
 		  
        $this->data['page_title'] = 'Promocode';
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"></script><script>$(\'.date-picker\').datetimepicker({timepicker:true,format:\'d-m-Y H:i\'});</script>';

        $this->form_validation->set_rules('promocode_name','Promocode Name','trim|required');
        if($this->form_validation->run() === FALSE)
        {
			$promocode =$this->promocode_model->selectdata("*",array('id'=>$id),"ORDER BY id DESC");
            if(count($promocode)>0)
            {
				$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY cat_id DESC');
				$this->data['products'] = $this->product_model->selectdata("*", array('status' => 'active'), 'ORDER BY product_name ASC');
				
				$this->data['promocode'] = $promocode;
             }else{
                $this->session->set_flashdata('message', 'The Promocode doesn\'t exist.');
                redirect('sysadmin/promocode', 'refresh');
            }
            $this->load->view('sysadmin/promocode/edit',$this->data);
        }
        else
        {
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;

 			$promocode_name=$this->input->post('promocode_name');
            $column['promocode_name'] = $promocode_name;            			  
			$column['promocode_on'] = $this->input->post('promocode_on');
			$column['category_id'] = !empty($_POST['category_id'])?implode(',',$this->input->post('category_id')):NULL;
            $column['product_id'] = !empty($_POST['product_id'])?implode(',',$this->input->post('product_id')):NULL;			
			$column['promocode_type'] = $this->input->post('promocode_type');
			$column['promocode_value'] = $this->input->post('promocode_value');
			$column['promocode_value_limit'] = $this->input->post('promocode_value_limit');
			//$column['usage_limit'] = $this->input->post('usage_limit');
			//$column['usage_limit_per_user'] = $this->input->post('usage_limit_per_user');
			$column['start_date']=date('Y-m-d H:i:s',strtotime($this->input->post('start_date')));
			$column['expiry_date']=date('Y-m-d H:i:s',strtotime($this->input->post('expiry_date')));

			$column['date_modified'] = date('Y-m-d H:i:s');
            //pr($column); die;
            $this->promocode_model->updatedata($column,array('id'=>$id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/promocode','refresh');
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

		$this->promocode_model->updatedata($columns,$conditions);

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

	    $deleted = $this->promocode_model->deletedata($column);

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

		 $cond= "AND promocode_name LIKE '%".$searchkey."%'";

		}else{

		 $cond='';	

		}

		$list=$this->promocode_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");

		if(count($list)>0){

			foreach($list as $l){
			   
				$PImages = json_decode($l->image_fids);
   	   		    $col=array();
				$col['id']=$l->id;
				$col['pimage']= count($PImages) > 0?$this->media->getThumbPathById($PImages[0], '65x49'):'';
				$col['promocode_name']=$l->promocode_name;
				$col['status']=$l->status;		 	
			 array_push($response['data'],$col);

			}

		}
		echo json_encode($response);
		exit;

	}

	

}