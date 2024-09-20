<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sekretariat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Link ke file CSS Anda -->
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

        .dropdown-menu .logout-btn {
            background-color: #e63946; /* Warna latar belakang merah gelap */
            color: #fff; /* Warna teks putih */
            border: none; /* Hapus border */
            font-weight: bold; /* Bold font */
            text-align: center; /* Center align text */
            border-radius: 5px; /* Rounded corners */
            padding: 10px; /* Padding for better appearance */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition */
        }

        .dropdown-menu .logout-btn:hover {
            background-color: #d62839; /* Warna latar belakang merah lebih gelap saat hover */
            color: #fff; /* Tetap putih saat hover */
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
        }

        /* Card Counter */
        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px;
            border-radius: 5px;
            transition: 0.3s ease;
            color: #ffffff;
        }

        .card-counter:hover {
            box-shadow: 2px 2px 15px #B0B0B0;
            transform: scale(1.05);
        }

        .card-counter.primary {
            background-color: #007bff;
        }

        .card-counter.success {
            background-color: #086756;
        }

        .card-counter.warning {
            background-color: #c49407fa;
        }

        /* Custom Styles */
        .navbar-brand img {
            width: 30px;
            height: 30px;
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

        .sidebar {
            background-color: #c0edf8;
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

        /* Tambahkan jarak antara navbar dan konten utama */
        .main-content {
            padding-top: 70px; /* Sesuaikan dengan tinggi navbar Anda */
        }
    </style>
</head>
<body>

<nav class="navbar-top">
    <a class="navbar-brand logo" href="#">
        <img src="path/to/logo.png" alt="Logo">
        <span>DocuArchive</span>
    </a>
    <div class="d-flex align-items-center">
        <div class="dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('img/user profile.png') }}" alt="Ikon User" class="rounded-circle" width="30" height="30">
                <span class="ms-2">User</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item logout-btn">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
            <ul class="nav flex-column">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/surat.png') }}" alt="Ikon Surat" width="24" height="24"> Surat
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarSuratDropdown">
                        <li><a class="dropdown-item" href="#">Surat Masuk</a></li>
                        <li><a class="dropdown-item" href="#">Surat Keluar</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{ asset('img/laporan.png') }}" alt="Ikon Laporan" width="24" height="24"> Laporan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="{{ asset('img/disposisi.png') }}" alt="Ikon Disposisi" width="24" height="24"> Disposisi
                    </a>
                </li>
            </ul>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-4 main-content">
            <div class="card-main">
                <h3 class="mt-4">Selamat Datang Di Dashboard Sekretariat</h3>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-counter primary">
                            <h5>Surat Masuk</h5>
                            <p>{{ $surat_masuk_count }} Surat</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-counter success">
                            <h5>Surat Keluar</h5>
                            <p>{{ $surat_keluar_count }} Surat</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-counter warning">
                            <h5>Disposisi Aktif</h5>
                            <p>{{ $disposisi_aktif_count }} Disposisi</p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h5>Aktivitas Terbaru</h5>
                    <ul class="list-group">
                        @foreach($aktivitas_terbaru as $aktivitas)
                            <li class="list-group-item">{{ $aktivitas }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
