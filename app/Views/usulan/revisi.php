<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-undo-alt"></i> Revisi Usulan Mutasi</h1>

<!-- Form dalam Card -->
<div class="card">
    <div class="card-body">
        <form action="/usulan/updateRevisi/<?= $usulan['id'] ?>" method="post">
            <div class="row">
                <!-- Kolom Kiri (1/3) -->
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="nomorUsulan">Nomor Usulan</label>
                        <input type="text" name="nomor_usulan" id="nomorUsulan" class="form-control" value="<?= $usulan['nomor_usulan'] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guruNama">Nama Guru</label>
                        <input type="text" name="guru_nama" id="guruNama" class="form-control" value="<?= $usulan['guru_nama'] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guruNip">NIP</label>
                        <input type="text" name="guru_nip" id="guruNip" class="form-control" value="<?= $usulan['guru_nip'] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guruNik">NIK</label>
                        <input type="text" name="guru_nik" id="guruNik" class="form-control" value="<?= $usulan['guru_nik'] ?>" readonly>
                    </div>
                </div>
                
                <!-- Kolom Tengah (2/3) -->
                <div class="col-md-8">
                    <!-- Sekolah Asal & Sekolah Tujuan sejajar -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="sekolahAsal">Sekolah Asal</label>
                                <input type="text" id="sekolahAsal" class="form-control" value="<?= $usulan['sekolah_asal'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="sekolahTujuan">Sekolah Tujuan</label>
                                <input type="text" id="sekolahTujuan" class="form-control" value="<?= $usulan['sekolah_tujuan'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Alasan -->
                    <div class="form-group mb-3">
                        <label for="alasan">Alasan</label>
                        <input type="text" name="alasan" id="alasan" class="form-control" value="<?= $usulan['alasan'] ?>" readonly>
                    </div>
                </div>
            </div>
            
            <!-- Tautan Berkas -->
            <div class="row border p-3 mt-3 rounded bg-white">
                <div class="col-md-12">
                    <label for="googleDriveLink">Tautan Berkas di Google Drive</label>
                    <div class="input-group">
                        <input type="text" name="google_drive_link" id="googleDriveLink" class="form-control" value="<?= $usulan['google_drive_link'] ?>" placeholder="Masukkan Tautan Google Drive" required>
                        <button type="button" class="btn btn-sm-custom btn-info" onclick="previewLink()">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Tombol -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/usulan" class="btn btn-sm-custom btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-sm-custom btn-success"><i class="fas fa-save"></i> Simpan Revisi</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script>
function previewLink() {
    let link = document.getElementById('googleDriveLink').value.trim();
    let googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/|docs\.google\.com\/)/;
    
    if (!link) {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Tautan Google Drive belum diisi.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    if (!googleDrivePattern.test(link)) {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Masukkan tautan Google Drive yang valid!',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }
    
    window.open(link, '_blank');
}
</script>

<?= $this->endSection(); ?>
