<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMUTASI</title>

    <link rel="stylesheet" href="/assets/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        .login-card {
            max-width: 450px;
            margin: auto;
        }
        .login-logo {
            width: 90px;
            margin-bottom: 5px;
        }
        .instansi-text {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            line-height: 1.2; /* Membuat teks lebih rapat */
            margin-bottom: 2px;
        }
        .instansi-subtext {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.2;
            margin-bottom: 10px;
        }
        .login-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4e73df;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-title i {
            margin-right: 8px;
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
    </style>
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5 login-card">
                    <div class="card-body p-5 text-center">

                        <img src="/assets/img/logo.png" class="login-logo" alt="SIMUTASI Logo">

                        <!-- Tambahan informasi PEMERINTAH ACEH dengan teks lebih rapat -->
                        <p class="instansi-text">PEMERINTAH ACEH</p>
                        <p class="instansi-text">DINAS PENDIDIKAN</p>
                        <p class="instansi-subtext">Jl. Tgk. Mohd. Daud Beureueh No.22, Telp. 22620 Banda Aceh, Kodepos 23121</p>

                        <h1 class="login-title"><i class="fas fa-key"></i> SIMUTASI Login Sistem</h1>

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>
                        <hr>
                        <form class="user" action="/auth/authenticate" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password" required>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center">
                                <div class="g-recaptcha" data-sitekey="6LepasoqAAAAAGbEhzC8fo_aolo1Jporb9biG24F"></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                        </form>
                        <hr>
                        <div class="info-link">
                            <i class="fas fa-history"></i>
                            <a href="/lacak-mutasi">Lacak usulan mutasi anda</a>
                        </div>
                        <div class="info-link">
                            <i class="fas fa-arrow-left"></i>
                            <a href="/">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    var passwordField = document.getElementById("password");
    var toggleButton = document.getElementById("togglePassword");
    var toggleIcon = toggleButton.querySelector("i");

    // Event saat tombol ditekan (tahan)
    toggleButton.addEventListener("mousedown", function() {
        passwordField.type = "text";
        toggleIcon.classList.remove("fa-eye");
        toggleIcon.classList.add("fa-eye-slash");
    });

    // Event saat tombol dilepas
    toggleButton.addEventListener("mouseup", function() {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    });

    // Event jika mouse keluar dari tombol, agar tetap aman
    toggleButton.addEventListener("mouseleave", function() {
        passwordField.type = "password";
        toggleIcon.classList.remove("fa-eye-slash");
        toggleIcon.classList.add("fa-eye");
    });
</script>