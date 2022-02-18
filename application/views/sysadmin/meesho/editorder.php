<?php defined('BASEPATH') or exit('No direct script access allowed');
$product = $product[0];
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <?php $this->load->view('templates/common/master_page_head'); ?>
  <?php echo $extracss; ?>
  <!-- App styles -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH; ?>css/app.min.css">
  <!--App Global variables-->
  <script>
    var SITE_URL = "<?php echo MAINSITE_MADMIN_URL; ?>";
    var CURRENT_URL = "<?php echo current_url(); ?>";
    var hash = "<?php echo $this->security->get_csrf_hash(); ?>";
  </script>
  <?php echo $this->session->flashdata('message'); ?>
</head>

<body data-ma-theme="red">
  <main class="main">
    <?php $this->load->view('templates/common/master_header_view'); ?>
    <?php $this->load->view('templates/common/master_sidebar_view'); ?>
    <section class="content">
      <div class="">
        <header class="content__title">
          <h1><?php echo $page_title; ?></h1>
        </header>
        <?php echo form_open_multipart('', 'id="add_new_product" name="add_new_product"'); 
                    $Ppics = (array) json_decode($product->image_fids); ?>

        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Product Image</h2>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-sm-12"><?php echo $post_pics; ?></div>
            </div>
            <div class="row">
              <div class="form-group">
                <div class="col-sm-12 field_wrapper">
                  <div id="post_pics">
                    <?php
                    echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Overview</h2>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group--float">
                  <?php echo form_input('product_name', set_value('product_name', $product->product_name), 'class="form-control" id="product_name"'); ?>
                  <?php echo form_label('Title', 'product_name'); ?>
                  <i class="form-group__bar"></i> 
               </div>
              </div>
            </div>

            <br>
            <div class="row">
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Select Brand</label>
                              


                              <?php
                              $options = array();
                              $options[''] = 'Select Brand';
                              if (count($brands) > 0) {
                                foreach ($brands as $bc) {
                                  $options[$bc->id] = $bc->brand_name;
                                }
                              }
                              $selected_brand = $product->brand_name;
                              ?>
                              <?php echo form_dropdown('brand', $options, $selected_brand, 'class="select2" id="brand" data-control="subbrands"'); ?>

                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Select Sub Brand</label>
                              <?php
                                 $options = array();                                 
                                 $options[''] = 'Select Sub Brand';
                                 if (count($subbrands) > 0) {
                                    foreach ($subbrands as $bc) {
                                      $options[$bc->id] = $bc->sub_brand_name;
                                    }
                                  }
                                  $selected_subbrand = $product->subbrand;

                                 ?>
                              <?php echo form_dropdown('subbrand', $options, $selected_subbrand, 'class="select2" id="subbrand"'); ?>

                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <label>Category</label>
                              <?php
                              $options = array();
                              $options[''] = 'Select category';
                              if (count($category) > 0) {
                                foreach ($category as $bc) {
                                  $options[$bc->cat_id] = $bc->category_name;
                                }
                              }
                              $selected_cat = $product->cat_id;
                              ?>
                              <?php echo form_dropdown('cat_id', $options, $selected_cat, 'class="select2" id="cat_id"'); ?>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <label>Product Type</label>
                              <?php
                                 $options = array();                                 
                                 $options[''] = 'Select product type';                                 
                                 if (count($pptype) > 0) {                                 
                                   foreach ($pptype as $bc) {                                 
                                     $options[$bc->type_id] = $bc->producttype_name;
                                    }                                 
                                 }
                              $pptype = $product->product_type; ?>
                              <?php echo form_dropdown('type_id', $options, $pptype, 'class="select2" id="type_id"'); ?>
                           </div>
                        </div>


                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>Frame Shape</label>

                                <?php
                                 $options = array();                                       
                                 if (count($pframeshape) > 0) {                                 
                                   foreach ($pframeshape as $bc) {                                 
                                     $options[$bc->id] = $bc->product_shape;
                                    }                                 
                                 }
                              $frame_shape = $product->frame_shape;
                                  $frame_sh = explode(',', $frame_shape);
                                  if(count($frame_sh) == 1){
                                    $options_shape = $frame_shape;
                                  }else{
                                    $options_shape = array();     
                                    
                                    foreach ($frame_sh as $fsh) {    
                                        $options_shape[$fsh] = $fsh;
                                    }  
                                  } ?>

                              <?php echo form_dropdown('frame_shape[]', $options, $options_shape, 'class="select2" id="frame_shape" multiple'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>Frame Size</label>
                              <?php
                                 $options = array();                                   
                                 if (count($pframesize) > 0) {                                 
                                   foreach ($pframesize as $bc) {    
                                     $options[$bc->id] = $bc->product_size;
                                    }                                 
                                  }
                                  $frame_size = $product->frame_size;
                                  $frame_s = explode(',', $frame_size);
                                  if(count($frame_s) == 1){
                                    $options_size = $frame_size;
                                  }else{
                                    $options_size = array();     
                                    
                                    foreach ($frame_s as $fs) {    
                                        $options_size[$fs] = $fs;
                                    }  
                                  }

                                   ?>
                              <?php echo form_dropdown('frame_size[]', $options, $options_size, 'class="select2" id="frame_size" multiple'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>Frame Colour</label>
                              <?php 
                                 $options = array();                    
                                 if (count($pframecolor) > 0) {                                 
                                   foreach ($pframecolor as $bc) {   
                                    $options[$bc->color_id] = $bc->color_name;
                                    }                                 
                                 }

                                 $frame_colors = $product->frame_color;
                                  $frame_c = explode(',', $frame_colors);
                                  if(count($frame_c) == 1){
                                    $options_colors = $frame_c;
                                  }else{
                                    $options_colors = array();     
                                    
                                    foreach ($frame_c as $fc) {    
                                        $options_colors[$fc] = $fc;
                                    }  
                                  }
                                 ?>
                              <?php echo form_dropdown('frame_color[]', $options, $options_colors, 'class="select2" id="frame_color" multiple'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>Gender</label>
                              <?php
                                  $options = array();      
                                  $options['Male'] = 'Male';  
                                  $options['Female'] = 'Female';
                                  $options['Unisex'] = 'Unisex';
                                  $gender = $product->gender;
                              ?>
                              <?php echo form_dropdown('gender', $options, $gender, 'class="select2" id="gender"'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>
                       

                         

                         <div class="col-sm-4 col-md-4">
                          <div class="form-group"> 
                                <label>Select Material</label>
                              <?php
                                 $options = array();                             
                                 $options[''] = 'Select Material';               
                                 if (count($pmaterial) > 0) {                                 
                                   foreach ($pmaterial as $bc) {   
                                    $options[$bc->id] = $bc->material_name;
                                    }                                 
                                 }$material = $product->material; ?>
                              <?php echo form_dropdown('material', $options, $material, 'class="select2" id="material"'); ?>
                                <i class="form-group__bar"></i>
                              </div> 

                           
                        </div>

                        <div class="col-sm-2">
                          <label class="custom-control custom-checkbox"> 
                            <input type="checkbox" name="featured" id="featured" value="1" class="custom-control-input" <?php if($product->featured==1){ echo 'checked';}?>>
                            <span class="custom-control-indicator"></span> <span class="custom-control-description">Featured</span></label>
                        </div>
                        <div class="col-sm-2">
                          <label class="custom-control custom-checkbox"> 
                            <input type="checkbox" name="hot_pro" id="hot_pro" value="1" class="custom-control-input" <?php if($product->hot==1){ echo 'checked';}?>>
                            <span class="custom-control-indicator"></span> <span class="custom-control-description">Hot</span></label>
                        </div>


                        <div class="col-sm-4 col-md-4">
                    <div class="form-group form-group--float"> 
                      <?php echo form_input('mrp', set_value('mrp',$product->mrp), 'class="form-control" id="mrp"'); ?>
                      <?php echo form_label('MRP', 'mrp'); ?>
                      <i class="form-group__bar"></i>
                    </div>                         
                  </div>
                  <div class="col-sm-4 col-md-4">
                    <div class="form-group form-group--float"> 
                      <?php echo form_input('price', set_value('price',$product->price), 'class="form-control" id="price"'); ?>
                      <?php echo form_label('Price', 'price'); ?>
                      <i class="form-group__bar"></i>
                    </div>                         
                  </div>
                        

                      </div>


            <div class="row">
              <div class="col-sm-12">
                <h3 class="card-block__title">Product Description</h3>
                <div class="form-group">
                  <textarea class="form-control" rows="2" name="product_desc" id="product_desc"><?= $product->product_desc; ?></textarea>
                  <i class="form-group__bar"></i> </div>
              </div>
            </div>

            

          </div>
        </div>



        <div class="card">
          <div class="card-block">

            <div class="row">
              <div class="form-group--centered col-sm-12">

                <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Submit', 'class="btn btn-success waves-effect"'); ?>
                <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/product'); ?>'">Cancel</button>
              </div>
            </div>

          </div>
        </div>



      </div>


      <?php echo form_close(); ?>
      </div>



      <?php $this->load->view('templates/common/master_footer_view'); ?>
    </section>
  </main>
  <?php $this->load->view('templates/common/master_page_js_noapp'); ?>
  <?php echo $extrajs; ?>

  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/custom.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/app.min.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/validation/jquery.validate.min.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/validation/additional-methods.min.js"></script>
  <?php include DIR_WS_CATALOG . 'assets/admin/vendors/bower_components/ckfinder/ckfinder.php'; ?>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/adapters/jquery.js"></script>
  <script type="text/javascript">
    var editor = CKEDITOR.replace('product_desc', {
      filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    var editor = CKEDITOR.replace('scope', {
      filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    var editor = CKEDITOR.replace('details', {
      filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
    var editor = CKEDITOR.replace('technical_parameter', {
      filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
  </script>

  <?php echo getExtraThing(); ?>
</body>

</html>