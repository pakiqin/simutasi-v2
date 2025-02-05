<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    .table-container {
        overflow-x: auto;
    }
    table {
        font-size: 0.75rem;
        border-collapse: collapse;
        width: 100%;
    }
    table th, table td {
        padding: 10px;
        text-align: left;
        border: 1px solid #dee2e6;
    }
    table th {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
    }
    table tbody tr:hover {
        background-color: #eaf1fd;
    }
    .pagination-container {
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
    }

    .d-flex {
    display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .me-2 {
        margin-right: 10px; /* Jarak antara input pencarian dan dropdown */
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .mb-2 {
        margin-bottom: 10px;
    }
            .detail-container {
        margin-top: 5px;
        display: none;
        background-color: #f8f9fc;
        border: 1px solid #dee2e6;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .detail-table {
        width: 100%;
        table-layout: fixed; /* Memastikan kolom sejajar */
        border-collapse: collapse;
    }

    .detail-table th,
    .detail-table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #dee2e6;
        vertical-align: middle;
        word-wrap: break-word; /* Jika teks panjang, tetap rapi */
    }

    .detail-table th {
        background-color: #4e73df;
        color: white;
        font-weight: bold;
        width: 35%; /* Lebar tetap untuk header */
    }

    .detail-table td {
        background-color: #ffffff;
        width: 65%; /* Lebar tetap untuk isi */
    }
        .table-container {
        overflow-x: auto; /* Aktifkan scroll horizontal */
    }
    .detail-table tbody tr:hover {
        background-color: #eaf1fd !important; /* Warna latar hover biru lembut */
        transition: background-color 0.2s ease-in-out; /* Efek smooth */
    }

</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-signature"></i> Rekomendasi Kadis</h1>
<div class="row" >
    <!-- Bagian 1: Form Input Surat Rekomendasi -->
    <div id="formInput" class="col-md-6">
        <h5>05.1: Input Surat Rekomendasi</h5>
        <div class="card mb-4">
            <div class="card-body">
                <form action="/rekomkadis/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nomor_rekomkadis">Nomor Surat Rekomendasi</label>
                        <input type="text" name="nomor_rekomkadis" id="nomor_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_rekomkadis">Tanggal Surat</label>
                        <input type="date" name="tanggal_rekomkadis" id="tanggal_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal_rekomkadis">Perihal Surat</label>
                        <input type="text" name="perihal_rekomkadis" id="perihal_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="file_rekomkadis">Upload Surat Rekomendasi (PDF, Maksimal 10 MB)</label>
                        <input type="file" name="file_rekomkadis" id="file_rekomkadis" class="form-control" accept=".pdf" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bagian Edit -->
    <div id="formEdit" class="col-md-6" style="display: none;">
        <h5>05.2: Edit Surat Rekomendasi Kadis</h5>
        <div class="card mb-4">
            <div class="card-body">
                    <form id="editForm" action="/rekomkadis/updaterekomkadis/<?= esc($id ?? '') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="POST">
                    <div class="form-group">
                        <label for="edit_nomor_rekomkadis">Nomor Surat Rekomendasi</label>
                        <input type="text" name="nomor_rekomkadis" id="edit_nomor_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_rekomkadis">Tanggal Surat</label>
                        <input type="date" name="tanggal_rekomkadis" id="edit_tanggal_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_perihal_rekomkadis">Perihal Surat</label>
                        <input type="text" name="perihal_rekomkadis" id="edit_perihal_rekomkadis" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_file_rekomkadis">Upload Surat Baru (Opsional)</label>
                        <input type="file" name="file_rekomkadis" id="edit_file_rekomkadis" class="form-control" accept=".pdf">
                        <small class="form-text text-muted">
                            File saat ini: 
                            <a id="currentFileLink" href="#" target="_blank">Tidak ada file yang tersedia</a>
                        </small>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                        <i class="fas fa-times-circle"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">05.2: Daftar Surat Rekomendasi Kadis</h5>
                <input type="text" id="searchRekomInput" class="form-control form-control-sm me-2"
                       placeholder="Cari Nomor / Perihal" onkeyup="filterRekomTable()"
                       style="max-width: 250px;">
            </div>
            <table id="rekomTable" class="table">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Tanggal</th>
                        <th>Perihal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftarSurat)): ?>
                        <?php foreach ($daftarSurat as $surat): ?>
                            <tr>
                                <td><?= esc($surat['nomor_rekomkadis']) ?></td>
                                <td><?= date('d-m-Y', strtotime($surat['tanggal_rekomkadis'])) ?></td>
                                <td><?= isset($surat['perihal_rekomkadis']) ? esc($surat['perihal_rekomkadis']) : 'Tidak tersedia' ?></td>

                                <td>
                                    <!-- Semua role bisa melihat file -->
                                    <a href="<?= base_url('file/rekomkadis/' . esc($surat['file_rekomkadis'])) ?>" 
                                       class="btn btn-info btn-sm" 
                                       target="_blank" 
                                       title="Lihat Surat Rekom Kadis">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a href="javascript:void(0);" 
                                       class="btn btn-warning btn-sm" 
                                       onclick="openEditForm('<?= esc($surat['id']) ?>', 
                                                             '<?= esc($surat['nomor_rekomkadis']) ?>', 
                                                             '<?= date('Y-m-d', strtotime($surat['tanggal_rekomkadis'])) ?>', 
                                                             '<?= esc($surat['perihal_rekomkadis']) ?>', 
                                                             '<?= base_url('file/rekomkadis/' . esc($surat['file_rekomkadis'])) ?>')">
                                        <i class="fas fa-edit"></i> 
                                    </a>
                                    <?php if ($surat['terkait'] == 0): ?>
                                        <button 
                                            class="btn btn-danger btn-sm" 
                                            onclick="confirmDelete('<?= base_url('rekomkadis/delete/' . esc($surat['id'])) ?>')"
                                            title="Hapus Surat">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada surat rekomendasi yang tersedia.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination Khusus untuk Tabel 05.2 -->
            <div class="pagination-container">
                <?= $pagerSurat->links('rekom_surat_pagination', 'custom_pagination') ?>
            </div>
        </div>
    </div>



</div>

<div class="row">
    <!-- Bagian 3: Tabel Usulan Belum Terkait -->
    <div class="col-md-6">
        <div class="table-container">
            <h5>05.3: Usulan (Belum Terbit Rekom)</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>Sekolah Asal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usulanBelumTerkait as $usulan): ?>
                        <tr>
                            <td><?= $usulan['nomor_usulan'] ?></td>
                            <td><?= $usulan['guru_nama'] ?></td>
                            <td><?= $usulan['sekolah_asal'] ?></td>
                        <td>
                            <a href="<?= base_url('rekomkadis/sematkan/' . esc($usulan['id'])) ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-link"></i> Sematkan
                            </a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--tabel 05.4: Usulan Terkait dengan File Rekomendasi Kadis-->
    <div class="col-md-6">
        <div class="table-container">
            <!-- Baris Header -->
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">05.4: Usulan (Telah Terbit Rekom)</h5>
                <div class="d-flex align-items-center">
                    <input type="text" id="searchUsulanInput" class="form-control form-control-sm me-2"
                           placeholder="Cari Nomor Usulan / Nama Guru" onkeyup="filterUsulanTable()"
                           value="<?= esc($keywordUsulan) ?>" style="max-width: 250px;">

                    <form method="get" id="perPageUsulanForm">
                        <select name="perPageUsulan" class="form-control form-control-sm"
                                onchange="document.getElementById('perPageUsulanForm').submit();">
                            <option value="25" <?= $perPageUsulan == 25 ? 'selected' : '' ?>>25</option>
                            <option value="50" <?= $perPageUsulan == 50 ? 'selected' : '' ?>>50</option>
                            <option value="100" <?= $perPageUsulan == 100 ? 'selected' : '' ?>>100</option>
                        </select>
                    </form>
                </div>
            </div>

            <table id="usulanTable" class="table">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>Sekolah Asal</th>
                        <th>Nomor Rekomendasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($usulanTerkait)): ?>
                        <?php foreach ($usulanTerkait as $usulan): ?>
                            <tr>
                                <td><?= esc($usulan['nomor_usulan']) ?></td>
                                <td><?= esc($usulan['guru_nama']) ?></td>
                                <td><?= esc($usulan['sekolah_asal']) ?></td>
                                <td><?= esc($usulan['nomor_rekomkadis']) ?></td>
                                <td>
                                    <button class="btn btn-info btn-sm" 
                                            onclick="showDetailUsulan(<?= htmlspecialchars(json_encode($usulan)) ?>)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada usulan terkait.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination untuk tabel 05.4 -->
            <div class="pagination-container">
                <?= $pagerUsulan->links('usulan_terkait_pagination', 'custom_pagination') ?>
            </div>
        </div>

        <!-- Detail Data Tabel Kanan -->
    <!-- Detail Data Usulan (Desain Mirip Detail Telaah) -->
        <div id="detailDataUsulan" class="detail-container">
            <h5 class="text-primary"><i class="fas fa-info-circle"></i> 05.4: Detail Rekomendasi Kadis</h5>
            <table  class="table detail-table">
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
                        <th>Sekolah Tujuan</th>
                        <td id="detailSekolahTujuan"></td>
                    </tr>
                    <tr>
                        <th>Nomor Rekomendasi</th>
                        <td id="detailNomorRekom"></td>
                    </tr>
                    <tr>
                        <th>Tanggal Surat Rekomendasi</th>
                        <td id="detailTanggalRekom"></td>
                    </tr>                    
                    <tr>
                        <th>File Rekom Kadis</th>
                        <td>
                            <a id="berkasRekomLink" href="#" target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-file-pdf">View</i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-secondary mt-2" onclick="hideDetailUsulan()">
                <i class="fas fa-window-close"></i>
            </button>
        </div>
    </div>


</div>

<script>
    function showDetailUsulan(data) {
        document.getElementById("detailNomorUsulan").innerText = data.nomor_usulan;
        document.getElementById("detailNamaGuru").innerText = data.guru_nama;
        document.getElementById("detailNIP").innerText = data.guru_nip || "-";
        document.getElementById("detailSekolahAsal").innerText = data.sekolah_asal;
        document.getElementById("detailSekolahTujuan").innerText = data.sekolah_tujuan || "-";
        document.getElementById("detailNomorRekom").innerText = data.nomor_rekomkadis || "-";
        document.getElementById("detailTanggalRekom").textContent = data.tanggal_rekomkadis ? new Date(data.tanggal_rekomkadis).toLocaleDateString('id-ID') : '-';       

        
        let berkasUsulanLink = document.getElementById("berkasRekomLink");
        if (data.file_rekomkadis) {
            berkasRekomLink.href = "/file/rekomkadis/" + data.file_rekomkadis;
            berkasRekomLink.style.display = "inline-block";
        } else {
            berkasRekomLink.style.display = "none";
        }

        // Tampilkan detail container
        document.getElementById("detailDataUsulan").style.display = "block";
    }

    function hideDetailUsulan() {
        document.getElementById("detailDataUsulan").style.display = "none";
    }

    function filterRekomTable() {
        let input = document.getElementById('searchRekomInput').value.toLowerCase();
        let table = document.getElementById('rekomTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Mulai dari indeks 1 (skip header)
            let nomorSurat = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
            let tanggalSurat = rows[i].getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';
            let perihalSurat = rows[i].getElementsByTagName('td')[2]?.textContent.toLowerCase() || '';

            if (nomorSurat.includes(input) || tanggalSurat.includes(input) || perihalSurat.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }




    function filterUsulanTable() {
        let input = document.getElementById('searchUsulanInput').value.toLowerCase();
        let table = document.getElementById('usulanTable');
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Mulai dari indeks 1 (skip header)
            let nomorUsulan = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
            let namaGuru = rows[i].getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';
            let sekolahAsal = rows[i].getElementsByTagName('td')[2]?.textContent.toLowerCase() || '';
            let nomorRekom = rows[i].getElementsByTagName('td')[3]?.textContent.toLowerCase() || '';

            if (nomorUsulan.includes(input) || namaGuru.includes(input) || sekolahAsal.includes(input) || nomorRekom.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
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
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke URL penghapusan
                window.location.href = url;
            }
        });
    }

    function toggleTables(state) {
        const tables = document.querySelectorAll('.table-container');
        tables.forEach((table) => {
            table.style.pointerEvents = state ? 'auto' : 'none';
            table.style.opacity = state ? '1' : '0.5'; // Berikan efek visual
        });
    }

    function openEditForm(id, nomorRekom, tanggalRekom, perihalRekom, fileUrl) {
        // Sembunyikan form input
        document.getElementById('formInput').style.display = 'none';

        // Tampilkan form edit
        document.getElementById('formEdit').style.display = 'block';
        
        // Nonaktifkan tabel-tabel
        toggleTables(false);
        
        // Isi data form edit
        const formEdit = document.getElementById('editForm');
        formEdit.action = '/rekomkadis/updaterekomkadis/' + id;
        document.getElementById('editForm').action = '/rekomkadis/updaterekomkadis/' + id;
        document.getElementById('edit_nomor_rekomkadis').value = nomorRekom;
        document.getElementById('edit_tanggal_rekomkadis').value = tanggalRekom;
        document.getElementById('edit_perihal_rekomkadis').value = perihalRekom;

        const fileLink = document.getElementById('currentFileLink');
        if (fileUrl) {
            fileLink.href = fileUrl;
            fileLink.textContent = fileUrl.split('/').pop();
        } else {
            fileLink.textContent = 'Tidak ada file yang tersedia';
            fileLink.removeAttribute('href');
        }
    }

    function cancelEdit() {
        // Tampilkan form input
        document.getElementById('formInput').style.display = 'block';

        // Sembunyikan form edit
        document.getElementById('formEdit').style.display = 'none';

        // Reset form edit
        document.getElementById('editForm').reset();

        // Aktifkan kembali tabel-tabel
        toggleTables(true);
    }
    
        //kembali dari halaman sematkan
    fetch('/rekomkadis/sematkan/proses', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ idUsulan: selectedUsulan, idRekomkadis: selectedRekom })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Berhasil!', 'Rekomendasi berhasil disematkan!', 'success')
                .then(() => {
                    window.location.href = data.redirect; // Redirect ke halaman rekomkadis
                });
        } else {
            Swal.fire('Gagal!', data.message || 'Gagal menyematkan rekomendasi.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Gagal!', 'Terjadi kesalahan dalam proses.', 'error');
    });


</script>

<?= $this->endSection(); ?>
