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
  var SITE_URL="<?php echo MAINSITE_MADMIN_URL;?>";
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
      <h2 class="card-title">Edit News</h2>
    </div>
    <?php $news=$news[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
       <div class="row">
          <div class="col-sm-12">
            <div class="form-group form-group--float"><?php echo form_input('n_title',set_value('n_title',$news->n_title,false),'class="form-control" id="n_title"');?> <?php echo form_label('Title','n_title');?><i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
            <div  class="col-sm-12">
              <h3 class="card-block__title">Image</h3>
              <?php echo $post_pics; ?></div>
          </div>
         <div class="row">
            <div class="form-group">
              <div class="col-sm-12 field_wrapper">
                <div id="post_pics">
                  <?php 
                  $Ppics = (array)json_decode($news->image_fids); 
                  echo $this->media_model->getImageBlock('post_pics','195x115',$Ppics);?>
                </div>
              </div>
            </div>
        </div> 

       <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="n_desc" id="n_desc" placeholder="Write here...."><?= $news->n_desc;?></textarea>
                <i class="form-group__bar"></i></div>
            </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('url_slug',set_value('url_slug',$news->url_slug,false),'class="form-control" id="url_slug"');?>
              <?php echo form_label('Base URL','url_slug');?><i class="form-group__bar"></i>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('h1_tag',set_value('h1_tag',$news->h1_tag,false),'class="form-control" id="h1_tag"');?>
              <?php echo form_label('H1 Tag','h1_tag');?><i class="form-group__bar"></i>
            </div>
          </div>          
        </div>

        <div class="row">
            <div class="col-sm-12">
            <div class="form-group form-group--float"><?php echo form_input('meta_title',set_value('meta_title',$news->meta_title,false),'class="form-control" id="meta_title"');?>
              <?php echo form_label('Meta Title','meta_title');?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Meta Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."><?= $news->meta_desc;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Additional Meta Tags</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."><?= $news->additional_tag;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>

      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($news->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($news->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('news_id',set_value('news_id',$news->nid));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/news').'\'"');?> </div>
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
   var editor = CKEDITOR.replace( 'n_desc', {
    filebrowserBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl : '<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});
</script>
<?php echo getExtraThing(); ?>

</body>
</html>