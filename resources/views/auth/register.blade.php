<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive - Daftar</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #d3d3d3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 36px;
            margin-bottom: 10px;
            color: #000;
        }

        .logo {
            width: 50px;
        }

        .container {
            background-color: #f2f2f2;
            border-radius: 8px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 380px;
            width: 100%;
            overflow: hidden;
        }

        .form-header {
            background-color: #c8ebe9;
            padding: 20px;
            text-align: center;
            color: #000;
        }

        .form-title {
            margin: 0;
            font-size: 24px;
        }

        .form-container {
            background-color: #f2f2f2;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .form-group .required {
            color: red;
        }

        .form-group .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }

        .btn-submit {
            background-color: #71c9c0;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-submit:hover {
            background-color: #60b2aa;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            color: #60b2aa;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .text-danger {
            color: red;
        }

        /* Additional styles for select */
        .form-group select {
            appearance: none;
            -webkit-appearance: none;
            background-color: #fff;
            background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"%3E%3Cpath d="M7 10l5 5 5-5z" fill="%23999" /%3E%3C/svg%3E');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px;
            cursor: pointer;
        }

        .form-group select:focus {
            outline: none;
            border-color: #71c9c0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="title">Docu Archive</h1>
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="logo">
    </div>

    <div class="container">
        <div class="form-header">
            <h2 class="form-title">Daftar</h2>
        </div>
        <div class="form-container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama_pengguna">Nama Pengguna <span class="required">*</span></label>
                    <input type="text" id="nama_pengguna" name="nama_pengguna" placeholder="Nama Pengguna" value="{{ old('nama_pengguna') }}" required>
                    @error('nama_pengguna')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
                    @error('nama_lengkap')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kata_sandi">Kata Sandi <span class="required">*</span></label>
                    <input type="password" id="kata_sandi" name="kata_sandi" placeholder="Kata Sandi" required>
                    @error('kata_sandi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="konfirmasi_kata_sandi">Konfirmasi Kata Sandi <span class="required">*</span></label>
                    <input type="password" id="kata_sandi_confirmation" name="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                    @error('kata_sandi_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="peran">Peran <span class="required">*</span></label>
                    <select id="peran" name="peran" required>
                        <option value="" disabled selected>Pilih Peran</option>
                        <option value="Admin" {{ old('peran') == 'Admin' ? 'selected' : '' }}>Admin</option>
                        <option value="Karyawan" {{ old('peran') == 'Karyawan' ? 'selected' : '' }}>Karyawan</option>
                        <option value="Sekretariat" {{ old('peran') == 'Sekretariat' ? 'selected' : '' }}>Sekretariat</option>
                        <option value="Pimpinan" {{ old('peran') == 'Pimpinan' ? 'selected' : '' }}>Pimpinan</option>
                    </select>
                    @error('peran')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">Daftar</button>
            </form>
        </div>
        <div class="card-footer text-center">
            <p><a href="{{ route('login') }}" class="back-link">Batal, Kembali ke Halaman Login</a></p>
        </div>
    </div>

    @if ($errors->any())
        <div class="text-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>
