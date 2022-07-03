<?php
$order = $this->session->userdata('order');
$orderTotal = $this->session->userdata('orderTotal');
?>

<style>
    html ,body {
        height: 100%;
    }

    .quantity {
        outline: none;
        cursor: pointer;
        border: 0;
        font-size: .875rem;
        font-weight: 300;
        line-height: 1;
        letter-spacing: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color .1s cubic-bezier(.4,0,.6,1);
        border: 1px solid rgb(200,200,200);
        border-radius: 2px;
        background: transparent;
        color: rgb(200,200,200);
        width: 32px;
        height: 32px;
    }

    #map {
        height: 200px;
        width: 400px;
    }

    input[type=text], select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    textarea {
        width: 100%;
        height: 150px;
        padding: 12px 20px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: #f8f8f8;
        resize: none;
    }
    .btnSubmit {
        background-color: #f44336;
        border: none;
        color: white;
        padding: 15px 40px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 0;
    }
</style>

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
        <div class="container">
            <div class="row">
                <div class="col" style="width: 50%;">
                    <div style="  border-radius: 5px;background-color: #f2f2f2;padding: 20px; color: black;">
                        <label for="fname">Name</label>
                        <input type="text" id="name" name="firstname" placeholder="Your name..">

                        <label for="lname">Contact Number</label>
                        <input type="text" id="cnum" name="lastname" placeholder="(+639)">

                        <label for="lname">Address</label>
                        <input type="text" id="loc" name="lastname" placeholder="Where to drop off...">
                        <textarea placeholder="Addition Description..."></textarea>
                        <label for="modePayment">Mode of Payment</label>
                        <select id="modePayment" onchange="checkUser()" name="modePayment">
                            <option value="gcash">Gcash</option>
                            <option value="cod">Cash on Delivery</option>
                        </select>
                    </div>
                </div>
                <div class="col" style="min-width:636px; max-height: 550px; overflow-y:scroll;">
                    <?php
                        for($x=0;$x<count($order);$x++){
                            if($order[$x] > 0){
                                $temp = $x+1;
                    ?>
                            <div class="container" id="Item<?=$x?>">
                                <div class="row">
                                    <div class="col">
                                        <img style="width:100px; height:100px;" src="<?=$productList[$x]['image_path'];?>">
                                    </div>
                                    <div class="col" style="padding-top: 50px;">
                                        <h5><?=ucfirst($productList[$x]['productName']);?> </h5>
                                    </div>
                                    <div class="col" style="padding-top: 50px;">
                                        <div style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
                                            <div style="display: flex;align-items: center;">
                                                <button class="quantity" onclick="vol(0,<?=$x;?>)">-</button>
                                                <input class="quantity" style="width: 50px;height: 32px;border-left: 0;border-right: 0;font-size: 16px;font-weight: 400;box-sizing: border-box;text-align: center;" id="num<?=$x;?>" type="number" id="order<?=$x;?>" value="<?=$order[$x];?>" onchange="updateAmount(<?=$x;?>,this.value)">
                                                <button class="quantity" onclick="vol(1,<?=$x;?>)">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col" style="padding-top: 50px;">
                                        <button onclick="removeItem(<?=$x;?>)">remove</button>
                                    </div>
                                </div>
                            </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <div style="position: fixed; left: 0%; bottom: 0%; right: 0%;">
                <div style="float: right;"><button class="btnSubmit" type="button" onclick="submit()">Order</button></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function submit(){

        }

        function checkUser(){
            document.getElementById("modePayment").value = "gcash";
            alert("Cannot apply mode of payment.\n\nTo verify the authenticity of our customer, only address with delivery history can apply this feature. ");
        }

        function vol(type,id){
            num = parseInt(document.getElementById("num"+id).value);
            if(type == 1) {
                num += 1
            } else {
                if(num > 0){
                    num-=1;
                }
            }
            document.getElementById("num"+id).value = num;
            updateAmount(id, num);
        }
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