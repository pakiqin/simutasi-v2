<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Lacak Usulan Mutasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef2f7;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 90%;
            width: 700px;
            margin: 50px auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: left;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 80px;
            margin-bottom: 5px;
        }
        .header h2 {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a8a;
            margin: 5px 0;
        }
        .header p {
            font-size: 12px;
            color: #555;
            margin: 3px 0;
        }
        .info-section {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        .info-left {
            width: 70%;
        }
        .info-right {
            width: 30%;
            text-align: right;
        }
        .info-section p {
            margin: 5px 0;
            font-size: 14px;
        }
        .info-section strong {
            color: #1e3a8a;
        }
        .highlight {
            font-weight: bold;
            color: #10B981;
        }
        .timeline {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            position: relative;
        }
        .timeline::before {
            content: "";
            position: absolute;
            top: 0;
            left: 20px;
            width: 2px;
            height: 100%;
            background: #10B981;
        }
        .timeline-item {
            position: relative;
            margin: 30px 0;
            padding-left: 50px;
            text-align: left;
        }
        .timeline-item::before {
            content: "\f058";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            top: 3px;
            left: 10px;
            font-size: 16px;
            color: #10B981;
            background: #ffffff;
            border-radius: 50%;
            padding: 5px;
            border: 2px solid #10B981;
        }
        .status {
            font-weight: bold;
            font-size: 16px;
            color: #1e3a8a;
        }
        .time {
            font-size: 14px;
            color: #6b7280;
            font-style: italic;
        }
        .download-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background: #10B981;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s ease;
        }
        .download-btn:hover {
            background: #0f9d58;
            transform: scale(1.05);
        }
        .empty-data {
            text-align: center;
            color: #ef4444;
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 15px;
            }
            .timeline-item {
                padding-left: 40px;
            }
            .timeline-item::before {
                left: 5px;
            }
            .info-section {
                flex-direction: column;
                text-align: left;
            }
            .info-left, .info-right {
                width: 100%;
                text-align: left;
            }

            .back-link {
                display: inline-block;
                margin-top: 10px;
                padding: 10px 15px;
                background: #10B981;
                color: white;
                text-decoration: none;
                border-radius: 8px;
                font-size: 14px;
                font-weight: bold;
            }

            .back-link:hover {
                background: #c82333;
                transform: scale(1.05);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="/assets/img/logo.png" alt="Logo Pemerintah Aceh">
            <h2>PEMERINTAH ACEH</h2>
            <h2>DINAS PENDIDIKAN</h2>
            <p>Jl. Tgk. Mohd. Daud Beureueh No.22, Telp. 22620 Banda Aceh</p>
            <p>Kodepos 23121</p>
        </div>

        <h1><i class="fas fa-history"></i> Riwayat Usulan</h1>

        <div class="info-section">
            <div class="info-left">
                <p><strong>Nomor Usulan:</strong> <span class="highlight"><?= $nomorUsulan ?></span></p>
                <p><strong>Nama Guru:</strong> <?= $namaGuru ?></p>
                <p><strong>NIP:</strong> <?= $nipGuru ?></p>
            </div>
            <div class="info-right">
                <p><strong>Sekolah Asal:</strong> <?= $sekolahAsal ?></p>
                <p><strong>Sekolah Tujuan:</strong> <?= $sekolahTujuan ?></p>
                <p><strong>Tanggal Input:</strong> <?= date('d M Y', strtotime($tanggalUsulan)) ?></p>
            </div>
        </div>

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
                            <i class="fas fa-download"></i> Unduh Surat Rekomendasi Kadis
                        </a>
                    <?php endif; ?>

                    <?php if ($data['status'] == '02' && !empty($fileDokumenRekom) && !empty($tokenDokumenRekom)): ?>
                        <a href="/lacak-mutasi/download/dokumen/<?= $nomorUsulan; ?>/<?= $tokenDokumenRekom; ?>" class="download-btn">
                            <i class="fas fa-download"></i> Unduh Dokumen Rekomendasi
                        </a>
                    <?php endif; ?>
                    
                    <?php if ($data['status'] == '01' && !empty($googleDriveLink)): ?>
                        <a href="<?= $googleDriveLink; ?>" target="_blank" class="download-btn">
                            <i class="fas fa-eye"></i> View Berkas
                        </a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>

            </ul>
        <?php endif; ?>
        
        <a href="/lacak-mutasi" class="download-btn" style="background: #dc3545;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

    </div>
</body>
</html>
