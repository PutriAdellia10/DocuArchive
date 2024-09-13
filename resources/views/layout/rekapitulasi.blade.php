<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekapitulasi</title>
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

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table-container th {
            background: linear-gradient(180deg, #0077b6, #00b4d8); /* Gradient Header */
            color: #ffffff; /* White Text */
        }

        .table-container tr:nth-child(even) {
            background-color: #f2f2f2; /* Zebra Striping */
        }
    </style>
</head>
<body>
    <div class="navbar-top">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span>Rekapitulasi</span>
        </div>
        <div class="people-icon" onclick="toggleDropdown()">
            <i class="bi bi-person-circle"></i>
            <div class="dropdown-menu" id="userDropdown">
                <div class="user-info">
                    <span>Welcome, User!</span>
                </div>
                <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profile</a>
                <a href="#" class="dropdown-item"><i class="fas fa-cog"></i> Settings</a>
                <a href="#" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
    <div class="sidebar">
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-file-alt"></i> Letters</a>
        <a href="#"><i class="fas fa-chart-line"></i> Reports</a>
        <a href="#"><i class="fas fa-cogs"></i> Settings</a>
    </div>
    <div class="container">
        <div class="header">
            <h2>Rekapitulasi Surat</h2>
        </div>
        <form method="GET" action="{{ url('/rekapitulasi') }}" id="rekapitulasiForm">
            <div class="form-group-inline">
                <div class="form-group">
                    <label for="tahun">Tahun:</label>
                    <select name="tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        @for($i = 2020; $i <= 2030; $i++)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn">Tampil</button>
                    <a onclick="window.print()" class="btn btn-cetak">Cetak</a>
                </div>
            </div>
        </form>
        <div id="tableContainer" class="table-container {{ $showTable ? 'show' : '' }}">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>bulan</th>
                        <th>Surat Masuk</th>
                        <th>Surat Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekapitulasi as $index => $rekap)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $rekap->bulan}}</td>
                            <td>{{ $rekap->total_surat_masuk }}</td>
                            <td>{{ $rekap->total_surat_keluar }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }

        document.getElementById('rekapitulasiForm').addEventListener('submit', function() {
            document.getElementById('tableContainer').classList.add('show');
        });
        document.getElementById('rekapitulasiForm').addEventListener('submit', function() {
    const tahunSelect = document.getElementById('tahun');
    const tableContainer = document.getElementById('tableContainer');

    if (tahunSelect.value === '') {
        tableContainer.classList.remove('show'); // Menyembunyikan tabel jika tahun belum dipilih
        event.preventDefault(); // Mencegah formulir dikirim jika tidak ada tahun yang dipilih
    } else {
        tableContainer.classList.add('show');
    }
});

    </script>
</body>
</html>
