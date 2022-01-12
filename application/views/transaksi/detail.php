<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?= $title; ?></h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>




                    <table id="mese" class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th></th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $gtotal = 0; ?>
                            <?php foreach ($transaksi as $s => $t) : ?>
                                <?php if ($i == 1) { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Nama Pelanggan: <?= $pelanggan['nama']; ?></h4>
                                            <p style="margin-bottom: 5px;">Email: <?= $pelanggan['email']; ?></p>
                                            <p style="margin-bottom: 5px;">Alamat: <?= $pelanggan['alamat']; ?></p>
                                            <p style="margin-bottom: 5px;">Telp: <?= $pelanggan['telp']; ?></p>
                                            <?php $kode_transaksi = $t['kode_transaksi']; ?>
                                            <?php $bukti_transfer = $t['bukti_transfer']; ?>
                                            <?php $status = $t['status']; ?>
                                            <?php $noresi = $t['noresi']; ?>
                                            <?php $created_at = $t['created_at']; ?>
                                            <p style="margin-bottom: 5px;">Waktu Checkout: <?= date_format(date_create($created_at), "H:i:s d/m/Y"); ?></p>
                                            <p>Bukti Transfer</p>
                                            <img src="<?= base_url('bukti_transfer/' . $bukti_transfer); ?>" width="500px;" srcset="" class="mb-4">

                                        </div>
                                        <div class="col-md-6">

                                            <form action="<?= base_url('transaksi/update/' . $kode_transaksi); ?>" method="post">
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="Belum Bayar" <?= ($status == 'Belum Bayar') ? 'selected' : '' ?>>Belum Bayar</option>
                                                        <option value="Menunggu Konfirmasi" <?= ($status == 'Menunggu Konfirmasi') ? 'selected' : '' ?>>Menunggu Konfirmasi</option>
                                                        <option value="Barang Dikemas" <?= ($status == 'Barang Dikemas') ? 'selected' : '' ?>>Barang Dikemas</option>
                                                        <option value="Barang Dikirim" <?= ($status == 'Barang Dikirim') ? 'selected' : '' ?>>Barang Dikirim</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="noresi" name="noresi" placeholder="Nomor Resi" value="<?= $noresi; ?>">
                                                </div>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </form>
                                        </div>
                                    </div>

                                <?php } ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><img src="<?= base_url('produk/' . $t['imageproduk']); ?>" width="150px"></td>
                                    <td><?= $t['namaproduk']; ?></td>
                                    <td><?= number_format($t["hargaproduk"], 0, ',', '.'); ?></td>
                                    <td><?= $t['jumlah']; ?></td>
                                    <td><?= number_format($t["total"], 0, ',', '.'); ?></td>
                                </tr>
                                <?php $gtotal = $gtotal + $t['total']; ?>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <tr>
                                <th colspan="5" style="text-align: right">Total</th>
                                <th><?= number_format($gtotal, 0, ',', '.'); ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->