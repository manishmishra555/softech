<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Public_Controller {

   function __construct(){

        parent::__construct();
		$this->load->model('brand_model');
		$this->load->model('sub_brand_model');
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('brand_model');
		$this->load->model('sub_brand_model');
		$this->load->model('productcolor_model');
		$this->load->model('productsize_model');
		$this->load->model('producttype_model');
		$this->load->model('productshape_model');
		$this->load->model('productmaterial_model');

    }
  
   public function index()
   {
		$this->data['extracss']='';
		$this->data['extrajs']='';
		$this->data['list_type']='';

		$cat_url = $this->uri->segment(2);

		$condition= array('status' => 'active');
		if(!empty($cat_url)){
			$condition['url_slug']=$cat_url;
		}

 		//Category list
		$category = $this->category_model->selectdata("*",$condition, " ORDER BY cat_id DESC");
		$cat_id=isset($category[0]->cat_id)? $category[0]->cat_id : '';

		$this->data['selected_category'] = $category;
		//pr($this->data['selected_category']);
		$productlist='';


		if(!empty($cat_url)){
		//Subcategory List
		if(!empty($hasChild)){
 				 $list = $this->category_model->selectdata("category_name,image_fids,url_slug",array('status'=>'active','parent'=>$cat_id), " ORDER BY sort_order ASC,featured DESC,cat_id ASC");
				 $this->data['list_type']='category';
				 $productlist = $this->product_model->selectdata("pid,product_name,cat_id,image_fids,price,url_slug", array('cat_id' => $cat_id, 'status' => 'active'), "ORDER BY pid ASC");
 				 //echo "Category Block";
  	    }else{
			if (!empty($cat_id)) {			
			   $list= $this->product_model->selectdata("*", array('cat_id'=>$cat_id,'status'=>'active'), "ORDER BY pid ASC");
			   $this->data['list_type'] = 'product';			   
			   //echo "Product Block";
			}			 
		 }

		 $pagename='category_list';
		}else{
			$productlist = $this->product_model->selectdata("pid,product_name,cat_id,image_fids,price,url_slug", array('status' => 'active'), "ORDER BY pid ASC LIMIT 10");
			$list = $category;
			$this->data['list_type']='category';
			$pagename='category_list';
		}

		 $this->data['productlist']=$productlist;
		 $this->data['list']=$list;

 
		//For static pages (like home,contact us, about us..) fetch meta details from pages meta 
		//ID:3 for category in pagesmeta table.
		$meta=$category;
 		$this->data['meta_title']=(isset($meta[0]->meta_title) && !empty($meta[0]->meta_title))?$meta[0]->meta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc))?$meta[0]->meta_desc:'';
 		//$this->data['h1_text']=(isset($meta[0]->h1_text) && !empty($meta[0]->h1_text))?$meta[0]->h1_text:'';
 		//$this->data['additional_tag'] = (isset($meta[0]->additional_tag)&& !empty($meta[0]->additional_tag))?$meta[0]->additional_tag:'';

 		$this->render('public/category/'.$pagename);    	 

	}



	public function getcateg_data()
   {
		$this->data['extracss']='';
		$this->data['extrajs']= '';
 
		$prod_url = $this->uri->segment(2);
		$prod_url1 = $this->uri->segment(3);
		$prod_url2 = $this->uri->segment(4);
		$condition= array('status' => 'active');

 		if (!empty($prod_url)) {		
 		$category = $this->category_model->selectdata("*", $condition, " ORDER BY cat_id DESC");
	

		$cat_data = $this->category_model->selectdata("*",array('status' => 'active','url_slug' => $prod_url), " ORDER BY cat_id ASC");
		$id=isset($cat_data[0]->cat_id)? $cat_data[0]->cat_id : '';
		

 		$colors = $this->productcolor_model->selectdata("*", $condition, " ORDER BY color_id DESC");
 		$size = $this->productsize_model->selectdata("*", $condition, " ORDER BY id DESC");
 		$type = $this->producttype_model->selectdata("*", $condition, " ORDER BY type_id DESC");
 		$shape = $this->productshape_model->selectdata("*", $condition, " ORDER BY id DESC");
 		$material = $this->productmaterial_model->selectdata("*", $condition, " ORDER BY id DESC");
			

			$brands = $this->brand_model->selectdata("*", $condition, " ORDER BY id DESC");
			$this->data['brands'] = $brands;
			$this->data['selected_category'] = $category;
			$this->data['colors'] = $colors;
			$this->data['size'] = $size;
			$this->data['type'] = $type;
			$this->data['shape'] = $shape;
			$this->data['material'] = $material;


			$this->data['total_record'] = $this->product_model->selectdata("count(*) as total_records",array('status' => 'active','cat_id' => $id),"ORDER BY pid DESC");

	 		$this->load->library('pagination');

	 		$config['base_url'] = MAINSITE_URL.'categories/'.$prod_url.'/page/';

			$config['total_rows'] = $this->data['total_record'][0]->total_records;

			$config['per_page'] = RECORD_PER_PAGE;

			$config["uri_segment"] = 4;

	 		$config['attributes'] = array('class' => 'page-link'); 

	 		//$config['use_page_numbers']=true;

			$config['full_tag_open'] = '<nav><ul class="pagination pag_all" style="width:100%;">';

	        $config['full_tag_close'] = '</ul></nav>';

	        $config['first_link'] = false;

	        $config['last_link'] =  false;

	        $config['first_tag_open'] = '<li class="page-item pagination-first">First';

	        $config['first_tag_close'] = '</li>';

	        $config['prev_link'] = '<i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;Prev';

	        $config['prev_tag_open'] = '<li class="page-item pagination-prev">';

	        $config['prev_tag_close'] = '</li>';

	        $config['next_link'] = 'Next&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i>';

	        $config['next_tag_open'] = '<li class="page-item pagination-next">';

	        $config['next_tag_close'] = '</li>';

	        $config['last_tag_open'] = '<li class="page-item pagination-last">Last';

	        $config['last_tag_close'] = '</li>';

	        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';

	        $config['cur_tag_close'] = '</a></li>';

	        $config['num_tag_open'] = '<li class="page-item">';

	        $config['num_tag_close'] = '</li>';


			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

			$this->data['total_product']  = $page;

				$this->data['productlist'] = $this->product_model->selectdata("*",array('status' => 'active','cat_id' => $id),'ORDER BY pid DESC',$page,$config["per_page"]);
				// pr($this->data['productlist']);die;
			$this->data['pageing_link'] = $this->pagination->create_links();

			$this->render('public/category/all_product_list');    	 
			//$this->load->view('public/product/product_detail',$this->data);
		}else{
			//$this->load->view('public/brands/brands_list');	 

		}
			
		    	 
	}

	public function page()

   {

      $this->index();

   }
 

}



