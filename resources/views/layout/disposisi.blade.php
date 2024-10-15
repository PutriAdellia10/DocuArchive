<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .content {
            display: flex;
            gap: 20px;
        }

        .left-section, .right-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .left-section {
            flex: 3;
        }

        .right-section {
            flex: 2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .right-section label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .right-section input[type="checkbox"] {
            margin-right: 10px;
        }

        .right-section select, .right-section textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .right-section button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .right-section button:hover {
            background-color: #0056b3;
        }

        .pdf-preview {
            background-color: #f2f2f2;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 20px;
        }

        .pdf-preview img {
            width: 50px;
            height: 50px;
        }

        .pdf-preview p {
            margin: 10px 0;
            font-weight: bold;
        }

        .pdf-preview a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        .pdf-preview a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Disposisi Surat</h1>

        <div class="content">
            <!-- Left Section - Data Surat -->
            <div class="left-section">
                <h2>Data Surat</h2>
                <table>
                    <tr>
                        <th>Nomor Agenda:</th>
                        <td>{{ $surat->no_agenda }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Masuk:</th>
                        <td>{{ $surat->tanggal }}</td>
                    </tr>
                    <tr>
                        <th>Asal Surat:</th>
                        <td>{{ $surat->instansi->nama_instansi }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Surat:</th>
                        <td>{{ $surat->no_surat }}</td>
                    </tr>
                    <tr>
                        <th>Perihal:</th>
                        <td>{{ $surat->perihal }}</td>
                    </tr>
                </table>

                <!-- File Preview Section -->
                <div class="pdf-preview">
                    <img src="https://cdn-icons-png.flaticon.com/512/337/337946.png" alt="PDF Icon">
                    <p>{{ $surat->file_name }}</p>
                    <a href="{{ route('surat.show', $surat->id) }}">Preview</a>
                </div>
            </div>

            <!-- Right Section - Tindak Lanjut / Disposisi -->
            <form action="{{ route('disposisi.kirim') }}" method="POST">
                @csrf
                <h2>Tindak Lanjut / Disposisi</h2>
                <label><input type="checkbox"> 1. Untuk Diketahui</label>
                <label><input type="checkbox"> 2. Untuk Diperhatikan</label>
                <label><input type="checkbox"> 3. Untuk Dipelajari</label>
                <label><input type="checkbox"> 4. Disiapkan Jawaban</label>
                <label><input type="checkbox"> 5. Jawab Langsung</label>
                <label><input type="checkbox"> 6. ACC untuk Tindak Lanjut</label>
                <label><input type="checkbox"> 7. Ambil Langkah Seperlunya</label>
                <label><input type="checkbox"> 8. Dibicarakan</label>
                <label><input type="checkbox"> 9. Dilaporkan</label>
                <label><input type="checkbox"> 10. Segera Selesaikan</label>
                <label><input type="checkbox"> 11. Copy Untuk</label>

                <label for="kepada">Kepada:</label>
                <select id="kepada">
                    <option value="">-- Pilih --</option>
                    <option value="1">Sekretariat</option>
                    <option value="2">Pimpinan</option>
                </select>

                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" rows="3"></textarea>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>

</body>
</html>
