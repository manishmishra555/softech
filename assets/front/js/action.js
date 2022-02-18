$(".btn_option.btn1").click(function(){
  $(".dropdown-menu.drop1").toggle();
}); 

$(".btn_option.btn2").click(function(){
  $(".dropdown-menu.drop2").toggle();
});

$('.form-checkout input[name="uphone"]').on("keypress keyup blur", function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
    if ($('.form-checkout input[name="uphone"]').val().length > 9 ) {
        event.preventDefault();
    }
});

  $('.step1 input[name="mobile"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step1 input[name="mobile"]').val().length > 9 ) {
                    event.preventDefault();
                }
            });

            $('.step3 input[name="addr_mobile"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step3 input[name="addr_mobile"]').val().length > 9 ) {
                    event.preventDefault();
                }
            });

            $('.step3 input[name="addr_pincode"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step3 input[name="addr_pincode"]').val().length > 5 ) {
                    event.preventDefault();
                }
            });
            $('.step3 input[name="addr_pincode_comp"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step3 input[name="addr_pincode_comp"]').val().length > 5 ) {
                    event.preventDefault();
                }
            });

            $('.step3 input[name="addr_mobile_comp"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step3 input[name="addr_mobile_comp"]').val().length > 9 ) {
                    event.preventDefault();
                }
            });
            
            $('.step4 input[name="otp_validate"]').on("keypress keyup blur", function (event) {
                $(this).val($(this).val().replace(/[^\d].+/, ""));
                if ((event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
                if ($('.step4 input[name="otp_validate"]').val().length > 3 ) {
                    event.preventDefault();
                }
            });

            $('.step2 input[name="comp_gst"]').on("keypress keyup blur", function (event) {               
                if ($('.step2 input[name="comp_gst"]').val().length > 15 ) {
                    event.preventDefault();
                }
            });
            $('.step2 input[name="pan_no"]').on("keypress keyup blur", function (event) {
                if ($('.step2 input[name="pan_no"]').val().length > 10 ) {
                    event.preventDefault();
                }
            });

            $(".btn-step1").click(function(e) {
                var uname = $('.step1 input[name="uname"]').val();
                var mobile = $('.step1 input[name="mobile"]').val();
                var email = $('.step1 input[name="email"]').val();
                var password = $('.step1 input[name="password"]').val();
                var confirmpassword = $('.step1 input[name="confirmpassword"]').val();
                if (uname == '') {
                    $('.step1 input[name="uname"]').focus();
                    alert('Please Enter your Name');
                }else if(mobile == ''){
                    $('.step1 input[name="mobile"]').focus();
                    alert('Please Enter your Mobile Number');
                }else if(email == ''){
                    $('.step1 input[name="email"]').focus();
                    alert('Please Enter your email');
                }else if(password == ''){
                    $('.step1 input[name="password"]').focus();
                    alert('Please Enter password');
                }else if(confirmpassword == ''){
                    $('.step1 input[name="confirmpassword"]').focus();
                    alert('Please Enter Confirm password');
                }else if(confirmpassword != password){
                    $('.step1 input[name="confirmpassword"]').focus();
                    alert('Password & Confirm password should be same');
                }else{
                    setTimeout(function(){
                        $(".register_block .step1").fadeOut(100);
                    }, 300);
                    setTimeout(function(){
                        $(".register_block .step2").fadeIn(100);
                    }, 100);
                }
            });

            $(".btn-step2").click(function(e) {
                var comp_name = $('.step2 input[name="comp_name"]').val();
                var comp_gst = $('.step2 input[name="comp_gst"]').val();
                var pan_no = $('.step2 input[name="pan_no"]').val();
                if(comp_gst != '' && comp_gst.length < 15){
                    $('.step2 input[name="comp_gst"]').focus();
                    alert('Please Enter Correct GST Number');
                }else if(pan_no != '' && pan_no.length < 10){
                    $('.step2 input[name="pan_no"]').focus();
                    alert('Please Enter Correct PAN Number');
                }else{
                    setTimeout(function(){
                        $(".register_block .step2").fadeOut(100);
                    }, 300);
                    setTimeout(function(){
                        $(".register_block .step3").fadeIn(100);
                    }, 100);
                }
            });
            
            $(".btn-step3").click(function(e) {
                
                
                var datastring = $("#registrationform").serialize();
                var url = SITE_URL+'login/registration_check';

                    $.ajax({
                    type: "POST",
                    url: url,
                    data: datastring,
                    success: function(data) {
                          //console.log(data);
                          var duce = jQuery.parseJSON(data);
                          
                            if (duce.status == 'haserror') {
                              alert(duce.error);
                            }else{
                                alert(duce.error);
                                setTimeout(function(){
                                    $(".register_block .step3").fadeOut(100);
                                }, 300);
                                setTimeout(function(){
                                    $(".register_block .step4").fadeIn(100);
                                }, 100);
                                $('.step4 input[name="otp_validate"]').val();
                            }
                        }
                    });
            });
            
            $(".resend_otp a").click(function(e) {
                var datastring = $("#registrationform").serialize();
                var url = SITE_URL+'login/resend_register_otp';

                    $.ajax({
                    type: "POST",
                    url: url,
                    data: datastring,
                    success: function(data) {
                          //console.log(data);
                          var duce = jQuery.parseJSON(data);
                          
                            if (duce.status == 'haserror') {
                              alert(duce.error);
                            }else{
                                alert(duce.error);
                                $('.step4 input[name="otp_validate"]').val();
                            }
                        }
                    });
                
            });
            
            $(".btn-step4").click(function(e) {
                
                var datastring = $("#registrationform").serialize();
                var url = SITE_URL+'login/submitregistration';

                    $.ajax({
                    type: "POST",
                    url: url,
                    data: datastring,
                    success: function(data) {
                          //console.log(data);
                          var duce = jQuery.parseJSON(data);
                          
                            if (duce.status == 'haserror') {
                              alert(duce.error);
                              $('.step4 input[name="otp_validate"]').focus();
                            }else{
                                alert(duce.error);
                                setTimeout(function(){ window.location = 'login'; }, 2000);
                            }
                        }
                    });
                    
                
                
                
                
            });

            $('#chk_terms').change(function() {
                if(this.checked) {
                    $('input[name="addr_line1_comp"]').val($('input[name="addr_line1"]').val());
                    $('input[name="addr_line2_comp"]').val($('input[name="addr_line2"]').val());
                    $('input[name="addr_city_comp"]').val($('input[name="addr_city"]').val());
                    $('input[name="addr_state_comp"]').val($('input[name="addr_state"]').val());
                    $('input[name="addr_pincode_comp"]').val($('input[name="addr_pincode"]').val());
                    $('input[name="addr_name_comp"]').val($('input[name="addr_name"]').val());
                    $('input[name="addr_mobile_comp"]').val($('input[name="addr_mobile"]').val());    
                }else{
                    $('input[name="addr_line1_comp"]').val('');
                    $('input[name="addr_line2_comp"]').val('');
                    $('input[name="addr_city_comp"]').val('');
                    $('input[name="addr_state_comp"]').val('');
                    $('input[name="addr_pincode_comp"]').val('');
                    $('input[name="addr_name_comp"]').val('');
                    $('input[name="addr_mobile_comp"]').val('');
                }                    
            });

            $(".btn-prev2").click(function(e) {
                setTimeout(function(){
                    $(".register_block .step2").fadeOut(100);
                }, 100);
                setTimeout(function(){
                    $(".register_block .step1").fadeIn(300);
                }, 300);
            });

            $(".btn-prev3").click(function(e) {
                setTimeout(function(){
                    $(".register_block .step3").fadeOut(100);
                }, 100);
                setTimeout(function(){
                    $(".register_block .step2").fadeIn(300);
                }, 300);
            });
            
            $(".btn-prev4").click(function(e) {
                setTimeout(function(){
                    $(".register_block .step4").fadeOut(100);
                }, 100);
                setTimeout(function(){
                    $(".register_block .step3").fadeIn(300);
                }, 300);
            });

            $('.color-selection .entry').click(function(e) {
                $('.color_clas').val($(this).attr('data-id'));
            });
            $('.SlectBox.size').on('change', function() {
                $('.size_clas').val(this.value);
            });
            $('.SlectBox.shape').on('change', function() {
                $('.shape_clas').val(this.value);
            });

          $('.searchItem').keyup(function(){
            var searchField = $('.searchItem').val();
            var url = SITE_URL+'getProductSearchData';

            if(searchField == ''){
                $('.resultSearch').html('');
            }else{

            $.ajax({
                type: "POST",
                url: url,
                data: {seachData:searchField},
              })
              .done(function(response) {
                console.log(response);
                var jObj=JSON.parse(response);
                var resultdata = '';   

                var prnt = '';
                var resp = jObj.data;
                $.each(resp, function(i, item) {   
                    var url = item.url;
                    prnt += '<li class="list-group-item link-class"><a href="'+url+'"><div class="pro_list_info"><p>'+item.name+' <span class="text-muted"></span></p></div></a></li>';
                });
              $('.resultSearch').css('display','block');
              $('.resultSearch').html(prnt);
              });
          }
              });

function removeCartItem(pId){
        var item_id = pId;
        
        $('.row_pro-'+item_id).remove();
            var url = SITE_URL+'cart/removeItem';
 
            $.ajax({
                type: "POST",
                url: url,
                data: {id:item_id},
              })
              .done(function(data) {
                console.log(data);
                 var jObj=JSON.parse(data);

                var atr = '<a href="javascript:void(0);" data-toggle="tooltip" data-item_id="'+item_id+'" data-placement="top" onclick=addToCartItem("'+item_id+'"); title="Add to Cart"><i class="icon-bag"></i></a>';
                $('.cart_'+item_id).html(atr);

                var atr_blk = '<a class="button size-2 style-3" href="javascript:void(0);" onclick=addToCartItem("'+item_id+'");> <span class="button-wrapper"> <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span> <span class="text">Add To Cart</span> </span> </a>';
                $('.cartblk_'+item_id).html(atr_blk);
                $('.row_pros-'+item_id).html(atr_blk);

                $(".alert_sucsss").fadeIn(500);
                $(".alert_sucsss").delay(5000).fadeOut(1000);
                $('.alert_sucsss .data_ad').html('<strong>Success</strong> Item Removed..!');
                
                var total_count=jObj.total_items;
                var total_price=jObj.cart_total;

                $(".cart .cart-label").text(total_count);
                $('.item_total span').text('₹'+total_price);


              }).error(function(data){
                 console.log(data);
              });
 
         }
 

    function addToCartItem(proid){
            var url = SITE_URL+'cart/addItem';
            var array = proid.toString().split("-");
  
            var item_id=array[0];
            var item_qnty=array[1];
            var item_size=array[2];
            var item_color=array[3];
            var item_shape=array[4];
            
            var proid = item_id+'-'+item_qnty+'-'+item_size+'-'+item_color+'-'+item_shape;

            $.ajax({
                type: "POST",
                url: url,
                data: {id:item_id,qty:item_qnty,color:item_color,shape:item_shape,size:item_size},
              })
              .done(function(data) {
                  
                var jObj=JSON.parse(data);
                if(jObj.status){
                    var atr = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" onclick=removeCartItem("'+proid+'"); title="Remove from Cart"><i class="icon-trash"></i></a>';
                    $('.cart_'+item_id).html(atr);

                    var rem_atr = '<a class="button size-2 style-2" href="javascript:void(0);" onclick=removeCartItem("'+proid+'");> <span class="button-wrapper"> <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span> <span class="text">Remove from Cart</span> </span> </a>';
                    $('.cartblk_'+item_id).html(rem_atr);
                
                }
                $(".alert_sucsss").fadeIn(500);
                $(".alert_sucsss").delay(5000).fadeOut(1000);
                $('.alert_sucsss .data_ad').html('<strong>Success</strong> Item Added to Cart..!');
                 headerCart(jObj);
              }).error(function(data){
                 console.log(data);
              })
       }

       function addToCartProduct(proid){
            var url = SITE_URL+'cart/addItem';
            var item_id=proid;
            var item_qnty=$('.number_cart_pro').text();
            var item_size=$("input[name='radio_size']:checked").val();
            var item_color=$('.color_clas').val();
            var item_shape=$("input[name='radio_shape']:checked").val();
            if (item_size == '') {
                alert('Please Select Size');
            }else if (item_color == '') {
                alert('Please Select Color');                
            }else if (item_shape == '') {
                alert('Please Select Shape');                
            }else{

            $.ajax({
                type: "POST",
                url: url,
                data: {id:item_id,qty:item_qnty,color:item_color,shape:item_shape,size:item_size},
              })
              .done(function(data) {
                 var jObj=JSON.parse(data);
                if(jObj.status){
                    var atr = '<a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" onclick=removeCartItem("'+item_id+'"); title="Remove from Cart"><i class="icon-trash"></i></a>';
                    $('.cart_'+item_id).html(atr);

                    // var rem_atr = '<a class="button size-2 style-2" href="javascript:void(0);" onclick="removeCartItem('+item_id+');"> <span class="button-wrapper"> <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-3.png" alt=""></span> <span class="text">Remove from Cart</span> </span> </a>';
                    // $('.cartblk_'+item_id).html(rem_atr);
                }
                $(".alert_sucsss").fadeIn(500);
                $(".alert_sucsss").delay(5000).fadeOut(1000);
                $('.alert_sucsss .data_ad').html('<strong>Success</strong> Item Added to Cart..!');
                 headerCart(jObj);
              }).error(function(data){
                 console.log(data);
              });
          }
       }


       function headerCart(jObj){
            var product=jObj.products;
            var total_count=jObj.totalitems;
            var ht='';
            var total_price = 0;
            var cartbtn='';
            
            if(jObj.status=="added"){
                if(product.length>0){
                    for(var i=0;i<product.length;i++){
                        var proid = product[i].itemid+'-'+product[i].itemqty+'-'+product[i].size+'-'+product[i].color+'-'+product[i].shape;
                        var subT = product[i].itemqty*product[i].itemprice;
                        total_price += subT;
                       ht +='<div class="cart-overflow header_cartlist"><div class="cart-entry clearfix row_pro-'+product[i].itemid+'"><div class="cart-entry-thumbnail"><img src="'+product[i].itemimage+'" alt="'+product[i].itemname+'"></div><div class="cart-entry-description"><table><tbody><tr><td><div class="h6"><a href="#">'+product[i].itemname+'</a></div><div class="simple-article size-1">QUANTITY: '+product[i].itemqty+'</div></td><td data-title="Info: "><p>Size : '+product[i].size+'</p><p>Color : <span class="cart-color" style="background: '+product[i].colorcode+';"></span></p><p>Shape : '+product[i].shape+'</p></td><td><div class="button-close" onclick=removeCartItem("'+proid+'"); title="Remove this item"></div></td></tr></tbody></table></div></div></div>';
                    }
                    //cartbtn+='<div class="cart-button">';
                    cartbtn+='<a class="button size-2 style-3" href="'+SITE_URL+'viewcart"> <span class="button-wrapper"> <span class="icon"><img src="img/icon-4.png" alt=""></span> <span class="text">proceed to checkout</span> </span> </a>';
                    //cartbtn+='</div>';
                }else{
                    cartbtn+='<p class="color-white">Cart is empty</p>';
                }
                $(".header_cartlist").html(ht);
                $(".cart-button").html(cartbtn);
                $(".cart .cart-label").text(total_count);
                $('.item_total span').text('₹'+total_price);
                
                //result('.success', jObj.msg);
            }else if(jObj.status=="exist"){
                //result('.error', jObj.msg);
                //$("#enquirysubmitinfo").text(jObj.msg);
                alert("Item already added in your cart.");
                //$("#enquiryinfoModal").modal('show');
            }
            //window.location.reload();
       }


       $(document).on("change", ".nice-select", function() {
          var sortingMethod = $(this).val();

          if(sortingMethod == 'l2h') {
            sortProductsPriceAscending();
          } else if (sortingMethod == 'h2l') {
            sortProductsPriceDescending();
          }else if (sortingMethod == 'atz') {
            sortProductsAlphaAscending();
          }else if (sortingMethod == 'zta') {
            sortProductsAlphaDescending();
          }
        });

    function sortProductsPriceAscending() {
      var gridItems = $('.grid-item');

      gridItems.sort(function(a, b) {
        return $('.product-item', a).data("price") - $('.product-item', b).data("price");
      });

      $(".shop-product-wrap").append(gridItems);
    }

    function sortProductsPriceDescending() {
      var gridItems = $('.grid-item');
      
      gridItems.sort(function(a, b) {
        return $('.product-item', b).data("price") - $('.product-item', a).data("price");
      });

      $(".shop-product-wrap").append(gridItems);
    }
    function sortProductsAlphaAscending(){
        var desc = true;
        var ul = "list";
        if(typeof ul == "string")
            ul = document.getElementById(ul);

          var lis = ul.getElementsByClassName("grid-item");
          var vals = [];

          for(var i = 0, l = lis.length; i < l; i++)
            vals.push(lis[i].innerHTML);

          vals.sort();

          if(desc)
            vals.reverse();

          for(var i = 0, l = lis.length; i < l; i++)
            lis[i].innerHTML = vals[i];
    }
    function sortProductsAlphaDescending(){
        var desc = false;
        var ul = "list";
        if(typeof ul == "string")
            ul = document.getElementById(ul);

          var lis = ul.getElementsByClassName("grid-item");
          var vals = [];

          for(var i = 0, l = lis.length; i < l; i++)
            vals.push(lis[i].innerHTML);

          vals.sort();

          if(desc)
            vals.reverse();

          for(var i = 0, l = lis.length; i < l; i++)
            lis[i].innerHTML = vals[i];
    }
    $(document).on("click", ".filter_price", function() {
        var amt = $('.hidnAmt').val();
        var array = amt.split(",");

        showProducts(array[0], array[1]);
    });
    

    function showProducts(minPrice, maxPrice) {
        $("#list .grid-item").hide().filter(function() {
            var price = parseInt($(this).data("price"), 10);
            return price >= minPrice && price <= maxPrice;
        }).show();
    }

$('.form-checkout').on('submit', function (e) {  
        e.preventDefault();
         var first_name = $('.form-checkout input[name="fname"]').val();  
         var last_name = $('.form-checkout input[name="lname"]').val();  
         var company_name = $('.form-checkout input[name="company_name"]').val();  
         var uemail = $('.form-checkout input[name="uemail"]').val();  
         var uphone = $('.form-checkout input[name="uphone"]').val();  
         var about_order = $('.form-checkout textarea[name="about_order"]').val();  

         if (first_name == '') {
            $('.form-checkout input[name="fname"]').focus();
            alert('Please Enter First Name');
         }else if (last_name == '') {
            $('.form-checkout input[name="lname"]').focus();
            alert('Please Enter Last Name');            
         }else if (company_name == '') {
            $('.form-checkout input[name="company_name"]').focus();
            alert('Please Enter Company Name');            
         }else if (uemail == '') { 
            $('.form-checkout input[name="uemail"]').focus();
            alert('Please Enter Email');            
         }else if (uphone == '') {
            $('.form-checkout input[name="uphone"]').focus();
            alert('Please Enter Phone Number');            
         }else if (uphone.length < 10){
            $('.form-checkout input[name="uphone"]').focus();
            alert('Please Enter 10 Digit Phone Number');      
         }else if (about_order == '') {
            $('.form-checkout input[name="about_order"]').focus();
            alert('Please Enter message');            
         }else{
            var fd = new FormData();
            fd.append('first_name',first_name);
            fd.append('last_name',last_name);
            fd.append('company_name',company_name);
            fd.append('uemail',uemail);
            fd.append('uphone',uphone);
            fd.append('about_order',about_order);
            
            $.ajax({
                url: SITE_URL+'cart/completeOrder',
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response)
                {
                    var jObj = JSON.parse(response);
                    if (jObj.status == 'success') {
                         alert(jObj.error);
                         setTimeout(function () { window.location.href = SITE_URL + 'user/orders'; }, 2000);                       
                    } else {
                        alert(jObj.error);
                    }
                }
            });
         }
    });




 $(document).ready(function(){
                $('.filter_var').click(function(){
                    filterSearch();
                }); 
            });
            function filterSearch() {
                var action = 'fetch_data';
                var brand = getFilterData('brand');
                var category = getFilterData('category');
                var color = getFilterData('color');
                var frame_type = getFilterData('frame_type');
                var gender = getFilterData('gender');
                var frame_size = getFilterData('frame_size');
                var frame_shape = getFilterData('frame_shape');
                var frame_material = getFilterData('frame_material');
                // console.log(category+', '+brand+', '+color+', '+frame_type+', '+gender+', '+frame_size+', '+frame_shape+', '+frame_material);

                $.ajax({
                    url:SITE_URL+'search/filterItem',
                    method:"POST",
                    dataType: "json",       
                    data:{action:action, category:category, color:color, brand:brand, frame_type:frame_type, gender:gender, frame_size:frame_size, frame_shape:frame_shape, frame_material:frame_material},
                    success:function(data){
                        console.log(data);
                        $('.products-content .nopadding').html(data);
                    }
                });
            }
            function getFilterData(className) {
                var filter = [];
                $('.'+className+':checked').each(function(){
                    filter.push($(this).val());
                });
                return filter;
            }
$(".phone").on("keypress keyup blur", function (event) {
  $(this).val($(this).val().replace(/[^\d].+/, ""));
  if ((event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
  if ($(".phone").val().length > 9 ) {
    event.preventDefault();
  }
});
$("#career-form").submit(function(e) {
    e.preventDefault(); 
    var email = $('#career-form #email').val();
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)){
        alert('Please Enter Valid Email..');
        $('#career-form #email').focus();
    }else{
        $('#career-form')[0].submit();
    }
    
    
});