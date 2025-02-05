<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    .table-container {
        overflow-x: auto; /* Aktifkan scroll horizontal */
    }

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

    .table-row {
        transition: background-color 0.2s; /* Efek transisi untuk hover */
    }

    .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .filter-input {
        max-width: 250px; /* Batasi lebar input filter */
    }

    .pagination-container {
        display: flex;
        justify-content: flex-end; /* Posisi ke kanan */
        margin-top: 5px; /* Jarak antara tabel dan pagination */
    }
        .filter-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .filter-section .filter-input {
        height: 38px;
        font-size: 0.875rem;
        margin-right: 10px;
    }

    .filter-section select {
        height: 38px;
        padding: 6px 12px;
        font-size: 0.875rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background-color: #fff;
        color: #495057;
        min-width: 80px;
    }

    .filter-section select:focus,
    .filter-section .filter-input:focus {
        border-color: #4e73df;
        box-shadow: 0 0 4px rgba(78, 115, 223, 0.5);
    }
    #detailData {
        /* Container utama */
        margin-top: 5px;
        display: none;
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #detailData .detail-table {
        /* Tabel detail */
        width: 100%;
    }

    #detailData .detail-table th {
        /* Header tabel */
        background-color: #4e73df;
        color: white;
        text-align: left;
        padding: 10px 15px;
    }

    #detailData .detail-table td {
        /* Isi tabel */
        background-color: #f8f9fc;
        text-align: left;
        padding: 10px 15px;
    }

    #detailData .status-container {
        /* Status container */
        margin-top: 15px;
        padding: 15px;
        background-color: #eaf1fd;
        border: 1px solid #4e73df;
        border-radius: 8px;
        text-align: center;
    }

    #detailData .status-title {
        /* Judul status */
        font-weight: bold;
        margin-bottom: 10px;
    }

    #detailData .status-note {
        /* Catatan status */
        font-size: 1rem;
    }
    #detailDataKanan {
        /* Container utama */
        margin-top: 5px;
        display: none;
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #detailDataKanan .detail-table {
        /* Tabel detail */
        width: 100%;
    }

    #detailDataKanan .detail-table th {
        /* Header tabel */
        background-color: #4e73df;
        color: white;
        text-align: left;
        padding: 10px 15px;
    }

    #detailDataKanan .detail-table td {
        /* Isi tabel */
        background-color: #f8f9fc;
        text-align: left;
        padding: 10px 15px;
    }

    /* Status Disetujui */
    #detailDataKanan .status-container.success {
        border-left-color: #3fd54a; /* Border hijau */
        background-color: #e9f7ea; /* Latar hijau lembut */
        color: #155724; /* Warna teks hijau */
    }

    /* Status Ditolak */
    #detailDataKanan .status-container.danger {
        border-left-color: #dc3545; /* Border merah */
        background-color: #f8d7da; /* Latar merah lembut */
        color: #721c24; /* Warna teks merah */
    }

    /* Teks di Status Container */
    #detailDataKanan .status-note {
        font-weight: bold;
        text-align: center;
        font-size: 1.25rem; /* Ukuran teks lebih besar */
    }
        .bg-warning-custom {
        background-color: #f6c23e !important;
        color: #291e03 !important;
        font-weight: bold; 
    }

</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-alt"></i> Telaah Dokumen</h1>
<?php if (session()->getFlashdata('message')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('message'); ?>
        </button>
    </div>
<?php endif; ?>
<!-- Notifikasi untuk pesan flash -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<div class="row">
    <!-- Tabel Menunggu Telaah -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>04.1. Menunggu Telaah</i></h5>
            <div class="d-flex">
                <input type="text" id="filterMenunggu" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableMenunggu', this.value)">
                <form method="get" id="perPageFormMenunggu">
                    <select name="perPage" class="form-control" onchange="document.getElementById('perPageFormMenunggu').submit();">
                        <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table id="tableMenunggu" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Nama Cabang</th>                        
                        <th>Sekolah Asal</th>
                        <th>Sekolah Tujuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanMenunggu)): ?>
                        <?php foreach ($usulanMenunggu as $usulan): ?>
                            <tr>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['nama_cabang']; ?></td>                                
                                <td><?= $usulan['sekolah_asal']; ?></td>
                                <td><?= $usulan['sekolah_tujuan']; ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($usulan)) ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data belum tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <?= $pagerMenunggu->links('usulanMenunggu', 'custom_pagination'); ?>
        </div>
        <!-- Detail Data -->
        <div id="detailData" class="detail-container" style="display: none;">
            <h5><i class="fas fa-info-circle"></i> Detail Usulan</h5>
            <table class="table table-bordered detail-table">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Informasi Usulan Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Nomor Usulan</th>
                        <td id="detailNomorUsulan"></td>
                    </tr>
                    <tr>
                        <th>Nama Guru</th>
                        <td id="detailNamaGuru"></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td id="detailNIP"></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td id="detailNIK"></td>
                    </tr>
                    <tr>
                        <th>Sekolah Asal</th>
                        <td id="detailSekolahAsal"></td>
                    </tr>
                    <tr>
                        <th>Sekolah Tujuan</th>
                        <td id="detailSekolahTujuan"></td>
                    </tr>
                    <tr>
                        <th>Alasan</th>
                        <td id="detailAlasan"></td>
                    </tr>
                    <tr>
                        <th>Berkas Usulan</th>
                        <td>
                            <a id="berkasUsulanLink" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Input Usulan</th>
                        <td id="detailTanggalInput"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Rekomendasi Cabang Dinas</th>
                    </tr>                    
                    <tr>
                        <th>Nama Cabang Dinas</th>
                        <td id="detailNamaCabang"></td>
                    </tr>
                    <tr>
                        <th>Dokumen Rekomendasi</th>
                        <td>
                            <a id="dokumenRekomendasiLink" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Operator</th>
                        <td id="detailOperator"></td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td id="detailNoHP"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dikirimkan</th>
                        <td id="detailTanggalDikirim"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Status Verifikasi Dinas Pendidikan</th>
                    </tr>  
                    <tr>
                        <th>Status Verifikasi</th>
                        <td id="detailStatusVerifikasi"></td>
                    </tr>    
                    <tr>
                        <th>Tanggal Update</th>
                        <td id="detailTanggalUpdate"></td>
                    </tr>                                                         
                    <tr>
                        <th>Catatan</th>
                        <td id="detailCatatan"></td>
                    </tr>
                    <?php if (!$readonly): ?>
                    <!-- Tombol Aksi Verifikasi -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <p class="mb-2 bg-warning-custom text-white p-2 text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Setelah dilakukan telaah secara mendalam terkait usulan mutasi guru yang dimaksud,<br \>maka usulan ini dinyatakan...</p>
                            <button class="btn btn-danger me-2" onclick="telaahDokumen('Ditolak')">
                                <i class="fas fa-times"></i> Ditolak
                            </button>
                            <button class="btn btn-success" onclick="telaahDokumen('Disetujui')">
                                <i class="fas fa-check"></i> Disetujui
                            </button>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>

            </table>
            <button class="btn btn-secondary mt-2" onclick="hideDetail()">
                <i class="fas fa-window-close"></i>
            </button>
        </div>
    </div>

    <!-- Tabel Sudah Ditelaah -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>04.2. Sudah Ditelaah</i></h5>
            <div class="d-flex">
                <input type="text" id="filterDitelaah" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableDitelaah', this.value)">
                <!-- Dropdown untuk Filter Status -->
                <select id="filterStatusTelaah" class="form-control" onchange="filterStatus()">
                    <option value="">Status</option>
                    <option value="Disetujui">Disetujui</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
                <form method="get" id="perPageFormDitelaah">
                    <select name="perPage" class="form-control" onchange="document.getElementById('perPageFormDitelaah').submit();">
                        <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="table-container">
            <table id="tableDitelaah" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Sekolah Tujuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanDitelaah)): ?>
                        <?php foreach ($usulanDitelaah as $usulan): ?>
                            <tr>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['sekolah_asal']; ?></td>
                                <td><?= $usulan['sekolah_tujuan']; ?></td>
                                <td>
                                    <span class="badge <?= $usulan['status_telaah'] === 'Disetujui' ? 'badge-success' : 'badge-danger'; ?>">
                                        <?= $usulan['status_telaah']; ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showDetailKanan(<?= htmlspecialchars(json_encode($usulan)) ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Data belum tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <?= $pagerDitelaah->links('usulanDitelaah', 'custom_pagination'); ?>
        </div>
        <!-- Detail Data Tabel Kanan -->
        <div id="detailDataKanan" class="detail-container" style="overflow-x: auto;">
            <h5><i class="fas fa-info-circle"></i> 04.2 Detail</h5>
            <table class="table table-bordered detail-table">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Informasi Usulan Guru</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Nomor Usulan</th>
                        <td id="detailNomorUsulanKanan"></td>
                    </tr>
                    <tr>
                        <th>Nama Guru</th>
                        <td id="detailNamaGuruKanan"></td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td id="detailNIPKanan"></td>
                    </tr>
                    <tr>
                        <th>NIK</th>
                        <td id="detailNIKKanan"></td>
                    </tr>
                    <tr>
                        <th>Sekolah Asal</th>
                        <td id="detailSekolahAsalKanan"></td>
                    </tr>
                    <tr>
                        <th>Sekolah Tujuan</th>
                        <td id="detailSekolahTujuanKanan"></td>
                    </tr>
                    <tr>
                        <th>Alasan</th>
                        <td id="detailAlasanKanan"></td>
                    </tr>
                    <tr>
                        <th>Berkas Usulan</th>
                        <td>
                            <a id="berkasUsulanLinkKanan" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Input Usulan</th>
                        <td id="detailTanggalInputKanan"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Rekomendasi Cabang Dinas</th>
                    </tr>
                    <tr>
                        <th>Nama Cabang Dinas</th>
                        <td id="detailNamaCabangKanan"></td>
                    </tr>
                    <tr>
                        <th>Dokumen Rekomendasi</th>
                        <td>
                            <a id="dokumenRekomendasiLinkKanan" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Operator</th>
                        <td id="detailOperatorKanan"></td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td id="detailNoHPKanan"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Dikirimkan</th>
                        <td id="detailTanggalDikirimKanan"></td>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Status Telaah Kabid GTK</th>
                    </tr>
                    <tr>
                        <th>Tanggal Telaah</th>
                        <td id="detailTanggalTelaahKanan"></td>
                    </tr>
                    <tr>
                        <th>Catatan Telaah</th>
                        <td id="detailCatatanTelaahKanan"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Status Telaah Container -->
            <div class="mt-3 p-3 border rounded status-container" id="statusContainerKanan">
                <h6 class="status-title">Status Telaah:</h6>
                <p id="statusTelaahNoteKanan" class="fw-bold text-center status-note"></p>
            </div>

            <button class="btn btn-secondary mt-2" onclick="hideDetailKanan()">
                <i class="fas fa-window-close"></i>
            </button>
        </div>


    </div>
</div>


<script>
    function filterTable(tableId, searchValue) {
        const table = document.getElementById(tableId);
        const rows = table.getElementsByTagName('tr');
        const value = searchValue.toLowerCase();

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toLowerCase().includes(value)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }

function showDetail(data) {
    // BAGIAN 1: Informasi Usulan Guru
    document.getElementById('detailNomorUsulan').textContent = data.nomor_usulan || '-';
    document.getElementById('detailNamaGuru').textContent = data.guru_nama || '-';
    document.getElementById('detailNIP').textContent = data.guru_nip || '-';
    document.getElementById('detailNIK').textContent = data.guru_nik || '-';
    document.getElementById('detailSekolahAsal').textContent = data.sekolah_asal || '-';
    document.getElementById('detailSekolahTujuan').textContent = data.sekolah_tujuan || '-';
    document.getElementById('detailAlasan').textContent = data.alasan || '-';
    document.getElementById('detailTanggalInput').textContent = data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID') : '-';

        const berkasLink = document.getElementById('berkasUsulanLink');
        if (data.google_drive_link) {
            berkasLink.href = data.google_drive_link;
            berkasLink.style.display = 'inline-block';
        } else {
            berkasLink.style.display = 'none';
        }

    // BAGIAN 2: Informasi Rekomendasi Cabang Dinas
    document.getElementById('detailNamaCabang').textContent = data.nama_cabang || '-';
    document.getElementById('detailOperator').textContent = data.operator || '-';
    document.getElementById('detailNoHP').textContent = data.no_hp || '-';
    document.getElementById('detailTanggalDikirim').textContent = data.tanggal_dikirim ? new Date(data.tanggal_dikirim).toLocaleDateString('id-ID') : '-';

        const dokumenLink = document.getElementById('dokumenRekomendasiLink');
        if (data.dokumen_rekomendasi) {
            dokumenLink.href = `/uploads/rekomendasi/${data.dokumen_rekomendasi}`;
            dokumenLink.style.display = 'inline-block';
        } else {
            dokumenLink.style.display = 'none';
        }
    // BAGIAN 3: Informasi Verifikasi
    document.getElementById('detailStatusVerifikasi').textContent = data.status_usulan_cabdin || '-';
    document.getElementById('detailTanggalUpdate').textContent = data.tanggal_update ? new Date(data.tanggal_update).toLocaleDateString('id-ID') : '-';
    document.getElementById('detailCatatan').textContent = data.catatan || '-';
    
    document.getElementById('detailData').style.display = 'block';
    window.scrollTo(0, document.getElementById('detailData').offsetTop);
}

    function hideDetail() {
        document.getElementById('detailData').style.display = 'none';
    }

function telaahDokumen(status) {
    const nomorUsulan = document.getElementById('detailNomorUsulan').textContent;

    if (!nomorUsulan) {
        Swal.fire({
            icon: 'error',
            title: 'Nomor Usulan Tidak Ditemukan',
            text: 'Pastikan detail usulan sudah ditampilkan sebelum melanjutkan.',
            confirmButtonText: 'OK',
        });
        return;
    }

    let dialogTitle = '';
    let dialogText = '';
    let inputPlaceholder = '';
    let isInputRequired = false;

    if (status === 'Ditolak') {
        dialogTitle = 'Konfirmasi Penolakan';
        dialogText = 'Anda akan menolak usulan ini. Masukkan alasan penolakan pada kolom berikut!';
        inputPlaceholder = 'Tulis alasan di sini...';
        inputDefaultValue = 'Usulan mutasi tidak memenuhi syarat'; // Teks awal untuk penolakan
        isInputRequired = true;
    } else if (status === 'Disetujui') {
        dialogTitle = 'Konfirmasi Penerimaan';
        dialogText = 'Anda akan menerima usulan ini. Tambahkan catatan penerimaan (opsional).';
        inputPlaceholder = 'Tulis catatan di sini...';
        inputDefaultValue = 'Usulan mutasi memenuhi syarat'; // Teks awal untuk persetujuan
    }

    Swal.fire({
        title: dialogTitle,
        text: dialogText,
        input: 'textarea',
        inputPlaceholder: inputPlaceholder,
        inputValue: inputDefaultValue, // Menyisipkan teks awal
        inputAttributes: {
            'aria-label': inputPlaceholder,
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        inputValidator: (value) => {
            if (isInputRequired && !value) {
                return 'Catatan wajib diisi!';
            }
        },
    }).then((result) => {
        if (result.isConfirmed) {
            const catatan = result.value || '';
            kirimHasilTelaah(nomorUsulan, status, catatan);
        }
    });

}

function kirimHasilTelaah(nomorUsulan, status, catatan) {
    const data = {
        nomor_usulan: nomorUsulan,
        status_telaah: status,
        catatan_telaah: catatan,
    };

    fetch('/telaah/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Gagal menghubungi server.');
            }
            return response.json();
        })
        .then((data) => {
            if (data.message) {
                Swal.fire({
                    icon: 'success',
                    title: 'Proses Berhasil',
                    text: data.message,
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Proses Gagal',
                    text: data.error || 'Gagal memperbarui hasil telaah.',
                });
            }
        })
        .catch((error) => {
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: error.message,
            });
        });
}
function showDetailKanan(data) {
    // BAGIAN 1: Informasi Usulan Guru
    document.getElementById('detailNomorUsulanKanan').textContent = data.nomor_usulan || '-';
    document.getElementById('detailNamaGuruKanan').textContent = data.guru_nama || '-';
    document.getElementById('detailNIPKanan').textContent = data.guru_nip || '-';
    document.getElementById('detailNIKKanan').textContent = data.guru_nik || '-';
    document.getElementById('detailSekolahAsalKanan').textContent = data.sekolah_asal || '-';
    document.getElementById('detailSekolahTujuanKanan').textContent = data.sekolah_tujuan || '-';
    document.getElementById('detailAlasanKanan').textContent = data.alasan || '-';
    document.getElementById('detailTanggalInputKanan').textContent = data.created_at
        ? new Date(data.created_at).toLocaleDateString('id-ID')
        : '-';

    const berkasLink = document.getElementById('berkasUsulanLinkKanan');
    if (data.google_drive_link) {
        berkasLink.href = data.google_drive_link;
        berkasLink.style.display = 'inline-block';
    } else {
        berkasLink.style.display = 'none';
    }

    // BAGIAN 2: Informasi Rekomendasi Cabang Dinas
    document.getElementById('detailNamaCabangKanan').textContent = data.nama_cabang || '-';
    document.getElementById('detailOperatorKanan').textContent = data.operator || '-';
    document.getElementById('detailNoHPKanan').textContent = data.no_hp || '-';
    document.getElementById('detailTanggalDikirimKanan').textContent = data.tanggal_dikirim
        ? new Date(data.tanggal_dikirim).toLocaleDateString('id-ID')
        : '-';

    const dokumenLink = document.getElementById('dokumenRekomendasiLinkKanan');
    if (data.dokumen_rekomendasi) {
        dokumenLink.href = `/uploads/rekomendasi/${data.dokumen_rekomendasi}`;
        dokumenLink.style.display = 'inline-block';
    } else {
        dokumenLink.style.display = 'none';
    }

    // BAGIAN 3: Status Telaah Kabid GTK
    document.getElementById('detailTanggalTelaahKanan').textContent = data.updated_at_telaah
        ? new Date(data.updated_at_telaah).toLocaleDateString('id-ID')
        : '-';
    document.getElementById('detailCatatanTelaahKanan').textContent = data.catatan_telaah || '-';

    // BAGIAN STATUS: Menampilkan informasi status telaah
 const statusNoteElement = document.getElementById('statusTelaahNoteKanan');
    const statusContainer = document.getElementById('statusContainerKanan');

    if (data.status_telaah === 'Disetujui') {
        statusNoteElement.innerHTML = `<i class="fas fa-check-circle text-success"></i> Disetujui`;
        statusContainer.classList.add('success');
        statusContainer.classList.remove('danger');
    } else if (data.status_telaah === 'Ditolak') {
        statusNoteElement.innerHTML = `<i class="fas fa-times-circle text-danger"></i> Ditolak`;
        statusContainer.classList.add('danger');
        statusContainer.classList.remove('success');
    } else {
        statusNoteElement.innerHTML = `<i class="fas fa-question-circle text-muted"></i> Tidak Diketahui`;
        statusContainer.classList.remove('success', 'danger');
    }

    document.getElementById('detailDataKanan').style.display = 'block';
    window.scrollTo(0, document.getElementById('detailDataKanan').offsetTop);
}

function hideDetailKanan() {
    document.getElementById('detailDataKanan').style.display = 'none';
}
function filterStatus() {
    const filterValue = document.getElementById('filterStatusTelaah').value.toLowerCase();
    const table = document.getElementById('tableDitelaah');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const statusCell = rows[i].getElementsByTagName('td')[4]; // Kolom ke-5 (Status)
        if (statusCell) {
            const statusText = statusCell.textContent.toLowerCase();
            rows[i].style.display =
                filterValue === '' || statusText.includes(filterValue) ? '' : 'none';
        }
    }
}






</script>

<?= $this->endSection(); ?>
