<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h1 class="mb-4"><i class="fas fa-undo-alt"></i> Revisi Usulan Mutasi</h1>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('message'); ?>
            </button>
        </div>
    <?php endif; ?>
    <!-- Notifikasi untuk pesan flash -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>
    <p class="text-muted">Form ini digunakan untuk memperbaiki data usulan mutasi yang sebelumnya ditolak karena tidak lengkap. Mohon lengkapi data berikut dengan benar.</p>
    <form action="/usulan/updateRevisi/<?= $usulan['id'] ?>" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label>Nomor Usulan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                        <input type="text" name="nomor_usulan" class="form-control" value="<?= $usulan['nomor_usulan'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Nama Guru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="guru_nama" class="form-control" value="<?= $usulan['guru_nama'] ?>"  placeholder="Masukkan Nama Guru" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>NIP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="guru_nip" class="form-control" value="<?= $usulan['guru_nip'] ?>"  placeholder="Masukkan NIP" required>>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Alasan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
                        <textarea name="alasan" class="form-control" placeholder="Masukkan Alasan Mutasi" rows="5" required><?= $usulan['alasan'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label>NIK</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                        <input type="number" name="guru_nik" class="form-control" value="<?= $usulan['guru_nik'] ?>" placeholder="Masukkan NIK" required maxlength="16">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Sekolah Asal</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-school"></i></span>
                        <input type="text" name="sekolah_asal" class="form-control" value="<?= $usulan['sekolah_asal'] ?>" placeholder="Masukkan Sekolah Asal" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Sekolah Tujuan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <input type="text" name="sekolah_tujuan" class="form-control" value="<?= $usulan['sekolah_tujuan'] ?>" placeholder="Masukkan Sekolah Tujuan" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Tautan Berkas di Google Drive</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                        <input type="text" name="google_drive_link" id="google_drive_link" class="form-control" value="<?= $usulan['google_drive_link'] ?>" placeholder="Masukkan Tautan Google Drive">
                    </div>
                    <!-- Tombol Preview -->
                    <button type="button" class="btn btn-info mt-2" onclick="previewLink()"> <i class="fas fa-eye"></i> Preview</button>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="/usulan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Revisi</button>
        </div>
    </form>
</div>

<script>
    function previewLink() {
        const link = document.getElementById('google_drive_link').value;
        if (link) {
            window.open(link, '_blank');
        } else {
            alert('Tautan Google Drive belum diisi.');
        }
    }
</script>
<?= $this->endSection(); ?>
