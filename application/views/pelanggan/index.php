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

                    <a class="btn btn-primary mb-3 btn-sm" href="<?= base_url('pelanggan/tambah') ?>">Tambah Pelanggan</a>

                    <table id="mese" class="table table-bordered dataTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Telp</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pelanggan as $p) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $p['nama']; ?></td>
                                    <td><?= $p['email']; ?></td>
                                    <td><?= $p['alamat']; ?></td>
                                    <td><?= $p['telp']; ?></td>
                                    <td>
                                        <a href="<?= base_url('pelanggan/edit/' . $p['id']) ?>" class="badge badge-warning">edit</a>
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