<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Tangan Elektronik</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 40px;
            background-color: #f5f5f5; /* Soft background color */
            color: #333; /* Dark text color */
        }
        h1 {
            color: #2c3e50; /* Darker heading color */
            margin-bottom: 20px;
            font-size: 2.5em; /* Increased font size for the heading */
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
        }
        #signatureCanvas {
            border: 2px solid #007BFF; /* Blue border for the canvas */
            width: 100%;
            max-width: 600px;
            height: 300px;
            background-color: #ffffff; /* White background for canvas */
            cursor: crosshair;
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Stronger shadow effect */
            margin: 20px 0; /* Margin above and below the canvas */
        }
        #controls {
            margin-top: 20px;
        }
        input[type="text"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: calc(100% - 22px);
            max-width: 300px;
            transition: border-color 0.3s; /* Transition for border color */
        }
        input[type="text"]:focus {
            border-color: #007BFF; /* Blue border on focus */
            outline: none; /* Remove default outline */
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px; /* Rounded corners for buttons */
            transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Subtle button shadow */
        }
        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px); /* Lift effect on hover */
        }
        button:active {
            background-color: #004494; /* Darker shade on click */
            transform: translateY(0); /* Remove lift effect on click */
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 2em; /* Responsive font size for smaller screens */
            }
        }
    </style>
</head>
<body>
    <h1>Gambar Tanda Tangan</h1>
    <canvas id="signatureCanvas"></canvas>
    <div id="controls">
        <input type="text" id="filename" placeholder="Masukkan nama file" />
        <button onclick="clearCanvas()">Hapus</button>
        <button onclick="downloadSignature()">Unduh Tanda Tangan</button>
    </div>

    <script>
        // Mengambil elemen canvas dan menyiapkan konteks untuk menggambar
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        let drawing = false;
        let lastX, lastY;

        // Menyesuaikan ukuran canvas
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;

        // Fungsi untuk memulai menggambar
        function startDrawing(e) {
            drawing = true;
            [lastX, lastY] = [e.clientX - canvas.offsetLeft, e.clientY - canvas.offsetTop];
        }

        // Fungsi untuk menggambar di canvas dengan smoothing
        function draw(e) {
            if (!drawing) return;
            const currentX = e.clientX - canvas.offsetLeft;
            const currentY = e.clientY - canvas.offsetTop;

            ctx.lineWidth = 2;
            ctx.lineCap = 'round';

            // Menggambar garis dengan Bezier curve untuk smoothing
            ctx.beginPath();
            ctx.moveTo(lastX, lastY);
            ctx.quadraticCurveTo(lastX, lastY, currentX, currentY);
            ctx.stroke();

            // Update last positions
            [lastX, lastY] = [currentX, currentY];
        }

        // Fungsi untuk mengakhiri gambar
        function stopDrawing() {
            drawing = false;
            ctx.closePath();
        }

        // Menambahkan event listener untuk mouse dan sentuhan
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseleave', stopDrawing);

        // Fungsi untuk menghapus canvas
        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        // Fungsi untuk mengunduh gambar tanda tangan
        function downloadSignature() {
            const link = document.createElement('a');
            const filename = document.getElementById('filename').value || 'tanda_tangan'; // Default name if empty
            link.href = canvas.toDataURL('image/png');
            link.download = `${filename}.png`; // Append .png extension
            link.click();
        }
    </script>
</body>
</html>
