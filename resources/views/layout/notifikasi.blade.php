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

    <div class="container mt-5">
        <h4>Notifikasi</h4>
        <ul class="list-group">
            @forelse($notifikasi as $notif)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>
                        {{ $notif->pesan }}
                        <small class="text-muted d-block">{{ $notif->dibuat_pada->diffForHumans() }}</small>
                    </span>
                    <div>
                        @if(!$notif->sudah_dibaca)
                            <a href="{{ route('notifikasi.markAsRead', $notif->id) }}" class="btn btn-sm btn-success">
                                Tandai sebagai dibaca
                            </a>
                        @else
                            <span class="badge badge-secondary">Dibaca</span>
                        @endif
                    </div>
                </li>
            @empty
                <li class="list-group-item">Tidak ada notifikasi</li>
            @endforelse
        </ul>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
