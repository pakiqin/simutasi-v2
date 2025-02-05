<?= $this->extend('layouts/main_layout'); ?>
<?= $this->section('content'); ?>
<style>
    .btn-revisi {
    background-color: #4e73df;
    color: #fff;
    }

    .btn-revisi:hover {
        background-color: #2952c7;
    }

</style>

<h1 class="h3 mb-4 text-gray-800"><i class="fas fa-fw fa-folder"></i> Daftar Usulan Mutasi</h1>
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
    <a href="/usulan/create" class="btn btn-primary mb-2 mb-lg-0">
        <i class="fas fa-plus-circle"></i> Tambah Usulan
    </a>
    <div class="d-flex gap-3">
        <form method="get" class="d-flex align-items-center gap-2">
            <label for="per_page" class="mb-0">Tampilkan:</label>
            <select id="per_page" name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="5" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="10" <?= $perPage == 25 ? 'selected' : '' ?>>25</option>
                <option value="25" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                <option value="50" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
            </select>
        </form>        
        <form method="get" class="d-flex align-items-center gap-2">
            <label for="nip" class="mb-0">Cari:</label>
            <div class="input-group">
                <input type="text" name="nip" id="nip" class="form-control form-control-sm" value="<?= $searchNIP ?? '' ?>" placeholder="Masukkan NIP">
                <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-search"></i></button>
                <a href="/usulan" class="btn btn-light btn-sm"><i class="fas fa-eraser"></i></a>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped">
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
                    <td>
                        <?php if ($row['status'] === '01'): ?>
                            <!-- Status 01: Semua tombol muncul -->
                            <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <?php if (!$readonly): ?>
                                <a href="/usulan/edit/<?= $row['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" onclick="confirmDelete('/usulan/delete/<?= $row['id'] ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>

                        <?php elseif ($row['status'] === '02'): ?>
                            <?php if (($row['status_usulan_cabdin'] === 'Lengkap' || $row['status_usulan_cabdin'] === 'Terkirim') && $row['status_telaah'] === 'Ditolak'): ?>
                                <!-- Status 02: Lengkap/Terkirim & Telaah Ditolak -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if (!$readonly): ?>                                
                                    <a href="#" class="btn btn-danger btn-sm" onclick="confirmDeleteTolak('/usulan/deletetolak/<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                <?php endif; ?>                                
                            <?php elseif (($row['status_usulan_cabdin'] === 'Lengkap' || $row['status_usulan_cabdin'] === 'Terkirim') && $row['status_telaah'] === 'Disetujui'): ?>
                                <!-- Status 02: Lengkap/Terkirim & Telaah Disetujui -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            <?php elseif (($row['status_usulan_cabdin'] === 'Lengkap' || $row['status_usulan_cabdin'] === 'Terkirim') && is_null($row['status_telaah'])): ?>
                                <!-- Status 02: Lengkap/Terkirim & Telaah NULL -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            <?php elseif ($row['status_usulan_cabdin'] === 'TdkLengkap'): ?>
                                <!-- Status 02: Tidak Lengkap -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if (!$readonly): ?>                                  
                                    <a href="javascript:void(0)" class="btn btn-revisi btn-sm" onclick="submitRevisiForm('<?= $row['nomor_usulan'] ?>')">
                                        <i class="fas fa-undo-alt"></i>
                                    </a>
                                    <form id="revisiForm" action="/revisi_usulan/deleteByNomorUsulan" method="POST" style="display: none;">
                                        <input type="hidden" name="nomor_usulan" id="revisiNomorUsulan">
                                    </form>
                                <?php endif; ?>                                       
                            <?php endif; ?>

                        <?php elseif ($row['status'] === '03'): ?>
                            <!-- Status 03: Hanya Tombol View -->
                            <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                <i class="fas fa-eye"></i>
                            </button>

                        <?php elseif ($row['status'] === '04'): ?>
                            <?php if ($row['status_telaah'] === 'Disetujui'): ?>
                                <!-- Status 04: Jika telaah diterima, hanya View -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            <?php elseif ($row['status_telaah'] === 'Ditolak'): ?>
                                <!-- Status 04: Jika telaah ditolak, View & Delete -->
                                <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <?php if (!$readonly): ?>                                
                                    <button class="btn btn-danger btn-sm" onclick="hapusUsulan('<?= $row['id'] ?>')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>

                        <?php elseif ($row['status'] >= '05' && $row['status'] <= '08'): ?>
                            <!-- Status 05-08: Hanya menampilkan View -->
                            <button class="btn btn-info btn-sm" onclick="showDetail(<?= htmlspecialchars(json_encode($row)) ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                        <?php endif; ?>
                    </td>




                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8" class="text-center">Tidak ada data ditemukan</td>
            </tr>
        <?php endif; ?>
    </tbody>


</table>

<div class="d-flex justify-content-between align-items-center">
    <p class="mb-0">Menampilkan <?= count($usulan) ?> dari <?= $pager->getTotal('usulan') ?> data</p>
    <?= $pager->links('usulan', 'custom_pagination') ?>
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
                <a href="#" id="googleDriveLink" class="btn btn-info btn-sm" target="_blank">
                    <i class="fas fa-eye"></i> Preview
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
        <button onclick="hideDetail()" class="btn btn-secondary"><i class="fas fa-times"></i></button>&nbsp;        
        <a href="#" id="cetakResiButton" class="btn btn-primary" target="_blank"><i class="fas fa-print"></i> Cetak Resi</a>

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
            title: 'Usulan ini belum anda kirim ke Dinas Provinsi',
            html: `
                <div style="text-align: left; margin-top: 10px;">
                    <p>Apakah Anda benar-benar ingin menghapus data usulan mutasi guru ini?</p>
                </div>
            `,
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

    function confirmDeleteTolak(url) {
        Swal.fire({
            title: 'Usulan ini Ditolak',
            html: `
                <div style="text-align: left; margin-top: 10px;">
                    <p>Dokumen ini tidak memenuhi syarat sehingga sistem tidak bisa meneruskan proses usulan.</p>
                    <p><strong>Data yang akan dihapus:</strong></p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> Hapus data usulan
                        </li>
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> Hapus data pengiriman usulan
                        </li>
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> File PDF rekomendasi dinas
                        </li>
                        <li style="display: flex; align-items: center;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> Hapus history usulan
                        </li>
                    </ul>
                </div>
            `,
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
    function submitRevisiForm(nomorUsulan) {
        Swal.fire({
            title: 'Konfirmasi Revisi',
            html: `
                <div style="text-align: left; margin-top: 10px;">
                    <p>Anda akan melakukan revisi berkas usulan mutasi. Tindakan ini akan menghapus catatan usulan sebelumnya!</p>
                    <p><strong>Data yang akan dihapus:</strong></p>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> Hapus data pengiriman usulan
                        </li>
                        <li style="display: flex; align-items: center; margin-bottom: 10px;">
                            <i class="fas fa-check text-success" style="margin-right: 10px;"></i> Hapus File PDF rekomendasi dinas
                        </li>
                    </ul>
                </div>
            `,

            text: "Anda akan melakukan revisi berkas usulan mutasi. Tindakan ini akan menghapus catatan usulan sebelumnya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Revisi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Set nilai nomor_usulan ke dalam form tersembunyi
                document.getElementById('revisiNomorUsulan').value = nomorUsulan;
                // Submit form
                document.getElementById('revisiForm').submit();
            }
        });
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
