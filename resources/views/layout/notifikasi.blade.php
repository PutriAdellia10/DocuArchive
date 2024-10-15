<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposisi Surat - Notifikasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .navbar-brand {
            color: #000 !important;
        }
        .sidebar-heading {
            font-size: 1.2rem;
            padding: 1rem;
            background-color: #343a40;
            color: #fff;
        }
        #sidebar-wrapper {
            min-height: 100vh;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }
        .list-group-item {
            color: #000;
        }
        .table {
            background-color: #fff;
        }
        .badge-danger {
            background-color: #dc3545;
        }
        .pdf-btn {
            display: flex;
            align-items: center;
        }
        .pdf-btn i {
            margin-right: 5px;
        }
        .dropdown-menu-right {
            right: 0;
            left: auto;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Disposisi Surat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inbox <span class="badge badge-danger">{{ Auth::user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                        @if(Auth::user()->unreadNotifications->count())
                            @foreach(Auth::user()->unreadNotifications as $notification)
                                <a class="dropdown-item" href="{{ route('disposisi.show', $notification->data['disposisi_id']) }}">
                                    {{ $notification->data['message'] }}
                                </a>
                            @endforeach
                        @else
                            <p class="dropdown-item">Tidak ada notifikasi</p>
                        @endif
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Arwan Prianto Mangidi</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light" id="sidebar-wrapper">
            <div class="sidebar-heading">Disposisi Surat</div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light">Home</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Surat Masuk</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Surat Keluar</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Data Pegawai</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mt-4">
            <h2>Notifikasi</h2>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengirim</th>
                        <th>No Surat</th>
                        <th>Tgl Surat</th>
                        <th>Disposisi</th>
                        <th>Lampran</th>
                        <th>Asal Surat</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $index => $notification)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $notification->data['pengirim'] }}</td>
                            <td>{{ $notification->data['no_surat'] }}</td>
                            <td>{{ $notification->data['tgl_surat'] }}</td>
                            <td>{{ implode(', ', $notification->data['disposisi']) }}</td>
                            <td>
                                <a href="{{ $notification->data['lampiran_url'] }}" class="btn btn-danger btn-sm pdf-btn">
                                    <i class="fa fa-file-pdf"></i> Preview
                                </a>
                            </td>
                            <td>{{ $notification->data['asal_surat'] }}</td>
                            <td>
                                <a href="{{ route('disposisi.show', $notification->data['disposisi_id']) }}" class="btn btn-primary btn-sm">
                                    Next Disposisi
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
