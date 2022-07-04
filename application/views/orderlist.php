<body>
<div class="container">
    <div class="mx-2 my-3">
        <a href="<?= base_url('admin')?>"><i class="bi bi-chevron-compact-left"></i>Return to home</a>
        <table class="table table-striped text-white">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Address</th>
                    <th>Order</th>
                    <th>Quantity</th>
                    <th>Code</th>
                    <th>Mode of Payment</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orderList as $order){?>
                    <tr class="align-middle">
                        <td class="text-white"><?= $order["customerID"]; ?> </td>
                        <td class="text-white"><?= ucwords($order["name"]); ?></td>
                        <td class="text-white"><?= $order["contactNumber"]; ?></td>
                        <td class="text-white"><?= $order["address"]; ?></td>
                        <!-- <td class="text-white"><?= $order["order"]; ?></td> -->
                        <?php $orders = explode(",", $order["order"]); $orderName = array(); $orderQuantity = array();?>
                        <?php for ($i = 0; $i < count($orders); $i++) {?>
                            <?php $x = explode("=", $orders[$i])?>
                            <?php if((int) $x[1] > 0) {?>
                                <?php array_push($orderName, ucwords($productList[$i]["productName"])); array_push($orderQuantity, $x[1]) ?>
                            <?php }?>
                        <?php }?>
                        <td class="text-white"><?php foreach($orderName as $xorder) {?>
                            <p><?= $xorder?></p>
                        <?php } ?>
                        </td>
                        <td class="text-white"><?php foreach($orderQuantity as $quantity) {?>
                            <p><?= $quantity?></p>
                        <?php } ?>
                        </td>
                        <td class="text-white"><?= $order["code"]; ?></td>
                        <td <?php if($order["modeOfPayment"] == 0){ ?> >
                            <p>mode is 0</p>
                        <?php } else { ?>
                            <p>mode is 1</p>
                        <?php } ?> </td>
                        <td <?php if($order["paymentStatus"] == 0){ ?> >
                            <p>payment status is 0</p>
                        <?php } else { ?>
                            <p>payment status is 1</p>
                        <?php } ?> </td>
                        <?php if($order["orderStatus"] == 0) {?>
                            <td><p>order status is 0</p></td>
                            <td><button>Confirm</button></td>
                        <?php } else { ?>
                            <td><p>order status is 1</p></td>
                            <td><button disabled>Confirm</button></td>
                        <?php } ?>                           
                    </tr>
                <?php }?>
            </tbody>

        </table>
    </div>
</div>
</body>