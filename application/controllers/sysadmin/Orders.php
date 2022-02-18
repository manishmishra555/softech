<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller
{

    function __construct()
    {
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('wallet_model');		
		$this->load->model('orders_model');
		$this->load->model('customers_model');		 
     }

    public function index()
    {
		$this->load->library('pagination');
        $this->data['page_title'] = 'orders';
 		 
		$total_records = $this->orders_model->selectdata("COUNT(*) as totalrecords",array(),"ORDER BY id DESC");
		$this->data['total_record'] = $total_records[0]->totalrecords;
 		$this->load->library('pagination');
 		$config['base_url'] = MAINSITE_MADMIN_URL.'orders/page/';
		$config['total_rows'] =	$total_records[0]->totalrecords;
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
		$this->data['orders'] = $this->orders_model->selectdata("*",array(),'ORDER BY id DESC',$page,$config["per_page"]);
		$this->data['pageing_link'] = $this->pagination->create_links();
		$this->data['extracss']='<link rel="stylesheet" href="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/css/select2.min.css"><link href="'.FRONT_ASSETS_PATH.'css/jquery.datetimepicker.css" rel="stylesheet" />';
		$this->data['extrajs']='<script src="'.ADMIN_ASSETS_PATH.'vendors/bower_components/select2/dist/js/select2.full.min.js"></script><script src="'.FRONT_ASSETS_PATH.'js/jquery.datetimepicker.min.js" type="text/javascript"></script><script>$(\'.date-picker\').datetimepicker({timepicker:false,format:\'d-m-Y\'});</script>';
        $this->render('sysadmin/orders/list_view');
	}
	
	public function page()
   {
      $this->index();
   }

    
    function orderdetails(){ 
		$response=array();
		$response['itemlist']=array();

		$order_id=$this->input->post('id');
		

		if(!empty($order_id)){
			$orders = $this->orders_model->selectdata("*", array('id' => $order_id), "ORDER BY id DESC LIMIT 1");
			$orders=$orders[0];

			$customer_name=$orders->uname;
  			$mobile = $orders->uphone;
			//$addressid = isset($orders->address_id) ? $orders->address_id : '';
			$order_date=date('d-m-Y', strtotime($orders->date_added));
			$total_items = $orders->total_items;
			
			$oid = $orders->id;

			$all_order_status = array('0' => 'Placed', '1' => 'Dispatched', '2' => 'Out for delivery', '3' => 'Delivered');
			$order_status = '';
			$os = $orders->order_status;
			if (array_key_exists($os, $all_order_status)) {
				$order_status = $all_order_status[$os];
			}

			$response['order_id']=$oid;

			$response['customer_name'] = $customer_name;			
			$response['order_status'] = $order_status;
			$response['order_date'] = $order_date;
			$response['total_items'] = $total_items;
			$response['mobile'] = $mobile;
			$response['email'] = $orders->uemail;
			$response['message'] = $orders->udescription;
			$response['company'] = $orders->ucompany;

			$items = $this->orders_model->selectitems("*", array('order_id' => $oid), "ORDER BY id ASC");
			if (count($items) > 0) {
				foreach ($items as $it) {
					$col=array();
					$col['item_name'] = $it->item_name;
					if (!empty($it->item_discounted_price)) {
						$price = $it->item_discounted_price;
					} else {
						$price = $it->item_price;
					}
					$col['price'] = $price;
					$pro_data = $this->db->get_where('tbl_product',array('pid ' => $it->item_id))->result();
					$cat_id=isset($pro_data[0])?$pro_data[0]->cat_id:'';
                    $gst = 0;
                    if($cat_id == '9'){
                        $gst = '18';
                    }if($cat_id == '6'){
                        $gst = '12';
                    }
                    $item_subtotal = $price * $it->item_qnty;
                    $gst_total = ($item_subtotal*$gst)/100;
                    $total = $item_subtotal+$gst_total;
					
					
					
					$col['gst']= $gst;
					$col['item_qnty'] = $it->item_qnty;
					$col['item_subtotal']= $total;
					array_push($response['itemlist'],$col);
				}
			}
			$response['order_subtotal'] = $orders->order_subtotal;
			$response['total_amount'] = $orders->total_amount;

			$response['status']="success";
		}else{
			$response['status']='error';
			$response['msg']="Invalid request";
		}

		echo json_encode($response);
	}

	function updateorder(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$order_id=$this->input->post('o_order_id');
		$order_status = $this->input->post('order_status');
		if(!empty($order_id) && !empty($order_status)){
			
			//Update Order
			$columns=array();
			$columns['order_status']=$order_status;
			$conditions=array();
			$conditions['id']=$order_id;
			$this->orders_model->updatedata($columns,$conditions);

            $checkstatus=$this->orders_model->get_order_status_history('*',array('order_status'=>$order_status,'order_id'=>$order_id),'LIMIT 1');
			$order_status_data=array(
                'order_id'=>$order_id,
                'order_status '=>$order_status,
				'created_at'=>date('Y-m-d H:i:s'),                
				'updated_at'=>date('Y-m-d H:i:s')
			);
			if(count($checkstatus)>0){
				$status_id=$checkstatus[0]->id;				
				$order_status_update_data=array('updated_at'=>date('Y-m-d H:i:s'));
			 	$this->db->where('id',$status_id);
				$this->db->update('tbl_order_status',$order_status_update_data);
			}else{
                $this->db->insert('tbl_order_status',$order_status_data);
			} 
			
			$response['status']="success";
		}else{
			$response['status']='error';
			$response['msg']="Invalid request";
		}
		echo json_encode($response);
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
		$this->orders_model->updatedata($columns,$conditions);
		//$msg = "Expense n_title Status Successfully Updated.";
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
	    $deleted = $this->orders_model->deletedata($column);
	    
		if($deleted){
	    	$response['status']="success";
  		}else{
			$response['status']="haserror";
		}
		echo json_encode($response); 
		//redirect($this->input->get('url'));
	}
	
	public function search(){
		$response=array();
		$response['token']=$this->security->get_csrf_token_name();
		$response['hash']=$this->security->get_csrf_hash();
		$response['data']=array();
        $searchkey=$this->input->post('searchkey');
		if(!empty($searchkey)){
		 $cond="AND n_title LIKE '%".$searchkey."%'";
		}else{
		 $cond='';	
		}
		$list=$this->orders_model->selectdata("*",array()," ".$cond." ORDER BY id DESC");
		if(count($list)>0){
			foreach($list as $l){
			 $col=array();
			 $col['id']=$l->id;
			 $col['n_title']=$l->n_title;
			 $col['status']=$l->status;		 	
			 array_push($response['data'],$col);
			}
		}
		echo json_encode($response);
		exit;
	}

	public function orderdownload($order_id = 0){
		if ($order_id) {
            $order_data = order_making_data($order_id);
             prepare_order_pdf($order_data, "download");
        }else{
			redirect('sysadmin/order');
		}
	}

	function viewOrder($order_id = 0,$print=''){
		if ($order_id) {
			$order_data = order_making_data($order_id);
			$order_data['print']=$print;
			$this->load->view("sysadmin/order/order_print", $order_data);
         }else{
			redirect('sysadmin/order');
		}
 	}
	
}