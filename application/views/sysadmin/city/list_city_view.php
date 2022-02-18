<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->
<div class="modal fade note-view" id="add-city" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New City</h5>
      </div>
      <?php echo form_open('sysadmin/city/create', 'id="add_new_city" name="add_new_city" data-controller="city"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('name', set_value('name'), 'class="form-control" id="name"'); ?> <?php echo form_label('City name', 'name'); ?><i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <?php echo form_label('Country', 'country'); ?>
            <div class="form-group form-group--select">
              <div class="select">
                <?php
                $options = array();
                $options[''] = 'Select Country';
                if (count($country) > 0) {
                  foreach ($country as $c) {
                    $options[$c->id] = $c->country_name;
                  }
                }
                $select_option = 99;
                ?>
                <?php echo form_dropdown('country', $options, $select_option, 'class="form-control" id="country"'); ?>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"><?php echo form_input('url_slug', set_value('url_slug'), 'class="form-control" id="url_slug"'); ?>
              <?php echo form_label('Base URL', 'url_slug'); ?><i class="form-group__bar"></i>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('h1_tag', set_value('h1_tag'), 'class="form-control" id="h1_tag"'); ?>
              <?php echo form_label('H1 Tag', 'h1_tag'); ?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group form-group--float"><?php echo form_input('meta_title', set_value('meta_title'), 'class="form-control" id="meta_title"'); ?>
              <?php echo form_label('Meta Title', 'meta_title'); ?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>

        <br>
        <div class="row">
          <div class="col-sm-12">
            <h3 class="card-block__title">Meta Description</h3>
            <div class="form-group">
              <textarea class="form-control" rows="3" name="meta_desc" id="meta_desc" placeholder="Write here...."></textarea>
              <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-sm-12">
            <h3 class="card-block__title">Additional Meta Tags</h3>
            <div class="form-group">
              <textarea class="form-control" rows="3" name="additional_tag" id="additional_tag" placeholder="Write here...."></textarea>
              <i class="form-group__bar"></i> </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('sort_order', set_value('sort_order'), 'class="form-control" id="sort_order"'); ?>
              <?php echo form_label('Sort Order', 'sort_order'); ?><i class="form-group__bar"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create city', 'class="btn btn-success waves-effect"'); ?> </div>
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
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="city" data-forms_id="add_new_city">
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
            <th>City Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php
          $i = 1;
          if (!empty($city)) {
            foreach ($city as $pc) {
              ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $pc->name; ?></td>
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
                        <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->id; ?>" data-control="city" id="status<?php echo $pc->id; ?>" title="<?php echo $title; ?>">
                        <i class="toggle-switch__helper"></i> </div>
                    </div>
                  <?php } ?>
                </td>
                <td>
                  <div class="btn-groups">
                    <?php if (checkPermission('edit')) { ?>
                      <?php echo anchor('sysadmin/city/edit/' . $pc->id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                    <?php }
                    if (checkPermission('delete')) { ?>
                      <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->id; ?>" data-control="city">Remove</a>
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
  <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-city"></button>
<?php } ?>