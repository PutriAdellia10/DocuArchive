<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Surat dan Disposisi</title>
    <link href="{{ asset('css/bootstrap-grid.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
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
        }

        table th {
            text-align: left;
            width: 30%;
            padding: 10px 15px;
            background-color: #f7f7f7;
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

        .pdf-preview {
            text-align: center;
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 10px;
        }

        .pdf-preview img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }

        .pdf-preview p {
            font-size: 16px;
            font-weight: 600;
            color: #555;
        }

        .pdf-preview a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        .pdf-preview a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .content {
                grid-template-columns: 1fr;
            }
        }
        .right-section {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.disposisi-options {
    margin-bottom: 20px;
}

.disposisi-label {
    display: block; /* Stack checkboxes vertically */
    margin-bottom: 10px; /* Space between checkboxes */
    font-size: 14px; /* Font size */
    color: #555; /* Text color */
}

.form-select, .form-textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ddd;
    font-size: 14px;
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
.icon-back {
    display: inline-flex; /* Aligns icon nicely */
    align-items: center; /* Centers icon vertically */
    justify-content: center; /* Centers icon horizontally */
    width: 40px; /* Set a fixed width */
    height: 40px; /* Set a fixed height */
    background-color: #007bff; /* Primary Bootstrap color */
    color: white; /* Icon color */
    text-decoration: none; /* Removes underline from the link */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
    margin-right: 15px; /* Space between the icon and other elements */
    margin-bottom: 20px; /* Space between the icon and content below */
}

.icon-back:hover {
    background-color: #0056b3; /* Darker shade on hover */
    transform: scale(1.1); /* Slightly enlarges the icon on hover */
}

.icon-back i {
    font-size: 20px; /* Adjust the icon size */
}

    </style>
</head>
<body>

<div class="container">
    <h1>Edit Data Surat dan Disposisi</h1>
    <a href="{{ route('surat.index') }}" class="icon-back">
        <i class="bi bi-backspace"></i>
    </a>

    <div class="content">
        <!-- Left Section: Edit Surat -->
        <form action="{{ route('surat.update', $surat->id) }}" method="POST" class="left-section">
            @csrf
            @method('PUT')
            <h2>Edit Data Surat</h2>
            <table>
                <tr>
                    <th>Nomor Agenda:</th>
                    <td><input type="text" name="no_agenda" value="{{ $surat->no_agenda }}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Tanggal Masuk:</th>
                    <td><input type="date" name="tanggal" value="{{ $surat->tanggal }}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Asal Surat:</th>
                    <td><input type="text" name="asal_surat" value="{{ $surat->instansi->nama_instansi }}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Nomor Surat:</th>
                    <td><input type="text" name="no_surat" value="{{ $surat->no_surat }}" class="form-control"></td>
                </tr>
                <tr>
                    <th>Perihal:</th>
                    <td><input type="text" name="perihal" value="{{ $surat->perihal }}" class="form-control"></td>
                </tr>
            </table>
            <button type="submit" class="btn-primary">Simpan Perubahan</button>

            <div class="pdf-preview mt-4">
                <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF Icon">
                <p>{{ $surat->file_name }}</p>
                <a href="{{ route('surat.show', $surat->id) }}">Preview File</a>
            </div>
        </form>

<!-- Right Section: Disposisi -->
<form action="{{ route('disposisi.kirim') }}" method="POST" class="right-section">
    @csrf
    <h2>Tindak Lanjut / Disposisi</h2>

    <!-- Container for checkboxes -->
    <div class="disposisi-options">
        @foreach(['Untuk Diketahui', 'Untuk Diperhatikan', 'Untuk Dipelajari', 'Disiapkan Jawaban', 'Jawab Langsung', 'ACC untuk Tindak Lanjut', 'Ambil Langkah Seperlunya', 'Dibicarakan', 'Dilaporkan', 'Segera Selesaikan', 'Copy Untuk'] as $option)
            <label class="disposisi-label">
                <input type="checkbox" name="disposisi[]" value="{{ $option }}"> {{ $loop->iteration }}. {{ $option }}
            </label>
        @endforeach
    </div>

    <label for="kepada">Kepada:</label>
    <select id="kepada" name="kepada" class="form-select">
        <option value="">-- Pilih --</option>
        <option value="Sekretariat">Sekretariat</option>
        <option value="Pimpinan">Pimpinan</option>
        <option value="Karyawan">Karyawan</option>
        <option value="Admin">Admin</option>
    </select>

    <label for="keterangan">Keterangan:</label>
    <textarea id="keterangan" name="keterangan" rows="4" placeholder="Tambahkan keterangan..." class="form-textarea"></textarea>

    <button type="submit" class="btn btn-primary">Kirim Disposisi</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
