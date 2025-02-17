<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Usulan Mutasi | SIMUTASI</title>

    <link rel="stylesheet" href="/assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/simutasi-landingpage.css">
</head>
<body class="track-body">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card track-card shadow-lg">
                    <div class="card-body text-center">

                        <!-- Logo -->
                        <img src="/assets/img/dinaspendidikanaceh.png" class="track-logo" alt="SIMUTASI Logo">
                        <!-- Judul -->
                        <h1 class="track-title"><i class="fas fa-search"></i> Lacak Usulan</h1>
                        <!-- Pesan Error -->
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form Pencarian -->
                        <form action="/lacak-mutasi/search" method="POST" class="track-form">
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
