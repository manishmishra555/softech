<table style="color: #444; width: 100%;">
    <tr class="orders-preview-header-row">
        <td style="width: 45%; vertical-align: top;">
            <?php $this->load->view('sysadmin/orders/orders_parts/company_logo'); ?>
        </td>
        <td class="hidden-orders-preview-row" style="width: 20%;"></td>
        <td class="orders-info-container orders-header-style-one" style="width: 35%; vertical-align: top; text-align: right"><?php
            $data = array(
                "address_info" => $address_info,
                "color" => $color,
                "orders_info" => $orders_info
            );
            $this->load->view('sysadmin/orders/orders_parts/orders_info', $data);
            ?>
        </td>
    </tr>
    <tr>
        <td style="padding: 5px;"></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><?php
            $this->load->view('sysadmin/orders/orders_parts/bill_from', $data);
            ?>
        </td>
        <td></td>
        <td><?php
            $this->load->view('sysadmin/orders/orders_parts/bill_to', $data);
            ?>
        </td>
    </tr>
</table>