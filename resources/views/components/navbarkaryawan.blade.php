
<style>
    body {
        margin: 0; /* Reset margin */
        font-family: Arial, sans-serif; /* Set a clean font */
    }

    .navbar-top {
        width: 100%;
        background: linear-gradient(90deg, #0077b6, #00b4d8);
        padding: 10px 20px;
        box-sizing: border-box;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: fixed;
        top: 0;
        z-index: 1000;
        height: 60px;
        border-bottom: 2px solid #005f73;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .navbar-top .logo {
        display: flex;
        align-items: center;
        color: #ffffff;
        font-weight: bold;
        font-size: 20px;
    }

    .navbar-top .logo img {
        width: 40px;
        margin-right: 10px;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .people-icon {
        position: relative;
        display: flex;
        align-items: center;
        font-size: 24px;
        color: #ffffff;
        cursor: pointer;
        transition: color 0.3s;
    }

    .people-icon:hover {
        color: #f0f0f0; /* Lighter color on hover */
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 60px;
        right: 0;
        background: linear-gradient(180deg, #0077b6, #00b4d8);
        border: 1px solid #005f73;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 10px;
        width: 250px;
        z-index: 1000;
        color: #ffffff;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        opacity: 0;
        visibility: hidden;
    }

    .dropdown-menu.show {
        display: block;
        opacity: 1; /* Fade-in effect */
        visibility: visible; /* Make visible */
    }

    .dropdown-item {
        color: #ffffff;
        text-decoration: none;
        padding: 10px;
        display: flex;
        align-items: center;
        transition: background 0.3s, color 0.3s;
    }

    .dropdown-item i {
        margin-right: 10px;
    }

    .dropdown-item:hover {
        background: rgba(255, 255, 255, 0.1); /* Light background on hover */
        border-radius: 5px; /* Rounded corners */
    }

    .user-info {
        font-weight: bold;
        margin-bottom: 10px; /* Spacing below user info */
    }
</style>

<!-- Navbar -->
<div class="navbar-top">
    <div class="logo">
        <img src="{{ asset('img/logo.jpg') }}" alt="Logo">
        <span>Docu Archive</span>
    </div>
    <div class="people-icon" onclick="toggleDropdown()">
        <i class="fa fa-user"></i>
        <div class="dropdown-menu" id="user-dropdown">
            <div class="user-info">
                <span>Pimpinan</span>
            </div>
            <!-- Button Edit Profil -->
            <form id="edit.profile-form" action="{{route('profile.edit')}}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="bi bi-person-circle"></i> Edit Profil
            </a>
            <!-- Button Logout -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>
</div>

@include('profile.edit')
<!-- Menambahkan Bootstrap JS di bagian bawah -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById("user-dropdown");
        dropdown.classList.toggle("show");
    }

    // Close dropdown if clicked outside
    document.addEventListener("click", function (event) {
        const dropdown = document.getElementById("user-dropdown");
        const icon = document.querySelector(".people-icon");
        if (!icon.contains(event.target)) {
            dropdown.classList.remove("show");
        }
    });
</script>
