<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Instansi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <div class="navbar-top">
        <div class="logo">
            <img src="{{ asset('img/logo.jpg') }}" alt="logo">
            <span>Docu Archive</span>
        </div>
        <div class="people-icon" onclick="toggleDropdown()">
            <i class="fa fa-user"></i>
        </div>
        <div class="dropdown-menu" id="dropdownMenu">
            <div class="user-info">
                <span>Admin</span>
                <p>admin@docuarchive.com</p>
            </div>
            <a href="#" class="dropdown-item">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </div>
    <div class="sidebar">
        <a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="/surat"><i class="fas fa-envelope"></i> Surat</a>
        <a href="/laporan"><i class="fas fa-chart-line"></i> Laporan</a>
        <a href="/template_surat"><i class="fas fa-cogs"></i> Template Surat</a>
        <a href="/instansi"><i class="fas fa-building"></i> Instansi</a>
        <a href="/disposisi"><i class="fas fa-user-cog"></i> Disposisi</a>
        <a href="/pengaturan"><i class="fas fa-user-cog"></i> Pengaturan</a>
    </div>
    <div class="content">
        <div class="header">
            <h2><i class="fas fa-arrow-left"></i> Instansi</h2>
            <button class="add-button" onclick="openModal()">Tambah Instansi</button>
        </div>
        <div class="table-container">
            <div class="search-container">
                <form action="{{ route('instansi.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari Instansi..." value="{{ request('search') }}">
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Instansi</th>
                        <th>Kontak</th>
                        <th>Jenis Kerja Sama</th>
                        <th>Dibuat Pada</th>
                        <th>Diperbarui Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instansi as $i)
                        <tr>
                            <td>{{ $i->id }}</td>
                            <td>{{ $i->nama_instansi }}</td>
                            <td>{{ $i->kontak }}</td>
                            <td>{{ $i->jenis_kerja_sama }}</td>
                            <td>{{ $i->dibuat_pada }}</td>
                            <td>{{ $i->diperbarui_pada }}</td>
                            <td class="actions">
                                <i class="fas fa-edit" onclick="openEditModal({{ $i->id }})"></i>
                                <i class="fas fa-trash" onclick="deleteInstansi({{ $i->id }})"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                @if ($instansi->onFirstPage())
                    <span class="pagination-button disabled">&laquo; Prev</span>
                @else
                    <a href="{{ $instansi->previousPageUrl() }}" class="pagination-button">&laquo; Prev</a>
                @endif

                @if ($instansi->hasMorePages())
                    <a href="{{ $instansi->nextPageUrl() }}" class="pagination-button">Next &raquo;</a>
                @else
                    <span class="pagination-button disabled">Next &raquo;</span>
                @endif
            </div>
        </div>
    </div>
    <!-- Modal for Tambah Instansi -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modalTitle">Tambah Instansi</h2>
            <form id="instansiForm" action="{{ route('instansi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="id">
                <label for="nama_instansi">Nama Instansi:</label>
                <input type="text" id="nama_instansi" name="nama_instansi" required>
                <label for="kontak">Kontak:</label>
                <input type="text" id="kontak" name="kontak" required>
                <label for="jenis_kerja_sama">Jenis Kerja Sama:</label>
                <input type="text" id="jenis_kerja_sama" name="jenis_kerja_sama" required>
                <label for="dibuat_pada">Dibuat Pada:</label>
                <input type="date" id="dibuat_pada" name="dibuat_pada" required>
                <label for="diperbarui_pada">Diperbarui Pada:</label>
                <input type="date" id="diperbarui_pada" name="diperbarui_pada" required>
                <button type="submit" id="submitButton">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('show');
        }

        function openModal() {
            document.getElementById('modal').style.display = 'flex';
            document.getElementById('modalTitle').textContent = 'Tambah Instansi';
            document.getElementById('instansiForm').action = '{{ route('instansi.store') }}';
            document.getElementById('instansiForm').reset();
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
        }

        function openEditModal(id) {
    fetch(`/instansi/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            // Tampilkan modal
            document.getElementById('modal').style.display = 'flex';

            // Isi data ke dalam form
            document.getElementById('modalTitle').textContent = 'Edit Instansi';
            const form = document.getElementById('instansiForm');
            form.action = `/instansi/${id}`; // URL untuk update data
            form.querySelector('input[name="id"]').value = data.id;
            form.querySelector('input[name="nama_instansi"]').value = data.nama_instansi;
            form.querySelector('input[name="kontak"]').value = data.kontak;
            form.querySelector('input[name="jenis_kerja_sama"]').value = data.jenis_kerja_sama;
            form.querySelector('input[name="dibuat_pada"]').value = data.dibuat_pada;
            form.querySelector('input[name="diperbarui_pada"]').value = data.diperbarui_pada;
        })
        .catch(error => console.error('Error:', error));
}


        function deleteInstansi(id) {
            if (confirm('Apakah Anda yakin ingin menghapus instansi ini?')) {
                fetch(`/instansi/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus instansi.');
                    }
                });
            }
        }
    </script>
</body>
</html>
