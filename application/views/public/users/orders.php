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
                        <div class="col-lg-9 myaccount-tab-content">
                            <div class="tab-content " id="account-page-tab-content">
                                
                                <div class="tab-pane fade active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">MY ENQUIRIES</h4>
                                        <div class="table-responsive">


										<table class="table table-bordered table-hover">
								<caption>Orders History</caption>
								<thead>
									<tr>
										<th scope="col">Invoice no.</th>
										<th scope="col">Items</th>
										<th scope="col">Enquiry placed on</th>
 										<th scope="col">Total </th>
 										<th scope="col">Status </th>
										<th scope="col">#</th>
									</tr>
								</thead>
								<tbody>
								   <?php $odr_status = '';$odr_st = '';if(count($orders)>0){
									   foreach($orders as $or){
										   	 $oid=$or->id;											 
										   ?>
									<tr>
										<td data-label="Invoice no.">
											 <?= $or->invoice_no;?>		
										</td>
										<td data-label="Items">
										<?php 
											$items = $this->orders_model->selectitems("*", array('order_id' => $oid), "ORDER BY id ASC");
											if(count($items)>0){
												foreach($items as $it){
													echo $it->item_name."<br>";
												}
											}
										?>
										</td>
										<td data-label="Order placed on"><?= date('d-m-Y',strtotime($or->date_added));?></td>
										<td data-label="Total"><?= "₹" .$or->total_amount;?></td>
										<?php 
											$status = $this->orders_model->get_order_status_history("*", array('order_id' => $oid), "ORDER BY id ASC");
											if(count($status)>0){
												foreach($status as $st){
													$odr_st = $st->order_status."<br>";
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
										<td><?= $odr_status;?></td>
 										<th data-label="Detail"><a href="<?= site_url('orderdetail/').$or->invoice_no;?>" class="button but2" style="font-size:15px;">View Details</a></th>
									</tr>
								   <?php } }else{ ?>
										<tr>
								   <td colspan="6" style="text-align: center;"><a href="<?= site_url('product');?>">Place your first order</a></td>
										</tr>
								   <?php } ?>
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
