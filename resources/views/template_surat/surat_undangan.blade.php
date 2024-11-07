<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Surat Undangan</title>
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

        /* Indentation for specific paragraphs */
        .indented {
            text-indent: 30px; /* Adjust the value as needed for the indentation */
        }

        /* Align signature to the right */
        .signature {
            text-align: right; /* Align text to the right */
            margin-top: 20px; /* Space above the signature */
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
            display: none; /* Initially hidden */
        }

        /* Print Styles */
        @media print {
            .container {
                box-shadow: none;
                border: none;
                margin: 0;
            }
        }
        #signature-container {
                margin-top: 20px;
                position: relative;
                height: 200px;
                border: 1px dashed #ccc;
                border-radius: 5px;
            }
            #signature-preview-img {
                width: 100px;
                height: auto;
            }
    </style>
</head>
<body>

    <div class="container">
        <div class="section">
            <button class="toggle-button" onclick="toggleForm()">
                <span>Isi Data Surat</span>
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="form-section" id="form-section">
                <label for="nomor">Nomor</label>
                <input type="text" id="nomor" placeholder="Nomor surat" oninput="updatePreview()" value="A.004/DTU/PTRM/VIII/2024">

                <label for="lampiran">Lampiran</label>
                <input type="text" id="lampiran" placeholder="Lampiran" oninput="updatePreview()" value="-">

                <label for="recipient">Kepada Yth.</label>
                <input type="text" id="recipient" placeholder="Nama penerima surat" oninput="updatePreview()" value="Bapak Nurul Saputro">
                <label for="jabatan">Jabatan Penerima</label>
                <input type="text" id="jabatan" placeholder="Jabatan penerima" oninput="updatePreview()" value="General Manager PT. Rocket Manajemen">

                <label for="alamat">Alamat Penerima</label>
                <textarea id="alamat" placeholder="Alamat penerima surat" oninput="updatePreview()">Jl. Taman Siswa Km. 12 Bantul, Yogyakarta</textarea>

                <label for="hari">Hari</label>
                <input type="text" id="hari" placeholder="Hari" oninput="updatePreview()" value="Senin-Rabu">

                <label for="tanggal">Tanggal</label>
                <input type="text" id="tanggal" placeholder="Tanggal" oninput="updatePreview()" value="28 Juni - 30 Juni 2024">

                <label for="jam">Jam</label>
                <input type="text" id="jam" placeholder="Jam" oninput="updatePreview()" value="09.00-16.00 WIB">

                <label for="tempat">Tempat</label>
                <input type="text" id="tempat" placeholder="Tempat" oninput="updatePreview()" value="Hotel Grand Royal">

                <label for="signatureName">Hormat Kami</label>
                <input type="text" id="signatureName" placeholder="Nama Pengirim" oninput="updatePreview()" value="Dr. Ir. H. Sutomo">
            </div>
            <h3>Tanda Tangan Elektronik</h3>
            <input type="file" id="signatureInput" accept="image/*" onchange="previewSignature()" />
            <div id="signature-container">
                <div id="signature-preview-placeholder" class="signature-preview">
                    <img id="signature-preview-img" src="" alt="Preview Tanda Tangan">
                </div>
            </div>
            <button type="button" onclick="downloadPDF()"><i class="fas fa-download"></i> Download PDF</button>
        </div>
        <div id="letter-preview" class="preview">
            <div class="header">
                <img src="{{ asset('img/logo_transparent.png') }}" alt="Logo Perusahaan">
                <div style="text-align: center;">
                    <h2><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ROCKET MANAJEMEN</span></h2> <!-- Menambahkan 4 spasi non-breaking -->
                    <p>Jl. Solo Km. 5,5 Sleman Yogyakarta<br>
                       Telp (0271) 2424242, Fax (0127) 2424245<br>
                       email: manajemenrocket@gmail.com, www.rocketmanajemen.com
                    </p>
                </div>
            </div>



            <hr>
            <p>Nomor: <span id="preview-nomor">A.004/DTU/PTRM/VIII/2024</span><br>
               Lampiran: <span id="preview-lampiran">-</span><br>
               Hal: Undangan Rapat
            </p>
            <p>Kepada Yth.<br>
                <span id="preview-recipient">Bapak Nurul Saputro</span><br>
                <span id="preview-jabatan">General Manager PT. Rocket Manajemen</span><br>
                <span id="preview-alamat">Jl. Taman Siswa Km. 12 Bantul, Yogyakarta</span>
             </p>


            <br><p>Dengan hormat,</p><br>
            <p class="indented">Sehubungan dengan PT. Rocket Manajemen yang akan melaksanakan rapat kerja nasional,
                 maka dengan ini mengundang seluruh General Manager dan Manager Marketing Cabang seluruh Indonesia agar dapat menghadiri rapat kerja nasional tersebut.
                  Rapat kerja nasional ini akan dilaksanakan pada:</p><br>
            <p class="centered indented">Hari: <span id="preview-hari">Senin-Rabu</span><br>
                <p class="centered indented"> Tanggal: <span id="preview-tanggal">28 Juni - 30 Juni 2024</span><br>
                <p class="centered indented"> Waktu: <span id="preview-jam">09.00-16.00 WIB</span><br>
                <p class="centered indented"> Tempat: <span id="preview-tempat">Hotel Grand Royal</span><br>
            </p>
            <br>
            <p class="indented">Demikian surat ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu kami ucapkan terima kasih.</p>
            <!-- In the signature section of the preview area -->
        <p class="signature">Hormat Kami,<br><br>
            <div id="signature-right" style="text-align: right;"> <!-- Wrap both elements in this div -->
                <div id="preview-signature"></div> <!-- Placeholder for signature image -->
                <span id="preview-signatureName">Dr. Ir. H. Sutomo</span>
            </div>
</p>


        </div>
    </div>

    <script>
        function toggleForm() {
    const formSection = document.getElementById("form-section");
    const icon = document.querySelector(".toggle-button i");

    if (formSection.style.display === "none" || formSection.style.display === "") {
        formSection.style.display = "block"; // Tampilkan form
        icon.classList.remove("fa-chevron-down");
        icon.classList.add("fa-chevron-up");
    } else {
        formSection.style.display = "none"; // Sembunyikan form
        icon.classList.remove("fa-chevron-up");
        icon.classList.add("fa-chevron-down");
    }
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
    document.getElementById('preview-lampiran').innerText = document.getElementById('lampiran').value;
    document.getElementById('preview-recipient').innerText = document.getElementById('recipient').value;
    document.getElementById('preview-jabatan').innerText = document.getElementById('jabatan').value; // Baris baru untuk memperbarui jabatan
    document.getElementById('preview-alamat').innerText = document.getElementById('alamat').value;
    document.getElementById('preview-hari').innerText = document.getElementById('hari').value;
    document.getElementById('preview-tanggal').innerText = document.getElementById('tanggal').value;
    document.getElementById('preview-jam').innerText = document.getElementById('jam').value;
    document.getElementById('preview-tempat').innerText = document.getElementById('tempat').value;
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
        pdf.save("Surat_Undangan.pdf");
    });
}

   </script>

</body>
</html>
