<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-menulabel" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Menu Label</h5>
      </div>
      <?php echo form_open('','id="add_new_menulabel" name="add_new_menulabel"');?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('name',set_value('name'),'class="form-control" id="name"');?> <?php echo form_label('Menu Label name','name');?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('icon',set_value('icon'),'class="form-control" id="icon"');?> <?php echo form_label('Menu Label icon','icon');?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group form-group--float">
             <?php echo form_input('order_no',set_value('order_no'),'class="form-control" id="order_no"');?> 
             <?php echo form_label('Menu order no.','order_no');?>
             <i class="form-group__bar"></i> </div>
          </div> 
        </div>
      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type'=>'submit','name'=>'submit'), 'Create menulabel', 'class="btn btn-success waves-effect"');?> </div>
      <?php echo form_close();?> </div>
  </div>
</div>
<!--Add new modal ends-->
<header class="content__title">
  <h1><?php echo $page_title;?></h1>
  <div class="actions"> <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>--> </div>
</header>
<div class="toolbar">
  <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo count($total_record);?> Records</div>
  <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i> 
    <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
   </div>
  <div class="toolbar__search" style="display: none;">
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="menulabel" data-forms_id="add_new_menulabel">
    <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i> </div>
</div>
<div class="card">
  <div class="card-header">
    <h2 class="card-title">List</h2>
  </div>
  <div class="card-block">
    <div class="table-responsive">
    <table class="table mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Menu Label Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="list_search_result">
        <?php
	   $i=1;
       if(!empty($menulabel)){ 
	   foreach($menulabel as $pc)
       {
	   ?>
        <tr>
          <th scope="row"><?php echo $i;?></th>
          <td><?php echo $pc->name;?></td>
          <td><div class="form-group">
              <div class="toggle-switch">
                <?php if($pc->status=='active'){ $status="checked"; $title="Active";}else{ $status=''; $title="Inactive";}?>
                <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status;?> value="<?php echo $pc->status;?>" data-id="<?php echo $pc->id;?>" data-control="menulabel" id="status<?php echo $pc->id;?>" title="<?php echo $title;?>">
                <i class="toggle-switch__helper"></i> </div>
            </div></td>
          <td><div class="btn-groups"> 
		  <?php echo anchor('menulabel/edit/'.$pc->id,'Edit','class="btn btn-primary waves-effect"');?> 
          <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->id;?>" data-control="menulabel">Remove</a> </div></td>
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
</div>
<button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-menulabel"></button>
