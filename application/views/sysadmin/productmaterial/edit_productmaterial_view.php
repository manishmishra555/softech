<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="">
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $productmaterial = $productmaterial[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('productmaterial_value', set_value('productmaterial_value', $productmaterial->material_name, false), 'class="form-control" id="productmaterial_value"'); ?> <?php echo form_label('Product Material name', 'name'); ?> <?php echo form_error('name'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($productmaterial->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($productmaterial->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('id', set_value('id', $productmaterial->id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/productmaterial') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>