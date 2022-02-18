<div><b><?php echo "Bill to"; ?></b></div>
<div style="line-height: 2px; border-bottom: 1px solid #f2f2f2;"> </div>
<div style="line-height: 3px;"> </div>
<strong><?php echo $customers->name; ?> </strong>
<br>
Contact: <strong><?php echo $address_info->mobile; ?> </strong>
<div style="line-height: 3px;"> </div>
<span class="invoice-meta" style="font-size: 90%; color: #666;">
    <?php if ($address_info->addressline) { ?>
        <div><?php echo nl2br($address_info->addressline." ". $address_info->addressline2); ?>
            <?php if ($address_info->city) { ?>
                <br /><?php echo $address_info->city; ?>
            <?php } ?>
            <?php if ($address_info->state) { ?>
                <br /><?php echo $address_info->state; ?>
            <?php } ?>
            <?php if ($address_info->zipcode) { ?>
                <br /><?php echo $address_info->zipcode; ?>
            <?php } ?>             
            <br /><?php echo "INDIA"; ?>

        </div> 
<?php } ?>
</span>