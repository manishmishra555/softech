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
                <a href="#">Career</a>
                <a href="#">Apply here</a>
            </div>
        </div>
        
        <div class="container">
            <div class="text-center">
                <div class="simple-article size-3 grey uppercase col-xs-b5">Apply Now</div>
                <div class="h2">Fill the form to apply for job</div>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>
<?php if(isset($_SESSION['msg'])){ 
    $json_return = $_SESSION['msg']; 
    if ($json_return['status'] != 'success') { ?>
        <div class="alert alert-danger alert-dismissible alert_err">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> <?php echo $json_return['msg']; ?>
        </div>
<?php   }else{  ?>
    <div class="alert alert-success alert-dismissible alert_err">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> <?php echo $json_return['msg']; ?>
        </div>
<?php } }unset($_SESSION['msg']); ?>
        <div class="empty-space col-sm-b15 col-md-b50"></div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                        <div class="inner-column">



                            <!-- Default Form -->

                            <div class="default-form contact-form">

                                <form method="POST" action="<?= site_url('submitcareer');?>" autocomplete="false" id="career-form" enctype="multipart/form-data">


                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="firstname" id="firstname" placeholder="First Name*" required>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="lastname" id="lastname" placeholder="Last Name*" required>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="email" id="email" placeholder="Email*" required>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20 phone" type="text" name="phone" id="phone" placeholder="Contact No*" required>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="currentcity" id="currentcity" placeholder="Current City*" required>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="designation" id="designation" placeholder="Designation*" required>
                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="currentcompany" id="currentcompany" placeholder="Current Company*" required>
                                        </div>

                                        <div class="form-group col-md-6 col-sm-12">
                                            <input class="simple-input col-xs-b20" type="text" name="currentctc" id="currentctc" placeholder="Current CTC*" required>
                                        </div>

                                    <div class="form-group col-md-6 col-sm-12">
                                            <div class="file-upload">
                                                <div class="file-select">
                                                    <div class="file-select-button" style="font-size:12px;" id="fileName">Choose File (File Format: Jpeg, Jpg, Png, PDF, Word Max. File Size: 2MB )</div>
                                                    <input class="simple-input col-xs-b20" style="opacity:1;top:unset;height:auto;position: relative;border: 1px solid #f1eded;" type="file" name="cv_file_upload" id="chooseFile">
                                                </div>
                                            </div>
                                        </div>
                                        

                                    <div class="col-sm-12">
                                <div class="text-center">
                                    <div class="button size-2 style-3">
                                        <span class="button-wrapper">
                                            <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                                            <span class="text">Apply</span>
                                        </span>
                                        <input type="submit"/>
                                    </div>
                                </div>
                            </div>

                            </div>


                                </form>

                            </div>

                            <!--End Default Form-->



                        </div>

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