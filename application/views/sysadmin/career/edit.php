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
          <header class="content__title">
            <h1><?php echo $page_title; ?></h1>
          </header>
          <div class="card">
            <div class="card-header">
              <h2 class="card-title">Edit</h2>
            </div>
            <?php $career = $career[0]; ?>
            <div class="card-block"> <?php echo form_open('', ''); ?>

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('career_title', set_value('career_title', $career->career_title), 'class="form-control" id="career_title"'); ?>
                    <?php echo form_label('Career Title', 'career_title'); ?><i class="form-group__bar"></i> </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <?php echo form_label('Hospital List', 'hosp_id'); ?>
                  <div class="form-group">
                    <?php
                    $options = array();
                    if (count($hospitals) > 0) {
                      foreach ($hospitals as $lo) {
                        $options[$lo->hid] = $lo->hosp_name;
                      }
                    }
                    ?>
                    <?php echo form_dropdown('hosp_id[]', $options, '', 'class="select2" id="hosp_id" data-placeholder="Select location" multiple'); ?> </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('designation', set_value('designation', $career->designation), 'class="form-control" id="designation"'); ?>
                    <?php echo form_label('Designation', 'designation'); ?><i class="form-group__bar"></i> </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('department', set_value('department', $career->department), 'class="form-control" id="department"'); ?>
                    <?php echo form_label('Department', 'department'); ?><i class="form-group__bar"></i> </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('qualification', set_value('qualification', $career->qualification), 'class="form-control" id="qualification"'); ?>
                    <?php echo form_label('Qualification', 'qualification'); ?><i class="form-group__bar"></i> </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('experience', set_value('experience', $career->experience), 'class="form-control" id="experience"'); ?>
                    <?php echo form_label('Experience', 'experience'); ?><i class="form-group__bar"></i> </div>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('total_opening', set_value('total_opening', $career->total_opening), 'class="form-control" id="total_opening"'); ?>
                    <?php echo form_label('Total Opening', 'total_opening'); ?><i class="form-group__bar"></i> </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('contact_details', set_value('contact_details', $career->contact_details), 'class="form-control" id="contact_details"'); ?>
                    <?php echo form_label('Contact Details', 'contact_details'); ?><i class="form-group__bar"></i> </div>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-12">
                  <h3 class="card-block__title">Job Description</h3>
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="job_decription" id="job_decription" placeholder="Write here...."><?= $career->job_decription; ?></textarea>
                    <i class="form-group__bar"></i> </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="form-group form-group--float">
                    <?php echo form_input('url_slug', set_value('blog_title', $career->url_slug), 'class="form-control" id="url_slug"'); ?>
                    <?php echo form_label('URL', 'url_slug'); ?><i class="form-group__bar"></i> </div>
                </div>

              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group form-group--float"><?php echo form_input('meta_title', set_value('meta_title', $career->meta_title, false), 'class="form-control" id="meta_title"'); ?>
                    <?php echo form_label('Meta Title', 'meta_title'); ?><i class="form-group__bar"></i>
                  </div>
                </div>
              </div>

              <br>
              <div class="row">
                <div class="col-sm-12">
                  <h3 class="card-block__title">Meta Description</h3>
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."><?= $career->meta_desc; ?></textarea>
                    <i class="form-group__bar"></i> </div>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  <h3 class="card-block__title">Additional Meta Tags</h3>
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."><?= $career->additional_tag; ?></textarea>
                    <i class="form-group__bar"></i> </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <label class="custom-control custom-radio">
                    <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($career->status == 'active') {
                                                                                                    echo "checked";
                                                                                                  } ?>>
                    <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
                  <label class="custom-control custom-radio">
                    <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($career->status == 'inactive') {
                                                                                                      echo "checked";
                                                                                                    } ?>>
                    <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
                </div>
              </div>


              <div class="row">
                <div class="form-group--centered col-sm-12">
                  <?php echo form_hidden('blog_id', set_value('blog_id', $career->cid)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
                  <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/career') . '\'"'); ?> </div>
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
  <script type="text/javascript">
    var editor = CKEDITOR.replace('job_decription', {
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