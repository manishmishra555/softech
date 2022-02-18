<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-brand" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Brand Category</h5>
      </div>
      <?php echo form_open('sysadmin/subbrands/create', 'id="brand" name="add_new_brand" data-controller="brand"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12">
            <h3 class="card-block__title">Brand Category Image</h3>
            <?php echo $post_pics; ?>
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <div class="col-sm-12 field_wrapper">
              <div id="post_pics">
                <?php
                if (isset($_POST['post_pics'])) {
                  $Ppics = (array) $_POST['post_pics'];
                  echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics);
                }
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('sub_brand_name', set_value('sub_brand_name'), 'class="form-control" id="sub_brand_name"'); ?> <?php echo form_label('Brand Category name', 'sub_brand_name'); ?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <label>&nbsp;</label>
                <?php
                   $options = array();                                 
                   $options[''] = 'Select Brand';                                 
                   if (count($brand) > 0) {                                 
                     foreach ($brand as $bc) {                                 
                       $options[$bc->id] = $bc->brand_name;
                      }                                 
                   } ?>
                <?php echo form_dropdown('brand', $options, '', 'class="select2" id="brand"'); ?>

          </div>
        </div>




    </div>
    <div class="modal-footer modal-footer--bordered">
      <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
      <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create Brand Category', 'class="btn btn-success waves-effect"'); ?> </div>
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
  <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo $total_record[0]->totalrecords; ?> Records</div>
  <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>
    <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>
      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>
    </div>-->
  </div>
  <div class="toolbar__search" style="display: none;">
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="brand" data-forms_id="add_new_brand">
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
            <th>Brand Name</th>
            <th>Sub Brand Name</th>
            <th>URL</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php
          $i = 1;
          if (!empty($sub_brand)) {
            foreach ($sub_brand as $pc) {
              $brand_data = $this->db->get_where('tbl_brand',array('id ' => $pc->brand_name))->result();
                                    
              $brand_name=isset($brand_data[0])?$brand_data[0]->brand_name:'';
          ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $brand_name; ?></td>
                <td><?php echo $pc->sub_brand_name; ?></td>
                <td><?php echo $pc->url_slug; ?></td>
               
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
                              }  ?>
                        <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->id; ?>" data-control="subbrands" id="status<?php echo $pc->id; ?>" title="<?php echo $title; ?>">
                        <i class="toggle-switch__helper"></i> </div>
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-groups">
                    <?php if (checkPermission('edit')) { ?>
                      <?php echo anchor('sysadmin/subbrands/edit/' . $pc->id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                    <?php }
                        if (checkPermission('delete')) { ?>
                      <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->id; ?>" data-control="subbrands">Remove</a>
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
<button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-brand"></button>