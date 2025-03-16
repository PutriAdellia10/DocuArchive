<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Disposisi</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {

            margin: auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 2.5rem;
            color: #333;
        }

        .content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        .left-section, .right-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 1.75rem;
            margin-bottom: 20px;
            color: #007BFF;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
            width: 30%;
            padding: 10px 15px;
            background-color: #f7f7f7;
            font-weight: bold;
        }

        table td {
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
        }

        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            padding: 12px;
            background-color: #6c757d;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .icon-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin-bottom: 20px;
        }

        .icon-back:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }

        .icon-back i {
            font-size: 20px;
        }

        .disposisi-options {
            margin-bottom: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }

            .left-section, .right-section {
                padding: 15px;
            }
        }

        .disposisi-label {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #555;
        }

        /* Kartu Disposisi untuk Pimpinan */
    .tindak-lanjut {
        max-width: 600px; /* Membatasi lebar maksimal kartu */
        margin: 20px auto; /* Mengatur margin agar kartu berada di tengah */
        padding: 15px; /* Mengurangi padding untuk membuat kartu lebih kecil */
        background-color: #fff; /* Memberikan latar belakang putih */
        border-radius: 8px; /* Menambahkan border radius untuk sudut melengkung */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Memberikan sedikit bayangan untuk efek depth */
    }

    </style>
</head>
<body>
    <div class="container">
        <h1>Disposisi</h1>
        <div class="content">
            <!-- Left Section -->
@if(auth()->user()->peran != 'Pimpinan')
    <div class="left-section">
        <form action="{{ route('disposisi.submit', $surat->id) }}" method="POST">
            @csrf
            <input type="hidden" name="surat_id" value="{{ $surat->id }}">
            <h2>Disposisi</h2>

            <div class="disposisi-options">
                <label for="keterangan" class="disposisi-label">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
            </div>
            <div class="disposisi-options">
                <label for="lampiran" class="disposisi-label">Lampiran:</label>
                <select id="lampiran" name="lampiran" class="form-select">
                    <option value="ada">Ada</option>
                    <option value="tidak_ada">Tidak Ada</option>
                </select>
            </div>

            <div class="card-footer text-end mt-4">
                <button type="submit" class="btn-success">Kirim Disposisi</button>
            </div>
        </form>
    </div>
@endif

     <!-- Right Section -->
     <div class="right-section">
        <h2>Daftar Disposisi</h2>
        <!-- Tindak Lanjut Form -->
        @if(auth()->user()->peran == 'Pimpinan')
        <form action="{{ route('disposisi.submit', $surat->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea name="catatan" id="catatan" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-secondary mb-2">Tindak Lanjut</button>
        </form>
        @endif

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Surat</th>
                    <th>Keterangan</th>
                    <th>Lampiran</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @if($disposisiEntries->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center">Belum ada disposisi yang dikirim.</td>
                    </tr>
                @else
                    @foreach($disposisiEntries as $disposisi)
                        <tr>
                            <td>{{ $disposisi->surat_id }}</td>
                            <td>{{ $disposisi->keterangan }}</td>
                            <td>{{ $disposisi->lampiran }}</td>
                            <td>

                                @if($disposisi->catatan)
                                    {{ $disposisi->catatan }}
                                @else
                                    --
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="card-footer text-end mt-4">
    <button type="button" class="btn btn-secondary" onclick="goBack()">Tutup</button>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       function goBack() {
    // Mendapatkan halaman sebelumnya
    const previousPage = document.referrer;

    // Tentukan URL untuk Surat Masuk dan Surat Keluar
    const suratMasukUrl = '/surat-masuk';
    const suratKeluarUrl = '/surat-keluar';

    // Periksa apakah halaman sebelumnya adalah Surat Masuk atau Surat Keluar
    if (previousPage.includes('surat-masuk')) {
        window.location.href = suratMasukUrl;
    } else if (previousPage.includes('surat-keluar')) {
        window.location.href = suratKeluarUrl;
    } else {
        window.location.href = suratMasukUrl; // Default ke Surat Masuk jika halaman sebelumnya tidak ditemukan
    }
}

        // Tampilkan notifikasi sukses jika ada pesan dari session
        @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK'
        });
        @endif

        document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        // Periksa apakah form memiliki elemen "catatan" (khusus Pimpinan)
        const catatan = this.querySelector('#catatan')?.value.trim();

        // Periksa apakah form memiliki elemen "keterangan" dan "lampiran" (khusus Sekretariat)
        const keterangan = this.querySelector('#keterangan')?.value.trim();
        const lampiran = this.querySelector('#lampiran')?.value.trim();

        // Validasi khusus untuk Pimpinan
        if (catatan !== undefined && (!catatan || catatan === '')) {
            e.preventDefault();
            Swal.fire({
                title: 'Error!',
                text: 'Harap isi catatan sebelum mengirim.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        // Validasi khusus untuk Sekretariat
        if (keterangan !== undefined && lampiran !== undefined) {
            if (!keterangan || !lampiran) {
                e.preventDefault();
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap isi semua data (keterangan dan lampiran) sebelum mengirim.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return;
            }
        }
    });
});
    </script>

</body>
</html>
