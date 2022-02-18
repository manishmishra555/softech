<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]>
<!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
  <?php $this->load->view('templates/front_common/master_page_head'); ?>
  <?php echo $extracss; ?>
  <?php $this->load->view('templates/front_common/master_page_subhead'); ?>
</head>
<?php $page = $this->uri->segment(1); ?>

<body>	
	
	<!-- page load -->
	<div class="animsition">
	 <?php 
	 	$this->load->view('templates/front_common/master_menu');
	  ?>
     <?php echo $the_view_content; ?>
  	<?php $this->load->view('templates/front_common/master_footer_view'); ?>
	 
	</div>	
  <!-- end page load -->
  <?php $this->load->view('templates/front_common/master_page_js');?>
   <?php echo $extrajs; ?>
</body>
</html>