	<div class="work-single-flex js-fullheight">
		<div class="col-half js-full-height work-img" style="background-image: url(<?= base_url('produk/' . $produk['image']); ?>);"></div>
		<div class="col-half js-fullheight">
			<div class="display-t js-fullheight">
				<div class="display-tc js-fullheight">
					<div class="work-desc">
						<h2><?= $produk['nama']; ?></h2>
						<p><?= $produk['keterangan']; ?></p>
						<p><?= number_format($produk['harga'], 0, ',', '.') ?></p>
						<form class="form-inline qbstp-header-subscribe" action="<?= base_url('front/addtocart'); ?>" method="POST">
							<input type="hidden" name="id_pelanggan" id="id_pelanggan" value="<?= $this->session->userdata('id_login'); ?>">
							<input type="hidden" name="id_produk" id="id_produk" value="<?= $produk['id']; ?>">
							<div class="col-three-forth">
								<div class="form-group">
									<input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah" value="1">
								</div>
							</div>
							<div class="col-one-third">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Add to cart</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>