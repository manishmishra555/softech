<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends Admin_Controller {
	function __construct() 
    {
        parent::__construct();
 		$this->load->library('upload');
		$this->load->model('media_model');
     }
	/*public function index()
	{		
		$data['page_title']="Dashboard";
		$data['page_heading']="Dashboard";
		$this->load->view('sysadmin/dashboard');
	}*/
	
	public function upload(){
 //if($this->is_adminLogedIn() || isset($_SESSION['USER_ID'])){return true;}else{die;}
    $response = array();

	if($_FILES['media']['tmp_name']){
 	$handle = new Upload($_FILES['media']);
     // then we check if the file has been uploaded properly
     // in its *temporary* location in the server (often, it is /tmp)
     if ($handle->uploaded) {

        // yes, the file is on the server

        // below are some example settings which can be used if the uploaded file is an image.

		$handle->file_safe_name = true;
		$handle->file_force_extension = false;
		// $handle->image_resize          = true;
		// $handle->image_ratio_fill      = true;
        $handle->allowed = array('image/*');
         // now, we start the upload 'process'. That is, to copy the uploaded file
         // from its temporary location to the wanted location
         // It could be something like $handle->Process('/home/www/my_uploads/');

        $handle->Process(UPLOAD_FILES_PATH);

        if ($handle->processed) {

		   /*create thumbnail*/

		     $rhandel = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name); /*do not change*/
			 $this->media_model->createThumbNail($rhandel,75,195,115); /*do not change*/

			 $rhande2 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name); /*do not change*/
			 $this->media_model->createThumbNail($rhande2,50,65,49); /*do not change*/

			 $rhande3 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name);/*Certificates*/
		     $this->media_model->createThumbNail($rhande3,100,56,36);/*do not change*/
			 
 			 $rhande4 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name);//Homepage Banner
		     $this->media_model->createThumbNail($rhande4,80,1820,810);
			  
		     $rhande5 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name);//Brand Image Size
		     $this->media_model->createThumbNail($rhande5,80,386,300); 

		     $rhande6 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name);//Category Image Size
			 $this->media_model->createThumbNail($rhande6,80,530,205);

		     $rhande6 = new upload(UPLOAD_FILES_PATH.$handle->file_dst_name);//Product Image Size Product Page
			 $this->media_model->createThumbNail($rhande6,80,600,800);
			 
			 $rhande7 = new upload(UPLOAD_FILES_PATH . $handle->file_dst_name); //Banner Image Size
			 $this->media_model->createThumbNail($rhande7, 100, 1828, 632); 

			 $rhande8 = new upload(UPLOAD_FILES_PATH . $handle->file_dst_name); //Product slider image thumbs
			 $this->media_model->createThumbNail($rhande8, 100, 339, 158); 

			 $rhande9 = new upload(UPLOAD_FILES_PATH . $handle->file_dst_name); //Blog image Detail
			 $this->media_model->createThumbNail($rhande9, 100, 900, 411); 

			 $rhande10 = new upload(UPLOAD_FILES_PATH . $handle->file_dst_name); //Blog image thumbs
			 $this->media_model->createThumbNail($rhande10, 100, 300, 137); 

		   /*Insert file record into data base*/
		     $column   = array();
			 $column['uid']          = isset($_SESSION['USER_ID'])?$_SESSION['USER_ID']:1;
			 $column['file_name']    = $handle->file_dst_name;
			 $column['orignal_name'] = $_FILES['media']['name'];
			 $column['mime_type']    = $handle->file_src_mime;
			 $column['file_size']    = $handle->file_src_size;
			 $column['file_uri']     = MAINSITE_URL.'assets/media/'.$handle->file_dst_name;
			 $column['file_dir']     = UPLOAD_FILES_PATH.$handle->file_dst_name;
			 $column['created']      = time();
			 $this->media_model->addFiles($column); 
		     $response['status']     = 'sucess';
		     //$this->setMsg('File "'.$_FILES['media']['name'].'" uploaded successfully and available in uploaded media tab.','success',false);
			 $msg = 'File "'.$_FILES['media']['name'].'" uploaded successfully and available in uploaded media tab.';
		     $this->session->set_flashdata('msg', $msg);
		     $response['msg']        = $msg;

			 /*show preview if available*/
			 if(file_exists(UPLOAD_FILES_PATH.'65x49'."/".$handle->file_dst_name)){
      			 $response['preview']    = '<img class="uploader-preview" src="'.UPLOAD_FILES_URLPATH.'65x49/'.$handle->file_dst_name.'" height="49" width="65">';
 			 }

             echo json_encode($response);
 		     exit;
 		}else{

		  $response['status'] = 'error';

		  //$this->setMsg($_FILES['media']['name'].' is invalid file please upload valid file(s).','error',false);
		  $msg = 'File "'.$_FILES['media']['name'].'" is invalid file please upload valid file(s).';
		  $this->session->set_flashdata('msg', $msg);
 		  $response['msg']    = $msg;

		  echo json_encode($response);

          exit;

		}
   }
 }

}

function upload_via_url(){
 //$this->is_adminLogedIn();
 $error = '';
$url = trim($_POST['url']);
if($url=='' && $error==''){$error = 'Please enter url.';}
$imageName = basename($url);
if($imageName=='' && $error==''){$error = 'Invalid url.';}
if(strstr($url,'https') && $error ==''){$error = 'Image can not be loaded via secure url(https).';}
$allowed = array('jpg','jpeg','png','gif');
$ext = pathinfo($imageName);
$fileNameFromUrl = preg_replace("/[^a-zA-Z0-9]+/", "", $ext['filename']); //sanitize file name
if(!in_array($ext['extension'],$allowed)){$error = 'Invalid image.';}
if($error == ''){
  $FileName = is_file(UPLOAD_FILES_PATH.$fileNameFromUrl.'.'.$ext['extension'])?$fileNameFromUrl.time().'.'.$ext['extension']:$fileNameFromUrl.'.'.$ext['extension'];
  $upload = file_put_contents(UPLOAD_FILES_PATH.$FileName,file_get_contents($url));
  $this->loadHelper('upload',false);
  $rhandel = new upload(UPLOAD_FILES_PATH.$FileName);
  $this->media_model->createThumbNail($rhandel,75,195,115); /*do not change*/
  
  $rhande2 = new upload(UPLOAD_FILES_PATH.$FileName);
  $this->media_model->createThumbNail($rhande2,50,65,49); /*do not change*/

  $rhande3 = new upload(UPLOAD_FILES_PATH.$FileName);
  $this->media_model->createThumbNail($rhande3,100,56,36);/*do not change*/

    $column   = array();
    $column['uid']          = 1;
    $column['file_name']    = $FileName;
    $column['orignal_name'] = $ext['basename'];
    $column['mime_type']    = $rhandel->file_src_mime;
    $column['file_size']    = $rhandel->file_src_size;
    $column['file_uri']     = MAINSITE_URL.'assets/media/'.$FileName;
    $column['file_dir']     = UPLOAD_FILES_PATH.$FileName;
    $column['created']      = time();
    $this->media_model->addFiles($column); 
	$msg = 'Image uploaded successfully and available in uploaded tab.';
    $this->session->set_flashdata('msg', $msg);
    echo $msg;
    exit;
 }else{
   $this->session->set_flashdata('msg', $error);
   echo $error;
   exit;
 }
}

function delete(){
$response = array();
$deletedIds='';
if($_POST['formsubmit']=='yes'){
  $error = '';
  if(count($_POST['fid'])<=0 && $error==''){
      $response['status'] = 'error';
  		  $msg = 'Invalid delete request';
		  $this->session->set_flashdata('msg', $msg);
 		  $response['msg']    = $msg;
	  echo json_encode($response);
	  exit;
  }
  
  /*find these ids in database*/
   // $fids = ((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], implode(',',$_POST['fid'])) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""));
	$fids=implode(',',$_POST['fid']);
    $media = $this->media_model->selectFiles('*',array(),' and fid in('.$fids.')');
 
 	if(count($media)<=0 && $error==''){
      $response['status'] = 'error';
	  $this->session->set_flashdata('msg', "<font color='white'>Request file not found.</font>");
 	  $response['msg']    = 'Request file not found.';
	  echo json_encode($response);
	  exit;
  }  foreach($media as $file){
      /*delete all media file of same name*/

	    $this->deleteAllmedia($file->file_name);

	  /*Delete database record*/
	    $this->media_model->deleteFiles(array($file->fid));
		$deletedIds.= '#media-box-'.$file->fid.',';
  }
	
  $response['status'] = 'success';
  $this->session->set_flashdata('msg', "<font color='white'>'File ".$media[0]->file_name." deleted successfully.</font>");
   $response['msg']    = "File  ".$media[0]->file_name." deleted successfully";
  $response['total'] = count($media);
  $response['fid']    = rtrim($deletedIds,',');
  echo json_encode($response);
  exit;
}

$response['status'] = 'error';
$msg = 'Invalid delete request or file is not available';
$this->session->set_flashdata('msg', $msg);
$response['msg']    = $msg;

echo json_encode($response);
exit;
  
}
function deleteAllmedia($mediaName,$direcoty=''){

$thumbs = (array)$this->media_model->availableTumbs();

$return = false;
if($mediaName==''){return $return;}

//delete image from all thumbs folder

foreach($thumbs as $thumbDir){

	if(file_exists(UPLOAD_FILES_PATH.$thumbDir."/".$mediaName)){

	 unlink(UPLOAD_FILES_PATH.$thumbDir."/".$mediaName);

	 $return = true;

	}

}
//delete orignal image

if(file_exists(UPLOAD_FILES_PATH.$mediaName)){
 	 unlink(UPLOAD_FILES_PATH.$mediaName);
 	 $return = true;
 }
 return $return;

}

function iframe_media(){
$this->load->view('sysadmin/media/iframe-media');
}

function gallery(){
//$this->load->model('sysadmin/media_model');
 $mediaModel = $this->media_model;
 $data['model_obj'] = $this->media_model;
if(1==1){
  /*get all uploaded media */
    $data['medias']     = $mediaModel->selectFiles('*',array(),' order by fid desc');
	$data['mediasT']    = $mediaModel->selectFiles('count(fid) as total',array(),'');
 }else{
  $uid = intval($_SESSION['USER_ID']);
/*get all uploaded media by individual user */
    $data['medias']     = $mediaModel->selectFiles('*',array('uid'=>$uid),' order by fid desc');
	$data['mediasT']   = $mediaModel->selectFiles('count(fid) as total',array('uid'=>$uid),'');
}

$this->load->view('sysadmin/media/gallery',$data);
}

 

	
}
