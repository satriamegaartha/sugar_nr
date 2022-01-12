<nav id="colorlib-main-nav" role="navigation">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle active"><i></i></a>
    <div class="js-fullheight colorlib-table">
        <div class="colorlib-table-cell js-fullheight">

            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li><a href="<?= base_url('front/index') ?>">Home</a></li>
                        <li><a href="<?= base_url('front/produk') ?>">Produk</a></li>
                        <?php if ($this->session->userdata('nama')) { ?>
                            <li><a href="<?= base_url('front/cart') ?>">Cart</a></li>
                            <li><a href="<?= base_url('front/viewcheckout') ?>">Transaksi</a></li>
                            <li><a href="<?= base_url('front/logout') ?>">Logout</a></li>
                        <?php } else { ?>
                            <li><a href="<?= base_url('front/login') ?>">Login</a></li>
                            <li><a href="<?= base_url('auth') ?>">Admin Page</a></li>
                        <?php } ?>


                    </ul>
                </div>
            </div>

        </div>
    </div>
</nav>