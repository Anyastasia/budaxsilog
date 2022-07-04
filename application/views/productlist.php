<body>
   
    <button type="button" class="btn btn-success mx-2 my-1" data-bs-toggle="modal" data-bs-target="#addModal">Add Item</button>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>body</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="mx-2 my-3">
            <a href="<?= base_url('admin')?>"><i class="bi bi-chevron-compact-left"></i>Return to home</a>
            <table class="table table-striped text-white">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productList as $product){?>
                        <?= form_open('toggle') ?>
                        <tr class="align-middle">
                            <td class="text-white"><?= $product["productID"]; ?> </td>
                            <td class="text-white"><?= ucwords($product["productName"]); ?></td>
                            <td class="text-white"><?= $product["status"]; ?></td>
                            <td <?php if($product["status"] == "active"){ ?> >
                                <button type="submit" name="productToggle" value="<?= $product["productID"]?>">Deactivate</button>
                            </td>
                            <?php } else { ?>
                            <td>
                                <button type="submit" name="productToggle" value="<?= $product["productID"]?>">Activate</button>
                            <?php } ?>
                            </td>
                        </tr>
                        <?= form_close() ?>
                    <?php }?>
                </tbody>

            </table>
        </div>
    </div>
</body>

<script>


</script>