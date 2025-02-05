<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-users"></i> Manajemen Admin</h1>
<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        </button>
    </div>
<?php endif; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="/admin/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah Admin</a>

    <form method="get" class="d-flex align-items-center">
        <label for="per_page" class="mb-0 me-2">Tampilkan:</label>
        <select id="per_page" name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </form>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Username</th>            
            <th>Email</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($users as $user): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $user['nama'] ?></td>       
                <td><?= $user['username'] ?></td>         
                <td><?= $user['email'] ?></td>
                <td><?= $user['no_hp'] ?></td>                
                <td>
                    <a href="/admin/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                    
                     <a href="#" 
                       class="btn btn-danger btn-sm" 
                       onclick="confirmDelete(<?= $user['id'] ?>)">
                       <i class="fas fa-trash-alt"></i>
                    </a>
                    <?php if ($user['status'] === 'enable'): ?>
                        <button class="btn btn-sm btn-success" onclick="confirmDisable(<?= $user['id'] ?>)"><i class="fas fa-check-square"></i></button>
                    <?php else: ?>
                        <button class="btn btn-sm btn-secondary" onclick="confirmEnable(<?= $user['id'] ?>)"><i class="fas fa-square"></i></button>
                    <?php endif; ?>                    
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-0">Menampilkan <?= count($users) ?> dari <?= $pager->getTotal('users') ?> data</p>
    <?= $pager->links('users', 'custom_pagination') ?>
</div>
<script>
    function confirmDisable(userId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda akan me-nonaktifkan akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Nonaktifkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/disable/${userId}`;
            }
        });
    }

    function confirmEnable(userId) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda akan mengaktifkan akun ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Aktifkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/enable/${userId}`;
            }
        });
    }
</script>
<script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/delete/${userId}`;
            }
        });
    }
</script>
<?= $this->endSection() ?>
