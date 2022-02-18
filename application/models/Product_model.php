<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product_model extends CI_Model{
 protected $table_name = "tbl_product";
 protected $subbrand_tbl = "tbl_subbrands";
 protected $brand_tbl = "tbl_brand";
 protected $pro_enquiry = "tbl_productenquiry";
 protected $setting = "tbl_website_setting";

   function __construct()
	 {
        parent::__construct();
	 }
	 
function insertdata($column) {
   $this->db->insert($this->table_name, $column);
   return $this->db->insert_id();
}	
	 
function selectdata($column, $cond, $search,$start="",$limit=""){
	    $limitcond='';
		$condStrArr = array();
 		if(is_array($cond) && count($cond)){
 			foreach($cond as $ind=>$val) {
 				$condStrArr[] = "$ind='".$val."'";
 			}
 		}
 		$condStr = implode(" and ", $condStrArr);
 		if(count($condStrArr)){
             $condStr="and ".$condStr;  
 		}
		if($limit!='' || $start!=''){
			//if($start==''){$start=0;}
			$limitcond=' LIMIT '.$start.','.$limit;
		}
 		$sql = "select $column from ".$this->table_name." where 1=1  $condStr $search $limitcond";
        $query_result=$this->db->query($sql);
		$result = $query_result->result();
	    return $result;
 }

 function selecthotdata($column, $cond, $search,$start="",$limit=""){
	    $limitcond='';
		$condStrArr = array();
 		if(is_array($cond) && count($cond)){
 			foreach($cond as $ind=>$val) {
 				$condStrArr[] = "$ind='".$val."'";
 			}
 		}
 		$condStr = implode(" and ", $condStrArr);
 		if(count($condStrArr)){
             $condStr="and ".$condStr;  
 		}
		if($limit!='' || $start!=''){
			//if($start==''){$start=0;}
			$limitcond=' LIMIT '.$start.','.$limit;
		}
 		$sql = "select $column from ".$this->table_name." where 1=1  $condStr $search $limitcond";
        $query_result=$this->db->query($sql);
		$result = $query_result->result();
	    return $result;
 }
		 
 function updatedata($column,$cond) {

 	 $this->db->where($cond);
	 $this->db->update($this->table_name,$column);
	 //echo $this->db->last_query();die;
    }
	  
 function deletedata($ids) {
 	if(is_array($ids) && count($ids)) {
		$this->db->where_in('pid',implode(",",$ids));
		$this->db->delete($this->table_name);
 	return $this->db->affected_rows();
 	}else{
 		return false;
 	}
 }


	function selectenquiry($column, $cond, $search, $start = "", $limit = "")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind='" . $val . "'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		if ($limit != '' || $start != '') {
			//if($start==''){$start=0;}
			$limitcond = ' LIMIT ' . $start . ',' . $limit;
		}
		$sql = "select $column from " . $this->pro_enquiry . " where 1=1  $condStr $search $limitcond";
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}


	function selectProductsbyid($column, $cond, $search, $start = "", $limit = "")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind='" . $val . "'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		$sql = "select $column from " . $this->table_name . " where 1=1 $condStr";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}
	function getSubbrandSearchData($column, $cond, $search, $start = "", $limit = "3")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind like '%" . $val . "%'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		if($limit!='' || $start!=''){
			//if($start==''){$start=0;}
			$limitcond=' LIMIT '.$limit;
		}
		$sql = "select $column from " . $this->subbrand_tbl . " join ".$this->brand_tbl." on ".$this->brand_tbl.".id=" . $this->subbrand_tbl.".brand_name where 1=1 $condStr $limitcond";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}
	function getBrandSearchData($column, $cond, $search, $start = "", $limit = "2")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind like '%" . $val . "%'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		if($limit!='' || $start!=''){
			//if($start==''){$start=0;}
			$limitcond=' LIMIT '.$limit;
		}
		$sql = "select $column from " . $this->brand_tbl . " where 1=1 $condStr $limitcond";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		
		return $result;
	}
	function getProductSearchData($column, $cond, $search, $start = "", $limit = "5")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind like '%" . $val . "%'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		if($limit!='' || $start!=''){
			//if($start==''){$start=0;}
			$limitcond=' LIMIT '.$limit;
		}
		$sql = "select $column from " . $this->table_name . " where 1=1 $condStr $limitcond";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}

	function getbrands($column, $cond, $search, $start = "", $limit = "")
	{
		$limitcond = '';
		$condStrArr = array();
		if (is_array($cond) && count($cond)) {
			foreach ($cond as $ind => $val) {
				$condStrArr[] = "$ind like '%" . $val . "%'";
			}
		}
		$condStr = implode(" and ", $condStrArr);
		if (count($condStrArr)) {
			$condStr = "and " . $condStr;
		}
		$sql = "select $column from " . $this->setting . " where 1=1 $condStr";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}


}
?>