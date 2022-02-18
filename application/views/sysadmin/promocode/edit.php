<?php defined('BASEPATH') or exit('No direct script access allowed');
$promocode = $promocode[0];
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
        <?php echo form_open_multipart('', 'id="edit_new_promocode" name="edit_new_promocode"'); ?>

          
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Promocode</h2>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group form-group--float">
                  <?php echo form_input('promocode_name', set_value('promocode_name', $promocode->promocode_name), 'class="form-control" id="promocode_name"'); ?>
                  <?php echo form_label('Promocode Name', 'promocode_name'); ?>
                  <i class="form-group__bar"></i> 
               </div>
              </div>
              <div class="col-sm-3">
                           <label>Create Promocode for : </label>
                           <div class="form-group">
                              <?php
                              $options = array('all' => 'All', 'category' => 'Category', 'products' => 'Products');
                              $selected_option = $promocode->promocode_on;
                              
                              ?>
                              <?php echo form_dropdown('promocode_on', $options, $selected_option, 'class="select2" id="promocode_on" data-placeholder="Promocode on" required'); ?>
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
                  $selected_option = explode(',',$promocode->category_id);
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
                           $selected_option = explode(',',$promocode->product_id);
                            
                            ?>
                        <?php echo form_dropdown('product_id[]', $options, $selected_option, 'class="select2 products" multiple="" id="product_id" data-placeholder="Select Product"'); ?>
                      </div>
                </div>

            </div>

            <div class="row">
                        <div class="col-sm-4">
                           <label>Promocode Type</label><br>
                           <label class="custom-control custom-radio">
                              <input name="promocode_type" class="custom-control-input" type="radio" value="flat" <?php if($promocode->promocode_type=='flat'){ echo "checked";}?>>
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Flat</span> </label>
                              <label class="custom-control custom-radio">
                              <input name="promocode_type" class="custom-control-input" type="radio" value="percent" <?php if($promocode->promocode_type=='percent'){ echo "checked";}?>>
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Percent</span> </label>
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('promocode_value', set_value('promocode_value',$promocode->promocode_value), 'class="form-control" id="promocode_value"'); ?>
                            <?php echo form_label('Promocode Value', 'promocode_value'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('promocode_value_limit', set_value('promocode_value_limit',$promocode->promocode_value_limit), 'class="form-control" id="promocode_value_limit"'); ?>
                            <?php echo form_label('Promocode Value Limit', 'promocode_value_limit'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                         

                      </div>
 

                          <!-- <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group"> 
                                <?php /* echo form_label('Usage Limit Per Coupon', 'usage_limit'); ?><small class="card-subtitle">(How many times the coupon can be used in total)</small>
                                  <?php echo form_input('usage_limit', set_value('usage_limit',$promocode->usage_limit), 'class="form-control" id="usage_limit" placeholder="Unlimited"'); */ ?>
                                  
                                  <i class="form-group__bar"></i>
                                </div>                         
                            </div>
                            <div class="col-sm-6 col-md-6">                           
                                <div class="form-group"> 
                                <?php /* echo form_label('Usage Limit Per User', 'usage_limit_per_user'); ?><small class="card-subtitle">(How many times the coupon can be used in total.)</small>
                                  <?php echo form_input('usage_limit_per_user', set_value('usage_limit_per_user',$promocode->usage_limit_per_user), 'class="form-control" id="usage_limit_per_user" placeholder="Unlimited"'); */ ?>                                 
                                  <i class="form-group__bar"></i>
                                </div>                                
                            </div>
                          </div> -->

                          <div class="row">
                              <div class="col-sm-3">
                              <div class="input-group"> <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                 <div class="form-group form-group--float">
                                    <input type="text" name="start_date" class="form-control date-picker form-control--active" id="start_date" placeholder="Select date" autocomplete="off" value="<?php if(!empty($promocode->expiry_date)){echo date('d-m-Y H:i',strtotime($promocode->start_date));}?>">
                                    <i class="form-group__bar"></i> </div>
                              </div>
                              </div>
                              <div class="col-sm-3">
                              <div class="input-group"> <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                 <div class="form-group form-group--float">
                                    <input type="text" name="expiry_date" class="form-control date-picker form-control--active" id="expiry_date" placeholder="Select date" autocomplete="off" value="<?php if(!empty($promocode->expiry_date)){echo date('d-m-Y H:i',strtotime($promocode->expiry_date));}?>">
                                    <i class="form-group__bar"></i> 
                                 </div>
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
                <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/promocode'); ?>'">Cancel</button>
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
   

  <?php echo getExtraThing(); ?>
</body>

</html>