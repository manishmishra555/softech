<!doctype html>
<html class="no-js" lang="en">
<?php $class['cls'] = 'userwallet'; ?>
<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?>

</head>

<body class="template-color-1 font-family-02">
<main class="page-content">
            <!-- Begin Account Page Area -->
            <div class="account-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
						<?php $this->load->view('public/users/user_sidebar',$class); ?>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                                
                                <div class="tab-pane fade active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="container mt-20">
 						<!-- <div class="clear"></div> -->
 						<div class="eight columns">
						 <h2 class="text-center">Available Points :  <?= $wallet[0]->amount;?></h2>
						 <br>
						 <table class="table table-bordered table-hover table-data-01">
								<caption>Wallet History</caption>
								<thead>
									<tr>
										<th scope="col">Date</th>
 										<th scope="col">Wallet Points</th> 		
 										<th scope="col">Credit / Debit</th> 										 
									</tr>
								</thead>
								<tbody>
								   <?php if(count($wallet_transaction)>0){
									   foreach($wallet_transaction as $wt){
												$date_created=date('d-m-y',strtotime($wt->date_added));
												$op='';
												if($wt->operation==0){
													$op='<span class="badge badge-success">Credited</span>';
												}else if($wt->operation==1){
													$op='<span class="badge badge-danger">Debited</span>';
												}
												$wallet_points=$wt->amount;
										   ?>
									<tr>
										<td data-label="Date">
											 <?= $date_created;?>											
										</td>
										<td data-label="Wallet Points">
										 <?php echo $wallet_points;?>
										</td>		
										<td data-label="Wallet Points">
										 <?php echo $op;?>
										</td>										 
									</tr>
								   <?php } } ?>
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
