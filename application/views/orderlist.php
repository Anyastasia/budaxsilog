<body>
<div class="container">
    <div class="mx-2 my-3">
        <a href="<?= base_url('admin')?>"><i class="bi bi-chevron-compact-left"></i>Return to home</a>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Filter</button>
            <ul class="dropdown-menu">
                <li><a href="<?= site_url('orderlist/1');?>" class="dropdown-item">All</a></li>
                <li><a href="<?= site_url('orderlist');?>" class="dropdown-item">Pending Orders</a></li>
                <li><a href="<?= site_url('orderlist/2');?>" class="dropdown-item">Accepted Orders</a></li>
                <li><a href="<?= site_url('orderlist/3');?>" class="dropdown-item">Delivered Orders</a></li>
                <li><a href="<?= site_url('orderlist/4');?>" class="dropdown-item">Canceled Orders</a></li>
            </ul>
        </div>
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
                        <td class="text-white" <?php if($order["modeOfPayment"] == 0){ ?> >
                            <p>GCash</p>
                        <?php } else { ?>
                            <p>Cash-on-Delivery</p>
                        <?php } ?> </td>
                        <?php if ($order["orderStatus"] == NULL) {?>
                            <td><p>Pending</p></td>
                            <?= form_open("updateOrderStatus") ?>
                            <?= form_hidden('customerID', $order["customerID"]); ?>
                            <td><button type="submit" value="<?=1?>" name="updateStatusButton">Confirm</button></td>
                        <?= form_close() ?>
                        <?php } elseif ($order["orderStatus"] == 0) {?>
                            <td><p>Canceled</p></td>    
                        <?php } elseif ($order["orderStatus"] == 1) {?>
                            <td><p>Accepted</p></td>
                        <?= form_open("updateOrderStatus") ?>
                            <?= form_hidden('customerID', $order["customerID"]); ?>
                            <td><button type="submit" value="<?=2?>" name="updateStatusButton">Ready</button></td>
                        <?= form_close() ?>
                        <?php } elseif ($order["orderStatus"] == 2) {?>
                            <td><p>Ready</p></td>
                            <?= form_open("updateOrderStatus") ?>
                            <?= form_hidden('customerID', $order["customerID"]); ?>
                            <td><button type="submit" value="<?=3?>" name="updateStatusButton">In transit</button></td>
                        <?= form_close() ?>
                        <?php } elseif ($order["orderStatus"] == 3) {?>
                            <td><p>In transit</p></td>
                            <?= form_open("updateOrderStatus") ?>
                            <?= form_hidden('customerID', $order["customerID"]); ?>
                            <td><button type="submit" value="<?=4?>" name="updateStatusButton">Delivered</button></td>
                        <?= form_close() ?>
                        <?php } else { ?>
                            <td><p>Delivered</p></td>
                        <?php } ?>
                        <?php if (($order["orderStatus"] >= 1 && $order["orderStatus"] <= 3) || $order["orderStatus"] == NULL) {?>
                        <?= form_open("updateOrderStatus") ?>
                            <?= form_hidden('customerID', $order["customerID"]); ?>
                            <td><button class="btn btn-danger" type="submit" value="<?=0?>" name="updateStatusButton">Cancel</button></td>
                        <?= form_close() ?>
                        <?php } else { ?>
                            <td></td>
                            <td></td>
                        <?php } ?>
                    </tr>
                <?php }?>
            </tbody>

        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>