
<!DOCTYPE html>

<html lang="en">
<head>
<?php $this->load->view('templates/common/master_page_head');?>
<?php echo $extracss;?>
<!-- App styles -->
<link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH;?>css/app.min.css">
<!--App Global variables-->
<script>
  var SITE_URL="<?php echo base_url('');?>";
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
    <header class="content__title">
      <h1>Dashboard</h1>
      <small>Welcome to the SOFTECH Dashboard!</small>
      <?php  

     /* pr($menu_items);
      foreach($menu_items as $code=>$name){                            
              if(count($name)>1){
                echo $code;
                 for($i=0;$i<sizeof($name);$i++){
                  //echo $name[$i]."<br>";
                   $m=explode("~",$name[$i]);
                   $module_code=$m[0];
                   $module_name=$m[1];
                   echo $module_code." : ".$module_name."<br>";
                 }
              }else{
                echo $code." ".$name."<br>";
              }
      }*/ ?>
    </header>
 
    
     
    <?php $this->load->view('templates/common/master_footer_view');?>
  </section>
</main>
<?php $this->load->view('templates/common/master_page_js');?>
<?php echo $extrajs;?>

<!-- App functions and actions --> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/app.min.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/custom.js"></script>
</body>
</html>
