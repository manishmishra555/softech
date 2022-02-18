<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        @media print {
            @page {
                size: A3;
            }
        }

        ul {
            padding: 0;
            list-style: none;
            border-bottom: 1px solid silver;
        }

        body {
            font-family: "Palatino Linotype", "Book Antiqua", Palatino, serif;
            margin: 0;
        }

        .container {
            padding: 20px 40px;
        }

        .inv-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .inv-header :nth-child(2) {
            flex-basis: 30%;
        }

        .inv-title {
            padding: 10px;
            border: 1px solid silver;
            text-align: center;
            margin-bottom: 20px;
        }

        .no-margin {
            margin: 0;
        }

        .inv-logo {
            width: 150px;
        }

        .inv-header h2 {
            font-size: 20px;
            margin: 1rem 0 0 0;
        }

        .inv-header ul li {
            font-size: 15px;
            padding: 3px 0;
        }

        /* table in head */
        .inv-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .inv-header table th,
        .inv-header table td,
        .inv-header table {
            border: 1px solid silver;
        }

        .inv-header table th,
        .inv-header table td {
            text-align: right;
            padding: 8px;
        }

        /* Body */
        .inv-body {
            margin-bottom: 20px;
        }

        .inv-body table {
            width: 100%;
            border: 1px solid silver;
            border-collapse: collapse;
        }

        .inv-body table th,
        .inv-body table td {
            padding: 10px;
            border: 1px solid silver;
        }

        .inv-body table td h5,
        .inv-body table td p {
            margin: 0 5px 0 0;
        }

        /* Footer */
        .inv-footer {
            clear: both;
            overflow: auto;
        }

        .inv-footer table {
            width: 30%;
            float: right;
            border: 1px solid silver;
            border-collapse: collapse;
        }

        .inv-footer table th,
        .inv-footer table td {
            padding: 8px;
            text-align: right;
            border: 1px solid silver;
        }
    </style>
</head>

<body <?php if ($print == 'print') {
            echo 'onload="window.print()"';
        } ?>>
    <div class="container">
        <div class="inv-title">
            <h1 class="no-margin">Challan # <?php echo $challan_id; ?></h1>
        </div>
        <div class="inv-header">
            <div>
                <img src="<?php echo ADMIN_ASSETS_PATH; ?>img/logo.png" class="inv-logo">
                <h2>POLO ELEVATORS STOCK</h2>
                <ul>
                    <li>POLO TOWERS, Plot No. 926-927</li>
                    <li>Rithala Industrial Area, Near Rice Mill</li>
                    <li>Delhi-110085</li>
                </ul>

            </div>
            <div>
                <table>
                    <tr>
                        <th>Issue Date</th>
                        <td><?php echo date('d-m-Y', strtotime($challandata[0]->date_added)); ?></td>
                    </tr>
                    <tr>
                        <th>Project Name</th>
                        <td><?php echo $project[0]->project_name; ?></td>
                    </tr>
                    <tr>
                        <th>Assigned to </th>
                        <td><?php
                            $emp = $this->ion_auth->user((int) $challandata[0]->assigned_to)->row();
                            echo $emp->first_name . " " . $emp->last_name; ?></td>
                    </tr>
                    <tr>
                        <th>Challan Mode </th>
                        <td><?php echo $ch_type = $challandata[0]->challan_type; ?></td>
                    </tr>
                    <tr>
                        <th>Challan Date </th>
                        <td><?php echo date('d-m-Y', strtotime($challandata[0]->date_added)); ?></td>
                    </tr>


                </table>
            </div>
        </div>
        <div class="inv-body">
            <table>
                <thead>
                    <th>S. No.</th>
                    <th>Description of Goods</th>
                    <th>Quantity</th>
                    <th>Rate</th>
                    <th>Amount</th>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $total_qnty = 0;
                    $total_amount = 0;
                    foreach ($challan_items as $item) {
                        $item_details = getItemDetails($item->item_id);
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <p><?php echo $item_details[0]->item_name; ?></p>
                            </td>
                            <td><?php $qnty = $item->quantity;
                                $total_qnty += $qnty;
                                echo $qnty; ?></td>
                            <td><?= $item->rate; ?></td>
                            <td>
                                <?php
                                $amount = $qnty * $item->rate;
                                $total_amount += $amount;
                                echo '₹' . $amount;
                                ?>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>
        <div class="inv-footer">
            <table>
                <tr>
                    <th>Total Quantity</th>
                    <td><?= $total_qnty; ?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td><?= '₹ ' . $total_amount; ?></td>
                </tr>

            </table>
        </div>
        <br>
        <div class="inv-body" style="width: 30%; float: left;">
            <table>
                <tr>
                    <th >Dispatch through</th>
                    <td><?= $challandata[0]->dispatch_through; ?></td>
                </tr>
                <tr>
                    <th>Dispatch Details</th>
                    <td><?= $challandata[0]->dispatch_detail; ?></td>
                </tr>
                <tr>
                    <th>Delivery By</th>
                    <td><?= $challandata[0]->delivery_by; ?></td>
                </tr>
                <tr>
                    <th>Delivery Details</th>
                    <td><?= $challandata[0]->delivery_detail; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>