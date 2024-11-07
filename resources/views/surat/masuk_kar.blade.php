<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Masuk</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8; /* Light Blue Background */
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 240px;
            padding: 80px 20px 20px;
        }

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

        .add-button {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 150px;
            color: white;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .add-button:hover {
            background-color: #005f73; /* Darker Blue Hover */
            transform: scale(1.05); /* Slightly Enlarge on Hover */
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

        .actions i {
            width: 20px;
            cursor: pointer;
            margin-right: 10px;
            color: #0077b6; /* Dark Blue Icon Color */
        }
        .action-buttons {
    display: flex; /* Use flexbox for alignment */
    align-items: center; /* Align items vertically centered */
}

.action-link {
    margin-right: 15px; /* Add some space between the link and the button */
    text-decoration: none; /* Remove underline from link */
    color: #007bff; /* Set color to match button color */
}

.delete-form {
    margin: 0; /* Remove default margin from the form */
}

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination-button {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            margin: 0 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .pagination-button:hover {
            background-color: #005f73; /* Darker Blue Hover */
            transform: scale(1.05); /* Slightly Enlarge on Hover */
        }

        .pagination-button.disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }

        .search-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #0077b6; /* Dark Blue Border */
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Input Shadow */
        }

        .modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
    z-index: 1000;
    overflow: auto; /* Ensure scrolling if needed */
}

.modal-content {
    background: #ffffff;
    padding: 20px;
    border-radius: 5px;
    width: 80%;
    max-width: 600px;
    max-height: 90%; /* Ensure modal doesn't exceed viewport height */
    position: relative;
    overflow-y: auto; /* Enable vertical scrolling */
}

        .modal-content h2 {
            margin: 0;
            padding-bottom: 20px;
        }

        .modal-content label {
            display: block;
            margin-bottom: 10px;
        }

        .modal-content input,
        .modal-content select,
        .modal-content textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
        }

        .modal-buttons button {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .modal-buttons button:hover {
            background-color: #005f73; /* Darker Blue Hover */
            transform: scale(1.05); /* Slightly Enlarge on Hover */
        }

        .cancel-button {
            background-color: #e63946; /* Red Button */
        }

        .cancel-button:hover {
            background-color: #d62839; /* Darker Red Hover */
        }
    </style>
</head>
<body>

@include('components.navbarkaryawan')

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

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h2>Data Surat Masuk</h2>
        </div>
        <div class="card-body">
            <div class="table-controls">
                <label for="entries">Tampilkan:
                    <select id="entries">
                        <option value="1">1</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                    </select>
                </label>
            </div>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari Surat Masuk">
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Agenda</th>
                        <th>Tanggal Masuk</th>
                        <th>Pengirim</th>
                        <th>Asal Surat</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Perihal</th>
                        <th>Sifat Surat</th>
                        <th>Status Disposisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratMasuk as $surat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat->no_agenda }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                        <td>
                            @if($surat->pengirim_eksternal)
                                {{ $surat->pengirim_eksternal }} <!-- Menampilkan pengirim eksternal -->
                            @else
                                {{ $surat->pengirim->jabatan }} <!-- Menampilkan jabatan pengirim internal -->
                            @endif
                        </td>
                        <td>{{ $surat->instansi ? $surat->instansi->nama_instansi : '--' }}</td>
                        <td>{{ $surat->no_surat }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                        <td>{{ $surat->perihal }}</td>
                        <td>{{ $surat->sifatSurat ? $surat->sifatSurat->nama_sifat : 'Tidak Diketahui' }}</td>
                        <td>{{ $surat->status_disposisi }}</td>
                        <td>
                            <div class="action-buttons d-flex align-items-center">
                                <!-- Button Lihat Detail -->
                                <form action="{{ route('surat.show', $surat->id) }}" method="GET" class="view-form">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-primary d-flex align-items-center btn-sm" title="Lihat Detail Surat">
                                        <i class="fas fa-eye me-2"></i> Lihat
                                    </button>
                                </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination">
            <a href="#" class="pagination-button">Previous</a>
            <a href="#" class="pagination-button">1</a>
            <a href="#" class="pagination-button">2</a>
            <a href="#" class="pagination-button">Next</a>
        </div>
    </div>
<script>

// Optional: Close the modal with the ESC key
document.onkeydown = function(event) {
    if (event.key === "Escape") { // Check if the Esc key is pressed
        closeModal();
    }
}

    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('.table-container tbody tr');
        rows.forEach(row => {
            const cells = row.getElementsByTagName('td');
            let found = false;
            for (let i = 0; i < cells.length - 1; i++) {
                if (cells[i].textContent.toLowerCase().includes(value)) {
                    found = true;
                    break;
                }
            }
            row.style.display = found ? '' : 'none';
        });
    });
</script>

</body>
</html>
