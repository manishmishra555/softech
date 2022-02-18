<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $banner = $banner[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12"><?php echo $post_pics; ?></div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics">
              <?php
              $Ppics = (array) json_decode($banner->image_fids);
              echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
            </div>
          </div>
        </div>
      </div>

     <!--  <div class="row">
        <div class="col-sm-12">
          <h3 class="card-block__title">Mobile banner</h3>
          <?php //echo $post_pics2; ?>
        </div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics2">
              <?php
              /* $Ppics = (array) json_decode($banner->mobile_banner);
              echo $this->media_model->getImageBlock('post_pics2', '195x115', $Ppics); */ ?>
            </div>
          </div>
        </div>
      </div> -->

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"><?php echo form_input('banner_title', set_value('banner_title', $banner->banner_title, false), 'class="form-control" id="banner_title"'); ?> <?php echo form_label('Title', 'banner_title'); ?><i class="form-group__bar"></i> </div>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="card-block__title">Description</h3>
          <div class="form-group">
            <textarea class="form-control" rows="2" name="banner_desc" id="banner_desc"><?= $banner->banner_desc; ?></textarea>
            <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('banner_link', set_value('banner_link', $banner->banner_link, false), 'class="form-control" id="banner_link"'); ?> <?php echo form_label('Banner Link', 'banner_link'); ?><i class="form-group__bar"></i> </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($banner->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($banner->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('banner_id', set_value('banner_id', $banner->banner_id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/banner') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>