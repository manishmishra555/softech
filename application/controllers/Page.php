<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('pages_model');
        //$this->load->model('team_model');        
        $this->load->model('faq_model');        

   }

   public function index()
   {
	    $this->data['page_title'] = 'About us';
		$this->data['extracss']='';
		$this->data['extrajs']='';
 		$this->data['aboutus'] = $this->pages_model->selectdata("*",array('pages_id'=>'2','status'=>'active'),"ORDER BY pages_id DESC LIMIT 1");
		$this->data['page_url'] = 'aboutus';
		//$this->data['whytravel'] = $this->pages_model->selectdata("*",array('pages_id'=>'2','status'=>'active'),"ORDER BY pages_id DESC");
		//pr($this->data['whytravel']); die;
		$meta = getMeta(0);
		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : '';
		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
		$this->render('public/pages/aboutus');
	}
	
	public function privacy()
   {
	    $this->data['page_title'] = 'Privacy Policy';
		$this->data['extracss']='';
		$this->data['extrajs']='';
 		$this->data['aboutus'] = $this->pages_model->selectdata("*",array('pages_id'=>'2','status'=>'active'),"ORDER BY pages_id DESC LIMIT 1");
		$this->data['page_url'] = 'aboutus';
		//$this->data['whytravel'] = $this->pages_model->selectdata("*",array('pages_id'=>'2','status'=>'active'),"ORDER BY pages_id DESC");
		//pr($this->data['whytravel']); die;
		$meta = getMeta(0);
		$this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : '';
		$this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
		$this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : '';
		$this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';
		$this->render('public/pages/privacy-policy');
	}

	public function careers()
	{
		$this->data['page_title'] = 'Career';
		$this->data['extracss'] = '';
		$this->data['extrajs'] = '';
		//$this->data['aboutus'] = $this->pages_model->selectdata("*", array('pages_id' => '1', 'status' => 'active'), "ORDER BY pages_id DESC LIMIT 1");
		$this->data['page_url'] = 'career';
		//$this->data['whytravel'] = $this->pages_model->selectdata("*",array('pages_id'=>'2','status'=>'active'),"ORDER BY pages_id DESC");
		//pr($this->data['whytravel']); die;
		$this->render('public/pages/career');
	}


   public function faq()
   {
	    $this->data['page_title'] = 'FAQ';
		$this->data['extracss']='';
		$this->data['extrajs']='<script type="text/javascript" src="'.FRONT_ASSETS_PATH.'js/smk-accordion.js"></script><script type="text/javascript">(function($){"use strict";$(document).ready(function(){$(".accordion").smk_Accordion({closeAble:!0})})})(jQuery);</script>';
		$this->data['faq']=$this->faq_model->selectdata("*",array('status'=>'active'),"ORDER BY faq_id ASC");
 		 
		$pagecontent= $this->pages_model->selectdata("*",array('pages_id'=>1,'status'=>'active'),"ORDER BY pages_id DESC LIMIT 1");
 		$this->data['pagecontent'] = $pagecontent[0];

		$meta=$pagecontent;
 		$this->data['meta_title']=(isset($meta[0]->meta_title) && !empty($meta[0]->meta_title))?$meta[0]->meta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc))?$meta[0]->meta_desc:'';
 		$this->data['h1_tag']=(isset($meta[0]->h1_tag) && !empty($meta[0]->h1_tag))?$meta[0]->h1_tag:'';
 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
		//pr($this->data['whytravel']); die;
		$this->render('public/pages/faq'); 
	}

 
	 
}

