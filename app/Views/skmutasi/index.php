<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-upload"></i> Unggah SK Mutasi / Nota Dinas</h1>

<div class="row">

    <!-- 🔹 Bagian Kiri: Data Usulan Siap Unggah SK Mutasi -->
    <div class="col-md-6">
        <div class="filter-section">
            <label class="text-primary"><i class="fas fa-info-circle"></i> 07.1. Belum ada SK Mutasi / ND</label>
            <div class="d-flex">
                <input type="text" id="filterNamaGuruKiri" class="form-control filter-input" placeholder="Filter Nama Guru..." onkeyup="filterTable('tableKiri', this.value)">
                <!-- Pilihan jumlah data per halaman -->
                <form method="get" id="perPageKiriForm">
                    <select name="perPageKiri" class="form-control w-auto d-inline-block" onchange="document.getElementById('perPageKiriForm').submit();">
                        <option value="10" <?= $perPageKiri == 10 ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= $perPageKiri == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $perPageKiri == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $perPageKiri == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table id="tableKiri" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanKiri)) : ?>
                        <?php foreach ($usulanKiri as $index => $usulan) : ?>
                            <tr id="row-<?= $usulan['nomor_usulan']; ?>">
                                <td><?= $index + 1; ?></td>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['sekolah_asal']; ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" 
                                        onclick="toggleForm('form-upload-<?= $usulan['nomor_usulan']; ?>', 'row-<?= $usulan['nomor_usulan']; ?>')">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                </td>
                            </tr>
                            <!-- Form Upload (Muncul di bawah baris data) -->
                            <tr id="form-upload-<?= $usulan['nomor_usulan']; ?>" class="upload-form-container" style="display: none;">
                                <td colspan="5">
                                    <div class="card p-3 shadow-sm">
                                        <h6 class="text-primary"><i class="fas fa-info-circle"></i> 07.1.1 Form Upload SK Mutasi / Nota Dinas</h6>
                                        <form method="post" action="<?= base_url('skmutasi/upload'); ?>" enctype="multipart/form-data">             
                                            <input type="hidden" name="nomor_usulan" value="<?= $usulan['nomor_usulan']; ?>">
                                            
                                            <div class="mb-2">
                                                <label class="form-label">Jenis SK</label>
                                                <select name="jenis_mutasi" class="form-control form-control-sm" required>
                                                    <option value="SK Mutasi">SK Mutasi</option>
                                                    <option value="Nota Dinas">Nota Dinas</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Nomor SK</label>
                                                <input type="text" name="nomor_skmutasi" class="form-control form-control-sm" required>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Tanggal SK</label>
                                                <input type="date" name="tanggal_skmutasi" class="form-control form-control-sm" required>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Upload File (PDF, Maks 1 MB)</label>
                                                <input type="file" name="file_skmutasi" class="form-control form-control-sm" accept=".pdf" required>
                                            </div>

                                            <div class="text-right">
                                                <button type="submit" class="btn btn-primary btn-sm-custom"><i class="fas fa-save"></i> Simpan</button>
                                                <button type="button" class="btn btn-secondary btn-sm-custom" onclick="closeForm('form-upload-<?= $usulan['nomor_usulan']; ?>')">
                                                    <i class="fas fa-window-close"></i> Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>



                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data usulan yang siap diunggah.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
                <!-- Pagination -->
            <div class="pagination-container">
                <?= $pagerKiri->links('usulanKiri', 'default_full'); ?>

            </div>
    </div>

    <!-- 🔹 Bagian Kanan: Data SK Mutasi yang Telah Diunggah -->
    <div class="col-md-6">
        <div class="filter-section">
            <label class="text-primary"><i class="fas fa-info-circle"></i> 07.2. Ada SK Mutasi / ND</label>     
            <div class="d-flex">            
                <input type="text" id="filterNamaGuruKanan" class="form-control filter-input" placeholder="Filter Nama Guru..." onkeyup="filterTable('tableKanan', this.value)">

                <!-- Pilihan jumlah data per halaman -->
                <form method="get" id="perPageKananForm">
                    <select name="perPageKanan" class="form-control w-auto d-inline-block" onchange="document.getElementById('perPageKananForm').submit();">
                        <option value="10" <?= $perPageKanan == 10 ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= $perPageKanan == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $perPageKanan == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $perPageKanan == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="table-responsive table-container">
            <table id="tableKanan" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanKanan)) : ?>
                        <?php foreach ($usulanKanan as $index => $usulan) : ?>
                            <tr id="row-kanan-<?= $usulan['nomor_usulan']; ?>">
                                <td><?= $index + 1; ?></td>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['sekolah_asal']; ?></td>                                
                                <td class="action-column">
                                    <!-- Tombol untuk melihat file PDF yang telah diunggah -->
                                    <a href="<?= base_url('file/skmutasi/' . esc($usulan['file_skmutasi'])) ?>"
                                       class="btn btn-info btn-sm"
                                       target="_blank"
                                       title="Lihat SK Mutasi">
                                       <i class="fas fa-file-pdf"></i>
                                    </a>

                                    <button class="btn btn-warning btn-sm" 
                                        onclick="toggleForm('form-update-<?= $usulan['nomor_usulan']; ?>', 'row-kanan-<?= $usulan['nomor_usulan']; ?>')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" 
                                        onclick="confirmDelete('<?= base_url('skmutasi/delete/' . $usulan['id_skmutasi']); ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- Form Update (Muncul di bawah baris data) -->
                            <tr id="form-update-<?= $usulan['nomor_usulan']; ?>" class="upload-form-container" style="display: none;">
                                <td colspan="5">
                                    <div class="card p-3 shadow-sm">
                                        <h6 class="text-primary"><i class="fas fa-info-circle"></i> 07.2.1 Form Edit SK Mutasi / Nota Dinas</h6>
                                        <form method="post" action="<?= base_url('skmutasi/update'); ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="id_skmutasi" value="<?= $usulan['id_skmutasi']; ?>">
                                            <input type="hidden" name="nomor_usulan" value="<?= $usulan['nomor_usulan']; ?>">

                                            <div class="mb-2">
                                                <label class="form-label">Jenis SK</label>
                                                <select name="jenis_mutasi" class="form-control form-control-sm" required>
                                                    <option value="SK Mutasi" <?= ($usulan['jenis_mutasi'] === 'SK Mutasi') ? 'selected' : ''; ?>>SK Mutasi</option>
                                                    <option value="Nota Dinas" <?= ($usulan['jenis_mutasi'] === 'Nota Dinas') ? 'selected' : ''; ?>>Nota Dinas</option>
                                                </select>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Nomor SK</label>
                                                <input type="text" name="nomor_skmutasi" class="form-control form-control-sm" value="<?= $usulan['nomor_skmutasi']; ?>" required>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Tanggal SK</label>
                                                <input type="date" name="tanggal_skmutasi" class="form-control form-control-sm" value="<?= $usulan['tanggal_skmutasi']; ?>" required>
                                            </div>

                                            <div class="mb-2">
                                                <label class="form-label">Upload File (PDF, Maks 1 MB)</label>
                                                <input type="file" name="file_skmutasi" class="form-control form-control-sm" accept=".pdf">
                                            </div>

                                            <div class="text-right">
                                                <a href="<?= base_url('file/skmutasi/' . esc($usulan['file_skmutasi'])) ?>" 
                                                   class="btn btn-info btn-sm-custom" 
                                                   target="_blank" 
                                                   title="Lihat SK Mutasi">
                                                    <i class="fas fa-file-pdf"></i> Lihat
                                                </a>
                                                <button type="submit" class="btn btn-primary btn-sm-custom"><i class="fas fa-save"></i> Simpan</button>
                                                <button type="button" class="btn btn-secondary btn-sm-custom" onclick="closeForm('form-update-<?= $usulan['nomor_usulan']; ?>')">
                                                    <i class="fas fa-window-close"></i> Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>



                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data SK Mutasi yang dapat diperbarui.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
                <!-- Pagination -->
            <div class="pagination-container">
                <?= $pagerKanan->links('usulanKanan', 'default_full'); ?>

            </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        <?php if (session()->getFlashdata('success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success'); ?>',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session()->getFlashdata('error'); ?>',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
/*
function toggleForm(formId, rowId) {
    let form = document.getElementById(formId);
    let row = document.getElementById(rowId);

    // Pastikan baris utama tampil sebelum menampilkan form
    if (row && row.style.display === "none") {
        return; // Tidak melakukan apa-apa jika baris utama tersembunyi
    }

    // Tampilkan atau sembunyikan form
    if (form) {
        form.style.display = (form.style.display === "none" || form.style.display === "") ? "table-row" : "none";
    }
}*/

    function toggleForm(formId, rowId) {
        let form = document.getElementById(formId);
        let row = document.getElementById(rowId);

        // Pastikan baris utama tampil sebelum menampilkan form
        if (row && row.style.display === "none") {
            return; // Tidak melakukan apa-apa jika baris utama tersembunyi
        }

        // Tutup semua form yang terbuka sebelum membuka yang baru (agar tidak menumpuk)
        document.querySelectorAll(".upload-form-container").forEach(el => {
            if (el.id !== formId) {
                el.style.display = "none";
            }
        });

        // Sembunyikan efek highlight dari semua baris sebelum menyoroti yang baru
        document.querySelectorAll("tr").forEach(el => el.classList.remove("table-active"));

        // Tampilkan atau sembunyikan form dengan efek smooth
        if (form) {
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "table-row"; // Tampilkan form
                row.classList.add("table-active"); // Sorot baris terkait
                form.classList.add("animate-fade"); // Efek animasi saat muncul
            } else {
                form.style.display = "none"; // Sembunyikan form
                row.classList.remove("table-active"); // Hapus sorotan baris
            }
        }
    }

    function closeForm(formId) {
        let form = document.getElementById(formId);
        if (form) {
            form.style.display = "none"; // Sembunyikan form
            form.classList.remove("animate-fade"); // Hapus animasi saat form ditutup
        }
    }


// Pastikan filter tidak menyembunyikan form yang sedang terbuka
function filterTable(tableId, searchValue) {
    let rows = document.querySelectorAll(`#${tableId} tbody tr`);
    
    rows.forEach(row => {
        if (row.id.startsWith("row-")) { // Baris utama data guru
            let formId = row.id.replace("row-", "form-upload-"); // ID form terkait
            let formRow = document.getElementById(formId);

            // Cek apakah row utama harus ditampilkan
            if (row.textContent.toLowerCase().includes(searchValue.toLowerCase())) {
                row.style.display = "";
                if (formRow && formRow.style.display !== "none") {
                    formRow.style.display = ""; // Pastikan form tetap terlihat
                }
            } else {
                row.style.display = "none";
                if (formRow) {
                    formRow.style.display = "none"; // Sembunyikan form jika baris utama tidak ada
                }
            }
        }
    });
}


function closeForm(formId) {
    let form = document.getElementById(formId);
    if (form) {
        form.style.display = 'none';
        form.dataset.visible = "false";
    }
}

function confirmDelete(url) {
    Swal.fire({
        title: "Yakin ingin menghapus?",
        text: "Data SK Mutasi dan file PDF akan dihapus!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}

</script>

<?= $this->endSection(); ?>
