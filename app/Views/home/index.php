<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUTASI - Sistem Informasi Mutasi Guru</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AOS (Animation On Scroll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="/assets/css/simutasi-landingpage.css">
</head>
<body>

    <!-- Navbar -->
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top shadow">
    <div class="container d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="/assets/img/dinas-pendidikan-aceh.png" alt="Logo Instansi" width="120" height="40" class="me-2">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i> Masuk</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section">
    <h1 class="hero-title" data-aos="fade-up">Sistem Informasi Mutasi Guru</h1>
    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="200">
        Mengelola proses mutasi guru dengan cepat, transparan, dan efisien.
    </p>
    <div class="mt-4">
        <a href="/lacak-mutasi" class="btn btn-main" data-aos="fade-up" data-aos-delay="400">
            <i class="fas fa-search"></i> Lacak Usulan
        </a>
    </div>
</div>

    <!-- Fitur -->
<!-- Fitur -->
<div class="container features" id="features">
    <div class="row">
        <!-- Integrasi Data -->
        <div class="col-md-4" data-aos="zoom-in">
            <div class="feature-box">
                <i class="fas fa-database"></i>
                <h4>Integrasi Data</h4>
                <p>Pengelolaan data mutasi guru terintegrasi, memastikan validasi cepat dan akurat.</p>
            </div>
        </div>

        <!-- Transparansi -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-box">
                <i class="fas fa-balance-scale"></i>
                <h4>Transparansi</h4>
                <p>Proses mutasi terdokumentasi dengan jelas, meminimalisir kesalahan administrasi.</p>
            </div>
        </div>

        <!-- Pelaporan -->
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="feature-box">
                <i class="fas fa-chart-line"></i>
                <h4>Pelaporan</h4>
                <p>Setiap tahapan mutasi dapat dipantau secara real-time oleh guru.</p>
            </div>
        </div>
    </div>
</div>


<!-- FAQ -->
<div class="container faq" id="faq">
    <h2 class="text-center mb-4">Pertanyaan Umum</h2>
    <div class="accordion" id="faqAccordion">

        <!-- Pertanyaan 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                    <i class="fas fa-question-circle me-2"></i> Bagaimana cara mengajukan mutasi?
                </button>
            </h2>
            <div id="faq1" class="accordion-collapse collapse show">
                <div class="accordion-body">
                    Guru dapat mengajukan mutasi melalui sistem online yang telah disediakan.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                    <i class="fas fa-file-alt me-2"></i> Apa saja syarat yang harus dipenuhi untuk mengajukan mutasi?
                </button>
            </h2>
            <div id="faq2" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Beberapa syarat umum termasuk masa kerja minimal, surat rekomendasi, dan persetujuan dari instansi terkait.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                    <i class="fas fa-clock me-2"></i> Berapa lama proses mutasi biasanya berlangsung?
                </button>
            </h2>
            <div id="faq3" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Waktu pemrosesan mutasi dapat bervariasi tergantung pada verifikasi dokumen dan persetujuan dari pihak terkait, biasanya antara 1 hingga 3 bulan.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                    <i class="fas fa-search me-2"></i> Bagaimana cara melacak status mutasi saya?
                </button>
            </h2>
            <div id="faq4" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Anda dapat menggunakan fitur <strong>"Lacak Usulan"</strong> di halaman utama untuk melihat status pengajuan mutasi Anda.
                </div>
            </div>
        </div>

        <!-- Pertanyaan 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                    <i class="fas fa-phone me-2"></i> Siapa yang dapat saya hubungi jika ada masalah dengan pengajuan mutasi?
                </button>
            </h2>
            <div id="faq5" class="accordion-collapse collapse">
                <div class="accordion-body">
                    Anda dapat menghubungi pihak admin dinas pendidikan melalui email atau kontak yang tersedia di halaman <strong>Kontak</strong>.
                </div>
            </div>
        </div>

    </div>
</div>

<div class="footer">
    <p>© 2025 SIMUTASI | Dinas Pendidikan Aceh</p>
    <div class="footer-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>

    <!-- Bootstrap & AOS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>
