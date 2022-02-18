<?php defined('BASEPATH') or exit('No direct script access allowed');
$discount = $discount[0];
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
        <?php echo form_open_multipart('', 'id="edit_new_discount" name="edit_new_discount"'); ?>

          
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Discount</h2>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group--float">
                  <?php echo form_input('discount_name', set_value('discount_name', $discount->discount_name), 'class="form-control" id="discount_name"'); ?>
                  <?php echo form_label('Discount Name', 'discount_name'); ?>
                  <i class="form-group__bar"></i> 
               </div>
              </div>
              <div class="col-sm-3">
                           <label>Create Discount for : </label>
                           <div class="form-group">
                              <?php
                              $options = array('all' => 'All', 'category' => 'Category', 'products' => 'Products');
                              $selected_option = $discount->discount_on;
                              
                              ?>
                              <?php echo form_dropdown('discount_on', $options, $selected_option, 'class="select2" id="discount_on" data-placeholder="Discount on" required'); ?>
                           </div>
                </div>
            </div>

            <br>
            <div class="row">
              <div class="col-sm-6 col-md-6">
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
                  $selected_option = explode(',',$discount->category_id);
                  ?>
                  <?php echo form_dropdown('category_id[]', $options, $selected_option, 'class="select2 category" multiple id="category_id"'); ?>
                </div>
              </div>

                <div class="col-sm-6 col-md-6">
                      <div class="form-group">
                        <label>Products</label>
                        <?php
                            $options = array();                                 
                            $options['all'] = 'All';                                                                
                            if (count($products) > 0) {                                 
                              foreach ($products as $pr) {                                 
                                $options[$pr->pid] = $pr->product_name;
                              }                                 
                            } 
                           $selected_option = explode(',',$discount->product_id);
                            
                            ?>
                        <?php echo form_dropdown('product_id[]', $options, $selected_option, 'class="select2 products" multiple="" id="product_id" data-placeholder="Select Product"'); ?>
                      </div>
                </div>

            </div>

            <div class="row">
                        <div class="col-sm-4">
                           <label>Discount Type</label><br>
                           <label class="custom-control custom-radio">
                              <input name="discount_type" class="custom-control-input" type="radio" value="flat" <?php if($discount->discount_type=='flat'){ echo "checked";}?>>
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Flat</span> </label>
                              <label class="custom-control custom-radio">
                              <input name="discount_type" class="custom-control-input" type="radio" value="percent" <?php if($discount->discount_type=='percent'){ echo "checked";}?>>
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Percent</span> </label>
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('discount_value', set_value('discount_value',$discount->discount_value), 'class="form-control" id="discount_value"'); ?>
                            <?php echo form_label('Discount Value', 'discount_value'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('discount_value_limit', set_value('discount_value_limit',$discount->discount_value_limit), 'class="form-control" id="discount_value_limit"'); ?>
                            <?php echo form_label('Discount Value Limit', 'discount_value_limit'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                         

                      </div>
 

                     
            

          </div>
        </div>



        <div class="card">
          <div class="card-block">

          
               
            <div class="row">
              <div class="form-group--centered col-sm-12">

                <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Submit', 'class="btn btn-success waves-effect"'); ?>
                <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/discount'); ?>'">Cancel</button>
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
    var editor = CKEDITOR.replace('discount_desc', {
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