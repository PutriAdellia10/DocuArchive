<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="logo.png" alt="Logo" width="30" height="24">
                DocuArchive
            </a>
            <div class="d-flex">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
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
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/admin.html">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSuratDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Surat
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarSuratDropdown">
                                <li><a class="dropdown-item" href="surat/surat_masuk.html">Surat Masuk</a></li>
                                <li><a class="dropdown-item" href="surat/surat_keluar.html">Surat Keluar</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarMasterDataDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Master Data
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarMasterDataDropdown">
                                <li><a class="dropdown-item" href="#">Jenis Surat</a></li>
                                <li><a class="dropdown-item" href="#">Template Surat</a></li>
                                <li><a class="dropdown-item" href="#">Sifat Surat</a></li>
                                <li><a class="dropdown-item" href="#">Instansi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarReportsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarReportsDropdown">
                                <li><a class="dropdown-item" href="#">Laporan Masuk</a></li>
                                <li><a class="dropdown-item" href="#">Laporan Keluar</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarSettingsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Pengaturan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarSettingsDropdown">
                                <li><a class="dropdown-item" href="#">Profil Perusahaan</a></li>
                                <li><a class="dropdown-item" href="#">Notifikasi</a></li>
                                <li><a class="dropdown-item" href="#">Manajemen User</a></li>
                                <li><a class="dropdown-item" href="#">Backup</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang Di Dashboard Admin</h1>
                </div>

                <!-- Statistik Singkat -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Surat Masuk</h5>
                                <p class="card-text">25 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Surat Keluar</h5>
                                <p class="card-text">15 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Disposisi</h5>
                                <p class="card-text">8 Disposisi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Instansi Terkait</h5>
                                <p class="card-text">10 Instansi</p>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Aktivitas Terbaru -->
                <div class="card mb-4">
                    <div class="card-header">Aktivitas Terbaru</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Pengguna A menambah surat baru pada tanggal 20 Agustus 2024.</li>
                            <li class="list-group-item">Surat Keluar dikirim ke Instansi B pada tanggal 18 Agustus 2024.</li>
                            <li class="list-group-item">Disposisi baru dibuat oleh Sekretariat pada tanggal 17 Agustus 2024.</li>
                        </ul>
                    </div>
                </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('adminChart').getContext('2d');
        const adminChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Surat Masuk',
                    data: [15, 10, 12, 14, 18, 20, 25],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Surat Keluar',
                    data: [5, 7, 9, 11, 14, 16, 15],
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }]
            }
        });

        const ctxPie = document.getElementById('adminPieChart').getContext('2d');
        const adminPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Jenis A', 'Jenis B', 'Jenis C', 'Jenis D'],
                datasets: [{
                    label: 'Distribusi Jenis Surat',
                    data: [10, 20, 30, 40],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)'
                    ]
                }]
            }
        });
    </script>
</body>

</html>
