<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Form Pembuatan Surat</title>
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
            width: 220px;
            background: linear-gradient(180deg, #0077b6, #00b4d8); /* Gradient Sidebar */
            height: 100vh;
            padding: 70px 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
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
            margin-left: 240px; /* Adjust margin to accommodate wider sidebar */
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

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        /* Form Styles */
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #90e0ef; /* Light Blue Border */
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Table Shadow */
            max-width: 800px;
            margin: 0 auto;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #0077b6;
        }

        .form-container .form-group {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container select,
        .form-container input[type="text"],
        .form-container textarea,
        .form-container input[type="date"] {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .form-container button {
    padding: 8px 16px; /* Smaller padding */
    background-color: #f4d35e; /* Yellow Button */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: auto; /* Adjust the width to fit the content */
    font-size: 14px; /* Slightly smaller font size */
    display: block; /* Make the button a block element */
    margin: 20px auto; /* Center the button with auto margins */
}

.form-container button:hover {
    background-color: #e09c36; /* Darker Yellow on Hover */
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
            <h2>Form Pembuatan Surat</h2>
        </div>

        <div class="form-container">
            <h2>Form Pembuatan Surat</h2>

            <form action="#" method="POST">
                <div class="form-group">
                    <label for="template_surat">Pilih Template Surat:</label>
                    <select id="template_surat" name="template_surat">
                        <option value="">-- Pilih Template Surat --</option>
                        <!-- Populate with options -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="kop_surat">Pilih Template Kop Surat:</label>
                    <select id="kop_surat" name="kop_surat">
                        <option value="">-- Pilih Template Kop Surat --</option>
                        <!-- Populate with options -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="penerima">Nama dan Jabatan Penerima:</label>
                    <input type="text" id="penerima" name="penerima">
                </div>

                <div class="form-group">
                    <label for="alamat_penerima">Alamat Penerima:</label>
                    <input type="text" id="alamat_penerima" name="alamat_penerima">
                </div>

                <div class="form-group">
                    <label for="tanggal_surat">Tanggal Surat:</label>
                    <input type="date" id="tanggal_surat" name="tanggal_surat">
                </div>

                <div class="form-group">
                    <label for="isi_surat">Isi Surat:</label>
                    <textarea id="isi_surat" name="isi_surat" rows="5"></textarea>
                </div>

                <div class="form-group">
                    <label for="pengirim">Nama Pengirim:</label>
                    <input type="text" id="pengirim" name="pengirim">
                </div>

                <button type="submit">Generate</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('peopleIcon').addEventListener('click', function () {
            const dropdown = document.getElementById('dropdownMenu');
            dropdown.classList.toggle('show');
        });
    </script>
</body>
</html>
