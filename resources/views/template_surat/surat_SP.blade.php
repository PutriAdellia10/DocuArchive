'<!DOCTYPE html>
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
                <span>Isi Data Surat SP</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="form-section" id="form-section">
                <label for="nomor">Nomor</label>
                <input type="text" id="nomor" placeholder="Nomor surat" oninput="updatePreview()" value="SP.001/HRD/PT-RM/XI/2024">

                <label for="nama">Nama Karyawan</label>
                <input type="text" id="nama" placeholder="Nama Karyawan" oninput="updatePreview()" value="Bapak Anwar Fadillah">

                <label for="jabatan">Jabatan Karyawan</label>
                <input type="text" id="jabatan" placeholder="Jabatan Karyawan" oninput="updatePreview()" value="Staff Administrasi">

                <label for="divisi">Divisi</label>
                <input type="text" id="divisi" placeholder="Divisi Karyawan" oninput="updatePreview()" value="Keuangan">

                <label for="pelanggaran">Deskripsi Pelanggaran</label>
                <textarea id="pelanggaran" placeholder="Deskripsi pelanggaran" oninput="updatePreview()">Sering terlambat masuk kerja lebih dari 5 hari pada periode Oktober 2024.</textarea>

                <label for="peraturan">Peraturan yang Dilanggar</label>
                <input type="text" id="peraturan" placeholder="Peraturan yang dilanggar" oninput="updatePreview()" value="Peraturan Perusahaan Bab 3 Pasal 8">

                <label for="periode">Periode Berlaku</label>
                <input type="text" id="periode" placeholder="Periode Berlaku SP" oninput="updatePreview()" value="3 bulan">

                <label for="signatureName">Hormat Kami</label>
                <input type="text" id="signatureName" placeholder="Nama Pengirim" oninput="updatePreview()" value="Manager HRD">
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
                    <h2><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROCKET MANAJEMEN</span></h2> <!-- Menambahkan 4 spasi non-breaking -->
                    <p>Jl. Solo Km. 5,5 Sleman Yogyakarta<br>
                       Telp (0271) 2424242, Fax (0127) 2424245<br>
                       email: manajemenrocket@gmail.com, www.rocketmanajemen.com
                    </p>
                </div>
            </div>
            <hr>
            <p>Nomor: <span id="preview-nomor">SP.001/HRD/PT-RM/XI/2024</span><br>
               Hal: Surat Peringatan (SP)
            </p>
            <p>Kepada Yth.<br>
               Nama: <span id="preview-nama">Bapak Anwar Fadillah</span><br>
               Jabatan: <span id="preview-jabatan">Staff Administrasi</span><br>
               Divisi: <span id="preview-divisi">Keuangan</span><br>
               Di Tempat
            </p>
            <br><p>Dengan Hormat,</p>
            <p class="indented">Sehubungan dengan evaluasi kinerja dan disiplin kerja yang dilakukan oleh perusahaan, kami dengan ini memberikan Surat Peringatan kepada Saudara/i <span id="preview-nama">Bapak Anwar Fadillah</span> atas pelanggaran peraturan perusahaan sebagai berikut:</p>
            <p class="indented"><span id="preview-pelanggaran">Sering terlambat masuk kerja lebih dari 5 hari pada periode Oktober 2024.</span> Tindakan ini telah melanggar aturan dan tata tertib perusahaan yang tercantum dalam <span id="preview-peraturan">Peraturan Perusahaan Bab 3 Pasal 8</span>.</p>
            <p class="indented">Peringatan ini berlaku selama <span id="preview-periode">3 bulan</span> sejak tanggal surat ini dikeluarkan. Kami berharap agar Saudara/i <span id="preview-nama">Bapak Anwar Fadillah</span> dapat segera memperbaiki sikap dan kinerja serta tidak mengulangi tindakan serupa di masa yang akan datang. Apabila dalam periode tersebut masih terjadi pelanggaran, perusahaan akan mengambil tindakan lebih lanjut sesuai kebijakan yang berlaku, yang dapat berupa Surat Peringatan Kedua hingga pemutusan hubungan kerja (PHK).</p>
            <p class="indented">Demikian Surat Peringatan ini disampaikan untuk dipatuhi sebagaimana mestinya.</p>
            <p style="text-align: right;"> <br>Yogyakarta, <span id="preview-tanggal">05 November 2024</span></p>
            <p class="signature">Hormat Kami,<br><br>
                <div id="signature-right" style="text-align: right;"> <!-- Wrap both elements in this div -->
                    <div id="preview-signature"></div> <!-- Placeholder for signature image -->
                <span id="preview-signatureName">Manager HRD</span><br>

            </div>
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
        document.getElementById('signature-preview-img').src = reader.result; // Update the image preview container
        updatePreview(); // Call updatePreview to reflect the image in the letter preview
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        signatureImgSrc = ""; // Clear image if no file is selected
        updatePreview();
    }
}

        function updatePreview() {
            document.getElementById('preview-nomor').innerText = document.getElementById('nomor').value;
            document.getElementById('preview-nama').innerText = document.getElementById('nama').value;
            document.getElementById('preview-jabatan').innerText = document.getElementById('jabatan').value;
            document.getElementById('preview-divisi').innerText = document.getElementById('divisi').value;
            document.getElementById('preview-pelanggaran').innerText = document.getElementById('pelanggaran').value;
            document.getElementById('preview-peraturan').innerText = document.getElementById('peraturan').value;
            document.getElementById('preview-periode').innerText = document.getElementById('periode').value;
            document.getElementById('preview-signatureName').innerText = document.getElementById('signatureName').value;
            const signaturePreviewElement = document.getElementById('preview-signature');
    if (signatureImgSrc) {
        signaturePreviewElement.innerHTML = `<img src="${signatureImgSrc}" alt="Signature" style="max-width: 100px; height: auto;">`;
    } else {
        signaturePreviewElement.innerHTML = "";
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
        pdf.save("Surat_Peringatan.pdf");
    });
}

    </script>
</body>
</html>
'
