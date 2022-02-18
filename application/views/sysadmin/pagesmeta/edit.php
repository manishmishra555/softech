<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div>
  <header class="content__title">
    <h1><?php echo $page_title;?></h1>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit</h2>
    </div>
    <?php $pagesmeta=$pagesmeta[0];?>
    <div class="card-block"> <?php echo form_open('','');?>
      <div class="row">
        <div class="col-sm-12">
           <div class="form-group form-group--float"> <?php echo form_input('page_name',set_value('page_name',$pagesmeta->page_name,false),'class="form-control" id="page_name" disabled');?> <?php echo form_label('Page Name','page_name');?><i class="form-group__bar"></i> </div>
          </div>          
        </div>

       <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('pagesmeta_title',set_value('pagesmeta_title',$pagesmeta->pagesmeta_title,false),'class="form-control" id="pagesmeta_title"');?> <?php echo form_label('Title','pagesmeta_title');?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('h1_text',set_value('h1_text',$pagesmeta->h1_text,false),'class="form-control" id="h1_text"');?> <?php echo form_label('H1 Text','h1_text');?><i class="form-group__bar"></i> </div>
          </div>
        </div>

       <div class="row">
        <div class="col-sm-12">
          <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="active" <?php if($pagesmeta->status=='active'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
            <label class="custom-control custom-radio">
            <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if($pagesmeta->status=='inactive'){ echo "checked";}?>>
            <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
        </div>
      </div>
       
      <br>
        <div class="row">
            <div class="col-sm-12">
              <h3 class="card-block__title">Description</h3>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="pagesmeta_desc" id="pagesmeta_desc" placeholder="Write here...."><?= $pagesmeta->pagesmeta_desc;?></textarea>
                <i class="form-group__bar"></i> </div>
            </div>
          </div>
       
      <div class="row">
        <div class="form-group--centered col-sm-12"> 
		<?php echo form_hidden('page_id',set_value('page_id',$pagesmeta->page_id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> 
		<?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/pagesmeta').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
