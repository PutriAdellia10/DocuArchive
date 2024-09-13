<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Laporan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #caf0f8; /* Light Blue Background */
            margin: 0;
            padding: 0;
        }

        .container {
            margin-left: 220px; /* Adjust based on sidebar width */
            padding: 80px 20px 20px;
        }

        /* Navbar Styles */
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

        /* Sidebar Styles */
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

        .table-container th, .table-container td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0; /* Light Gray Border */
        }

        .table-container th {
            background-color: #f2f2f2; /* Light Gray Background */
            text-align: left;
        }

        .table-container tr:hover {
            background-color: #f9f9f9; /* Light Gray Hover */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                margin-top: 0;
                border-right: none;
                box-shadow: none;
            }

            .navbar-top {
                position: static;
                height: auto;
                border-bottom: none;
                box-shadow: none;
            }

            .container {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
   <body>
    <div class="navbar-top">
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <span>Admin Dashboard</span>
        </div>
        <div class="people-icon" id="dropdownMenuButton">
            <i class="bi bi-person-circle"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <div class="user-info">
                    <span>Admin</span>
                </div>
                <a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a>
                <a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Settings</a>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <a href="{{ url('/dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a>
        <a href="{{ url('/surat-masuk') }}"><i class="bi bi-envelope-in"></i> Surat Masuk</a>
        <a href="{{ url('/surat-keluar') }}"><i class="bi bi-envelope-out"></i> Surat Keluar</a>
        <a href="{{ url('/laporan') }}"><i class="bi bi-file-earmark-text"></i> Laporan</a>
        <a href="{{ url('/master') }}"><i class="bi bi-folder"></i> Master Data</a>
    </div>

    <div class="container">
        <div class="header">
            <h2><i class="bi bi-file-earmark-text"></i>Laporan Surat Masuk</h2>
        </div>

        <div class="content">
            <form method="GET" action="{{ route('laporan.masuk') }}" id="filterForm">
                <div class="form-group-inline">
                    <div class="form-group">
                        <label for="tanggal_awal">Tanggal Awal:</label>
                        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir:</label>
                        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="btn">Tampilkan</button>
                        <button type="button" class="btn btn-cetak" id="cetakBtn">Cetak</button>
                    </div>
                </div>
            </form>

            <div class="table-container {{ request('tanggal_awal') && request('tanggal_akhir') ? 'show' : '' }}">
                <table>
                    <thead>
                        <tr>
                            <th>No Agenda</th>
                            <th>Tanggal Masuk</th>
                            <th>Asal Surat</th>
                            <th>No Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Perihal</th>
                            <th>Keterangan</th>
                            <th>Sifat Surat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            <tr>
                                <td>{{ $laporan->no_agenda }}</td>
                                <td>{{ $laporan->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $laporan->asal_surat }}</td>
                                <td>{{ $laporan->no_surat }}</td>
                                <td>{{ $laporan->tanggal_surat->format('d-m-Y') }}</td>
                                <td>{{ $laporan->perihal }}</td>
                                <td>{{ $laporan->keterangan }}</td>
                                <td>{{ $laporan->sifat_surat->nama }}</td>
                                <td>{{ $laporan->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">Tidak ada laporan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle print button
            const cetakBtn = document.getElementById('cetakBtn');
            if (cetakBtn) {
                cetakBtn.addEventListener('click', function() {
                    window.print();
                });
            }
        });
    </script>
</body>
</html>
