<?php 



function is_system_users() {
 $CI = & get_instance();
 $system_user = $CI->session->userdata('system_user');
 if (!isset($system_user) || empty($system_user)) {
     redirect("login");
 }
}







function exists($string) {

 if (isset($string) && $string) {

   return $string;

  }

  return '';

}



function data_format($data) {

 $CI = & get_instance();

 if (!empty($data) && $data != '0000-00-00') {

     $newDate = date("d M Y", strtotime($data));

     return $newDate;

 }



}







function phpformat($data){

 $CI = & get_instance();

 if (!empty($data)) {

     $newDate = date("Y-m-d H:i:s", strtotime($data));

     return $newDate;

 }

}





function randomDigits($numDigits) {

 if ($numDigits <= 0) {

     return '';

 }

 return mt_rand(0, 9) . randomDigits($numDigits - 1);

}



function getNameFromNumber($num) {

 $numeric = $num % 26;

 $letter = chr(65 + $numeric);

 $num2 = intval($num / 26);

 if ($num2 > 0) {

     return getNameFromNumber($num2 - 1) . $letter;

 } else {

     return $letter;

 }



} 





function setExtraThing($thing=''){

	$CI = & get_instance();

	$data=$CI->session->userdata('ExtraThing');

	if($thing!=''){

     $data.= $thing."\n";

	 $CI->session->set_userdata('ExtraThing',$data);

	 }

 }



function getExtraThing($thing=''){

  $CI = & get_instance();

  $extThing =$CI->session->userdata('ExtraThing');;

  $CI->session->unset_userdata('ExtraThing');

  return $extThing;

 } 





function getMsg(){

	$CI = & get_instance();

	$ms=$CI->session->userdata('MSG');

 	  if(isset($ms) || $ms!=''){

 	   $msg = $CI->session->userdata('MSG');

 	   $CI->session->unset_userdata('MSG');

 	   return $msg;

 	  } 

	}







function get_valid_name($string){

	$valid_name='';

	$replace_char='';

	if($string){

			$sps_chr_arr=array("--",",","\\","/","&quot;",".","_",".","'","!","@","#","$","%","^","&","*","(",")","+","=","-","[","]","{","}","<",">","?",";",",","|",":","`","~"," ");

			$m=1;

			for($x=0;$x<strlen($string);$x++){

				if(!in_array($string[$x],$sps_chr_arr) && $string[$x]!="\""){

					$m='';

					if($replace_char){

						$valid_name.=$replace_char;

						$replace_char='';

					}

					$valid_name.=$string[$x];

				}else if($m=='' && $string[$x]==" "){

					$m=5;

					$replace_char="-";

				}

			}

		}

		return strtolower($valid_name);

	}





function randomstring($n=10)

{	

	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$randomString = '';



	for ($i = 0; $i < $n; $i++) {

		$index = rand(0, strlen($characters) - 1);

		$randomString .= $characters[$index];

	}



	return $randomString;

} 





function pr($var, $strict = false) {

	$CI = & get_instance();

	if ($var != NULL) {

		if ($strict == false) {

			if( is_array($var) ||  is_object($var) ) {

				echo "<pre>";print_r($var);echo "</pre>";

			 }else{

				echo $var;

			 }

		}else{

			if( is_array($var) ||  is_object($var) ) {

				echo "<pre>";var_dump($var);echo "</pre>";

			 }else{

				var_dump($var) ;

			  }

		}

	}else {

		var_dump($var) ;

	}

}







function send_sms($to, $msg) {

 #die("$to, $type, $f1");	 

	$res = file_get_contents('http://www.kit19.com/ComposeSMS.aspx?username=myheerat648646&password=5795&sender=RGHOSP&to=' . $to . '&message=' . urlencode($msg) . '&priority=1&dnd=1&unicode=0');

	#echo $res;

	return $res;

}







 function loadClassMethods($file_name=''){

   $CI= &get_instance();

   $file_name=ucfirst($file_name);

   foreach(glob(APPPATH . 'controllers/sysadmin/*') as $controller) {

 	  //echo basename($controller, 'php');

 	 if(is_dir($controller)) {

 		 // Get name of directory

 		 $dirname = basename($controller, '.php');

 		 // Loop through the subdirectory

 		 foreach(glob(APPPATH . 'controllers/'.$dirname.'/*') as $subdircontroller) 

 		 {

 			// Get the name of the subdir

 			$subdircontrollername = basename($subdircontroller, '.php');

 			if($subdircontrollername==$file_name)

  			{

 			// Load the controller file in memory if it's not load already

 			if(!class_exists($subdircontrollername)) {				

 				$CI->load->file($subdircontroller);

 			}					

 			// Add the controllername to the array with its methods

 			$aMethods=get_class_methods($subdircontrollername);

 			$aUserMethods = array();

 			foreach($aMethods as $method) {

 				if($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername) {

 					$aUserMethods[] = $method;

 				}

 			}

 		    return $aUserMethods;

 			}

 		 }

  	 }else if(basename($controller, '.php')==$file_name){

 	    $controllername= basename($controller, '.php');

 		// Load the class in memory (if it's not loaded already)

 		if(!class_exists($controllername)) {

 			$CI->load->file($controller);

 		}

 		// Add the controllername to the array with its methods

 	   $aMethods= get_class_methods($controllername);

 	   $aUserMethods = array();

 		foreach($aMethods as $method) {

 			if($method != '__construct' && $method != 'get_instance' && $method != $controllername) {

 				$aUserMethods[] = $method;

 			}

 		}

 	   return $aUserMethods;

   }



 }



}







function selectedOption($action,$allmethods)

 {

   $ol='';

   foreach($allmethods as $all){

 	  if(in_array($all,$action)) { $checked="selected";}else{ $checked='';}

 	  $ol.='<option value="'.$all.'" '.$checked.'>'.$all.'</option>';

 	}

   return $ol;

 }







function getModules($uid = NULL, $group_id = NULL, $module_code = NULL)

{

	$CI = &get_instance();

	if (!empty($uid)) {

		$CI->db->select("*,modules.id AS module_id");

		$CI->db->from('users_groups');

		$CI->db->join('permissions', 'permissions.group_id=users_groups.group_id', 'right');

		$CI->db->join('modules', 'modules.id=permissions.module_id', 'right');

		$CI->db->where('modules.status', 'active');

		$CI->db->where('users_groups.user_id', $uid);

		if (isset($group_id)) {

			// build an array if only one group was passed

			if (!is_array($group_id)) {

				$group_id = array($group_id);

			}

			$CI->db->where_in('users_groups.group_id', $group_id);

			// $CI->db->where('users_groups.group_id',$group_id);	

		}

		if (!empty($module_code)) {

			$CI->db->where('modules.module_code', $module_code);

		}

		//$CI->db->group_by('module_code');



		

		$CI->db->order_by('modules.id', 'ASC');

		$CI->db->order_by('modules.orderno','ASC');

		$query = $CI->db->get();

		//echo $CI->db->last_query();die;

		if ($query->num_rows() > 0) {

			return $query->result();

		} else {

			return false;

		}

	}

}





function getModuleInfo($module_id = NULL)

{

	$CI = &get_instance();

	$CI->db->select("*");

	$CI->db->from("modules");

	$CI->db->where("id", $module_id);

	$query = $CI->db->get();

	//echo $CI->db->last_query(); //die;	

	if ($query->num_rows() > 0) {

		return $query->result();

	} else {

		return false;

	}

}



function authenticateModule($controller,$action)

{

 $CI= &get_instance();

 $allowed_modules=$CI->session->userdata('allowed_modules'); 

 foreach($allowed_modules as $key=>$val){

	 if($key==$controller){

		 foreach($val as $a){

		  if($a==$action){

			return true;

			break;

		  } 

		 }

	 }

  }	

}







function checkPermission($action = NULL)

{

	$CI = &get_instance();

	if (!empty($action)) {



		if ($CI->ion_auth->in_group('admin') != 1) {



			$user_id = $CI->session->userdata('userId');

			$groups = $CI->ion_auth->get_users_groups($user_id)->result();

			if (!empty($groups)) {

				foreach ($groups as $g) {

					$group_id[] = $g->id;

				}

			}

			$controller = $CI->router->fetch_class();



			$modules = getModules($user_id, $group_id, $controller);

			//pr($modules);

			switch ($action) {

				case "create":

					if ($modules[0]->pr_create == 1) {

						return true;

					} else {

						return false;

					}

					break;

				case "edit":

					if ($modules[0]->pr_edit == 1) {

						return true;

					} else {

						return false;

					}

					break;

				case "delete":

					if ($modules[0]->pr_delete == 1) {

						return true;

					} else {

						return false;

					}

					break;

				case "view":

					if ($modules[0]->pr_view == 1) {

						return true;

					} else {

						return false;

					}

					break;

				default:

					return false;

			}

		} else {

			return true;

		}

	}

}





 function getUsersByID($uid=NULL)

  {

	  if(!empty($uid)){

 	 $CI= &get_instance();	

 	 $CI->db->select("id,first_name,last_name,email,phone,locations");

 	 $CI->db->from("users");

 	 $CI->db->where("id",$uid);

	 $CI->db->where("active","1");

	 $query=$CI->db->get();

 	 //echo $CI->db->last_query(); die;

  	 if($query->num_rows()>0){

 	     return $query->result();

	 }else{

 	    return false;	 

 	 }	 

	 }else{

 	    return false;	 

 	 }

  }







function cityName($city_id){

   	$CI= &get_instance();	

	$CI->load->model('city_model');

	$city =$CI->city_model->selectdata("*",array('id'=>$city_id),"ORDER BY id DESC");

 	if(count($city)>0){

	  return $city[0]->name;

	}else{

	  return null;	

	}

}



function countryName($country_id){

   	$CI= &get_instance();	

	$CI->load->model('country_model');

	$country =$CI->country_model->selectdata("*",array('id'=>$country_id),"ORDER BY id DESC");

 	if(count($country)>0){

	  return $country[0]->name;

	}else{

	  return null;	

	}

}

 

 function countrylist(){

 	$CI= &get_instance();

 	$CI->db->select("*");

 	$CI->db->from("country");

 	 $query=$CI->db->get();

 	 //echo $CI->db->last_query(); die;

  	 if($query->num_rows()>0){

 	     return $query->result();

	 }else{

 	    return false;	 

 	 }

 }



   



function author($author_id){

   	$CI= &get_instance();

	$CI->load->model('author_model');

	$auhtor =$CI->author_model->selectdata("*",array('author_id'=>$author_id,'status'=>'active'),"ORDER BY author_id ASC");

	if(count($auhtor)>0){

	  return $auhtor;

	}else{

	  return null;	

	}

}



 



 function getMeta($page_id){

	$CI= &get_instance();

	$CI->db->select("*");

	$CI->db->from('tbl_pagesmeta');

    $CI->db->where('page_id',$page_id); 

 	$CI->db->where('status','active');

	$CI->db->limit(1,0);

	$query=$CI->db->get();

	//echo $CI->db->last_query(); die;

  	 if($query->num_rows()>0){

 	     return $query->result();

	 }else{

 	    return false;	 

 	 }

}

 



 



function getenquirythread($eid){

	$CI = &get_instance();

	$CI->db->select( "tbl_enquiry.*");

	$CI->db->from( 'tbl_enquiry');

	// if (!empty($eid)) {

	// 	$CI->db->where( 'eid', $eid);

	// }

	if (!empty( $eid)) {

		$CI->db->where('parent', $eid);

	}

	//$CI->db->where('status', 'active');

	$query = $CI->db->get();

	return $query->result(); 

}

 

function checkMobileAgent()

{

	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {

		return true;

	} else {

		return false;

	}

}





function getCategory($cat_id=NULL,$parent=NULL){

	$CI = &get_instance();

	$CI->load->model('category_model');

	$condition_array=array();

	$condition_array['status']='active';

	if(!empty($cat_id)){

	  $condition_array['cat_id']=$cat_id;	

	}

	if ($parent!='') {

		$condition_array['parent'] = $parent;

	}

	 return $CI->category_model->selectdata("*", $condition_array, "ORDER BY sort_order ASC,featured ASC,category_name DESC,parent ASC");

}


function searchitems($searchkey=NULL,$limit=NULL){
	$CI=&get_instance();
	
	$CI->db->select('tbl_product.product_name,tbl_product.image_fids,tbl_product.url_slug AS product_url,tbl_category.category_name,tbl_category.url_slug AS category_url');
	$CI->db->from('tbl_product');
	$CI->db->join('tbl_category','tbl_category.cat_id=tbl_product.cat_id');
	$CI->db->where('tbl_product.status','active');
	$CI->db->where('tbl_category.status','active');
	$CI->db->like('tbl_product.product_name',$searchkey);
	$CI->db->or_like('tbl_category.category_name',$searchkey);
	if(!empty($limit)){
		$CI->db->limit($limit, 0);
	}	
	$query = $CI->db->get();
	//echo $CI->db->last_query(); die;
	$r_array=array();
	$r_array['total_count']=$query->num_rows();
	$r_array['result']=$query->result();
	return $r_array;
}


function generateURL(){
	$CI = &get_instance();

	$CI->load->model('product_model');

	$productlist = $CI->product_model->selectdata("*", array(), "ORDER BY pid ASC");

	foreach($productlist as $pl){
		$current_url=$pl->url_slug;
 		$pid=$pl->pid;
		echo $pid.") ".$pl->product_name."    <br>";
 		//Check product url for duplicacy
		$checkproduct = $CI->product_model->selectdata("*", array('url_slug'=>$current_url), "AND pid!=".$pid." ORDER BY pid ASC");
		if(count($checkproduct)>0){
			foreach($checkproduct as $cp){
			 $p_url=$cp->url_slug;
			 $n_pid = $cp->pid;
			 $cat_id = $cp->cat_id;
			 
			 $categorydetails = $CI->category_model->selectdata("category_name,url_slug", array('cat_id' => $cat_id), " ORDER BY cat_id DESC");
			 $cat_url = isset($categorydetails[0]->url_slug) ? $categorydetails[0]->url_slug : '';

			 $new_url=$cat_url."-".$p_url;

			 echo "---------".$n_pid.") ".$new_url."<br>";
			 $column['url_slug']=$new_url;
     		 $CI->product_model->updatedata($column, array('pid' => $n_pid));
 
			}
		}


	}

}


function sendmail($customer_email,$customer_name, $subject, $en_msg){
	$ci = get_instance();
	$ci->load->library('My_PHPMailer');
	$mail = new PHPMailer();

	/* $customer_email='microlinkedin@gmail.com';
	$customer_name="Abhishek";
	$subject="asdasd";
	$en_msg="asas"; */
 
	try {
		$mail->IsHTML(true);
		//$mail->SetFrom($this->dbsettings->COMPLIANCE_ALERT_EMAILS,"Abhishek");
		$mail->SetFrom($customer_email, $customer_name);
		$mail->Subject = $subject;
		$mail->Body = $en_msg;
		$mail->AddAddress($ci->dbsettings->ENQUIRY_EMAIL);
		//$mail->AddAddress('info@acad.co.in.test-google-a.com');				 
		$mail->send();
 
	} catch (phpmailerException $e) {
		echo $e->errorMessage(); //Error from PHPMailer
	} catch (Exception $e) {
		echo $e->getMessage(); //Other error messages
	}

}

function order_making_data($order_id){
	$ci = get_instance();
	$ci->load->model('orders_model');		
 
	$orderdata =$ci->orders_model->selectdata("*",array('id'=>$order_id),"ORDER BY id DESC LIMIT 1");
	if(count($orderdata)>0){
		
 		$data['order_id']=$order_id;
 		$orders=$orderdata[0];
		$data['orders_info'] =$orders;

		//Order Items
		$orders_items = $ci->orders_model->selectitems("*", array('order_id' => $order_id), "ORDER BY id ASC");
		$data['orders_items']= $orders_items;

		//Customer info
		$customer_id = isset($orders->uid) ? $orders->uid : '';
		$customers = $ci->customers_model->selectdata("*", array('id' => $customer_id), "ORDER BY id DESC LIMIT 1");
		$data['customers']=$customers[0];

		//addressinfo
		$address = $ci->users_model->selectorderaddress("*", array('order_id' => $order_id), "ORDER BY id DESC");
		$data['address_info']=$address[0];
 
		return $data;
	}
	   
}

function prepare_order_pdf($order_data, $mode = "") {
	$ci = get_instance();
	$ci->load->library('pdfs');
	$ci->pdfs->setPrintHeader(false);
	$ci->pdfs->setPrintFooter(false);
	$ci->pdfs->SetCellPadding(1.5);
	$ci->pdfs->SetFont('dejavusans', '', 14, '', true);
	$ci->pdfs->setImageScale(1.42);
	$ci->pdfs->AddPage();
	$ci->pdfs->SetFontSize(10);


	if ($order_data) {

		$order_data["mode"] = $mode;

		$html = $ci->load->view("sysadmin/orders/orders_pdf", $order_data, true);
		 if ($mode != "html") {
		 	
			$ci->pdfs->writeHTML($html, true, false, true, false, '');
		}

		//$invoice_info = get_array_value($order_data, "invoice_info");
		$pdf_file_name = "Orders.pdf";

		if ($mode === "download") {
			$ci->pdfs->Output($pdf_file_name, "D");
		} else if ($mode === "send_email") {
			$temp_download_path = getcwd() . "/" . get_setting("temp_file_path") . $pdf_file_name;
			$ci->pdfs->Output($temp_download_path, "F");
			return $temp_download_path;
		} else if ($mode === "view") {
			$ci->pdfs->Output($pdf_file_name, "I");
		} else if ($mode === "html") {
			return $html;
		}
	}
}



