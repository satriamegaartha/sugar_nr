<div id="colorlib-blog">
    <div class="container">
        <div class="row text-center">
            <h2 class="bold">Dream Catcher</h2>
        </div>
        <div class="row row-pb-md">
            <?php foreach ($produk as $p) : ?>
                <div class="col-md-4">
                    <div class="article animate-box">
                        <a href="<?= base_url('front/produkdetail/' . $p['id']); ?>" class="blog-img">
                            <img class="img-responsive" src="<?= base_url('produk/' . $p['image']); ?>" alt="html5 bootstrap by colorlib.com">
                            <div class="overlay"></div>
                            <div class="link">
                                <span class="read">Detail</h2>
                            </div>
                        </a>
                        <div class="desc">
                            <span class="meta"><?= number_format($p['harga'], 0, ',', '.'); ?></span>
                            <h2><a href="<?= base_url('front/produkdetail/' . $p['id']); ?>"><?= $p['nama']; ?></a></h2>
                            <p><?= substr($p['keterangan'], 0, 50); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>