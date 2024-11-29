<!-- resources/views/profile/modal.blade.php -->
<!-- Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <!-- Close Button -->
        <span class="close-btn" id="closeModal">&times;</span>

        <!-- Modal Header -->
        <h5>Edit Profil</h5>

        <!-- Modal Form -->
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input untuk Nama Pengguna -->
            <div class="mb-3">
                <label for="edit_nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="edit_nama_pengguna" name="nama_pengguna" required>
            </div>

            <!-- Input untuk Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Input untuk Kata Sandi -->
            <div class="mb-3">
                <label for="edit_kata_sandi" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="edit_kata_sandi" name="kata_sandi" required>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalBtn">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Tombol untuk membuka modal -->
<button id="openModal" class="btn btn-primary">Edit Profil</button>

<!-- Style untuk Modal -->
<style>
    /* Modal Background */
    .modal {
        display: none; /* Sembunyikan modal secara default */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Background gelap dengan transparansi */
        overflow: auto;
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Modal Content */
    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 40px;
        border: 1px solid #888;
        width: 100%;
        max-width: 600px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        animation: zoomIn 0.3s ease-out;
    }

    /* Title Header */
    .modal-content h5 {
        font-size: 1.75rem;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
        font-weight: bold;
    }

    /* Close Button */
    .close-btn {
        color: #aaa;
        font-size: 32px;
        font-weight: bold;
        position: absolute;
        top: 15px;
        right: 20px;
        cursor: pointer;
    }

    .close-btn:hover,
    .close-btn:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /* Form Fields */
    .form-label {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .form-control {
        font-size: 1rem;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin-bottom: 1.5rem;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    /* Modal Footer */
    .modal-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
    }

    .modal-footer button {
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .modal-footer .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .modal-footer .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .modal-footer .btn-secondary:hover {
        background-color: #5a6268;
    }

    .modal-footer .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Animasi untuk modal */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes zoomIn {
        from { transform: scale(0.7); }
        to { transform: scale(1); }
    }
</style>

<!-- JavaScript untuk Menangani Modal -->
<script>
    // Dapatkan modal dan tombol
    var modal = document.getElementById("editProfileModal");
    var openModalButton = document.getElementById("openModal");
    var closeModalButton = document.getElementById("closeModal");
    var closeModalBtn = document.getElementById("closeModalBtn");

    // Ketika tombol 'Edit Profil' di-klik, modal akan muncul
    openModalButton.onclick = function() {
        modal.style.display = "block";
    }

    // Ketika tombol 'X' di-klik, modal akan ditutup
    closeModalButton.onclick = function() {
        modal.style.display = "none";
    }

    // Ketika tombol 'Tutup' di-klik, modal akan ditutup
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Tutup modal jika klik di luar modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
