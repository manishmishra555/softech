<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Privacypolicy extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
    }

   public function index()
   {
	    $this->data['page_title'] = 'Privacy policy';
		$this->data['extracss']='';
		$this->data['extrajs']='';
		$this->data['privacy'] = $this->pages_model->selectdata("*",array('pages_id'=>'4','status'=>'active'),"ORDER BY pages_id DESC");
 		$this->render('public/page/privacypolicy');
	}
}

