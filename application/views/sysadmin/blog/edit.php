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
    <?php $blog=$blog[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
        
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="form-group form-group--float"> 
              <?php echo form_input('blog_title',set_value('blog_title',$blog->blog_title,false),'class="form-control" id="blog_title"');?> 
              <?php echo form_label('Title','blog_title');?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="form-group">
              <label>Category</label>
              <?php 
              $options=array();
              $options['']='Select category';
               if(count($blog_category)>0){ 
                     foreach($blog_category as $bc){
                     $options[$bc->bcat_id]=$bc->bcat_name;
                   }
                   $selected_option=$blog->blog_category; 
               }?>
                <?php echo form_dropdown('blog_category', $options, $selected_option,'class="select2" id="blog_category"');?>
             </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Blog Brief</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="blog_brief" id="blog_brief" placeholder="Write here...."><?= $blog->blog_brief?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>

        <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Blog Post</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="blog_post" id="blog_post" placeholder="Write here...."><?= $blog->blog_post?></textarea>
                <i class="form-group__bar"></i> </div>
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
                  $Ppics = (array)json_decode($blog->image_fids); 
                  echo $this->media_model->getImageBlock('post_pics','195x115',$Ppics);?>
                </div>
              </div>
            </div>
        </div>

        <div class="row"> 
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label>Related Articles</label>
              <?php 
              $options=array();
               if(count($blogs)>0){ 
                     foreach($blogs as $b){
                     $options[$b->blog_id]=$b->blog_title;
                   }
                    $selected_related_article=explode(',',$blog->related_article);  
               }?>
                <?php echo form_dropdown('related_article[]', $options, $selected_related_article,'class="select2" multiple id="related_article" placeholder="Select articles"');?>
             </div>
          </div>

          

          <!-- <div class="col-sm-4"> <?php //echo form_label('Date Added','date_added');?>
              <div class="input-group"> <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                <div class="form-group form-group--float">
                  <input type="text" name="date_added" class="form-control date-picker form-control--active" id="date_added" placeholder="Select Date" autocomplete="off" required>
                  <i class="form-group__bar"></i> </div>
              </div>
            </div> -->

        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group form-group--float"> 
                 <?php echo form_input('url_slug',set_value('blog_title',$blog->url_slug),'class="form-control" id="url_slug"');?> 
                 <?php echo form_label('URL','url_slug');?><i class="form-group__bar"></i> </div>
            </div> 
            <div class="col-sm-6">
                <div class="form-group form-group--float"> <?php echo form_input('h1_tag',set_value('h1_tag',$blog->h1_tag),'class="form-control" id="h1_tag"');?>
                  <?php echo form_label('H1 Tag','h1_tag');?><i class="form-group__bar"></i>
                </div>
              </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group form-group--float"> 
                 <?php echo form_input('meta_title',set_value('meta_title',$blog->meta_title),'class="form-control" id="meta_title"');?> 
                 <?php echo form_label('Meta Title','meta_title');?><i class="form-group__bar"></i> </div>
            </div> 
        </div>

        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Meta Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Write here...."><?= $blog->meta_description;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="form-group form-group--float"> 
                 <?php echo form_input('image_title',set_value('image_title',$blog->image_title),'class="form-control" id="image_title"');?> 
                 <?php echo form_label('Image Title','image_title');?><i class="form-group__bar"></i> </div>
            </div> 
            <div class="col-sm-6 col-md-6">
                <div class="form-group form-group--float"> 
                 <?php echo form_input('image_alt',set_value('image_alt',$blog->image_alt),'class="form-control" id="image_alt"');?> 
                 <?php echo form_label('Image Alt','image_alt');?><i class="form-group__bar"></i> </div>
            </div> 
        </div>


      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($blog->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($blog->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('blog_id',set_value('blog_id',$blog->blog_id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/blog').'\'"');?> </div>
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
   var editor = CKEDITOR.replace( 'blog_post', {
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