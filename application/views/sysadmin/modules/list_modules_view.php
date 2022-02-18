<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-module" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new module</h5>
      </div>
      <?php echo form_open('sysadmin/modules/create', 'id="add_new_module" name="add_new_module" data-controller="modules"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('module_name', set_value('module_name'), 'class="form-control" id="module_name"'); ?> <?php echo form_label('Module name', 'module_name'); ?> <?php echo form_error('module_name'); ?> <i class="form-group__bar"></i> </div>
          </div>

          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('module_code', set_value('module_code'), 'class="form-control" id="module_code"'); ?> <?php echo form_label('Module Code', 'module_code'); ?> <?php echo form_error('module_code'); ?> <i class="form-group__bar"></i> </div>
          </div>

        </div>



        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Create</label>
              <select class="select2 roles" id="pr_create" name="pr_create[]" multiple data-placeholder="Select one or more modules">

              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Edit</label>
              <select class="select2 roles" id="pr_edit" name="pr_edit[]" multiple data-placeholder="Select one or more modules">
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Delete</label>
              <select class="select2 roles" id="pr_delete" name="pr_delete[]" multiple data-placeholder="Select one or more modules">
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>View</label>
              <select class="select2 roles" id="pr_view" name="pr_view[]" multiple data-placeholder="Select one or more modules">
              </select>
            </div>
          </div>
        </div>


        <div class="row">

          <div class="col-sm-6">
            <div class="form-group" style="margin-top:7%;">
              <strong>Menu Type: </strong>&nbsp;&nbsp;
              <label class="custom-control custom-radio">
                <input name="menu_type" class="custom-control-input" type="radio" value="0" checked="checked">
                <span class="custom-control-indicator"></span> <span class="custom-control-description">Parent</span> </label>
              <label class="custom-control custom-radio">
                <input name="menu_type" class="custom-control-input" type="radio" value="1">
                <span class="custom-control-indicator"></span> <span class="custom-control-description">Subcategory</span> </label>
            </div>
          </div>

          <div class="col-sm-6 col-md-6" id="subcategoryblock" style="display: none;">
            <div class="form-group">
              <label>Category</label>
              <?php
              $options = array();
              $options[''] = 'Select Category';
              if (count($menulabel) > 0) {
                foreach ($menulabel as $menu) {
                  $options[$menu->id] = $menu->module_name;
                }
              }
              ?>
              <?php echo form_dropdown('parent', $options, '', 'class="select2 select2-single" id="parent" data-placeholder="Select Category"'); ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4">
            <div class="form-group form-group--float">
              <?php echo form_input('orderno', set_value('orderno', ''), 'class="form-control" id="orderno"'); ?>
              <?php echo form_label('Menu order no.', 'orderno'); ?>
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create module', 'class="btn btn-success waves-effect"'); ?> </div>
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
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="modules" data-forms_id="add_new_module">
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
            <th>Module Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php
          if ($total_pages > 0) {
            $i = $total_pages + 1;
          } else {
            $i = 1;
          }
          if (!empty($modules)) {
            foreach ($modules as $module) {
              ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $module->module_name; ?></td>
                <td>
                  <?php if (checkPermission('edit')) { ?>
                    <div class="form-group">
                      <div class="toggle-switch">
                        <?php if ($module->status == 'active') {
                          $status = "checked";
                          $title = "Active";
                        } else {
                          $status = '';
                          $title = "Inactive";
                        } ?>
                        <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $module->status; ?>" data-id="<?php echo $module->id; ?>" data-control="modules" id="status<?php echo $module->id; ?>" title="<?php echo $title; ?>">
                        <i class="toggle-switch__helper"></i> </div>
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-groups">
                    <?php if (checkPermission('edit')) { ?>
                      <?php echo anchor('sysadmin/modules/edit/' . $module->id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                    <?php }
                    if (checkPermission('delete')) { ?>
                      <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $module->id; ?>" data-control="modules">Remove</a>
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
  <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-module"></button>
<?php } ?>