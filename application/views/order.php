<?php
$order = $this->session->userdata('order');
$orderTotal = $this->session->userdata('orderTotal');
?>
<body>    
    <nav id="header" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="<?=base_url()?>" class="navbar-brand">BudaXSilog</a>
            <button class="navbar-toggler secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapseNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item header-item"><a href="<?=base_url('Cart');?>">Order <label id="orderCount"><?= ($orderTotal > 0) ? $orderTotal : "";?></label></a></li>
                    <li class="nav-item header-item"><a href="#">Status</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="menu">
        <div>
            <?php
                for($x=0;$x<count($order);$x++){
                    if($order[$x] > 0){
                        $temp = $x+1;
                        echo '<div id="Item'.$x.'">';
                        echo '<h5>Item '.$temp.': </h5>';
                        echo '<input type="number" id="order"'.$x.'" value="'.$order[$x].'" onchange="updateAmount('.$x.',this.value)">';
                        echo '<button onclick="removeItem('.$x.')">remove</button>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function order(id){
            bStatus = document.getElementById("bannerStatus"+id).value;
            $.post('<?=base_url('PlaceOrder');?>', {pid: id, bs: bStatus}, function(data){
                if(data.status == "0"){
                    document.getElementById("productBanner"+id).style.backgroundColor = "rgb(244,162,97)";
                    document.getElementById("bannerStatus"+id).value = 0;
                    document.getElementById("bannerImg"+id).style.opacity = "1";
                }else{
                    document.getElementById("productBanner"+id).style.backgroundColor = "rgb(25,135,84)";
                    document.getElementById("bannerStatus"+id).value = 1;
                    document.getElementById("bannerImg"+id).style.opacity = "0.5";
                }
                if(data.total != 0){
                    document.getElementById("orderCount").innerHTML = data.total;
                }else{
                    document.getElementById("orderCount").innerHTML = '';
                }
            }, 'JSON');
        }
        function resetOrder(){
            $.post('<?=base_url('home/resetOrder');?>');
        }

        function updateAmount(id, num){
            $.post('<?=base_url('home/updateItem');?>', {oid: id, count: num}, function(data){
                if(data.status == 0){
                    document.getElementById("Item"+id).remove();
                }

                if(data.total != 0){
                    document.getElementById("orderCount").innerHTML = data.total;
                }else{
                    document.getElementById("orderCount").innerHTML = '';
                }
            }, 'JSON');
        }

        function removeItem(id){
            $.post('<?=base_url('home/removeItem');?>', {oid: id}, function(data){
                if(data.status == 0){
                    document.getElementById("Item"+id).remove();
                }

                if(data.total != 0){
                    document.getElementById("orderCount").innerHTML = data.total;
                }else{
                    document.getElementById("orderCount").innerHTML = '';
                }
            }, 'JSON');
        }
    </script>

</body>