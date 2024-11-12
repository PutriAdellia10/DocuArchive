<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
       body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 20px;
            background-color: #eef2f3;
            font-size: 12px;
            line-height: 1.5;
        }

        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            background-color: white;
        }

        .section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            flex: 0 0 40%;
            max-width: 40%;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .preview {
        flex: 1;
        max-height: none;
        overflow-y: visible;
        padding: 20px;
        /* background-color: #f9f9f9; */ /* Hapus atau komentari baris ini */
        line-height: 1.5;
        font-size: 14px;
        color: #333;
        text-align: justify;
    }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .header img {
            max-height: 50px;
            margin-right: 20px;
        }

        h2 {
            color: black;
            margin: 0;
            padding: 0;
            text-align: left;
        }

        p {
            margin: 0;
        }

        .indented {
            text-indent: 30px;
        }

        .preview {
        flex: 1;
        max-height: none;
        overflow-y: visible;
        padding: 20px;
        /* background-color: #f9f9f9; */ /* Hapus atau komentari baris ini */
        line-height: 1.5;
        font-size: 14px;
        color: #333;
        text-align: justify;
    }

    .signature {
            text-align: right;
            margin-top: 20px;
        }

        button {
            width: 100%;
            background-color: #00bfae;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s, transform 0.2s;
            margin: 10px 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .toggle-button {
            background-color: #f39c12;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-bottom: 10px;
        }

        .toggle-button:hover {
            background-color: #e67e22;
        }

        .form-section {
            display: none;
        }

        @media print {
            .container {
                box-shadow: none;
                border: none;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <a href="{{ route('generete') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

<div class="container">
    <div class="section">
        <button class="toggle-button" onclick="toggleForm()">
            <span>Isi Data Surat Perintah</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div class="form-section" id="form-section">
            <label for="nomor">Nomor</label>
            <input type="text" id="nomor" placeholder="Nomor surat" oninput="updatePreview()" value="SP-001/HRD/PT-RM/XI/2024">

            <label for="pegawai">Nama Pegawai</label>
            <input type="text" id="pegawai" placeholder="Nama Pegawai" oninput="updatePreview()" value="Andi Susanto">

            <label for="jabatan">Jabatan Pegawai</label>
            <input type="text" id="jabatan" placeholder="Jabatan" oninput="updatePreview()" value="Staff Marketing">

            <label for="tugas">Tugas</label>
            <input type="text" id="tugas" placeholder="Tugas yang diberikan" oninput="updatePreview()" value="Mengelola proyek pemasaran baru">

            <label for="tanggalMulai">Tanggal Mulai</label>
            <input type="text" id="tanggalMulai" placeholder="Tanggal Mulai" oninput="updatePreview()" value="15 November 2024">

            <label for="tanggalSelesai">Tanggal Selesai</label>
            <input type="text" id="tanggalSelesai" placeholder="Tanggal Selesai" oninput="updatePreview()" value="30 November 2024">

            <label for="atasan">Nama Atasan yang Menetapkan</label>
            <input type="text" id="atasan" placeholder="Nama Atasan" oninput="updatePreview()" value="Budi Santoso">

            <label for="jabatanAtasan">Jabatan Atasan</label>
            <input type="text" id="jabatanAtasan" placeholder="Jabatan Atasan" oninput="updatePreview()" value="HRD Manager">
        </div>
        <h3>Tanda Tangan Elektronik</h3>
            <input type="file" id="signatureInput" accept="image/*" onchange="previewSignature()" />
            <div id="signature-container">
                <div id="signature-preview-placeholder" class="signature-preview">
                    <img id="signature-preview-img" src="" alt="Preview Tanda Tangan">
                </div>
            </div>
        <button onclick="downloadPDF()"><i class="fas fa-download"></i> Download PDF</button>
    </div>

    <div id="letter-preview" class="preview">
        <div class="header">
            <img src="{{ asset('img/logo_transparent.png') }}" alt="Logo Perusahaan">
            <div style="text-align: center;">

                <h2><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROCKET MANAJEMEN</span></h2>
                <p>Jl. Solo Km. 5,5 Sleman Yogyakarta<br>
                   Telp (0271) 2424242, Fax (0127) 2424245<br>
                   email: manajemenrocket@gmail.com, www.rocketmanajemen.com
                </p>
            </div>
        </div>
        <hr>
        <p>Nomor: <span id="preview-nomor">SP-001/HRD/PT-RM/XI/2024</span><br>
           Perihal: Surat Perintah Kerja
        </p>
        <p>Kepada Yth.<br>
           Nama Pegawai: <span id="preview-pegawai">Andi Susanto</span><br>
           Jabatan: <span id="preview-jabatan">Staff Marketing</span><br>
           Di Tempat
        </p>
        <br><p>Dengan Hormat,</p>
        <p class="indented">Sehubungan dengan kebutuhan perusahaan, melalui surat ini kami menugaskan Saudara/i <span id="preview-pegawai">Andi Susanto</span> yang menjabat sebagai <span id="preview-jabatan">Staff Marketing</span> untuk melaksanakan tugas <span id="preview-tugas">Mengelola proyek pemasaran baru</span>.</p>
        <p class="indented">Tugas ini dimulai dari tanggal <span id="preview-tanggalMulai">15 November 2024</span> dan diharapkan selesai pada tanggal <span id="preview-tanggalSelesai">30 November 2024</span>. Kami berharap Saudara/i dapat melaksanakan tugas ini dengan penuh tanggung jawab dan dedikasi.</p>
        <br><p>Demikian surat perintah ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.</p>
        <p class="signature">Hormat Kami,<br><br>
            <div id="signature-right" style="text-align: right;">
                <div id="preview-signature"></div>
                <span id="preview-atasan">Budi Santoso</span><br>
                Jabatan: <span id="preview-jabatanAtasan">HRD Manager</span>
            </div>
        </p>
    </div>
</div>

<script>
    function toggleForm() {
        document.getElementById('form-section').style.display =
            document.getElementById('form-section').style.display === 'none' ? 'block' : 'none';
    }
    let signatureImgSrc = ""; // Store the signature image data URL here

function previewSignature() {
const file = document.getElementById('signatureInput').files[0];
const reader = new FileReader();

reader.onloadend = function () {
    signatureImgSrc = reader.result; // Set the signature image data URL
    const img = document.getElementById('signature-preview-img');
    img.src = reader.result; // Set the image source to the loaded data URL
    img.onload = () => updatePreview(); // Ensure the image is loaded before calling updatePreview
};

if (file) {
    reader.readAsDataURL(file);
} else {
    signatureImgSrc = ""; // Clear image if no file is selected
    updatePreview();
}
}

    function updatePreview() {
        document.getElementById('preview-nomor').textContent = document.getElementById('nomor').value;
        document.getElementById('preview-pegawai').textContent = document.getElementById('pegawai').value;
        document.getElementById('preview-jabatan').textContent = document.getElementById('jabatan').value;
        document.getElementById('preview-tugas').textContent = document.getElementById('tugas').value;
        document.getElementById('preview-tanggalMulai').textContent = document.getElementById('tanggalMulai').value;
        document.getElementById('preview-tanggalSelesai').textContent = document.getElementById('tanggalSelesai').value;
        document.getElementById('preview-atasan').textContent = document.getElementById('atasan').value;
        document.getElementById('preview-jabatanAtasan').textContent = document.getElementById('jabatanAtasan').value;
        const signaturePreviewElement = document.getElementById('preview-signature');
    if (signatureImgSrc) {
        signaturePreviewElement.innerHTML = `<img src="${signatureImgSrc}" alt="Signature" style="max-height: 50px;" />`;
    } else {
        signaturePreviewElement.innerHTML = ""; // Hapus jika tidak ada tanda tangan
    }
}

    function downloadPDF() {
    const element = document.getElementById("letter-preview");

    if (!element) {
        alert("The preview element was not found. Ensure the element is available.");
        return;
    }

    html2canvas(element, {
        scale: 3, // Perbesar skala untuk resolusi lebih tinggi
        useCORS: true,
        allowTaint: true
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");

        const pdf = new jspdf.jsPDF("p", "mm", "a4");

        // Custom margin settings in mm
        const marginTop = 25;  // Top margin
        const marginLeft = 25; // Left margin
        const marginBottom = 25; // Bottom margin
        const marginRight = 25;  // Right margin

        // Page width and height minus margins
        const pageWidth = pdf.internal.pageSize.getWidth() - marginLeft - marginRight;
        const pageHeight = pdf.internal.pageSize.getHeight() - marginTop - marginBottom;

        // Set font to Times New Roman, increase font size
        pdf.setFont("times", "normal");
        pdf.setFontSize(14); // Perbesar font untuk surat

        // Calculate the image width and height within the printable area
        const imgWidth = pageWidth;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        // Add image to PDF with custom margins
        pdf.addImage(imgData, 'PNG', marginLeft, marginTop, imgWidth, imgHeight);

        // Save PDF file
        pdf.save("Surat_Mutasi.pdf");
    });
}
</script>

</body>
</html>
