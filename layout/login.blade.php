<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docu Archive Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F5F5F5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 900px;
            height: 500px;
            display: flex;
            background-color: #fff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        }
        .left-side {
            width: 60%;
            position: relative;
            background-image: url('d:/Magang 2024/bg apk.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .left-side img {
            position: absolute;
            max-width: 60%;  /* Increased from 50% to 60% */
            max-height: 60%; /* Increased from 50% to 60% */
            object-fit: contain;
        }
        .right-side {
            width: 40%;
            padding: 30px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .logo img {
            display: block;
            margin: 0 auto 20px auto;
            width: 100px;
            height: auto;
        }
        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
            color: #000;
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-button {
            width: 100%;
            padding: 10px;
            background-color: #75C9C8;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <!-- Image in the center of the background -->
            <img src="d:/Magang 2024/bg3.jpg" alt="Centered Image">
        </div>
        <div class="right-side">
            <div class="logo">
                <img src="d:/Magang 2024/logo.jpg" alt="Docu Archive Logo">
            </div>
            <h2>Welcome To Docu Archive</h2>
            <p>Silahkan Login Terlebih Dahulu!</p>
            <form>
                <input type="text" placeholder="Username" required>
                <input type="password" placeholder="Password" required>
                <button type="submit" class="login-button">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
