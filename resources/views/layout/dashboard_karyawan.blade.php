<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Karyawan</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8; /* Light background */
            margin: 0;
            padding: 0;
        }
        .content {
            margin-left: 240px;
            padding: 80px 20px 20px;
        }

        .header {
            background: linear-gradient(180deg, #90e0ef, #caf0f8);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #0077b6;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .header img {
            width: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .header h2 {
            margin: 0;
            padding-left: 10px;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .statistics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.card {
    background-color: #ffffff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    overflow: hidden;
    padding-top: 60px; /* Ruang untuk icon */
}

.card h5 {
    font-size: 18px;
    color: #0077b6;
    margin-bottom: 10px;
    font-weight: bold;
}

.card p {
    font-size: 24px;
    font-weight: bold;
    margin: 0;
    color: #333;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Icon centered on top */
.card-icon {
    font-size: 50px;
    color: #00b4d8;
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%); /* Menggeser icon ke tengah */
}


    /* Container for Recent Activities and Notifications */
.card-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

/* Container for Recent Activities and Notifications */
.card-container {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

/* Recent Activities and Notifications */
.recent-activities, .notifications {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    width: 48%; /* Adjust width to fit side by side */
    margin-right: 20px; /* Add right margin to the first card */
}

.notifications {
    margin-right: 0; /* No margin on the rightmost card */
}

.recent-activities h5, .notifications h5 {
    margin: 0 0 10px 0;
    font-weight: bold;
}

.activity-list li {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f1f1f1;
}

.activity-list li span {
    flex-grow: 1;
    margin-right: 10px;
}

.activity-list li time {
    color: #030303;
    white-space: nowrap; /* Pastikan tanggal tidak terpotong */
}

    </style>
</head>
<body>
    @include('components.navbarkaryawan')
    @include('components.sidebarkaryawan')

    <div class="content">
        <div class="header" style="display: flex; flex-direction: column; align-items: flex-start;">
            <h1 class="h2" style="margin: 0; font-size: 40px; color: #0077b6; margin: 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Dashboard Karyawan</h1>
            <div class="welcome-section" style="display: flex; align-items: center; margin-top: 10px;">
                <img src="{{ asset('img/bg3.jpg') }}" alt="Welcome" style="margin-right: 40px; border-radius: 10px; width: 500px; height: auto;">
                <div style="margin-left: 90px;">
                    <h3 style="font-size: 40px; color: #0077b6; margin: 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Selamat Datang di DocuArchive</h3>
                    <p style="font-size: 30px; color: #0077b6; margin: 5px 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Atur dan Arsipkan Dokumen</p>
                    <p style="font-size: 30px; color: #0077b6; margin: 5px 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Anda dengan Mudah dan Aman</p>

                    <!-- Buttons for Surat Masuk and Surat Keluar -->
                    <div class="button-container" style="margin-top: 10px; display: flex; justify-content: flex-start; gap: 10px;">
                        <a href="{{ route('surat.index') }}" class="btn btn-primary" style="padding: 10px 20px; border-radius: 5px; text-decoration: none; color: #fff; background-color: #0077b6;">Surat Masuk</a>
                        <a href="{{ route('surat.keluar.index')}}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; text-decoration: none; color: #fff; background-color: #00b4d8;">Surat Keluar</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="statistics">
            <div class="card">
                <h5>Total Surat Masuk</h5>
                <p>{{ $totalSuratMasuk }}</p>
                <i class="fas fa-envelope card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Surat Keluar</h5>
                <p>{{ $totalSuratKeluar }}</p>
                <i class="fas fa-paper-plane card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Disposisi Aktif</h5>
                <p>10</p>
                <i class="bi bi-file-earmark-check-fill card-icon"></i>
            </div>
        </div>

       <!-- Container for Recent Activities and Notifications -->
<div class="card-container">
    <!-- Recent Activities -->
    <div class="recent-activities">
        <h5>Recent Activities</h5>
        <ul class="activity-list">
            @forelse($recentSuratMasuk as $suratmasuk)
            <li>
                <span>Surat Masuk dari {{ $suratmasuk->instansi ? $suratmasuk->instansi->nama_instansi : 'Instansi Tidak Diketahui' }}</span>
                <time>{{ $suratmasuk->created_at->format('d-m-Y H:i') }}</time>
            </li>
        @empty
            <li><span>Tidak ada surat masuk terbaru</span></li>
        @endforelse
        </ul>
    </div>

    <!-- Notifications -->
    <div class="notifications">
        <h5>Notifications</h5>
        <ul class="notification-list">
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

</body>
</html>
