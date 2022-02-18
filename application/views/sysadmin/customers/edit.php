<?php defined('BASEPATH') or exit('No direct script access allowed');
$customers = $customers[0];
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <?php $this->load->view('templates/common/master_page_head'); ?>
  <?php echo $extracss; ?>
  <!-- App styles -->
  <link rel="stylesheet" href="<?php echo ADMIN_ASSETS_PATH; ?>css/app.min.css">
  <!--App Global variables-->
  <script>
    var SITE_URL = "<?php echo MAINSITE_MADMIN_URL; ?>";
    var CURRENT_URL = "<?php echo current_url(); ?>";
    var hash = "<?php echo $this->security->get_csrf_hash(); ?>";
  </script>
  <?php echo $this->session->flashdata('message'); ?>
</head>

<body data-ma-theme="red">
  <main class="main">
    <?php $this->load->view('templates/common/master_header_view'); ?>
    <?php $this->load->view('templates/common/master_sidebar_view'); ?>
    <section class="content">
      <div class="">
        <header class="content__title">
          <h1><?php echo $page_title; ?></h1>
        </header>
<?php echo form_open_multipart('', 'id="add_new_customer" name="add_new_customer"'); ?>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Overview</h2>
          </div>
          <div class="card-block">
            <div class="row">
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Customer Name</label>
                  <?php echo form_input('customers_title', set_value('customers_title', $customers->name), 'class="form-control" id="customer_name"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Email ID</label>
                  <?php echo form_input('email', set_value('email', $customers->email), 'class="form-control" id="customer_email"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <input type="hidden" name="customers_id" value="<?php echo $customers->id; ?>">


              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Mobile Number</label>
                  <?php echo form_input('mobile', set_value('mobile', $customers->mobile), 'class="form-control" id="customer_mobile"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Company Name </label>
                  <?php echo form_input('company_name', set_value('company_name', $customers->company_name), 'class="form-control" id="company_name"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>GST Number</label>
                  <?php echo form_input('gst_no', set_value('gst_no', $customers->gst_no), 'class="form-control" id="gst_no"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>PAN Number </label>
                  <?php echo form_input('pan_no', set_value('pan_no', $customers->pan_no), 'class="form-control" id="pan_no"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <label class="custom-control custom-radio">
                  <input name="status" class="custom-control-input" type="radio" value="active" <?php if ($customers->status == 'active') {
                                                                                                  echo "checked";
                                                                                                } ?>>
                  <span class="custom-control-indicator"></span> <span class="custom-control-description">Active</span> </label>
                <label class="custom-control custom-radio">
                  <input name="status" class="custom-control-input" type="radio" value="inactive" <?php if ($customers->status == 'inactive') {
                                                                                                    echo "checked";
                                                                                                  } ?>>
                  <span class="custom-control-indicator"></span> <span class="custom-control-description">Inactive</span> </label>
              </div>


            </div> 
            


          </div>
          
          
          <div class="card-block">
            <div class="card-header" style="padding-left: unset;">
              <h2 class="card-title">Residential Address</h2>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Address Line 1</label>
                  <?php echo form_input('addressline1', set_value('addressline1', $address[0]->addressline1), 'class="form-control" id="addressline1"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Address Line 2</label>
                  <?php echo form_input('addressline2', set_value('addressline2', $address[0]->addressline2), 'class="form-control" id="addressline2"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <input type="hidden" name="adr_cust_id" value="<?php echo $address[0]->uid; ?>">


              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>City</label>
                  <?php echo form_input('city', set_value('city', $address[0]->city), 'class="form-control" id="city"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>State </label>
                  <?php echo form_input('state', set_value('state', $address[0]->state), 'class="form-control" id="state"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>Zipcode</label>
                  <?php echo form_input('zipcode', set_value('zipcode', $address[0]->zipcode), 'class="form-control" id="zipcode"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Name </label>
                  <?php echo form_input('adr_name', set_value('adr_name', $address[0]->adr_name), 'class="form-control" id="adr_name"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Phone Number </label>
                  <?php echo form_input('mobile', set_value('mobile', $address[0]->mobile), 'class="form-control" id="mobile"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              


            </div> 
            <hr>

            <div class="card-header" style="padding-left: unset;">
              <h2 class="card-title">Official Address</h2>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Address Line 1</label>
                  <?php echo form_input('addressline1_res', set_value('addressline1_res', $address[0]->addressline1_res), 'class="form-control" id="addressline1_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Address Line 2</label>
                  <?php echo form_input('addressline2_res', set_value('addressline2_res', $address[0]->addressline2_res), 'class="form-control" id="addressline2_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>


              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>City</label>
                  <?php echo form_input('city_res', set_value('city_res', $address[0]->city_res), 'class="form-control" id="city_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>State </label>
                  <?php echo form_input('state_res', set_value('state_res', $address[0]->state_res), 'class="form-control" id="state_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-4 col-md-4">
                <div class="form-group">
                  <label>Zipcode</label>
                  <?php echo form_input('zipcode_res', set_value('zipcode_res', $address[0]->zipcode_res), 'class="form-control" id="zipcode_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Name </label>
                  <?php echo form_input('adr_name_res', set_value('adr_name_res', $address[0]->adr_name_res), 'class="form-control" id="adr_name_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label>Phone Number </label>
                  <?php echo form_input('mobile_res', set_value('mobile_res', $address[0]->mobile_res), 'class="form-control" id="mobile_res"'); ?>
                  <i class="form-group__bar"></i> 
                </div>
              </div>
              


            </div> 

            <div class="row">
              <div class="form-group--centered col-sm-12">

                <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Submit', 'class="btn btn-success waves-effect"'); ?>
                <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/customers'); ?>'">Cancel</button>
              </div>
            </div>


          </div>
        </div>




      </div>


      <?php echo form_close(); ?>
      </div>



      <?php $this->load->view('templates/common/master_footer_view'); ?>
    </section>
  </main>
  <?php $this->load->view('templates/common/master_page_js_noapp'); ?>
  <?php echo $extrajs; ?>

  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/custom.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>js/app.min.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/validation/jquery.validate.min.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/validation/additional-methods.min.js"></script>
  <?php include DIR_WS_CATALOG . 'assets/admin/vendors/bower_components/ckfinder/ckfinder.php'; ?>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.js"></script>
  <script src="<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckeditor/adapters/jquery.js"></script>
  

  <?php echo getExtraThing(); ?>
</body>

</html>