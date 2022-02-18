<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends Publicusers_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('users_model');       
        $this->load->model('orders_model');
        $this->load->model('wallet_model');
        $this->load->model('wishlist_model');
        $this->load->model('product_model');
    }

   public function info()
   {
	    $this->data['page_title'] = 'User Info';
		$this->data['extracss']='';
        $this->data['extrajs']='';
        //Get user session
        if($this->session->has_userdata('userId')){    
            $user_id=$this->session->userdata('userId');
            $this->data['user_info'] = $this->users_model->selectdata("*",array('id'=>$user_id,'status'=>'active'),"ORDER BY id DESC LIMIT 1");
 		    $this->render('public/users/userinfo');
        }else{
            redirect('');
        }		
    }

    public function updateprofile(){
        $this->data['page_title'] = 'Update Account Details';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $this->data['user_info'] = $this->users_model->selectdata("*", array('id' => $user_id, 'status' => 'active'), "ORDER BY id DESC LIMIT 1");
            $this->render('public/users/edit_userinfo');
        } else {
            redirect('');
        }
    }

    function updateprofiledata()
    {
        $response = array();
        $response['data']='';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('inputUname', 'User Name', 'trim|required');
        $this->form_validation->set_rules('inputEmail', 'User Email', 'trim|required');
        $this->form_validation->set_rules('InputPhone', 'User Phone', 'trim|required');              

        if ($this->form_validation->run() === FALSE) {
            $response['status'] = 'haserror';
            $response['error'] = validation_errors();
        } else {
            if ($this->session->has_userdata('userId')) {
                
                $user_id = $this->session->userdata('userId');
                $inputUname = $this->input->post('inputUname');
                $inputEmail = $this->input->post('inputEmail');
                $InputPhone = $this->input->post('InputPhone');
                $Inputcompany = $this->input->post('Inputcompany');

                $column['id'] = $user_id;
                $column['name'] = $inputUname;
                $column['email'] = $inputEmail;
                $column['mobile'] = $InputPhone;
                $column['company_name'] = $Inputcompany;
                
                $column['date_modified'] = date('Y-m-d H:i:s');

                $this->db->where('id', $user_id);
                $this->db->update('tbl_customer', $column);
                

                $response['data'] = $column;
                $response['status'] = 'success';
                $response['error'] = 'Profile Updated Successfully..!';
            } else {
                $response['status'] = 'haserror';
                $response['error'] = 'Invalid Request';
            }
        }
        echo json_encode($response);        
        $_SESSION['msg'] = $response;
        redirect('user/info');
    }


    function address(){
        $this->data['page_title'] = 'User Address';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $this->data['address'] = $this->users_model->selectaddress("*", array('uid' => $user_id), "ORDER BY id DESC");
            $this->render('public/users/address');
        } else {
            redirect('');
        }
    }


    function getAddress(){
        $response = array();
        $addressid=$this->input->post('adid');
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $address = $this->users_model->selectaddress("*", array('id' => $addressid,'uid'=> $user_id), "ORDER BY id DESC");
            
            $response['addressline']=$address[0]->addressline;
            $response['addressline2'] = $address[0]->addressline2;
            $response['city'] = $address[0]->city;
            $response['state'] = $address[0]->state;
            $response['zipcode'] = $address[0]->zipcode;
            $response['mobile'] = $address[0]->mobile;

            $response['status'] = 'success';
        }else{
            $response['status'] = 'haserror';
            $response['error'] = 'Invalid Request';
        }
        echo json_encode($response);
    }


    function addadress(){
		$response=array();
        $this->load->library('form_validation');
        $this->form_validation->set_rules('addressline','Address','trim|required');
		$this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('state','State','trim|required');
		$this->form_validation->set_rules('zipcode','Zipcode','trim|required');        
		$this->form_validation->set_rules('mobile','Mobile No.','trim|required');
        
   		if($this->form_validation->run()===FALSE){
      		$response['status']='haserror';  
		    $response['error']=validation_errors();
        }else{
            if ($this->session->has_userdata('userId')) {
                $user_id = $this->session->userdata('userId');
                $addressline = $this->input->post('addressline');
                $addressline2 = $this->input->post('addressline2');
                $city = $this->input->post('city');
                $state = $this->input->post('state');
                $zipcode = $this->input->post('zipcode');
                $mobile = $this->input->post('mobile');
                
                $column['uid']=$user_id;
                $column['addressline']=$addressline;
                $column['addressline2']=$addressline2;
                $column['city']=$city;
                $column['state']=$state;
                $column['zipcode']=$zipcode;
                $column['mobile']=$mobile;

                $column['date_added']=date('Y-m-d H:i:s');
                $column['date_modified']=date('Y-m-d H:i:s');

                $this->db->insert('tbl_address',$column);
                $response['status']='success';
                $response['error'] = 'Address Added Successfully..!';
            }else{
                $response['status'] = 'haserror';
    		    $response['error'] = 'Invalid Request';
            }
		}
        echo json_encode($response);       
        $_SESSION['msg'] = $response;
        redirect('user/address');
        
	}


    function updateadress()
    {
        $response = array();
        $response['data']='';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('addr_name','Address1 name','trim|required');
        $this->form_validation->set_rules('addr_mobile','Address 1 mobile Number','trim|required');
        $this->form_validation->set_rules('addr_line1','Address Line 1','trim|required');
        $this->form_validation->set_rules('addr_line2','Address Line 2','trim|required');
        $this->form_validation->set_rules('addr_city','City','trim|required');
        $this->form_validation->set_rules('addr_state','State','trim|required');
        $this->form_validation->set_rules('addr_pincode','Pincode','trim|required|min_length[6]');

        $this->form_validation->set_rules('addr_name_comp','Address1 name','trim|required');
        $this->form_validation->set_rules('addr_mobile_comp','Address 2 mobile Number','trim|required');
        $this->form_validation->set_rules('addr_line1_comp','Address Line 1','trim|required');
        $this->form_validation->set_rules('addr_line2_comp','Address Line 2','trim|required');
        $this->form_validation->set_rules('addr_city_comp','City','trim|required');
        $this->form_validation->set_rules('addr_state_comp','State','trim|required');
        $this->form_validation->set_rules('addr_pincode_comp','Pincode','trim|required|min_length[6]');
        $adid = $this->input->post('adid');                

        if ($this->form_validation->run() === FALSE) {
            $response['status'] = 'haserror';
            $response['error'] = validation_errors();
        } else {
            if ($this->session->has_userdata('userId') && !empty($adid)) {
                
                $user_id = $this->session->userdata('userId');
                $addr_name = $this->input->post('addr_name');
                $addr_mobile_no = $this->input->post('addr_mobile');
                $addr_line1 = $this->input->post('addr_line1');
                $addr_line2 = $this->input->post('addr_line2');
                $addr_city = $this->input->post('addr_city');
                $addr_state = $this->input->post('addr_state');
                $addr_pincode = $this->input->post('addr_pincode');

                $addr_name_comp = $this->input->post('addr_name_comp');
                $addr_mobile_comp = $this->input->post('addr_mobile_comp');
                $addr_line1_comp = $this->input->post('addr_line1_comp');
                $addr_line2_comp = $this->input->post('addr_line2_comp');
                $addr_city_comp = $this->input->post('addr_city_comp');
                $addr_state_comp = $this->input->post('addr_state_comp');
                $addr_pincode_comp = $this->input->post('addr_pincode_comp');

                $column1['adr_name']=$addr_name;
                $column1['mobile']=$addr_mobile_no;
                $column1['addressline1']=$addr_line1;
                $column1['addressline2']=$addr_line2;
                $column1['city']=$addr_city;
                $column1['state']=$addr_state;
                $column1['zipcode']=$addr_pincode;

                $column1['adr_name_res']=$addr_name_comp;
                $column1['mobile_res']=$addr_mobile_comp;
                $column1['addressline1_res']=$addr_line1_comp;
                $column1['addressline2_res']=$addr_line2_comp;
                $column1['city_res']=$addr_city_comp;
                $column1['state_res']=$addr_state_comp;
                $column1['zipcode_res']=$addr_pincode_comp;
                
                $column['date_modified'] = date('Y-m-d H:i:s');

                $this->db->where('id', $adid);
                $this->db->where('uid', $user_id);
                $this->db->update('tbl_address', $column1);
                
                $column['adid'] = $adid;

                unset($column['uid']);
                unset($column['date_modified']);

                $response['data'] = $column;
                $response['status'] = 'success';
                $response['error'] = 'Address Updated Successfully..!';
            } else {
                $response['status'] = 'haserror';
                $response['error'] = 'Invalid Request';
            }
        }
        echo json_encode($response);        
        $_SESSION['msg'] = $response;
        redirect('user/address');
    }

    function deleteadress($id)
    {        
            $user_id = $this->session->userdata('userId');
            if ($this->session->has_userdata('userId')) {
                $this->db->where('id', $id);
                $this->db->where('uid', $user_id);
                $this->db->delete('tbl_address');                

                $response['status'] = 'success';
                $response['error'] = 'Address Deleted Successfully..!';
            } else {
                $response['status'] = 'haserror';
                $response['error'] = 'Invalid Request';
            }

        echo json_encode($response);        
        $_SESSION['msg'] = $response;
        redirect('user/address');
    }


    function orders(){
        $this->data['page_title'] = 'Order History';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $this->data['orders'] = $this->orders_model->selectdata("*", array('uid' => $user_id), "ORDER BY id DESC");
            $this->render('public/users/orders');
        } else {
            redirect('');
        }
    }


    function wishlist(){
        $this->data['page_title'] = 'My Wishlist';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $this->data['wish'] = $this->wishlist_model->selectdata("*", array('uid' => $user_id), "ORDER BY id DESC");
            $this->render('public/users/wishlist');
        } else {
            redirect('');
        }
    }


    function addtowishlist(){
        
        //Get product data by ID
        $response = array();
        $pro_id = $_POST['proid']; 
        $column['pro_id']=$pro_id;
        $user_id=$this->session->userdata('userId');
        
        $column['uid']=$user_id;
        $column['addition_date']=date('Y-m-d H:i:s');
        $this->db->insert('tbl_wishlist',$column);

        $response['status']='success';
        $response['error'] = 'Added to Wishlist..!';    
       
        echo json_encode($response);
    }

    function removefromwishlist(){
        $response =array();    
        $pro_id=$this->input->post('proid', true);


        $user_id = $this->session->userdata('userId');
            if ($this->session->has_userdata('userId')) {
                $this->db->where('pro_id', $pro_id);
                $this->db->where('uid', $user_id);
                $this->db->delete('tbl_wishlist');                

                $response['status'] = 'success';
                $response['error'] = 'Item Removed from Wishlist..!';
            } else {
                $response['status'] = 'haserror';
                $response['error'] = 'Invalid Request';
            }

        echo json_encode($response);   
     }

    function logout(){
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('msg');
		redirect('login');
	}
    function orderdetail(){
        $this->data['page_title'] = 'Order Detail';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        $invoice_no=$this->uri->segment(2);
        
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId');
            $invoiceno=$this->uri->segment(2);
            $orders= $this->orders_model->selectdata("*", array('invoice_no'=>$invoice_no,'uid' => $user_id), "ORDER BY id DESC LIMIT 1");
            $this->data['orders']=count($orders)>0?$orders[0]:array();
            $orderid=isset($orders[0]->id)?$orders[0]->id:'';
            //$this->data['address'] = $this->users_model->selectaddress("*", array('id' => $addressid,'uid'=> $user_id), "ORDER BY id DESC");
            $this->data['address'] = $this->orders_model->get_order_addressbyid("*", array('order_id' => $orderid), "ORDER BY id DESC");
            //var_dump($this->db->last_query());


            $this->render('public/users/orderdetails');
        } else {
            redirect('');
        }
    }

    function wallet(){
        $this->data['page_title'] = 'Wallet';
        $this->data['extracss'] = '';
        $this->data['extrajs'] = '';
        //$invoice_no=$this->uri->segment(2);
        
        //Get user session
        if ($this->session->has_userdata('userId')) {
            $user_id = $this->session->userdata('userId'); 

            $wallet= $this->wallet_model->selectdata("*", array('uid' => $user_id,'status'=>'active'), "ORDER BY id DESC LIMIT 1");     
            if(count($wallet)>0){
                $wallet_id=$wallet[0]->id;
                $wallet_transaction=$this->wallet_model->selecttransaction('*',array('wallet_id'=>$wallet_id,'status'=>'active'),'ORDER BY id DESC');
                $this->data['wallet']=$wallet;
                $this->data['wallet_transaction']=$wallet_transaction;
                $this->render('public/users/wallet');
            }        
        } else {
            redirect('');
        }
    }

    function getAddressData(){
        
        //Get user session
        $response = array();
        $response['data']='';
        if ($this->session->has_userdata('userId')) {
            $adr_id = $_POST['adrid']; 
            $user_id = $this->session->userdata('userId');

            $adr_data= $this->users_model->selectaddressbyid("*", array('uid' => $user_id,'id'=>$adr_id), "ORDER BY id DESC LIMIT 1");    
            $response['data'] = $adr_data;       
        } else {
            echo "N";
            $response['data'] = 'N';     
        }
        echo json_encode($response);
    }

    
}


