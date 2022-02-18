<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-website_settings" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new settings</h5>
      </div>
      <?php echo form_open('sysadmin/website_settings/create','id="add_new_website_settings" name="add_new_website_settings" data-controller="website_settings"');?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('var_title',set_value('var_title'),'class="form-control" id="website_settings_name"');?> <?php echo form_label('Variable Title','var_title');?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('var_name',set_value('var_name'),'class="form-control" id="var_name"');?> <?php echo form_label('Variable Name','var_name');?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('setting_value',set_value('setting_value'),'class="form-control" id="setting_value"');?> <?php echo form_label('Setting Value','setting_value');?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Create Setting', 'class="btn btn-success waves-effect"');?> </div>
      <?php echo form_close();?> </div>
  </div>
</div>
<!--Add new modal ends-->
<header class="content__title">
  <h1><?php echo $page_title;?></h1>
</header>
<div class="toolbar">
  <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo count($total_record);?> Records</div>
  <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i> 
    <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
   </div>
  <div class="toolbar__search" style="display: none;">
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="website_settingss" data-forms_id="add_new_website_settings">
    <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i> </div>
</div>
<div class="card">
  <div class="card-header">
    <h2 class="card-title">List</h2>
  </div>
  <div class="card-block">
    <table class="table mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Variable Name</th>
          <th>Value</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="list_search_result">
        <?php
	   $i=1;
       if(!empty($results)){ 
	   foreach($results as $list)
       {
	   ?>
        <tr>
          <th scope="row"><?php echo $i;?></th>
          <td><?php echo $list->var_title;?></td>
          <td><?php echo $list->var_name;?></td>
          <td><?php echo substr($list->setting_value, 0, 200);?> </td>
          <td><div class="btn-groups"> 
		  <?php echo anchor('sysadmin/website_settings/edit/'.$list->id,'Edit','class="btn btn-primary waves-effect"');?> 
          <!-- <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php //echo $list->id;?>" data-control="website_settings">Remove</a> --> 
        </div>
      </td>
        </tr>
        <?php $i++;}}else{?>
        <tr><td colspan="5" align="center">No record found...</td></tr>
        <?php } ?>
      </tbody>
    </table>
    <table>
      <tr>
         <td colspan="5" align="right" style="font-size:12px;"><div class="center"><?php echo $pageing_link; ?></div></td>
      </tr>
    </table>
  </div>
</div>
<button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-website_settings"></button>
