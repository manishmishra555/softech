<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title; ?></h1>
  </header>
    <?php $career = $career[0]; ?>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title" style="display: inline-block;">View</h2>
      <a href="<?php echo CV_FILES_URL.$career->file_name; ?>" download target="_blank" style="float: right;display: inline-block;" class="btn btn-primary waves-effect" id="view_cv" ><i class="zmdi zmdi-cloud-download"></i> Download CV</a>
    </div>
    <div class="card-block"> <?php echo form_open('', ''); ?>
      


      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('name', set_value('name', $career->name, false), 'class="form-control" id="name"'); ?> <?php echo form_label('Name', 'name'); ?> <?php echo form_error('name'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>


      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('email', set_value('email', $career->email, false), 'class="form-control" id="email"'); ?>
            <?php echo form_label('Email', 'email'); ?><i class="form-group__bar"></i>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('phone', set_value('phone', $career->phone, false), 'class="form-control" id="phone"'); ?>
            <?php echo form_label('Phone', 'phone'); ?><i class="form-group__bar"></i>
          </div>
        </div>
      </div>
      
       <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('city', set_value('city', $career->currentcity, false), 'class="form-control" id="city"'); ?>
            <?php echo form_label('City', 'city'); ?><i class="form-group__bar"></i>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('currentcompany', set_value('currentcompany', $career->currentcompany, false), 'class="form-control" id="currentcompany"'); ?>
            <?php echo form_label('Current Company', 'currentcompany'); ?><i class="form-group__bar"></i>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('designation', set_value('designation', $career->designation, false), 'class="form-control" id="designation"'); ?>
            <?php echo form_label('Designation', 'designation'); ?><i class="form-group__bar"></i>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group form-group--float"><?php echo form_input('currentctc', set_value('currentctc', $career->currentctc, false), 'class="form-control" id="currentctc"'); ?>
            <?php echo form_label('Current CTC', 'currentctc'); ?><i class="form-group__bar"></i>
          </div>
        </div>
      </div>


      

      <?php echo form_close(); ?>
    </div>
  </div>
</div>