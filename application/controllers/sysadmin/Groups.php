<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Groups extends Admin_Controller

{



    function __construct()

    {

        parent::__construct();
         /*if(!$this->ion_auth->in_group('admin'))

        {

            $this->session->set_flashdata('message','You are not allowed to visit the Groups page');

            redirect('sysadmin','refresh');

        }*/

 		$this->load->model('modules_model');

    }



    public function index()

    {

        $this->data['page_title'] = 'Groups';

		$this->data['extracss']='';

		$this->data['extrajs']='';

		$this->data['modulesname']=$this->modules_model->selectdata("*",array('status'=>'active'),"ORDER BY id DESC");

        $this->data['groups'] = $this->ion_auth->groups()->result();

        $this->render('sysadmin/groups/list_groups_view');

	}



    public function create()

    {

		$response=array();

		$response['token']=$this->security->get_csrf_token_name();

		$response['hash']=$this->security->get_csrf_hash();

        $this->form_validation->set_rules('group_name','Group name','trim|required|is_unique[groups.name]');

        $this->form_validation->set_rules('group_description','Group description','trim|required');

        if($this->form_validation->run()===FALSE)

        {

           	 $response['status']='haserror';

			 $response['error']=validation_errors();

        }

        else

        {

            $group_name = $this->input->post('group_name');

            $group_description = $this->input->post('group_description');

			$column=array();

			$column['default_page']=$this->input->post('default_page');

            $last_id=$this->ion_auth->create_group($group_name, $group_description,$column);

            //Insert Permissions for this group

			$modules=$this->input->post('modulesname[]');

			$mod_id=$this->input->post('modulesid[]');

			if(count($modules)>0){

			 foreach($modules as $key=>$m){

			  $col['group_id']=$last_id;	 

			  $col['modulename']=$m;

			  $col['module_id']=$mod_id[$key];

			  $col['pr_view']=isset($_POST[$m.'_pr_view'])?$this->input->post($m.'_pr_view'):0;

			  $col['pr_create']=isset($_POST[$m.'_pr_create'])?$this->input->post($m.'_pr_create'):0;

			  $col['pr_edit']=isset($_POST[$m.'_pr_edit'])?$this->input->post($m.'_pr_edit'):0;

			  $col['pr_delete']=isset($_POST[$m.'_pr_delete'])?$this->input->post($m.'_pr_delete'):0;

			  $col['date_added']=date('Y-m-d H:i:s');

			  $col['date_modified']=date('Y-m-d H:i:s');

			  $this->db->insert('permissions',$col); 

			 }

			}

 			$this->session->set_flashdata('message',$this->ion_auth->messages());

			$response['status']='success';	

			$response['msg']="Group created successfully.";		

         }

		echo json_encode($response); 

		exit;

    }



    public function edit($group_id = NULL)

    {

        $group_id = $this->input->post('group_id') ? $this->input->post('group_id') : $group_id;

        $this->data['page_title'] = 'Edit group';

 		$this->data['extracss']='';

		$this->data['extrajs']='';

        $this->data['modulesname']=$this->modules_model->selectdata("*",array('status'=>'active'),"ORDER BY id DESC");

		

        $this->form_validation->set_rules('group_name','Group name','trim|required');

        $this->form_validation->set_rules('group_description','Group description','trim|required');

        $this->form_validation->set_rules('group_id','Group id','trim|integer|required');



        if($this->form_validation->run() === FALSE)

        {

            if($group = $this->ion_auth->group((int) $group_id)->row())

            {

                $this->data['group'] = $group;

				//$this->data['permissions']=$this->ion_auth->permissions((int) $group_id)->row();

				//print_r($this->data['permissions']);die;

            }

            else

            {

                $this->session->set_flashdata('message', 'The group doesn\'t exist.');

                redirect('sysadmin/groups', 'refresh');

            }

            $this->render('sysadmin/groups/edit_group_view');

        }

        else

        {

            $group_name = $this->input->post('group_name');

            $group_description = $this->input->post('group_description');

            $group_id = $this->input->post('group_id');

			$column=array();

			$column['group_description']=$group_description;

			$column['default_page']=$this->input->post('default_page');

            $this->ion_auth->update_group($group_id, $group_name, $column);

			//Update Permissions for this group

			$modules=$this->input->post('modulesname');

			$mod_id=$this->input->post('modulesid');

			if(count($modules)>0){

			 foreach($modules as $key=>$m){

			  $col=array();

			  $col['pr_view']=isset($_POST[$m.'_pr_view'])?$this->input->post($m.'_pr_view'):0;

			  $col['pr_create']=isset($_POST[$m.'_pr_create'])?$this->input->post($m.'_pr_create'):0;

			  $col['pr_edit']=isset($_POST[$m.'_pr_edit'])?$this->input->post($m.'_pr_edit'):0;

			  $col['pr_delete']=isset($_POST[$m.'_pr_delete'])?$this->input->post($m.'_pr_delete'):0;			  

			  //print_r($this->checkGroupPermission($group_id,$m));

			  //pr($col)."<br>";

			  if($this->checkGroupPermission($group_id,$m)){

 			   $col['date_modified']=date('Y-m-d H:i:s');

			   $this->db->where(array('group_id' => $group_id,'modulename'=>$m));

			   $this->db->update('permissions',$col); 

			  }else{

			   $col['group_id']=$group_id;	 

			   $col['modulename']=$m; 

			   $col['module_id']=$mod_id[$key];

			   $col['date_added']=date('Y-m-d H:i:s');

			   $col['date_modified']=date('Y-m-d H:i:s');

			   $this->db->insert('permissions',$col); 

 			  }

			 }

			}

            $this->session->set_flashdata('message',$this->ion_auth->messages());

            redirect('sysadmin/groups','refresh');

        }

    }



    public function delete($group_id = NULL)

    {

        if(is_null($group_id))

        {

            $this->session->set_flashdata('message','There\'s no group to delete');

        }

        else

        {

            $this->ion_auth->delete_group($group_id);

            $this->session->set_flashdata('message',$this->ion_auth->messages());

        }

        redirect('sysadmin/groups','refresh');

    }

	

	public function checkGroupPermission($group_id=NULL,$modulename=NULL){

	 if(!empty($group_id) && !empty($modulename)){	

	  $perm = $this->db->get_where('permissions', array('group_id' => $group_id,'modulename'=>$modulename))->row();

 	  if(!empty($perm))

	  {

 		return TRUE;

	  }else{

		return FALSE;  

	  }

	 }

	}

	

}