<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #d4f1f4;
            font-family: Arial, sans-serif;
            margin: 0;
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
            background-color: #00b4d8;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            color: black;
        }

        .table-container {
            margin-top: 20px;
            border: 1px solid #00b4d8;
            border-radius: 8px;
            background-color: #e9f1f7;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            border: 1px solid #00b4d8;
            padding: 10px;
            text-align: left;
        }

        .table-container th {
            background-color: #00b4d8;
            color: black;
        }
        .table-container tbody tr:nth-child(even) {
            background-color: #f1f1f1; /* Light Gray */
        }

        .table-container tbody tr:hover {
            background-color: #e0f7fa; /* Very Light Blue */
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: #00b4d8;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .pagination button {
            background-color: #00b4d8;
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: rgb(3, 3, 3);
            margin-left: 5px;
        }

        .pagination button:disabled {
            background-color: #33a393;
        }
          /* Perbaikan untuk memastikan backdrop dan modal tampil dengan benar */
          .modal-backdrop {
            z-index: 1040 !important;  /* Pastikan backdrop berada di bawah modal */
        }

        .modal {
            z-index: 1050 !important;   /* Pastikan modal muncul di atas backdrop */
        }

        .modal-content {
            background-color: #f9f9f9;
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="kata_sandi" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="kata_sandi" name="kata_sandi" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kata_sandi" class="form-label">Kata Sandi</label>
                            <input type="text" class="form-control" id="edit_kata_sandi" name="kata_sandi" required>
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
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
