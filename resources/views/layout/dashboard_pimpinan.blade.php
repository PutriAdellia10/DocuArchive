<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pimpinan</title>
    <link rel="stylesheet" href="styles.css">
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
                        <li><a class="dropdown-item" href="#">Pengaturan Profil</a></li>
                        <li><a class="dropdown-item" href="#">Keluar</a></li>
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
                            <a class="nav-link active" aria-current="page" href="#">
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Disposisi
                            </a>
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
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Pimpinan</h1>
                </div>

                <!-- Statistik Singkat -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Surat Masuk</h5>
                                <p class="card-text">20 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Surat Keluar</h5>
                                <p class="card-text">10 Surat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Disposisi Aktif</h5>
                                <p class="card-text">5 Disposisi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Instansi Terkait</h5>
                                <p class="card-text">12 Instansi</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik dan Chart -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">Grafik Surat Masuk vs Surat Keluar</div>
                            <div class="card-body">
                                <canvas id="pimpinanChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">Distribusi Jenis Surat</div>
                            <div class="card-body">
                                <canvas id="pimpinanPieChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aktivitas Terbaru -->
                <div class="card mb-4">
                    <div class="card-header">Aktivitas Terbaru</div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Disposisi baru dibuat oleh Sekretariat pada tanggal 20 Agustus 2024.</li>
                            <li class="list-group-item">Surat Keluar dikirim pada tanggal 18 Agustus 2024.</li>
                        </ul>
                    </div>
                </div>

                <!-- Footer -->
                <footer class="pt-3 mt-4 text-muted text-center">
                    © 2024 Nama Perusahaan - Hak Cipta Dilindungi
                </footer>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('pimpinanChart').getContext('2d');
        const pimpinanChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'Surat Masuk',
                    data: [20, 15, 17, 18, 21, 22, 20],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }, {
                    label: 'Surat Keluar',
                    data: [10, 8, 9, 11, 12, 14, 10],
                    borderColor: 'rgb(255, 99, 132)',
                    tension: 0.1
                }]
            }
        });

        const ctxPie = document.getElementById('pimpinanPieChart').getContext('2d');
        const pimpinanPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Jenis A', 'Jenis B', 'Jenis C', 'Jenis D'],
                datasets: [{
                    label: 'Distribusi Jenis Surat',
                    data: [15, 25, 30, 30],
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
