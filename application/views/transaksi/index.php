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

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Laporan
                    </button>

                    <table id="mese" class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kode Transaksi</th>
                                <th scope="col">Waktu Checkout</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $kode_transaksi = ""; ?>
                            <?php foreach ($transaksi as $s => $t) : ?>
                                <?php if ($kode_transaksi != $t["kode_transaksi"]) { ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $t['kode_transaksi']; ?></td>
                                        <td><?= date_format(date_create($t['created_at']), "H:i:s d/m/Y"); ?></td>
                                        <td><?= $t['status']; ?></td>
                                        <td>
                                            <a href="<?= base_url('transaksi/detail/' . $t['kode_transaksi'] . '/' . $t['id_pelanggan']) ?>" class="badge badge-info">detail</a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php } ?>
                                <?php $kode_transaksi = $t["kode_transaksi"]; ?>
                            <?php endforeach; ?>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('transaksi/laporan/'); ?>" method="post">
                    <div class="form-group">
                        <label for="">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="stop_date" name="stop_date">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>