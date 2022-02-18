<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $text = "\xE0";
    utf8_encode($text);
?>
<div style=" margin: auto;">
    <?php    
    $color = "#2AA384";
    $promocode='';
    $item = array(
        "address_info" => $address_info,
        "color" => $color,
        "orders_info" => $orders_info
    );
    $this->load->view('sysadmin/orders/orders_parts/header_style_1.php', $item);
    if (!empty($orders_info->promocode)) {
        $promocode= $orders_info->promocode;
    }
     ?>
</div>

<br />

<table class="table-responsive" style="width: 100%; color: #444;">            
    <tr style="font-weight: bold; background-color: <?php echo $color; ?>; color: #fff;  ">
        <th style="width: 45%; border-right: 1px solid #eee;">Item</th>
        <th style="text-align: center;  width: 15%; border-right: 1px solid #eee;">Quantity</th>
        <th style="text-align: right;  width: 20%; border-right: 1px solid #eee;"> Rate</th>
        <th style="text-align: right;  width: 20%; ">Total</th>
    </tr>
    <?php

     foreach ($orders_items as $item) {
        if (!empty($item->item_discounted_price)) {
            $price = $item->item_discounted_price;
        } else {
            $price = $item->item_price;
        }

        $item_total=$price*$item->item_qnty;

        ?>
        <tr style="background-color: #f4f4f4; ">
            <td style="width: 45%; border: 1px solid #fff; padding: 10px;"><?php echo $item->item_name; ?></td>
            <td style="text-align: center; width: 15%; border: 1px solid #fff;"> <?php echo $item->item_qnty; ?></td>
            <td style="text-align: right; width: 20%; border: 1px solid #fff;"> ₹<?php echo $price; ?></td>
            <td style="text-align: right; width: 20%; border: 1px solid #fff;"> ₹<?php echo $item_total; ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="3" style="text-align: right;"><?php echo "Subtotal"; ?></td>
        <td style="text-align: right; width: 20%; border: 1px solid #fff; background-color: #f4f4f4;">
            ₹<?php echo ($orders_info->order_subtotal); ?>
        </td>
    </tr>
       
    <tr>
        <td colspan="3" style="text-align: right;"><?php echo "Shipping Charges"; ?></td>
        <td style="text-align: right; width: 20%; border: 1px solid #fff; background-color: #f4f4f4;">
            ₹<?php echo ($orders_info->shipping_amount); ?>
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: right;"><?php echo "Discount"; ?></td>
        <td style="text-align: right; width: 20%; border: 1px solid #fff; background-color: #f4f4f4;">
            ₹<?php echo ($orders_info->discount_amount); ?>
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: right;"><?php echo "Wallet"; ?></td>
        <td style="text-align: right; width: 20%; border: 1px solid #fff; background-color: #f4f4f4;">
           ₹<?php echo ($orders_info->wallet_amount); ?>
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align: right;"><?php echo "Grand Total"; ?></td>
        <td style="text-align: right; width: 20%; background-color: <?php echo $color; ?>; color: #fff;">
            &#8377;<?php echo ($orders_info->total_amount); ?>
        </td>
    </tr>
</table>
 
    <br /><br /><table class="orders-pdf-hidden-table" style="border-top: 2px solid #f2f2f2; margin: 0; padding: 0; display: block; width: 100%; height: 10px;"></table>
 
