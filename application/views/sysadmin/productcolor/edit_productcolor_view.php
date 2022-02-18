<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="">
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $productcolor = $productcolor[0];$color_type = $productcolor->color_type; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('productcolor_name', set_value('productcolor_name', $productcolor->color_name, false), 'class="form-control" id="productcolor_name"'); ?> <?php echo form_label('Product Color name', 'name'); ?> <?php echo form_error('name'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group"> 
              <label>Color Type</label>
            <?php
                $options = array();      
                $options['single'] = 'Single Color';  
                $options['dual'] = 'Dual Color';
            ?>
            <?php echo form_dropdown('color_type', $options, $color_type, 'class="select2 form-control" id="color_type"'); ?>
              <i class="form-group__bar"></i>
            </div> 
          </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('productcolor_value1', set_value('productcolor_value1', $productcolor->color_value1, false), 'class="form-control" id="productcolor_value1"'); ?> <?php echo form_label('Product Color value 1', 'value1'); ?> <?php echo form_error('value1'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('productcolor_value2', set_value('productcolor_value2', $productcolor->color_value2, false), 'class="form-control" id="productcolor_value2"'); ?> <?php echo form_label('Product Color value 2', 'value2'); ?> <?php echo form_error('value2'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($productcolor->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($productcolor->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('productcolor_id', set_value('productcolor_id', $productcolor->color_id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/productcolor') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>