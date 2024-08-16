<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archipe Navbar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #40E0D0; /* Turquoise color */
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
            color: white;
        }
        .navbar .profile-icon {
            height: 36px; /* Reduced height */
            width: 36px; /* Reduced width */
            background-color: #00796b; /* Darker turquoise */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 4px; /* Added padding */
        }
        .navbar .profile-icon svg {
            fill: white;
            width: 24px;
            height: 24px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Docu Archipe</h1>
        <div class="profile-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>
    </div>
</body>
</html>
