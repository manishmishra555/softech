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
               <div class="card">
                  <div class="card-header">
                     <h2 class="card-title">Product Image</h2>
                  </div>
                  <div class="card-block">
                     <div class="row">
                        <div class="col-sm-12"><?php echo $post_pics; ?></div>
                     </div> 
                     <div class="row">
                        <div class="form-group">
                           <div class="col-sm-12 field_wrapper">
                              <div id="post_pics">
                                 <?php
                                    if (isset($_POST['post_pics'])) {                                    
                                      $Ppics = (array) $_POST['post_pics'];                                    
                                      echo $this->media_model->getImageBlock('post_pics', '195x115', $Ppics);                                    
                                    } ?>
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
                        <div class="col-sm-8">
                           <div class="form-group form-group--float"> <?php echo form_input('product_name', set_value('product_name'), 'class="form-control" id="product_name"'); ?> <?php echo form_label('Product Name', 'product_name'); ?><i class="form-group__bar"></i> </div>
                        </div>
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>Platform</label>
                              <?php
                                  $options = array();      
                                  $options['all'] = 'All';  
                                  $options['meesho'] = 'Meesho';  
                                  $options['amazon'] = 'Amazon';
                                  $options['flipkart'] = 'Flipkart';
                              ?>
                              <?php echo form_dropdown('gst_percentage', $options, '', 'class="select2" id="gst_percentage"'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>
                     </div>
                     <br>
                     <div class="row">
                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                            <label>Select Brand</label>
                              <?php
                                 $options = array();                                 
                                 $options[''] = 'Select Brand';                                 
                                 if (count($brand) > 0) {                                 
                                   foreach ($brand as $bc) {                                 
                                     $options[$bc->id] = $bc->brand_name;
                                    }                                 
                                 } ?>
                              <?php echo form_dropdown('brand', $options, '', 'class="select2" id="brand" data-control="subbrands"'); ?>

                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <label>Category</label>
                              <?php
                                 $options = array();                                 
                                 $options[''] = 'Select category';                                 
                                 if (count($category) > 0) {                                 
                                   foreach ($category as $bc) {                                 
                                     $options[$bc->cat_id] = $bc->category_name;
                                    }                                 
                                 } ?>
                              <?php echo form_dropdown('cat_id', $options, '', 'class="select2" id="cat_id"'); ?>
                           </div>
                        </div>


                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('hsn_code', set_value('hsn_code'), 'class="form-control" id="hsn_code"'); ?>
                            <?php echo form_label('HSN Code', 'hsn_code'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('catalogue_id', set_value('catalogue_id'), 'class="form-control" id="catalogue_id"'); ?>
                            <?php echo form_label('Catalogue Id', 'catalogue_id'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('product_id', set_value('product_id'), 'class="form-control" id="product_id"'); ?>
                            <?php echo form_label('Product Id', 'product_id'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('product_sku', set_value('product_sku'), 'class="form-control" id="product_sku"'); ?>
                            <?php echo form_label('Product SKU', 'product_sku'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4" style="display:none;">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('supplier_cost', set_value('supplier_cost'), 'class="form-control" id="supplier_cost"'); ?>
                            <?php echo form_label('Supplier Cost', 'supplier_cost'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>
                        
                        <div class="col-sm-4 col-md-4">
                          <div class="form-group form-group--float"> 
                            <?php echo form_input('mrp', set_value('mrp'), 'class="form-control" id="mrp"'); ?>
                            <?php echo form_label('MRP', 'mrp'); ?>
                            <i class="form-group__bar"></i>
                          </div>                         
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group form-group--float"> 
                                <?php echo form_input('price', set_value('price'), 'class="form-control" id="price"'); ?>
                                <?php echo form_label('Price', 'price'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group"> 
                                <label>GST Percentage</label>
                              <?php
                                  $options = array();      
                                  $options['3'] = '3%';  
                                  $options['12'] = '12%';
                                  $options['18'] = '18%';
                              ?>
                              <?php echo form_dropdown('gst_percentage', $options, '', 'class="select2" id="gst_percentage"'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <div class="form-group form-group--float"> 
                                <?php echo form_input('weight', set_value('weight'), 'class="form-control" id="weight"'); ?>
                                <?php echo form_label('Package Weight', 'weight'); ?>
                                <i class="form-group__bar"></i>
                              </div> 
                           </div>
                        </div>

                        <div class="col-sm-4 col-md-4">
                           <div class="form-group">
                              <label>Weight Unit</label>
                              <?php
                                 $options = array();                                 
                                 $options[''] = 'Select Weight Unit';                                 
                                 if (count($weight) > 0) {                                 
                                   foreach ($weight as $wt) {                                 
                                     $options[$wt->name] = $wt->name;
                                    }                                 
                                 } ?>
                              <?php echo form_dropdown('weight_unit', $options, '', 'class="select2" id="weight_unit"'); ?>
                           </div>
                        </div>

                        
                        

                      </div>


                     <div class="row">
                        <div class="col-sm-12">
                           <h3 class="card-block__title">Product Description</h3>
                           <div class="form-group">
                              <textarea class="form-control" rows="2" name="product_desc" id="product_desc"></textarea>
                              <i class="form-group__bar"></i> 
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