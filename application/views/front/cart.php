<div id="colorlib-contact">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Cart</h2>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="row">

                    <div class="col-md-6 col-md-push-1 animate-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container mt-5 mb-5">
                                    <div class="row justify-content-center">
                                        <div class="col-xl-7 col-lg-8 col-md-7">

                                            <div class="border border-gainsboro p-3">
                                                <?= $this->session->flashdata('message'); ?>
                                                <h2 class="h6 text-uppercase mb-0">Total Pesanan: <strong class="cart-total"><?= number_format($gtotal, 0, ',', '.'); ?></strong></h2>
                                            </div>
                                            <!-- item -->
                                            <table class="table">
                                                <tr>
                                                    <th></th>
                                                    <th>Produk</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tbody>
                                                    <?php foreach ($cart as $c) : ?>
                                                        <tr>
                                                            <td><img src="<?= base_url('produk/' . $c['imageproduk']); ?>" width="200px" srcset=""></td>
                                                            <td><?= $c["namaproduk"]; ?></td>
                                                            <td><?= number_format($c["hargaproduk"], 0, ',', '.'); ?></td>
                                                            <td><?= number_format($c["jumlah"], 0, ',', '.'); ?></td>
                                                            <td><?= number_format($c["total"], 0, ',', '.'); ?></td>
                                                            <td>
                                                                <a href="<?= base_url('front/editcart/' . $c['id']); ?>" class="badge badge-success">Edit</a>
                                                                <a href="<?= base_url('front/deletecart/' . $c['id']); ?>" class="badge badge-primary">Delete</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="col-xl-3 col-lg-4 col-md-5 totals">
                                            <div class="border border-gainsboro px-3">
                                                <div class="totals-item totals-item-total d-flex align-items-center justify-content-between mt-3 pt-3 border-top border-gainsboro">
                                                    <p class="text-uppercase"><strong>Total</strong></p>
                                                    <p class="totals-value font-weight-bold cart-total"><?= number_format($gtotal, 0, ',', '.'); ?></p>
                                                </div>
                                            </div>
                                            <a href="<?= base_url('front/checkout/'); ?>" class="mt-3 btn btn-pay w-100 d-flex justify-content-between btn-lg rounded-0">Checkout</a>
                                        </div>
                                    </div>
                                </div><!-- container -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>