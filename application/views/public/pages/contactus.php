<!doctype html>
<html class="no-js" lang="en">

<head>
  <!-- Favicon -->
  <?php $this->load->view('templates/front_common/master_page_head'); ?>
	<?php echo $extracss; ?>
	<?php $this->load->view('templates/front_common/master_page_subhead'); ?>
</head>

<body class="template-color-5 font-family-02">

    <div class="main-wrapper wrapper-boxed_layout">

        <!-- Begin Main Header Area Two -->
        <header class="main-header_area-2">
        <?php $this->load->view('templates/front_common/master_menu'); ?>
        </header>
     

        <div class="checkout-area">
            <div class="container" >
<div class="header-empty-space"></div>
        <div class="container">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
                <a href="#">Contact</a>
                <a href="#">Get in Touch</a>
            </div>
        </div>
        
        <div class="container">
            <div class="text-center">
                <div class="simple-article size-3 grey uppercase col-xs-b5">Contact Us</div>
                <div class="h2">we are ready for your questions</div>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>

        <div class="empty-space col-sm-b15 col-md-b50"></div>

        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="icon-description-shortcode style-1">
                        <img class="icon" src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-25.png" alt="">
                        <div class="title h6">address</div>
                        <div class="description simple-article size-2"><?= $this->dbsettings->OFFICE_ADDRESS; ?></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="icon-description-shortcode style-1">
                        <img class="icon" src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-23.png" alt="">
                        <div class="title h6">phone</div>
                        <div class="description simple-article size-2" style="line-height: 26px;">
                           Phone: <a href="tel:<?= $this->dbsettings->PHONE; ?>"><?= $this->dbsettings->PHONE; ?></a>
                            <br/>
                           Landline: <a href="tel:<?= $this->dbsettings->Landline; ?>"><?= $this->dbsettings->Landline; ?></a> / <a href="tel:<?= $this->dbsettings->Landline2; ?>">73</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="icon-description-shortcode style-1">
                        <img class="icon" src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-28.png" alt="">
                        <div class="title h6">email</div>
                        <div class="description simple-article size-2">Email1 :<a href="mailto:<?= $this->dbsettings->ENQUIRY_EMAIL; ?>"><?= $this->dbsettings->ENQUIRY_EMAIL; ?></a><br>Email2 :<a href="mailto:<?= $this->dbsettings->ENQUIRY_EMAIL1; ?>"><?= $this->dbsettings->ENQUIRY_EMAIL1; ?></a></div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="icon-description-shortcode style-1">
                        <img class="icon" src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-26.png" alt="">
                        <div class="title h6">Follow us</div>
                        <div class="follow light">
                            <a class="entry" href="<?= $this->dbsettings->FACEBOOK_LINK; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a class="entry" href="<?= $this->dbsettings->INSTAGRAM_LINK; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12" style="padding: 4% 0;text-align: center;">
                    <p>We're Availbale All Days in a Week. <b>(Wednesday Off)</b></p>
                    <p>Timing : 10AM to 7:30PM</p>
                </div>
            </div>
        </div>
                    
                    

        <div class="empty-space col-xs-b25 col-sm-b50"></div>
    
        <div class="container">    
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.7799840751177!2d77.09046851508268!3d28.63635548241636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d04985625c275%3A0x723506e2c3ce3a0f!2sGalorebay%20Optix%20(India)!5e0!3m2!1sen!2sin!4v1608619087918!5m2!1sen!2sin" frameborder="0" style="border:0;width: 100%;height: 400px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>

        <div class="empty-space col-xs-b25 col-sm-b50"></div>

        <div class="container">
            <h4 class="h4 text-center col-xs-b25">have a questions?</h4>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="contact-form">
                        <div class="row m5">
                            <div class="col-sm-6">
                                <input class="simple-input col-xs-b20" type="text" value="" placeholder="Name" name="name" />
                            </div>
                            <div class="col-sm-6">
                                <input class="simple-input col-xs-b20" type="text" value="" placeholder="Email" name="email" />
                            </div>
                            <div class="col-sm-6">
                                <input class="simple-input col-xs-b20" type="text" value="" placeholder="Phone" name="phone" />
                            </div>
                            <div class="col-sm-6">
                                <input class="simple-input col-xs-b20" type="text" value="" placeholder="Subject" name="subject" />
                            </div>
                            <div class="col-sm-12">
                                <textarea class="simple-input col-xs-b20" placeholder="Your message" name="message"></textarea>
                            </div>
                            <div class="col-sm-12">
                                <div class="text-center">
                                    <div class="button size-2 style-3">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                                            <span class="text">send message</span>
                                        </span>
                                        <input type="submit"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <div class="empty-space col-xs-b35 col-md-b70"></div>
      

        <!-- Scroll To Top Start -->
        <a class="scroll-to-top" href=""><i class="icon-arrow-up"></i></a>
        <!-- Scroll To Top End -->

    </div>

    <!-- JS
============================================ -->

<?php $this->load->view('templates/front_common/master_page_js'); ?>
<script type="text/javascript">

    
</script>
</body>

</html>