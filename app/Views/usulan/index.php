<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800">
    <i class="fas fa-fw fa-folder"></i> Daftar Usulan Mutasi
</h1>


<!-- Header & Filter -->
<div class="header-container">
    <div class="action-buttons">
        <?php if ($role !== 'dinas'): ?> <!-- Dinas tidak bisa tambah data -->
            <a href="/usulan/create" class="btn btn-primary btn-sm-custom">
                <i class="fas fa-plus-circle"></i> Tambah
            </a>
        <?php endif; ?>
    </div>

    <div class="filter-section">
        <form method="get" class="d-flex align-items-center gap-2">
            <input type="text" name="nip" id="nip" class="form-control form-control-sm" value="<?= $searchNIP ?? '' ?>" placeholder="Cari NIP">
            <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-search"></i> Cari</button>
            <a href="/usulan" class="btn btn-light btn-sm"><i class="fas fa-eraser"></i> Hapus</a>
        </form>
        <form method="get" class="d-flex align-items-center gap-2">
            <select id="per_page" name="per_page" class="form-control pagination-select" onchange="this.form.submit()">
                <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5</option>
                <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
            </select>
        </form>
    </div>
</div>

<!-- Tabel Usulan Mutasi -->
<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Guru</th>
                <th>NIP</th>
                <th>Sekolah Asal</th>
                <th>Sekolah Tujuan</th>
                <th>Nomor Usulan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usulan)): ?>
                <?php foreach ($usulan as $index => $row): ?>
                    <tr>
                        <td><?= $index + 1 + ($perPage * ($pager->getCurrentPage('usulan') - 1)) ?></td>
                        <td><?= $row['guru_nama'] ?></td>
                        <td><?= $row['guru_nip'] ?></td>
                        <td><?= $row['sekolah_asal'] ?></td>
                        <td><?= $row['sekolah_tujuan'] ?></td>
                        <td><?= $row['nomor_usulan'] ?></td>
                        <td class="action-column">
                            <!-- Tombol View: Selalu ada untuk semua role -->
                            <button class="btn btn-info btn-sm-custom" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                <i class="fas fa-eye"></i>
                            </button>

                            <?php if ($role !== 'dinas'): ?> <!-- Dinas tidak bisa edit & hapus -->
                                <?php if ($row['status'] === '01'): ?>
                                    <!-- Status 01: Bisa Edit & Hapus -->
                                    <a href="/usulan/edit/<?= $row['id'] ?>" class="btn btn-warning btn-sm-custom">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm-custom" onclick="confirmDelete('/usulan/delete/<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                <?php elseif ($row['status'] === '02' && $row['status_telaah'] === 'Ditolak'): ?>
                                    <!-- Status 02: Telaah Ditolak, Bisa Dihapus -->
                                    <a href="#" class="btn btn-danger btn-sm-custom" onclick="confirmDeleteTolak('/usulan/deletetolak/<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>

                                <?php elseif ($row['status'] === '04' && $row['status_telaah'] === 'Ditolak'): ?>
                                    <!-- Status 04: Jika telaah ditolak, Bisa Hapus -->
                                    <button class="btn btn-danger btn-sm-custom" onclick="hapusUsulan('<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                <?php elseif ($row['status'] >= '07'): ?>
                                    <!-- Status 07 ke atas: Bisa Dihapus -->
                                    <a href="#" class="btn btn-danger btn-sm-custom" onclick="confirmDelete('/usulan/delete/<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data ditemukan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="d-flex justify-content-between align-items-center">
    <p class="pagination-info">Menampilkan <?= count($usulan) ?> dari <?= $pager->getTotal('usulan') ?> data</p>
    <?= $pager->links('usulan', 'default_full') ?>
</div>

<!-- Detail Data -->
<div id="detailData" class="mt-4" style="display: none;">
    <h3>Detail Usulan</h3>
    <table class="table table-bordered">
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
            <th>Nomor Usulan</th>
            <td id="detailNomorUsulan"></td>
        </tr>
        <tr>
            <th>Berkas Scan</th>
            <td>
                <a href="#" id="googleDriveLink" class="btn btn-info btn-sm-custom" target="_blank">
                    <i class="fas fa-eye"></i> Lihat
                </a>
            </td>
        </tr>
    </table>
    <!-- Bagian History -->
    <h4>History</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody id="historyData">
            <!-- History akan diisi oleh JavaScript -->
        </tbody>
    </table>
    <div class="d-flex gap-2">
        <button onclick="hideDetail()" class="btn btn-secondary btn-sm-custom"><i class="fas fa-times"></i></button>&nbsp;        
        <a href="#" id="cetakResiButton" class="btn btn-primary btn-sm-custom" target="_blank"><i class="fas fa-print"></i> Cetak Resi</a>

    </div>
</div>
<script>
        function showDetail(row) {
        document.getElementById('detailNamaGuru').textContent = row.guru_nama;
        document.getElementById('detailNIP').textContent = row.guru_nip;
        document.getElementById('detailSekolahAsal').textContent = row.sekolah_asal;
        document.getElementById('detailSekolahTujuan').textContent = row.sekolah_tujuan;
        document.getElementById('detailNomorUsulan').textContent = row.nomor_usulan;
        document.getElementById('googleDriveLink').href = row.google_drive_link;
        document.getElementById('cetakResiButton').href = "/usulan/generate-resi/" + row.nomor_usulan;

        // Fetch data history berdasarkan nomor_usulan
        fetch(`/usulan/getHistory/${row.nomor_usulan}`)
            .then(response => response.json())
            .then(data => {
                const historyData = document.getElementById('historyData');
                historyData.innerHTML = ''; // Kosongkan isi sebelumnya

                if (data.length > 0) {
                    data.forEach((history, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${history.status}</td>
                            <td>${history.catatan_history || '-'}</td>
                            <td>${new Date(history.updated_at).toLocaleDateString('id-ID')}</td>
                        `;
                        historyData.appendChild(row);
                    });
                } else {
                    historyData.innerHTML = `<tr><td colspan="4" class="text-center">Tidak ada data history</td></tr>`;
                }
            })
            .catch(error => {
                console.error('Error fetching history:', error);
                const historyData = document.getElementById('historyData');
                historyData.innerHTML = `<tr><td colspan="4" class="text-center text-danger">Gagal memuat data history</td></tr>`;
            });


        document.getElementById('detailData').style.display = 'block';
        window.scrollTo(0, document.getElementById('detailData').offsetTop);
    }

    function hideDetail() {
        document.getElementById('detailData').style.display = 'none';
    }

    function confirmDelete(url) {
        Swal.fire({
            title: 'Hapus Usulan',
            text: "Apakah Anda yakin ingin menghapus data usulan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function confirmDeleteTolak(url) {
        Swal.fire({
            title: 'Hapus Usulan',
            text: "Usulan ini tidak bisa dilanjutkan karena tidak memenuhi syarat. \n Apakah Anda yakin ingin menghapus data usulan ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    function submitRevisiForm(nomorUsulan) {
        Swal.fire({
            title: 'Konfirmasi Revisi',
            text: "Anda akan melakukan revisi berkas usulan mutasi. Data lama akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Revisi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('revisiNomorUsulan').value = nomorUsulan;
                document.getElementById('revisiForm').submit();
            }
        });
    }

document.addEventListener("DOMContentLoaded", function () {
    <?php if (session()->getFlashdata('success')): ?>
        let successMessage = "<?= session()->getFlashdata('success'); ?>";
        let redirectToCetak = "<?= session()->getFlashdata('redirectToCetak'); ?>";
        let nomorUsulan = "<?= session()->get('nomor_usulan'); ?>"; 

        Swal.fire({
            title: 'Berhasil!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            if (redirectToCetak && nomorUsulan) {
                window.location.replace("/usulan/konfirmasi-cetak/" + nomorUsulan);
            } else {
                window.location.replace("/usulan");
            }
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
