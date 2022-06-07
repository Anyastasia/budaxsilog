<?php
$order = $this->session->userdata('order');
?>
<body>    
    <nav id="header" class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="" class="navbar-brand">BudaXSilog</a>
            <button class="navbar-toggler secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapseNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item header-item"><a href="#">Order</a></li>
                    <li class="nav-item header-item"><a href="#">Status</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="menu">
        <?php $xx = 0; foreach($productList as $x){ ?>
            <?php if($order[$xx] == 1){?>
                <div class="xcard"  id="productBanner<?=$xx;?>" style="background-color:rgb(25,135,84);" onclick="order(<?=$xx;?>)">
            <?php } else {?>
                <div class="xcard"  id="productBanner<?=$xx;?>" style="background-color:rgb(244,162,97);" onclick="order(<?=$xx;?>)">
            <?php }?>
                <input type="number" id="bannerStatus<?=$xx;?>" value=<?=$order[$xx]?> hidden>
                <!-- image placeholder -->
                <?php if($order[$xx] == 1){?>
                    <img class="orderClick" style="transition: opacity .5s; opacity: 0.5;" id="bannerImg<?=$xx;?>" src="<?= base_url('imgs/BaTKgtJF_4x.jpg');?>" alt="">
                <?php } else {?>
                    <img class="orderClick" style="transition: opacity .5s; opacity: 1;" id="bannerImg<?=$xx;?>" src="<?= base_url('imgs/BaTKgtJF_4x.jpg');?>" alt="">
                <?php }?>
                <div class="xcard-details">
                    <p class='xcard-title'>chixsilog</p>
                    <p class='xcard-price mb-0'>&#8369 80</p>
                </div>
            </div>
        <?php $xx++; }?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function order(id){
            bStatus = document.getElementById("bannerStatus"+id).value;
            $.post('<?=base_url('PlaceOrder');?>', {pid: id, bs: bStatus}, function(data){
                if(data == "0"){
                    document.getElementById("productBanner"+id).style.backgroundColor = "rgb(244,162,97)";
                    document.getElementById("bannerStatus"+id).value = 0;
                    document.getElementById("bannerImg"+id).style.opacity = "1";
                }else{
                    document.getElementById("productBanner"+id).style.backgroundColor = "rgb(25,135,84)";
                    document.getElementById("bannerStatus"+id).value = 1;
                    document.getElementById("bannerImg"+id).style.opacity = "0.5";
                }
            }, 'JSON');
        }
    </script>

</body>