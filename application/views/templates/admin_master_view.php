<!DOCTYPE html>
<html lang="en">
 <meta charset="UTF-8">
<head>
<?php $this->load->view('templates/common/master_page_head');?>
<?php echo $extracss;?>
<!-- App styles -->
<link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH;?>css/app.min.css">
<!--App Global variables-->
<script>
	var SITE_URL="<?php echo MAINSITE_MADMIN_URL;?>";
	var CURRENT_URL="<?php echo current_url();?>";
	var hash="<?php echo $this->security->get_csrf_hash();?>";
</script>
<?php echo $this->session->flashdata('message');?>
</head>
<body data-ma-theme="blue">
<main class="main">
  <?php $this->load->view('templates/common/master_header_view');?>
  <?php $this->load->view('templates/common/master_sidebar_view');?>
  <section class="content">
     <?php echo $the_view_content;?>
     <?php $this->load->view('templates/common/master_footer_view');?>
  </section>
</main>
<?php $this->load->view('templates/common/master_page_js');?>
<?php echo $extrajs;?>
<!-- App functions and actions --> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/app.min.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/custom.js"></script>
<?php echo getExtraThing(); ?>
</body>
</html>
