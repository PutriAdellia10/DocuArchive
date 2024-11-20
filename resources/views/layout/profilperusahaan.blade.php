<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #d4f1f4;
            font-family: Arial, sans-serif;
            margin: 0;
        }
        .content-wrapper {
            margin-left: 300px;
            margin-top: 60px; /* Adjusted for top navbar height */
            padding: 20px;
        }

        .card {
            background-color: #d4f1f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #00b4d8;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            color: black;
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #00b4d8;
            border-radius: 8px;
            background-color: #e9f1f7;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #00b4d8;
            padding: 10px;
            text-align: left;
        }

        .table-container th {
            background-color: #00b4d8;
            color: black;
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f1f1f1; /* Light Gray */
        }

        .table-container tbody tr:hover {
            background-color: #e0f7fa; /* Very Light Blue */
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #00b4d8;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .pagination button {
            background-color: #00b4d8;
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: rgb(3, 3, 3);
            margin-left: 5px;
        }

        .pagination button:disabled {
            background-color: #33a393;
        }

        .modal-content {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

    @include('components.navbar')

    @if(auth()->check())
        @if(auth()->user()->peran == 'Admin')
            @include('components.sidebaradmin')
        @elseif(auth()->user()->peran == 'Sekretariat')
            @include('components.sidebarsekre')
        @elseif(auth()->user()->peran == 'Karyawan')
            @include('components.sidebarkaryawan')
        @elseif(auth()->user()->peran == 'Pimpinan')
            @include('components.sidebarpim')
        @else
            <p>Peran tidak dikenali.</p>
        @endif
    @else
        <p>Anda belum login. Silakan login untuk melanjutkan.</p>
    @endif

    <div class="content-wrapper">
        <div class="center-card">
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="bi bi-house-door"></i> Profil Perusahaan
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

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
                                    <td>{{ $perusahaan->telepon }}</td>
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
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editProfilModal">
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
                <div class="modal-header">
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
                            <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $perusahaan->telepon }}">
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
    <script>
        const myModal = new bootstrap.Modal(document.getElementById('editProfilModal'), {
            keyboard: false
        });
    </script>
</body>
</html>
