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
                <form name="loginform" id="forgotform" method="POST" action="<?= site_url('validateforgotPwd');?>">
                <div class="popup-align">
                    <h3 class="h3 text-center">Forgot Password ?</h3>
                    <?php if(isset($_SESSION['msg'])){ 
                                    $json_return = $_SESSION['msg']; 
                                    if ($json_return['status'] != 'success') { ?>
                                        <div class="alert alert-danger alert-dismissible alert_err" style="margin: unset;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> <?php echo $json_return['error']; ?>
                                        </div>
                                <?php   }else{  ?>
                                    <div class="alert alert-success alert-dismissible alert_err" style="margin: unset;">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong> <?php echo $json_return['error']; ?>
                                        </div>
                               <?php } }unset($_SESSION['msg']); ?>
                    <div class="empty-space col-xs-b30"></div>
                    <input class="simple-input" type="email" name="email"  placeholder="Your email" required />
                    <div class="empty-space col-xs-b10 col-sm-b20"></div>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <button class="button size-2 style-3" type="submit" style="margin: 0 auto;display: block;">
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