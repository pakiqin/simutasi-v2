<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Usulan Mutasi | SIMUTASI</title>

    <link rel="stylesheet" href="/assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #4a90e2, #6a11cb);
        }
        .track-card {
            max-width: 450px;
            margin: auto;
        }
        .track-logo {
            width: 90px;
            margin-bottom: 5px;
        }
        .instansi-text {
            font-size: 1rem;
            font-weight: bold;
            color: #333; /* Warna lebih gelap */
            text-transform: uppercase;
            line-height: 1.2;
            margin-bottom: 2px;
            text-align: center;
        }
        .instansi-subtext {
            font-size: 0.85rem;
            color: #555; /* Warna lebih tegas */
            line-height: 1.3;
            margin-bottom: 15px;
            text-align: center;
        }
        .track-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e73df;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .track-title i {
            margin-right: 8px;
        }
        .info-text {
            font-size: 14px;
            font-weight: 500;
            color: #333; /* Warna lebih tegas */
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .info-link {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
            margin-top: 15px;
        }
        .info-link i {
            margin-right: 5px;
        }
        .btn-search {
            width: 100%;
            padding: 12px;
            background: #4e73df;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-search:hover {
            background: #3b5ecf;
        }
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5 track-card">
                    <div class="card-body p-5 text-center">

                        <img src="/assets/img/logo.png" class="track-logo" alt="SIMUTASI Logo">

                        <!-- 🔹 Informasi Instansi -->
                        <p class="instansi-text">PEMERINTAH ACEH</p>
                        <p class="instansi-text">DINAS PENDIDIKAN</p>
                        <p class="instansi-subtext">Jl. Tgk. Mohd. Daud Beureueh No.22, Telp. 22620 Banda Aceh, Kodepos 23121</p>

                        <h1 class="track-title"><i class="fas fa-search"></i> Lacak Usulan Mutasi</h1>
                        <p class="info-text">Masukkan <strong>Nomor Usulan</strong> dan <strong>NIP</strong> untuk melihat status terbaru mutasi Anda.</p>
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <form action="/lacak-mutasi/search" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nomor_usulan" placeholder="Masukkan Nomor Usulan" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nip" placeholder="Masukkan NIP" required>
                            </div>
                            <button type="submit" class="btn-search"><i class="fas fa-search"></i> Cari</button>
                        </form>
                        
                        <hr>
                        <a href="/" class="info-link"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
