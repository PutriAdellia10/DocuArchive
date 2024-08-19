<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('judul-halaman')</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="logo">
                <h2>Docu Archive</h2>
            </div>
            <nav class="nav-menu">
                <ul>
                    <li><a href="#"><img src="{{ asset('img/dashboard.jpeg') }}" alt="Dashboard Icon">Dashboard</a></li>
                    <li><a href="#"><img src="{{ asset('img/surat.png') }}" alt="Surat Icon">Surat</a></li>
                    <li><a href="#"><img src="{{ asset('img/laporan.png') }}" alt="Laporan Icon">Laporan</a></li>
                    <li><a href="#"><img src="{{ asset('img/master.png') }}" alt="Master Icon">Master</a></li>
                    <li><a href="#"><img src="{{ asset('img/instansi.png') }}" alt="Instansi Icon">Instansi</a></li>
                    <li><a href="#"><img src="{{ asset('img/pengaturan.png') }}" alt="Pengaturan Icon">Pengaturan</a></li>
                </ul>
            </nav>
        </aside>

        <main class="content-wrapper">
            @yield('konten')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
