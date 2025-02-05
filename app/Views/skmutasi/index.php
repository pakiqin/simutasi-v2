<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    /* Konsistensi Style */

    table {
        font-size: 0.75rem;
        border-collapse: collapse;
        width: 100%; /* Tabel akan memenuhi container */
    }

    table th, table td {
        padding: 10px 15px;
        white-space: nowrap;
        text-align: left;
        border: 1px solid #dee2e6; /* Border antar sel */
    }

    table th {
        background-color: #4e73df; /* Warna biru sesuai dengan tombol Kirim */
        color: white; /* Teks putih */
        font-weight: bold; /* Cetak tebal */
    }

    table tbody tr:hover {
        background-color: #eaf1fd; /* Warna latar biru lembut saat baris dihover */
    }

    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .filter-input {
        max-width: 250px;
    }

    .detail-container {
        display: none;
        background: #f8f9fc;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
    }



    .table-container {
        overflow-x: auto;
    }
/* Styling untuk form upload */
.upload-form-container {
    background-color: #f8f9fc;
    border: 2px solid #007bff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

/* Styling untuk header dalam form */
.upload-table th {
    background-color: #e3f2fd;
    color: black; 
    text-align: center;
    font-weight: bold;
    font-size: 0.85rem;
}

/* Ukuran form lebih seragam */
.upload-table td {
    padding: 8px;
    vertical-align: middle;
}

/* Styling tombol */
.upload-table .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.upload-table .btn-danger {
    background-color: #dc3545;
    border-color: #dc3545;
}


</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-upload"></i> Unggah Nota Dinas / SK Mutasi</h1>

<div class="row">

    <!-- 🔹 Bagian Kiri: Data Usulan Siap Unggah SK Mutasi -->
    <div class="col-md-6">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="m-0"><i>07.1. Data Usulan (Belum ada SK Mutasi/ND)</i></h5>
            <div class="d-flex align-items-center">
                <input type="text" id="filterNamaGuruKiri" class="form-control filter-input" placeholder="Filter Nama Guru..." onkeyup="filterTable('tableKiri', this.value)">
        </div>
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
        <div class="table-responsive table-container">
            <table id="tableKiri" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <!--<th>Sekolah Tujuan</th>-->
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
                                <!--<td><?= $usulan['sekolah_tujuan']; ?></td>-->
                                <td>
                                    <button class="btn btn-success btn-sm" 
                                        onclick="toggleForm('form-upload-<?= $usulan['nomor_usulan']; ?>', 'row-<?= $usulan['nomor_usulan']; ?>')">
                                        <i class="fas fa-upload"></i>
                                    </button>

                                </td>
                            </tr>
                            <!-- Form Upload (Muncul di bawah baris data) -->
                            <tr id="form-upload-<?= $usulan['nomor_usulan']; ?>" class="upload-form-container" style="display: none;">
                                <td colspan="6">
                                    <h5 class="text-primary"><i class="fas fa-info-circle"></i> 07.1.1 Form Upload SK Mutasi / Nota Dinas</h5>
                                    <table class="table table-borderless upload-table">
                                        <thead>
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Nomor SK</th>
                                                <th>Tanggal SK</th>
                                                <th>File (PDF, Maksimal 1 MB)</th>
                                            </tr>
                                        </thead>
                                        <form method="post" action="<?= base_url('skmutasi/upload'); ?>" enctype="multipart/form-data">             
                                            <tbody>
                                                <tr>
                                                        <input type="hidden" name="nomor_usulan" value="<?= $usulan['nomor_usulan']; ?>">

                                                        <td>
                                                            <select name="jenis_mutasi" class="form-control form-control-sm" required>
                                                                <option value="SK Mutasi">SK Mutasi</option>
                                                                <option value="Nota Dinas">Nota Dinas</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="nomor_skmutasi" class="form-control form-control-sm" required>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="tanggal_skmutasi" class="form-control form-control-sm" required>
                                                        </td>
                                                        <td>
                                                            <input type="file" name="file_skmutasi" class="form-control form-control-sm" accept=".pdf" required>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="closeForm('form-upload-<?= $usulan['nomor_usulan']; ?>')">
                                                            <i class="fas fa-window-close"></i> Batal
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </form>
                                    </table>
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
                <?= $pagerKiri->links('usulanKiri', 'custom_pagination'); ?>
            </div>
    </div>

    <!-- 🔹 Bagian Kanan: Data SK Mutasi yang Telah Diunggah -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5 class="m-0"><i>07.2. Data Usulan (Ada SK Mutasi/ND)</i></h5>
            <input type="text" id="filterNamaGuruKanan" class="form-control filter-input" placeholder="Filter Nama Guru..." onkeyup="filterTable('tableKanan', this.value)">
            <div class="d-flex align-items-center">
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
            <table id="tableKanan" class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Nomor SK</th>
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
                                <td><?= $usulan['nomor_skmutasi']; ?></td>
                                <td>
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
                                <td colspan="7">
                                    <h5 class="text-primary"><i class="fas fa-info-circle"></i> 07.2.1 Form Edit SK Mutasi / Nota Dinas</h5>
                                    <table class="table table-borderless upload-table">
                                        <thead>
                                            <tr>
                                                <th>Jenis</th>
                                                <th>Nomor SK</th>
                                                <th>Tanggal SK</th>
                                                <th>File (PDF, Maksimal 1 MB)</th>
                                            </tr>
                                        </thead>
                                        <form method="post" action="<?= base_url('skmutasi/update'); ?>" enctype="multipart/form-data">
                                            <tbody>
                                                <tr>
                                                    <input type="hidden" name="id_skmutasi" value="<?= $usulan['id_skmutasi']; ?>">
                                                    <input type="hidden" name="nomor_usulan" value="<?= $usulan['nomor_usulan']; ?>">

                                                    <td>
                                                        <select name="jenis_mutasi" class="form-control form-control-sm" required>
                                                            <option value="SK Mutasi" <?= ($usulan['jenis_mutasi'] === 'SK Mutasi') ? 'selected' : ''; ?>>SK Mutasi</option>
                                                            <option value="Nota Dinas" <?= ($usulan['jenis_mutasi'] === 'Nota Dinas') ? 'selected' : ''; ?>>Nota Dinas</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nomor_skmutasi" class="form-control form-control-sm" value="<?= $usulan['nomor_skmutasi']; ?>" required>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="tanggal_skmutasi" class="form-control form-control-sm" value="<?= $usulan['tanggal_skmutasi']; ?>" required>
                                                    </td>
                                                    <td>
                                                        <input type="file" name="file_skmutasi" class="form-control form-control-sm" accept=".pdf">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4" class="text-right">
                                                        <a href="<?= base_url('file/skmutasi/' . esc($usulan['file_skmutasi'])) ?>" 
                                                           class="btn btn-info btn-sm" 
                                                           target="_blank" 
                                                           title="Lihat SK Mutasi">
                                                            <i class="fas fa-file-pdf"></i> Lihat File
                                                        </a>
                                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="closeForm('form-update-<?= $usulan['nomor_usulan']; ?>')">
                                                            <i class="fas fa-window-close"></i> Batal
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </form>
                                    </table>
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
                <?= $pagerKanan->links('usulanKanan', 'custom_pagination'); ?>
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
