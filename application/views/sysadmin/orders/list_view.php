<?php defined('BASEPATH') or exit('No direct script access allowed'); 
  $all_order_status = array('0' => 'Placed', '1' => 'Dispatched', '2' => 'Out for delivery', '3' => 'Delivered');

?>
<style>
    .col-sm-3{
        word-break: break-all;
    }
</style>
<!-- Order Modal-->
<div class="modal fade note-view" id="view-order" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Order Details</h5>
      </div>

      <div class="modal-body">
        <div class="card profile">
          <div class="profile__info">

            <dl class="row">
              <dl class="row">
                <dt class="col-sm-3">Customers Name: </dt>
                <dd class="col-sm-3" id="customer_name"></dd>

                <dt class="col-sm-3">Mobile</dt>
                <dd class="col-sm-3" id="mobile">&nbsp;</dd>

                <dt class="col-sm-3">Email ID</dt>
                <dd class="col-sm-3" id="email">&nbsp;</dd>

                <dt class="col-sm-3">Company Name</dt>
                <dd class="col-sm-3" id="company">&nbsp;</dd>

                <dt class="col-sm-3">Order Date: </dt>
                <dd class="col-sm-3" id="order_date"></dd>

                <dt class="col-sm-3 text-truncate">Total items: </dt>
                <dd class="col-sm-3" id="total_items"></dd>

                <dt class="col-sm-3 text-truncate">Message: </dt>
                <dd class="col-sm-3" id="message"></dd>





              </dl>
          </div>
        </div>

        <table class="table mb-0">
          <thead>
            <tr>
              <th colspan="4" class="text-center">
                <h5>Items Details</h5>
              </th>
            </tr>
            <tr>
              <th>Item Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Tax</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody id="itemlist"></tbody>
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <td>Sub Total</td>
              <td id="order_subtotal"></td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>Total</td>
              <td id="total_amount">-</td>
            </tr>
          </tfoot>
        </table>


      </div>
      <div class="modal-footer modal-footer--bordered"><button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button> </div>
    </div>
  </div>
</div>
<!-- Order modal ends -->

<!-- Order Modal-->
<div class="modal fade note-view" id="update-status" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="o_invoice_no" style="font-weight:bold;"></span> Order Status</h5>
      </div>

      <?php echo form_open('', 'id="order_status_form" name="order_status_form"'); ?>
        <input type="hidden" name="o_order_id" id="o_order_id" value="">
        
      <div class="modal-body">

        <div class="card profile">
          <div class="profile__info">

            <dl class="row">
              <dl class="row">
                <dt class="col-sm-3">Customers Name: </dt>
                <dd class="col-sm-3" id="o_customer_name"></dd>

                <dt class="col-sm-3">Order Date: </dt>
                <dd class="col-sm-3" id="o_order_date"></dd>

                <dt class="col-sm-3">&nbsp;</dt>
                <dd class="col-sm-3">&nbsp;</dd>

                <dt class="col-sm-3 text-truncate">Total items: </dt>
                <dd class="col-sm-3" id="o_total_items"></dd>


                <dt class="col-sm-3">&nbsp;</dt>
                <dd class="col-sm-3">&nbsp;</dd>
                <dt class="col-sm-3">&nbsp;</dt>
                <dd class="col-sm-3">&nbsp;</dd>
                
                <dt class="col-sm-3">Shipping Address: </dt>
                <dd class="col-sm-9" id="o_shipping_address"></dd>

                <dt class="col-sm-3">&nbsp;</dt>
                <dd class="col-sm-3">&nbsp;</dd>
                <dt class="col-sm-3">&nbsp;</dt>
                <dd class="col-sm-3">&nbsp;</dd>

                <dt class="col-sm-3">Mobile</dt>
                <dd class="col-sm-3" id="o_mobile">&nbsp;</dd>

                <dt class="col-sm-3">Promocode</dt>
                <dd class="col-sm-3" id="o_promocode">&nbsp;</dd>

                <dt class="col-sm-3">Order Total</dt>
                <dd class="col-sm-3" id="o_order_total">&nbsp;</dd>

 
                <dt class="col-sm-3">Current Order Status</dt>
                <dd class="col-sm-3" id="o_order_status">&nbsp;</dd>
 
              </dl>
          </div>
        </div>
 
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Order Status</label>
              <?php
              $options = array();
              if (count($all_order_status) > 0) {
                foreach ($all_order_status as $key=>$val) {
                  $options[$key] = $val;
                }
               } ?>
              <?php echo form_dropdown('order_status', $options, '', 'class="select2" id="order_status" data-placeholder="Select Status" required'); ?>
            </div>
          </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
              <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Update Order', 'class="btn btn-success waves-effect"'); ?>  
            </div>
        </div>

      </div>


      <div class="modal-footer modal-footer--bordered">
       <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Dismiss</button> 
      </div>

      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<!-- Order modal ends -->

<header class="content__title">
  <h1><?php echo $page_title; ?></h1>
  <div class="actions">
    <!--<a href="#" class="btn btn-primary waves-effect">Add new</a>-->
  </div>
</header>
<div class="toolbar">
  <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo $total_record; ?> Records</div>
  <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>

    <!--<div class="dropdown actions__item"> <i class="zmdi zmdi-sort" data-toggle="dropdown" aria-expanded="false"></i>

      <div class="dropdown-menu dropdown-menu-right"> <a href="#" class="dropdown-item">Last Modified</a> <a href="#" class="dropdown-item">Name</a> <a href="#" class="dropdown-item">Size</a> </div>

    </div>-->

  </div>
  <div class="toolbar__search" style="display: none;">
    <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-control="orders" data-forms_id="add_new_orders">
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
            <th>Order ID</th>
            <th>Order Items</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="list_search_result">
          <?php

          $i = 1;

          if (!empty($orders)) {
            foreach ($orders as $orders) {
              //0:placed 1:Dispatched 2:Out for delivery 3:Delivered
              $order_status = '';
              $os = $orders->order_status;
              if (array_key_exists($os, $all_order_status)) {
                $order_status = $all_order_status[$os];
              }
          ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?= $orders->invoice_no; ?></td>
                <td><?php 
											$items = $this->orders_model->selectitems("*", array('order_id' => $orders->id), "ORDER BY id ASC");
											if(count($items)>0){
												foreach($items as $it){
													echo $it->item_name."<br>";
												}
											}
										?></td>
                <td><?= $orders->uname; ?></td>
                <td><?= $orders->uemail; ?>
                </td>

                <td>
                  <div class="btn-groups">
                    <!--<a href="#" id="viewrecord" class="btn btn-info waves-effect" title="View" data-toggle="modal" data-target="#view-orders" data-formid="add_new_orders" data-control="orders" data-id="<?= $orders->id; ?>"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></a>-->
                    <button class="btn btn-primary waves-effect view_order" data-toggle="modal" data-target="#view-order" type="button" data-order_id="<?= $orders->id; ?>" title="View Order Details" data-invoiceno="<?= $orders->invoice_no; ?>" id="view_order">View</button>
                    <?php if (checkPermission('delete')) { ?>
                      <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $orders->id; ?>" data-control="orders">Remove</a>
                    <?php } ?>

                  </div>
                </td> 
              </tr>
            <?php $i++;
            }
          } else { ?>
            <tr>
              <td colspan="9" align="center">No record found...</td>
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