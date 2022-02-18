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
                <form name="loginform" id="loginform" method="POST" action="<?= site_url('validatelogin');?>">
                <div class="popup-align">
                    <h3 class="h3 text-center">Log in</h3>
                    <?php if(isset($_SESSION['msg'])){ 
                                    $json_return = $_SESSION['msg']; 
                                    if ($json_return['status'] != 'success') { ?>
                                        <div class="alert alert-danger alert-dismissible alert_err">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> <?php echo $json_return['error']; ?>
                                        </div>
                                <?php   }else{  ?>
                                    <div class="alert alert-success alert-dismissible alert_err">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> <?php echo $json_return['error']; ?>
                                        </div>
                               <?php } }unset($_SESSION['msg']); ?>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="email" name="email"  placeholder="Your email" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <input class="simple-input" type="password" name="password"  placeholder="Enter password" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-6 col-xs-b10 col-sm-b0">
                            <div class="empty-space col-sm-b5"></div>
                            <a class="simple-link" href="<?php echo site_url('/forgot-password') ?>">Forgot password?</a>
                            <div class="empty-space col-xs-b5"></div>
                            <a class="simple-link" href="<?php echo site_url('/register') ?>">register now</a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="button size-2 style-3" type="submit">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">submit</span>
                                </span>
                            </button>  
                        </div>
                    </div>
                </div>
            </form>
            </div>
        
    </body>
</html>