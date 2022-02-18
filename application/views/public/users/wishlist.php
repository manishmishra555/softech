<!doctype html>
<html class="no-js" lang="en">
<?php $class['cls'] = 'userwish'; ?>
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
                                
                                <div class="tab-pane fade active" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">MY WISHLIST</h4>
                                        <div class="table-responsive">


										<table class="table table-bordered table-hover table-data-01">
								<caption>Wishlist</caption>
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Product</th>
										<th scope="col">Price</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
								   <?php 
								   		$i = 1;$pro_name = '';$pro_price = 0;$pro_img = '';
									   foreach($wish as $or){
										   	 $pro_id=$or->pro_id;							 
										   ?>
									<tr class="wish_page_link-<?= $pro_id; ?>">
										<td><?= $i;?></td>
										<?php 
											$pros_data = $this->db->where('pid',$pro_id)->get('tbl_product')->result();
                							
                							$pro_name=isset($pros_data[0])?$pros_data[0]->product_name:'';
                							$pro_price=isset($pros_data[0])?$pros_data[0]->price:'';
                							$pro_img=isset($pros_data[0])?$pros_data[0]->image_fids:'';

                							$url_sl = isset($pros_data[0])?$pros_data[0]->url_slug:'';

                							$url = 'product/'.$url_sl;

                							$PImages = json_decode($pro_img);
											$image1=$this->media->getThumbPathById($PImages[0],'');
										?>
										<td data-label="Items"><img class="img_wish" src="<?php echo $image1; ?>" alt="<?= $pro_name ?>"><a href="../<?php echo $url; ?>" data-toggle="tooltip" data-placement="top" title="View Product" ><?= $pro_name ?></a>
										</td>
										<td data-label="Order placed on"><?= $pro_price ?></td>
 										<th data-label="Detail">
 											<a href="../<?php echo $url; ?>" data-toggle="tooltip" data-placement="top" title="View Product" ><i class="icon-magnifier"></i></a>

 											<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" onclick="removefromwishlist(<?= $pro_id; ?>);" title="Remove from Wishlist"><i class="icon-trash" style="color: #e62222;"></i></a>
 										</th>
									</tr>
								   <?php $i++; } ?>
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
