<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Callback extends Public_Controller {
   function __construct(){
        parent::__construct();
        //define('RAZOR_KEY_ID', 'rzp_test_0kDAsb3GqtdQwR');
		//define('RAZOR_KEY_SECRET', 'Azsy2BFcbOE4okezfw6xdK5Z'); 
     }

    public function index(){
		if (!empty($_POST['razorpay_payment_id']) && !empty($_POST['merchant_order_id'])) {
			$json = array();
			$razorpay_payment_id = $_POST['razorpay_payment_id'];
			$merchant_order_id = $_POST['merchant_order_id'];
			$currency_code = $_POST['currency_code_id'];
			// store temprary data
			$dataFlesh = array(
				'card_holder_name' => $_POST['card_holder_name_id'],
				'merchant_amount' => $_POST['merchant_amount'],
				'merchant_total' => $_POST['merchant_total'],
				'surl' => $_POST['merchant_surl_id'],
				'furl' => $_POST['merchant_furl_id'],
				'currency_code' => $currency_code,
				'order_id' => $merchant_order_id,
				'razorpay_payment_id' => $_POST['razorpay_payment_id'],
			);
 		 
			
			$paymentInfo = $dataFlesh;
			$order_info = array('order_status_id' => $_POST['merchant_order_id']);
			$amount = $_POST['merchant_total'];
			$currency_code = $_POST['currency_code_id'];
			// bind amount and currecy code
			$data = array(
				'amount' => $amount,
				'currency' => $currency_code,
			);
			$success = false;
			$error = '';
			try {
				$ch = $this->get_curl_handle($razorpay_payment_id, $data);
				//execute post
				$result = curl_exec($ch);
				$data = json_decode($result);
			   
				$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			
				if ($result === false) {
					$success = false;
					$error = 'Curl error: ' . curl_error($ch);
				} else {
					$response_array = json_decode($result, true);
					//Check success response
					if ($http_status === 200 and isset($response_array['error']) === false) {
						$success = true;
					} else {
						$success = false;
						if (!empty($response_array['error']['code'])) {
							$error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
						} else {
							$error = 'Invalid Response <br/>' . $result;
						}
					}
				}
				//close connection
				curl_close($ch);
			} catch (Exception $e) {
				$success = false;
				$error = 'Request to Razorpay Failed';
			}
			if ($success === true) {
				if (!$order_info['order_status_id']) {
					$json['redirectURL'] = $_POST['merchant_surl_id'];
				} else {
					$json['redirectURL'] = $_POST['merchant_surl_id'];
				}
 
 				 //Save transaction in db
				 $col=array();
 				 $col['card_holder_name']=$dataFlesh['card_holder_name'];
				 $col['merchant_amount']=$dataFlesh['merchant_amount'];
				 $col['currency_code']=$dataFlesh['currency_code'];
				 $col['merchant_total']=$dataFlesh['merchant_total'];
				 $col['order_id']=$dataFlesh['order_id'];
 				 $col['razorpay_payment_id']=$dataFlesh['razorpay_payment_id'];
				 $col['transaction_date']=date('Y-m-d H:i:s');
				 //$this->db->insert('tbl_transaction',$col);
				 //$transaction_id=$this->db->insert_id();	
				  
				 $this->session->set_userdata('transaction_data',$col);

			} else {
				$json['redirectURL'] = $_POST['merchant_furl_id'];
			}
			$json['msg'] = '';
			} else {
			$json['msg'] = 'An error occured. Contact site administrator, please!';
			}
			header('Content-Type: application/json');
			echo json_encode($json);
	}

	function get_curl_handle($payment_id, $data) {
		$url = 'https://api.razorpay.com/v1/payments/' . $payment_id . '/capture';
		$key_id = RAZOR_KEY_ID;
		$key_secret = RAZOR_KEY_SECRET;
		$params = http_build_query($data);
		//cURL Request
		$ch = curl_init();
		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		return $ch;
	}

}

