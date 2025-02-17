<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<?php if (session()->get('role') !== 'dinas'): ?>

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
                        </div>
                    </div>
                </div>

                <!-- Tautan Berkas -->
                <div class="row border p-3 mt-3 rounded bg-white">
                    <div class="col-md-12">
                        <label for="googleDriveLink">Tautan Berkas di Google Drive</label>
                        <div class="input-group">
                            <input type="text" name="google_drive_link" id="googleDriveLink" class="form-control" placeholder="Masukkan Tautan Google Drive" required>
                            <button type="button" class="btn btn-sm-custom btn-info" onclick="previewLink()">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
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

// Validasi Tautan Google Drive sebelum submit
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault(); // Cegah submit sementara

        checkNipNikAvailability(() => {
            let googleDriveLink = document.querySelector("input[name='google_drive_link']").value.trim();

            // 🔍 Update regex agar mendukung tautan folder Google Drive
            let googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/(file\/d\/|open\?id=|drive\/folders\/)).+/;

            if (!googleDrivePattern.test(googleDriveLink)) {
                Swal.fire({
                    title: 'Gagal!',
                    html: `<div style="text-align:left;">
                            <p>Masukkan tautan Google Drive yang valid.</p>
                            <b>Contoh format yang diterima:</b>
                            <ul style="text-align:left; padding-left:15px;">
                                <li>📂 <b>File:</b> <code>https://drive.google.com/file/d/EXAMPLE_ID/view</code></li>
                                <li>📁 <b>Folder:</b> <code>https://drive.google.com/drive/folders/EXAMPLE_ID</code></li>
                            </ul>
                          </div>`,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }

            event.target.submit(); // Jika semua validasi lolos, lanjut submit
        });
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

// Fungsi Preview Link Google Drive
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
