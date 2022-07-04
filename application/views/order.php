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

    .btnSubmit:hover {
        background-color: #e9756c;
    }

    #checkContainer {
        position: fixed;
        top: 0;
        Left: 0;
        height: 100%;
        width: 100%;
        z-index: 1;
    }
    #orderCheck {
        position: relative;
        margin-top: 10%;
        margin-left: 25%;
        width: 50%;
        height: 50%;
        min-height: 370px;
        border-radius: 5px;background-color: #f2f2f2;padding: 20px; color: black;
    }
    #bgCheck {
        position: absolute;
        z-index: -1;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(50,50,50,.8);
    }

    .cancelBtn {
        position: absolute; bottom: 10%; left: 5%; border: solid 1px; border-color: rgb(150,150,150);
    }
    .cancelBtn:hover {
        background-color: rgb(150,150,150);
        color: white;
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
                    <li class="nav-item header-item"><a href="status">Status</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="menu">
        <div class="container">
            <form action='<?=base_url('checkoutOrder');?>' method="POST">
                <div id="checkContainer" style="display: none;">
                    <div id="orderCheck" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                        <div id="hideCode" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                            <h3 style="color: black;">Confirm order?</h3>
                        </div>
                        <button class="cancelBtn" type="button" onclick="document.getElementById('checkContainer').style.display = 'none';">Cancel</button>
                        <button class="btnSubmit" type="submit" onclick="document.getElementById('checkContainer').style.display = 'none';" style="position: absolute; bottom: 10%; right: 5%;">Order</button>
                    </div>
                    <div id="bgCheck" style="cursor: pointer;" onclick="document.getElementById('checkContainer').style.display = 'none';"></div>
                </div>
                <div class="row">
                    <div class="col" style="width: 50%;">
                        <div style="border-radius: 5px;background-color: #f2f2f2;padding: 20px; color: black;">
                            <label for="fname">Name</label>
                            <input type="text" id="name" name="name" placeholder="Your name.." required>

                            <label for="lname">Contact Number</label>
                            <input type="text" onblur="backToDefault()" id="cnum" name="cnum" minlength="11" maxlength="11" placeholder="09xxxxxxxxx" required>

                            <label for="lname">Address</label>
                            <input type="text" onblur="backToDefault()" id="loc" name="loc" placeholder="Where to drop off..." required>
                            <textarea placeholder="Addition Description..."></textarea>
                            <label for="modePayment">Mode of Payment</label>
                            <select id="modePayment" onchange="checkUser()" name="modePayment" required>
                                <option value="">----</option>
                                <option value="0">Gcash</option>
                                <option value="1">Cash on Delivery</option>
                            </select>
                        </div>
                    </div>
                    <div class="col" style="position: relative; min-width:436px; max-height: 550px;">
                        <div class="container" style="overflow-y:scroll; height: 100%; max-height: 490px;">
                            <?php
                                $color = 0;
                                for($x=0;$x<count($order);$x++){
                                    if($order[$x] > 0){
                                        $temp = $x+1;
                                        $color++;
                            ?>
                                    <div class="row"  id="Item<?=$x?>" style="padding: 10px 0px; background-color:<?php if($color%2==1){echo'rgba(150,150,150,.8)';}else{echo'rgba(100,100,100,.8)';}?>;">
                                        <div class="col">
                                            <img style="width:100px; height:100px;" src="<?=$productList[$x]['image_path'];?>">
                                        </div>
                                        <div class="col" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                                            <h5><?=ucfirst($productList[$x]['productName']);?> </h5>
                                        </div>
                                        <div class="col" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                                            <div style="display: flex;align-items: center;justify-content: center;flex-direction: column;">
                                                <div style="display: flex;align-items: center;">
                                                    <button type="button" class="quantity" onclick="vol(0,<?=$x;?>)">-</button>
                                                    <input class="quantity" style="width: 50px;height: 32px;border-left: 0;border-right: 0;font-size: 16px;font-weight: 400;box-sizing: border-box;text-align: center;" id="num<?=$x;?>" type="number" id="order<?=$x;?>" value="<?=$order[$x];?>" onchange="updateAmount(<?=$x;?>,this.value)">
                                                    <button type="button" class="quantity" onclick="vol(1,<?=$x;?>)">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                                            <button type="button" onclick="removeItem(<?=$x;?>)">remove</button>
                                        </div>
                                    </div>
                            <?php
                                    }
                                }
                            ?>
                            </div>
                        <div class="row" style="padding-right: 15px;"><button class="btnSubmit" type="button" onclick="document.getElementById('checkContainer').style.display = '';">Checkout</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function backToDefault(){
            document.getElementById("modePayment").value = "";
        }

        function checkUser(){
            loc = document.getElementById("loc");
            num = document.getElementById("cnum");
            type = document.getElementById("modePayment").value;

            if(num.value != "" && loc.value != "" ) {
                if (type == "1") {
                    $.post('<?=base_url('checker');?>', {location: loc.value, number: num.value}, function(data){
                        if(data){
                            alert("Payment method accepted");
                        }else{
                            console.log(num)
                            alert("Cannot apply mode of payment.\n\nTo verify the authenticity of our customer, only address with delivery history can apply this feature. ");
                            backToDefault();
                        }
                    }, 'JSON');
                }
            } else {
                alert("fill up the Contact Number and Address information\nbefore choosing mode of payment.");
                backToDefault();
            }
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