<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content__inner">
  <header class="content__title">
    <h1>Form Elements</h1>
    <div class="actions"> <a href="#" class="actions__item zmdi zmdi-trending-up"></a> <a href="#" class="actions__item zmdi zmdi-check-all"></a>
      <div class="dropdown actions__item"> <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
        <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Refresh</a> <a href="#" class="dropdown-item">Manage Widgets</a> <a href="#" class="dropdown-item">Settings</a> </div>
      </div>
    </div>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit Groups</h2>
    </div>
    <div class="card-block"> <?php echo form_open('','');?>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('group_name',set_value('group_name',$group->name),'class="form-control" id="group_name"');?> <?php echo form_label('Group name','group_name');?> <?php echo form_error('group_name');?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('group_description',set_value('group_description',$group->description),'class="form-control" id="group_description"');?> <?php echo form_label('Group description','group_description');?> <?php echo form_error('group_description');?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
        <div class="form-group form-group--select">
            <div class="select">
              <?php echo form_label('Default Landing Page','default_page');?>
              <select class="form-control" id="default_page" name="default_page" required>
                <option value="">Select page</option>
               <?php if(count($modulesname)>0)
 			         {
					   foreach($modulesname as $module)
					   {?>
                        <option value="<?= $module->module_code;?>" <?php if($group->default_page==$module->module_code){ echo "selected";}?>><?= $module->module_name;?></option>
                       <?php }
                     } ?>
              </select>
              </div>
            </div>
          <!--<div class="form-group form-group--float"> <?php //echo form_input('default_page',set_value('default_page',$group->default_page),'class="form-control" id="default_page"');?> <?php //echo form_label('Default Landing Page','default_page');?> <?php //echo form_error('default_page');?> <i class="form-group__bar"></i> </div>-->
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <h3 class="card-block__title"><strong>Permissions</strong></h3>
        </div>
      </div>
      <br>
      <?php 

  	 if(isset($modulesname) && !empty($modulesname))
			  {
			   foreach($modulesname as $module)
			   {
				$key=$module->module_code;
			    $get_module_permission=$this->ion_auth->permissions((int) $group->id,$key)->row();   
			   //print_r($get_module_permission);
 			  ?>
      <h3 class="card-block__title"><strong><?php echo $module->module_name;?></strong></h3>
      <div class="row">
        <input type="hidden" name="modulesid[]" value="<?php echo $module->id;?>">
        <input type="hidden" name="modulesname[]" value="<?php echo $key;?>">
        <?php if(isset($allowedpermissions) && !empty($allowedpermissions))
                         {
                          foreach($allowedpermissions as $pr=>$prtext)
                           {
							if(!empty($get_module_permission)){
							 $check=($get_module_permission->$pr==1)?TRUE:FALSE; 
							}else{
							 $check=FALSE;	
							 }
							?>
        <div class="col-sm-3">
          <label class="custom-control custom-checkbox"> <?php echo form_checkbox($key."_".$pr, '1',set_checkbox($key."_".$pr, '1',$check),'class="custom-control-input"');?> <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $prtext;?></span> </label>
        </div>
        <?php }
                 }
               ?>
      </div>
      <br>
      <?php }} ?>
      <div class="row">
        <div class="form-group--centered col-sm-12"> <?php echo form_hidden('group_id',set_value('group_id',$group->id));?> <?php echo form_label('&nbsp;','');?> <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Save Changes', 'class="btn btn-success waves-effect"');?> <?php echo form_button(array('type'=>'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\''.site_url('sysadmin/groups').'\'"');?> </div>
      </div>
      <?php echo form_close();?> </div>
  </div>
</div>
