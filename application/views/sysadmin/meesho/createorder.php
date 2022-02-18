<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
               <?php echo form_open_multipart('', 'id="add_new_product" name="add_new_product"'); ?>
               <div class="card card_block_info">
                  <div class="card-header">
                     <h2 class="card-title">Product Info</h2>
                  </div>
                  <div class="card-block">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="form-group form-group--float"> <?php echo form_input('order_id', set_value('order_id'), 'class="form-control" id="order_id"'); ?> <?php echo form_label('Order ID', 'product_name'); ?><i class="form-group__bar"></i> </div>
                              </div>

                              <div class="col-sm-12">
                                 <div class="form-group form-group--float"> <?php echo form_input('product_id', set_value('product_id'), 'class="form-control" id="product_id"'); ?> <?php echo form_label('Enter Product SKU', 'product_id'); ?><i class="form-group__bar"></i> </div>
                              </div>

                              <div class="col-sm-12">
                                 <div class="form-group form-group--float"> <?php echo form_input('qty', set_value('qty'), 'class="form-control" id="qty"'); ?> <?php echo form_label('Quantity', 'qty'); ?><i class="form-group__bar"></i> </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="block_info_show">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="img_block_right">
                                       <img src="<?php echo ADMIN_ASSETS_PATH; ?>/img/no-image.png">
                                    </div>
                                 </div>
                                 <div class="col-md-8">
                                    <div class="info_block_right">
                                       <h4>Product 1</h4>
                                       <p>SKU : <b>ABXJD934H</b></p>
                                       <p>GST : <b>18%</b></p>
                                       <p>Price : <b>180 Rs.</b></p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> 
                     
                  </div>
               </div>
               <div class="card">
                  <div class="card-header">
                     <h2 class="card-title">Overview</h2>
                  </div>
                  <div class="card-block">
                     <div class="row">
                        <div class="col-sm-4">
                           <div class="form-group form-group--float date_block"> 
                              <?php echo form_label('Order Date', 'order_date'); ?><i class="form-group__bar"></i>
                              <input type="date" class="form-control" id="order_date">
                           </div>
                        </div>
                        <div class="col-sm-4">
                           <div class="form-group form-group--float"> <?php echo form_input('total_amount', set_value('total_amount'), 'class="form-control" id="total_amount"'); ?> <?php echo form_label('Total Amount', 'total_amount'); ?><i class="form-group__bar"></i> </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Payment Method</label>
                              <?php
                                 $options = array();          
                                 $options['cod'] = 'Cash on Delivery';    
                                 $options['online'] = 'Paid Online';    
                                 ?>
                              <?php echo form_dropdown('payment_method', $options, '', 'class="select2" id="payment_method"'); ?>

                           </div>
                        </div>

                        


                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('customer_name', set_value('customer_name'), 'class="form-control" id="customer_name"'); ?>
                            <?php echo form_label('Customer Name', 'customer_name'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group form-group--float"> 
                                <?php echo form_input('state', set_value('state'), 'class="form-control" id="state"'); ?>
                                <?php echo form_label('State', 'state'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group form-group--float"> 
                                <?php echo form_input('address', set_value('address'), 'class="form-control" id="address"'); ?>
                                <?php echo form_label('Address', 'address'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>
                        
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Shipping Provider</label>
                              <?php
                                 $options = array();          
                                 $options['shadowfax'] = 'Shadowfax';    
                                 $options['ecom-express'] = 'Ecom Express'; 
                                 $options['express-bees'] = 'Express Bees';    
                                 $options['delhivery'] = 'Delhivery';    
                                 ?>
                              <?php echo form_dropdown('shipping_partner', $options, '', 'class="select2" id="shipping_partner"'); ?>

                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group form-group--float"> 
                                <?php echo form_input('shipping_id', set_value('shipping_id'), 'class="form-control" id="shipping_id"'); ?>
                                <?php echo form_label('Shipping Id', 'shipping_id'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Order Status</label>
                              <?php
                                 $options = array();          
                                 $options['0'] = 'Ordered';    
                                 $options['1'] = 'Shipped'; 
                                 $options['2'] = 'Cancelled';    
                                 $options['3'] = 'Delivered';    
                                 $options['4'] = 'Returned';    
                                 ?>
                              <?php echo form_dropdown('shipping_partner', $options, '', 'class="select2" id="shipping_partner"'); ?>

                           </div>
                        </div>

                      </div>


                   
                     <br>
                     <div class="row">
                        <div class="form-group--centered col-sm-12">
                           <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Submit', 'class="btn btn-success waves-effect"'); ?>
                           <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/product'); ?>'">Cancel</button>
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
      <script type="text/javascript">
         var editor = CKEDITOR.replace('product_desc', {         
           filebrowserBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html',        
           filebrowserImageBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Images',         
           filebrowserFlashBrowseUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/ckfinder.html?type=Flash',         
           filebrowserUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',         
           filebrowserImageUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',         
           filebrowserFlashUploadUrl: '<?php echo ADMIN_ASSETS_PATH; ?>vendors/bower_components/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'         
         });
          
      </script>
      <script>
         $(document).ready(function() {
         
           // Initialize the date picker for the original date field
           $(".hide").hide();         
           bindformsubmitevent();         
           createValidation();         
           //bindclick();         
         });
         
         
         
         
         
         
         
         $.validator.addMethod(         
           "australianDate",        
           function(value, element) {         
             return value.match(/^\d\d?\/\d\d?\/\d\d\d\d$/);         
           }
          );
         
         
         
         
         
         
         
         $.validator.addMethod('filesize', function(value, element, param) {         
           return this.optional(element) || (element.files[0].size <= param)         
         });
        

         function bindformsubmitevent() {         
           $("#add_new_product").validate({        
             rules: {         
               'product_name': {         
                 required: true         
               }         
             },         
             errorPlacement: function(error, element) {         
               $("label.error").hide();         
             },         
             highlight: function(element, errorClass, validClass) {         
               $(element).closest(".form-group").addClass("has-danger").removeClass("has-success");         
             },              
             unhighlight: function(element, errorClass, validClass) {         
               $(element).closest(".form-group").addClass("has-success").removeClass("has-danger");         
             },
             submitHandler: function(form) {         
               swal({         
                 title: 'Are you sure?',         
                 text: 'You want to submit this data!',         
                 type: 'info',         
                 showCancelButton: true,         
                 buttonsStyling: false,         
                 confirmButtonClass: 'btn btn-info',         
                 confirmButtonText: 'Yes, submit it!',         
                 cancelButtonClass: 'btn btn-secondary'         
               }).then(function() {         
                 submitdata();         
               });
         
               return false; // if you need to block normal submit because you used ajax
         
         
         
             }
         
         
         
           });
         
         
         
         }
         
         
         
         
         
         var createValidation = function() {
         
           $(".produ").each(function() {
         
             $(this).rules('remove');
         
             $(this).rules('add', {
         
               required: true,
         
             });
         
           });
         
         
         
         
         
         
         
         }
         
         
         
         
         
         function submitdata() {
         
           //var form_data =$("#voucherdata").serialize();
         
           var form_id = 'add_new_product';

           //var form_data=new FormData($("form")[0]);
         
           var form_data = new FormData(document.getElementById("add_new_product"));
     
         
           $.ajax({
         
             url: SITE_URL + 'product/add',
         
             type: 'POST',
         
             processData: false,
         
             contentType: false,
         
             async: false,
         
             data: form_data,
         
             cache: false,
         
             success: function(response) {
         console.log(response);
               var jObj = JSON.parse(response);
         
               if (jObj.status === "success") {
         
                 //alert("Voucher added succefully");
         
                 swal("Submitted!", "Product added successfully", "success");
         
                 setTimeout(function() { window.location.href = SITE_URL+'product';}, 1000);
         
               } else if (jObj.status === 'haserror') {
         
                 $("#add_new_product input[name='" + jObj.token_name + "']").val(jObj.hash);
         
                 alert(jObj.error);
         
                 //$('#infomsg1').delay(3000).fadeOut();	
         
               }
         
             }
         
           });
         
         }
         
      </script>
      <?php echo getExtraThing(); ?>
   </body>
</html>