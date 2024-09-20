<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Masuk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8; /* Light Blue Background */
            margin: 0;
            padding: 0;
        }

        .navbar-top {
            width: 100%;
            background: linear-gradient(90deg, #0077b6, #00b4d8); /* Gradient Navbar */
            padding: 10px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
            height: 60px;
            border-bottom: 2px solid #005f73; /* Darker Blue Border */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Subtle Shadow */
        }

        .navbar-top .logo {
            display: flex;
            align-items: center;
            color: #ffffff; /* White Text */
            font-weight: bold;
        }

        .navbar-top .logo img {
            width: 40px;
            margin-right: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Logo Shadow */
        }

        .navbar-top .logo span {
            font-size: 20px;
        }

        .navbar-top .people-icon {
            position: relative;
            display: flex;
            align-items: center;
            font-size: 24px;
            color: #ffffff; /* White Icon Color */
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background: linear-gradient(180deg, #0077b6, #00b4d8); /* Gradient Background */
            border: 1px solid #005f73; /* Darker Blue Border */
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Shadow */
            padding: 10px;
            width: 250px;
            z-index: 1000;
            color: #ffffff; /* White Text */
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu .user-info {
            margin-bottom: 10px;
        }

        .dropdown-menu .user-info span {
            font-weight: bold;
        }

        .dropdown-menu .dropdown-item {
            display: flex;
            align-items: center;
            padding: 10px;
            text-decoration: none;
            color: #ffffff; /* White Text */
            font-weight: bold;
            border-radius: 5px;
            margin-bottom: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dropdown-menu .dropdown-item i {
            margin-right: 10px;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #005f73; /* Darker Blue Hover */
        }

        .sidebar {
            width: 200px;
            background: linear-gradient(180deg, #0077b6, #00b4d8); /* Gradient Sidebar */
            height: 100vh;
            padding: 70px 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 60px;
            border-right: 2px solid #005f73; /* Darker Blue Border */
            box-shadow: 4px 0 6px rgba(0,0,0,0.1); /* Sidebar Shadow */
        }

        .sidebar a {
            text-decoration: none;
            color: #ffffff; /* White Text */
            margin: 10px 0;
            text-align: left;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #005f73; /* Darker Blue Hover */
            color: #ffffff; /* White Text */
        }

        .content {
            margin-left: 220px;
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
    <!-- Navbar -->
    <div class="navbar-top">
        <div class="logo">
            <img src="https://via.placeholder.com/40" alt="Logo">
            <span>Surat Masuk</span>
        </div>
        <div class="people-icon" onclick="toggleDropdown()">
            <i class="fa fa-user"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="user-info">
                    <span>John Doe</span>
                    <br>
                    <span>Admin</span>
                </div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-cogs"></i> Settings
                </a>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('dashboard_admin') }}">
            <i class="fa fa-home"></i> Dashboard
        </a>
        <a href="#">
            <i class="fa fa-envelope"></i> Surat Masuk
        </a>
        <a href="#">
            <i class="fa fa-paper-plane"></i> Surat Keluar
        </a>
        <a href="#">
            <i class="fa fa-file"></i> Laporan
        </a>
        <a href="#">
            <i class="fa fa-cogs"></i> Master Data
        </a>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h2>Data Surat Masuk</h2>
            <button class="add-button" onclick="openModal()">Tambah Surat Masuk</button>
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
                        <th>Asal Surat</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Perihal</th>
                        <th>Sifat Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suratMasuk as $surat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat->no_agenda }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $surat->instansi ? $surat->instansi->nama_instansi : 'Tidak Diketahui' }}</td>
                        <td>{{ $surat->no_surat }}</td>
                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('d-m-Y') }}</td>
                        <td>{{ $surat->perihal }}</td>
                        <td>{{ $surat->sifatSurat ? $surat->sifatSurat->nama_sifat : 'Tidak Diketahui' }}</td>
                        <td>
                            <a href="{{ route('surat.show', $surat->id) }}" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('surat.edit', $surat->id) }}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:#007bff; cursor:pointer;" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
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

 <!-- Modal -->
<div class="modal" id="modal">
    <div class="modal-content">
        <h3 id="modalTitle">Tambah Surat Masuk</h3>
        <form id="modalForm" action="{{ route('surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="no_agenda">No Agenda *</label>
                <input type="text" id="no_agenda" name="no_agenda" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Masuk *</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>

            <div class="form-group">
                <label for="id_asal_surat">Asal Surat *</label>
                <select id="id_asal_surat" name="id_asal_surat" required>
                    <option value="">--Pilih--</option>
                    @foreach($instansi as $inst)
                        <option value="{{ $inst->id }}">{{ $inst->nama_instansi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="no_surat">No Surat *</label>
                <input type="text" id="no_surat" name="no_surat" required>
            </div>

            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat *</label>
                <input type="date" id="tanggal_surat" name="tanggal_surat" required>
            </div>

            <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" id="perihal" name="perihal">
            </div>

            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea id="konten" name="konten"></textarea>
            </div>

            <div class="form-group">
                <label for="id_sifat_surat">Sifat Surat *</label>
                <select id="id_sifat_surat" name="id_sifat_surat" required>
                    <option value="">--Pilih--</option>
                    @foreach($sifatSurat as $sifat)
                        <option value="{{ $sifat->id }}">{{ $sifat->nama_sifat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="">--Pilih--</option>
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen">Dokumen Elektronik *</label>
                <input type="file" id="dokumen" name="dokumen" accept=".pdf" required>
                <p class="file-info">
                    Keterangan: <br>
                    - Tipe file yang bisa diunggah adalah *.pdf. <br>
                    - Ukuran file yang bisa diunggah maksimal 10 Mb.
                </p>
            </div>

            <div class="form-buttons">
                <button type="submit">Simpan</button>
                <button type="button" onclick="closeModal()">Batal</button>
            </div>
        </form>
    </div>
</div>
@include('crudsurat.editmasuk')
<script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('show');
    }

    function openModal(type = 'add') {
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('modalForm');
        modal.style.display = 'flex';
        if (type === 'edit') {
            modalTitle.textContent = 'Edit Surat Masuk';
            // Populate form with existing data if needed
            // Example: document.getElementById('no_agenda').value = existingData.no_agenda;
        } else {
            modalTitle.textContent = 'Tambah Surat Masuk';
            form.reset(); // Reset form fields for new entry
        }
    }

    function closeModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
    }

    // Close the modal when clicking outside of the modal content
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target == modal) {
            closeModal();
        }
    };

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
