<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #d4f1f4;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .navbar {
            background-color: #33a393; /* Brighter shade */
            color: rgb(0, 0, 0);
            display: flex;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar img {
            width: 50px;
            margin-right: 10px;
        }

        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }

        .sidebar {
            width: 200px;
            background-color: #33a393; /* Same brighter color as navbar */
            position: fixed;
            height: 100%;
            padding-top: 60px; /* Adjusted for top navbar height */
            padding-left: 20px;
            top: 0;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: rgb(2, 2, 2); /* Text color remains white */
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #4bc2b0;
        }

        .content {
            margin-left: 220px;
            margin-top: 60px; /* Adjusted for top navbar height */
            padding: 20px;
        }

        .card {
            background-color: #d4f1f4;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #76c7c0;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            color: black;
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #76c7c0;
            border-radius: 8px;
            background-color: #e9f1f7;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #76c7c0;
            padding: 10px;
            text-align: left;
        }

        .table-container th {
            background-color: #76c7c0;
            color: black;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #33a393;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .pagination button {
            background-color: #96bdb9;
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: rgb(3, 3, 3);
            margin-left: 5px;
        }

        .pagination button:disabled {
            background-color: #33a393;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="logo">
        <h2>Docu Archive</h2>
    </div>

    <div class="sidebar">
        <a href="#">Dashboard</a>
        <a href="#">Surat</a>
        <a href="#">Laporan</a>
        <a href="#">Template Surat</a>
        <a href="#">Instansi</a>
        <a href="#">Pengaturan</a>
    </div>
    <div class="content">
        <!-- Menampilkan pesan sukses -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <span>Manajemen User</span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                    Tambah User
                </button>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama User</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengguna as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama_pengguna }}</td>
                            <td>{{ $user->peran }}</td>
                            <td class="actions">
                                <a href="#"
                                   class="edit-btn"
                                   data-bs-toggle="modal"
                                   data-bs-target="#editUserModal"
                                   data-id="{{ $user->id }}"
                                   data-nama="{{ $user->nama_pengguna }}"
                                   data-peran="{{ $user->peran }}">
                                   <img src="{{ asset('img/edit.png') }}" alt="Edit" width="20">
                                </a>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <img src="{{ asset('img/hapus.png') }}" alt="Delete" width="20">
                                    </button>
                                    <script>
                                        function confirmDelete() {
                                            return confirm('Apakah Anda yakin ingin menghapus data ini?');
                                        }
                                    </script>
                                </form>
                            </td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                <span>Menampilkan 1 sampai {{ $pengguna->count() }} dari {{ $total }} data</span>
                <button>Sebelumnya</button>
                <button>1</button>
                <button>Selanjutnya</button>
            </div>
        </div>
    </div>

    <!-- Modal Tambah User -->
    <div class="modal fade" id="tambahUserModal" tabindex="-1" aria-labelledby="tambahUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahUserModalLabel">Tambah User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    @if ($errors->any())
        <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                    @endforeach
                </ul>
        </div>
    @endif

                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                            <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
                        </div>
                        <div class="mb-3">
                            <label for="kata_sandi" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
                        </div>
                        <div class="mb-3">
                            <label for="peran" class="form-label">Peran</label>
                            <select class="form-select" id="peran" name="peran" required>
                                <option value="admin">Admin</option>
                                <option value="karyawan">Karyawan</option>
                                <option value="sekretariat">Sekretariat</option>
                                <option value="pimpinan">Pimpinan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" action="" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_pengguna" class="form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="edit_nama_pengguna" name="nama_pengguna" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kata_sandi" class="form-label">Kata Sandi</label>
                        <input type="text" class="form-control" id="edit_kata_sandi" name="kata_sandi" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_peran" class="form-label">Peran</label>
                        <select class="form-select" id="edit_peran" name="peran" required>
                            <option value="admin">Admin</option>
                            <option value="karyawan">Karyawan</option>
                            <option value="sekretariat">Sekretariat</option>
                            <option value="pimpinan">Pimpinan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-btn');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var userId = this.getAttribute('data-id');
                var userName = this.getAttribute('data-nama');
                var userRole = this.getAttribute('data-peran');

                var form = document.getElementById('editUserForm');
                form.action = '{{ route('user.update', '') }}/' + userId;
                document.getElementById('edit_nama_pengguna').value = userName;
                document.getElementById('edit_peran').value = userRole;
            });
        });
    });
</script>


</body>
</html>
