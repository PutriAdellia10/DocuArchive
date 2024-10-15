<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d1e7dd;
        }

        .sidebar {
            background-color: #b1d1cd;
            height: 100vh;
            padding-top: 20px;
        }

        .sidebar .list-group-item {
            background-color: #b1d1cd;
            color: #333;
        }

        .sidebar .list-group-item:hover {
            background-color: #91c1b5;
            color: #fff;
        }

        .card-header {
            background-color: #a0d3d1;
            color: #333;
            font-size: 18px;
        }

        .table th, .table td {
            border: none;
            padding: 10px;
        }

        .table th {
            width: 150px;
        }

        .btn-primary {
            background-color: #6c757d;
            border: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
        }

        .navbar {
            background-color: #b1d1cd;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .modal-header {
            background-color: #a0d3d1;
        }

        .modal-content {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('logo.png') }}" alt="Logo" style="width: 30px;">
                Docu Archive
            </a>
            <div class="d-flex">
                <button class="btn btn-outline-dark">
                    <i class="bi bi-person"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar">
                <div class="list-group">
                    <a href="#" class="list-group-item active"><i class="bi bi-house"></i> Dashboard</a>
                    <a href="#" class="list-group-item"><i class="bi bi-file-earmark-text"></i> Surat</a>
                    <a href="#" class="list-group-item"><i class="bi bi-file-bar-graph"></i> Laporan</a>
                    <a href="#" class="list-group-item"><i class="bi bi-envelope"></i> Template Surat</a>
                    <a href="#" class="list-group-item"><i class="bi bi-building"></i> Instansi</a>
                    <a href="#" class="list-group-item"><i class="bi bi-gear"></i> Pengaturan</a>
                </div>
            </div>

<!-- Main Content -->
<div class="col-md-9">
    <div class="card mt-4">
        <div class="card-header">
            <i class="bi bi-house-door"></i> Profil Perusahaan
        </div>
        <div class="card-body">
            <!-- Tampilkan pesan sukses jika ada -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tampilkan error validasi jika ada -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($perusahaan)
                <table class="table">
                    <tr>
                        <th>Nama Perusahaan</th>
                        <td>{{ $perusahaan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $perusahaan->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Telepon</th>
                        <td>{{ $perusahaan->kontak }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $perusahaan->email ?? 'Tidak tersedia' }}</td>
                    </tr>
                    <tr>
                        <th>Logo</th>
                        <td>
                            @if($perusahaan->logo)
                                <img src="{{ asset('img/logo.jpg') }}" alt="Logo" style="width: 100px;">
                            @else
                                Tidak tersedia
                            @endif
                        </td>
                    </tr>
                </table>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                    Ubah
                </button>
            @else
                <p>Data perusahaan tidak tersedia.</p>
            @endif
        </div>
    </div>
</div>
</div>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header" style="background-color: #a0d3d1;">
        <h5 class="modal-title" id="editProfilModalLabel">Ubah Profil Perusahaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form action="{{ route('profilperusahaan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Perusahaan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ $perusahaan->nama }}">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $perusahaan->alamat }}">
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $perusahaan->kontak }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $perusahaan->email }}">
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo Perusahaan</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
