 <?php
 
    $pid = $detail->pid;
    $cat_id = $detail->cat_id;
    $name = $detail->product_name;
    $PImages = json_decode($detail->image_fids);
    $image1=$this->media->getThumbPathById($PImages[0],'600x800/');
    $mrp_pr = $detail->mrp;
    $price = $detail->price;
    $pdetails = $detail->product_desc;
    $psize = $detail->frame_size;
    $pcolor = $detail->frame_color;
    $pmaterial = $detail->material;
    $pshape = $detail->frame_shape;

    $brand_data = $this->db->get_where('tbl_brand',array('id ' => $detail->brand_name))->result();
                                    
    $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
    

    $key_f = '';
    $cart = getCart();

    if (count($cart['products']) > 0) {
        foreach ($cart['products'] as $pr) { 
            if ($pr['itemid'] == $pid) {
                $key_f = $pr['itemid'];
              }
        }
    }

    ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?>
<style type="text/css">
      .pos-center {
  display: block;
  margin-left: auto;
  margin-right: auto;width: 80%;
}
.color-selection{
    font-size: 10px;
}
.demo-img {
  width: 400px;
  height: 300px;
  border-radius: 5px;
}

.descrip {
  font-size: 15px;
  line-height: 0;
  color: #D66A00;
}

.code-view {
  width: 245px;
  font-size: 14px;
}
.color-selection.size-1 .entry{
    margin: unset;margin-bottom: 10px;
}
.color-selection label{
    margin-bottom: 10px;
    padding-left: 3px;
    padding-right: 10px;
    }
    </style>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.css'>

</head>

<body class="template-color-1 font-family-02">

    <div class="main-wrapper wrapper-boxed_layout">
        <div class="container products_conts">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
                <a href="#">home</a>
                <a href="#">Products</a>
                <a href="#"><?= $name; ?></a>
            </div>
            <div class="empty-space col-xs-b15 col-sm-b50 col-md-b50"></div>
            <div class="row">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-sm-6 col-xs-b30 col-sm-b0">
                            
                            <div class="main-product-slider-wrapper swipers-couple-wrapper">
                                <div class="swiper-container swiper-control-top">
                                   <div class="swiper-button-prev hidden"></div>
                                   <div class="swiper-button-next hidden"></div>
                                   <div class="swiper-wrapper">
                                    <?php $i = 1; foreach ($PImages as $kimg) {
                                            $image1=$this->media->getThumbPathById($kimg,'600x800/'); ?>
                                       <div class="swiper-slide">
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="product-big-preview-entry swiper-lazy imglist">
                                                <a href="<?= $image1; ?>" data-fancybox="images">
                                                <img src="<?= $image1; ?>" class="demo-img-<?php echo $i; ?> pos-center" >
                                                </a>
                                            </div>
                                       </div>
                                       
                                   <?php $i++; } ?>
                                   </div>
                                </div>




                                <div class="empty-space col-xs-b30 col-sm-b60"></div>

                                <div class="swiper-container swiper-control-bottom" data-breakpoints="1" data-xs-slides="3" data-sm-slides="3" data-md-slides="4" data-lt-slides="4" data-slides-per-view="5" data-center="1" data-click="1">
                                   <div class="swiper-button-prev hidden"></div>
                                   <div class="swiper-button-next hidden"></div>
                                   <div class="swiper-wrapper">
                                    <?php foreach ($PImages as $kimg) {
                                            $image1=$this->media->getThumbPathById($kimg,'386x300/'); ?>

                                       <div class="swiper-slide">
                                            <div class="product-small-preview-entry">
                                                <img src="<?= $image1; ?>" alt="" />
                                            </div>
                                        </div>
                                    <?php } ?>

                                   </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="modal fade" id="swiper_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body modal_slider">
                                  <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php $i = 1; foreach ($PImages as $kimg) {
                                            $image1=$this->media->getThumbPathById($kimg,'600x800/'); ?>
                                      <div class="swiper-slide"><a href="<?= $image1; ?>" target="_blank"><img src="<?= $image1; ?>" class="pos-center" ></a></div>
                                      <?php } ?>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                  </div>
                                  <script>
                                    var swiper = new Swiper('.swiper-container', {
                                      navigation: {
                                        nextEl: '.swiper-button-next',
                                        prevEl: '.swiper-button-prev',
                                      },
                                    });
                                  </script>
                              
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 div_pros_inf">
                            <div class="simple-article size-3 grey col-xs-b5"><?= strtoupper($brand_name); ?></div>
                            <div class="h3 col-xs-b25"><?= $name; ?></div>
                            <?php if($this->session->has_userdata('userId')){ ?>
                            <div class="row col-xs-b25">
                                <div class="col-sm-6">
                                    <div class="simple-article size-5 grey">PRICE: <span class="color">₹<?= $price; ?></span>&nbsp;&nbsp;<span class="line-through">₹<?= $mrp_pr; ?></span></div>        
                                </div>
                                <?php $gst = '';
                                if($cat_id == '9'){
                                    $gst = '18%';
                                }if($cat_id == '6'){
                                    $gst = '12%';
                                }
                                ?>
                                <div>GST:<span class="color"> <?= $gst; ?></span></div>
                            </div>
                        <?php } ?>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">size:</div>
                                </div>
                                <div class="col-sm-9">
                                        <?php
                                            $p_size = explode(',', $psize);
                                            foreach ($p_size as $size) {
                                                $psize_data = $this->db->get_where('tbl_productsize',array('id ' => $size))->result();
                                    
                                                $psize_name=isset($psize_data[0])?$psize_data[0]->product_size:'';
                                             ?>
                                            <label class="container_check size"><?= $psize_name; ?>
                                              <input type="radio" checked="checked" name="radio_size" value="<?= $size; ?>">
                                              <span class="checkmark"></span>
                                            </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title">color:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="color-selection size-1">
                                        <?php
                                        $pcolor_name = '';
                                            $p_color = explode(',', $pcolor);
                                            foreach ($p_color as $color) {
                                            $pcolor_data = $this->db->get_where('tbl_productcolor',array('color_id ' => $color))->result();
                                                $pcolor_type=isset($pcolor_data[0])?$pcolor_data[0]->color_type:'';
                                                if($pcolor_type == 'dual'){
                                                    $pcolor_name1=isset($pcolor_data[0])?$pcolor_data[0]->color_value1:'';
                                                    $pcolor_name2=isset($pcolor_data[0])?$pcolor_data[0]->color_value2:'';
                                                    $pcolor_names=isset($pcolor_data[0])?$pcolor_data[0]->color_name:''; ?>
                                                    <div class="entry" style="background-image:linear-gradient(140deg, #EADEDB 0%, <?php echo $pcolor_name1; ?> 50%, <?php echo $pcolor_name2; ?> 75%);" data-id="<?= $color; ?>"></div><label><?php echo $pcolor_names; ?></label>
                                            <?php    }
                                                if($pcolor_type == 'single'){
                                                    $pcolor_name=isset($pcolor_data[0])?$pcolor_data[0]->color_value1:'';
                                                    $pcolor_names = isset($pcolor_data[0])?$pcolor_data[0]->color_name:''; ?>
                                                    <div class="entry" style="background-color:<?= $pcolor_name; ?>" data-id="<?= $color; ?>"></div><label><?php echo $pcolor_names; ?></label>
                                            <?php   }
                                                  } ?>
                                    </div>

                                </div>
                            </div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">Shape:</div>
                                </div>
                                <div class="col-sm-9">
                                        <?php
                                            $p_shape = explode(',', $pshape);
                                            foreach ($p_shape as $shape) {
                                            $pshape_data = $this->db->get_where('tbl_productshape',array('id ' => $shape))->result();
                                    
                                                $pshape_name=isset($pshape_data[0])?$pshape_data[0]->product_shape:''; ?>
                                        <label class="container_check shape"><?= $pshape_name; ?>
                                              <input type="radio" checked="checked" name="radio_shape" value="<?= $shape; ?>">
                                              <span class="checkmark"></span>
                                            </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">Material:</div>
                                </div>
                                <div class="col-sm-9">
                                        <?php
                                            $p_material = explode(',', $pmaterial);
                                            foreach ($p_material as $material) {
                                            $pmaterial_data = $this->db->get_where('tbl_productmaterial',array('id ' => $material))->result();
                                    
                                                $pmaterial_name=isset($pmaterial_data[0])?$pmaterial_data[0]->material_name:''; ?>
                                        <label class="container_check shape"><?= $pmaterial_name; ?>
                                              <input type="radio" checked="checked" name="radio_material" value="<?= $material; ?>">
                                              <span class="checkmark"></span>
                                            </label>
                                    <?php } ?>
                                </div>
                            </div>
                            <input type="hidden" class="color_clas">
                            <input type="hidden" class="size_clas">
                            <input type="hidden" class="shape_clas">
                            <div class="row col-xs-b40">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-1">quantity:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="quantity-select">
                                        <span class="minus"></span>
                                        <span class="number number_cart_pro">1</span>
                                        <span class="plus"></span>
                                    </div>
                                </div>
                            </div>
                            <?php $total_cart = 1; ?>
                            <div class="row m5">
                                <div class="col-sm-6 col-xs-b10 col-sm-b0 cartblk_<?= $pid; ?>">
                                        <a class="button size-2 style-2 block add_cart_single" href="javascript:void(0);" onclick="addToCartProduct(<?= $pid; ?>);">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                            <span class="text">add to cart</span>
                                        </span>
                                    </a>
                                    <input type="hidden" class="hiddncart" value="<?= $total_cart; ?>">
                                </div>  
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-3">
                                    <div class="h6 detail-data-title size-2">share:</div>
                                </div>
                                <div class="col-sm-9">
                                    <div class="follow light">
                                        <a class="entry" href="#"><i class="fa fa-facebook"></i></a>
                                        <a class="entry" href="#"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="empty-space col-xs-b35 col-md-b70"></div>
<?php if ($pdetails != '') { ?>

                    <!-- <div class="tabs-block">
                        <div class="tabulation-menu-wrapper text-center">
                            <div class="tabulation-title simple-input">description</div>
                            <ul class="tabulation-toggle">
                                <li><a class="tab-menu active">description</a></li>
                                <li><a class="tab-menu">technical specs</a></li>
                            </ul>
                        </div>
                        <div class="empty-space col-xs-b30 col-sm-b60"></div>

                        <div class="tab-entry visible">
                            <div class="row">
                                <div class="col-sm-12 col-xs-b30 col-sm-b0">
                                    <div class="simple-article size-2"><?= $pdetails; ?></div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-entry">
                            <div class="h5"></div>
                        </div>

                    </div> -->
<?php } ?>
                    <div class="empty-space col-xs-b35 col-md-b70"></div>

                    

                </div>
            </div>


            
           
        </div>
    <div class="slider-wrapper">
                <div class="swiper-button-prev visible-lg"></div>
                <div class="swiper-button-next visible-lg"></div>
                <div class="container">
                <div class="text-center">
                    <div class="h2">Similar Products</div>
                    <div class="title-underline center"><span></span></div>
                </div>
            </div>
                <div class="swiper-container" data-breakpoints="4" data-xs-slides="4" data-sm-slides="4" data-md-slides="4" data-lt-slides="4"  data-slides-per-view="4">
                    <div class="swiper-wrapper">
                      <?php  foreach ($products as $product) {
                            $PImages = json_decode($product->image_fids);
                            $image1=$this->media->getThumbPathById($PImages[0],'');
                            $pid = $product->pid;
                            $cat_id = $product->cat_id;
                            $p_size = explode(',',$product->frame_size);
                            $p_color = explode(',',$product->frame_color);
                            $p_shape = explode(',',$product->frame_shape);
                            
                            $key_f = $key_w ='';
                            $url = site_url('product/') . $product->url_slug;
                            $usr_id = $this->session->userdata('userId');

                            $brand_data = $this->db->get_where('tbl_brand',array('id ' => $product->brand_name))->result();
                                    
                            $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
                                    $brand_url=isset($brand_data[0])?$brand_data[0]->url_slug:'';
                            
                            
                                    $cart = getCart();

                                    if (count($cart['products']) > 0) {
                                        foreach ($cart['products'] as $pr) { 
                                            if ($pr['itemid'] == $pid) {
                                                $key_f = $pr['itemid'];
                                              }
                                        }

                                    }
                                    $product_descr = substr($product->product_desc, 0, 80).'..';
                ?>
                        
                        <div class="swiper-slide pros_page">
                            <div class="product-shortcode style-1 big">
                               
                                <div class="preview">
                                    <img src="<?php echo $image1; ?>" alt="<?php echo $product->product_name; ?>">
                                    <div class="preview-buttons valign-middle">
                                        
                                    </div>
                                </div>
                                <div class="title">
                                    <div class="simple-article size-1 color col-xs-b5 bran_name"><a href="<?= site_url('brands/'.$brand_url) ?>"><?php echo $brand_name; ?></a></div>
                                    <?php if($this->session->has_userdata('userId')){ ?>
                                    <div class="price">                                    
                                        <div class="simple-article size-4"><span class="dark">₹<?php echo $product->price; ?></span>&nbsp;&nbsp;&nbsp;<span class="line-through">₹<?= $product->mrp; ?></span></div>
                                    </div>
                                <?php } ?>
                                    <div class="h6 animate-to-green"><a href="<?php echo $url; ?>"><?php echo $product->product_name; ?></a></div>
                                </div>
                                <div class="description">
                                    <div class="simple-article text size-2"><?php echo $product_descr; ?></div><br>
                                <a href="<?php echo $url; ?>" class="view_more_p">View More</a>
                                <div class="btn_cart001 valign-middle-content cartblk_<?= $pid; ?>">
                                           <?php if ($key_f == $pid) { ?>
                                            <a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem(<?= $pid; ?>);">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                    <span class="text">Remove from Cart</span>
                                                </span>
                                            </a>
                                            <?php }else{ ?>
                                                <a class="button size-2 style-3" href="javascript:void(0);" onclick="addToCartItem(<?= $pid; ?>,'<?= $p_size[0]; ?>','<?= $p_color[0]; ?>','<?= $p_shape[0]; ?>');">
                                                    <span class="button-wrapper">
                                                        <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                        <span class="text">Add To Cart</span>
                                                    </span>
                                                </a>
                                            <?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?> 
                    </div>
                    <div class="swiper-pagination relative-pagination visible-xs visible-sm"></div>
                </div>
            </div>
            <div class="empty-space col-xs-b35 col-md-b70"></div>
    </div>

    <!-- JS
============================================ -->
<script>
    function zoomImg(){
        alert('Added');
    }
</script>
<script src='https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.6/dist/jquery.fancybox.min.js'></script>

</body>

</html>