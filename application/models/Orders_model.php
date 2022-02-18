<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Orders_model extends CI_Model{
 protected $table_name = "tbl_order";
 protected $items_table = "tbl_order_items";
 protected $status_table = "tbl_order_status";
 protected $tbl_order_address = "tbl_order_address";
 
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
		 
 function updatedata($column,$cond) {
 	 $this->db->where($cond);
	 $this->db->update($this->table_name,$column);
	 //echo $this->db->last_query();die;
    }
	  
 function deletedata($ids) {
 	if(is_array($ids) && count($ids)) {
		$this->db->where_in('id',implode(",",$ids));
		return $this->db->delete($this->table_name);
 	}
 }

 function selectitems($column, $cond, $search,$start="",$limit=""){
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
		$sql = "select $column from ".$this->items_table." where 1=1  $condStr $search $limitcond";
		$query_result=$this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}
 
	function get_order_status_history($column, $cond, $search,$start="",$limit=""){
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
		 $sql = "select $column from ".$this->status_table." where 1=1  $condStr $search $limitcond";
		$query_result=$this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}

	function get_order_addressbyid($column, $cond, $search,$start="",$limit=""){
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
		 $sql = "select $column from ".$this->tbl_order_address." where 1=1  $condStr $search $limitcond";
		$query_result=$this->db->query($sql);
		$result = $query_result->result();
		return $result;
	}



}
?>