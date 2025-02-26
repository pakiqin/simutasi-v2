<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<?php if (session()->get('role') !== 'dinas'): ?>

<?php 
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

    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-folder"></i> Tambah Usulan Mutasi</h1>

    <!-- Form dalam Card -->
    <div class="card">
        <div class="card-body">
            <form action="/usulan/store" method="post">
                <div class="row">
                    <!-- Kolom Kiri (1/3) -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="guruNama">Nama Guru</label>
                            <input type="text" name="guru_nama" id="guruNama" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="guruNip">NIP</label>
                            <input type="text" name="guru_nip" id="guruNip" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="guruNik">NIK</label>
                            <input type="text" name="guru_nik" id="guruNik" class="form-control" maxlength="16" pattern="\d{16}" title="Masukkan tepat 16 digit angka" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alasan">Alasan</label>
                            <input type="text" name="alasan" id="alasan" class="form-control" required>
                        </div>
                    </div>

                    <!-- Kolom Tengah (2/3) -->
                    <div class="col-md-8">
                        <div class="row">
                            <!-- Kabupaten Asal & Cabang Dinas Asal sejajar -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kabupatenAsal">Kabupaten Asal</label>
                                    <select id="kabupatenAsal" name="kabupaten_asal_id" class="form-control"
                                        <?= (session()->get('role') === 'operator') ? 'disabled' : 'required' ?>>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($kabupatenList as $kabupaten): ?>
                                            <option value="<?= $kabupaten['id_kab']; ?>"
                                                <?= (session()->get('role') === 'operator' && $kabupaten['id_kab'] == $kabupaten_asal_id) ? 'selected' : '' ?>>
                                                <?= $kabupaten['nama_kab']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="kabupaten_asal_id" value="<?= $kabupaten_asal_id; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cabangDinasAsal">Cabang Dinas Asal</label>
                                    <input type="text" id="cabangDinasAsal" class="form-control" readonly
                                           value="<?= $cabang_dinas_asal_nama; ?>">
                                    <input type="hidden" id="cabangDinasAsalId" name="cabang_dinas_asal_id" value="<?= $cabang_dinas_asal_id; ?>">
                                </div>
                            </div>
                        </div>

                        <?php 
                        $sekolahAsalList = isset($sekolahAsalList) ? $sekolahAsalList : []; // Hindari error jika variabel belum terisi
                        ?>
                        <!-- Sekolah Asal -->
                        <div class="form-group mb-3">
                            <label for="sekolahAsal">Sekolah Asal</label>
                            <select id="sekolahAsal" name="sekolah_asal_id" class="form-control w-100" required>
                                <option value="">-- Pilih Sekolah --</option>
                                <?php foreach ($sekolahAsalList as $sekolah): ?>
                                    <option value="<?= $sekolah['id']; ?>"><?= $sekolah['nama_sekolah']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="sekolah_asal_nama" id="sekolahAsalNama">
                        </div>

                        <div class="row">
                            <!-- Kabupaten Tujuan & Cabang Dinas Tujuan sejajar -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kabupatenTujuan">Kabupaten Tujuan</label>
                                    <select id="kabupatenTujuan" name="kabupaten_tujuan_id" class="form-control" required>
                                        <option value="">-- Pilih --</option>
                                        <?php foreach ($kabupatenList as $kabupaten): ?>
                                            <option value="<?= $kabupaten['id_kab']; ?>"><?= $kabupaten['nama_kab']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cabangDinasTujuan">Cabang Dinas Tujuan</label>
                                    <input type="text" id="cabangDinasTujuan" class="form-control" readonly>
                                    <input type="hidden" id="cabangDinasTujuanId" name="cabang_dinas_tujuan_id">
                                </div>
                            </div>
                        </div>

                        <!-- Sekolah Tujuan -->
                        <div class="form-group mb-3">
                            <label for="sekolahTujuan">Sekolah Tujuan</label>
                            <select id="sekolahTujuan" name="sekolah_tujuan_id" class="form-control w-100" required>
                                <option value="">-- Pilih Sekolah --</option>
                            </select>
                            <input type="hidden" name="sekolah_tujuan_nama" id="sekolahTujuanNama">
                        </div>
                    </div>
                </div>
                <!-- Tautan Berkas -->
                <div class="row border p-3 mt-3 rounded bg-white">
                    <div class="col-md-12">
                        <label class="text-primary"><i class="fas fa-file-upload"></i> Tautan Berkas di Google Drive</label>

                        <?php for ($i = 0; $i < count($berkasLabels); $i++): ?>
                            <div class="form-group mb-2">
                                <label for="googleDriveLink<?= $i ?>">Berkas <?= str_pad(($i + 1), 2, "0", STR_PAD_LEFT) ?> - <?= htmlspecialchars($berkasLabels[$i]) ?></label>
                                <div class="input-group">
                                    <input type="text" name="google_drive_link[]" id="googleDriveLink<?= $i ?>" class="form-control" placeholder="Masukkan Tautan Google Drive">
                                    <button type="button" class="btn btn-sm-custom btn-info" onclick="previewLink(<?= $i ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small id="errorMsg<?= $i ?>" class="form-text"></small>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>



                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="/usulan" class="btn btn-sm-custom btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-sm-custom btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-danger">Anda tidak memiliki izin untuk mengakses halaman ini.</div>
<?php endif; ?>
<!-- SCRIPT AJAX -->
<script>
const berkasLabels = <?= json_encode($berkasLabels) ?>;
//ambil sekolah asal
document.getElementById("sekolahAsal").addEventListener("change", function () {
    let selectedOption = this.options[this.selectedIndex].text;
    document.getElementById("sekolahAsalNama").value = selectedOption;
});
//ambil sekolah tujuan
document.getElementById("sekolahTujuan").addEventListener("change", function () {
    let selectedOption = this.options[this.selectedIndex].text;
    document.getElementById("sekolahTujuanNama").value = selectedOption;
});

function updateCabangDinas(kabupatenId, targetCabangInput, targetCabangHidden, targetSekolahSelect) {
    if (kabupatenId) {
        fetch(`/api/get-cabang-dinas/${kabupatenId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById(targetCabangInput).value = data.nama_cabang;
                    document.getElementById(targetCabangHidden).value = data.id;
                } else {
                    document.getElementById(targetCabangInput).value = "";
                    document.getElementById(targetCabangHidden).value = "";
                }
            })
            .catch(error => console.error("Error Fetching Cabang Dinas:", error));

        fetch(`/api/get-sekolah/${kabupatenId}`)
            .then(response => response.json())
            .then(data => {
                let sekolahSelect = document.getElementById(targetSekolahSelect);
                sekolahSelect.innerHTML = '<option value="">-- Pilih Sekolah --</option>';
                data.forEach(sekolah => {
                    sekolahSelect.innerHTML += `<option value="${sekolah.id}">${sekolah.nama_sekolah}</option>`;
                });
            })
            .catch(error => console.error("Error Fetching Sekolah:", error));
    }
}

document.getElementById("kabupatenAsal").addEventListener("change", function () {
    updateCabangDinas(this.value, "cabangDinasAsal", "cabangDinasAsalId", "sekolahAsal");
});

document.getElementById("kabupatenTujuan").addEventListener("change", function () {
    updateCabangDinas(this.value, "cabangDinasTujuan", "cabangDinasTujuanId", "sekolahTujuan");
});

// Validasi NIK hanya angka & max 16 digit
document.getElementById("guruNik").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 16);
});

// ✅ Validasi NIP/NIK dengan AJAX sebelum submit
function checkNipNikAvailability(callback = null) {
    let nip = document.getElementById("guruNip").value.trim();
    let nik = document.getElementById("guruNik").value.trim();
    let submitBtn = document.querySelector("button[type='submit']");

    if (nip.length < 18 || nik.length < 16) {
        return;
    }

    fetch(`/api/check-nip-nik?nip=${nip}&nik=${nik}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Guru dengan NIP atau NIK ini masih dalam proses usulan dan belum selesai.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                submitBtn.disabled = true;
            } else {
                submitBtn.disabled = false;
                if (callback) callback(); // Eksekusi callback jika ada (untuk validasi submit)
            }
        })
        .catch(error => console.error("Error checking NIP/NIK:", error));
}

document.getElementById("guruNip").addEventListener("input", checkNipNikAvailability);
document.getElementById("guruNik").addEventListener("input", checkNipNikAvailability);

document.addEventListener("DOMContentLoaded", function () {
    const submitBtn = document.querySelector("button[type='submit']");
    const googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/(file\/d\/|open\?id=|drive\/folders\/)).+/;

    // Pastikan berkasLabels sudah ada
    if (typeof berkasLabels === "undefined" || !Array.isArray(berkasLabels)) {
        console.error("Daftar berkasLabels tidak ditemukan.");
        return;
    }

    // Daftar indeks berkas yang boleh dikosongkan (0-based index)
    const optionalIndexes = [6, 9, 16, 19]; // Berkas ke-7, 10, 17, 20

    function validateLinks() {
        let allValid = true;

        document.querySelectorAll("input[name='google_drive_link[]']").forEach((input, index) => {
            let linkValue = input.value.trim();
            let feedbackElement = document.getElementById(`errorMsg${index}`);

            // Jika input termasuk dalam daftar opsional, boleh kosong
            if (optionalIndexes.includes(index)) {
                if (!linkValue) {
                    feedbackElement.textContent = "✅ Opsional (Boleh dikosongkan)";
                    feedbackElement.style.color = "gray";
                    return;
                }
            }

            // Jika bukan opsional, tetap wajib diisi
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

    // Event listener untuk setiap input tautan
    document.querySelectorAll("input[name='google_drive_link[]']").forEach((input) => {
        input.addEventListener("input", validateLinks);
    });

    // Jalankan validasi saat halaman pertama kali dimuat untuk menangani data yang sudah ada
    validateLinks();

    // Cegah submit jika ada error
    document.querySelector("form").addEventListener("submit", function (event) {
        validateLinks();
        if (submitBtn.disabled) {
            event.preventDefault();
            Swal.fire({
                title: 'Gagal!',
                text: 'Harap periksa kembali semua tautan sebelum menyimpan.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
});


// SweetAlert Notifikasi
document.addEventListener("DOMContentLoaded", function () {
    <?php if (session()->getFlashdata('success')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?= session()->getFlashdata('success'); ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        Swal.fire({
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error'); ?>',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
});

// Fungsi Preview Link Google Drive untuk masing-masing input
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
    let googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/|docs\.google\.com\/)/;

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
