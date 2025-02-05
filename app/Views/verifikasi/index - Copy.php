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

    .detail-container {
        margin-top: 5px;
        display: none;
    }

    .detail-table {
        width: 100%;
    }

    .detail-table th {
        background-color: #4e73df;
    }

    .detail-table td {
        background-color: #f8f9fc;
    }

    .swal-title {
    font-family: 'Arial', sans-serif;
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
    }

    .swal-button-confirm {
        background-color: #4e73df !important;
        color: #fff !important;
        font-weight: bold !important;
    }

    .swal-button-cancel {
        background-color: #d1d1d1 !important;
        color: #333 !important;
    }

    .swal2-popup {
        border-radius: 10px !important;
        padding: 20px !important;
    }

    #detailData {
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

        #detailDataDiverifikasi {
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        margin-top: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    #detailDataDiverifikasi .status-container {
        margin-top: 5px; /* Jarak atas */
        padding: 10px; /* Ruang dalam elemen */
        border-left: 5px solid #dc3545 !important; /* Border kiri lebih tebal */
        border-top-left-radius: 10px; /* Membulatkan sudut kiri atas */
        border-bottom-left-radius: 10px; /* Membulatkan sudut kiri bawah */
        background-color: #f8d7da; /* Latar merah lembut */
        font-size: 1rem; /* Ukuran font */
        color: #721c24; /* Warna teks merah */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Bayangan */
        overflow: hidden; /* Untuk memastikan sudut membulat terlihat sempurna */
    }

    #detailDataDiverifikasi .status-container.success {
        border-left: 5px solid #3fd54a !important; /* Hijau untuk status Lengkap */
        background-color: #e9f7ea; /* Latar hijau lembut */
        color: #155724; /* Warna teks hijau */
    }

    #detailDataDiverifikasi .status-container.danger {
        border-left: 5px solid #dc3545 !important; /* Border kiri lebih tebal untuk status TdkLengkap */
        background-color: #f8d7da; /* Latar merah lembut */
        color: #721c24; /* Warna teks merah */
    }

    #statusContainerDiverifikasi .status-note {
        font-weight: bold;
        text-align: center;
        font-size: 1.25rem; /* Ukuran teks lebih besar */
    }
    .badge {
        display: inline-block;
        padding: 0.25em 0.4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }

    .badge-success {
        color: #fff;
        background-color: #28a745;
    }

    .badge-danger {
        color: #fff;
        background-color: #dc3545;
    }
    .bg-warning-custom {
    background-color: #f6c23e !important;
    color: #291e03 !important;
    font-weight: bold; 
}

</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-alt"></i> Verifikasi Dokumen</h1>

<div class="row">
    <!-- Tabel 03: Usulan Menunggu Verifikasi -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>03.1. Menunggu Verifikasi</i></h5>
            <input type="text" id="filterMenunggu" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableMenunggu', this.value)">
        </div>
        <div class="table-container">
            <table id="tableMenunggu" class="table table-striped">
                <thead>
                    <tr>
                        <th>Kode Cabang</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanMenunggu)): ?>
                        <?php foreach ($usulanMenunggu as $usulan): ?>
                            <tr>
                                <td>
                                    <?= $usulan['nomor_usulan']; ?></td>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['sekolah_asal']; ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($usulan)) ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Data pada Cabang Dinas tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <?= $pagerMenunggu->links('usulanMenunggu', 'custom_pagination'); ?>
        </div>

        <!-- Detail Usulan -->
        <div id="detailData" class="detail-container"  style="overflow-x: auto;">
            <h5><i class="fas fa-info-circle"></i> 03.1 Detail</h5>
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
                        <th>Catatan</th>
                        <td id="detailCatatan"></td>
                    </tr>

                    <!-- Tombol Aksi Verifikasi -->
                    <tr>
                        <td colspan="2" class="text-center">
                            <p class="mb-2 bg-warning-custom text-white p-2 text-center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Pastikan anda untuk melakukan verifikasi kelengkapan<br \>dokumen usulan mutasi guru beserta rekomendasi Cabang Dinas pengusul<br \>sebelum klik tombol dibawah ini.</p>
                            <button class="btn btn-danger me-2" onclick="verifikasi('TdkLengkap')">
                                <i class="fas fa-times"></i> TdkLengkap
                            </button>
                            <button class="btn btn-success" onclick="verifikasi('Lengkap')">
                                <i class="fas fa-check"></i> Lengkap
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-secondary mt-2" onclick="hideDetail()">
                <i class="fas fa-window-close"></i>
            </button>
        </div>


    </div>

    <!-- Tabel 04: Usulan Diverifikasi -->
    <div class="col-md-6">
        <div class="filter-section">
            <h5><i>03.2. Usulan Diverifikasi</i></h5>
            <input type="text" id="filterDiverifikasi" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableDiverifikasi', this.value)">
        </div>
        <div class="table-container">
            <table id="tableDiverifikasi" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Tanggal Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanDiverifikasi)): ?>
                        <?php foreach ($usulanDiverifikasi as $usulan): ?>
                            <tr>
                                <td><?= $usulan['nomor_usulan']; ?>
                                    <span class="badge <?= $usulan['status_usulan_cabdin'] === 'Lengkap' ? 'badge-success' : 'badge-danger'; ?>">
                                        <?= $usulan['status_usulan_cabdin']; ?>
                                    </span>
                                </td>
                                <td><?= $usulan['guru_nama']; ?></td>
                                <td><?= $usulan['guru_nip']; ?></td>
                                <td><?= $usulan['sekolah_asal']; ?></td>
                                <td><?= date('d-m-Y', strtotime($usulan['updated_at'])); ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="showDetailDiverifikasi(<?= htmlspecialchars(json_encode($usulan)) ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data untuk proses diverifikasi.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="pagination-container">
            <?= $pagerDiverifikasi->links('usulanDiverifikasi', 'custom_pagination'); ?>
        </div>
        <div id="detailDataDiverifikasi" class="detail-container" style="overflow-x: auto;" >
        <h5><i class="fas fa-info-circle"></i> 03.2 Detail</h5>
        <table class="table table-bordered detail-table">
            <thead>
                <tr>
                    <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Informasi Usulan Guru</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Nomor Usulan</th>
                    <td id="detailNomorUsulanDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Nama Guru</th>
                    <td id="detailNamaGuruDiverifikasi"></td>
                </tr>
                <tr>
                    <th>NIP</th>
                    <td id="detailNIPDiverifikasi"></td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td id="detailNIKDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Sekolah Asal</th>
                    <td id="detailSekolahAsalDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Sekolah Tujuan</th>
                    <td id="detailSekolahTujuanDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Alasan</th>
                    <td id="detailAlasanDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Berkas Usulan</th>
                    <td>
                        <a id="berkasUsulanLinkDiverifikasi" href="#" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-file-pdf"></i> View
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Input Usulan</th>
                    <td id="detailTanggalInputDiverifikasi"></td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center"><i class="fas fa-info-circle"></i> Rekomendasi Cabang Dinas</th>
                </tr>
                <tr>
                    <th>Nama Cabang Dinas</th>
                    <td id="detailNamaCabangDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Dokumen Rekomendasi</th>
                    <td>
                        <a id="dokumenRekomendasiLinkDiverifikasi" href="#" target="_blank" class="btn btn-info btn-sm">
                            <i class="fas fa-file-pdf"></i> View
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Operator</th>
                    <td id="detailOperatorDiverifikasi"></td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td id="detailNoHPDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Tanggal Dikirimkan</th>
                    <td id="detailTanggalDikirimDiverifikasi"></td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td id="detailCatatanDiverifikasi"></td>
                </tr>
            </tbody>
        </table>

        <div class="mt-3 p-3 border rounded status-container" id="statusContainerDiverifikasi">
            <h6 class="status-title">Status Verifikasi:</h6>
            <p id="statusVerifikasiDiverifikasi" class="fw-bold text-center status-note" style="font-size: 1.25rem;"></p>
        </div>

        <button class="btn btn-secondary mt-2" onclick="hideDetailDiverifikasi()">
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
        document.getElementById('detailCatatan').textContent = data.catatan || '-';

        const dokumenLink = document.getElementById('dokumenRekomendasiLink');
        if (data.dokumen_rekomendasi) {
            dokumenLink.href = `/uploads/rekomendasi/${data.dokumen_rekomendasi}`;
            dokumenLink.style.display = 'inline-block';
        } else {
            dokumenLink.style.display = 'none';
        }

        document.getElementById('detailData').style.display = 'block';
        window.scrollTo(0, document.getElementById('detailData').offsetTop);
    }

    function hideDetail() {
        document.getElementById('detailData').style.display = 'none';
    }

    function verifikasi(status) {
    const nomorUsulan = document.getElementById('detailNomorUsulan').textContent;

    if (!nomorUsulan) {
        Swal.fire({
            icon: 'error',
            title: '<i class="fas fa-times-circle"></i> Nomor Usulan Tidak Ditemukan',
            html: '<p>Pastikan detail usulan sudah ditampilkan sebelum melanjutkan.</p>',
        });
        return;
    }

    let catatan = '';
    if (status === 'TdkLengkap') {
        Swal.fire({
            title: '<i class="fas fa-info-circle text-danger"></i> <strong>Masukkan Alasan Penolakan</strong>',
            html: '<p class="text-muted">Berikan alasan penolakan untuk dokumen ini.</p>',
            input: 'textarea',
            inputPlaceholder: 'Tulis alasan di sini...',
            inputAttributes: {
                'aria-label': 'Tulis alasan penolakan',
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Kirim',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Alasan penolakan wajib diisi!';
                }
            },
            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-button-confirm',
                cancelButton: 'swal-button-cancel',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                catatan = result.value;
                kirimDataVerifikasi(nomorUsulan, status, catatan);
            }
        });
    } else if (status === 'Lengkap') {
        Swal.fire({
            title: '<i class="fas fa-info-circle text-success"></i> <strong>Masukkan Catatan Penerimaan</strong>',
            html: '<p class="text-muted">Anda dapat menambahkan catatan penerimaan untuk dokumen ini (opsional).</p>',
            input: 'textarea',
            inputPlaceholder: 'Tulis catatan di sini...',
            inputAttributes: {
                'aria-label': 'Tulis catatan penerimaan',
            },
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-paper-plane"></i> Kirim',
            cancelButtonText: '<i class="fas fa-times"></i> Batal',
            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-button-confirm',
                cancelButton: 'swal-button-cancel',
            },
        }).then((result) => {
            if (result.isConfirmed) {
                catatan = result.value || '';
                kirimDataVerifikasi(nomorUsulan, status, catatan);
            }
        });
    }
}

function kirimDataVerifikasi(nomorUsulan, status, catatan) {
    const data = {
        nomor_usulan: nomorUsulan,
        status: status,
        catatan: catatan,
    };

    fetch('/verifikasi/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => {
            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: '<i class="fas fa-check-circle"></i> Verifikasi Berhasil',
                    html: '<p>Status verifikasi berhasil diperbarui.</p>',
                }).then(() => {
                    location.reload();
                });
            } else {
                return response.json().then((err) => {
                    throw new Error(err.error || 'Terjadi kesalahan.');
                });
            }
        })
        .catch((error) => {
            Swal.fire({
                icon: 'error',
                title: '<i class="fas fa-exclamation-triangle"></i> Gagal Memproses',
                html: `<p>${error.message}</p>`,
            });
        });
}

    function showDetailDiverifikasi(data) {
        // Isi data detail berdasarkan data yang dipilih
        document.getElementById('detailNomorUsulanDiverifikasi').textContent = data.nomor_usulan || '-';
        document.getElementById('detailNamaGuruDiverifikasi').textContent = data.guru_nama || '-';
        document.getElementById('detailNIPDiverifikasi').textContent = data.guru_nip || '-';
        document.getElementById('detailNIKDiverifikasi').textContent = data.guru_nik || '-';
        document.getElementById('detailSekolahAsalDiverifikasi').textContent = data.sekolah_asal || '-';
        document.getElementById('detailSekolahTujuanDiverifikasi').textContent = data.sekolah_tujuan || '-';
        document.getElementById('detailAlasanDiverifikasi').textContent = data.alasan || '-';
        document.getElementById('detailTanggalInputDiverifikasi').textContent = data.created_at
            ? new Date(data.created_at).toLocaleDateString('id-ID')
            : '-';

        const berkasLink = document.getElementById('berkasUsulanLinkDiverifikasi');
        if (data.google_drive_link) {
            berkasLink.href = data.google_drive_link;
            berkasLink.style.display = 'inline-block';
        } else {
            berkasLink.style.display = 'none';
        }

        document.getElementById('detailNamaCabangDiverifikasi').textContent = data.nama_cabang || '-';
        document.getElementById('detailOperatorDiverifikasi').textContent = data.operator || '-';
        document.getElementById('detailNoHPDiverifikasi').textContent = data.no_hp || '-';
        document.getElementById('detailTanggalDikirimDiverifikasi').textContent = data.tanggal_dikirim
            ? new Date(data.tanggal_dikirim).toLocaleDateString('id-ID')
            : '-';
        document.getElementById('detailCatatanDiverifikasi').textContent = data.catatan || '-';

        const dokumenLink = document.getElementById('dokumenRekomendasiLinkDiverifikasi');
        if (data.dokumen_rekomendasi) {
            dokumenLink.href = `/uploads/rekomendasi/${data.dokumen_rekomendasi}`;
            dokumenLink.style.display = 'inline-block';
        } else {
            dokumenLink.style.display = 'none';
        }

        // Tampilkan status verifikasi (Lengkap/TdkLengkap)
        const statusVerifikasi = document.getElementById('statusVerifikasiDiverifikasi');
        const statusContainer = document.getElementById('statusContainerDiverifikasi');
        if (data.status_usulan_cabdin === 'Lengkap') {
            statusVerifikasi.innerHTML = `<i class="fas fa-check-circle text-success"></i> Lengkap`;
            statusContainer.classList.add('success');
            statusContainer.classList.remove('danger');
        } else if (data.status_usulan_cabdin === 'TdkLengkap') {
            statusVerifikasi.innerHTML = `<i class="fas fa-times-circle text-danger"></i> TdkLengkap`;
            statusContainer.classList.add('danger');
            statusContainer.classList.remove('success');
        } else {
            statusVerifikasi.innerHTML = `<i class="fas fa-question-circle text-muted"></i> Tidak Diketahui`;
            statusContainer.classList.remove('success', 'danger');
        }


        // Tampilkan modal detail
        document.getElementById('detailDataDiverifikasi').style.display = 'block';
        window.scrollTo(0, document.getElementById('detailDataDiverifikasi').offsetTop);
    }



function hideDetailDiverifikasi() {
    document.getElementById('detailDataDiverifikasi').style.display = 'none';
}





</script>

<?= $this->endSection(); ?>
