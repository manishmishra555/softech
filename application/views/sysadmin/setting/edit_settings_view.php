<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>

<html lang="en">

<head>
  <?php $this->load->view('templates/common/master_page_head'); ?>
  <?php echo $extracss; ?>
  <!-- App styles -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH; ?>css/app.min.css">
  <!--App Global variables-->
  <script>
    var SITE_URL = "<?php echo base_url(''); ?>";
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

        <div>
          <div class="">
            <header class="content__title">
              <h1><?php echo $page_title; ?></h1>
            </header>
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Edit</h2>
              </div>
              <?php $setting = $setting[0]; ?>
              <div class="card-block"> <?php echo form_open('', ''); ?>
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group form-group--float"> <?php echo form_input('var_title', set_value('var_title', $setting->var_title), 'class="form-control" id="website_settings_name"'); ?> <?php echo form_label('Variable Title', 'var_title'); ?><i class="form-group__bar"></i> </div>
                  </div>
                  <!--<div class="col-sm-4">
            <div class="form-group form-group--float"> <?php //echo form_input('var_name',set_value('var_name',$setting->var_name),'class="form-control" id="var_name"');
                                                        ?> <?php //echo form_label('Variable Name','var_name');
                                                            ?> <i class="form-group__bar"></i> </div>
          </div>-->

                </div>


                <div class="row">
                  <div class="col-sm-12">
                    <?php if ($setting->var_name == 'OFFICE_ADDRESS') { ?>
                      <h3 class="card-block__title">Blog Post</h3>
                      <div class="form-group">
                        <textarea class="form-control" rows="3" name="setting_value" id="setting_value" placeholder="Write here...."><?= $setting->setting_value ?></textarea>
                        <i class="form-group__bar"></i> </div>
                    <?php } else { ?>
                      <div class="form-group form-group--float"> <?php echo form_input('setting_value', set_value('setting_value', $setting->setting_value), 'class="form-control" id="setting_value"'); ?> <?php echo form_label('Setting Value', 'setting_value'); ?> <i class="form-group__bar"></i> </div>
                    <?php } ?>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="form-group--centered col-sm-12">
                    <?php echo form_hidden('setting_id', set_value('setting_id', $setting->id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
                    <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.history.go(-1)"'); ?> </div>
                </div>
                <?php echo form_close(); ?>
              </div>
            </div>
          </div>


          <?php $this->load->view('templates/common/master_footer_view'); ?>
    </section>
  </main>
  <?php $this->load->view('templates/common/master_page_js_noapp'); ?>
  <?php echo $extrajs; ?>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/custom.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/app.min.js"></script>
  <?php include DIR_WS_CATALOG . 'assets/admin/vendors/bower_components/ckfinder/ckfinder.php'; ?>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/adapters/jquery.js"></script>
  <?php if ($setting->var_name == 'OFFICE_ADDRESS') { ?>
  <script type="text/javascript">
    var editor = CKEDITOR.replace('setting_value', {
      filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',
      filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',
      filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',
      filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
      filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
      filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
  </script>
  <?php } ?>
  <?php echo getExtraThing(); ?>
</body>

</html>