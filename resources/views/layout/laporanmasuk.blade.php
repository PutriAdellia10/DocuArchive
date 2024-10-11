<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Laporan</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8; /* Light Blue Background */
            margin: 0;
            padding: 0;
        }

        .container {
            margin-left: 240px;

            padding: 80px 20px 20px;
        }

        /* Content Styles */
        .content {
            padding: 20px;
        }

        /* Header Styles */
        .header {
            background: linear-gradient(180deg, #90e0ef, #caf0f8); /* Gradient Header */
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #0077b6; /* Dark Blue Border */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Header Shadow */
        }

        .header img {
            width: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Logo Shadow */
        }

        .header h2 {
            margin: 0;
            padding-left: 10px;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        /* Button Styles */
        .btn {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
            text-align: center;
        }

        .btn:hover {
            background-color: #005f73; /* Darker Blue Hover */
            transform: scale(1.05); /* Slightly Enlarge on Hover */
        }

        .btn-cetak {
            background-color: #00b4d8; /* Light Blue Button */
        }

        .btn-cetak:hover {
            background-color: #0096c7; /* Darker Blue Hover */
        }

        /* Form Styles */
        .form-group-inline {
            display: flex;
            align-items: center;
            gap: 20px; /* Space between filters and buttons */
            margin-bottom: 20px;
        }

        .form-group-inline .form-group {
            margin: 0; /* Remove margin for inline layout */
        }

        .form-group-inline select {
            width: auto; /* Auto width for inline layout */
            padding: 8px; /* Adjust padding for consistency */
        }

        .form-buttons {
            display: flex;
            align-items: center;
            gap: 10px; /* Space between buttons */
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #90e0ef; /* Light Blue Border */
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Table Shadow */
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table-container th {
            background: linear-gradient(180deg, #0077b6, #00b4d8); /* Gradient Header */
            color: #ffffff; /* White Text */
            font-weight: bold;
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f1f1f1; /* Light Gray */
        }

        .table-container tbody tr:hover {
            background-color: #e0f7fa; /* Very Light Blue */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-top: 0;
                border-right: none;
                box-shadow: none;
            }

            .navbar-top {
                position: static;
                height: auto;
                border-bottom: none;
                box-shadow: none;
            }

            .container {
                margin-left: 0;
                padding: 20px;
            }
            @media print {
        body * {
            visibility: hidden; /* Sembunyikan semua elemen */
        }
        .table-container, .table-container * {
            visibility: visible; /* Tampilkan tabel dan isinya */
        }
        .table-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
    }
        }
    </style>
</head>
   <body>
    @include('components.navbar')

    @if(auth()->check())
    @if(auth()->user()->peran == 'Admin')
        @include('components.sidebaradmin')
    @elseif(auth()->user()->peran == 'Sekretariat')
        @include('components.sidebarpimdansekre')
    @elseif(auth()->user()->peran == 'Karyawan')
        @include('components.sidebarkaryawan')
    @elseif(auth()->user()->peran == 'Pimpinan')
        @include('components.sidebarpimdansekre')
    @else
        <p>Peran tidak dikenali.</p>
    @endif
@else
    <p>Anda belum login. Silakan login untuk melanjutkan.</p>
@endif

    <div class="container">
        <div class="header">
            <h2><i class="bi bi-file-earmark-text"></i>Laporan Surat Masuk</h2>
        </div>
            <div class="content">
                <form method="GET" action="{{ route('laporan.masuk') }}" id="filterForm">
                    <div class="form-group-inline">
                        <div class="form-group">
                            <label for="tanggal_awal">Tanggal Awal:</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                        </div>

                        <div class="form-group">
                            <label for="tanggal_akhir">Tanggal Akhir:</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                        </div>

                        <div class="form-buttons">
                            <button type="submit" class="btn">Tampilkan</button>
                            <button type="button" class="btn btn-cetak" id="cetakBtn">Cetak</button>
                        </div>
                    </div>
                </form>

                @if(request('tanggal_awal') && request('tanggal_akhir'))  <!-- Check if both dates are provided -->
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>No Agenda</th>
                                    <th>Tanggal</th>
                                    <th>Asal Surat</th>
                                    <th>No Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal</th>
                                    <th>Keterangan</th>
                                    <th>Sifat Surat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($surats as $surat)
                                    <tr>
                                        <td>{{ $surat->no_agenda }}</td>
                                        <td>{{ $surat->tanggal }}</td>
                                        <td>{{ $surat->instansi->nama_instansi }}</td>
                                        <td>{{ $surat->no_surat }}</td>
                                        <td>{{ $surat->tanggal_surat }}</td>
                                        <td>{{ $surat->perihal }}</td>
                                        <td>{{ $surat->konten }}</td>
                                        <td>{{ $surat->sifatSurat->nama_sifat }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p>Silakan pilih tanggal untuk melihat laporan.</p>  <!-- Message when dates are not set -->
                @endif
            </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Handle print button
    const cetakBtn = document.getElementById('cetakBtn');
    if (cetakBtn) {
        cetakBtn.addEventListener('click', function() {
            window.print();
        });
    }
});

    </script>
</body>
</html>
