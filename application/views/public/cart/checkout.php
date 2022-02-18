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
                <a href="#">home</a>
                <a href="#">checkout</a>
            </div>
        </div>
        <?php  $cart=getCart(); 
        $cart_subtotal=0;
        $cart_total=0;
        $item_subtotal=0;
        if(count($cart['products'])>0){
            foreach($cart['products'] as $pr){
                $pid=$pr['itemid'];
                $price=$pr['itemprice'];
                $qnty=$pr['itemqnty'];
            }
        }
            ?>
<?php  if(count($cart['products'])>0){ ?>
        <div class="container">
            <div class="text-center">
                <div class="simple-article size-3 grey uppercase col-xs-b5">checkout</div>
                <div class="h2">check your products</div>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>
        <form class="form-checkout" method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-b50 col-md-b0">
                    <h4 class="h4 col-xs-b25">billing details</h4>
                    <?php $customer_name = $customer_email = $customer_mobile = $customer_ucompany = '';
                    if($this->session->has_userdata('userId')){ 
                                            
                            $user_id = $this->session->userdata('userId');
                            $customers = $this->customers_model->selectdata("*", array('id' => $user_id), "ORDER BY id DESC LIMIT 1");
                            $customer_name=$customers[0]->name;
                            $customer_email=$customers[0]->email;
                            $customer_mobile=$customers[0]->mobile;
                            $customer_ucompany=$customers[0]->company_name;
                            
                    }
                            ?>
                    
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" name="fname" type="text" placeholder="First name" value="<?php echo $customer_name; ?>" autofocus required />
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" name="lname" type="text"  placeholder="Last name" required/>
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                    <input class="simple-input" name="company_name" type="text"  placeholder="Company name" value="<?php echo $customer_ucompany; ?>" required/>
                    <div class="empty-space col-xs-b20"></div>
                    <div class="row m10">
                        <div class="col-sm-6">
                            <input class="simple-input" name="uemail" type="email"  placeholder="Email" value="<?php echo $customer_email; ?>" required/>
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                        <div class="col-sm-6">
                            <input class="simple-input" type="text" name="uphone" placeholder="Phone" value="<?php echo $customer_mobile; ?>" required/>
                            <div class="empty-space col-xs-b20"></div>
                        </div>
                    </div>
                    <textarea class="simple-input" placeholder="Note about your order" name="about_order" required></textarea>

                    <div class="empty-space col-xs-b30 col-sm-b60"></div>
                </div>
                <div class="col-md-6">
                    <h4 class="h4 col-xs-b25">your order</h4>
                    <?php 
                        foreach($cart['products'] as $pr){
                            $item_subtotal=0;
                            $pid=$pr['itemid'];
                            $price=$pr['itemprice'];
                            $qnty=$pr['itemqnty'];
                            $item_subtotal = $price*$qnty;  
                            
                            $pro_data = $this->db->get_where('tbl_product',array('pid ' => $pid))->result();
                            $cat_id=isset($pro_data[0])?$pro_data[0]->cat_id:'';
                            $gst = '';
                            if($cat_id == '9'){
                                $gst = '18';
                            }if($cat_id == '6'){
                                $gst = '12';
                            }
                            $gst_total = ($item_subtotal*$gst)/100;
                            $total = $item_subtotal+$gst_total;
                            $pcookie_id=$pr['pcookie_id'];
                     ?>
                    <div class="cart-entry clearfix">
                        <a class="cart-entry-thumbnail" href="#"><img src="<?php echo $pr['itemimage']; ?>" alt=""></a>
                        <div class="cart-entry-description">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="h6"><a href="#"><?= $pr['itemname']; ?></a></div>
                                            <div class="simple-article size-1">QUANTITY: <?= $qnty; ?></div>
                                        </td>
                                        <td data-title="Info: "><p>Size : <?= $pr['size']; ?></p><p>Color : <span class="cart-color" style="background: <?= $pr['color']; ?>;"></span></p><p>Shape : <?= $pr['shape']; ?></p></td>
                                        <?php if($this->session->has_userdata('userId')){ ?>
                                        <td>
                                            <div class="simple-article size-3 grey">₹<?php echo $price; ?></div>
                                             <div class="simple-article size-3 grey">+<?php echo $gst.'%'; ?></div>
                                            <div class="simple-article size-1">TOTAL: ₹<?php echo $total; ?></div>
                                        </td>
                                        <?php } ?>
                                        <td>
                                            <div class="button-close" onclick="removeCartItem('<?= $pcookie_id; ?>');" title="Remove this item."></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <?php } ?>
                    
                    
                    
                    <div class="empty-space col-xs-b30"></div>
                    <div class="button block size-2 style-3">
                        <span class="button-wrapper">
                            <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                            <span class="text">submit query</span>
                        </span>
                        <input type="submit"/>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <?php }else{ ?>
            <div class="container">
            <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
            <div class="text-center">
                <div class="simple-article size-3 grey uppercase col-xs-b5">shopping cart</div>
                <div class="h2">There is no Item in your Shopping cart</div>

                <a class="button size-2 style-3" href="<?= site_url('product/') ?>">
                            <span class="button-wrapper">
                                <span class="icon"><img src="<?php echo FRONT_ASSETS_PATH; ?>img/icon-4.png" alt=""></span>
                                <span class="text">Shop More</span>
                            </span>
                        </a>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>

        <?php } ?>
            </div>
            
            <div class="empty-space col-xs-b15 col-sm-b50 col-md-b100"></div>
        </div>

        <?php $this->load->view('templates/front_common/master_footer_view'); ?>
      

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