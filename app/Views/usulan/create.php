<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h1 class="mb-4"><i class="fas fa-fw fa-folder"></i> Tambah Usulan Mutasi</h1>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

    <form action="/usulan/store" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label>Nama Guru</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="guru_nama" class="form-control" placeholder="Masukkan Nama Guru" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>NIP</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                        <input type="text" name="guru_nip" class="form-control" placeholder="Masukkan NIP (tanpa spasi)" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Alasan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-comment"></i></span>
                        <textarea name="alasan" class="form-control" placeholder="Masukkan Alasan Mutasi" rows="5" required></textarea>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label>NIK</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                        <input type="text" name="guru_nik" id="guru_nik" class="form-control" placeholder="Masukkan NIK (16 angka)" required 
                         maxlength="16" pattern="\d{16}" title="Masukkan tepat 16 digit angka">
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Sekolah Asal</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-school"></i></span>
                        <input type="text" name="sekolah_asal" class="form-control" placeholder="Masukkan Sekolah Asal" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Sekolah Tujuan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                        <input type="text" name="sekolah_tujuan" class="form-control" placeholder="Masukkan Sekolah Tujuan" required>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Tautan Berkas di Google Drive</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                        <input type="text" name="google_drive_link" class="form-control" placeholder="Masukkan Tautan Google Drive">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label>Nama Cabang</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-building"></i></span>
                        <!-- Nama cabang hanya bisa dibaca -->
                        <input type="text" class="form-control" value="<?= $cabangDinas['nama_cabang']; ?>" readonly>
                        <!-- Hidden input untuk mengirim cabang_dinas_id -->
                        <input type="hidden" name="cabang_dinas_id" value="<?= $cabangDinas['id']; ?>">
                    </div>
                </div>


            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <a href="/usulan" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
        </div>
    </form>
</div>

<script>
    document.getElementById("guru_nik").addEventListener("input", function () {
        this.value = this.value.replace(/\D/g, '').substring(0, 16); // Hanya angka & max 16 digit
    });
</script>
<?= $this->endSection(); ?>
