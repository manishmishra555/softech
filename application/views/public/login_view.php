<!DOCTYPE html>
<html lang="en">
    
 <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/animate.css/animate.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH;?>css/app.min.css">
    </head>

    <body data-ma-theme="green">
        <div class="login">

            <!-- Login -->
            <div class="login__block active" id="l-login">
                <div class="login__block__header">
                    <i class="zmdi zmdi-account-circle"></i>
                    Hi there! Please Sign in

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <!--<a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="#">Create an account</a>-->
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                 <?php echo $this->session->flashdata('message');?>
                <?php echo form_open("");?>
                     <div class="form-group form-group--float form-group--centered">
                        <?php echo form_input('identity','','class="form-control"');?>
                        <?php echo form_label('Email Address','identity');?>
						<?php echo form_error('identity');?>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <?php echo form_password('password','','class="form-control"');?>
                        <?php echo form_label('Password','password');?>
                        <?php echo form_error('password');?>
                        <i class="form-group__bar"></i>
                    </div>
                     <button class="btn btn--icon login__block__btn"><i class="zmdi zmdi-long-arrow-right"></i></button>
                  <?php echo form_close();?>  
                 </div>
            </div>

            <!-- Register -->
            <!--<div class="login__block" id="l-register">
                <div class="login__block__header palette-Blue bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Create an account

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Already have an account?</a>
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-forget-password" href="#">Forgot password?</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control">
                        <label>Name</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control">
                        <label>Email Address</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="password" class="form-control">
                        <label>Password</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Accept the license agreement</span>
                        </label>
                    </div>

                    <a href="index-2.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-plus"></i></a>
                </div>
            </div>-->

            <!-- Forgot Password -->
            <div class="login__block" id="l-forget-password">
                <div class="login__block__header palette-Purple bg">
                    <i class="zmdi zmdi-account-circle"></i>
                    Forgot Password?

                    <div class="actions actions--inverse login__block__actions">
                        <div class="dropdown">
                            <i data-toggle="dropdown" class="zmdi zmdi-more-vert actions__item"></i>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-login" href="#">Already have an account?</a>
                                <a class="dropdown-item" data-ma-action="login-switch" data-ma-target="#l-register" href="#">Create an account</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login__block__body">
                    <p class="mt-4">Lorem ipsum dolor fringilla enim feugiat commodo sed ac lacus.</p>

                    <div class="form-group form-group--float form-group--centered">
                        <input type="text" class="form-control">
                        <label>Email Address</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <a href="index-2.html" class="btn btn--icon login__block__btn"><i class="zmdi zmdi-check"></i></a>
                </div>
            </div>
        </div>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
        <script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="<?php echo ADMIN_ASSETS_PATH;?>vendors/bower_components/Waves/dist/waves.min.js"></script>

        <!-- App functions and actions -->
        <script src="<?php echo ADMIN_ASSETS_PATH;?>js/app.min.js"></script>
    </body>

<!-- Mirrored from byrushan.com/projects/material-admin/app/2.0/jquery/bs4/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Jul 2017 11:32:45 GMT -->
</html>