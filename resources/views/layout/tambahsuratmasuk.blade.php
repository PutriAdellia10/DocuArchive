<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat Masuk</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <img src="path/to/icon.png" alt="Icon">
            <h1>Tambah Surat Masuk</h1>
        </div>
        <form>
            <div class="form-group">
                <label for="nomor-agenda">Nomor Agenda *</label>
                <input type="text" id="nomor-agenda" value="005" required>
            </div>

            <div class="form-group">
                <label for="tanggal-masuk">Tanggal Masuk *</label>
                <input type="date" id="tanggal-masuk" required>
            </div>

            <div class="form-group">
                <label for="asal-surat">Asal Surat *</label>
                <select id="asal-surat" required>
                    <option value="">--Pilih--</option>
                    <!-- Add options here -->
                </select>
            </div>

            <div class="form-group">
                <label for="nomor-surat">Nomor Surat *</label>
                <input type="text" id="nomor-surat" required>
            </div>

            <div class="form-group">
                <label for="nomor-surat-lain">Nomor Surat *</label>
                <input type="text" id="nomor-surat-lain" required>
            </div>

            <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" id="perihal">
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea id="keterangan"></textarea>
            </div>

            <div class="form-group">
                <label for="sifat-surat">Sifat Surat *</label>
                <select id="sifat-surat" required>
                    <option value="">--Pilih--</option>
                    <!-- Add options here -->
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen-elektronik">Dokumen Elektronik *</label>
                <input type="file" id="dokumen-elektronik" accept=".pdf" required>
                <p class="file-info">
                    Keterangan: <br>
                    - Tipe file yang bisa diunggah adalah *.pdf. <br>
                    - Ukuran file yang bisa diunggah maksimal 10 Mb.
                </p>
            </div>

            <div class="form-buttons">
                <button type="submit">Simpan</button>
                <button type="reset">Batal</button>
            </div>
        </form>
    </div>
</body>
</html>
