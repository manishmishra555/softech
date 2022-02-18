<span class="orders-info-title" style="font-size:20px; font-weight: bold;background-color: <?php echo $color; ?>; color: #fff;">&nbsp;<?php echo $orders_info->invoice_no; ?>&nbsp;</span>
<div style="line-height: 10px;"></div>
<span><?php echo "Order Date: " . date('d-m-Y', strtotime($orders_info->date_added)); ?></span><br />
 