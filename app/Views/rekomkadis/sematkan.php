<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<style>
    .table-container { overflow-x: auto; }
    table {
        font-size: 0.75rem; width: 100%; border-collapse: collapse;
    }
    table th, table td {
        padding: 10px; text-align: left; border: 1px solid #dee2e6;
    }
    table th {
        background-color: #4e73df; color: white; font-weight: bold;
    }
    table tbody tr:hover { background-color: #eaf1fd; }
    
    .btn-batal {
        background-color: #dc3545; color: white; border: none;
        padding: 8px 12px; border-radius: 5px; cursor: pointer;
    }
    .btn-batal:hover { background-color: #c82333; }

    .filter-container {
        display: flex; justify-content: flex-end; align-items: center;
        gap: 10px; margin-bottom: 10px;
    }
    .filter-container input, .filter-container select {
        height: 38px; font-size: 0.875rem;
    }
    .action-buttons { display: flex; gap: 8px; } /* Beri jarak antar tombol */
</style>


<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-file-signature"></i>05.3: Sematkan Rekomendasi</h1>

<div class="row">
    <!-- Tabel Kiri: Data Usulan Terpilih -->
    <div class="col-md-6 table-container">
        <h5>05.3.1: Data Usulan Terpilih</h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Nomor Usulan</th>
                    <th>Nama Guru</th>
                    <th>Sekolah Asal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= esc($usulanTerpilih['nomor_usulan']) ?></td>
                    <td><?= esc($usulanTerpilih['guru_nama']) ?></td>
                    <td><?= esc($usulanTerpilih['sekolah_asal']) ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Tabel Kanan: Data Rekomendasi -->
    <div class="col-md-6 table-container">
        <!-- Header dengan Pencarian dan Pagination -->
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h5 class="mb-0">05.3.2: Daftar Surat Rekomendasi</h5>
            <div class="d-flex align-items-center">
                <input type="text" id="searchInput" class="form-control form-control-sm me-2"
                       placeholder="Cari Nomor / Perihal Rekom" onkeyup="filterTable()"
                       value="<?= esc($keyword) ?>" style="max-width: 250px;">

                <form method="get" id="perPageForm">
                    <select name="perPage" class="form-control form-control-sm"
                            onchange="document.getElementById('perPageForm').submit();">
                        <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                        <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                        <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                    </select>
                </form>
            </div>
        </div>


        <table id="rekomTable" class="table">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Perihal</th>
                    <th>Tanggal Rekom</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($daftarRekom as $rekom): ?>
                    <tr>
                        <td><?= esc($rekom['nomor_rekomkadis']) ?></td>
                        <td><?= esc($rekom['perihal_rekomkadis']) ?></td>
                        <td><?= date('d-m-Y', strtotime($rekom['tanggal_rekomkadis'])) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?= base_url('file/rekomkadis/' . esc($rekom['file_rekomkadis'])) ?>" 
                                   class="btn btn-info btn-sm" target="_blank" title="Lihat Surat Rekom Kadis">
                                    <i class="fas fa-file-pdf"></i> View PDF
                                </a>

                                <button class="btn btn-success btn-sm" onclick="sematkanRekom('<?= $rekom['id'] ?>')">
                                    <i class="fas fa-check"></i> Pilih
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination-container mt-3">
            <?= $pager->links('rekom_pagination', 'custom_pagination') ?>
        </div>
    </div>

</div>

<!-- Tombol Batalkan -->
<div class="mt-3">
    <button class="btn-batal" onclick="batalkanSematkan()">
        <i class="fas fa-times"></i> Batalkan
    </button>
</div>

<script>
    function filterTable() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let table = document.getElementById('rekomTable'); 
        let rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Mulai dari indeks 1 (skip header)
            let nomor = rows[i].getElementsByTagName('td')[0]?.textContent.toLowerCase() || '';
            let perihal = rows[i].getElementsByTagName('td')[1]?.textContent.toLowerCase() || '';

            if (nomor.includes(input) || perihal.includes(input)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }



    function sematkanRekom(rekomId) {
        fetch('/sematkan/proses', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                idUsulan: "<?= esc($usulanTerpilih['id']) ?>",
                idRekomkadis: rekomId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Rekomendasi berhasil disematkan!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/rekomkadis";
                    }
                });
            } else {
                Swal.fire({
                    title: 'Gagal!',
                    text: data.message || 'Terjadi kesalahan!',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Gagal!',
                text: 'Terjadi kesalahan jaringan atau server.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    }

    function batalkanSematkan() {
        Swal.fire({
            title: 'Batalkan?',
            text: "Anda yakin ingin membatalkan penyematan rekomendasi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Batalkan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/rekomkadis";
            }
        });
    }
</script>

<?= $this->endSection(); ?>
