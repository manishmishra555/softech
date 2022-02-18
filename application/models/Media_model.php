<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Media_model extends CI_Model{
protected $table_name = "tbl_files";
	
    function __construct(){
        parent::__construct();
        $this->load->library('session');
		$this->load->library('encrypt');
	}
    
	function updateFiles($column,$cond) {
 	 $this->db->where($cond);
	 $this->db->update($this->table_name,$column);
    }

 
 function getOriginal($ids){
 $file = (array)$this->selectFiles('file_name',array('fid'=>intval($ids)), ' LIMIT 0,1');
  if(!empty($file)){
  return file_exists(UPLOAD_FILES_PATH.$file[0]->file_name)?MAINSITE_URL.'assets/media/'.$file[0]->file_name:false; 
  }
  return false;
 }

function deleteFiles($ids) {
	if(is_array($ids) && count($ids)) {
		$this->db->where_in('fid',implode(",",$ids));
		$this->db->delete($this->table_name);
	}
 }

/*function selectFiles($columns, $condArr, $search) {
	$this->db->select($columns, FALSE);
	$this->db->from($this->table_name);
 	if(!empty($condArr) || $condArr!='') {
	$this->db->where((array)$condArr); }
	if($search!=''){
 	$this->db->where($search,NULL, FALSE);
 	}
 	$query_result = $this->db->get();
	$result = $query_result->result();
	return $result;
}*/

function selectFiles($column, $cond, $search){
		$condStrArr = array();;
 		if(is_array($cond) && count($cond)){
 			foreach($cond as $ind=>$val) {
 				$condStrArr[] = "$ind='".$val."'";
 			}
 		}
 		$condStr = implode(" and ", $condStrArr);
 		if(count($condStrArr)){
                     $condStr="and ".$condStr;  
 		}
 		$sql = "select $column from ".$this->table_name." where 1=1  $condStr $search";
        $query_result=$this->db->query($sql);
		$result = $query_result->result();
	    return $result;
	}

function selectOriginal($columns,$condArr,$search) {
	return $this->selectFiles($columns, $condArr,$search);
}

function addFiles($column) {
   $this->db->insert($this->table_name, $column);
   return $this->db->insert_id();
}
 
function getThumbPathByFilename($filename,$thumbSize){
  return file_exists(UPLOAD_FILES_PATH.$thumbSize.'/'.$filename)?UPLOAD_FILES_URLPATH.$thumbSize.'/'.$filename:false;
 }

function getThumbPathById($fid,$thumbSize){
  $file = (array)$this->selectFiles('file_name',array('fid'=>intval($fid)), ' LIMIT 0,1');
  if(!empty($file)){
   /*return file_exists(UPLOAD_FILES_PATH.$thumbSize.$file[0]->file_name)?UPLOAD_FILES_URLPATH.$thumbSize.$file[0]->file_name:false; */
   if (!empty(UPLOAD_FILES_PATH.$thumbSize.$file[0]->file_name)) {
     return UPLOAD_FILES_URLPATH.$thumbSize."/".$file[0]->file_name;
   }
   
  }
   return false;
}

function getImageBlock($instanceName,$thumbSize,$fids=array()){
$html = '';
$thumbSizeArr = explode('x',$thumbSize);
if(empty($fids)){return $html;}
$idIns = implode(',',$fids);
$files = (array)$this->selectFiles('file_name,fid,orignal_name',array(),' AND fid IN('.$idIns.') order by fid asc');
foreach($files as $file){
 if(!$this->getThumbPathByFilename($file->file_name,$thumbSize)){continue;}
 $html.='<div class="media-box p-rel"  title="'.strtolower($file->orignal_name).'">';
 $html.= $this->getDeleteMediaBtn();
 $html.='<div class="inner-media-box">';
 $html.='<input class="media-delete-btn" type="hidden" name="'.$instanceName.'[]" value="'.$file->fid.'" />';
 $html.='<img src="'.$this->getThumbPathByFilename($file->file_name,$thumbSize).'" height="'.$thumbSizeArr[1].'" width="'.$thumbSizeArr[0].'" />';
 $html.='</div>';
 $html.='</div>';
 }
 return $html;   
}

function getImageList($instanceName,$thumbSize,$fids=array(),$largeSize=false){
$html = '';
 $thumbSizeArr = explode('x',$thumbSize);
$largeSizeXY  = $largeSize?explode('x',$largeSize):false;
if(empty($fids)){return $html;}
$idIns = implode(',',$fids);
 $files = (array)$this->selectFiles('file_name,fid,orignal_name',array(),' AND fid IN('.$idIns.') order by fid asc');
 
foreach($files as $file){
  if(!$this->getThumbPathByFilename($file->file_name,$thumbSize)){continue;}
  if($largeSizeXY){
    $href = $this->getThumbPathByFilename($file->file_name,$largeSize);
  }else{$href = UPLOAD_FILES_URLPATH.$file->file_name;}
  $html.='<a class="pull-left various fancybox"  title="'.strtolower($file->orignal_name).'" href="'.$href.'" rel="'.$instanceName.'">';
  $html.='<img src="'.$this->getThumbPathByFilename($file->file_name,$thumbSize).'" height="'.$thumbSizeArr[1].'" width="'.$thumbSizeArr[0].'" />';
  $html.='</a>';
 }
 return $html;   
 }
 


function getDeleteMediaBtn(){
 return '<div onclick="deleteVirtualMedia(this)" class="btn  btn-danger p-abs mediadeletebtn"  title="click to delete">Delete</div>';
 }


 
function createThumbNail($handel,$imageQuality,$sizeX,$sizeY){
 $handel->image_resize  = true;
 $handel->image_ratio_fill      = true;
 $handel->jpeg_quality  = $imageQuality;
 $handel->image_x       = $sizeX;
 $handel->image_y       = $sizeY;
 $handel->Process(UPLOAD_FILES_PATH.$sizeX.'x'.$sizeY.'/');
}


 
function availableTumbs(){
 $path   = UPLOAD_FILES_PATH; // path to media folder
  $dirs   = array_filter(glob($path.'*'), 'is_dir');
  $thumbs = array();
  foreach($dirs as $dir){
 	 if(!strstr($dir,DS)){continue;}
 	 $thumbArr = explode(DS,$dir);
 	 $thumbs[$thumbArr[count($thumbArr)-1]] =  $thumbArr[count($thumbArr)-1];
   }
  $thumbs ['orignal image']   = 'orignal image';
  return $thumbs;
 }
	
	
}
?>