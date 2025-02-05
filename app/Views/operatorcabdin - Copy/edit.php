<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-user"></i> Edit Operator Dinas</h1>

<form action="/operatordinas/update/<?= $user['id'] ?>" method="post">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" id="nama" class="form-control" value="<?= $user['nama'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?= $user['username'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" value="<?= $user['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="no_hp" class="form-label">Nomor Handphone</label>
        <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $user['no_hp'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="password">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select">
            <option value="enable" <?= $user['status'] === 'enable' ? 'selected' : '' ?>>Enable</option>
            <option value="disable" <?= $user['status'] === 'disable' ? 'selected' : '' ?>>Disable</option>
        </select>
    </div>    
    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
    <a href="/operatorcabdin" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</form>

<?= $this->endSection() ?>
