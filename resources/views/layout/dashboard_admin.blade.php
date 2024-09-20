<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar Top */
        .navbar-top {
            width: 100%;
            background: linear-gradient(90deg, #005f73, #0096c7); /* Gradient Navbar */
            padding: 10px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
            height: 60px;
            border-bottom: 2px solid #003f4c; /* Darker Blue Border */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Subtle Shadow */
        }

        .navbar-top .logo {
            display: flex;
            align-items: center;
            color: #ffffff; /* White Text */
            font-weight: bold;
        }

        .navbar-top .logo img {
            width: 40px;
            margin-right: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Logo Shadow */
        }

        .navbar-top .logo span {
            font-size: 20px;
        }

        .navbar-top .people-icon {
            position: relative;
            display: flex;
            align-items: center;
            font-size: 24px;
            color: #ffffff; /* White Icon Color */
            cursor: pointer;
        }

        .dropdown-item.logout-btn {
            background-color: #28adc5;
            color: #fff;
            border: none;
            font-weight: bold;
            text-align: center;
            border-radius: 5px;
            padding: 10px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-item.logout-btn:hover {
            background-color: #2ad4f1;
            color: #fff;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background: linear-gradient(90deg, #005f73, #0096c7); /* Gradient Sidebar Sesuai Navbar Top */
            height: 100vh;
            padding: 70px 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 60px;
            border-right: 2px solid #003f4c; /* Darker Blue Border */
            box-shadow: 4px 0 6px rgba(0,0,0,0.1); /* Sidebar Shadow */
        }

        .sidebar a {
            text-decoration: none;
            color: #ffffff; /* White Text */
            margin: 10px 0;
            text-align: left;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #003f4c; /* Darker Blue Hover */
            color: #ffffff; /* White Text */
            transform: scale(1.05); /* Slightly scale up on hover */
        }

        /* Main content */
        main {
            margin-left: 220px; /* Geser konten utama agar tidak tertutup sidebar */
            padding-top: 70px; /* Memberikan ruang di atas untuk menghindari tumpang tindih dengan navbar */
        }

        /* Main content cards */
        .card {
            border: none; /* Hapus border */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sedikit bayangan */
        }

        .card-header {
            background-color: #20B2AA; /* Warna biru toska lebih gelap untuk header */
            color: #ffffff;
        }

        .card-body {
            color: #ffffff; /* Warna teks putih */
        }

        /* Kartu Statistik */
        .card-total-masuk {
            background-color: #4CAF50; /* Hijau */
        }

        .card-total-keluar {
            background-color: #4dc000; /* Oranye */
        }

        .card-jumlah-disposisi {
            background-color: #113496; /* Biru */
        }

        .card-instansi-terkait {
            background-color: #27af5b; /* Merah */
        }

        /* Responsive cards layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .col-md-3 {
            flex: 1 1 calc(25% - 1rem); /* Responsive card width */
        }

        /* Welcome Card */
        .welcome-card {
            margin-bottom: 20px;
        }

        .welcome-text {
            font-size: 24px;
            font-weight: bold;
            color: #333; /* Warna teks */
        }

        /* Card Biru Toska untuk Konten Main */
        .card-main {
            background-color: #8ad1ce; /* Warna Biru Toska */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Subtle Shadow */
            color: #ffffff; /* Warna Teks Putih */
            width: 100%; /* Mengisi lebar kontainer */
            min-height: 500px; /* Menjaga tinggi minimal card */
            box-sizing: border-box; /* Agar padding dan border tidak mempengaruhi lebar total */
        }
    </style>
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light navbar-top">
        <div class="container-fluid">
            <a class="navbar-brand logo" href="#">
                <img src="img/logo.jpg" alt="Logo">
                <span>DocuArchive</span>
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/user profile.png') }}" alt="Ikon User" class="rounded-circle" width="30" height="30">
                        <span class="ms-2">User</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Pengaturan Profil -->
                        <li><a class="dropdown-item" href="{{ route('user.profil') }}">Pengaturan Profil</a></li>
                        <!-- Logout -->
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item logout-btn">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/surat.png" alt="Ikon Surat" width="24" height="24"> Surat
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarSuratDropdown">
                            <li><a class="dropdown-item" href="#">Surat Masuk</a></li>
                            <li><a class="dropdown-item" href="#">Surat Keluar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="img/laporan.png" alt="Ikon Laporan" width="24" height="24"> Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="img/disposisi.png" alt="Ikon Disposisi" width="24" height="24"> Disposisi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="img/master.png" alt="Ikon Master" width="24" height="24"> Master
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <img src="img/instansi.png" alt="Ikon Instansi" width="24" height="24"> Instansi
                        </a>
                    </li>
                </ul>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
                <div class="container">
                    <!-- Combined Card -->
                    <div class="card mb-4">
                        <div class="card-main">
                            <!-- Welcome Message -->
                            <h1 class="welcome-text">Selamat Datang di Dashboard Admin</h1>
                            <hr>
                            <!-- Statistics -->
                            <div class="row mb-4">
                                <!-- Total Surat Masuk -->
                                <div class="col-md-3">
                                    <div class="card text-white card-total-masuk mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Surat Masuk</h5>
                                            <p class="card-text">25 Surat</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Total Surat Keluar -->
                                <div class="col-md-3">
                                    <div class="card text-white card-total-keluar mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Total Surat Keluar</h5>
                                            <p class="card-text">15 Surat</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Jumlah Disposisi -->
                                <div class="col-md-3">
                                    <div class="card text-white card-jumlah-disposisi mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Jumlah Disposisi</h5>
                                            <p class="card-text">8 Disposisi</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Instansi Terkait -->
                                <div class="col-md-3">
                                    <div class="card text-white card-instansi-terkait mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Instansi Terkait</h5>
                                            <p class="card-text">10 Instansi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Recent Activities -->
                            <div class="card">
                                <div class="card-header">Aktivitas Terbaru</div>
                                <div class="card-main">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Pengguna A menambah surat baru pada tanggal 20 Agustus 2024.</li>
                                        <li class="list-group-item">Surat Keluar dikirim ke Instansi B pada tanggal 18 Agustus 2024.</li>
                                        <li class="list-group-item">Disposisi baru dibuat oleh Sekretariat pada tanggal 17 Agustus 2024.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
