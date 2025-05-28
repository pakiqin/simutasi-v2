<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    .nav-custom {
        background-color: #e9ecef;
    }
    .nav-tabs .nav-link.active {
        background-color: white !important;
        color: #6c757d !important;
        font-weight: bold;
    }
    .nav-tabs .nav-link {
        color: #6c757d;
        transition: 0.3s;
    }
    .nav-tabs .nav-link:hover {
        color: #495057;
    }
</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-upload"></i> Edit Berkas Usulan</h1>

<!-- Ringkasan Data Guru & Sekolah -->
<div class="card shadow-sm p-4 mb-4">
    <div class="row">
        <!-- Kolom Kiri: Data Guru -->
        <div class="col-md-6">
            <h5 class="text-primary"><i class="fas fa-user"></i> Data Guru</h5>
            <p><strong>Nama Guru:</strong> <?= $usulan['guru_nama']; ?></p>
            <p><strong>NIP:</strong> <?= $usulan['guru_nip']; ?></p>
            <p><strong>NIK:</strong> <?= $usulan['guru_nik']; ?></p>
        </div>

        <!-- Kolom Kanan: Data Sekolah -->
        <div class="col-md-6">
            <h5 class="text-primary"><i class="fas fa-school"></i> Data Sekolah</h5>
            <p><strong>Sekolah Asal:</strong> <?= $usulan['sekolah_asal']; ?></p>
            <p><strong>Sekolah Tujuan:</strong> <?= $usulan['sekolah_tujuan']; ?></p>
            <p><strong>Alasan Mutasi:</strong> <?= $usulan['alasan']; ?></p>
        </div>
    </div>
</div>

<div class="card mt-3">
    <ul class="nav nav-tabs nav-custom">
        <li class="nav-item">
            <a class="nav-link" href="/usulan/edit-usulan/<?= $usulan['id'] ?>">1️⃣ Data Guru & Sekolah</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">2️⃣ Edit Berkas</a>
        </li>
    </ul>

    <div class="card-body">
        <form action="/usulan/update-berkas/<?= $nomor_usulan ?>" method="post">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    $optionalIndexes = [6, 9, 16, 19]; // Indeks berkas opsional
                    $berkasLabels = [
                        "Surat Pengantar dari Cabang Dinas Asal",
                        "Surat Pengantar dari Kepala Sekolah",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Kepala Dinas)",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Kepala BKA)",
                        "Surat Permohonan Pindah Tugas Bermaterai (Ditujukan Untuk Gubernur cq Sekda Aceh)",
                        "Rekomendasi Kepala Sekolah Melepas Lengkap dengan Analisis (Jumlah jam, Siswa, Rombel, Guru Mapel Kurang atau Lebih)",
                        "Rekomendasi Melepas dari Pengawas Sekolah (Optional)",
                        "Rekomendasi Melepas dari Kepala Cabang Dinas Kab/Kota",
                        "Rekomendasi Kepala Sekolah Menerima Lengkap dengan Analisis (Jumlah jam, Siswa, Rombel, Guru Mapel Kurang atau Lebih)",
                        "Rekomendasi Menerima dari Pengawas Sekolah (Optional)",
                        "Rekomendasi Menerima dari Kepala Cabang Dinas Kab/Kota",
                        "Analisis Jabatan (Anjab) ditandatangani oleh Kepala Sekolah Melepas dan Mengetahui Kepala Dinas",
                        "Surat Formasi GTK dari Sekolah Asal (Data Guru dan Tendik yang ditandatangani oleh Kepala Sekolah)",
                        "Foto Copy SK 80% dan SK Terakhir di Legalisir",
                        "Foto Copy Karpeg dilegalisir",
                        "Surat Keterangan tidak Pernah di Jatuhi Hukuman Disiplin ditandatangani oleh Kepala Sekolah Melepas",
                        "Surat Keterangan Bebas Temuan Inspektorat ditandatangani oleh Kepala Sekolah Melepas (Optional)",
                        "Surat Keterangan Bebas Tugas Belajar/Izin Belajar ditandatangani oleh Kepala Sekolah Melepas",
                        "Daftar Riwayat Hidup/ Riwayat Pekerjaan",
                        "Surat Tugas Suami dan Foto Copy Buku Nikah (Optional)"
                    ];
                    ?>

                    <?php foreach ($berkasLabels as $index => $label): ?>
                        <div class="form-group mb-2">
                            <label for="googleDriveLink<?= $index ?>">Berkas <?= $index + 1 ?> - <?= htmlspecialchars($label) ?></label>
                            <div class="input-group">
                                <input type="text" 
                                    name="google_drive_link[]" 
                                    id="googleDriveLink<?= $index ?>" 
                                    class="form-control"
                                    value="<?= isset($usulan_drive_links[$index]) ? $usulan_drive_links[$index] : '' ?>"
                                    <?= in_array($index, $optionalIndexes) ? '' : 'required' ?> 
                                >
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-sm-custom btn-info" onclick="previewLink(<?= $index ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <small id="errorMsg<?= $index ?>" class="form-text"></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <!-- 🔹 Tombol Kembali ke Edit Usulan -->
                <a href="/usulan/edit-usulan/<?= $usulan['id'] ?>" class="btn btn-sm-custom btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <!-- 🔹 Tombol Simpan Perubahan -->
                <button type="submit" class="btn btn-sm-custom btn-primary" id="submitBtn">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SCRIPT VALIDASI BERKAS -->
<script>
const berkasLabels = <?= json_encode($berkasLabels) ?>;    
const googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/(file\/d\/|open\?id=|drive\/folders\/)).+/;
const optionalIndexes = [6, 9, 16, 19]; 

async function validateLinks() {
    let allValid = true;
    let submitBtn = document.getElementById("submitBtn");

    for (let i = 0; i < document.querySelectorAll("input[name='google_drive_link[]']").length; i++) {
        let input = document.querySelectorAll("input[name='google_drive_link[]']")[i];
        let linkValue = input.value.trim();
        let feedbackElement = document.getElementById(`errorMsg${i}`);

        if (optionalIndexes.includes(i) && !linkValue) {
            feedbackElement.innerHTML = "✅ Opsional (Boleh dikosongkan)";
            feedbackElement.style.color = "green";
            continue;
        }

        if (!linkValue) {
            feedbackElement.innerHTML = "❌ Data masih kosong";
            feedbackElement.style.color = "red";
            allValid = false;
            continue;
        }

        let match = linkValue.match(googleDrivePattern);
        if (!match) {
            feedbackElement.innerHTML = "❌ Tautan tidak valid!";
            feedbackElement.style.color = "red";
            allValid = false;
            continue;
        }

        let fileId = match[1];
        let fileInfo = await checkGoogleDriveFile(fileId);

        if (!fileInfo.success) {
            feedbackElement.innerHTML = `❌ ${fileInfo.message}`;
            feedbackElement.style.color = "red";
            allValid = false;
        } else {
            feedbackElement.innerHTML = "✔ Tautan valid dan file adalah PDF";
            feedbackElement.style.color = "green";
        }
    }

    submitBtn.disabled = !allValid;
}

async function checkGoogleDriveFile(fileId) {
    try {
        let response = await fetch(`https://www.googleapis.com/drive/v3/files/${fileId}?fields=mimeType,name&key=YOUR_GOOGLE_DRIVE_API_KEY`);
        let data = await response.json();

        if (data.error) {
            return { success: false, message: "File tidak bisa diakses (Periksa izin)" };
        }

        if (data.mimeType !== "application/pdf") {
            return { success: false, message: "File bukan PDF!" };
        }

        return { success: true };
    } catch (error) {
        return { success: false, message: "Gagal memverifikasi file" };
    }
}

document.querySelectorAll("input[name='google_drive_link[]']").forEach((input) => {
    input.addEventListener("input", validateLinks);
});

document.addEventListener("DOMContentLoaded", validateLinks);

document.addEventListener("DOMContentLoaded", function () {
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: "<?= session()->getFlashdata('success'); ?>",
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // ✅ Redirect ke halaman usulan setelah dikonfirmasi
            window.location.href = "/usulan";
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            title: 'Gagal!',
            text: "<?= session()->getFlashdata('error'); ?>",
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
});


// Fungsi Preview Link Google Drive
function previewLink(index) {
    let inputId = `googleDriveLink${index}`;
    let inputElement = document.getElementById(inputId);

    if (!inputElement) {
        Swal.fire({
            title: 'Error!',
            text: `Tidak ditemukan input untuk ${berkasLabels[index] || 'Berkas ' + (index + 1)}.`,
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return;
    }

    let link = inputElement.value.trim();
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
