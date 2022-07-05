<?php
$order = $this->session->userdata('order');
$orderTotal = $this->session->userdata('orderTotal');
$code = $this->session->userdata('codeC');
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
    .btnS {
        background-color: #f44336;
        border: none;
        color: white;
        padding: 10px 30px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 0;
    }

    .btnS:hover {
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
        <div class="container" style="position: relative; margin-top: 5%; margin-left: 25%; width: 50%; min-height: 500px; padding-bottom: 50px; border-radius: 5px;background-color: #f2f2f2;padding: 20px; color: black; align-items: center;justify-content: center;display: flex;flex-direction: column;">
            <div id="showCode" style="align-items: center;justify-content: center;display: flex;flex-direction: column;">
                <div class="row">
                    <h3 id="description" style="color: black;">Check Status:</h3>
                </div>
                <div class="row">
                    <img id="imgL" src="<?=base_url()?>/imgs/qr.jpg" style="width: 300px; height:300px; display: none;">
                </div>
                <div class="row" style="text-align: center; position: relative;">
                    <div class="col-9">
                        <textarea id="code" placeholder="Confirmation Code..." style="text-align: center; max-height: 70px; max-width:400px;"><?php if(isset($code)){echo $code;}?></textarea>
                    </div>
                    <div class="col-3">
                    <button type="button" onclick="statusCheck()" class="btnS" id="search">check status</button>
                    </div>
                    <button type="button" onclick="cancelOrder()" class="btnS" id="cancel" style="display: none;">Cancel Order</button>
                </div>
                <a href="" style="color:blue; position: absolute; bottom: 20px; display: none;" id="OtherCode">View Other Status</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
        function cancelOrder(){
            $.post('<?=base_url('cancelOrder');?>', {codeC: code.value}, function(data){
                if(data){
                    location.href = "<?=base_url('status');?>";
                }
            }, 'JSON');
        }

        function statusCheck(){
            code = document.getElementById("code");
            if(code.value != "") {
                $.post('<?=base_url('statusCheck');?>', {codeC: code.value}, function(data){
                    
                    if(data.orderStatus != undefined){
                        switch(parseInt(data.orderStatus)){
                            case 0:
                                document.getElementById("description").innerHTML = "Order Cancelled";
                                break;
                            case 1:
                                document.getElementById("description").innerHTML = "Accepted";
                                break;
                            case 2:
                                document.getElementById("description").innerHTML = "Ready"
                                break;
                            case 3:
                                document.getElementById("description").innerHTML = "Out for Delivery"
                                break;
                            case 4:
                                document.getElementById("description").innerHTML = "Delivered!"
                                break;
                        }
                        document.getElementById("OtherCode").style.display = "";
                        
                    }else{
                        if(data.modeOfPayment == "0"){
                            document.getElementById("description").innerHTML = "Pending Order or Waiting for Payment";
                            document.getElementById("imgL").style.display = "";

                        } else {
                            document.getElementById("description").innerHTML = "Pending Order";
                        }

                        document.getElementById("OtherCode").style.display = "";
                        document.getElementById("cancel").style.display = "";
                    }
                    document.getElementById("code").style.display = "none";
                    document.getElementById("search").style.display = "none";
                }, 'JSON');
            } else {
                alert("fill up the Contact Number and Address information\nbefore choosing mode of payment.");
                backToDefault();
            }
        }

        function checkUser(){
            loc = document.getElementById("loc");
            num = document.getElementById("cnum");
            type = document.getElementById("modePayment").value;

            if(num.value != "" && loc.value != "") {
                $.post('<?=base_url('checker');?>', {location: loc.value, number: num.value}, function(data){
                    if(data || type == "0"){
                        alert("Payment method accepted");
                    }else{
                        console.log(num)
                        alert("Cannot apply mode of payment.\n\nTo verify the authenticity of our customer, only address with delivery history can apply this feature. ");
                        backToDefault();
                    }
                }, 'JSON');
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