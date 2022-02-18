<body class="template-color-1 font-family-02">
    <main class="page-content">
        <div class="container">
          
<div class="quicky-content_wrapper pt-90 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3 class="heading head_categ">All Brands</h3>
                        </div>
                    </div>
                    <div class="header-empty-space"></div>
         <div class="container">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
               <a href="#">home</a>
               <a href="#"><?= $page; ?></a>
               <a href="#"><?= $brand_name; ?></a>
            </div>
            <div class="text-center">
               <div class="h2"><?= $page; ?> > <?= $brand_name; ?></div>
               <div class="title-underline center"><span></span></div>
            </div>
         </div>

         <div class="empty-space col-xs-b20 col-sm-b35 col-md-b70"></div>
         <div class="grid brands_blocks">
               <div class="grid-sizer"></div>
              <?php if (count($list) > 0) {
                                foreach ($list as $l) {

                                $PImages = json_decode($l->image_fids);
                                    $image = !empty($PImages[0]) ? $this->media->getThumbPathById($PImages[0], '386x300/') : FRONT_ASSETS_PATH . "images/tuoren_noproduct.png";

                                     ?>
               <div class="grid-item w33 filter-3" >
                    <a href="<?= site_url(strtolower($page).'/'.$l->url_slug) ?>">
                  <div class="gallery-grid-item gallery_pros">
                     <img src="<?= $image; ?>" alt="">
                     <div class="gallery-title">
                        <div class="left">
                          <h6 class="h5"><?= $brand_name; ?></h6>
                           <h5><?= $l->sub_brand_name; ?></h5>
                        </div>
                     </div>
                     
                  </div>
                   </a>
                     <!-- <h4 class="brand_title"><a href="<?= site_url('product/'.strtolower($page).'/'.$l->url_slug) ?>"><?= $l->brand_name; ?></a></h4> -->
               </div><?php } }else{ ?>
                    <div class="col-sm-12">
                        <p class="no-product">No Data Found</p>
                    </div>

              <?php } ?>
            </div>
         <div class="empty-space col-xs-b20 col-sm-b35 col-md-b70"></div>
         </div>
        </div>
</div>

        </div>
    </main>
<script type="text/javascript">
    
</script>
</body>
</html>