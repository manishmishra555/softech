<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Public_Controller {

   function __construct(){

        parent::__construct();
        $this->load->helper('text');
        $this->load->model('blogcategory_model');
        $this->load->model('author_model');
        $this->load->model('blog_model');
    }



   public function index(){

  		$this->data['extracss']='';

  		$this->data['extrajs']='';
      $page_title="Blog";
       
      $this->data['page_title']=$page_title;
      
      $this->data['total_record'] = $this->blog_model->selectdata("COUNT(*) as total_records",array('status' => 'active'),"ORDER BY blog_id DESC");
      $this->load->library('pagination');
      $config['page_query_string'] = TRUE;
      $config['base_url'] = MAINSITE_URL . 'blog';
      $config['total_rows'] = $this->data['total_record'][0]->total_records;
		  $config['per_page'] = 10;
		  $config["uri_segment"] = 3;
       //$config['use_page_numbers']=true;
      //$config['attributes'] =  array('class' => 'pagination first');
		  $config['full_tag_open'] = '<ul class="pagination2 first">';
      $config['full_tag_close'] = '</ul>';
      $config['first_link'] = false;
      $config['last_link'] = false;
      $config['prev_tag_open'] = '<li>';
      $config['prev_link'] = 'Prev';
      $config['prev_tag_close'] = '</li>';
      $config['next_link'] = 'Next';
      $config['cur_tag_open'] = '<li class="active"><a href="#">';
      $config['cur_tag_close'] = '</a></li>';
      $this->pagination->initialize($config);
      //$page = !empty($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      $page = isset($_GET['per_page']) ? $_GET['per_page'] : 0;

       // echo $page;die;

      $this->data['blogs']= $this->blog_model->selectdata("*",array('status'=>'active'),"ORDER BY blog_id DESC",$page,$config["per_page"]);
      //$this->data['authors']= $this->blog_author_model->selectdata("id,name",array(), "ORDER BY id ASC");

      $this->data['pageing_link'] = $this->pagination->create_links();

      $meta_id = 9;
      $meta = getMeta(0);
      $this->data['meta_title'] = (isset($meta[0]->pagesmeta_title) && !empty($meta[0]->pagesmeta_title)) ? $meta[0]->pagesmeta_title : 'Blog';
      $this->data['meta_desc'] = (isset($meta[0]->pagesmeta_desc) && !empty($meta[0]->pagesmeta_desc)) ? $meta[0]->pagesmeta_desc : '';
      $this->data['h1_text'] = (isset($meta[0]->h1_text) && !empty($meta[0]->h1_text)) ? $meta[0]->h1_text : 'Blog';
      $this->data['additional_tag'] = (isset($meta[0]->additional_tag) && !empty($meta[0]->additional_tag)) ? $meta[0]->additional_tag : '';

      //pr($this->data['blogs']); die;
      $this->render('public/blog/blog_list');
    }
    

    public function page(){
       $this->index(); 
    }



  public function blogdetail($blog_slug=NULL){

    $this->data['page_title'] = 'Blog Detail';
    $this->data['extracss']='';
    $this->data['extrajs']='';

    $blog_slug = !empty($blog_slug)? $blog_slug : $this->uri->segment(2);

    //echo $blog_slug; die;

    $this->data['post']= $this->blog_model->selectdata("*",array('url_slug'=>$blog_slug,'status'=>'active'),"ORDER BY blog_id ASC");
    //$post = $this->data['post'];
    //$postf = $post[0];
    //$author = $this->blog_author_model->selectdata("name",array('id'=>$postf->blog_author_id),"ORDER BY id ASC");
    //$this->data['author'] = $author[0];
    //'url_slug !'=>$blog_slug
    $blog_categ = $this->data['post'][0]->blog_category;
    $this->data['latest']= $this->blog_model->selectdata("*",array('status'=>'active'),"ORDER BY blog_id ASC LIMIT 4");
    $this->data['blog_categ']= $this->blogcategory_model->selectdata("*",array('status'=>'active','bcat_id'=>$blog_categ),"ORDER BY bcat_id ASC LIMIT 1");
    $this->data['allcateg']= $this->blogcategory_model->selectdata("*",array('status'=>'active'),"ORDER BY bcat_id ASC LIMIT 5");

    //pr($this->data['latest']); die;

    $meta = $this->data['post'];
    $this->data['meta_title'] = (isset($meta[0]->meta_title) && !empty($meta[0]->meta_title)) ? $meta[0]->meta_title : '';
    $this->data['meta_desc'] = (isset($meta[0]->meta_description) && !empty($meta[0]->meta_description)) ? $meta[0]->meta_description : '';
    $this->data['h1_text'] = (isset($meta[0]->h1) && !empty($meta[0]->h1)) ? $meta[0]->h1 : '';
    //$this->data['h1_text']='Blog';
    
    if (empty($this->data['post']))
    {
        show_404();
    }
    $this->render('public/blog/blog_detail');

  }  


  

}



