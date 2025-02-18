<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Lacak Usulan Mutasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/simutasi-lacak.css">
</head>
<body class="track-body">

    <div class="container">
        <div class="card track-card shadow-lg">
            <div class="card-body text-center p-4">
                
                <!-- Logo -->
                <img src="/assets/img/dinaspendidikanaceh.png" class="track-logo" alt="SIMUTASI Logo">
                
                <!-- Judul -->
                <h5 class="track-title mt-3"><i class="fas fa-history"></i> Riwayat Usulan</h5>

                <!-- Tabel Informasi -->
                <table class="info-table">
                    <tr>
                        <td><strong>Nomor Usulan</strong></td>
                        <td><span class="highlight"><?= $nomorUsulan ?></span></td>
                        <td><strong>Sekolah Asal</strong></td>
                        <td><?= $sekolahAsal ?></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Guru</strong></td>
                        <td><?= $namaGuru ?></td>
                        <td><strong>Sekolah Tujuan</strong></td>
                        <td><?= $sekolahTujuan ?></td>
                    </tr>
                    <tr>
                        <td><strong>NIP</strong></td>
                        <td><?= $nipGuru ?></td>
                        <td><strong>Tanggal Input</strong></td>
                        <td><?= date('d M Y', strtotime($tanggalUsulan)) ?></td>
                    </tr>
                </table>

                <!-- Cek apakah ada data -->
                <?php if (empty($results)) : ?>
                    <p class="empty-data"><i class="fas fa-exclamation-triangle"></i> Data tidak ditemukan. Periksa kembali nomor usulan & NIP Anda.</p>
                <?php else : ?>
                    <ul class="timeline">
                    <?php foreach ($results as $data) : ?>
                        <li class="timeline-item">
                            <p class="status"><i class="fas fa-check-circle"></i> <?= strtoupper($data['status']) ?> - <?= $data['catatan_history'] ?></p>
                            <p class="time"><i class="far fa-clock"></i> <?= date('l, d M Y H:i', strtotime($data['updated_at'])) ?> WIB</p>

                            <?php if ($data['status'] == '07' && !empty($fileSK) && !empty($tokenSK)): ?>
                                <a href="/lacak-mutasi/download/sk/<?= $nomorUsulan; ?>/<?= $tokenSK; ?>" class="download-btn">
                                    <i class="fas fa-download"></i> Unduh <?= ($jenisMutasi === 'SK Mutasi') ? 'SK Mutasi' : 'Nota Dinas'; ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($data['status'] == '05' && !empty($fileRekomKadis) && !empty($tokenRekom)): ?>
                                <a href="/lacak-mutasi/download/rekom/<?= $nomorUsulan; ?>/<?= $tokenRekom; ?>" class="download-btn">
                                    <i class="fas fa-download"></i> Unduh Rekomendasi Kadis
                                </a>
                            <?php endif; ?>

                            <?php if ($data['status'] == '02' && !empty($fileDokumenRekom) && !empty($tokenDokumenRekom)): ?>
                                <a href="/lacak-mutasi/download/dokumen/<?= $nomorUsulan; ?>/<?= $tokenDokumenRekom; ?>" class="download-btn">
                                    <i class="fas fa-download"></i> Unduh Dokumen Rekomendasi
                                </a>
                            <?php endif; ?>
                            
                            <?php if ($data['status'] == '01' && !empty($googleDriveLink)): ?>
                                <a href="<?= $googleDriveLink; ?>" target="_blank" class="download-btn">
                                    <i class="fas fa-download"></i> Unduh Dokumen
                                </a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <!-- Tombol Kembali -->
                <a href="/lacak-mutasi" class="btn btn-danger w-100 mt-3">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 SIMUTASI | Dinas Pendidikan Aceh</p>
    </footer>

</body>
</html>
