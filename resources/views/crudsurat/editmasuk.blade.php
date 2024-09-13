<!-- Tambahkan CSS untuk Pop-Up Modal -->
<style>
    /* CSS for Modal */
    .modal {
        display: none; /* Modal disembunyikan secara default */
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4); /* Latar belakang hitam transparan */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 50%; /* Ukuran lebar modal */
        box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .form-buttons {
        margin-top: 20px;
        text-align: right;
    }

    .form-buttons button {
        margin-right: 10px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .file-info {
        font-size: 12px;
        color: #555;
    }
</style>

<!-- Modal untuk Edit Surat Masuk -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3 id="modalTitle">Edit Surat Masuk</h3>
        <form id="editForm" action="#" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" id="surat_id" name="surat_id">

            <div class="form-group">
                <label for="no_agenda">No Agenda *</label>
                <input type="text" id="no_agenda" name="no_agenda" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal Masuk *</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>

            <div class="form-group">
                <label for="id_asal_surat">Asal Surat *</label>
                <select id="id_asal_surat" name="id_asal_surat" required>
                    <option value="">--Pilih--</option>
                    @foreach($instansi as $inst)
                        <option value="{{ $inst->id }}">{{ $inst->nama_instansi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="no_surat">No Surat *</label>
                <input type="text" id="no_surat" name="no_surat" required>
            </div>

            <div class="form-group">
                <label for="tanggal_surat">Tanggal Surat *</label>
                <input type="date" id="tanggal_surat" name="tanggal_surat" required>
            </div>

            <div class="form-group">
                <label for="perihal">Perihal</label>
                <input type="text" id="perihal" name="perihal">
            </div>

            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea id="konten" name="konten"></textarea>
            </div>

            <div class="form-group">
                <label for="id_sifat_surat">Sifat Surat *</label>
                <select id="id_sifat_surat" name="id_sifat_surat" required>
                    <option value="">--Pilih--</option>
                    @foreach($sifatSurat as $sifat)
                        <option value="{{ $sifat->id }}">{{ $sifat->nama_sifat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required>
                    <option value="">--Pilih--</option>
                    <option value="Masuk">Masuk</option>
                    <option value="Keluar">Keluar</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dokumen">Dokumen Elektronik *</label>
                <input type="file" id="dokumen" name="dokumen" accept=".pdf">
                <p class="file-info">
                    Keterangan: <br>
                    - Tipe file yang bisa diunggah adalah *.pdf. <br>
                    - Ukuran file yang bisa diunggah maksimal 10 Mb.
                </p>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" id="closeModalBtn" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan Script untuk Mengatur Modal -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const editModal = document.getElementById('editModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Fungsi untuk membuka modal dan mengisi data
        function openModal(suratId) {
            const form = document.getElementById('editForm');
            form.action = `/surat-masuk/${suratId}`; // Set URL action form
            document.getElementById('surat_id').value = suratId;

            // Ambil data existing dan masukkan ke dalam form
            fetch(`/surat-masuk/${suratId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('no_agenda').value = data.no_agenda;
                    document.getElementById('tanggal').value = data.tanggal;
                    document.getElementById('id_asal_surat').value = data.id_asal_surat;
                    document.getElementById('no_surat').value = data.no_surat;
                    document.getElementById('tanggal_surat').value = data.tanggal_surat;
                    document.getElementById('perihal').value = data.perihal;
                    document.getElementById('konten').value = data.konten;
                    document.getElementById('id_sifat_surat').value = data.id_sifat_surat;
                    document.getElementById('status').value = data.status;
                });

            editModal.style.display = 'flex';
        }

        // Buka modal saat tombol edit diklik
        document.querySelectorAll('.edit-button').forEach(button => {
            button.addEventListener('click', (event) => {
                event.preventDefault();
                const suratId = button.getAttribute('data-suratid');
                openModal(suratId);
            });
        });

        // Tutup modal
        closeModalBtn.addEventListener('click', () => {
            editModal.style.display = 'none';
        });

        // Tutup modal jika pengguna mengklik di luar modal
        window.addEventListener('click', (event) => {
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        });
    });
</script>
