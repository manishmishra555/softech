<?php
class Website_settings_model extends CI_Model {

	var $tmpreturn=0;
	protected $table_name = "tbl_website_setting";
	
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
		$this->db->delete($this->table_name);
 	}
 }
	
	public function record_count() {
        return $this->db->count_all("tbl_website_setting");
    }
	
	public function fetch_website_settings($limit, $start) {
        $this->db->limit($limit, $start);
		
		if($this->input->post('search')!= "")
		{
		$name = $this->security->xss_clean($this->input->post('name'));
		$this->db->like('var_title', trim($name));
		$this->db->or_like('setting_value', trim($name));
		
		}
			$this->db->order_by('date_added','DESC');
		
        $query = $this->db->get("tbl_website_setting");
 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }
	
	public function get_website_settings($data_id = FALSE)
	{
		if ($data_id === FALSE)
		{
			$query = $this->db->get('tbl_website_setting');
			return $query->result_array();
		}

		$query = $this->db->get_where('tbl_website_setting', array('id' => $data_id));
		return $query->row_array();
	}
	
	public function get_website_settings_name($data_id = FALSE)
	{
		$name = "";
		if ($data_id !== FALSE)
		{
		$this->db->select('var_title');
		$query = $this->db->get_where('tbl_website_setting', array('id' => $data_id));
		if ($query->num_rows() > 0) {
		foreach ($query->result() as $row) {
               $name =  $row->var_title;
        }
		
		}
		return $name;
		}
	}
	
	
	public function createWebsiteSettingsList($data_id="")
	{

		$this_list = '';

		$query = $this->db->get("tbl_website_setting");
        if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
		{
			if($data_id == $row->id)
			{
				$this_list .= "<OPTION value=\"" . $row->id . "\"  selected >" . $row->var_title . "</OPTION>";
			}
			else
			{
				$this_list .= "<OPTION value=\"" . $row->id . "\" >" . $row->var_title . "</OPTION>";
			}	
		}
		}
		}
			
		return $this_list;

	}
	
	public function save_website_settings()
	{
		
		//echo "============". $this->input->post('Submit');
		//exit;
		if ($this->input->post('Submit')=='Submit')
		{
				
			#echo "===============".$this->input->post('data_id');
			#exit;
			if($this->input->post('data_id')=="")
			{	
				$data = array(
				'var_title'=>$this->input->post('var_title'),
				'var_name'=>$this->input->post('var_name'),
				'setting_value'=>$this->input->post('setting_value'),
				'old_setting_value'=>$this->input->post('setting_value'),
				'date_added'=>date('Y-m-d H:i:s'),
				'date_modified'=>date('Y-m-d H:i:s'),
				);
				
				$this->db->insert('tbl_website_setting',$data);
				$ins_id = $this->db->insert_id();
				$this->tmpreturn=1;
				
				$this->session->set_flashdata('message', "<font color=green>Data successfully addded.</font>");
				
				//Record Action Log
				//$this->general_functions->recordActionLog('website_settings','add',$ins_id,$this->flexi_auth->get_user_id(),$this->input->ip_address());
				
			}
			else
			{
				
				$data = array(
				'var_title'=>$this->input->post('var_title'),
				'var_name'=>$this->input->post('var_name'),
				'setting_value'=>$this->input->post('setting_value'),
				'date_modified'=>date('Y-m-d H:i:s'),
				);
				
				$this->db->where('id', $this->input->post('data_id') );
				$this->db->update('tbl_website_setting', $data); 
				$this->tmpreturn=1;
				
				$this->session->set_flashdata('message', "<font color=green>Data successfully updated.</font>");
				
				//Record Action Log
				//$this->general_functions->recordActionLog('website_settings','update',$this->input->post('data_id'),$this->flexi_auth->get_user_id(),$this->input->ip_address());
				
			}	

			return $this->tmpreturn ;

		}
		else
		{
			return $this->tmpreturn ;
		}

   }
	
   public function delete_website_settings($data_id = FALSE)
	{
		if ($data_id !== FALSE)
		{
		$this->db->delete('tbl_website_setting', array('id' => $data_id)); 
		
		//Record Action Log
		//$this->general_functions->recordActionLog('website_settings','delete',$data_id,$this->flexi_auth->get_user_id(),$this->input->ip_address());
		}
	}
	
}
?>