<!doctype html>
<html class="no-js" lang="en">
<?php $class['cls'] = 'userorder'; ?>
<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?>

</head>

<body class="template-color-1 font-family-02">
<main class="page-content pg_usr_content">
            <!-- Begin Account Page Area -->
            <div class="account-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
						<?php $this->load->view('public/users/user_sidebar',$class); ?>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                                <?php 
                    $odr_status = '';
                    $odr_st = '';
                      $status = $this->orders_model->get_order_status_history("*", array('order_id' => $orders->id), "ORDER BY id desc LIMIT 1");
                      if(count($status)>0){
                        foreach($status as $st){
                          $odr_st = $st->order_status;
                        }
                      }
                      if ($odr_st == 0) {
                        $odr_status = 'Placed';
                      }
                      if ($odr_st == 1) {
                        $odr_status = 'Dispatched';
                      }
                      if ($odr_st == 2) {
                        $odr_status = 'Out For Delivery';
                      }
                      if ($odr_st == 3) {
                        $odr_status = 'Delivered';
                      }
                    ?>      
                                <div class="tab-pane fade active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title" style="display: inline-block;">MY ORDERS</h4>
                                        <?php if ($odr_st == 3) { ?>
                                        <a style="border:1px solid #000; padding:5px 15px;display: inline-block;float: right;" class="button-short-block med border-block-1" href="../sysadmin/orders/orderdownload/<?= $orders->id;?>">Download Invoice</a>
                                      <?php } ?>

                                        <div class="table-responsive">
                                        <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                          <strong>Invoice No.</strong> : <?= $orders->invoice_no;?>
                                        </div>
                                       <div class="col-lg-4 col-md-4">
                                       <strong>Order Date</strong> : <?=date('d-m-Y',strtotime($orders->date_added));?>
                                       </div>
                                       <div class="col-lg-4 col-md-4">
                                          <strong>Total items</strong> : <?= $orders->total_items;?>
                                       </div>


                                        
                     <div style="clear:both;">&nbsp;&nbsp;</div>
                     <div class="col-lg-4 col-md-4"><br>
                        <strong>Shipping Address</strong>
                        <?php 

                        
                        if (count($address) > 0) {
                           foreach ($address as $ad) { ?>
                        <div class="pricing-box-1 grey-background">
                           <ul>
                              <li>
                                 <p><?= $ad->addressline . " " . $ad->addressline2 . ", " . $ad->city . ", " . $ad->state; ?></p>
                              </li>
                              <li>
                                 <p>Contact: <?= $ad->mobile; ?></p>
                              </li>
                           </ul>
                        </div>
                        <?php }
                           } ?>
                     </div>
                                       <div class="col-lg-4 col-md-4"><br>
                                          <strong>Order Status : </strong><?= $odr_status ?>
                                        </div>
                                       </div> 
                     
                     <?php if (!empty($orders->promocode)) {?>
                     <div class="three columns">
                        <strong>Promocode</strong> : <?= $orders->promocode;?>
                     </div>
                     <?php } ?>
                     <div class="clear"></div>
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Item</th>
                              <th>Price</th>
                              <th>Qnty</th>
                              <th>Tax</th>
                              <th>Total</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              $oid=$orders->id;								   							   
                              $items = $this->orders_model->selectitems("*", array('order_id' => $oid), "ORDER BY id ASC");
                              if(count($items)>0){
                               foreach($items as $it){
                                  if(!empty($it->item_discounted_price)){
                                 	$price=$it->item_discounted_price;
                                 }else{
                                 	$price=$it->item_price;
                                 }
                                 $item_subtotal = $price*$it->item_qnty;
                                   $gst = $it->item_tax;
                                $gst_total = ($item_subtotal*$gst)/100;
                                $total = $item_subtotal+$gst_total;
                                	 										 
                                ?>
                           <tr>
                              <td data-label="Item">
                                 <?= $it->item_name;?>											
                              </td>
                              <td data-label="Price"><?php 
                                 
                                 echo "₹" .$price;?></td>
                              <td data-label="Qnty"><?= $it->item_qnty;?></td>
                              <td data-label="tax"><?= $gst;?>%</td>
                              <td data-label="Total"><?= "₹" .($total);?></td>
                           </tr>
                           <?php } } ?>
                           <tr>
                              <td colspan="3"></td>
                              <td><strong>Subtotal</strong></td>
                              <td><?= "₹" .$orders->order_subtotal;?></td>
                           </tr>
                           <tr>
                              <td colspan="3"></td>
                              <td><strong>Total</strong></td>
                              <td><?= "₹" .$orders->total_amount;?></td>
                           </tr>
                        </tbody>
                     </table>
                 


                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Page Area End Here -->
        </main>
</body>
</html>





