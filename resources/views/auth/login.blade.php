<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 1200px;
            height: 100vh;
            display: flex;
            background-color: #fff;
        }
        .left-side {
            width: 60%;
            background-image: url('{{ asset('img/bg apk.jpg') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .left-side img {
            max-width: 60%;
            max-height: 60%;
            object-fit: contain;
        }
        .right-side {
            width: 40%;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .logo img {
            width: 100px;
            height: auto;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 26px; /* Mengubah ukuran tulisan */
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        p {
            font-size: 18px; /* Mengubah ukuran tulisan */
            margin-bottom: 20px;
            color: #000;
            text-align: center;
        }
        input, select {
            width: 100%;
            padding: 15px; /* Mengubah ukuran padding kotak input */
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px; /* Mengubah ukuran tulisan dalam input */
        }
        .login-button {
            width: 100%;
            padding: 15px; /* Mengubah ukuran padding tombol */
            background-color: #75C9C8;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }
        .login-button:hover {
            background-color: #4fbdbd;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
        .register-text {
            margin-top: 10px;
            text-align: center;
        }
        .register-text a {
            color: #75C9C8;
            text-decoration: none;
        }
        .register-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="{{ asset('img/bg3.jpg') }}" alt="logo" class="logo">
        </div>
        <div class="right-side">
            <div class="logo">
                <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="logo">
            </div>
            <h2>Selamat Datang di DocuArchive</h2>
            <p>Silahkan Login Terlebih Dahulu!</p>
            @if(session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="login-email">Email <span class="text-danger"></span></label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Kata Sandi <span class="text-danger"></span></label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="login-kata_sandi" name="kata_sandi" placeholder="Kata Sandi" required>
                    </div>
                </div>
                <button type="submit" class="login-button">Login</button>
            </form>
            <div class="register-text">
                <p>Belum punya Akun? <a href="{{ route('register') }}">Daftar Disini</a></p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
