<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!--Add new modal-->

<div class="modal fade note-view" id="add-user" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New User</h5>
      </div>
      <?php echo form_open('sysadmin/users/create', 'id="add_new_user" name="add_new_user" data-controller="users"'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-1">
            <div class="form-group form-group--select">
              <div class="select">
                <label>&nbsp;</label>
                <select class="form-control" id="salutation" name="salutation">
                  <option value="Mr.">Mr</option>
                  <option value="Mrs.">Mrs</option>
                  <option value="Ms.">Miss</option>
                  <option value="Dr.">Dr</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group form-group--float"> <?php echo form_input('first_name', set_value('first_name'), 'class="form-control" id="first_name"'); ?> <?php echo form_label('First name', 'first_name'); ?> <?php echo form_error('first_name'); ?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('last_name', set_value('last_name'), 'class="form-control" id="last_name"'); ?> <?php echo form_label('Last Name', 'last_name'); ?> <?php echo form_error('last_name'); ?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('company', set_value('company'), 'class="form-control" id="company"'); ?> <?php echo form_label('Company', 'company'); ?> <?php echo form_error('company'); ?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('phone', set_value('phone'), 'class="form-control" id="phone"'); ?> <?php echo form_label('Phone', 'phone'); ?> <?php echo form_error('phone'); ?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('username', set_value('username'), 'class="form-control" id="username"'); ?> <?php echo form_label('Username', 'username'); ?> <?php echo form_error('username'); ?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_input('email', set_value('email'), 'class="form-control" id="email"'); ?> <?php echo form_label('Email', 'email'); ?> <?php echo form_error('email'); ?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label>Address</label>
            <div class="form-group">
              <textarea class="form-control" placeholder="Write here..." style="overflow: hidden; word-wrap: break-word; height: 60px;" name="address" id="address"></textarea>
              <i class="form-group__bar"></i>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_password('password', set_value('password'), 'class="form-control" id="password"'); ?> <?php echo form_label('Password', 'password'); ?> <?php echo form_error('password'); ?> <i class="form-group__bar"></i> </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group form-group--float"> <?php echo form_password('password_confirm', set_value('password_confirm'), 'class="form-control" id="password_confirm"'); ?> <?php echo form_label('Confirm password', 'password_confirm'); ?> <?php echo form_error('password_confirm'); ?> <i class="form-group__bar"></i> </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 col-md-12">
            <div class="form-group">
              <label>Location</label>              
                <?php
                $options = array();
                if (count($locations) > 0) {
                  foreach ($locations as $lo) {
                    $options[$lo->hid] = $lo->hosp_name;
                  }
                }
                ?>
               <?php echo form_dropdown('locations[]', $options, '', 'class="select2" id="locations" data-placeholder="Select location" multiple'); ?> </div>
          </div>
        </div>
      

      <h3 class="card-block__title">Groups</h3>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <?php if (isset($groups)) {

            foreach ($groups as $group) { ?>
              <label class="custom-control custom-checkbox"> <?php echo form_checkbox('groups[]', $group->id, set_checkbox('groups[]', $group->id), 'class="custom-control-input"'); ?> <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $group->name; ?></span> </label>
            <?php }
          }
          ?>
        </div>
      </div>

      <!--<br><br><h3 class="card-block__title">Notification alerts</h3>
    <hr>    
    <div class="row">
    <div class="col-sm-6">
       <div class="form-group">
               <label class="card-block__title">Legal Compliance Notification alerts:   </label>
               <div class="toggle-switch">
                 <input class="toggle-switch__checkbox" type="checkbox" value="1" id="legal_notification_alerts" name="legal_notification_alerts" title="Legal Compliance Notification Alerts (ON/OFF)">
                <i class="toggle-switch__helper litle_margin"></i> </div>
            </div>
       </div>
    </div>-->

    </div>
    <div class="modal-footer modal-footer--bordered">
      <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button>
      <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Create User', 'class="btn btn-success waves-effect"'); ?> </div>
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
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="users" data-forms_id="add_new_user">
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
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Last login</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php

          $i = 1;

          if (!empty($users)) {

            foreach ($users as $user) {

              ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $user->username; ?></td>
                <td><?php echo $user->salutation . " " . $user->first_name . ' ' . $user->last_name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo date('Y-m-d H:i:s', $user->last_login); ?></td>
                <td><?php

                    if ($current_user->id != $user->id) {
                      if (checkPermission('edit')) {
                        ?>
                      <div class="form-group">
                        <div class="toggle-switch">
                          <?php if ($user->active == 1) {
                            $status = "checked";
                            $title = "Active";
                          } else {
                            $status = '';
                            $title = "Inactive";
                          } ?>
                          <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $user->active; ?>" data-id="<?php echo $user->id; ?>" data-control="users" id="status<?php echo $user->id; ?>" title="<?php echo $title; ?>">
                          <i class="toggle-switch__helper"></i> </div>
                      </div>
                    <?php }
                  } ?></td>
                <td>
                  <div class="btn-group">
                    <?php

                    if ($current_user->id != $user->id) {
                      if (checkPermission('edit')) {
                        echo anchor('sysadmin/users/edit/' . $user->id, 'Edit', 'class="btn btn-primary waves-effect"');
                      }
                      if (checkPermission('delete')) {
                        echo anchor('sysadmin/users/delete/' . $user->id, 'Remove', 'class="btn btn-danger waves-effect"');
                      }
                    }

                    ?>
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
  <button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-user"></button>
<?php } ?>