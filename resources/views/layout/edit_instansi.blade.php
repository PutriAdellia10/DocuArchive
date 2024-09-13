<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Instansi - Docu Archive</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Add your custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f2f0;
            margin: 0;
            padding: 0;
        }
        .navbar-top {
            width: 100%;
            background-color: #b3dcd3;
            padding: 10px 20px;
            box-sizing: border-box;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
            height: 60px;
            border-bottom: 2px solid #9bcbb5;
        }
        .navbar-top .logo {
            display: flex;
            align-items: center;
            color: #333;
            font-weight: bold;
        }
        .navbar-top .logo img {
            width: 40px;
            margin-right: 10px;
            border-radius: 50%;
        }
        .navbar-top .logo span {
            font-size: 20px;
        }
        .content {
            margin-left: 220px;
            padding: 80px 20px 20px;
        }
        .header {
            background-color: #c6e7df;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #9bcbb5;
        }
        .header img {
            width: 50px;
        }
        .header h2 {
            margin: 0;
            padding-left: 10px;
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #b3dcd3;
            border-radius: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-container input[type="text"],
        .form-container input[type="date"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #9bcbb5;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #00796b;
        }
    </style>
</head>
<body>
    <div class="navbar-top">
        <div class="logo">
            <img src="img/logo.jpg" alt="logo">
            <span>Docu Archive</span>
        </div>
    </div>
    <div class="content">
        <div class="header">
            <img src="img/logo-small.jpg" alt="logo">
            <h2>Edit Instansi</h2>
        </div>
        <div class="form-container">
            <form method="POST" action="{{ route('instansi.update', $instansi->id) }}">
                @csrf
                @method('PUT')
                <input type="text" id="nama_instansi" name="nama_instansi" value="{{ $instansi->nama }}" placeholder="Nama Instansi">
                <input type="text" id="kontak" name="kontak" value="{{ $instansi->kontak }}" placeholder="Kontak">
                <input type="text" id="jenis_kerja_sama" name="jenis_kerja_sama" value="{{ $instansi->jenis_kerja_sama }}" placeholder="Jenis Kerja Sama">
                <input type="date" id="dibuat_pada" name="dibuat_pada" value="{{ $instansi->dibuat_pada->format('Y-m-d') }}" placeholder="Dibuat Pada">
                <input type="date" id="diperbarui_pada" name="diperbarui_pada" value="{{ $instansi->diperbarui_pada->format('Y-m-d') }}" placeholder="Diperbarui Pada">
                <button type="submit">Simpan</button>
            </form>
        </div>
    </div>
</body>
</html>
