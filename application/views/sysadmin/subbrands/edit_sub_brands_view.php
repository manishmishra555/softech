<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $subbrand = $subbrand[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12"><?php echo $post_pics; ?></div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics">
              <?php
              $Ppics = (array) json_decode($subbrand->image_fids);
              echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
            </div>
          </div>
        </div>
      </div>

      <?php

          $brand_data = $this->db->get_where('tbl_brand',array('id ' => $subbrand->brand_name))->result();
          $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';


      ?>


      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('sub_brand_name', set_value('sub_brand_name', $subbrand->sub_brand_name, false), 'class="form-control" id="sub_brand_name"'); ?> <?php echo form_label('Brand Category name', 'sub_brand_name'); ?> <?php echo form_error('sub_brand_name'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <?php
            $options = array();
            $options[''] = 'Select Brand';
            if (count($brands) > 0) {
              foreach ($brands as $bc) {
                $options[$bc->id] = $bc->brand_name;
              }
            }
            $selected_brand = $subbrand->brand_name;
            ?><?php echo form_label('Brand name', 'brand_name'); ?>
            <?php echo form_dropdown('brand', $options, $selected_brand, 'class="select2" id="brand"'); ?>
        </div>
      </div>




      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($subbrand->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($subbrand->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('brand_id', set_value('brand_id', $subbrand->id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/subbrands') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>