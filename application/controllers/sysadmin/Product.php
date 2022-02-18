<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Product extends Admin_Controller

{



    function __construct()

    {

        parent::__construct();

 		$this->load->model('product_model');

		$this->load->model('category_model');

		$this->load->model('brand_model');

		$this->load->model('sub_brand_model');

		$this->load->model('weight_unit_model');

		$this->load->model('productsize_model');

		$this->load->model('productcolor_model');

		$this->load->model('productshape_model');

		$this->load->model('productmaterial_model');

     }



    public function index()

    {

		$this->load->library('pagination');

		$this->data['page_title'] = 'Product';

		

 		

   		$this->data['total_record'] = $this->product_model->selectdata("*",array(),"ORDER BY pid DESC");

 		$this->load->library('pagination');

 		$config['base_url'] = MAINSITE_MADMIN_URL.'product/page/';

		$config['total_rows'] = count($this->data['total_record']);

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

		$this->data['total_product']  = $page;

		$this->data['product'] = $this->product_model->selectdata("*",array(),'ORDER BY pid DESC',$page,$config["per_page"]);
		

		$this->data['pageing_link'] = $this->pagination->create_links();

		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" />';

		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/datetimepicker/jquery.datetimepicker.min.js" type="text/javascript"><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';

        $this->load->view('sysadmin/product/list',$this->data);

	}

	

	public function page()

   {

      $this->index();

   }



	public function create()

	{

		$this->data['page_title'] = 'Add Product';

		//Gallery

		$this->load->library('gallery');

		$attr = array('class' => 'btn btn-primary btn-block btn-large');

		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics', $attr);



		$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY cat_id DESC');

		$this->data['brand'] = $this->brand_model->selectdata("*", array('status' => 'active'), 'ORDER BY id DESC');

		$this->data['weight'] = $this->weight_unit_model->selectdata("*", array(), 'ORDER BY id ASC');

		$this->data['pframeshape'] = $this->productshape_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');

		$this->data['pframesize'] = $this->productsize_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');

		$this->data['pframecolor'] = $this->productcolor_model->selectdata("*", array('status' => 'active'), 'ORDER BY color_id');

		$this->data['pmaterial'] = $this->productmaterial_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');
 

		$this->data['extracss'] = '<link rel="stylesheet" href="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/css/select2.min.css">';

		$this->data['extrajs'] = '<script src="' . ADMIN_ASSETS_PATH . 'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';

		$this->load->view('sysadmin/product/add', $this->data);

	}



    public function add()

    {

		$response = array();

		$response['token'] = $this->security->get_csrf_token_name();

		$response['hash'] = $this->security->get_csrf_hash();


         $this->form_validation->set_rules('product_name','Product Name','trim|required');
        	$this->form_validation->set_rules('brand','Brand Name','trim|required');
        	$this->form_validation->set_rules('subbrand','Sub Brand','trim|required');
        	$this->form_validation->set_rules('cat_id','Category','trim|required');
        	$this->form_validation->set_rules('type_id','Product Type','trim|required');
        	$this->form_validation->set_rules('post_pics[]','Product Images','trim|required');
        	$this->form_validation->set_rules('product_desc','Product Desription','trim|required');
        	$this->form_validation->set_rules('mrp','MRP','trim|required');
        	$this->form_validation->set_rules('price','Price','trim|required');
        	$this->form_validation->set_rules('frame_shape[]','Frame Shape','trim|required');
        	$this->form_validation->set_rules('frame_size[]','Frame Size','trim|required');
        	$this->form_validation->set_rules('frame_color[]','Frame Color','trim|required');
        	$this->form_validation->set_rules('material','Frame Material','trim|required');

        //$this->form_validation->set_rules('consultant_description','Product description','trim|required');

        if($this->form_validation->run()===FALSE)

        {

           	 $response['status']='haserror';

			 $response['error']=validation_errors();

        }

        else

        {
			$product_name=$this->input->post('product_name');
            $column['product_name'] = $product_name;
            $column['brand_name'] = $this->input->post('brand');
            $column['subbrand'] = $this->input->post('subbrand');
            $column['cat_id'] = $this->input->post('cat_id');
            $column['product_type'] = $this->input->post('type_id');
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
 			$column['product_desc'] = $this->input->post('product_desc');
			$column['mrp'] = $this->input->post('mrp');
			$column['price'] = $this->input->post('price');

			$column['featured'] = !empty($_POST['featured'])?$this->input->post('featured'):0;
			$column['hot'] = !empty($_POST['hot_pro'])?$this->input->post('hot_pro'):0;
  			$column['url_slug']=get_valid_name($product_name);
			 
  			$column['frame_shape'] = implode(',', $this->input->post('frame_shape'));
			$column['frame_size'] = implode(',', $this->input->post('frame_size'));
			$column['frame_color'] = implode(',', $this->input->post('frame_color'));
 			$column['gender'] = $this->input->post('gender');
 			$column['material'] = $this->input->post('material');
 			$column['status']='active';
			$column['date_added']=date('Y-m-d H:i:s');
			$column['date_modified']=date('Y-m-d H:i:s');
			$this->product_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Product added successfully.";		
         }

		echo json_encode($response); 

		exit;

    }



    public function edit($pid = NULL){
		$pid = $this->input->post('pid') ? $this->input->post('pid') : $pid;

		//Gallery
		$this->load->model('media_model');
		$this->load->library('gallery');        
        $attr = array('class'=>'btn btn-primary btn-block btn-large');
 		$this->data['post_pics'] = $this->gallery->getMediaGallery('post_pics',$attr);
  	
        $this->data['page_title'] = 'Edit Product';
 		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css">';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script>';

        $this->form_validation->set_rules('product_name','Product Name','trim|required');
        if($this->form_validation->run() === FALSE)
        {
			$product =$this->product_model->selectdata("*",array('pid'=>$pid),"ORDER BY pid DESC");
            if(count($product)>0)
            {
				$this->data['category'] = $this->category_model->selectdata("*", array('status' => 'active'), 'ORDER BY cat_id DESC');

				$this->data['brands'] = $this->brand_model->selectdata("*", array('status' => 'active'), 'ORDER BY id DESC');

				$this->data['subbrands'] = $this->sub_brand_model->selectdata("*", array('status' => 'active','brand_name' => $product[0]->brand_name), 'ORDER BY id DESC');


		$this->data['pframeshape'] = $this->productshape_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');

		$this->data['pframesize'] = $this->productsize_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');

		$this->data['pframecolor'] = $this->productcolor_model->selectdata("*", array('status' => 'active'), 'ORDER BY color_id');

		$this->data['pmaterial'] = $this->productmaterial_model->selectdata("*", array('status' => 'active'), 'ORDER BY id');

                $this->data['product'] = $product;
             }else{
                $this->session->set_flashdata('message', 'The Product doesn\'t exist.');
                redirect('sysadmin/product', 'refresh');
            }
            $this->load->view('sysadmin/product/edit',$this->data);
        }
        else
        {
        	$response = array();

		$response['token'] = $this->security->get_csrf_token_name();

		$response['hash'] = $this->security->get_csrf_hash();

        	$this->form_validation->set_rules('product_name','Product Name','trim|required');
        	$this->form_validation->set_rules('brand','Brand Name','trim|required');
        	$this->form_validation->set_rules('subbrand','Sub Brand','trim|required');
        	$this->form_validation->set_rules('cat_id','Category','trim|required');
        	$this->form_validation->set_rules('type_id','Product Type','trim|required');
        	$this->form_validation->set_rules('post_pics[]','Product Images','trim|required');
        	$this->form_validation->set_rules('product_desc','Product Desription','trim|required');
        	$this->form_validation->set_rules('mrp','MRP','trim|required');
        	$this->form_validation->set_rules('price','Price','trim|required');
        	$this->form_validation->set_rules('frame_shape[]','Frame Shape','trim|required');
        	$this->form_validation->set_rules('frame_size[]','Frame Size','trim|required');
        	$this->form_validation->set_rules('frame_color[]','Frame Color','trim|required');
        	$this->form_validation->set_rules('material','Frame Material','trim|required');

	        if($this->form_validation->run()===FALSE)
	        {

	           	 $response['status']='haserror';

				 $response['error']=validation_errors();
	        }
	        else
	        {
			$product_name=$this->input->post('product_name');
            $column['product_name'] = $product_name;
            $column['brand_name'] = $this->input->post('brand');
            $column['subbrand'] = $this->input->post('subbrand');
            $column['cat_id'] = $this->input->post('cat_id');
            $column['product_type'] = $this->input->post('type_id');
            $column['image_fids'] = trim(json_encode($this->input->post('post_pics')));
 			$column['product_desc'] = $this->input->post('product_desc');
			$column['mrp'] = $this->input->post('mrp');
			$column['price'] = $this->input->post('price');
			$column['url_slug']=get_valid_name($product_name);
			
			$column['frame_shape'] = implode(',', $this->input->post('frame_shape'));
			$column['frame_size'] = implode(',', $this->input->post('frame_size'));
			$column['frame_color'] = implode(',', $this->input->post('frame_color'));

			$column['featured'] = !empty($_POST['featured'])?$this->input->post('featured'):0;
			$column['hot'] = !empty($_POST['hot_pro'])?$this->input->post('hot_pro'):0;

 			$column['gender'] = $this->input->post('gender');
 			$column['material'] = $this->input->post('material');
			$column['date_modified'] = date('Y-m-d H:i:s');
            //pr($column); die;
            $this->product_model->updatedata($column,array('pid'=>$pid));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            //redirect('sysadmin/product','refresh');

            $response['status']='success';	
			$response['msg']="Product Updated successfully.";		
         

redirect('sysadmin/product','refresh');
        }
		// echo json_encode($response); 

		// exit;
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

		$conditions['pid']=$id;

		$this->product_model->updatedata($columns,$conditions);

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
    
		$column['pid']=$this->input->post('id');

	    $deleted = $this->product_model->deletedata($column);

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

        $platform=$this->input->post('platform');

		if(!empty($searchkey)){

		 $cond= "AND product_name LIKE '%".$searchkey."%'";

		}else{

		 $cond='';	

		}

		$list=$this->product_model->selectdata("*",array("platform"=>$platform)," ".$cond." ORDER BY pid DESC");

		if(count($list)>0){

			foreach($list as $l){
			   
				$PImages = json_decode($l->image_fids);
   	   		    $col=array();
				$col['id']=$l->pid;
				$col['pimage']= count($PImages) > 0?$this->media->getThumbPathById($PImages[0], '65x49/'):'';
				$col['product_name']=$l->product_name;
				$col['catalogue_id']=$l->catalogue_id;		 	
				$col['sku']=$l->sku;		 	
				$col['price']=$l->price;		 	
				$col['platform']=$l->platform;		 	
				$col['status']=$l->status;		 	
			 	array_push($response['data'],$col);

			}

		}
		echo json_encode($response);
		exit;

	}



	

}