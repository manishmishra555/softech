<div class="header-empty-space"></div>

        <div class="container">
            <div class="empty-space col-xs-b15 col-sm-b30"></div>
            <div class="breadcrumbs">
                <a href="#">home</a>
                <a href="#">shopping cart</a>
            </div>
        </div>
        <?php  $cart=getCart();
        $cart_subtotal=0;$pcookie_id = 0;
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
                <div class="simple-article size-3 grey uppercase col-xs-b5">shopping cart</div>
                <div class="h2">check your products</div>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>

        <div class="empty-space col-xs-b35 col-md-b70"></div>

        <div class="container">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th style="width: 95px;"></th>
                        <th>product name</th>
                        <th style="width: 150px;">Info</th>
                        <th style="width: 260px;">quantity</th>
                        <?php if($this->session->has_userdata('userId')){ ?>
                        <th style="width: 150px;">price</th>
                        <th style="width: 150px;">Tax</th>
                        <th style="width: 150px;">total</th>
                        <?php } ?>
                        <th style="width: 70px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($cart['products'] as $pr){
                            $item_subtotal=0;
                            $pid=$pr['itemid'];
                            $price=$pr['itemprice'];
                            $qnty=$pr['itemqnty'];
                            $item_subtotal = $price*$qnty;  
                            
                            $pro_data = $this->db->get_where('tbl_product',array('pid ' => $pid))->result();
                            $cat_id=isset($pro_data[0])?$pro_data[0]->cat_id:'';
                            $gst = 0;
                            if($cat_id == '9'){
                                $gst = '18';
                            }if($cat_id == '6'){
                                $gst = '12';
                            }
                            $gst_total = ($item_subtotal*$gst)/100;
                            $total = $item_subtotal+$gst_total;
                $pcookie_id=$pr['pcookie_id'];
                                
                     ?>
                    <tr class="row_pro-<?= $pcookie_id; ?>">
                        <td data-title=" ">
                            <a class="cart-entry-thumbnail" href="#"><img src="<?php echo $pr['itemimage']; ?>" alt=""></a>
                        </td>
                        <td data-title=" "><h4><a href="<?= $pr['itemlink']; ?>"><?= $pr['itemname']; ?></a></h4><h6 class="h6"><a href="#"><?= $pr['brand_name']; ?></a></h6></td>
                        <td data-title="Info: "><p>Size : <?= $pr['size']; ?></p><p>Color : <span class="cart-color" style="background: <?= $pr['colorcode']; ?>;"></span></p><p>Shape : <?= $pr['shape']; ?></p></td>
                        <td data-title="Quantity: ">
                            <div class="quantity-select">
                                <span class="cartminus" data-itemid="<?= $pcookie_id; ?>"></span>
                                <span class="number"><?= $qnty; ?></span>
                                <span class="cartplus" data-itemid="<?= $pcookie_id; ?>"></span>
                            </div>
                        </td>
                        <?php if($this->session->has_userdata('userId')){ ?>
                        <td data-title="Price: ">₹<?php echo $price; ?></td>
                        <td data-title="GST: ">+ <?php echo $gst.'%'; ?></td>
                        <td data-title="Total:">₹<?php echo $total; ?></td>
                        <?php } ?>
                        <td data-title="" >
                            <div class="button-close" onclick="removeCartItem('<?= $pcookie_id; ?>');" title="Remove this item."></div>
                        </td>
                    </tr>
            <input type="hidden" class="hiddncart" value="1">
                     <?php } ?>
                </tbody>
            </table>
            <div class="empty-space col-xs-b35"></div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-sm-text-right">
                    <div class="buttons-wrapper">
                       
                        <a class="button size-2 style-3" href="<?= site_url('checkout/') ?>">
                            <span class="button-wrapper">
                                <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                <span class="text">checkout</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="empty-space col-xs-b35 col-md-b70"></div>
        </div>


        <?php }else{ ?>
            <div class="container">
            <div class="text-center">
                <div class="simple-article size-3 grey uppercase col-xs-b5">shopping cart</div>
                <div class="h2">There is no Item in your Shopping cart</div>
                <a class="button size-2 style-3" href="<?= site_url('product/') ?>">
                            <span class="button-wrapper">
                                <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                <span class="text">Shop More</span>
                            </span>
                        </a>
                <div class="title-underline center"><span></span></div>
            </div>
        </div>

        <?php } ?>
