<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Masuk</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8;
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

        .add-button {
            background-color: #0077b6;
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
            background-color: #005f73;
            transform: scale(1.05);
        }

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #90e0ef;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
            background: linear-gradient(180deg, #0077b6, #00b4d8);
            color: #ffffff;
            font-weight: bold;
        }

        .table-container tbody tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        .table-container tbody tr:hover {
            background-color: #e0f7fa;
        }

        .actions i {
            width: 20px;
            cursor: pointer;
            margin-right: 10px;
            color: #0077b6;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .pagination-button {
            background-color: #0077b6;
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
            background-color: #005f73;
            transform: scale(1.05);
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
            border: 1px solid #0077b6;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
            overflow: auto;
        }

        .modal-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            width: 80%;
            max-width: 600px;
            max-height: 90%;
            position: relative;
            overflow-y: auto;
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
            background-color: #0077b6;
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
            background-color: #005f73;
            transform: scale(1.05);
        }

        .cancel-button {
            background-color: #e63946;
        }

        .cancel-button:hover {
            background-color: #d62839;
        }
    </style>
</head>
<body>

@include('components.navbar')

@if(auth()->check() && auth()->user()->peran == 'Admin')

    @include('components.sidebaradmin')

    <div class="content">
        <div class="header">
            <h2>Data Surat Masuk</h2>
            <button class="add-button" onclick="openModal()">Tambah Surat Masuk</button>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari Surat Masuk">
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No. Surat</th>
                        <th>Pengirim</th>
                        <th>Tanggal</th>
                        <th>Subjek</th>
                        <th>Lampiran</th>
                        <th>Status Disposisi</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratMasuk as $surat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat->no_surat }}</td>
                        <td>{{ $surat->pengirim->jabatan ?? $surat->nama_pengirim_eksternal }}</td>
                        <td>{{ $surat->tanggal }}</td>
                        <td>{{ $surat->subjek }}</td>
                        <td>{{ $surat->lampiran }}</td>
                        <td>{{ $surat->status_disposisi }}</td>
                        <td>
                            <!-- Lihat Detail Surat -->
                            <a href="{{ route('surat-masuk.show', $surat->id) }}" class="btn btn-info">Lihat</a>

                            <!-- Fitur Mengelola Surat (Edit & Hapus) -->
                            <a href="{{ route('surat-masuk.edit', $surat->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('surat-masuk.destroy', $surat->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus surat ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->

    <!-- Modal for adding new letter -->
    <div class="modal" id="addModal">
        <div class="modal-content">
            <h2>Tambah Surat Masuk</h2>
            <form action="{{ route('surat-masuk.store') }}" method="POST">
                @csrf
                <label for="no_surat">No. Surat:</label>
                <input type="text" id="no_surat" name="no_surat" required>

                <label for="pengirim">Pengirim:</label>
                <input type="text" id="pengirim" name="pengirim" required>

                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>

                <label for="subjek">Subjek:</label>
                <input type="text" id="subjek" name="subjek" required>

                <label for="status_disposisi">Status Disposisi:</label>
                <select id="status_disposisi" name="status_disposisi">
                    <option value="Belum Disposisi">Belum Disposisi</option>
                    <option value="Sudah Disposisi">Sudah Disposisi</option>
                </select>

                <div class="modal-buttons">
                    <button type="button" class="cancel-button" onclick="closeModal()">Batal</button>
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('addModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addModal').style.display = 'none';
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Close modal on outside click
            window.onclick = function (event) {
                if (event.target == document.getElementById('addModal')) {
                    closeModal();
                }
            };
        });
    </script>

@endif
</body>
</html>
