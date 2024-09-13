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
            display: flex; /* Mengaktifkan Flexbox */
            align-items: center; /* Menyelaraskan item secara vertikal */
            justify-content: space-between; /* Menyebarkan item secara horizontal */
            margin-bottom: 20px;
            border-bottom: 2px solid #0077b6; /* Dark Blue Border */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* Header Shadow */
        }

        .header img {
            width: 50px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2); /* Logo Shadow */
        }

        .header .header-content {
            display: flex; /* Mengaktifkan Flexbox pada header-content */
            align-items: center; /* Menyelaraskan item secara vertikal */
            gap: 15px; /* Jarak antara image dan text */
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .add-button {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center; /* Align text in center */
            display: inline-block;
            width: 200px; /* Adjust the width */
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
            max-width: 800px; /* Adjusted max-width */
            overflow-x: auto;
            display: flex;
            justify-content: center;
            margin: 0 auto; /* Center the container */
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            max-width: 100%; /* Ensure table does not exceed container width */
        }

        .table-container th,
        .table-container td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            font-size: 14px;
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

        .actions {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .actions i {
            width: 20px;
            cursor: pointer;
            margin-right: 10px;
            color: #0077b6; /* Dark Blue Icon Color */
        }

        .actions .generate-button {
            background-color: #f9c74f; /* Yellow Button */
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            display: inline-block;
        }

        .actions .generate-button:hover {
            background-color: #f8e71c; /* Light Yellow Hover */
            transform: scale(1.05); /* Slightly Enlarge on Hover */
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination button {
            background-color: #0077b6; /* Dark Blue Button */
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin: 0 5px;
        }

        .pagination button:hover {
            background-color: #005f73; /* Darker Blue Hover */
        }

        /* Search Styles */
        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .search-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 200px;
            margin-right: 10px;
        }

        .search-container button {
            padding: 10px;
            border: none;
            background-color: #0077b6;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #005f73;
        }

        /* Modal Styles */
        #modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #modal > div {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 500px;
        }

        #modal h3 {
            margin: 0;
            margin-bottom: 15px;
        }

        #modal label {
            display: block;
            margin-bottom: 5px;
        }

        #modal input[type="text"],
        #modal textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        #modal button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }

        #modal button[type="submit"] {
            background-color: #0077b6;
            color: #fff;
        }

        #modal button[type="submit"]:hover {
            background-color: #005f73;
        }

        #modal button[type="button"] {
            background-color: #e63946;
            color: #fff;
        }

        #modal button[type="button"]:hover {
            background-color: #d62839;
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
        <a href="/master"><i class="fas fa-cogs"></i> Template Surat</a>
        <a href="/instansi"><i class="fas fa-building"></i> Instansi</a>
        <a href="/pengaturan"><i class="fas fa-user-cog"></i> Disposisi</a>
        <a href="/pengaturan"><i class="fas fa-user-cog"></i> Pengaturan</a>
    </div>

    <div class="content">
        <div class="header">
            <div class="header-content">
                <img src="your-logo.png" alt="Logo">
                <h2>Template Surat</h2>
            </div>
            <button class="add-button" onclick="openAddModal()">Tambah Template</button>
        </div>

        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari...">
            <button onclick="searchTable()">Cari</button>
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
                    <?php foreach ($templates as $template): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($template->id); ?></td>
                        <td><?php echo htmlspecialchars($template->nama_template); ?></td>
                        <td class="actions">
                            <i class="fas fa-edit" onclick="openEditModal(<?php echo $template->id; ?>)"></i>
                            <i class="fas fa-trash" onclick="deleteTemplate(<?php echo $template->id; ?>)"></i>
                            <button class="generate-button" onclick="generateTemplate(<?php echo $template->id; ?>)">Generate</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <!-- Pagination controls -->
            <button onclick="previousPage()">Previous</button>
            <button onclick="nextPage()">Next</button>
        </div>

        <!-- Add/Edit Modal -->
        <div id="modal" style="display: none;">
            <div>
                <h3>Tambah Template Surat</h3>
                <form id="addTemplateForm" enctype="multipart/form-data">
                    <label for="nama_template">Nama Template</label>
                    <input type="text" id="nama_template" name="nama_template" required>

                    <label for="konten">Konten Template</label>
                    <textarea id="konten" name="konten" rows="5" required></textarea>

                    <label for="ttd_pimpinan">Upload Tanda Tangan Pimpinan</label>
                    <input type="file" id="ttd_pimpinan" name="ttd_pimpinan" accept=".png, .jpg, .jpeg" required>

                    <label for="stempel">Upload Stempel</label>
                    <input type="file" id="stempel" name="stempel" accept=".png, .jpg, .jpeg" required>

                    <div style="margin-top: 15px;">
                        <button type="submit">Simpan</button>
                        <button type="button" onclick="closeModal()">Batal</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function openAddModal() {
                document.getElementById('modal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('modal').style.display = 'none';
            }

            // Handle form submission logic here
            document.getElementById('addTemplateForm').addEventListener('submit', function(event) {
                event.preventDefault();
                // Add logic to handle form data and file uploads
            });
        </script>

<script>
        function deleteTemplate(id) {
            if (confirm('Apakah Anda yakin ingin menghapus template ini?')) {
                // Perform the delete operation using AJAX or form submission
            }
        }

        function generateTemplate(id) {
            // Implement the generate operation using AJAX or similar method
            alert('Generate template ID: ' + id);
        }

        function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}


        function previousPage() {
            // Implement pagination logic
        }

        function nextPage() {
            // Implement pagination logic
        }
    </script>
</body>
</html>
