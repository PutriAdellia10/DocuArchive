<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sekretariat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px;
            background-color: #00179c;
            height: 100px;
            border-radius: 5px;
            transition: 0.3s ease;
        }

        .card-counter:hover {
            box-shadow: 2px 2px 15px #B0B0B0;
            transform: scale(1.05);
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #086756;
            color: #FFF;
        }

        .card-counter.warning {
            background-color: #c49407fa;
            color: #FFF;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="path/to/logo.png" alt="Logo" width="30" height="30">
            DochuArchive
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 bg-light">
            <nav class="nav flex-column">
                <a class="nav-link active" href="#">Dashboard</a>
                <a class="nav-link" href="#">Surat</a>
                <a class="nav-link" href="#">Disposisi</a>
                <a class="nav-link" href="#">Laporan</a>
            </nav>
        </div>

        <div class="col-md-10">
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
