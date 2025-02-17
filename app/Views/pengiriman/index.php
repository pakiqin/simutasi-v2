<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>




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
            <button type="submit" class="btn btn-primary btn-sm-custom"><i class="fas fa-paper-plane"></i> Kirim</button>
        </form>
    </div>
    <?php endif; ?>
</div>


<!-- Tabel Kiri dan Kanan -->
<div class="row">
    <!-- Tabel Kiri -->
    <div class="col-md-6">
        <div class="filter-section">
            <label class="text-primary"><i class="fas fa-info-circle"></i> 01: Belum Dikirim</label>
            <input type="text" id="filterStatus01" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableStatus01', this.value)">
        </div>
        <div class="table-responsive">
            <table id="tableStatus01" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru</th>
                        <th>NIP</th>
                        <th>Sekolah Asal</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($status01Usulan as $usulan): ?>
                        <tr class="table-row">
                            <td><?= $usulan['guru_nama'] ?></td>
                            <td><?= $usulan['guru_nip'] ?></td>
                            <td><?= $usulan['sekolah_asal'] ?></td>
                            <td><?= date('d-m-Y', strtotime($usulan['created_at'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links('page_status01', 'default_full'); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Tabel Kanan -->
    <div class="col-md-6">
    <div class="filter-section">
        <label class="text-primary"><i class="fas fa-info-circle"></i> 02: Usulan Terkirim</label>
        <input type="text" id="filterStatus02" class="form-control filter-input" placeholder="Filter Nama Guru" onkeyup="filterTable('tableStatus02', this.value)">
    </div>

        <div class="table-responsive">
            <table id="tableStatus02" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Nama Guru</th>                        
                        <th>Sekolah Asal</th>
                        <th>Tanggal</th>                       
                        <th>Aksi</th>
                    </tr>
                </thead>
				<tbody>
				    <?php foreach ($status02Usulan as $usulan): ?>
				        <tr class="table-row">
                            <td><?= $usulan['guru_nama'] ?></td>
				            <td><?= $usulan['sekolah_asal'] ?></td>
				            <td align="center"><?= isset($usulan['updated_at']) ? date('d-m-Y', strtotime($usulan['updated_at'])) : '-' ?><br />
                                <?php if (isset($usulan['status_usulan_cabdin']) && !empty($usulan['status_usulan_cabdin'])): ?>
                                    <span class="badge 
                                        <?= $usulan['status_usulan_cabdin'] === 'Terkirim' ? 'badge-primary' : ($usulan['status_usulan_cabdin'] === 'Lengkap' ? 'badge-success' : 'badge-danger') ?>">
                                        <?= $usulan['status_usulan_cabdin'] ?>
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Belum Dikirim</span>
                                <?php endif; ?>
                            </td>
				            <td>
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode([
                                    'nomor_usulan' => $usulan['nomor_usulan'],
                                    'guru_nama' => $usulan['guru_nama'],
                                    'guru_nip' => $usulan['guru_nip'],
                                    'sekolah_asal' => $usulan['sekolah_asal'],
                                    'status_usulan_cabdin' => $usulan['status_usulan_cabdin'] ?? 'Belum Dikirim',

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
        <?php if (!empty($pager)) : ?>
            <div class="pagination-container">
                <?= $pager->links('page_status02', 'default_full'); ?>
            </div>
        <?php endif; ?>

        <!-- Detail Data -->
        <div id="detailData" class="mt-4 detail-container" style="display: none;">
            <label class="text-primary"><i class="fas fa-info-circle"></i> Detail Usulan</label>
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
                        <th>Rekomendasi (PDF)</th>
                        <td>
                            <a id="viewPdfLink" href="#" target="_blank" class="btn btn-info  btn-sm">
                                <i class="fas fa-file-pdf"></i> Lihat
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

            <button class="btn btn-secondary mt-3 btn-sm-custom" onclick="hideDetail()">
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
