<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->

<div class="modal fade note-view" id="add-group" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add new group</h5>
      </div>
      <?php echo form_open('sysadmin/groups/create', 'id="add_new_group" name="add_new_group" data-controller="groups"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('group_name', set_value('group_name'), 'class="form-control" id="group_name"'); ?> <?php echo form_label('Group name', 'group_name'); ?> <?php echo form_error('group_name'); ?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('group_description', set_value('group_description'), 'class="form-control" id="group_description"'); ?> <?php echo form_label('Group description', 'group_description'); ?> <?php echo form_error('group_description'); ?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--select">
              <div class="select">
                <?php echo form_label('Default Landing Page', 'default_page'); ?>
                <select class="form-control" id="default_page" name="default_page" required>
                  <option value="">Select page</option>
                  <?php if (count($modulesname) > 0) {
                    foreach ($modulesname as $module) { ?>
                      <option value="<?= $module->module_code; ?>"><?= $module->module_name; ?></option>
                    <?php }
                  } ?>
                </select>
              </div>
            </div>
            <!--<div class="form-group form-group--float"> <?php //echo form_input('default_page',set_value('default_page'),'class="form-control" id="default_page"');
                                                            ?>  <?php //echo form_error('default_page');
                                                                ?> <i class="form-group__bar"></i> </div>-->
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <h3 class="card-block__title"><strong>Permissions</strong></h3>
          </div>
        </div>
        <br>
        <?php

        //$modulesname=$this->config->item('modulesname');

        //$allowedpermissions=$this->config->item('allowedpermissions');

        if (count($modulesname) > 0) {
          foreach ($modulesname as $module) {
            $key = $module->module_code;
            ?>
            <h3 class="card-block__title"><strong><?php echo $module->module_name; ?></strong></h3>
            <div class="row">
              <input type="hidden" name="modulesid[]" value="<?php echo $module->id; ?>">
              <input type="hidden" name="modulesname[]" value="<?php echo $key; ?>">
              <?php if (isset($allowedpermissions) && !empty($allowedpermissions)) {
                foreach ($allowedpermissions as $pr => $prtext) { ?>
                  <div class="col-sm-3">
                    <label class="custom-control custom-checkbox"> <?php echo form_checkbox($key . "_" . $pr, '1', set_checkbox($key . "_" . $pr, '1'), 'class="custom-control-input"'); ?> <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $prtext; ?></span> </label>
                  </div>
                <?php }
              }

              ?>
            </div>
            <br>
          <?php }
        } ?>
      </div>
      <div class="modal-footer modal-footer--bordered">
        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
        <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create group', 'class="btn btn-success waves-effect"'); ?> </div>
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
            <th>Group Name</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $i = 1;

          if (!empty($groups)) {

            foreach ($groups as $group) {

              ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $group->name; ?></td>
                <td><?php echo $group->description; ?></td>
                <td>
                  <div class="btn-group">
                    <?php if (checkPermission('edit')) { ?>
                      <?php echo anchor('sysadmin/groups/edit/' . $group->id, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                    <?php }
                    if (checkPermission('delete')) { ?>
                      <?php if (!in_array($group->name, array('admin', 'members')))
                        echo anchor('sysadmin/groups/delete/' . $group->id, 'remove', 'class="btn btn-primary waves-effect"'); ?>
                    <?php } ?>
                  </div>
                </td>
              </tr>
              <?php $i++;
            }
          } else { ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php if (checkPermission('create')) { ?>
  <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-group"></button>
<?php } ?>