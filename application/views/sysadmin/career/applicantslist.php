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
    var SITE_URL = "<?php echo base_url('sysadmin/'); ?>";
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


        <!--View Enquiry modal-->
        <div class="modal fade note-view" id="view-careerenquiry" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title"> <?php echo $page_title; ?> - Applicant Details</h5>
              </div>

              <div class="modal-body">
                <div class="card profile">
                  <div class="profile__info">

                    <dl class="row">

                      <dt class="col-sm-3"><strong>Name:</strong> </dt>
                      <dd class="col-sm-3" id="applicant_name"></dd>
                      <dt class="col-sm-3"><strong>Hospital Name:</strong> </dt>
                      <dd class="col-sm-3" id="hospital_name"></dd>

                      <dt class="col-sm-3"><strong>Email:</strong> </dt>
                      <dd class="col-sm-3" id="email"></dd>
                      <dt class="col-sm-3"><strong>Phone:</strong> </dt>
                      <dd class="col-sm-3" id="phone"></dd>

                      <dt class="col-sm-3 text-"><strong>CV/Resume:</strong> </dt>
                      <dd class="col-sm-3" id="file_path"></dd>
                      <dt class="col-sm-3 text-"><strong>Date Applied:</strong> </dt>
                      <dd class="col-sm-3" id="date_added"></dd>

                      <dt class="col-sm-3 text-truncate"><strong>Additional Information:</strong> </dt>
                      <dd class="col-sm-9" id="additional_information"></dd>

                    </dl>
                  </div>
                </div>

              </div>
              <div class="modal-footer modal-footer--bordered"><button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button> </div>
            </div>
          </div>
        </div>
        <!--View Enquiry modal ends-->

        <header class="content__title">
          <h1><?php echo $page_title; ?></h1>
          <div class="actions">
            <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>-->
          </div>
        </header>
        <div class="toolbar">
          <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo $total_record[0]->totalrecords; ?> Records</div>
          <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i></div>
          <div class="toolbar__search" style="display: none;">
            <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="applicants" data-forms_id="add_new_applicants">
            <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i> </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">List</h2>
          </div>
          <div class="card-block">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact No.</th>
                  <th>Resume/CV</th>
                  <th>Date Applied</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="list_search_result">
                <?php
                $i = 1;
                if (!empty($applicants)) {
                  foreach ($applicants as $pc) {
                    ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td><?php echo $pc->name; ?></td>
                  <td><?php echo $pc->email; ?></td>
                  <td><?php echo $pc->phone; ?></td>
                  <td><?php if (file_exists(CV_FILES_PATH . $pc->file_name)) {
                            echo anchor(CV_FILES_URL . $pc->file_name, 'Download ', 'class="btn btn-primary waves-effect" download');
                          }
                          ?></td>
                  <td><?php echo date('d-m-Y H:i', strtotime($pc->date_added)); ?></td>
                  <td>
                    <div class="btn-groups">
                      <button class="btn btn-primary waves-effect viewapplicant" data-toggle="modal" data-target="#view-careerenquiry" type="button" data-id="<?= $pc->caid; ?>" title="View Details of Applicant" id="viewapplicant">View Details</button>
                  </td>
                </tr>
                <?php $i++;
                  }
                } else { ?>
                <tr>
                  <td colspan="5" align="center">No record found...</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <table>
              <tr>
                <td colspan="5" align="right" style="font-size:12px;">
                  <div class="center"><?php echo $pageing_link; ?></div>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-Career"></button>


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
  <?php echo getExtraThing(); ?>
</body>

</html>