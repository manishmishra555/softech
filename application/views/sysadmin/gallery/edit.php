<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $gallery = $gallery[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12"><?php echo $post_pics; ?></div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics">
              <?php
              $Ppics = (array) json_decode($gallery->image_fids);
              echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
            </div>
          </div>
        </div>
      </div>
 
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"><?php echo form_input('gallery_title', set_value('gallery_title', $gallery->gallery_title, false), 'class="form-control" id="gallery_title"'); ?> <?php echo form_label('Title', 'gallery_title'); ?><i class="form-group__bar"></i> </div>
        </div>
      </div>

       
      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($gallery->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($gallery->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('gallery_id', set_value('gallery_id', $gallery->gallery_id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/webgallery') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>