<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content__inner">
  <header class="content__title">
    <h1><?php echo $page_title;?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $menulabel=$menulabel[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group form-group--float"> <?php echo form_input('name',set_value('name',$menulabel->name,false),'class="form-control" id="menulabel_name"');?> <?php echo form_label('Menu Label name','menulabel_name');?> <?php echo form_error('name');?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group form-group--float">
             <?php echo form_input('icon',set_value('icon',$menulabel->icon,false),'class="form-control" id="icon"');?> 
             <?php echo form_label('Menu Label icon','icon');?>
             <i class="form-group__bar"></i> </div>
          </div>
         <div class="col-sm-4">
            <div class="form-group form-group--float">
             <?php echo form_input('order_no',set_value('order_no',$menulabel->order_no),'class="form-control" id="order_no"');?> 
             <?php echo form_label('Menu order no.','order_no');?>
             <i class="form-group__bar"></i> </div>
          </div> 
      </div>
      <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($menulabel->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($menulabel->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
      <br>
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('menulabel_id',set_value('menulabel_id',$menulabel->id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('menulabel').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
