<body>
    <?php if ($this->session->flashdata("invalid_password")) { ?>
            <div class="alert alert-danger" role="alert"><?= $this->session->flashdata("invalid_password") ?></div>
    <?php }  ?>

    <?php if ($this->session->flashdata("logged_out")){ ?>
            <div class="alert alert-success" role="alert"><?= $this->session->flashdata("logged_out") ?></div>
    <?php } ?>
    
    <div class="container v-100 flex flex-center">
        <div class="w-40">
            <?= form_open("admin/login"); ?>
                <p>Enter password</p>
                <?= form_password(array("id" => "password", "name" => "password")); ?>
                <div class="my-2">
                    <button type="submit" class="secondary w-100">Log in</button>
                </div>
            </form>
        </div>
    </div>
</body>