<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapitulasi</title>
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
            display: none; /* Hidden by default */
        }

        .table-container.show {
            display: block; /* Show when class added */
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
        }

        .table-container tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra Striping */
        }
    </style>
</head>
<body>
    @if(auth()->check())
    @if(auth()->user()->peran == 'Admin')
        @include('components.navbar')
    @elseif(auth()->user()->peran == 'Sekretariat')
        @include('components.navbarsekre')
    @elseif(auth()->user()->peran == 'Pimpinan')
        @include('components.navbarpim')
    @else
        <p>Peran tidak dikenali.</p>
    @endif

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

    <div class="container">
        <div class="header">
            <h2>Rekapitulasi Surat</h2>
        </div>
        <form method="GET" action="{{ url('/rekapitulasi') }}" id="rekapitulasiForm">
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <select name="tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        @for($i = 2020; $i <= 2030; $i++)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn">Tampil</button>
                    <a onclick="printTable()" class="btn btn-cetak">Cetak</a>
                </div>
            </div>
        </form>
        <div id="printSection">
            <h1 id="printTitle"> Laporan Surat - Tahun <span id="selectedYear">{{ request('tahun') }}</span></h1>
        <div id="tableContainer" class="table-container {{ $showTable ? 'show' : '' }}">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>bulan</th>
                        <th>Surat Masuk</th>
                        <th>Surat Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapitulasi as $index => $rekap)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rekap->bulan}}</td>
                            <td>{{ $rekap->total_surat_gabungan}}</td>
                            <td>{{ $rekap->total_surat_keluar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>

function updateTitle() {
    // Ambil nilai dari input tahun
    var selectedYear = document.getElementById('tahun').value;

    // Jika tahun tidak kosong, ubah judulnya
    if (selectedYear) {
        document.getElementById('selectedYear').innerText = selectedYear;
    } else {
        document.getElementById('selectedYear').innerText = 'Pilih Tahun';
    }
}

function printTable() {
    // Update judul sebelum cetak
    updateTitle();

    var printContents = document.getElementById('printSection').innerHTML;
    var originalContents = document.body.innerHTML;

    // Cetak hanya konten yang diinginkan
    document.body.innerHTML = "<html><head><title>" + document.getElementById('printTitle').innerText + "</title></head><body>" + printContents + "</body></html>";

    window.print();

    // Kembalikan tampilan seperti semula
    document.body.innerHTML = originalContents;
}

        document.getElementById('rekapitulasiForm').addEventListener('submit', function() {
            document.getElementById('tableContainer').classList.add('show');
        });
        document.getElementById('rekapitulasiForm').addEventListener('submit', function() {
    const tahunSelect = document.getElementById('tahun');
    const tableContainer = document.getElementById('tableContainer');

    if (tahunSelect.value === '') {
        tableContainer.classList.remove('show'); // Menyembunyikan tabel jika tahun belum dipilih
        event.preventDefault(); // Mencegah formulir dikirim jika tidak ada tahun yang dipilih
    } else {
        tableContainer.classList.add('show');
    }
});

    </script>
</body>
</html>
