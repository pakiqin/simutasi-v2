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
</style>
<?php if (session()->get('role') !== 'dinas'): ?>

    <h1 class="h3 mb-4 text-gray-800"><i class="fas fa-folder"></i> Tambah Usulan Mutasi</h1>

    <!-- Form dalam Card -->
    <div class="card mt-3">
        <!-- Tab Bar -->
        <ul class="nav nav-tabs nav-custom">
            <li class="nav-item">
                <a class="nav-link active" href="#">1️⃣ Data Guru & Sekolah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">2️⃣ Upload Berkas</a>
            </li>
        </ul>
        <div class="card-body">
            <form action="/usulan/store-data-guru" method="post">
            <div class="row">
                    <!-- Kolom Kiri (1/3) -->
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="guruNama">Nama Guru</label>
                            <input type="text" name="guru_nama" id="guruNama" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="guruNip">NIP</label>
                            <input type="text" name="guru_nip" id="guruNip" class="form-control" 
                                maxlength="18" pattern="\d{18}" title="Masukkan tepat 18 digit angka tanpa spasi" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="guruNik">NIK</label>
                            <input type="text" name="guru_nik" id="guruNik" class="form-control" maxlength="16" pattern="\d{16}" title="Masukkan tepat 16 digit angka" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="alasan">Alasan Mutasi</label>
                            <textarea name="alasan" id="alasan" class="form-control" rows="4" required></textarea>
                        </div>

                    </div>

                    <!-- Kolom Tengah (2/3) -->
                    <div class="col-md-8">
                        <div class="row">
                            <!-- Kabupaten Asal & Cabang Dinas Asal sejajar -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="kabupatenAsal">Kabupaten Asal</label>
                                    <select id="kabupatenAsal" name="kabupaten_asal_id" class="form-control" required>
                                        <option value="">-- Pilih Kabupaten --</option>
                                        <?php 
                                            // Jika role = operator, hanya tampilkan kabupaten terkait Cabang Dinas
                                            if (session()->get('role') === 'operator') {
                                                foreach ($kabupatenListAsal as $kabupaten): ?>
                                                    <option value="<?= $kabupaten['id_kab']; ?>" <?= ($kabupaten['id_kab'] == $kabupaten_asal_id) ? 'selected' : '' ?>>
                                                        <?= $kabupaten['nama_kab']; ?>
                                                    </option>
                                                <?php endforeach;
                                            } else {
                                                // Jika role = admin atau kabid, tampilkan semua kabupaten
                                                foreach ($kabupatenListTujuan as $kabupaten): ?>
                                                    <option value="<?= $kabupaten['id_kab']; ?>" <?= ($kabupaten['id_kab'] == $kabupaten_asal_id) ? 'selected' : '' ?>>
                                                        <?= $kabupaten['nama_kab']; ?>
                                                    </option>
                                                <?php endforeach;
                                            }
                                            ?>                                                
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="cabangDinasAsal">Cabang Dinas Asal</label>
                                    <input type="text" id="cabangDinasAsal" class="form-control" readonly>
                                    <input type="hidden" id="cabangDinasAsalId" name="cabang_dinas_asal_id">
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
                                    <?php foreach ($kabupatenListTujuan as $kabupaten): ?>
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

                <div class="d-flex justify-content-between mt-4">
                    <a href="/usulan" class="btn btn-sm-custom  btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-sm-custom btn-primary"><i class="fas fa-save"></i> Simpan & Lanjut</button>
                </div>
            </form>
        </div>
    </div>

<?php else: ?>
    <div class="alert alert-danger">Anda tidak memiliki izin untuk mengakses halaman ini.</div>
<?php endif; ?>

<!-- SCRIPT AJAX -->
<script>
// Ambil nama sekolah asal dan tujuan
document.getElementById("sekolahAsal").addEventListener("change", function () {
    let selectedOption = this.options[this.selectedIndex].text;
    document.getElementById("sekolahAsalNama").value = selectedOption;
});

document.getElementById("sekolahTujuan").addEventListener("change", function () {
    let selectedOption = this.options[this.selectedIndex].text;
    document.getElementById("sekolahTujuanNama").value = selectedOption;
});

// Fungsi untuk memperbarui Cabang Dinas berdasarkan Kabupaten dan menampilkan sekolah terkait
function updateCabangDinas(kabupatenId, targetCabangInput, targetCabangHidden, targetSekolahSelect) {
    if (kabupatenId) {
        fetch(`/api/get-cabang-dinas/${kabupatenId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById(targetCabangInput).value = data.nama_cabang || "";
                document.getElementById(targetCabangHidden).value = data.id || "";
            });

        // Ambil daftar sekolah sesuai kabupaten yang dipilih
        if (targetSekolahSelect) {
            fetch(`/api/get-sekolah/${kabupatenId}`)
                .then(response => response.json())
                .then(data => {
                    let sekolahSelect = document.getElementById(targetSekolahSelect);
                    sekolahSelect.innerHTML = '<option value="">-- Pilih Sekolah --</option>';
                    data.forEach(sekolah => {
                        sekolahSelect.innerHTML += `<option value="${sekolah.id}">${sekolah.nama_sekolah}</option>`;
                    });
                });
        }
    }
}

// Event listener untuk Kabupaten Asal & Tujuan
document.getElementById("kabupatenAsal").addEventListener("change", function () {
    updateCabangDinas(this.value, "cabangDinasAsal", "cabangDinasAsalId", "sekolahAsal");
});

document.getElementById("kabupatenTujuan").addEventListener("change", function () {
    updateCabangDinas(this.value, "cabangDinasTujuan", "cabangDinasTujuanId", "sekolahTujuan");
});

// Fungsi untuk memastikan hanya angka yang bisa diketik di input NIP/NIK
document.getElementById("guruNip").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 18); // Hanya angka, max 18 digit
});

document.getElementById("guruNik").addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, '').substring(0, 16); // Hanya angka, max 16 digit
});

function checkNipNikAvailability() {
    let nip = document.getElementById("guruNip").value.trim();
    let nik = document.getElementById("guruNik").value.trim();
    let submitBtn = document.querySelector("button[type='submit']");

    if (nip.length < 18 || nik.length < 16) {
        submitBtn.disabled = true;
        return;
    }

    fetch(`/api/check-nip-nik?nip=${nip}&nik=${nik}`)
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                submitBtn.disabled = true;

                setTimeout(() => {
                    Swal.fire({
                        title: 'Sedang Diproses...',
                        text: 'Guru dengan NIP atau NIK ini masih dalam proses usulan dan belum selesai.',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                }, 100);
            } else {
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            submitBtn.disabled = true;
        });
}

// ✅ Pastikan event listener berjalan
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("guruNip").addEventListener("input", checkNipNikAvailability);
    document.getElementById("guruNik").addEventListener("input", checkNipNikAvailability);
});


</script>

<?= $this->endSection(); ?>
