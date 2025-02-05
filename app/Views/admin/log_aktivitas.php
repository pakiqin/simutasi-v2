<?= $this->extend('layouts/main_layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-history"></i> Log Aktivitas User</h1>

<!-- Form Pencarian -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <form method="get" class="d-flex align-items-center">
        <input type="text" name="search" class="form-control form-control-sm me-2" 
               placeholder="Cari username atau role..." value="<?= esc($search) ?>">
        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> </button>
        <?php if ($search): ?>
            <a href="/log_aktivitas" class="btn btn-secondary btn-sm ms-2"><i class="fas fa-times"></i></a>
        <?php endif; ?>
    </form>

    <form method="get" class="d-flex align-items-center">
        <label for="per_page" class="mb-0 me-2">Tampilkan:</label>
        <select id="per_page" name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
            <option value="5" <?= $perPage == 5 ? 'selected' : '' ?>>5</option>
            <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
            <option value="25" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
        </select>
    </form>
</div>

<!-- Tabel Log Aktivitas -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Riwayat Aktivitas Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="logTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Aksi</th>
                        <th>IP Address</th>
                        <th>Perangkat</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($log['username']); ?></td>
                            <td>
                                <span class="badge bg-info text-white"><?= ucfirst($log['role']); ?></span>
                            </td>
                            <td>
                                <?php if ($log['action'] == 'login'): ?>
                                    <span class="badge bg-success text-white"><i class="fas fa-sign-in-alt"></i> Login</span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-white"><i class="fas fa-sign-out-alt"></i> Logout</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($log['ip_address']); ?></td>
                            <td><?= esc($log['user_agent']); ?></td>
                            <td><?= date('d-m-Y H:i:s', strtotime($log['timestamp'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0">Menampilkan <?= count($logs) ?> dari <?= $pager->getTotal() ?> data</p>
            <?= $pager->links('default', 'custom_pagination') ?>
        </div>
    </div>
</div>

<!-- DataTable Integration -->
<script>
    $(document).ready(function() {
        $('#logTable').DataTable({
            "ordering": false,
            "pageLength": <?= $perPage ?>,
            "searching": false, // Matikan search bawaan DataTable
            "language": {
                "lengthMenu": "Tampilkan _MENU_ data per halaman",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data tersedia",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "search": "Cari:",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Berikutnya",
                    "previous": "Sebelumnya"
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>
