<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-school"></i> Daftar Sekolah
</h1>

<!-- Header dengan Tombol Aksi dan Filter -->
<div class="header-container">
    <!-- Tombol di Kiri -->
    <div class="action-buttons">
        <a href="/sekolah/create" class="btn btn-primary btn-sm-custom">
            <i class="fas fa-plus-circle"></i>Tambah
        </a>
        <a href="/sekolah/import" class="btn btn-success btn-sm-custom">
            <i class="fas fa-file-import"></i> Import
        </a>
        <a href="/sekolah/export" class="btn btn-secondary btn-sm-custom">
            <i class="fas fa-file-download"></i> Ekspor
        </a>
    </div>

    <!-- Filter & Pagination di Kanan -->
    <div class="filter-section">
        <select id="kabupaten_filter" class="form-control" onchange="filterKabupaten()">
            <option value="">Semua Kabupaten</option>
            <?php foreach ($kabupaten as $row): ?>
                <option value="<?= $row['id_kab']; ?>" <?= ($selectedKabupaten == $row['id_kab']) ? 'selected' : ''; ?>>
                    <?= $row['nama_kab']; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <select id="per_page" class="form-control pagination-select" onchange="updatePerPage()">
            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </div>
</div>

<!-- Tabel Data Sekolah -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>NPSN</th>
                <th>Nama Sekolah</th>
                <th>Alamat</th>
                <th>Kabupaten</th>
                <th>Jenjang</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1 + ($perPage * ($pager->getCurrentPage('sekolah') - 1));
            foreach ($sekolah as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['npsn']; ?></td>
                    <td><?= $row['nama_sekolah']; ?></td>
                    <td><?= $row['alamat_sekolah']; ?></td>
                    <td><?= $row['nama_kab']; ?></td>
                    <td><?= $row['jenjang']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td class="action-column">
                        <a href="/sekolah/edit/<?= $row['id']; ?>" class="btn btn-warning btn-sm-custom">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button onclick="confirmDelete(<?= $row['id']; ?>)" class="btn btn-danger btn-sm-custom">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<!-- Pagination -->
<div class="d-flex justify-content-between align-items-center">
    <p class="pagination-info">Menampilkan <?= count($sekolah); ?> dari <?= $pager->getTotal('sekolah'); ?> data</p>
    <?= $pager->links('sekolah', 'default_full'); ?>
</div>

<script>
    function filterKabupaten() {
        window.location.href = `?kabupaten=${document.getElementById('kabupaten_filter').value}`;
    }

    function updatePerPage() {
        window.location.href = `?per_page=${document.getElementById('per_page').value}`;
    }

    function confirmDelete(id) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then(result => {
            if (result.isConfirmed) window.location.href = "/sekolah/delete/" + id;
        });
    }
</script>

<?= $this->endSection(); ?>
