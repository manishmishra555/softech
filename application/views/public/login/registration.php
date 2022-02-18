<!doctype html>
<html class="no-js" lang="en">

<head>
    <!-- Favicon -->
    <?php $this->load->view('templates/front_common/master_page_head'); ?>
    <?php echo $extracss; ?>
    <?php $this->load->view('templates/front_common/master_page_subhead'); ?>

</head>

<body class="template-color-1 font-family-02">




<div class="popup-container size-1 login_conts">
   
                <form name="registrationform" id="registrationform" method="POST" action="<?= site_url('submitregistration');?>" autocomplete="false">
                <div class="popup-align register_block">
                    <h3 class="h3 text-center">vendor registeration</h3>
                     <?php if(isset($_SESSION['msg'])){ 
                                    $json_return = $_SESSION['msg']; 
                                    if ($json_return['status'] != 'success') { ?>
                                        <div class="alert alert-danger alert-dismissible alert_err">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong></strong> <?php echo $json_return['error']; ?>
                                        </div>
                                <?php   }else{  ?>
                                    <div class="alert alert-success alert-dismissible alert_err">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong></strong> <?php echo $json_return['error']; ?>
                                        </div>
                               <?php } }unset($_SESSION['msg']); ?>
                    <div class="step1">
                    <div class="empty-space col-xs-b30"></div>
                        <h4>Enter Perosnal Details</h4>
                    <input class="simple-input" name="uname" type="text"  placeholder="Your name" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="mobile" type="text"  placeholder="Your Phone Number" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="email" type="email"  placeholder="Your email" required/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="password" type="password"  placeholder="Enter password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="confirmpassword" type="password"  placeholder="Repeat password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        
                        <div class="col-sm-12 text-right">
                            <button class="button size-2 style-3 btn-step1" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">next</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
                <div class="step2">

                    <div class="empty-space col-xs-b30"></div>
                        <h4>Enter Business Details</h4>
                    <input class="simple-input" name="comp_name" type="text"  placeholder="Enter Company Name" />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="comp_gst" type="text"  placeholder="Enter GST Number"/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="pan_no" type="text"  placeholder="Enter PAN Number"/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 text-left btn_prevs">
                            <button class="button size-2 style-3 btn-prev2" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">previous</span>
                                </span>
                            </button>  
                        </div>
                        <div class="col-sm-6 text-right btn_nxts">
                            <button class="button size-2 style-3 btn-step2" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">next</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
                <div class="step3">
                    <div  style="display:none;">
                    <div class="empty-space col-xs-b30"></div>
                        <h4>Residential Address</h4>
                        <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <input class="simple-input" name="addr_name" type="text"  placeholder="Name" />
                        </div>
                        <div class="col-sm-6 text-right">
                            <input class="simple-input" name="addr_mobile" type="text"  placeholder="mobile Number" />
                        </div>
                    </div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line1" type="text"  placeholder="Address Line 1"  />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_line2" type="text"  placeholder="Address Line 2"/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_city" type="text"  placeholder="City"  />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_state" type="text"  placeholder="State"  />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_pincode" type="text"  placeholder="pincode"  />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    </div>

                    <div class="empty-space col-xs-b30"></div>
                        <h4>Company Address&nbsp;&nbsp;<label class="checkbox-entry" style="display:none;">
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
                    <input class="simple-input" name="addr_line2_comp" type="text"  placeholder="Address Line 2"/>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_city_comp" type="text"  placeholder="City" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_state_comp" type="text"  placeholder="State" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" name="addr_pincode_comp" type="text"  placeholder="pincode" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 text-left btn_prevs">
                            <button class="button size-2 style-3 btn-prev3" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">previous</span>
                                </span>
                            </button>  
                        </div>
                        <div class="col-sm-6 text-right btn_nxts">
                            <button class="button size-2 style-3 btn-step3" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">next</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
                
                <div class="step4">

                    <div class="empty-space col-xs-b30"></div>
                        <h4>Account Verification</h4>
                        <p style="color: #c31717;font-size: 12px;">* Please Enter One Time Password sent on your Email ID or Mobile Number </p>
                    <input class="simple-input" name="otp_validate" type="text" placeholder="Enter OTP" />
                    <p class="resend_otp"><a href="javascript:void(0);">Resend OTP</a></p>
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 text-left btn_prevs">
                            <button class="button size-2 style-3 btn-prev4" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">previous</span>
                                </span>
                            </button>  
                        </div>
                        <div class="col-sm-6 text-right btn_nxts">
                            <button class="button size-2 style-3 btn-step4" type="button">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">next</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
                    <hr>

                    <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b5"></div>
                            <a class="simple-link">Already Registered ?</a>
                            <div class="empty-space col-xs-b5"></div>
                            <a class="simple-link" href="<?php echo site_url('/login') ?>">login now</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        <script type="text/javascript">
          

        </script>
    </body>
</html>