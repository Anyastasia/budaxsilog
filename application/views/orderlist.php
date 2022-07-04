<body>
<div class="container">
    <div class="mx-2 my-3">
        <a href="<?= base_url('admin')?>"><i class="bi bi-chevron-compact-left"></i>Return to home</a>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">Filter</button>
            <ul class="dropdown-menu">
                <li><a href="<?= site_url('orderlist');?>" class="dropdown-item">All</a></li>
                <li><a href="<?= site_url('orderlist/1');?>" class="dropdown-item">Pending Orders</a></li>
                <li><a href="<?= site_url('orderlist/2');?>" class="dropdown-item">Pending Payments</a></li>
                <li><a href="" class="dropdown-item"></a></li>
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
                            <p>GCash</p>
                        <?php } else { ?>
                            <p>Cash-on-Delivery</p>
                        <?php } ?> </td>
                        <td <?php if($order["paymentStatus"] == 0){ ?> >
                            <p>Pending</p>
                        <?php } else { ?>
                            <p>Paid</p>
                        <?php } ?> </td>
                        <?php if($order["orderStatus"] == 0) {?>
                            <td><p>Pending</p></td>
                            <td><button>Confirm</button></td>
                        <?php } else { ?>
                            <td><p>Confirmed</p></td>
                            <td><button disabled>Confirm</button></td>
                        <?php } ?>                           
                    </tr>
                <?php }?>
            </tbody>

        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>