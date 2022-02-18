<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productcolor extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
 		$this->load->model('productcolor_model');
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'Product Color';
 		
   		$this->data['total_record'] = $this->productcolor_model->selectdata("*",array(),"ORDER BY color_id DESC");
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'productcolor/page/';
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
		$this->data['productcolor'] = $this->productcolor_model->selectdata("*",array(),'ORDER BY color_id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='';
		$this->data['extrajs']='';
        $this->render('sysadmin/productcolor/list_productcolor_view');
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
        $this->form_validation->set_rules('productcolor_name','Product Color name','trim|required');
        $this->form_validation->set_rules('productcolor_value1','Product Color Value','trim|required');
        //$this->form_validation->set_rules('consultant_description','Product Type description','trim|required');
        if($this->form_validation->run()===FALSE)
        {
           	 $response['status']='haserror';
			 $response['error']=validation_errors();
        }
        else
        {

			$name=$this->input->post('productcolor_name');
			$value1=$this->input->post('productcolor_value1');
			$value2=$this->input->post('productcolor_value2');
			$color_type=$this->input->post('color_type');
            $column['color_name'] = $name;
            $column['color_value1'] = $value1;
            $column['color_value2'] = $value2;
            $column['color_type'] = $color_type;
			$column['status']='active';
			$column['last_modified_date']=date('Y-m-d H:i:s');			
			$this->productcolor_model->insertdata($column);
 			$response['status']='success';	
			$response['msg']="Product Color created successfully.";		
         }
		echo json_encode($response); 
		exit;
    }

    public function edit($color_id = NULL)
    {
		$color_id = $this->input->post('color_id') ? $this->input->post('color_id') : $color_id;
        $this->data['page_title'] = 'Product Color';
 		$this->data['extracss']='';
		$this->data['extrajs']='';

        $this->form_validation->set_rules('productcolor_name','Product Color name','trim|required');

        if($this->form_validation->run() === FALSE)
        {
			$productcolor =$this->productcolor_model->selectdata("*",array('color_id'=>$color_id),"ORDER BY color_id DESC");
            if(count($productcolor)>0)
            {
                $this->data['productcolor'] = $productcolor;
             }
            else
            {
                $this->session->set_flashdata('message', 'The Product Color doesn\'t exist.');
                redirect('sysadmin/productcolor', 'refresh');
			}
			//pr(validation_errors());die;
			$this->render('sysadmin/productcolor/edit_productcolor_view');
			
        }
        else
        {
			$name=$this->input->post('productcolor_name');
			$value1=$this->input->post('productcolor_value1');
			$value2=$this->input->post('productcolor_value2');
			$color_type=$this->input->post('color_type');
			
            $column['color_name'] = $name;
            $column['color_value1'] = $value1;
            $column['color_value2'] = $value2;
            $column['color_type'] = $color_type;

			$column['status']=$this->input->post('status');
			 $column['last_modified_date']=date('Y-m-d H:i:s');		
			 
			 
           
            $this->productcolor_model->updatedata($column,array('color_id'=>$color_id));
            //$this->session->set_flashdata('message',$this->ion_auth->messages());
            redirect('sysadmin/productcolor','refresh');
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
		$conditions['color_id']=$id;
		$this->productcolor_model->updatedata($columns,$conditions);
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
		$column['color_id']=$this->input->post('id');
	    $deleted = $this->productcolor_model->deletedata($column);
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
		 $cond="AND color_name LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$color = '';
		$list=$this->productcolor_model->selectdata("*",array()," ".$cond." ORDER BY color_id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['color_id']=$l->color_id;
			 $col['productcolor_name']=$l->color_name;
			 $col['color_type']=$l->color_type;
			 $col['status']=$l->status;		 	
			 $col['color_value1']=$l->color_value1;	 	
			 $col['color_value2']=$l->color_value2;		
			 if($l->color_type == 'dual'){
                	$color ='<td><label style="background-image: linear-gradient(140deg, #EADEDB 0%, '.$l->color_value1.' 50%, '.$l->color_value2.' 75%);height: 20px;width: 20px;"></label></td>';
             }else{
              		$color ='<td><label style="background-color:'.$l->color_value1.';height: 20px;width: 20px;"></label></td>';
              }
              $col['bg_color']=$color;	

			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}
	
}