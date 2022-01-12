<div id="colorlib-page">

    <div id="colorlib-work">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h2>Transaksi</h2>



                    <?php $check_kode = ''; ?>
                    <?php foreach ($transaksi as $t => $k) : ?>

                        <?php if ($check_kode == $k["kode_transaksi"]) { ?>
                            <tr>
                                <td><?= $k["kode_transaksi"]; ?></td>
                                <td><?= $k["namaproduk"]; ?></td>
                                <td><?= number_format($k["hargaproduk"], 0, ',', '.'); ?></td>
                                <td><?= number_format($k["jumlah"], 0, ',', '.'); ?></td>
                                <td><?= number_format($k["total"], 0, ',', '.'); ?></td>
                                <?php $gtotal = $gtotal + $k["total"]; ?>

                                <?php if ($t == (count($transaksi) - 1)) { ?>
                            <tr>
                                <td colspan="4"></td>
                                <td><?= number_format($gtotal, 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                        </tr>
                    <?php } else { ?>
                        <?php if (isset($gtotal)) { ?>
                            <tr>
                                <td colspan="4"></td>
                                <td><?= number_format($gtotal, 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                        </table>

                        <h3 style="display:inline;"><?= $k["kode_transaksi"]; ?></h3>
                        <a href="<?= base_url('front/detailpenjualan/' . $k["kode_transaksi"]); ?>" class="btn btn-info" style="float:right">Detail</a>
                        <table class="table table-striped">
                            <tr>
                                <th></th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                            <tbody>
                                <tr>
                                    <td><?= $k["kode_transaksi"]; ?></td>
                                    <td><?= $k["namaproduk"]; ?></td>
                                    <td><?= number_format($k["hargaproduk"], 0, ',', '.'); ?></td>
                                    <td><?= number_format($k["jumlah"], 0, ',', '.'); ?></td>
                                    <td><?= number_format($k["total"], 0, ',', '.'); ?></td>
                                    <?php $gtotal = $k["total"]; ?>
                                </tr>




                            <?php } ?>
                            <?php $check_kode = $k["kode_transaksi"] ?>
                        <?php endforeach; ?>
                            </tbody>
                        </table>



                </div>
            </div>
        </div>
    </div>


</div>