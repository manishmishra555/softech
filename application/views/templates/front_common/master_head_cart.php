
<?php $cart = getCart();?>

<div class="entry hidden-xs hidden-sm cart">
                                <a href="<?= site_url('viewcart/') ?>">
                                    <b class="hidden-xs">Your bag</b>
                                    <span class="cart-icon">
                                        <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        <span class="cart-label"><?= $cart['total_items']; ?></span>
                                    </span>
                                </a>
                                <div class="cart-toggle hidden-xs hidden-sm">
                                    <div class="cart-overflow header_cartlist">
                                    <?php $cart = getCart();$totalfinal_cart = 0;
                                        if (count($cart['products']) > 0) { ?>
                                        <?php
                                        foreach ($cart['products'] as $pr) {
                                            $total_cart = $pr['itemqnty']*$pr['itemprice'];
                                            $totalfinal_cart += $total_cart;
                                        ?>
                                        <div class="cart-entry clearfix row_pro-<?= $pr['itemid']; ?>">
                                            <div class="cart-entry-thumbnail"><img src="<?php echo $pr['itemimage']; ?>" alt="<?= $pr['itemname']; ?>" /></div>
                                            <div class="cart-entry-description">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <div class="h6"><a href="#"><?= $pr['itemname']; ?></a></div>
                                                            <div class="simple-article size-1">QUANTITY: <?php echo $pr['itemqnty']; ?></div>
                                                        </td>
                                                        <td data-title="Info: "><p>Size : <?= $pr['size']; ?></p><p>Color : <span class="cart-color" style="background: <?= $pr['colorcode']; ?>;"></span></p><p>Shape : <?= $pr['shape']; ?></p></td>
                                                        <?php if($this->session->has_userdata('userId')){ ?>
                                                        <td>
                                                            <div class="simple-article size-3 grey">₹<?php echo $pr['itemprice']; ?></div>
                                                            <div class="simple-article size-1">TOTAL: ₹<?php echo $total_cart; ?></div>
                                                        </td>
                                                        <?php } ?>
                                                        <td>
                                                            <div class="button-close"  onclick="removeCartItem(<?= $pr['itemid']; ?>);" title="Remove this item"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <?php } ?>  
                                    
                                    <?php }else { ?>
                                        <p class="color-white">Cart is empty</p>
                                    <?php } ?>  
                                    </div>
                                    <div class="empty-space col-xs-b40"></div>
                                    <div class="row">
                                        <?php if($this->session->has_userdata('userId')){ ?>
                                        <div class="col-xs-6">
                                            <div class="cell-view empty-space col-xs-b50 item_total">
                                                <div class="simple-article size-5 grey">TOTAL <span class="color">₹<?= $totalfinal_cart; ?></span></div>
                                            </div>
                                        </div>
                                    <?php } ?>  
                                    <div class="col-xs-6">

                                    </div>
                                        <div class="col-xs-6 text-right cart-button">
                                            <a class="button size-2 style-3" href="<?= site_url('viewcart/') ?>">
                                                <span class="button-wrapper">
                                                    <span class="icon"><img src="img/icon-4.png" alt=""></span>
                                                    <span class="text">proceed to query</span>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>