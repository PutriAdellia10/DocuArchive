<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Template Surat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8;
            margin: 0;
            padding: 0;
        }

        .navbar-top {
            width: 100%;
            background: linear-gradient(90deg, #0077b6, #00b4d8);
            padding: 10px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
            height: 60px;
            border-bottom: 2px solid #005f73;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .navbar-top .logo {
            display: flex;
            align-items: center;
            color: #ffffff;
            font-weight: bold;
        }

        .navbar-top .logo img {
            width: 40px;
            margin-right: 10px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-top .logo span {
            font-size: 20px;
        }

        .navbar-top .people-icon {
            position: relative;
            display: flex;
            align-items: center;
            font-size: 24px;
            color: #ffffff;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 60px;
            right: 0;
            background: linear-gradient(180deg, #0077b6, #00b4d8);
            border: 1px solid #005f73;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            padding: 10px;
            width: 250px;
            z-index: 1000;
            color: #ffffff;
        }

        .dropdown-menu.show {
            display: block;
        }

        .sidebar {
            width: 220px;
            background: linear-gradient(180deg, #0077b6, #00b4d8);
            height: 100vh;
            padding: 70px 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            border-right: 2px solid #005f73;
            box-shadow: 4px 0 6px rgba(0,0,0,0.1);
        }

        .sidebar a {
            text-decoration: none;
            color: #ffffff;
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
            background-color: #005f73;
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

        /* Table Styles */
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #90e0ef;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px 15px;
            border: 1px solid #0077b6;
            text-align: left;
        }

        table th {
            background-color: #0077b6;
            color: #ffffff;
        }

        table td {
            background-color: #f1f8ff;
        }

        table tr:hover {
            background-color: #e0f7ff;
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
    <div class="navbar-top">
        <div class="logo">
            <img src="your-logo.png" alt="Logo">
            <span>Docu Archive</span>
        </div>
        <div class="people-icon" id="peopleIcon">
            <i class="fas fa-user"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="user-info">
                    <span>John Doe</span>
                </div>
                <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
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
            <h2>Daftar Template Surat</h2>
            <a href="{{ route('tanda_tangan') }}" class="btn-add"> Buat Tanda Tangan</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
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
                        <td>1</td>
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
