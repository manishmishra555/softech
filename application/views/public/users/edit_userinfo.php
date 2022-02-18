 

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


                                <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                                    <div class="myaccount-dashboard">
                                        <div class="title-text-left">
                                        	<a href="<?= site_url('user/info');?>" class="edit_btn_uinfo">Go Back</a>
 						<h4>Update Account Information </h4>
 					</div>
 					<div class="container mt-20">
                         <!-- <div class="clear"></div> -->
                         <div class="row">
                         	<form action="<?= site_url('user/updateprofiledata'); ?>" method="post">
							  <div class="form-group">
							    <label for="inputUname">Name</label>
							    <input type="text" class="form-control" id="inputUname" name="inputUname" value="<?= $user_info[0]->name; ?>" aria-describedby="nameHelp" placeholder="Enter User Name">
							  </div>
							  <div class="form-group">
							    <label for="inputEmail">Email address</label>
							    <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?= $user_info[0]->email; ?>" aria-describedby="emailHelp" placeholder="Enter email">
							  </div>
							  <div class="form-group">
							    <label for="InputPhone">Phone</label>
							    <input type="text" class="form-control" id="InputPhone" name="InputPhone" value="<?= $user_info[0]->mobile; ?>" placeholder="Phone Number">
							  </div>
							  <div class="form-group">
							    <label for="InputPhone">Company Name</label>
							    <input type="text" class="form-control" id="Inputcompany" name="Inputcompany" value="<?= $user_info[0]->company_name; ?>" placeholder="Company Name">
							  </div>
                              <button class="button size-2 style-3 btn-step3" type="submit">
                                <span class="button-wrapper">
                                    <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt="" /></span>
                                    <span class="text">Update</span>
                                </span>
                            </button>  
							</form>
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