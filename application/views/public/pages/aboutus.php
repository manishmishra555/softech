<!doctype html>
<html class="no-js" lang="en">

<head>
  <!-- Favicon -->
  <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?>
	<style type="text/css">
		.client-logo-entry{
			width: 100%;
		}
	</style>
</head>

<body class="template-color-5 font-family-02">

    <div class="main-wrapper wrapper-boxed_layout">

        <!-- Begin Main Header Area Two -->
        <header class="main-header_area-2">
        <?php $this->load->view('templates/front_common/master_menu'); ?>
        </header>
     

        <div class="checkout-area">
            <div class="container" >
<div class="header-empty-space"></div>
        <div class="container">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
                <a href="<?= site_url('/') ?>">Home</a>
                <a href="#">About Us</a>
            </div>
        </div>
        
        

        <div class="empty-space col-sm-b15 col-md-b50"></div>
<div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="simple-article size-3 grey uppercase col-xs-b5">about us</div>
                    <div class="h2">At galorebay</div>
                    <div class="title-underline left"><span></span></div>
                    <!-- <img src="http://projects.doorsstudio.com/galorebay/assets/front/images/about_photo.jpg" alt="About Us"> -->
                </div>
                <div class="col-sm-7">
                    <div class="simple-article size-3">
                        <p><b>Galorebay Optix India</b> is a well established and rooted company in the world of Indian Optical Market.</p>
                        <p>As the history rolls by the fact comes to play which signifies Galorebay as one of the first brands we started with in the Optical frame business. Galorebay as a company was named as by the brand for the mere reason that it had a lot to do with the success and positioning of the company in the industry. Since 2008 we have been trading and doing business in the south Indian zone of the country along with New Delhi.</p>
                        <p>We have an indirect distributorship Pan India. Keeping it factual Galorebay has been the only importer for optical frames from South Korea today defining the quality and becoming the first company dealing in Titanium Gold plated frames. We produce frames, sunglasses and reading glasses in the most innovative styles that would go with every individual’s style and vogue.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b25 col-sm-b50"></div>
        <div class="empty-space col-xs-b25 col-sm-b50"></div>

        <div class="container">
            <div class="text-center">
                <div class="h2">our brands</div>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>
        <div class="container">
            
                <?php 
                $brands = $this->db->order_by('sort_no', 'ASC')->get_where('tbl_brand',array('status ' => 'active'))->result();
                foreach ($brands as $brand) {
                    $BImages = json_decode($brand->image_fids);
                    $bimage=$this->media->getThumbPathById($BImages[0],'386x300/');
                 ?>
                 <div class="col-md-2">
                 <a class="client-logo-entry" href="<?= site_url('brands/'.$brand->url_slug) ?>">
	                <img src="<?php echo $bimage; ?>" alt="<?= $brand->brand_name; ?>">
	                <img src="<?php echo $bimage; ?>" alt="<?= $brand->brand_name; ?>">
	            </a>
	        </div>
                <?php } ?>
                                    
            </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="empty-space col-xs-b35 col-md-b70"></div>
      

        <!-- Scroll To Top Start -->
        <a class="scroll-to-top" href=""><i class="icon-arrow-up"></i></a>
        <!-- Scroll To Top End -->

    </div>

    <!-- JS
============================================ -->

<?php $this->load->view('templates/front_common/master_page_js'); ?>
<script type="text/javascript">

    
</script>
</body>

</html>