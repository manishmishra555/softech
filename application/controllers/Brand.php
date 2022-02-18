<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends Public_Controller {

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

		$brand_url = $this->uri->segment(2);
		$condition= array('status' => 'active');
		

 		//brand list
		$brand = $this->brand_model->selectdata("*",$condition, " ORDER BY sort_no ASC");
		$id=isset($brand[0]->id)? $brand[0]->id : '';

		$this->data['selected_brand'] = $brand;

		$brandslist='';


		if(!empty($brand_url)){ 

 				 $list = $this->brand_model->selectdata("brand_name,image_fids,url_slug",array('status'=>'active','parent'=>$id), " ORDER BY sort_no ASC");
				 $this->data['list_type']='brand';
				 $brandslist = $this->product_model->selectdata("pid,product_name,image_fids,price,url_slug", array('id' => $id, 'status' => 'active'), "ORDER BY pid ASC"); 	

		 $pagename='brands';
		}else{
			$brandslist = $this->brand_model->selectdata("brand_name,image_fids,url_slug",array('status'=>'active','id'=>$id), " ORDER BY sort_no ASC");
			$list = $brand;
			$this->data['list_type']='brand';
			$pagename='brands_list';
		}

		 $this->data['brandslist']=$brandslist;
		 $this->data['list']=$list;
		 $this->data['page']='Brands';

 
		$meta=$brand;
 		$this->data['meta_title']=(isset($meta[0]->meta_title) && !empty($meta[0]->meta_title))?$meta[0]->meta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc))?$meta[0]->meta_desc:'';
 	

 		$this->render('public/brands/'.$pagename);    	 

	}
 	function getBrandsData(){
        
        //Get product data by ID
        $response = array();
        $response['data']='';
        $prod_url = $this->uri->segment(2);

        $product_data= $this->brand_model->selectdata("*", array('url_slug'=>$prod_url), " ORDER BY sort_no ASC");    
        $response['data'] = $product_data;       
       
        echo json_encode($response);
    }

    public function getsubbrand_data()
   {
		$this->data['extracss']='';
		$this->data['extrajs']='';
		$this->data['list_type']='';

		$brand_url = $this->uri->segment(2);
		$condition= array('status' => 'active','url_slug' => $brand_url);
		

 		//brand list
		$brand = $this->brand_model->selectdata("*",$condition, " ORDER BY id ASC");
		$id=isset($brand[0]->id)? $brand[0]->id : '';
		$brand_n=isset($brand[0]->brand_name)? $brand[0]->brand_name : '';

		$this->data['selected_brand'] = $brand;

		$brandslist='';


		if(!empty($brand_url)){ 

 				 $list = $this->sub_brand_model->selectdata("brand_name,sub_brand_name,image_fids,url_slug",array('status'=>'active','brand_name'=>$id), " ORDER BY sub_brand_name ASC");
				 $this->data['list_type']='brand';

		 $pagename='sub_brands';
		}else{
			$brandslist = $this->brand_model->selectdata("brand_name,image_fids,url_slug",array('status'=>'active','id'=>$id), " ORDER BY id sort_no ASC");
			$list = $brand;
			$pagename='brands_list';
		}

		 $this->data['brandslist']=$brandslist;
		 $this->data['list']=$list;
		 $this->data['page']='Brands';
		 $this->data['brand_name']=$brand_n;

 
		$meta=$brand;
 		$this->data['meta_title']=(isset($meta[0]->meta_title) && !empty($meta[0]->meta_title))?$meta[0]->meta_title:'';
 		$this->data['meta_desc']=(isset($meta[0]->meta_desc) && !empty($meta[0]->meta_desc))?$meta[0]->meta_desc:'';
 	

 		$this->render('public/brands/'.$pagename);   
			
		    	 
	}



	public function getbrand_data()
   {
		$this->data['extracss']='';
		$this->data['extrajs']= '';
 
		$prod_url = $this->uri->segment(2);
		$prod_url1 = $this->uri->segment(3);
		$prod_url2 = $this->uri->segment(4);
		$condition= array('status' => 'active');
		
		 
 		if (!empty($prod_url) && !empty($prod_url1)) {		
 		$category = $this->category_model->selectdata("*", $condition, " ORDER BY cat_id DESC");
		
		$brand = $this->brand_model->selectdata("*",array('status' => 'active','url_slug' => $prod_url), " ORDER BY id ASC");
		$id=isset($brand[0]->id)? $brand[0]->id : '';

 		$u_slu = strtolower($prod_url)."/".$prod_url1;
 		$brand_detail= $this->sub_brand_model->selectdata("*", array('url_slug'=> $u_slu,'brand_name'=> $id,'status'=>'active'), "ORDER BY id DESC");

		if(empty($brand_detail)){			
			$subbrand_name = 99999;
		}else{
			$subbrand_name = $brand_detail[0]->id;
		}

 		$colors = $this->productcolor_model->selectdata("*", $condition, " ORDER BY color_id ASC");
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



			$this->data['total_record'] = $this->product_model->selectdata("count(*) as total_records",array('status' => 'active','brand_name' => $id,'subbrand' => $subbrand_name),"ORDER BY pid DESC");

	 		$this->load->library('pagination');

	 		$config['base_url'] = MAINSITE_URL.'brands/'.$prod_url.'/'.$prod_url1.'/page/';

			$config['total_rows'] = $this->data['total_record'][0]->total_records;

			$config['per_page'] = RECORD_PER_PAGE;

			$config["uri_segment"] = 5;

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
			$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
			
			$this->data['total_product']  = $page;

				$this->data['productlist'] = $this->product_model->selectdata("*",array('status' => 'active','brand_name' => $id,'subbrand' => $subbrand_name),'ORDER BY pid DESC',$page,$config["per_page"]);
				//pr($this->data['productlist']);die;
			$this->data['pageing_link'] = $this->pagination->create_links();

			$this->render('public/brands/all_product_list');    	 
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



