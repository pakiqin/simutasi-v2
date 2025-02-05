<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kartu Resi Usulan Mutasi Guru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h2, .header h3 {
            margin: 3px;
        }
        .table {
            width: 90%;
            margin: 10px auto;
            border-collapse: collapse;
        }
        .table th, .table td {
            text-align: left;
            padding: 5px;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .divider {
            text-align: center;
            margin: 15px 0;
            position: relative;
        }
        .divider::before {
            content: '';
            display: block;
            border-top: 1px dashed #000;
            margin: 0 auto;
            width: 90%;
        }
        .divider span {
            background: #fff;
            padding: 0 5px;
            font-size: 10px;
            position: relative;
            top: -8px;
        }
        .footer {
            text-align: left;
            font-size: 10px;
            margin-top: 5px;
            margin-left: 5%;
        }
    </style>
</head>
<body>
    <!-- Tabel untuk Guru Pengusul -->
    <div class="header">
        <h2>PEMERINTAH ACEH</h2>
        <h3>DINAS PENDIDIKAN</h3>
    </div>
    <table class="table">
        <tr>
            <th colspan="2">Untuk Guru Pengusul</th>
        </tr>
        <tr>
            <th>No. Resi</th>
            <td><?= $usulan['nomor_usulan'] ?></td>
        </tr>
        <tr>
            <th>Nama Guru</th>
            <td><?= $usulan['guru_nama'] ?></td>
        </tr>
        <tr>
            <th>NIP</th>
            <td><?= $usulan['guru_nip'] ?></td>
        </tr>
        <tr>
            <th>Asal Sekolah</th>
            <td><?= $usulan['sekolah_asal'] ?></td>
        </tr>
        <tr>
            <th>Cabang Dinas</th>
            <td><?= $usulan['nama_cabang'] ?></td>
        </tr>
        <tr>
            <th>Sekolah Tujuan</th>
            <td><?= $usulan['sekolah_tujuan'] ?></td>
        </tr>
        <tr>
            <th>Alasan Mutasi</th>
            <td><?= $usulan['alasan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Usulan</th>
            <td><?= strftime('%d %B %Y', strtotime($usulan['created_at'])) ?></td>
        </tr>
        <tr>
            <th>Tanggal Cetak</th>
            <td><?= strftime('%d %B %Y', strtotime($tanggal_cetak)) ?></td>
        </tr>
    </table>
    <div class="footer">
        * Kartu resi ini merupakan tanda bukti pengajuan usulan mutasi guru.
    </div>

    <!-- Garis Potong -->
    <div class="divider">
        <span>Potong di Sini</span>
    </div>

    <!-- Tabel untuk Arsip Dinas -->
    <div class="header">
        <h2>PEMERINTAH ACEH</h2>
        <h3>DINAS PENDIDIKAN</h3>
    </div>
    <table class="table">
        <tr>
            <th colspan="2">Untuk Arsip Cabang Dinas</th>
        </tr>
        <tr>
            <th>No. Resi</th>
            <td><?= $usulan['nomor_usulan'] ?></td>
        </tr>
        <tr>
            <th>Nama Guru</th>
            <td><?= $usulan['guru_nama'] ?></td>
        </tr>
        <tr>
            <th>NIP</th>
            <td><?= $usulan['guru_nip'] ?></td>
        </tr>
        <tr>
            <th>Asal Sekolah</th>
            <td><?= $usulan['sekolah_asal'] ?></td>
        </tr>
        <tr>
            <th>Cabang Dinas</th>
            <td><?= $usulan['nama_cabang'] ?></td>
        </tr>
        <tr>
            <th>Sekolah Tujuan</th>
            <td><?= $usulan['sekolah_tujuan'] ?></td>
        </tr>
        <tr>
            <th>Alasan Mutasi</th>
            <td><?= $usulan['alasan'] ?></td>
        </tr>
        <tr>
            <th>Tanggal Usulan</th>
            <td><?= strftime('%d %B %Y', strtotime($usulan['created_at'])) ?></td>
        </tr>
        <tr>
            <th>Tanggal Cetak</th>
            <td><?= strftime('%d %B %Y', strtotime($tanggal_cetak)) ?></td>
        </tr>
    </table>
    <div class="footer">
        * Kartu resi ini merupakan tanda bukti pengajuan usulan mutasi guru.
    </div>
</body>
</html>
