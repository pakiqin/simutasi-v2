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

    @media (max-width: 768px) {
        table {
            font-size: 0.65rem;
        }
    }
    .pagination-container {
        display: flex;
        justify-content: flex-end; /* Posisi ke kanan */
        margin-top: 10px; /* Jarak antara tabel dan pagination */
    }

    .detail-container {
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .detail-table {
        width: 100%;
        font-size: 0.875rem;
        border-collapse: collapse;
    }

    .detail-table th {
        background-color: #4e73df;
        color: #fff;
        text-align: left;
        padding: 10px;
    }

    .detail-table td {
        background-color: #f8f9fc;
        padding: 5px;
    }

    /* Desain konsisten untuk status usulan */
    .status-container {
        border-left: 5px solid #dee2e6; /* Default */
        background-color: #f8f9fc;
        text-align: center;
        font-size: 1rem;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .status-container.success {
        border-left-color: #28a745; /* Hijau untuk Lengkap */
        background-color: #e9f7ea;
        color: #155724;
    }

    .status-container.danger {
        border-left-color: #dc3545; /* Merah untuk TdkLengkap */
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-container.pending {
        border-left-color: #007bff; /* Biru untuk terkirim */
        background-color: #e7f1ff;
        color: #004085;
    }

    .status-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .status-note {
        font-size: 1.5rem;
        font-weight: bold;
        margin: 0;
    }

    .status-note.danger {
        color: #dc3545;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .status-subnote {
        font-size: 0.875rem; 
        font-style: italic;
        color: #6c757d;
        margin-top: -5px;
    }



    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }

    .alert-secondary {
        background-color: #e2e3e5;
        color: #6c757d;
        border-color: #d6d8db;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: bold;
    }
    .badge-pending {
        background-color: #007bff; /* Warna biru */
        color: #fff; /* Warna teks putih */
        padding: 3px 8px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: bold;
    }


</style>


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-paper-plane"></i> Pengiriman Usulan</h1>
<!-- Formulir Pengiriman -->
<div class="card mb-4">
    <?php if (!$readonly): ?>
    <div class="card-body">
        <form action="/pengiriman/updateStatus" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <!-- Sisi Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nomorUsulan">Nomor Usulan</label>
                        <select id="nomorUsulan" name="nomor_usulan" class="form-control" required>
                            <option value="">Pilih Nomor Usulan</option>
                            <?php foreach ($status01Usulan as $usulan): ?>
                                <option value="<?= $usulan['nomor_usulan'] ?>">
                                    <?= $usulan['nomor_usulan'] ?> - <?= $usulan['guru_nama'] ?> - <?= $usulan['sekolah_asal'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dokumenRekomendasi">Unggah Dokumen Rekomendasi (PDF, Maksimal 1 MB)</label>
                        <input type="file" id="dokumenRekomendasi" name="dokumen_rekomendasi" class="form-control" accept=".pdf" required>
                    </div>
                </div>

                <!-- Sisi Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="operator">Nama Operator</label>
                        <input type="text" id="operator" name="operator" class="form-control" value="<?= session()->get('nama') ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="noHp">No. HP Operator</label>
                        <input type="text" id="noHp" name="no_hp" class="form-control" placeholder="Masukkan nomor HP" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
        </form>
    </div>
    <?php endif; ?>
</div>


<!-- Tabel Kiri dan Kanan -->
<div class="row">
    <!-- Tabel Kiri -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>01: Input Usulan Mutasi oleh Cabang Dinas</i></h5>
            <input type="text" id="filterStatus01" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableStatus01', this.value)">
        </div>
        <div class="table-container">
            <table id="tableStatus01" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status01Usulan as $usulan): ?>
                        <tr class="table-row">
                            <td><?= $usulan['nomor_usulan'] ?></td>
                            <td><?= $usulan['guru_nama'] ?></td>
                            <td><?= $usulan['guru_nip'] ?></td>
                            <td><?= $usulan['sekolah_asal'] ?></td>
                            <td><?= date('d-m-Y', strtotime($usulan['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
                <?= custom_pagination(base_url('/pengiriman'), $totalStatus01, $perPage, $currentPage01, 'page_status01') ?>
        </div>
    </div>

    <!-- Tabel Kanan -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>02: Usulan Dikirim ke Dinas Provinsi</i></h5>
            <input type="text" id="filterStatus02" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableStatus02', this.value)">
        </div>
        <div class="table-container">
            <table id="tableStatus02" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Tanggal Kirim</th>                       
                        <th>Aksi</th>
                    </tr>
                </thead>
				<tbody>
				    <?php foreach ($status02Usulan as $usulan): ?>
				        <tr class="table-row">
                            <td>
                                <?= $usulan['nomor_usulan'] ?>
                                <?php if (!empty($usulan['status_usulan_cabdin'])): ?>
                                    <span class="badge 
                                        <?= $usulan['status_usulan_cabdin'] === 'Terkirim' ? 'badge-pending' : ($usulan['status_usulan_cabdin'] === 'Lengkap' ? 'badge-success' : 'badge-danger') ?>">
                                        <?= $usulan['status_usulan_cabdin'] ?>
                                    </span>
                                <?php endif; ?>
                            </td>
				            <td><?= $usulan['guru_nama'] ?></td>
				            <td><?= $usulan['guru_nip'] ?></td>
				            <td><?= $usulan['sekolah_asal'] ?></td>
				            <td><?= isset($usulan['updated_at']) ? date('d-m-Y', strtotime($usulan['updated_at'])) : '-' ?>
                            </td>
				            <td>
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode([
                                    'nomor_usulan' => $usulan['nomor_usulan'],
                                    'guru_nama' => $usulan['guru_nama'],
                                    'guru_nip' => $usulan['guru_nip'],
                                    'sekolah_asal' => $usulan['sekolah_asal'],
                                    'status_usulan_cabdin' => $usulan['status_usulan_cabdin'],
                                    'catatan' => $usulan['catatan'] ?? '-',
                                    'updated_at' => $usulan['updated_at'],
                                    'dokumen_rekomendasi' => $usulan['dokumen_rekomendasi']?? null,
                                ])) ?>)">

                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
				    <?php endforeach; ?>
				</tbody>
            </table>
        </div>
        <div class="pagination-container">
                <?= custom_pagination(base_url('/pengiriman'), $totalStatus02, $perPage, $currentPage02, 'page_status02') ?>
        </div>
        <!-- Detail Data -->
        <div id="detailData" class="mt-4 detail-container" style="display: none;">
            <h5 class="mb-3"><i class="fas fa-info-circle"></i> Detail Usulan</h5>
            <table class="table table-bordered detail-table">
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
                        <th>Sekolah Asal</th>
                        <td id="detailSekolahAsal"></td>
                    </tr>
                    <tr>
                        <th>Dokumen Rekomendasi (PDF)</th>
                        <td>
                            <a id="viewPdfLink" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf"></i> View PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Kirim</th>
                        <td id="detailTanggalKirim"></td>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <td id="catatan"></td>
                    </tr>
                </tbody>
            </table>
            <!-- Status Usulan -->
            <div class="status-container mt-4 p-3 border rounded" id="statusContainer">
                <p id="status_usulan_cabdin" class="status-note text-center fw-bold"></p>
            </div>

            <button class="btn btn-secondary mt-3" onclick="hideDetail()">
                <i class="fas fa-times"></i>
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
                if (cells[j].textContent.toLowerCase().indexOf(value) > -1) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    }
</script>

<script>
    function showDetail(data) {
        document.getElementById('detailNomorUsulan').textContent = data.nomor_usulan || '-';
        document.getElementById('detailNamaGuru').textContent = data.guru_nama || '-';
        document.getElementById('detailNIP').textContent = data.guru_nip || '-';
        document.getElementById('detailSekolahAsal').textContent = data.sekolah_asal || '-';
        document.getElementById('detailTanggalKirim').textContent = data.updated_at
            ? new Date(data.updated_at).toLocaleDateString('id-ID')
            : '-';
        document.getElementById('catatan').textContent = data.catatan || '-';

        const statusElement = document.getElementById('status_usulan_cabdin');
        const statusContainer = document.getElementById('statusContainer');
        statusElement.textContent = '';
        statusContainer.className = 'status-container';

        if (data.status_usulan_cabdin === 'Lengkap') {
            statusContainer.classList.add('success');
            statusElement.innerHTML = `
                <span class="danger"><i class="fas fa-check-circle text-success"></i> Lengkap</span>
                <br>
                <span class="status-subnote">Dilanjutkan ke proses telaah usulan oleh Kabid. GTK</span>
            `;
        } else if (data.status_usulan_cabdin === 'TdkLengkap') {
            statusContainer.classList.add('danger');
            statusElement.innerHTML = `
                <span class="danger"><i class="fas fa-times-circle text-danger"></i> TdkLengkap</span>
                <br>
                <span class="status-subnote">Revisi Perbaikan di Menu Penerimaan Usulan</span>
            `;
        } else if (data.status_usulan_cabdin === 'Terkirim') {
            statusContainer.classList.add('pending');
            statusElement.innerHTML = `
                <span class="danger"><i class="fas fa-paper-plane"></i> Terkirim</span>
                <br>
                <span class="status-subnote">Menunggu Verifikasi Dinas Provinsi</span>
            `;
        } else {
            statusElement.textContent = 'Status Tidak Diketahui';
        }

        const pdfLink = document.getElementById('viewPdfLink');
        if (data.dokumen_rekomendasi) {
            pdfLink.href = '/uploads/rekomendasi/' + data.dokumen_rekomendasi;
            pdfLink.style.display = 'inline-block';
        } else {
            pdfLink.style.display = 'none';
        }

        document.getElementById('detailData').style.display = 'block';
        window.scrollTo(0, document.getElementById('detailData').offsetTop);
    }


    function hideDetail() {
        document.getElementById('detailData').style.display = 'none';
    }
    //SweetAlert
    document.addEventListener("DOMContentLoaded", function () {
        // SweetAlert untuk notifikasi sukses
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
</script>


<?= $this->endSection(); ?>
