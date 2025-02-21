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
                    <label class="text-primary"><i class="fas fa-file-upload"></i> Tautan Berkas di Google Drive</label>
                    <?php 
                    $berkas_labels = [
                        "Surat Pengantar dari Cabang Dinas Asal",
                        "Surat Pengantar dari Kepala Sekolah",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Kepala Dinas)",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Kepala BKA)",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Gubernur cq Sekda Aceh)",
                        "Rekomendasi Kepala Sekolah Melepas Lengkap dengan Analisis",
                        "Rekomendasi Melepas dari Pengawas Sekolah",
                        "Rekomendasi Melepas dari Kepala Cabang Dinas Kab/Kota",
                        "Rekomendasi Kepala Sekolah Menerima Lengkap dengan Analisis",
                        "Rekomendasi Menerima dari Pengawas Sekolah",
                        "Rekomendasi Menerima dari Kepala Cabang Dinas Kab/Kota",
                        "Analisis Jabatan (Anjab) ditandatangani oleh Kepala Sekolah Melepas",
                        "Surat Formasi GTK dari Sekolah Asal",
                        "Foto Copy SK 80% dan SK Terakhir di Legalisir",
                        "Foto Copy Karpeg dilegalisir",
                        "Surat Keterangan tidak Pernah di Jatuhi Hukuman Disiplin",
                        "Surat Keterangan Bebas Temuan Inspektorat",
                        "Surat Keterangan Bebas Tugas Belajar/Izin Belajar",
                        "Daftar Riwayat Hidup/ Riwayat Pekerjaan",
                        "Surat Tugas Suami dan Foto Copy Buku Nikah"
                    ];
                    ?>

                    <?php for ($i = 0; $i < 20; $i++): ?>
                        <div class="form-group mb-2">
                            <label for="googleDriveLink<?= $i ?>">Berkas <?= str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?> - <?= $berkas_labels[$i] ?></label>
                            <div class="input-group">
                                <input type="text" name="google_drive_link[]" id="googleDriveLink<?= $i ?>" class="form-control" 
                                    placeholder="Masukkan Tautan Google Drive"
                                    value="<?= isset($usulan_drive_links[$i]) ? $usulan_drive_links[$i] : '' ?>">
                                <button type="button" class="btn btn-sm-custom btn-info" onclick="previewLink(<?= $i ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small id="errorMsg<?= $i ?>" class="form-text"></small> <!-- Pesan validasi -->
                        </div>
                    <?php endfor; ?>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/usulan" class="btn btn-sm-custom btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                <button type="submit" class="btn btn-sm-custom btn-success" id="submitBtn"><i class="fas fa-save"></i> Simpan Revisi</button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT -->
<script>

document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.getElementById("submitBtn");
    const googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/(file\/d\/|open\?id=|drive\/folders\/)).+/;

    function validateLinks() {
        let allValid = true;

        document.querySelectorAll("input[name='google_drive_link[]']").forEach((input, index) => {
            let linkValue = input.value.trim();
            let feedbackElement = document.getElementById(`errorMsg${index}`);

            if (!linkValue) {
                feedbackElement.textContent = "❌ Data masih kosong";
                feedbackElement.style.color = "red";
                allValid = false;
            } else if (!googleDrivePattern.test(linkValue)) {
                feedbackElement.textContent = "❌ Tautan tidak valid!";
                feedbackElement.style.color = "red";
                allValid = false;
            } else {
                feedbackElement.textContent = "✔ Tautan valid";
                feedbackElement.style.color = "green";
            }
        });

        submitBtn.disabled = !allValid;
    }

    document.querySelectorAll("input[name='google_drive_link[]']").forEach((input) => {
        input.addEventListener("input", validateLinks);
    });
});

function previewLink(index) {
    let inputId = `googleDriveLink${index}`;
    let link = document.getElementById(inputId).value.trim();
    let googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/|docs\.google\.com\/)/;

    const berkasLabels = <?= json_encode($berkas_labels) ?>;
    let berkasNama = berkasLabels[index] || `Berkas ${index + 1}`;

    if (!link) {
        Swal.fire({
            title: 'Peringatan!',
            text: `Tautan belum diisi untuk ${berkasNama}.`,
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    if (!googleDrivePattern.test(link)) {
        Swal.fire({
            title: 'Peringatan!',
            text: `Masukkan tautan Google Drive yang valid untuk ${berkasNama}!`,
            icon: 'warning',
            confirmButtonText: 'OK'
        });
        return;
    }

    window.open(link, '_blank');
}
</script>

<?= $this->endSection(); ?>
