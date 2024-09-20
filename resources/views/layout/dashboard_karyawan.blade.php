<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
/* Navbar Top */
.navbar-top {
    width: 100%;
    background: linear-gradient(90deg, #005f73, #0096c7); /* Sama dengan Sidebar */
    padding: 10px 20px;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    z-index: 1000;
    height: 60px;
    border-bottom: 2px solid #003f4c; /* Sama dengan Sidebar */
    box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Bayangan Halus */
}

.navbar-top .logo {
    display: flex;
    align-items: center;
    color: #ffffff; /* Warna teks putih */
    font-weight: bold;
}

.navbar-top .logo img {
    width: 40px;
    margin-right: 10px;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Bayangan logo */
}

.navbar-top .logo span {
    font-size: 20px;
}

.navbar-top .people-icon {
    position: relative;
    display: flex;
    align-items: center;
    font-size: 24px;
    color: #ffffff; /* Warna icon putih */
    cursor: pointer;
}

/* Sidebar */
.sidebar {
    width: 200px;
    background: linear-gradient(90deg, #005f73, #0096c7); /* Gradient Sidebar */
    height: 100vh;
    padding: 70px 10px 20px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-top: 60px;
    border-right: 2px solid #003f4c; /* Sama dengan Navbar */
    box-shadow: 4px 0 6px rgba(0,0,0,0.1); /* Bayangan Sidebar */
}

.sidebar a {
    text-decoration: none;
    color: #ffffff; /* Teks putih */
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
    background-color: #003f4c; /* Warna hover sidebar lebih gelap */
    color: #ffffff;
    transform: scale(1.05); /* Sedikit membesar saat hover */
}


</style>

<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="30" height="24">
                DocuArchive
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
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Surat
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarSuratDropdown">
                                <li><a class="dropdown-item" href="surat/surat_masuk.html">Surat Masuk</a></li>
                                <li><a class="dropdown-item" href="surat/surat_keluar.html">Surat Keluar</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Disposisi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Notifikasi
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang Di Dashboard Karyawan</h1>
                </div>

                <!-- Statistik Singkat -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk</h5>
                                <p class="card-text">8 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Surat Keluar</h5>
                                <p class="card-text">5 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Disposisi Aktif</h5>
                                <p class="card-text">3 Disposisi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="card mb-4">
                    <div class="card-header">Aktivitas Terbaru</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Surat Masuk baru diterima pada tanggal 20 Agustus 2024.</li>
                            <li class="list-group-item">Disposisi baru diterima pada tanggal 18 Agustus 2024.</li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
