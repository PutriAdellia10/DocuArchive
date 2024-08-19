<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    display: flex;
    height: 100vh;
    background-color: #e6f2f2;
}

.container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 200px;
    background-color: #c7e7e4;
    padding: 20px;
}

.logo {
    display: flex;
    align-items: center;
    margin-bottom: 30px;
}

.logo img {
    width: 40px;
    margin-right: 10px;
}

.logo h2 {
    font-size: 20px;
    color: #086756;
}

.nav-menu ul {
    list-style-type: none;
}

.nav-menu ul li {
    margin: 15px 0;
}

.nav-menu ul li a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    display: flex;
    align-items: center;
}

.nav-menu ul li a img {
    width: 24px;
    margin-right: 10px;
}

.nav-menu ul li a:hover {
    color: #086756;
}

.main-content {
    flex-grow: 1;
    padding: 20px;
    background-color: #f7fdfd;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #e6f7f5;
    border-radius: 10px;
}

header .welcome {
    display: flex;
    align-items: center;
}

header .welcome-image img {
    width: 200px;
    margin-right: 20px;
}

header .welcome-text h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

header .welcome-text p {
    font-size: 18px;
    margin-bottom: 10px;
}

header .welcome-text button {
    background-color: #33a393;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    margin-right: 10px;
    cursor: pointer;
}

header .welcome-text button:hover {
    background-color: #29877b;
}

header .profile img {
    width: 30px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.card {
    background-color: #c7e7e4;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.card img {
    width: 40px;
    margin-bottom: 10px;
}

.card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.card p {
    font-size: 24px;
    font-weight: bold;
    color: #086756;
}

    </style>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="logo">
                <h2>Docu Archive</h2>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#"><img src="dashboard-icon.png" alt="Dashboard Icon">Dashboard</a></li>
                    <li><a href="#"><img src="surat-icon.png" alt="Surat Icon">Surat</a></li>
                    <li><a href="#"><img src="laporan-icon.png" alt="Laporan Icon">Laporan</a></li>
                    <li><a href="#"><img src="master-icon.png" alt="Master Icon">Master</a></li>
                    <li><a href="#"><img src="instansi-icon.png" alt="Instansi Icon">Instansi</a></li>
                    <li><a href="#"><img src="pengaturan-icon.png" alt="Pengaturan Icon">Pengaturan</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header>
                <div class="welcome">
                    <div class="welcome-image">
                        <img src="{{ asset('img/bg3.jpg') }}" alt="bg3.jpg">
                    </div>
                    <div class="welcome-text">
                        <h1>Selamat Datang di Docu Archive</h1>
                        <p>Atur dan Arsipkan Dokumen Anda dengan Mudah dan Aman</p>
                        <button>Surat Masuk</button>
                        <button>Surat Keluar</button>
                    </div>
                </div>
                <div class="profile">
                    <img src="profile-icon.png" alt="User Profile">
                </div>
            </header>

            <section class="cards">
                <div class="card">
                    <img src="surat-masuk-icon.png" alt="Surat Masuk Icon">
                    <h3>Surat Masuk</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <img src="surat-keluar-icon.png" alt="Surat Keluar Icon">
                    <h3>Surat Keluar</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <img src="surat-masuk-pertahun-icon.png" alt="Surat Masuk Pertahun Icon">
                    <h3>Surat Masuk Pertahun</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <img src="surat-keluar-pertahun-icon.png" alt="Surat Keluar Pertahun Icon">
                    <h3>Surat Keluar Pertahun</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <img src="total-surat-icon.png" alt="Total Surat Icon">
                    <h3>Total Surat</h3>
                    <p>0</p>
                </div>
                <div class="card">
                    <img src="instansi-icon.png" alt="Instansi Icon">
                    <h3>Instansi</h3>
                    <p>0</p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
