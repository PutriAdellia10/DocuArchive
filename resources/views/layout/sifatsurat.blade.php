<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Sifat Surat</title>
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
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #ffffff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #0077b6; /* Dark Blue Border */
    width: 80%;
    max-width: 600px;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Modal Shadow */
}

.modal-content input[type="text"],
.modal-content input[type="date"] {
    width: calc(100% - 22px);
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.modal-content button {
    background-color: #0077b6; /* Dark Blue Button */
    border: none;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
    color: white;
    font-weight: bold;
    width: 100%;
    transition: background-color 0.3s, transform 0.3s;
}

.modal-content button:hover {
    background-color: #005f73; /* Darker Blue Hover */
    transform: scale(1.05); /* Slightly Enlarge on Hover */
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
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
<div class="content">
    <div class="header">
        <h2></i> Sifat Surat</h2>
        <button class="add-button" onclick="openModal()">Tambah Sifat Surat</button>
    </div>

    <div class="table-container">
        <div class="search-container">
            <form action="{{ route('instansi.index') }}" method="GET">
                <input type="text" name="search" placeholder="Cari Sifat Surat..." value="{{ request('search') }}">
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sifat</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sifatSurat as $sifat)
                    <tr>
                        <td>{{ $sifat->id }}</td>
                        <td>{{ $sifat->nama_sifat }}</td>
                        <td>{{ $sifat->deskripsi }}</td>
                        <td class="actions">
                            <i class="fas fa-edit" onclick="openEditModal({{ $sifat->id }}, '{{ $sifat->nama_sifat }}', '{{ $sifat->deskripsi }}')"></i>
                            <i class="fas fa-trash" onclick="deleteInstansi({{ $sifat->id }})"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Adding Sifat Surat -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Tambah Sifat Surat</h2>
        <form action="{{ route('sifat_surat.store') }}" method="POST">
            @csrf
            <input type="text" name="nama_sifat" placeholder="Nama Sifat" required>
            <input type="text" name="deskripsi" placeholder="Deskripsi" required>
            <button type="submit">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal for Editing Sifat Surat -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeEditModal()">&times;</span>
        <h2>Edit Sifat Surat</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <input type="text" id="edit_nama_sifat" name="nama_sifat" placeholder="Nama Sifat" required>
            <input type="text" id="edit_deskripsi" name="deskripsi" placeholder="Deskripsi" required>
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById("addModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("addModal").style.display = "none";
    }

    function openEditModal(id, nama_sifat, deskripsi) {
        document.getElementById("edit_nama_sifat").value = nama_sifat;
        document.getElementById("edit_deskripsi").value = deskripsi;
        document.getElementById("editForm").action = `/sifat_surat/${id}`; // Set the action URL for edit
        document.getElementById("editModal").style.display = "flex";
    }

    function closeEditModal() {
        document.getElementById("editModal").style.display = "none";
    }

    function deleteInstansi(id) {
        if (confirm("Apakah Anda yakin ingin menghapus sifat surat ini?")) {
            document.location.href = `/sifat_surat/${id}`; // Adjust according to your route
        }
    }

    // Close modals when clicking outside of them
    window.onclick = function(event) {
        if (event.target === document.getElementById("addModal") || event.target === document.getElementById("editModal")) {
            closeModal();
            closeEditModal();
        }
    };
</script>
</body>
</html>
