<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMUTASI - Sistem Informasi Mutasi Guru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            background: linear-gradient(135deg, #4a90e2, #6a11cb);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 85%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .container:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .logo {
            width: 90px;
            margin-bottom: 5px; /* Jarak antara logo dan header instansi dikurangi */
        }
        .header-text {
            font-size: 18px;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 5px; /* Jarak dengan "Selamat Datang di SIMUTASI" diperbesar */
        }
        .header-alamat {
            font-size: 12px;
            line-height: 0.8;
            margin-bottom: 20px; /* Jarak dengan "Selamat Datang di SIMUTASI" diperbesar */
        }
        h1 {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 60px;
            flex-wrap: wrap;
        }
        .btn {
            padding: 12px 20px;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .btn i {
            margin-right: 8px;
        }
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        .btn-primary:hover {
            background: #2563eb;
            transform: scale(1.05);
        }
        .btn-secondary {
            background: #10B981;
            color: white;
        }
        .btn-secondary:hover {
            background: #059669;
            transform: scale(1.05);
        }

        /* Responsif */
        @media (max-width: 768px) {
            .container {
                max-width: 95%;
                padding: 25px;
            }
            h1 {
                font-size: 1.5rem;
            }
            .btn {
                font-size: 0.9rem;
                padding: 10px 16px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="/assets/img/logo.png" alt="SIMUTASI Logo" class="logo">
        <p class="header-text">
            <strong>PEMERINTAH ACEH</strong><br>
            <strong>DINAS PENDIDIKAN</strong></p>
        <p class="header-alamat">
            Jl. Tgk. Mohd. Daud Beureueh No.22, Telp. 22620 Banda Aceh, Kodepos 23121
        </p>
        <h1>Selamat Datang di SIMUTASI</h1>
        <p>Sistem Informasi Mutasi Guru - Pemerintah Aceh</p>
        
        <div class="buttons">
            <a href="/login" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</a>
            <a href="/lacak-mutasi" class="btn btn-secondary"><i class="fas fa-search"></i> Lacak Status</a>
        </div>
    </div>

</body>
</html>
