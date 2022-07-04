<body>
    <!--  -->
    <div class="d-flex justify-content-end">
        <?= form_open("admin/logout");?>
            <button type="submit" class="btn btn-secondary mx-3 my-3">Log out</button>
        <?= form_close();?>
    </div>
    <div class="container v-100 flex flex-center">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url('productlist') ?>">
                <div class="card" style="width: 20rem">
                    <div class="card-body text-center">
                        <i class="bi bi-bag text-dark text-cemter" style="font-size: 5rem;"></i>
                        <p class="text-dark text-center">Product List</p>
                    </div>
                 </div>
                 </a>
            </div>

            <div class="col-md-6">
                <a href="<?= base_url('orderlist') ?>">
                <div class="card" style="width: 20rem">
                    <div class="card-body text-center">
                        <i class="bi bi-cart text-dark" style="font-size: 5rem;"></i>
                        <p class="text-dark">Order List</p>
                    </div>
                 </div>
                 </a>
            </div>
    </div>
</body>