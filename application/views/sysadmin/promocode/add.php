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
               <?php echo form_open_multipart('', 'id="add_new_promocode" name="add_new_promocode"'); ?>
            
               <div class="card">
                  <div class="card-header">
                     <h2 class="card-title">Overview</h2>
                  </div>
                  <div class="card-block">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="form-group form-group--float"> <?php echo form_input('promocode_name', set_value('promocode_name'), 'class="form-control" id="promocode_name"'); ?> <?php echo form_label('Title', 'promocode_name'); ?><i class="form-group__bar"></i> </div>
                        </div>

                        <div class="col-sm-3">
                           <label>Create Promocode for : </label>
                           <div class="form-group">
                              <?php
                              $options = array('all' => 'All', 'category' => 'Category', 'products' => 'Products');
                              ?>
                              <?php echo form_dropdown('promocode_on', $options, '', 'class="select2" id="promocode_on" data-placeholder="Promocode on" required'); ?>
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-sm-6 col-md-6">
                           <div class="form-group">
                              <label>Category</label>
                              <?php
                                 $options = array();                                 
                                 $options['all'] = 'All';                                 
                                 if (count($category) > 0) {                                 
                                   foreach ($category as $bc) {                                 
                                     $options[$bc->cat_id] = $bc->category_name;
                                    }                                 
                                 } ?>
                              <?php echo form_dropdown('category_id[]', $options, '', 'class="select2 category" multiple="" id="category_id" data-placeholder="Select Category"'); ?>
                           </div>
                        </div>

                        <div class="col-sm-6 col-md-6">
                           <div class="form-group">
                              <label>Products</label>
                              <?php
                                 $options = array();                                 
                                 $options['all'] = 'All';                                                                
                                 if (count($products) > 0) {                                 
                                   foreach ($products as $pr) {                                 
                                     $options[$pr->pid] = $pr->product_name;
                                    }                                 
                                 } ?>
                              <?php echo form_dropdown('product_id[]', $options, '', 'class="select2 products" multiple="" id="product_id" data-placeholder="Select Product"'); ?>
                           </div>
                        </div>

                         
                      </div>


                      

                      <div class="row">
                        <div class="col-sm-4">
                           <label>Promocode Type</label><br>
                           <label class="custom-control custom-radio">
                              <input name="promocode_type" class="custom-control-input" type="radio" value="flat" checked>
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Flat</span> </label>
                              <label class="custom-control custom-radio">
                              <input name="promocode_type" class="custom-control-input" type="radio" value="percent">
                              <span class="custom-control-indicator"></span> <span class="custom-control-description">Percent</span> </label>
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('promocode_value', set_value('promocode_value'), 'class="form-control" id="promocode_value"'); ?>
                            <?php echo form_label('Promocode Value', 'promocode_value'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('promocode_value_limit', set_value('promocode_value_limit'), 'class="form-control" id="promocode_value_limit"'); ?>
                            <?php echo form_label('Promocode Value Limit', 'promocode_value_limit'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                         

                      </div>


                      <!-- <div class="row">
                           <div class="col-sm-6 col-md-6">                           
                              <div class="form-group"> 
                              <?php echo form_label('Usage Limit Per Coupon', 'usage_limit'); ?><small class="card-subtitle">(How many times the coupon can be used in total)</small>
                                 <?php echo form_input('usage_limit', set_value('usage_limit'), 'class="form-control" id="usage_limit" placeholder="Unlimited"'); ?>
                                 <i class="form-group__bar"></i>
                              </div>                         
                           </div>
                           <div class="col-sm-6 col-md-6">                           
                              <div class="form-group"> 
                                 <?php echo form_label('Usage Limit Per User', 'usage_limit_per_user'); ?><small class="card-subtitle">(How many times the coupon can be used in total.)</small>
                                 <?php echo form_input('usage_limit_per_user', set_value('usage_limit_per_user'), 'class="form-control" id="usage_limit_per_user" placeholder="Unlimited"'); ?>
                                 <i class="form-group__bar"></i>
                              </div>  
                           </div>                              
                      </div> -->
                     
                      <div class="row">
                              <div class="col-sm-3">
                              <div class="input-group"> <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                 <div class="form-group form-group--float">
                                    <input type="text" name="start_date" class="form-control date-picker form-control--active" id="start_date" placeholder="Select date" autocomplete="off">
                                    <i class="form-group__bar"></i> </div>
                              </div>
                              </div>
                              <div class="col-sm-3">
                              <div class="input-group"> <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                 <div class="form-group form-group--float">
                                    <input type="text" name="expiry_date" class="form-control date-picker form-control--active" id="expiry_date" placeholder="Select date" autocomplete="off">
                                    <i class="form-group__bar"></i> 
                                 </div>
                              </div>
                              </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-block">
                       
                     <div class="row">
                        <div class="form-group--centered col-sm-12">
                           <?php echo form_button(array('type' => 'submit', 'name' => 'submit'), 'Submit', 'class="btn btn-success waves-effect"'); ?>
                           <button type="button" class="btn btn-danger waves-effect" onclick="window.location.href='<?= site_url('sysadmin/promocode'); ?>'">Cancel</button>
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
           $("#add_new_promocode").validate({        
             rules: {         
               'promocode_name': {         
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
           var form_id = 'add_new_promocode';         
           //var form_data=new FormData($("form")[0]);         
           var form_data = new FormData(document.getElementById("add_new_promocode"));         
           $.ajax({         
             url: SITE_URL + 'promocode/add',         
             type: 'POST',         
             processData: false,         
             contentType: false,         
             async: false,         
             data: form_data,         
             cache: false,         
             success: function(response) {         
               var jObj = JSON.parse(response);         
               if (jObj.status === "success") {         
                 //alert("Voucher added succefully");         
                 swal("Submitted!", "Promocode added successfully", "success");         
                 setTimeout(function() { window.location.href = SITE_URL+'promocode';}, 1000);         
               } else if (jObj.status === 'haserror') {         
                 $("#add_new_promocode input[name='" + jObj.token_name + "']").val(jObj.hash);         
                 alert(jObj.error);         
                 //$('#infomsg1').delay(3000).fadeOut();	         
               }         
             }         
           });
         
         }
         
      </script>

      <script>
      $('.category').on("select2:select", function (e) { 
           var data = e.params.data.text;
            if(data=='All'){
               $(".category > option").prop("selected","selected");
               $(".category option[value='all']").prop("selected","");
               $(".category").trigger("change");
           }
      });

      $('.products').on("select2:select", function (e) { 
           var data = e.params.data.text;
            if(data=='All'){
               $(".products > option").prop("selected","selected");
               $(".products option[value='all']").prop("selected","");
               $(".products").trigger("change");
           }
      });
      </script>
      <?php echo getExtraThing(); ?>
   </body>
</html>