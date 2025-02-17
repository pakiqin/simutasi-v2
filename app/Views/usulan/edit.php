<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fas fa-fw fa-folder"></i> Edit Usulan Mutasi
    </h1>
<div class="card">
    <div class="card-body">
        <form action="/usulan/update/<?= $usulan['id'] ?>" method="post">
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        <label for="guruNama">Nama Guru</label>
                        <input type="text" name="guru_nama" id="guruNama" class="form-control" value="<?= $usulan['guru_nama'] ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guruNip">NIP</label>
                        <input type="text" name="guru_nip" id="guruNip" class="form-control" value="<?= $usulan['guru_nip'] ?>" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="guruNik">NIK</label>
                        <input type="text" name="guru_nik" id="guruNik" class="form-control" value="<?= $usulan['guru_nik'] ?>" maxlength="16" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alasan">Alasan</label>
                        <input type="text" name="alasan" id="alasan" class="form-control" value="<?= $usulan['alasan'] ?>" required>
                    </div>
                </div>

                <!-- Kolom Tengah -->
                <div class="col-md-8">
                    <div class="row">
                        <!-- Kabupaten Asal -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="kabupatenAsal">Kabupaten Asal</label>
                                <input type="text" id="kabupatenAsal" class="form-control" 
                                       value="<?= isset($usulan['kabupaten_asal_nama']) ? $usulan['kabupaten_asal_nama'] : ''; ?>" readonly>
                                <input type="hidden" name="kabupaten_asal_id" value="<?= $usulan['kabupaten_asal_id'] ?? ''; ?>">
                            </div>
                        </div>

                        <!-- Cabang Dinas Asal -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="cabangDinasAsal">Cabang Dinas Asal</label>
                                <input type="text" id="cabangDinasAsal" class="form-control" 
                                       value="<?= isset($usulan['cabang_dinas_asal_nama']) ? $usulan['cabang_dinas_asal_nama'] : ''; ?>" readonly>
                                <input type="hidden" name="cabang_dinas_asal_id" value="<?= $usulan['cabang_dinas_asal_id'] ?? ''; ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Sekolah Asal -->
                    <div class="form-group mb-3">
                        <label for="sekolahAsal">Sekolah Asal</label>
                        <input type="text" id="sekolahAsal" class="form-control" 
                               value="<?= isset($usulan['sekolah_asal_nama']) ? $usulan['sekolah_asal_nama'] : ''; ?>" readonly>
                        <input type="hidden" name="sekolah_asal_id" value="<?= $usulan['sekolah_asal'] ?? ''; ?>">
                    </div>

                    <div class="row">
                        <!-- Kabupaten Tujuan & Cabang Dinas Tujuan -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="kabupatenTujuan">Kabupaten Tujuan</label>
                                <select id="kabupatenTujuan" name="kabupaten_tujuan_id" class="form-control" required>
                                    <?php foreach ($kabupatenList as $kabupaten): ?>
                                        <option value="<?= $kabupaten['id_kab']; ?>" <?= ($usulan['kabupaten_tujuan_nama'] == $kabupaten['nama_kab']) ? 'selected' : '' ?>><?= $kabupaten['nama_kab']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="cabangDinasTujuan">Cabang Dinas Tujuan</label>
                                <input type="text" id="cabangDinasTujuan" class="form-control" value="<?= $usulan['cabang_dinas_tujuan_nama'] ?>" readonly>
                                <input type="hidden" id="cabangDinasTujuanId" name="cabang_dinas_tujuan_id" value="<?= $usulan['cabang_dinas_tujuan_id'] ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Sekolah Tujuan -->
                    <div class="form-group mb-3">
                        <label for="sekolahTujuan">Sekolah Tujuan</label>
                        <select id="sekolahTujuan" name="sekolah_tujuan_id" class="form-control w-100" required>
                            <option value="<?= $usulan['sekolah_tujuan']; ?>"><?= $usulan['sekolah_tujuan_nama']; ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Tautan Berkas -->
            <div class="row border p-3 mt-3 rounded bg-white">
                <div class="col-md-12">
                    <label for="googleDriveLink">Tautan Berkas di Google Drive</label>
                    <div class="input-group">
                        <input type="text" name="google_drive_link" id="googleDriveLink" class="form-control" 
                               value="<?= isset($usulan['google_drive_link']) ? $usulan['google_drive_link'] : ''; ?>" 
                               placeholder="Masukkan Tautan Google Drive" required>
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

<!-- AJAX untuk mengupdate data -->
<script>
    function updateCabangDinas(kabupatenId, targetCabangInput, targetCabangHidden, targetSekolahSelect) {
        if (kabupatenId) {
            // Ambil data Cabang Dinas berdasarkan Kabupaten
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

            // Ambil daftar sekolah berdasarkan Kabupaten
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

    // Pastikan ID elemen yang dipilih benar
    document.getElementById("kabupatenAsal").addEventListener("change", function () {
        updateCabangDinas(this.value, "cabangDinasAsal", "cabangDinasAsalId", "sekolahAsal");
    });

    document.getElementById("kabupatenTujuan").addEventListener("change", function () {
        updateCabangDinas(this.value, "cabangDinasTujuan", "cabangDinasTujuanId", "sekolahTujuan");
    });


    function previewLink() {
        let link = document.getElementById('googleDriveLink').value.trim();

        // Validasi apakah tautan berisi teks
        if (!link) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Tautan Google Drive belum diisi.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Validasi apakah tautan mengandung format Google Drive
        let googleDrivePattern = /^(https?:\/\/)?(www\.)?(drive\.google\.com\/|docs\.google\.com\/)/;
        if (!googleDrivePattern.test(link)) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Masukkan tautan Google Drive yang valid!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Jika valid, buka tautan di tab baru
        window.open(link, '_blank');
    }


</script>
<?= $this->endSection(); ?>
