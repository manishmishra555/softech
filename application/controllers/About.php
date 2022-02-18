<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class About extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
    }

   public function index(){
	    $this->data['page_title'] = 'About us';
		$this->data['extracss']='';
		$this->data['extrajs']= '<script src="'.FRONT_ASSETS_PATH.'js/validate.js"></script>';

		$meta=getMeta(6);
 		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
 		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
 
  		$this->render('public/pages/aboutus');
	}


}

