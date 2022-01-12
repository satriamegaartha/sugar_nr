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

                    <a class="btn btn-primary mb-3 btn-sm" href="<?= base_url('produk/tambah') ?>">Tambah Produk</a>

                    <table id="mese" class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($produk as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['keterangan']; ?></td>
                                    <td><?= $p['harga']; ?></td>
                                    <td><?= $p['jumlah']; ?></td>
                                    <td class="<?= ($p['status'] == 'Tidak Aktif') ? 'text-danger' : '' ?>"><?= $p['status']; ?></td>
                                    <td>
                                        <a href="<?= base_url('produk/edit/' . $p['id']) ?>" class="badge badge-warning">edit</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
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