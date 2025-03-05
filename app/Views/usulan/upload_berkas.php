<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    .nav-custom {
        background-color: #e9ecef;
    }

    .nav-tabs .nav-link.active {
        background-color: white !important;
        color: #6c757d; !important;
        font-weight: bold;
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        transition: 0.3s;
    }
    .nav-tabs .nav-link:hover {
        color: #495057;
    }
    .info-card {
        background: #f8f9fc;
        border-left: 4px solid #4e73df;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
</style>
<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-upload"></i> Upload Berkas</h1>

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
        <a class="nav-link" href="#">1️⃣ Data Guru & Sekolah</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">2️⃣ Upload Berkas</a>
    </li>
</ul>
    <div class="card-body">
        <form action="/usulan/store-drive-links/<?= $nomor_usulan ?>" method="post">
            <div class="row">
                <div class="col-md-12">
                    <?php 
                    $optionalIndexes = [6, 9, 16, 19];
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
                                    <?= in_array($index, $optionalIndexes) ? '' : 'required' // Hanya required jika bukan opsional ?>
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

            <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-sm-custom btn-primary" id="submitBtn">
                <i class="fas fa-save"></i> Simpan Usulan
            </button>
        </div>

        </form>
    </div>
</div>


<!-- SCRIPT VALIDASI BERKAS -->
<script>
const berkasLabels = <?= json_encode($berkasLabels) ?>;
const googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/(file\/d\/|open\?id=|drive\/folders\/)).+/;
const optionalIndexes = [6, 9, 16, 19]; // Berkas opsional

function validateLinks() {
    let allValid = true;
    let submitBtn = document.getElementById("submitBtn");

    document.querySelectorAll("input[name='google_drive_link[]']").forEach((input, index) => {
        let linkValue = input.value.trim();
        let feedbackElement = document.getElementById(`errorMsg${index}`);

        // Jika input opsional kosong, tandai hijau dan lanjutkan
        if (optionalIndexes.includes(index) && !linkValue) {
            feedbackElement.innerHTML = "✅ Opsional (Boleh dikosongkan)";
            feedbackElement.style.color = "green";
            return;
        }

        // Jika berkas wajib kosong, tandai merah dan blokir submit
        if (!linkValue) {
            feedbackElement.innerHTML = "❌ Data masih kosong";
            feedbackElement.style.color = "red";
            allValid = false;
        } else if (!googleDrivePattern.test(linkValue)) {
            feedbackElement.innerHTML = "❌ Tautan tidak valid!";
            feedbackElement.style.color = "red";
            allValid = false;
        } else {
            feedbackElement.innerHTML = "✔ Tautan valid";
            feedbackElement.style.color = "green";
        }
    });

    // Pastikan tombol hanya aktif jika semua wajib sudah benar
    submitBtn.disabled = !allValid;
}

// Jalankan validasi saat input diubah
document.querySelectorAll("input[name='google_drive_link[]']").forEach((input) => {
    input.addEventListener("input", validateLinks);
});

// Validasi awal saat halaman dimuat
document.addEventListener("DOMContentLoaded", validateLinks);

document.addEventListener("DOMContentLoaded", function () {
    // ✅ Notifikasi untuk tahap 1 (Data Guru & Sekolah)
    <?php if (session()->getFlashdata('success') == 'Data guru dan sekolah berhasil disimpan. Silakan lanjut ke upload berkas.'): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data guru dan sekolah berhasil disimpan. Silakan lanjut ke upload berkas.',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            // ✅ Pindah ke halaman Upload Berkas setelah konfirmasi
            window.location.href = "/usulan/upload-berkas/<?= session()->get('nomor_usulan'); ?>";
        });
    <?php endif; ?>

    // ✅ Notifikasi untuk tahap 2 (Upload Berkas)
    <?php if (session()->getFlashdata('success') == 'Berkas berhasil diunggah dan disimpan!'): ?>
        Swal.fire({
            title: 'Berkas berhasil diunggah!',
            text: 'Apakah Anda ingin mencetak resi?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya, Cetak Resi',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            let nomorUsulan = "<?= session()->get('nomor_usulan'); ?>";

            if (result.isConfirmed) {
                if (nomorUsulan) {
                    // ✅ Buka hasil generate resi di halaman baru
                    window.open("/usulan/generate-resi/" + nomorUsulan, "_blank");
                } else {
                    Swal.fire("Error!", "Nomor usulan tidak ditemukan.", "error");
                }
            }
            // ✅ Kembali ke halaman usulan setelah konfirmasi
            window.location.href = "/usulan";
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
