<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends Public_Controller {
   function __construct(){
        parent::__construct();
        $this->load->model('news_model');
        $this->load->model('pagesmeta_model');
     }

   public function index()
   {
		$this->data['extracss']='';
		$this->data['extrajs']='';
		
		$news = $this->news_model->selectdata("*",array('status'=>'active')," ORDER BY date_added DESC");
 		$this->data['news'] = $news;

		//pr($this->data['hospitallist']); die;
		//For static pages (like home,contact us, about us..) fetch meta details from pages meta 
		//ID:3 for news in pagesmeta table.
		$meta=getMeta(10);
 		$this->data['meta_title']=(isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title))?$meta[0]->pagesmeta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc))?$meta[0]->pagesmeta_desc:'';
 		$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
 		$this->render('public/news/news_list');    	 
	}

 
	public function detail($detail=NULL){
		$this->data['extracss']='';
		$this->data['extrajs']='';

  		if(!empty($detail)){
 			$this->data['detail_url'] = $detail;
		
			$newsdetail= $this->news_model->selectdata("*",array('url_slug'=>$detail,'status'=>'active'),"ORDER BY date_added ASC LIMIT 1");  
   	    	$this->data['newsdetail']=$newsdetail[0];  
 
   	    	$meta=$newsdetail;
	 		$this->data['meta_title']=(isset($meta[0]->meta_title) && !empty($meta[0]->meta_title))?$meta[0]->meta_title:'';
	 		$this->data['meta_desc']=(isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc))?$meta[0]->meta_desc:'';
	 		$this->data['h1_tag']=(isset($meta[0]->h1_tag) && !empty($meta[0]->h1_tag))?$meta[0]->h1_tag:'';
	 		$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';
  			$this->render('public/news/news_detail');
		} 
    		   

		
	}


	 
}

