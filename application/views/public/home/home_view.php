<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
    <?php echo $extracss; ?>
    <?php $this->load->view('templates/front_common/master_page_subhead'); ?>

</head> 
        <?php $page = 'home'; ?>
<body>

    <!-- LOADER -->
    <div id="loader-wrapper"></div>

    <div id="content-block">
        <!-- HEADER -->
        <?php $page = 'home'; ?>
        <?php $this->load->view('templates/front_common/master_menu'); ?>

        <div class=" grey bg_top">
            <div class="slider-wrapper">
                <div class="swiper-button-prev visible-lg"></div>
                <div class="swiper-button-next visible-lg"></div>
                <div class="swiper-container" data-parallax="1" data-auto-height="1">
                   <div class="swiper-wrapper">
                    <?php  foreach ($banner as $b) {
                        $PImages = json_decode($b->image_fids);

                        $image=$this->media->getThumbPathById($PImages[0],'1820x810/');
                    ?>
                       <div class="swiper-slide swipe_bg" >
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cell-view page-height">
                                            <img src="<?php echo $image; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="empty-space col-xs-b80 col-sm-b0"></div>
                            </div>
                       </div>
                       <?php } ?>
                   </div>
                   <div class="swiper-pagination swiper-pagination-white"></div>
                </div>
            </div>
        </div>
            
            <div class="tab-entry visible slide_nearbanner brand_block_home">
                <div class="row">
                <?php foreach ($brands as $brand) {
                    $BImages = json_decode($brand->image_fids);
                    $bimage=$this->media->getThumbPathById($BImages[0],'386x300/');
                 ?>
                    <div class="brand_blk col-md-2" data-menu="<?php echo $brand->id; ?>">
                        <a href="<?= site_url('brands/'.$brand->url_slug) ?>">
                            <div class="product-shortcode style-1 big">
                                <div class="preview">
                                    <img src="<?php echo $bimage; ?>" alt="">          
                                </div>
                            </div>
                        </a>
                        <?php
                            $subbrand_head = $this->db->order_by('id', 'DESC')->get_where('tbl_subbrands',array('status ' => 'active','brand_name ' => $brand->id))->result(); 
                        ?>
                    <div class="dropdown-content data-<?php echo $brand->id; ?>">
                        <?php  foreach ($subbrand_head as $key1) { ?>
                        <a href="<?= site_url('brands/'.$key1->url_slug) ?>"><?= $key1->sub_brand_name; ?></a>
                    <?php } ?>
                    </div>
                    </div>
                <?php } ?>
            </div>
                                    
            </div>


<div class="tab-entry visible slide_nearbanner size_categs">
                        <div class="slider-wrapper">
                            <div class="swiper-button-prev hidden-xs"></div>
                            <div class="swiper-button-next hidden-xs"></div>
                            <div class="swiper-container arrows-align-top" data-breakpoints="1" data-xs-slides="1" data-sm-slides="3" data-md-slides="3" data-lt-slides="3" data-slides-per-view="3">
                                <div class="swiper-wrapper">
                                    <?php foreach ($categories as $category) {
                                        $CImages = json_decode($category->image_fids);
                                        $cimage=$this->media->getThumbPathById($CImages[0],'530x205/');
                                     ?>
                                    <div class="swiper-slide">
                                        <div class="product-shortcode style-1 big">
                                            <div class="preview">
                                                <img src="<?php echo $cimage; ?>" alt="">          
                                            </div>
                                            <div class="title">
                                                <div class="h6 animate-to-green"><a href="<?= site_url('categories/'.$category->url_slug) ?>"><?php echo ucfirst($category->category_name); ?></a></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    
                                </div>
                                <div class="swiper-pagination relative-pagination visible-xs"></div>
                            </div>
                        </div>
                    </div>

            <div class="slider-wrapper">
                <div class="swiper-button-prev visible-lg"></div>
                <div class="swiper-button-next visible-lg"></div>
                <div class="container">
                <div class="text-center">
                    <div class="h2">best seller</div>
                    <div class="title-underline center"><span></span></div>
                    <div class="simple-article size-3 grey uppercase col-xs-b5">Pick from the best, to match your style</div>
                </div>
            </div> 
                <div class="swiper-container" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lt-slides="4"  data-slides-per-view="4">
                    <div class="swiper-wrapper">
                        <?php foreach ($products_hot as $product_h) {
                            $PImages = json_decode($product_h->image_fids);
                            $image1=$this->media->getThumbPathById($PImages[0],'339x158/');
                            $pid = $product_h->pid;
                            $cat_id = $product_h->cat_id;
                            $p_size = explode(',',$product_h->frame_size);
                            $p_color = explode(',',$product_h->frame_color);
                            $p_shape = explode(',',$product_h->frame_shape);
                            $proid = $pid.'-1-'.$p_size[0].'-'.$p_color[0].'-'.$p_shape[0];
                            $key_f = $key_w ='';
                            $url = site_url('product/') . $product_h->url_slug;
                            $usr_id = $this->session->userdata('userId');

                            $brand_data = $this->db->get_where('tbl_brand',array('id ' => $product_h->brand_name))->result();
                                    
                            $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
                            $brand_url=isset($brand_data[0])?$brand_data[0]->url_slug:'';
                            
                                    $cart = getCart();

                                    if (count($cart['products']) > 0) {
                                        foreach ($cart['products'] as $pr) { 
                                            if ($pr['pcookie_id'] == $proid) {
                                                $key_f = $pr['pcookie_id'];
                                              }
                                        }

                                    }
                                    $product_descr = substr($product_h->product_desc, 0, 80).'..';
                ?>
                        <div class="swiper-slide pros_page">
                            <div class="product-shortcode style-1 big">
                                
                                <div class="preview">
                                    <img src="<?php echo $image1; ?>" alt="<?php echo $product_h->product_name; ?>">
                                </div>
                                <div class="title">
                                    <div class="simple-article size-1 color col-xs-b5 bran_name"><a href="<?= site_url('brands/'.$brand_url) ?>"><?php echo $brand_name; ?></a></div>

                                <?php if($this->session->has_userdata('userId')){ ?>
                                    <div class="price">                                    
                                        <div class="simple-article size-4"><span class="dark">₹<?php echo $product_h->price; ?></span>&nbsp;&nbsp;&nbsp;<span class="line-through">₹<?= $product_h->mrp; ?></span></div>
                                    </div>
                                <?php } ?>
                                    <div class="h6 animate-to-green"><a href="<?php echo $url; ?>"><?php echo $product_h->product_name; ?></a></div>
                                </div>
                                <div class="description">
                                    <div class="simple-article text size-2"><?php echo $product_descr; ?></div><br>
                                <a href="<?php echo $url; ?>" class="view_more_p">View More</a>
                                 <div class="btn_cart001 valign-middle-content cartblk_<?= $pid; ?> row_pros-<?= $proid; ?>">
                                           <?php if ($key_f == $proid) { ?>
                                            <a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem('<?= $pr['pcookie_id']; ?>');">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                    <span class="text">Remove from Cart</span>
                                                </span>
                                            </a>
                                            <?php }else{ ?>
                                                <a class="button size-2 style-3" href="javascript:void(0);" onclick="addToCartItem('<?= $proid; ?>');">
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
                <a class="button size-2 style-3 btn_view_more" href="<?= site_url('product/') ?>">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                                                    <span class="text">View Range</span>
                                                </span>
                                            </a>
            </div>

            <div class="empty-space col-xs-b35 col-md-b70"></div>

<div class="fixed-background bg_banner" style="background-image: url(<?php echo FRONT_ASSETS_PATH; ?>img/background-18.jpg);">
            <div class="block-entry">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="cell-view simple-banner-height big">
                                <div class="empty-space col-xs-b35"></div>
                                <h2 class="h1 light">&nbsp;</h2>

                                <!-- <a class="button size-2 style-1 btn_know_more_banner" href="#">
                                    <span class="button-wrapper">
                                        <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-1.png" alt=""></span>
                                        <span class="text">KNOW WHY!</span>
                                    </span>
                                </a> -->
                                </div>
                                <div class="empty-space col-xs-b35"></div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="empty-space col-xs-b35 col-md-b70"></div>
<?php if(count($products) > 0){ ?>
           <div class="slider-wrapper">
                <div class="swiper-button-prev visible-lg"></div>
                <div class="swiper-button-next visible-lg"></div>
                <div class="container">
                <div class="text-center">
                    <div class="h2">featured</div>
                    <div class="title-underline center"><span></span></div>
                    <div class="simple-article size-3 grey uppercase col-xs-b5">Frames that define vogue pretty well as trendsetters</div>
                </div>
            </div>
                <div class="swiper-container" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lt-slides="4"  data-slides-per-view="4">
                    <div class="swiper-wrapper">
                       <?php foreach ($products as $product) {
                            $PImages = json_decode($product->image_fids);
                            $image1=$this->media->getThumbPathById($PImages[0],'339x158/');
                            $pid = $product->pid;
                            $cat_id = $product->cat_id;
                            $p_size = explode(',',$product->frame_size);
                            $p_color = explode(',',$product->frame_color);
                            $p_shape = explode(',',$product->frame_shape);
                            $proid = $pid.'-1-'.$p_size[0].'-'.$p_color[0].'-'.$p_shape[0];
                            $key_f = $key_w ='';
                            $url = site_url('product/') . $product->url_slug;
                            $usr_id = $this->session->userdata('userId');
                            
                                    $cart = getCart();

                            if (count($cart['products']) > 0) {
                                foreach ($cart['products'] as $pr) { 
                                    if ($pr['pcookie_id'] == $proid) {
                                        $key_f = $pr['pcookie_id'];
                                      }
                                }

                            }
                         $brand_data = $this->db->get_where('tbl_brand',array('id ' => $product->brand_name))->result();
                                    
                        $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
                        $brand_url=isset($brand_data[0])?$brand_data[0]->url_slug:'';
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
                                <div class="btn_cart001 valign-middle-content cartblk_<?= $pid; ?> row_pros-<?= $proid; ?>">
                                           <?php if ($key_f == $proid) { ?>
                                            <a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem('<?= $pr['pcookie_id']; ?>');">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span>
                                                    <span class="text">Remove from Cart</span>
                                                </span>
                                            </a>
                                            <?php }else{ ?>
                                                <a class="button size-2 style-3" href="javascript:void(0);" onclick="addToCartItem('<?= $proid; ?>');">
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
                <a class="button size-2 style-3 btn_view_more" href="<?= site_url('product/') ?>">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                                                    <span class="text">View Range</span>
                                                </span>
                                            </a>
            </div>
<div class="empty-space col-xs-b35 col-md-b70"></div>
<?php } ?>

        </div>

        <!-- FOOTER -->
        
        <?php $this->load->view('templates/front_common/master_footer_view'); ?>

        <?php $this->load->view('templates/front_common/master_modal'); ?>
    </div>


<?php $this->load->view('templates/front_common/master_page_js'); ?>
</body>
</html>
