<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-productcolor" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Product Color</h5>
      </div>
      <?php echo form_open('sysadmin/productcolor/create', 'id="add_new_productcolor" name="add_new_productcolor" data-controller="productcolor"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('productcolor_name', set_value('productcolor_name'), 'class="form-control" id="productcolor_name"'); ?> <?php echo form_label('Product Color name', 'name'); ?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group"> 
              <label>Color Type</label>
            <?php
                $options = array();      
                $options['single'] = 'Single Color';  
                $options['dual'] = 'Dual Color';
            ?>
            <?php echo form_dropdown('color_type', $options, '', 'class="select2 form-control" id="color_type"'); ?>
              <i class="form-group__bar"></i>
            </div> 
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('productcolor_value1', set_value('productcolor_value1'), 'class="form-control" type="color" id="productcolor_value1"'); ?> <?php echo form_label('Product Color Value 1', 'value'); ?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6 color_2">
            <div class="form-group form-group--float"> <?php echo form_input('productcolor_value2', set_value('productcolor_value2'), 'class="form-control" type="color" id="productcolor_value2"'); ?> <?php echo form_label('Product Color Value 2', 'value'); ?><i class="form-group__bar"></i> </div>
          </div>



        </div>
      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create Color', 'class="btn btn-success waves-effect"'); ?> </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!--Add new modal ends-->
<header class="content__title">
  <h1><?php echo $page_title; ?></h1>
  <div class="actions">
    <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>-->
  </div>
</header>
<div class="toolbar">
  <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo count($total_record); ?> Records</div>
  <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>
    <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
  </div>
  <div class="toolbar__search" style="display: none;">
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="productcolor" data-forms_id="add_new_productcolor">
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
            <th>Color Name</th>
            <th>Color Type</th>
            <th>Color Value</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php
          $i = 1;
          if (!empty($productcolor)) {
            foreach ($productcolor as $pc) {
              ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $pc->color_name; ?></td>
                <td><?php echo $pc->color_type; ?></td>
                <?php if($pc->color_type == 'dual'){  ?>
                
                    <td><label style="background-image: linear-gradient(140deg, #EADEDB 0%, <?php echo $pc->color_value1; ?> 50%, <?php echo $pc->color_value2; ?> 75%);height: 20px;width: 20px;"></label></td>
              <?php }else{ ?>
                    <td><label style="background-color:<?php echo $pc->color_value1; ?>;height: 20px;width: 20px;"></label></td>
              <?php } ?>
                
                <td>
                  <?php if (checkPermission('edit')) { ?>
                    <div class="form-group">
                      <div class="toggle-switch">
                        <?php if ($pc->status == 'active') {
                          $status = "checked";
                          $title = "Active";
                        } else {
                          $status = '';
                          $title = "Inactive";
                        } ?>
                        <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->color_id; ?>" data-control="productcolor" id="status<?php echo $pc->color_id; ?>" title="<?php echo $title; ?>">
                        <i class="toggle-switch__helper"></i> </div>
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-groups">
                    <?php if (checkPermission('edit')) { ?>
                      <?php echo anchor('sysadmin/productcolor/edit/' . $pc->color_id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                    <?php }
                    if (checkPermission('delete')) { ?>
                      <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->color_id; ?>" data-control="productcolor">Remove</a>
                    <?php } ?>
                  </div>
                </td>
              </tr>
              <?php $i++;
            }
          } else { ?>
            <tr>
              <td colspan="5" align="center">No record found...</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <table>
        <tr>
          <td colspan="5" align="right" style="font-size:12px;">
            <div class="center"><?php echo $pageing_link; ?></div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<?php if (checkPermission('create')) { ?>
  <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-productcolor"></button>
<?php } ?>
