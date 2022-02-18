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


        <!--Add new modal-->
        <div class="modal fade note-view" id="add-team" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add New Team</h5>
              </div>
              <?php echo form_open('sysadmin/team/create', 'id="add_new_team" name="add_new_team" data-controller="team"'); ?>
              <div class="modal-body">
                <div class="row">
                  <div class="col-sm-12"><?php echo $post_pics; ?></div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-sm-12 field_wrapper">
                      <div id="post_pics">
                        <?php
                        if (isset($_POST['post_pics'])) {
                          $Ppics = (array) $_POST['post_pics'];
                          echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics);
                        } ?>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group form-group--float"> <?php echo form_input('team_title', set_value('team_title'), 'class="form-control" id="team_title"'); ?> <?php echo form_label('Title', 'team_title'); ?><i class="form-group__bar"></i> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group form-group--float"> <?php echo form_input('designation', set_value('designation', '', false), 'class="form-control" id="designation"'); ?> <?php echo form_label('Designation', 'designation'); ?><i class="form-group__bar"></i> </div>
                  </div>
                </div>

                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="card-block__title">Description</h3>
                    <div class="form-group">
                      <textarea class="form-control" rows="2" name="team_desc" id="team_desc"></textarea>
                      <i class="form-group__bar"></i> </div>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group form-group--float"><?php echo form_input('url_slug', set_value('url_slug'), 'class="form-control" id="url_slug"'); ?>
                      <?php echo form_label('Base URL', 'url_slug'); ?><i class="form-group__bar"></i>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group form-group--float"> <?php echo form_input('h1_tag', set_value('h1_tag'), 'class="form-control" id="h1_tag"'); ?>
                      <?php echo form_label('H1 Tag', 'h1_tag'); ?><i class="form-group__bar"></i>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group form-group--float"><?php echo form_input('meta_title', set_value('meta_title'), 'class="form-control" id="meta_title"'); ?>
                      <?php echo form_label('Meta Title', 'meta_title'); ?><i class="form-group__bar"></i>
                    </div>
                  </div>
                </div>

                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="card-block__title">Meta Description</h3>
                    <div class="form-group">
                      <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."></textarea>
                      <i class="form-group__bar"></i> </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-12">
                    <h3 class="card-block__title">Additional Meta Tags</h3>
                    <div class="form-group">
                      <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."></textarea>
                      <i class="form-group__bar"></i> </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group form-group--float"> <?php echo form_input('sort_order', set_value('sort_order'), 'class="form-control" id="sort_order"'); ?>
                      <?php echo form_label('Sort Order', 'sort_order'); ?><i class="form-group__bar"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer modal-footer--bordered">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
                <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create team', 'class="btn btn-success waves-effect"'); ?> </div>

            </div>

            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
      <!--Add new modal ends-->
      <header class="content__title">
        <h1><?php echo $page_title; ?></h1>
        <div class="actions">
          <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>-->
        </div>
      </header>
      <div class="toolbar">
        <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo count($total_record); ?> Records</div>
        <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>
          <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
        </div>
        <div class="toolbar__search" style="display: none;">
          <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="team" data-forms_id="add_new_team">
          <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i> </div>
      </div>
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">List</h2>
        </div>
        <div class="card-block">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="list_search_result">
                <?php
                $i = 1;
                if (!empty($team)) {
                  foreach ($team as $pc) {
                    $PImages = json_decode($pc->image_fids);

                    ?>
                    <tr>
                      <th scope="row"><?php echo $i; ?></th>
                      <td>
                        <?php
                        if (count($PImages) > 0) {
                          for ($i = 0; $i < sizeof($PImages); $i++) {
                            ?>
                            <img src="<?php echo $this->media->getThumbPathById($PImages[$i], '65x49'); ?>" title="<?php echo $pc->team_title; ?>">
                          <?php }
                        } ?>
                      </td>
                      <td><?php echo $pc->team_title; ?></td>
                      <td>
                        <?php if (checkPermission('edit')) { ?>
                          <div class="form-group">
                            <div class="toggle-switch">
                              <?php if ($pc->status == 'active') {
                                $status = "checked";
                                $title = "Active";
                              } else {
                                $status = '';
                                $title = "Inactive";
                              } ?>
                              <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->team_id; ?>" data-control="team" id="status<?php echo $pc->team_id; ?>" title="<?php echo $title; ?>">
                              <i class="toggle-switch__helper"></i> </div>
                          </div>
                        <?php } ?>
                      </td>
                      <td>
                        <div class="btn-groups">
                          <?php if (checkPermission('edit')) { ?>
                            <?php echo anchor('sysadmin/team/edit/' . $pc->team_id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                          <?php }
                          if (checkPermission('delete')) { ?>
                            <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->team_id; ?>" data-control="team">Remove</a>
                          <?php } ?>
                        </div>
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
      </div>
      
      <?php if (checkPermission('create')) { ?>
        <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-team"></button>
      <?php } ?>


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
    var editor = CKEDITOR.replace('team_desc', {
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