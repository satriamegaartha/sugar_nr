<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-paint-brush"></i>
        </div>
        <div class="sidebar-brand-text mx-3">sugar_nr</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- QUERY MENU -->


    <!-- LOOPING MENU -->
    <div class="sidebar-heading">
        Produk </div>

    <!-- SIAPKAN SUB-MENU SESUAI MENU -->

    <li class="nav-item <?= ($menu == 'Produk') ? 'active' : '' ?>">
        <a class="nav-link pb-0" href="<?= base_url('produk/index'); ?>">
            <i class="fab fa-affiliatetheme"></i>
            <span>Produk</span></a>
    </li>
    <li class="nav-item <?= ($menu == 'Pelanggan') ? 'active' : '' ?>">
        <a class="nav-link pb-0" href="<?= base_url('pelanggan/index'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Pelanggan</span></a>
    </li>
    <li class="nav-item <?= ($menu == 'Transaksi') ? 'active' : '' ?>">
        <a class="nav-link pb-0" href="<?= base_url('transaksi/index'); ?>">
            <i class="fas fa-edit"></i>
            <span>Transaksi</span></a>
    </li>

    <hr class="sidebar-divider mt-3">


    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>