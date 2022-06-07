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
        <?php for ($x = 0 ; $x < 8; $x++): ?>
        <div class="xcard">
            <!-- image placeholder -->
            <img src="<?= base_url('imgs/BaTKgtJF_4x.jpg');?>" alt="">
            <div class="xcard-details">
                <p class='xcard-title'>chixsilog</p>
                <p class='xcard-price mb-0'>&#8369 80</p>
            </div>
        </div>
        <?php endfor; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</body>