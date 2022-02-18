<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends Public_Controller {

   function __construct(){

        parent::__construct();

		$this->load->model('category_model');

		$this->load->model('product_model');
		$this->load->model('brand_model');

    }



   public function index()

   {

		$this->data['extracss']='';

		$this->data['extrajs']= '';



 		 

		$searchkey=isset($_GET['searchkey'])?$this->input->get('searchkey'):'';



		if(!empty($searchkey)){

			$searchresults=searchitems($searchkey);

			$this->data['searchresults']=$searchresults['result'];
			$this->data['total_count']=$searchresults['total_count'];
 			$this->data['searchkey']=$searchkey;

			$this->render('public/search/search_result');

		}else{

			redirect('');

		}

		  

		    	 

	}





	 public function searchajax(){

		

		$response=array();

		$response['data']=array();

		$searchkey = isset($_GET['searchkey']) ? $this->input->get('searchkey') : '';



		if (!empty($searchkey)) {

			$searchresults = searchitems($searchkey);
			$response['data']=$searchresults['result'];
			$response['total_count']=$searchresults['total_count'];

			echo json_encode($response,JSON_PRETTY_PRINT);

 		}

	 }




	function filterItem(){ 
		$sqlQuery = '';
		if(isset($_POST["brand"])) {
			$brandFilterData = implode("','", $_POST["brand"]);
			$sqlQuery .= "
			AND brand_name IN('".$brandFilterData."')";
		}
		if(isset($_POST["category"])){
			$categoryFilterData = implode("','", $_POST["category"]);
			$sqlQuery .= "
			AND cat_id IN('".$categoryFilterData."')";
		}
		if(isset($_POST["color"])){
			$colorFilterData = implode("','", $_POST["color"]);
			$sqlQuery .= "
			AND frame_color IN('".$colorFilterData."')";
		}
		if(isset($_POST["frame_type"])){
			$frame_typeFilterData = implode("','", $_POST["frame_type"]);
			$sqlQuery .= "
			AND product_type IN('".$frame_typeFilterData."')";
		}
		if(isset($_POST["gender"])){
			$genderFilterData = implode("','", $_POST["gender"]);
			$sqlQuery .= "
			AND gender IN('".$genderFilterData."')";
		}
		if(isset($_POST["frame_size"])){
			$genderFilterData = implode("','", $_POST["frame_size"]);
			$sqlQuery .= "
			AND frame_size IN('".$genderFilterData."')";
		}
		if(isset($_POST["frame_shape"])){
			$genderFilterData = implode("','", $_POST["frame_shape"]);
			$sqlQuery .= "
			AND frame_shape IN('".$genderFilterData."')";
		}
		if(isset($_POST["frame_material"])){
			$genderFilterData = implode("','", $_POST["frame_material"]);
			$sqlQuery .= "
			AND material IN('".$genderFilterData."')";
		}
		$product_data = '';
		$filter_data= $this->product_model->selectdata("*", array('status' => 'active'), "$sqlQuery order by rand() LIMIT 30");  
		if(count($filter_data)>0){
        	foreach ($filter_data as $sb) {
        		 $col=array();
        		 $brand_id=$sb->brand_name;
        		 $brand_data= $this->brand_model->selectdata("*", array('status' => 'active','id' => $brand_id), " order by id DESC");  
        		 if(count($brand_data)>0){
		        	foreach ($brand_data as $bd) {
		        		$brand_name = $bd->brand_name;
		        		$brand_url_slug = site_url('brands/'.$bd->url_slug);
		        	}
		        }else{
		        	$brand_name = 'Unknown';
		        }
        		 $product_name=$sb->product_name;
        		 $mrp=$sb->mrp;
        		 $price=$sb->price;
        		 $pid=$sb->pid;
        		 $url_product=site_url('product/') . $sb->url_slug;
        		 $PImages = json_decode($sb->image_fids);
                 $image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '600x800/') : FRONT_ASSETS_PATH . "images/tuoren_noproduct.png";

                 $key_f = '';
                $cart = getCart();

                if (count($cart['products']) > 0) {
                    foreach ($cart['products'] as $pr) { 
                        if ($pr['itemid'] == $pid) {
                            $key_f = $pr['itemid'];
                          }
                    }
                }

                $p_size = explode(',',$sb->frame_size);
                $p_color = explode(',',$sb->frame_color);
                $p_shape = explode(',',$sb->frame_shape);
        		 
        		 $product_data .= '<div class="col-sm-4">
                                    <div class="product-shortcode style-1 pros_page">                                        
                                        <div class="preview">
                                            <img src="'.$image.'" alt="">
                                        </div>                                        
                                        <div class="title">
                                            <div class="simple-article size-1 color col-xs-b5 bran_name"><a href="'.$brand_url_slug.'">'.$brand_name.'</a></div>';
                                            if($this->session->has_userdata('userId')){
                                               $product_data .='<div class="price">
                                                    <div class="simple-article size-4"><span class="color">₹'.$price.'</span>&nbsp;&nbsp;&nbsp;<span class="line-through">₹'.$mrp.'</span></div>
                                                </div>';
                                            }
                                            $product_data .='<div class="h6 animate-to-green"><a href="'.$url_product.'">'.$product_name.'</a></div>
                                        </div>
                                        <div class="btn_cart001 btn_middle valign-middle-content cartblk_'.$pid.'">';
                                           if ($key_f == $pid) {
                                            $product_data .='<a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem('.$pid.');">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="'. FRONT_ASSETS_PATH.'img/icon-3.png" alt=""></span>
                                                    <span class="text">Remove from Cart</span>
                                                </span>
                                            </a>';
                                            }else{
                                                $product_data .='<a class="button size-2 style-3" href="javascript:void(0);" onclick="addToCartItem('.$pid.','.$p_size[0].','.$p_color[0].','.$p_shape[0].');">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="'.FRONT_ASSETS_PATH.'img/icon-3.png" alt=""></span>
                                                        <span class="text">Add To Cart</span>
                                                    </span>
                                                </a>';
                                            }
                                        $product_data .='</div>
                                    </div>  
                                </div>';

        	}
        }
        echo json_encode($product_data);
    }
 

 

	 





	 

}



