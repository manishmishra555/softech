<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $enquiry = $enquiry[0]; ?>
<div class="card profile">

  <div class="profile__info">
    <h1><?= $enquiry->patient_name; ?></h1>

    <ul class="icon-list">
      <li><strong>Location</strong> : <?= $hospital_name; ?></li>
      <li><strong>Phone</strong> : <?= $enquiry->phone; ?></li>
      <li><strong>Email</strong> : <?= $enquiry->email; ?></li>
      <li><strong>Age</strong> : <?= $enquiry->age; ?></li>
      <li><strong>Gender</strong> : <?= $enquiry->gender; ?></li>
    </ul>
  </div>
</div>

<div class="messages">
  <div class="messages__body">

    <div class="messages__content">
      <div class="messages__item">
        <div class="messages__details">
          <p><?= $enquiry->comments; ?></p>
          <small><i class="zmdi zmdi-time"></i> <?= date('d/m/Y', strtotime($enquiry->date_added)); ?> at <?= date('H:i', strtotime($enquiry->date_added)); ?></small>
        </div>
      </div>

      <?php $enq = getenquirythread($enquiry->eid);
      if (count($enq) > 0) {
        foreach ($enq as $e) {
          $uid = $e->uid;
          if (empty($uid)) { ?>
            <div class="messages__item">
              <div class="messages__details">
                <p><?= $e->comments; ?></p>
                <small><i class="zmdi zmdi-time"></i> <?= date('d/m/Y', strtotime($e->date_added)); ?> at <?= date('H:i', strtotime($e->date_added)); ?></small>
              </div>
            </div>
          <?php  } else { ?>
            <div class="messages__item messages__item--right">
              <div class="messages__details">
                <p><?= $e->comments; ?></p>
                <?php $user = getUsersByID($uid);
                $name = $user[0]->first_name . " " . $user[0]->last_name; ?>
                <small><?= $name; ?> - <i class="zmdi zmdi-time"></i> <?= date('d/m/Y', strtotime($e->date_added)); ?> at <?= date('H:i', strtotime($e->date_added)); ?></small>
              </div>
            </div>
          <?php }
      } ?>

      <?php } ?>


    </div>

    <div class="messages__reply">
      <?php echo form_open('', array('class' => 'form-horizontal', 'id' => 'enquiry_reply')); ?>
      <input type="hidden" id="eid" name="eid" value="<?= $enquiry->eid; ?>">
      <textarea class="messages__reply__text" name="message" id="message" placeholder="Type a message..." required></textarea>
      <button type="submit" class="btn btn-success btn--icon messages__reply__btn" id="messagereply"><i class="zmdi zmdi-mail-send"></i></button>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>