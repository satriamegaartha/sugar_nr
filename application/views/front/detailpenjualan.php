<div id="colorlib-page">

    <div id="colorlib-work">
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $gtotal = 0; ?>
                            <?php $status = ''; ?>
                            <?php foreach ($transaksi as $t) : ?>
                                <?php $kode_transaksi = $t["kode_transaksi"]; ?>
                                <tr>
                                    <td><img src="<?= base_url('produk/' . $t['imageproduk']); ?>" width="150px"></td>
                                    <td><?= $t["namaproduk"]; ?></td>
                                    <td><?= number_format($t["hargaproduk"], 0, ',', '.');; ?></td>
                                    <td><?= $t["jumlah"]; ?></td>
                                    <td><?= number_format($t["total"], 0, ',', '.');; ?></td>
                                    <?php $gtotal = $gtotal + $t["total"] ?>
                                    <?php $status = $t["status"] ?>
                                    <?php $noresi = $t["noresi"] ?>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="4" style="text-align:right">Total</th>
                                <th><?= number_format($gtotal, 0, ',', '.');; ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3">
                    <h4 style="margin-bottom:10px"> Total : <?= number_format($gtotal, 0, ',', '.');; ?></h4>
                    <h4 style="margin-bottom:10px"> Status : <?= $status; ?></h4>
                    <h4> Nomor Resi : <?= $noresi; ?></h4>
                    <?php if ($status == 'Belum Bayar') { ?>
                        <form action="<?php echo site_url('front/uploadbuktitransfer/' . $kode_transaksi) ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Bukti Transfer</label>
                                <div class="input-group">
                                    <input type="file" name="image">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>


</div>