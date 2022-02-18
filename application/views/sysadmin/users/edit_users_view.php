<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 eas
<div class="content__inner">
  <header class="content__title">
    <h1>User</h1>
    <div class="actions"> <a href="#" class="actions__item zmdi zmdi-trending-up"></a> <a href="#" class="actions__item zmdi zmdi-check-all"></a>
      <div class="dropdown actions__item"> <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
        <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Refresh</a> <a href="#" class="dropdown-item">Manage Widgets</a> <a href="#" class="dropdown-item">Settings</a> </div>
      </div>
    </div>
  </header>
  <div class="card">
    <div class="card-header">
      <h2 class="card-title">Edit User</h2>
    </div>
    <div class="card-block"> <?php echo form_open('', 'id="edit_user" name="edit_user"'); ?>
      <div class="row">
        <div class="col-sm-1">
          <div class="form-group form-group--select">
            <div class="select">
              <label>&nbsp;</label>
              <select class="form-control" id="salutation" name="salutation">

                <!--<option value="">&nbsp;</option>-->

                <option <?php if ($user->salutation == "Mr.") {
                          echo "selected";
                        } ?> value="Mr.">Mr.</option>
                <option <?php if ($user->salutation == "Mrs.") {
                          echo "selected";
                        } ?> value="Mrs.">Mrs.</option>
                <option <?php if ($user->salutation == "Ms.") {
                          echo "selected";
                        } ?> value="Ms.">Miss.</option>
                <option <?php if ($user->salutation == "Dr.") {
                          echo "selected";
                        } ?> value="Dr.">Dr.</option>
              </select>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="form-group form-group--float"> <?php echo form_input('first_name', set_value('first_name', $user->first_name), 'class="form-control" id="first_name"'); ?> <?php echo form_label('First name', 'first_name'); ?> <?php echo form_error('first_name'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('last_name', set_value('last_name', $user->last_name), 'class="form-control" id="last_name"'); ?> <?php echo form_label('Last Name', 'last_name'); ?> <?php echo form_error('last_name'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('company', set_value('company', $user->company), 'class="form-control" id="company"'); ?> <?php echo form_label('Company', 'company'); ?> <?php echo form_error('company'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('phone', set_value('phone', $user->phone), 'class="form-control" id="phone"'); ?> <?php echo form_label('Phone', 'phone'); ?> <?php echo form_error('phone'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('username', set_value('username', $user->username), 'class="form-control" id="username"'); ?> <?php echo form_label('Username', 'username'); ?> <?php echo form_error('username'); ?> <i class="form-group__bar"></i> </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group form-group--float"> <?php echo form_input('email', set_value('email', $user->email), 'class="form-control" id="email"'); ?> <?php echo form_label('Email', 'email'); ?> <?php echo form_error('email'); ?> <i class="form-group__bar"></i> </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <label>Address</label>
          <div class="form-group">
            <textarea class="form-control" placeholder="Write here..." style="overflow: hidden; word-wrap: break-word; height: 60px;" name="address" id="address"><?= $user->address; ?></textarea>
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
            <label>Locations</label>
            <?php
            $options = array();
            if (count($locations) > 0) {
              foreach ($locations as $lo) {
                $options[$lo->hid] = $lo->hosp_name;
              }
            }
            $selectd_options=explode(',',$user->locations);
            ?>
            <?php echo form_dropdown('locations[]', $options, $selectd_options, 'class="select2" id="locations" data-placeholder="Select location" multiple'); ?>
          </div>
        </div>
      </div>

      <h3 class="card-block__title">Groups</h3>
      <hr>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <?php if (isset($groups)) {
            foreach ($groups as $group) { ?>
              <label class="custom-control custom-checkbox"> <?php echo form_checkbox('groups[]', $group->id, set_checkbox('groups[]', $group->id, in_array($group->id, $usergroups)), 'class="custom-control-input"'); ?> <span class="custom-control-indicator"></span> <span class="custom-control-description"><?php echo $group->name; ?></span> </label>
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
                <?php /*if($user->legal_notification_alerts==1){ $status="checked"; $title="Active";}else{ $status=''; $title="Inactive";}*/ ?>
                <input class="toggle-switch__checkbox" type="checkbox" <?php //echo $status;
                                                                        ?> value="1"  id="legal_notification_alerts" name="legal_notification_alerts" title="Legal Notification Alerts">
                <i class="toggle-switch__helper litle_margin"></i> </div>
            </div>
       </div>
    </div>-->


      <br>
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group--centered"> <?php echo form_hidden('user_id', $user->id); ?> <?php echo form_label('&nbsp;', ''); ?> <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Save Changes', 'class="btn btn-success waves-effect"'); ?> <?php echo form_button(array('type' => 'button'), 'Cancel', 'class="btn btn-danger waves-effect" onclick="window.location.href=\'' . site_url('sysadmin/users') . '\'"'); ?> </div>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>