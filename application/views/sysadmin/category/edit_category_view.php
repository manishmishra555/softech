<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $category = $category[0]; ?>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      <div class="row">
        <div class="col-sm-12"><?php echo $post_pics; ?></div>
      </div>
      <div class="row">
        <div class="form-group">
          <div class="col-sm-12 field_wrapper">
            <div id="post_pics">
              <?php
              $Ppics = (array) json_decode($category->image_fids);
              echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics); ?>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('category_name', set_value('category_name', $category->category_name, false), 'class="form-control" id="category_name"'); ?> <?php echo form_label('Category name', 'category_name'); ?> <?php echo form_error('category_name'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('url_slug', set_value('url_slug', $category->url_slug, false), 'class="form-control" id="url_slug"'); ?>
            <?php echo form_label('Base URL', 'url_slug'); ?><i class="form-group__bar"></i>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('meta_title', set_value('meta_title', $category->meta_title, false), 'class="form-control" id="meta_title"'); ?>
            <?php echo form_label('Meta Title', 'meta_title'); ?><i class="form-group__bar"></i>
          </div>
        </div>
      </div>

      <br>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="card-block__title">Meta Description</h3>
          <div class="form-group">
            <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."><?= $category->meta_desc; ?></textarea>
            <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="card-block__title">Additional Meta Tags</h3>
          <div class="form-group">
            <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."><?= $category->additional_tag; ?></textarea>
            <i class="form-group__bar"></i> </div>
        </div>
      </div>



      <div class="row">
        <div class="col-sm-3">
          <label class="custom-control custom-radio">
            <label class="custom-control custom-checkbox" style="margin-top:30px;">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($category->status == 'active') {
                                                                                            echo "checked";
                                                                                          } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
          <label class="custom-control custom-radio">
            <label class="custom-control custom-checkbox" style="margin-top:30px;">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($category->status == 'inactive') {
                                                                                              echo "checked";
                                                                                            } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
         <div class="col-sm-3">
          <label class="custom-control custom-checkbox" style="margin-top:30px;"> <input type="checkbox" name="hasChild" value="1" class="custom-control-input" <?php if ($category->featured == 1) {
                                                                                                                                          echo "checked";
                                                                                                                                        } ?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Featured</span> </label>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="form-group--centered col-sm-12">
          <?php echo form_hidden('category_id', set_value('category_id', $category->cat_id)); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?>
          <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/category') . '\'"'); ?> </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>