<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Admin</title>
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
            background-color: #f0f4f8;
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
            padding-top: 60px;
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
        .card-icon {
            font-size: 50px;
            color: #00b4d8;
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
        }
        .card-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            gap: 20px;
        }
        .recent-activities, .notifications, .statistik-disposisi {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            flex: 1; /* Ensure equal width */
        }
        .recent-activities h5, .notifications h5, .statistik-disposisi h5 {
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
            white-space: nowrap;
        }
    </style>
</head>
<body>
    @include('components.navbar')
    @include('components.sidebaradmin')
    <div class="content">
        <div class="header" style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 20px;">
            <h1 class="h2" style="margin: 0; font-size: 40px; color: #0077b6; margin: 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Dashboard Admin</h1>
            <div class="welcome-section" style="display: flex; align-items: center; margin-top: 10px;">
                <img src="{{ asset('img/bg3.jpg') }}" alt="Welcome" style="margin-right: 40px; border-radius: 10px; width: 500px; height: auto;">
                <div style="margin-left: 90px;">
                    <h3 style="font-size: 40px; color: #0077b6; margin: 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Selamat Datang di DocuArchive</h3>
                    <p style="font-size: 30px; color: #0077b6; margin: 5px 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Atur dan Arsipkan Dokumen</p>
                    <p style="font-size: 30px; color: #0077b6; margin: 5px 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Anda dengan Mudah dan Aman</p>
                    <div class="button-container" style="margin-top: 10px; display: flex; justify-content: flex-start; gap: 10px;">
                        <a href="{{ route('surat.index') }}" class="btn btn-primary" style="padding: 10px 20px; border-radius: 5px; text-decoration: none; color: #fff; background-color: #0077b6;">Surat Masuk</a>
                        <a href="{{ route('surat.keluar.index') }}" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 5px; text-decoration: none; color: #fff; background-color: #00b4d8;">Surat Keluar</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="statistics">
            <div class="card">
                <h5>Total Surat Masuk</h5>
                <p>{{ $total_surat_gabungan }}</p>
                <i class="fas fa-envelope card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Surat Keluar</h5>
                <p>{{ $totalSuratKeluarSelesai }}</p>
                <i class="fas fa-paper-plane card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Surat</h5>
                <p>{{$totalSuratPerTahun}}</p>
                <i class="fas fa-calendar-alt card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Instansi</h5>
                <p>{{ $totalInstansi }}</p>
                <i class="fas fa-building card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Disposisi Aktif</h5>
                <p>10</p>
                <i class="bi bi-file-earmark-check-fill card-icon"></i>
            </div>
        </div>
        <div class="card-container">
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
            <div class="statistik-disposisi">
                <h5>Statistik Waktu Disposisi</h5>
                <div class="mb-4">
                    <h6>Rata-rata Waktu Disposisi</h6>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>
                    <p>Rata-rata waktu disposisi: <strong>2 jam 30 menit</strong></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Perihal Surat</th>
                                <th>Tanggal Disposisi</th>
                                <th>Waktu Penyelesaian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disposisiData as $index => $disposisi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $disposisi->surat_id }}</td>
                                    <td>{{ date('d-m-Y', strtotime($disposisi->created_at)) }}</td>
                                    <td>{{ $disposisi->waktu_penyelesaian ?? 'Belum Selesai' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
