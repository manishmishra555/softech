<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $brand = $brand[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12"><?php echo $post_pics; ?></div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics">
              <?php
              $Ppics = (array) json_decode($brand->image_fids);
              echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('brand_name', set_value('brand_name', $brand->brand_name, false), 'class="form-control" id="brand_name"'); ?> <?php echo form_label('Brand name', 'brand_name'); ?> <?php echo form_error('brand_name'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>

      <div class="row">
       

        <div class="col-sm-6">
          <label class="custom-control custom-checkbox" style="margin-top:30px;"> <input type="checkbox" name="featured" value="1" class="custom-control-input" <?php if ($brand->featured == 1) {  echo "checked"; } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Featured</span> </label>
        </div>


        <div class="col-sm-6">
          <label class="custom-control custom-radio">
          <label class="custom-control custom-checkbox" style="margin-top:30px;">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($brand->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
          <label class="custom-control custom-checkbox" style="margin-top:30px;">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($brand->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('brand_id', set_value('brand_id', $brand->id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/brand') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>