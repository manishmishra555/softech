<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{
 protected $table_name = "tbl_customer";
 protected $table_address = "tbl_address";
 protected $table_order_address = "tbl_order_address";
 
   function __construct()
	 {
        parent::__construct();
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
		 
 function updatedata($column,$cond) {
 	 $this->db->where($cond);
	 $this->db->update($this->table_name,$column);
	 //echo $this->db->last_query();die;
    }
	  
 function deletedata($column,$cond) {
 	$this->db->where($ids);
	 $this->db->delete($this->table_name,$column);
 }
 
 function selectaddress($column, $cond, $search,$start="",$limit=""){
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
	 $sql = "select $column from ".$this->table_address." where 1=1  $condStr $search $limitcond";
	$query_result=$this->db->query($sql);
	$result = $query_result->result();
	return $result;
}

	function selectorderaddress($column, $cond, $search, $start = "", $limit = "")
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
		$sql = "select $column from " . $this->table_order_address . " where 1=1  $condStr $search $limitcond";
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}

	function selectaddressbyid($column, $cond, $search, $start = "", $limit = "")
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
		$sql = "select $column from " . $this->table_address . " where 1=1 $condStr";
		
		$query_result = $this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}

	
}
?>