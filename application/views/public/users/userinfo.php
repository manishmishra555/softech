 

<!doctype html>
<html class="no-js" lang="en">

<?php $class['cls'] = 'userinfo'; ?>
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


                                <div class="tab-pane  show active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                                    <div class="myaccount-dashboard">
                                        <div class="title-text-left">
 						<h4>Account Information <a href="<?= site_url('user/updateprofile');?>" class="edit_btn_uinfo">Edit info</a></h4>
 					</div>
 					<div class="container mt-20">
                         <!-- <div class="clear"></div> -->
                         <div class="row">
 						<div class="col-lg-6">
 							<div class="services-box-2">
 								<div class="subtext">Name</div>
 								<h6><?= $user_info[0]->name; ?></h6>
 							</div>
 						</div>
 						
 						<div class="col-lg-6">
 							<div class="services-box-2">
 								<div class="subtext">Email</div>
 								<h6><?= $user_info[0]->email; ?></h6>
 							</div>
                         </div>
 						<div class="col-lg-6">
 							<div class="services-box-2">
 								<div class="subtext">Phone</div>
 								<h6><?= $user_info[0]->mobile; ?></h6>
 							</div>
 						</div>
 						<div class="col-lg-6">
 							<div class="services-box-2">
 								<div class="subtext">Company Name</div>
 								<h6><?= $user_info[0]->company_name; ?></h6>
 							</div>
 						</div>
 						
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