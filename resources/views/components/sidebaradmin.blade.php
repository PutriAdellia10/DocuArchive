<style>
    .sidebar {
    width: 235px; /* Change this value to your desired width */
    background: linear-gradient(180deg, #0077b6, #00b4d8);
    padding: 70px 10px 20px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-top: 60px;
    border-right: 2px solid #005f73;
    box-shadow: 4px 0 6px rgba(0,0,0,0.1);
    height: calc(100vh - 60px);
    overflow-y: auto;
    box-sizing: border-box;
    }

        .sidebar a {
            text-decoration: none;
            color: #ffffff;
            margin: 10px 0;
            text-align: left;
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: bold;
            font-size: 16px;
            display: flex;
            align-items: center;
        }
        .sidebar a i {
            margin-right: 10px;
        }
        .sidebar a:hover {
            background-color: #005f73;
            color: #ffffff;
        }
        .submenu {
    display: none;
}

    .submenu.active {
    display: block;
}

    .arrow {
        margin-left: auto;
        font-size: 0.8em; /* Ukuran panah lebih kecil */
        transition: transform 0.3s; /* Transisi untuk perubahan arah panah */
    }

    .arrow.down {
        transform: rotate(90deg); /* Putar panah ke bawah */
    }
</style>
   <!-- Sidebar -->
   <div class="sidebar">
    <a href="{{ route('dashboard_admin') }}"><i class="fa fa-home"></i> Dashboard</a>
    <a href="#" id="toggle-surat">
        <i class="bi bi-envelope-fill"></i> Surat
        <span class="arrow" id="arrow-surat">&#9654;</span>
    </a>
    <div class="submenu" id="submenu-surat">
        <a href="{{ route('surat.index') }}"><i class="bi bi-envelope-arrow-up-fill"></i> Surat Masuk</a>
        <a href="{{ route('surat.keluar.index') }}"><i class="bi bi-envelope-arrow-down-fill"></i> Surat Keluar</a>
    </div>
    <a href="#" id="toggle-laporan">
        <i class="fas fa-chart-line"></i> Laporan
        <span class="arrow" id="arrow-laporan">&#9654;</span>
    </a>
    <div class="submenu" id="submenu-laporan">
        <a href="{{ route('laporan.masuk') }}"><i class="bi bi-inbox"></i> Laporan Masuk</a>
        <a href="{{ route('laporan.keluar') }}"><i class="bi bi-send"></i> Laporan Keluar</a>
        <a href="{{ route('rekapitulasi.index') }}"><i class="bi bi-save"></i> Rekapitulasi</a>
    </div>
    <a href="#" id="toggle-master">
        <i class="fas fa-file-invoice"></i> Master Data
        <span class="arrow" id="arrow-master">&#9654;</span>
    </a>
    <div class="submenu" id="submenu-master">
        <a href="{{ route('sifat_surat.index') }}"><i class="bi bi-inbox"></i> Sifat Surat</a>
        <a href="{{ route('instansi.index') }}"><i class="bi bi-buildings-fill"></i> Instansi</a>
        <a href="{{ route('profilperusahaan.index') }}"><i class="bi bi-house-gear-fill"></i> Profil Perusahaan</a>
    </div>
    <a href="#" id="toggle-pengaturan">
        <i class="fas fa-cog"></i> Pengaturan
        <span class="arrow" id="arrow-pengaturan">&#9654;</span>
    </a>
    <div class="submenu" id="submenu-pengaturan">
        <a href="{{ route('user.profil') }}"><i class="bi bi-people-fill"></i> Manajemen User</a>
        <a href="{{ route('notifikasi.index')}}"><i class="bi bi-bell-fill"></i> Notifikasi</a>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggles = [
        { toggleId: 'toggle-surat', submenuId: 'submenu-surat', arrowId: 'arrow-surat' },
        { toggleId: 'toggle-master', submenuId: 'submenu-master', arrowId: 'arrow-master' },
        { toggleId: 'toggle-laporan', submenuId: 'submenu-laporan', arrowId: 'arrow-laporan' },
        { toggleId: 'toggle-pengaturan', submenuId: 'submenu-pengaturan', arrowId: 'arrow-pengaturan' }
    ];

    // Restore submenu state from localStorage
    toggles.forEach(item => {
        const submenu = document.getElementById(item.submenuId);
        const arrow = document.getElementById(item.arrowId);

        const isActive = localStorage.getItem(item.submenuId) === 'true';
        if (isActive) {
            submenu.classList.add("active");
            arrow.innerHTML = "&#9660;"; // Point down
        }
    });

    toggles.forEach(item => {
        const toggle = document.getElementById(item.toggleId);
        const submenu = document.getElementById(item.submenuId);
        const arrow = document.getElementById(item.arrowId);

        toggle.addEventListener("click", function(event) {
            event.preventDefault();
            submenu.classList.toggle("active");

            // Change arrow direction
            if (submenu.classList.contains("active")) {
                arrow.innerHTML = "&#9660;"; // Point down
                localStorage.setItem(item.submenuId, 'true'); // Store state
            } else {
                arrow.innerHTML = "&#9654;"; // Point right
                localStorage.setItem(item.submenuId, 'false'); // Store state
            }
        });
    });
});

</script>
