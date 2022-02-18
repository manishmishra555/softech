<?php
$company_address = nl2br('S-31 A/1 dlf phase 3 Nathupur, sector 24 Near st. Stephen hospital
Gurugram, Haryana, India 122002');
$company_phone = '+91 8766277208';
 
$company_gst_number = '';
?><div><b><?php echo "Hello Natur"; ?></b></div>

<div style="line-height: 3px;"> </div>
<span class="invoice-meta" style="font-size: 90%; color: #666;"><?php
    if ($company_address) {
        echo $company_address;
    }
    ?>
    <?php if ($company_phone) { ?>
        <br /><?php echo "Phone: " . $company_phone; ?>
    <?php } ?>
    <?php if ($company_gst_number) { ?>
        <br /><?php echo "GST No.: " . $company_gst_number; ?>
    <?php } ?>
</span>