<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content__inner">
  <header class="content__title">
    <h1><?php echo $page_title;?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $nationality=$nationality[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group form-group--float"> <?php echo form_input('name',set_value('name',$nationality->name,false),'class="form-control" id="nationality_name"');?> <?php echo form_label('Nationality name','nationality_name');?> <?php echo form_error('name');?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($nationality->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($nationality->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
      <br>
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('nationality_id',set_value('nationality_id',$nationality->id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/nationality').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
