<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

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

<body data-ma-theme="red">
<main class="main">
  <?php $this->load->view('templates/common/master_header_view');?>
  <?php $this->load->view('templates/common/master_sidebar_view');?>
  <section class="content">
    <div class="">

<div>
  <header class="content__title">
    <h1><?php echo $page_title;?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $pages=$pages[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
       <div class="row">
          <div class="col-sm-12">
            <div class="form-group form-group--float"><?php echo form_input('pages_title',set_value('pages_title',$pages->pages_title,false),'class="form-control" id="pages_title"');?> <?php echo form_label('Title','pages_title');?><i class="form-group__bar"></i> </div>
          </div>
        </div>

       <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="pages_desc" id="pages_desc" placeholder="Write here...."><?= $pages->pages_desc;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>


      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($pages->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($pages->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('pages_id',set_value('pages_id',$pages->pages_id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/pages').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
<?php $this->load->view('templates/common/master_footer_view');?>
  </section>
</main>
<?php $this->load->view('templates/common/master_page_js_noapp');?>
<?php echo $extrajs;?> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/custom.js"></script> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>js/app.min.js"></script> 
<?php include DIR_WS_CATALOG.'assets/admin/vendors/bower_components/ckfinder/ckfinder.php';?>
<script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckeditor/ckeditor.js"></script> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.js"></script> 
<script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckeditor/adapters/jquery.js"></script> 
<script type="text/javascript">
   var editor = CKEDITOR.replace( 'pages_desc', {
    filebrowserBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>
</body>
</html>