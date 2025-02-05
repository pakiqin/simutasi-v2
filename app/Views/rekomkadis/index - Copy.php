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
</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-signature"></i> Rekomendasi Kadis</h1>
<div class="row">
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
        <h5>05.1: Edit Surat Rekomendasi</h5>
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


    <!-- Bagian 2: Tabel Daftar Surat Rekomendasi -->
    <div class="col-md-6">
        <div class="table-container">
            <h5>05.2: Daftar Surat Rekomendasi Kadis</h5>
            <table class="table">
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
                                <td><?= esc($surat['perihal_rekomkadis']) ?></td>
                                <td>
                                    <a href="<?= base_url('file/rekomkadis/' . esc($surat['file_rekomkadis'])) ?>" 
                                       class="btn btn-info btn-sm" 
                                       target="_blank" 
                                       title="Lihat Surat Rekom Kadis">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <?php if (!$surat['terkait']): ?>
                                    <a href="javascript:void(0);" 
                                       class="btn btn-warning btn-sm" 
                                       onclick="openEditForm('<?= esc($surat['id']) ?>', 
                                                             '<?= esc($surat['nomor_rekomkadis']) ?>', 
                                                             '<?= date('Y-m-d', strtotime($surat['tanggal_rekomkadis'])) ?>', 
                                                             '<?= esc($surat['perihal_rekomkadis']) ?>', 
                                                             '<?= base_url('file/rekomkadis/' . esc($surat['file_rekomkadis'])) ?>')">
                                        <i class="fas fa-edit"></i> 
                                    </a>
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
        </div>
    </div>

</div>

<div class="row">
    <!-- Bagian 3: Tabel Usulan Belum Terkait -->
    <div class="col-md-6">
        <div class="table-container">
            <h5>05.3: Usulan Belum Terkait dengan File Rekomendasi Kadis</h5>
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
                                <button class="btn btn-primary btn-sm" onclick="openPopup('<?= $usulan['nomor_usulan'] ?>')">
                                    <i class="fas fa-link"></i> Sematkan
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bagian 4: Tabel Usulan yang Terkait -->
    <div class="col-md-6">
        <div class="table-container">
            <h5>05.4: Usulan Terkait dengan File Rekomendasi Kadis</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nomor Usulan</th>
                        <th>Nama Guru</th>
                        <th>Sekolah Asal</th>
                        <th>Nomor Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usulanTerkait as $usulan): ?>
                        <tr>
                            <td><?= $usulan['nomor_usulan'] ?></td>
                            <td><?= $usulan['guru_nama'] ?></td>
                            <td><?= $usulan['sekolah_asal'] ?></td>
                            <td><?= $usulan['nomor_rekomkadis'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Popup untuk Memilih Surat Rekomendasi -->
<div id="popupRekomendasi" style="display: none;">
    <div class="popup-container">
        <h5>Pilih Surat Rekomendasi</h5>
        <input type="text" id="searchPopup" class="form-control" placeholder="Cari Surat Rekomendasi">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nomor Surat</th>
                    <th>Tanggal</th>
                    <th>Perihal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="popupTableBody">
                <?php foreach ($daftarSurat as $surat): ?>
                    <tr>
                        <td><?= $surat['nomor_rekomkadis'] ?></td>
                        <td><?= date('d-m-Y', strtotime($surat['tanggal_rekomkadis'])) ?></td>
                        <td><?= $surat['perihal_rekomkadis'] ?></td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="sematkanSurat('<?= $surat['id'] ?>', selectedNomorUsulan)">
                                Pilih
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    let selectedNomorUsulan = null;

    function openPopup(nomorUsulan) {
        document.getElementById('popupRekomendasi').style.display = 'block';
        selectedNomorUsulan = nomorUsulan; // Set variabel global dengan nomor usulan yang dipilih
    }

    function sematkanSurat(idSurat, nomorUsulan) {
        // Kirim permintaan untuk menyematkan surat rekomendasi
        fetch('/rekomkadis/sematkan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?= csrf_token() ?>',
            },
            body: JSON.stringify({ idSurat, nomorUsulan }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Surat berhasil disematkan!');
                location.reload();
            } else {
                alert('Gagal menyematkan surat.');
            }
        })
        .catch(error => console.error('Error:', error));
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

</script>

<?= $this->endSection(); ?>
