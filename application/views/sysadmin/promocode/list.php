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
          <div class="actions">
            <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>-->
          </div>
        </header>
        <div class="toolbar">
          <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo $total_record; ?> Records</div>
          <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>
            <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
          </div>
          <div class="toolbar__search" style="display: none;">
            <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="promocode" data-forms_id="add_new_promocode">
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
                     <th>Promocode Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="list_search_result">
                  <?php
                  $j = 1;
                  if (!empty($promocode)) {
                    foreach ($promocode as $pc) {
 
                      ?>
                      <tr>
                        <th scope="row"><?php echo $j; ?></th>
                        <td><?php echo $pc->promocode_name; ?></td>
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
                                <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->id; ?>" data-control="promocode" id="status<?php echo $pc->id; ?>" title="<?php echo $title; ?>">
                                <i class="toggle-switch__helper"></i> </div>
                            </div>
                          <?php } ?>
                        </td>
                        <td>
                          <div class="btn-groups">
                            <?php if (checkPermission('edit')) { ?>
                              <?php echo anchor('sysadmin/promocode/edit/' . $pc->id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                            <?php }
                                if (checkPermission('delete')) { ?>
                              <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->id; ?>" data-control="promocode">Remove</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    <?php $j++;
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
          <a class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" href="<?= site_url('sysadmin/promocode/create'); ?>"></a>
        <?php } ?>

        <?php $this->load->view('templates/common/master_footer_view'); ?>
    </section>
  </main>
  <?php $this->load->view('templates/common/master_page_js_noapp'); ?>
  <?php echo $extrajs; ?>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/custom.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/app.min.js"></script>
    
  <?php echo getExtraThing(); ?>
</body>

</html>