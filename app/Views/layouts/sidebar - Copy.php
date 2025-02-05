<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Simutasi</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu Utama
    </div>

<!-- Data Cabang Dinas -->
    <li class="nav-item">
        <a class="nav-link" href="/cabang-dinas">
            <i class="fas fa-fw fa-building"></i>
            <span>Cabang Dinas</span></a>
    </li>

<!-- Data Users -->
<li class="nav-item">
    <a class="nav-link" href="/users">
        <i class="fas fa-fw fa-users"></i>
        <span>Users</span></a>
</li>

    <!-- Penerimaan Usulan -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/usulan'); ?>">
            <i class="fas fa-fw fa-folder"></i>
            <span>Penerimaan Usulan</span></a>
    </li>

    <!-- Pengiriman Usulan -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/pengiriman'); ?>">
            <i class="fas fa-fw fa-share-square"></i>
            <span>Pengiriman Usulan</span></a>
    </li>

    <!-- Proses di Dinas -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/proses-dinas'); ?>">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>Proses di Dinas</span></a>
    </li>

    <!-- Lacak Status -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/lacak-status'); ?>">
            <i class="fas fa-fw fa-search"></i>
            <span>Lacak Status</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
</ul>
