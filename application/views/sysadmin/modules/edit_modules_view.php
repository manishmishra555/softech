<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="">
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $module = $module[0];
    $parent = $module->parent;
    $display = "";
    if ($parent == 0) {
      $display = 'style="display: none;"';
    }
    ?>
    <div class="card-block"> <?php echo form_open('', 'id="edit_module" name="edit_module"'); ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('module_name', set_value('module_name', $module->module_name), 'class="form-control" id="module_name"'); ?> <?php echo form_label('Module name', 'module_name'); ?> <?php echo form_error('module_name'); ?> <i class="form-module__bar"></i> </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group form-group--float">
            <?php echo form_input('module_code', set_value('module_code', $module->module_code), 'class="form-control" id="module_code"'); ?>
            <?php echo form_label('Module Code', 'module_code'); ?>
            <?php echo form_error('module_code'); ?> <i class="form-group__bar"></i> </div>
        </div>

      </div>

      <div>


        <?php $allmethods = loadClassMethods($module->module_code); ?>

        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Create</label>
              <select class="select2 roles" id="pr_create" name="pr_create[]" multiple data-placeholder="Select one or more modules">
                <?php $create = explode(',', $module->mod_create);
                echo selectedOption($create, $allmethods); ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Edit</label>
              <select class="select2 roles" id="pr_edit" name="pr_edit[]" multiple data-placeholder="Select one or more modules">
                <?php $create = explode(',', $module->mod_edit);
                echo selectedOption($create, $allmethods); ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>Delete</label>
              <select class="select2 roles" id="pr_delete" name="pr_delete[]" multiple data-placeholder="Select one or more modules">
                <?php $create = explode(',', $module->mod_delete);
                echo selectedOption($create, $allmethods); ?>
              </select>
            </div>
          </div>
          <div class="col-sm-6 col-md-6">
            <div class="form-group">
              <label>View</label>
              <select class="select2 roles" id="pr_view" name="pr_view[]" multiple data-placeholder="Select one or more modules">
                <?php $create = explode(',', $module->mod_view);
                echo selectedOption($create, $allmethods); ?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="form-group" style="margin-top:5%;">
            <strong>Menu Type: </strong>&nbsp;&nbsp;
            <label class="custom-control custom-radio">
              <input name="menu_type" class="custom-control-input" type="radio" value="0" <?php if ($parent == 0) {
                                                                                            echo 'checked="checked"';
                                                                                          } ?>>
              <span class="custom-control-indicator"></span> <span class="custom-control-description">Parent</span> </label>
            <label class="custom-control custom-radio">
              <input name="menu_type" class="custom-control-input" type="radio" value="1" <?php if ($parent != 0) {
                                                                                            echo 'checked="checked"';
                                                                                          } ?>>
              <span class="custom-control-indicator"></span> <span class="custom-control-description">Subcategory</span> </label>
          </div>
        </div>

        <div class="col-sm-6 col-md-6" id="subcategoryblock" <?= $display; ?>>
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
            $selectedOption = $module->parent; 
            ?>
            <?php echo form_dropdown('parent', $options, $selectedOption, 'class="select2 select2-single" id="parent" data-placeholder="Select Category"'); ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-4">
          <div class="form-group form-group--float">
            <?php echo form_input('orderno', set_value('orderno', $module->orderno), 'class="form-control" id="orderno"'); ?>
            <?php echo form_label('Menu order no.', 'orderno'); ?>
            <i class="form-group__bar"></i> </div>
        </div>

        <div class="col-sm-8">
          <div class="form-group" style="margin-top:3%;">
            <strong>Status: </strong>&nbsp;&nbsp;
            <label class="custom-control custom-radio">
              <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($module->status == 'active') {
                                                                                              echo "checked";
                                                                                            } ?>>
              <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
              <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($module->status == 'inactive') {
                                                                                                echo "checked";
                                                                                              } ?>>
              <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('module_id', set_value('module_id', $module->id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('modules') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>