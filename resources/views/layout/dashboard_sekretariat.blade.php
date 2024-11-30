<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Administrasi</title>
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

        .statistik-disposisi {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
    max-width: 100%;
    box-sizing: border-box; /* Memastikan padding termasuk dalam width */
}

.statistik-disposisi h5 {
    font-size: 1.5em;
    color: #0077b6;
    border-bottom: 2px solid #0077b6;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.statistik-disposisi h6 {
    font-size: 1.2em;
    color: #264653;
}

.progress {
    height: 20px;
    background-color: #e9ecef;
    border-radius: 5px;
    overflow: hidden;
}

.progress-bar {
    text-align: center;
    line-height: 20px;
    font-size: 0.9em;
    color: #ffffff;
}

.progress-bar.bg-success {
    background-color: #00b4d8;
}

p {
    font-size: 1em;
    color: #6c757d;
    margin-bottom: 10px;
}

/* Table */
.table-responsive {
    margin-top: 20px;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin: 10px 0;
}

.table th,
.table td {
    text-align: left;
    padding: 10px;
    border: 1px solid #dee2e6;
}

.table th {
    background-color: #00b4d8;
    color: #ffffff;
    font-weight: bold;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}

.table-hover tbody tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

.table-dark {
    background-color: #264653;
    color: #ffffff;
}

.table-dark th {
    border-color: #2a9d8f;
}

/* Responsive Design */
@media (max-width: 768px) {
    .statistik-disposisi {
        padding: 15px;
    }

    .table {
        font-size: 0.9em;
    }
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
        .activity-list {
    list-style-type: none; /* Menghilangkan bullet points jika diperlukan */
    padding: 0; /* Menghapus padding bawaan */
    margin: 0; /* Menghapus margin bawaan */
    text-align: left; /* Memastikan teks sejajar ke kiri */
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
    @include('components.navbarsekre')
    @include('components.sidebarsekre')
    <div class="content">
        <div class="header" style="display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 20px;">
            <h1 class="h2" style="margin: 0; font-size: 40px; color: #0077b6; margin: 0; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Dashboard Bagian Administrasi</h1>
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
                <h5>Total Surat Masuk Selesai</h5>
                <p>{{ $total_surat_gabungan }}</p>
                <i class="fas fa-envelope card-icon"></i>
            </div>
            <div class="card">
                <h5>Total Surat Keluar Selesai</h5>
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
                <p>{{ $totalDisposisiAktif }}</p>
                <i class="bi bi-file-earmark-check-fill card-icon"></i>
            </div>
        </div>
        <div class="card-container">
            <!-- Recent Surat Masuk -->
            <div class="recent-activities card">
                <h5 class="card-title">Recent Surat Masuk</h5>
                <ul class="activity-list">
                    @forelse($recentGabungan as $suratmasuk)
                    <li class="activity-item">
                        <span class="activity-description">
                            Surat Masuk dari
                            @if($suratmasuk->pengirim_eksternal)
                            <strong>{{ $suratmasuk->pengirim_eksternal }} </strong>
                        @else
                           <strong> {{ $suratmasuk->pengirim->jabatan }}</strong>
                        @endif
                        </span>
                        <time class="activity-time">{{ $suratmasuk->created_at->format('d-m-Y H:i') }}</time>
                    </li>
                    @empty
                        <li class="activity-item">
                            <span class="no-activities">Tidak ada surat masuk terbaru</span>
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Recent Surat Keluar -->
            <div class="recent-activities card">
                <h5 class="card-title">Recent Surat Keluar</h5>
                <ul class="activity-list">
                    @forelse($recentSurat as $suratkeluar)
        <li class="activity-item">
            <span class="activity-description">
                Surat Keluar ke
                @if($suratkeluar->tujuan_pengguna_id)
                <strong>{{ $suratkeluar->tujuanPengguna->jabatan ?? 'Pengguna Tidak Diketahui' }}</strong>
            @elseif($suratkeluar->tujuan_instansi_id)
                <strong>{{ $suratkeluar->tujuanInstansi->nama_instansi ?? 'Instansi Tidak Diketahui' }}</strong>
            @else
                <strong>Tidak Ada Tujuan</strong>
            @endif
        </span>
            <time class="activity-time">{{ \Carbon\Carbon::parse($suratkeluar->created_at)->format('d-m-Y H:i') }}</time>
        </li>
        @empty
        <li class="activity-item">
            <span class="no-activities">Tidak ada surat keluar terbaru</span>
        </li>
        @endforelse
                </ul>
            </div>
        </div>
            <div class="statistik-disposisi">
                <h5>Statistik Waktu Disposisi</h5>
                <div class="mb-4">
                    <h6>Rata-rata Waktu Penyelesaian</h6>
                    <div class="progress mb-2">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">{{$persenPenyelesaianFormat}}</div>
                    </div>
                    <p>Rata-rata waktu penyelesaiian: <strong>{{$rataWaktuPenyelesaian}}</strong></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                                <th>Tanggal Disposisi</th>
                                <th>Waktu Penyelesaian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($disposisiData as $index => $disposisi)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $disposisi->perihal }}</td> <!-- Menampilkan perihal surat -->
                                    <td>{{ $disposisi->pimpinan_updated_at ? \Carbon\Carbon::parse($disposisi->pimpinan_updated_at)->format('d-m-Y') : 'Belum Disposisi' }}</td>
                                    <td>{{ $disposisi->waktu_penyelesaian }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</body>
</html>
