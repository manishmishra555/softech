

<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?> 
<?php $class['cls'] = 'useraddr'; ?>
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
                        <?php if (count($address) > 0) {
							foreach ($address as $ad) { ?>
                        <div class="col-lg-9 myaccount-tab-content">
						<div class="title-text-left">
						<h4>Manage Address <a href="javascript:void(0);"  onclick="getAddrdata(<?= $ad->id; ?>)" class="edit_btn_uinfo">Edit info</a></h4>
					</div>

					<div class="container mt-20" id="addresslist">
						<div class="row">
						
								<div class="col-md-6 col-lg-6" style="float:left;display:none;">
									<div class="card pricing-box-1 grey-background box_show_align">
										<ul >
											<li>
												<p><b>Residential Address</b></p><hr>
												<p><b><?= $ad->adr_name; ?></b>	</p>
												<p><?= $ad->addressline1 . ", " . $ad->addressline2 . ",<br> " . $ad->city . ", " . $ad->state. " - " . $ad->zipcode; ?></p>
											</li>
											<li>
												<p><b>Contact:</b> <?= $ad->mobile; ?></p>
											</li>
										</ul>
									</div>
								</div>

								<div class="col-md-6 col-lg-6" style="float:left;">
									<div class="card pricing-box-1 grey-background box_show_align">
										<ul >
											<li>
												<p><b>Official Address</b></p><hr>
												<p><b><?= $ad->adr_name_res; ?></b>	</p>
												<p><?= $ad->addressline1_res . ", " . $ad->addressline2_res . ",<br> " . $ad->city_res . ", " . $ad->state_res. " - " . $ad->zipcode_res; ?></p>
											</li>
											<li>
												<p><b>Contact:</b> <?= $ad->mobile_res; ?></p>
											</li>
										</ul>
									</div>
								</div>
						
						</div>
						<div class="clear clr_botm">&nbsp;</div>
						<hr/>

						<div class="three columns adr_blocks">
						<div class="login_conts">
   
                <form name="registrationform" id="registrationform" method="POST" action="<?= site_url('user/updateadress');?>" autocomplete="false">
                <div class="popup-align register_block">
                    <h3 class="h3 text-center">Address</h3>
                    
                    <div style="display:none">
                    <div class="empty-space col-xs-b30"></div>
                        <h4>Residential Address</h4>
                        <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <input class="simple-input" name="addr_name" type="text"  placeholder="Name" required/>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input class="simple-input" name="addr_mobile" type="text"  placeholder="mobile Number" required/>
                        </div>
                    </div>
                    <input type="hidden" id="adid" name="adid">
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line1" type="text"  placeholder="Address Line 1" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line2" type="text"  placeholder="Address Line 2" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_city" type="text"  placeholder="City" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_state" type="text"  placeholder="State" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_pincode" type="text"  placeholder="pincode" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    </div>

                    <div class="empty-space col-xs-b30"></div>
                        <h4>Company Address&nbsp;&nbsp;<label class="checkbox-entry" style="display:none">
                                <input type="checkbox" id="chk_terms"/><span for="chk_terms">Same as residential address</span>
                            </label></h4>
                            <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <input class="simple-input" name="addr_name_comp" type="text"  placeholder="Name" required/>
                        </div>
                        <div class="col-sm-6 text-right">
                            <input class="simple-input" name="addr_mobile_comp" type="text"  placeholder="mobile Number" required/>
                        </div>
                    </div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line1_comp" type="text"  placeholder="Address Line 1" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line2_comp" type="text"  placeholder="Address Line 2" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_city_comp" type="text"  placeholder="City" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_state_comp" type="text"  placeholder="State" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_pincode_comp" type="text"  placeholder="pincode" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        
                        <div class="col-sm-12 text-right">
                            <button class="button size-2 style-3 btn-step3" type="submit">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">Update</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
            </form>
            </div>
	
						</div>



					</div>
                        </div>
                        <?php }
						} ?>
                    </div>
                </div>
            </div>
            <!-- Account Page Area End Here -->
		</main>

		<script type="text/javascript">
			function getAddrdata(adrid){
				$(".dropdown-menu").hide();
				$(".dropdown-menu").hide();
				var url = SITE_URL+'user/getAddressData';
				$.ajax({
				type: "POST",
				url: url,
				data: {adrid:adrid},
			  })
			  .done(function(data) {
			  	var duce = jQuery.parseJSON(data);
			 	 $('input[name="addr_line1"]').val(duce.data[0].addressline1);
				 $('input[name="addr_line2"]').val(duce.data[0].addressline2);
				 $('input[name="addr_city"]').val(duce.data[0].city);
				 $('input[name="addr_state"]').val(duce.data[0].state);
				 $('input[name="addr_pincode"]').val(duce.data[0].zipcode);
				 $('input[name="addr_mobile"]').val(duce.data[0].mobile);
				 $('input[name="addr_name"]').val(duce.data[0].adr_name);

				 $('input[name="addr_line1_comp"]').val(duce.data[0].addressline1_res);
				 $('input[name="addr_line2_comp"]').val(duce.data[0].addressline2_res);
				 $('input[name="addr_city_comp"]').val(duce.data[0].city_res);
				 $('input[name="addr_state_comp"]').val(duce.data[0].state_res);
				 $('input[name="addr_pincode_comp"]').val(duce.data[0].zipcode_res);
				 $('input[name="addr_mobile_comp"]').val(duce.data[0].mobile_res);
				 $('input[name="addr_name_comp"]').val(duce.data[0].adr_name_res);
				 
				 $('#adid').val(duce.data[0].id);

				 setTimeout(function(){
                    $(".adr_blocks").fadeIn(100);
                 }, 100);
				 $('html, body').animate({
			        scrollTop: $(".clr_botm").offset().top
			     }, 100);

 			  }).error(function(data){
				 console.log(data);
			  });
			}

			$(".alert_err").fadeOut(1000);
		</script>

</body>
</html>