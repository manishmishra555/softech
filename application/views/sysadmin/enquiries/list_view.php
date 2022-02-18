<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!--View Enquiry modal-->
 <div class="modal fade note-view" id="view-enquiries" data-backdrop="static" data-keyboard="false" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enquiry Details</h5>
      </div>
       
      <div class="modal-body">
         <div class="card profile">
                          <div class="profile__info">
                         
                             <dl class="row">
                                <dt class="col-sm-3">Name: </dt>
                                <dd class="col-sm-3" id="name"></dd>
                             
                                <dt class="col-sm-3">Email: </dt>
                                <dd class="col-sm-3" id="email"></dd>

                                <dt class="col-sm-3 text-truncate">Phone: </dt>
                                <dd class="col-sm-3" id="phone"></dd>

                                <dt class="col-sm-3 text-truncate"></dt>
                                <dd class="col-sm-3" id="phone"></dd>
                                 
                                <dt class="col-sm-3 text-truncate">Message: </dt>
                                <dd class="col-sm-9" id="message"></dd>

                             </dl>
                          </div>
                        </div>

       </div>
      <div class="modal-footer modal-footer--bordered"><button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button> </div>
     </div>
  </div>
</div>
<!--View Enquiry modal ends-->
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
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="enquiries" data-forms_id="add_new_enquiries">
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
          <th>Name</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="list_search_result">
        <?php
	   $i=1;
        if(!empty($enquiries)){ 
	   foreach($enquiries as $pc)
       {
	   ?>
        <tr>
          <th scope="row"><?php echo $i;?></th>
          <td><?php echo $pc->name;?></td>
          <td><?php echo $pc->message;?></td>
          <td><div class="btn-groups"> 
		       <button class="btn btn-primary waves-effect view_enquiry" data-toggle="modal" data-target="#view-enquiries" type="button" data-id="<?= $pc->eid;?>" title="View Enquiry" id="viewenquiry">View Enquiry</button>
          <!-- <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php //echo $pc->eid;?>" data-control="enquiries">Remove</a> </div></td> -->
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
<button class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" data-toggle="modal" data-target="#add-enquiries"></button>
