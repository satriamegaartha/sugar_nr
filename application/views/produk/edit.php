<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?php echo base_url('produk/update') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="id" name="id" value="<?= $produk['id']; ?>">
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="<?= $produk['nama']; ?>">
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" value="<?= $produk['keterangan']; ?>">
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $produk['harga']; ?>">
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="<?= $produk['jumlah']; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option disabled>Pilih Status</option>
                        <option value="Aktif" <?= ($produk['status'] == 'Aktif') ? 'selected' : '' ?>>Aktif</option>
                        <option value="Tidak Aktif" <?= ($produk['status'] == 'Tidak Aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Gambar</label>
                    <div class="input-group">
                        <img src="<?= base_url('produk/') .  $produk['image']; ?>" width="200px class=" img-thumbnail>
                        <div class="ml-3">
                            <input type="file" name="image">
                            <input type="hidden" value="<?= $produk['image']; ?>" name="old_image">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->