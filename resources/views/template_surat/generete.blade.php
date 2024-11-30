<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Template Surat</title>
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
            background-color: #caf0f8;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 240px;
            padding: 80px 20px;
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

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
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

        .btn-add {
            background-color: #f4d35e;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            display: inline-block;
            text-decoration: none;
        }

        .btn-add:hover {
            background-color: #e09c36;
        }

        .btn-pilih {
        background-color: #0077b6; /* Blue color */
        color: #ffffff; /* White text */
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-pilih:hover {
        background-color: #005f73; /* Darker blue on hover */
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
    @elseif(auth()->user()->peran == 'Karyawan')
        @include('components.navbarkaryawan')
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
        <div class="header">
            <h2>Daftar Format Surat</h2>
            <a href="{{ route('tanda_tangan') }}" class="btn-add"> Buat Tanda Tangan</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Template</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    <tr>
                        <td>1</td>
                        <td>Surat Undangan </td>
                        <td>
                            <form action="{{ route('surat_undangan') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>

                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Surat Peringatan </td>
                        <td>
                            <form action="{{ route('surat_SP') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>

                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Surat Pemberitahuan </td>
                        <td>
                            <form action="{{ route('surat_pemberitahuan') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Surat Permohonan Kerja Sama </td>
                        <td>
                            <form action="{{ route('surat_permohonan_kerjasama') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>

                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Surat Mutasi </td>
                        <td>
                            <form action="{{ route('surat_mutasi') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Surat Perintah </td>
                        <td>
                            <form action="{{ route('surat_perintah') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Surat Mutasi </td>
                        <td>
                            <form action="{{ route('surat_mutasi') }}" method="GET">
                                <button type="submit" class="btn-pilih">Pilih</button>

                            </form>
                        </td>
                    </tr>
                    <td>8</td>
                    <td>Permohonan Cuti kerja</td>
                    <td>
                        <form action="{{ route('permohonan_cuti') }}" method="GET" style="display: inline;">
                            <button type="submit" class="btn-pilih">Pilih</button>
                        </form>
                            </button>
                    </td>

                </tr>
                <tr>
                    <td>9</td>
                    <td>Surat Perjanjian Karyawan</td>
                    <td>
                        <form action="{{ route('perjanjian_karyawan') }}" method="GET">
                            <button type="submit" class="btn-pilih">Pilih</button>

                        </form>
                    </td>

                </tr>
                <tr>
                    <td>10</td>
                    <td>Surat Undur Diri </td>
                    <td>
                        <form action="{{ route('surat_undurdiri') }}" method="GET">
                            <button type="submit" class="btn-pilih">Pilih</button>

                        </form>
                    </td>

                </tr>

                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Dropdown toggle for user menu
        document.getElementById('peopleIcon').addEventListener('click', function() {
            document.getElementById('dropdownMenu').classList.toggle('show');
        });
    </script>
</body>
</html>
