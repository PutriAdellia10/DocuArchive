<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Permohonan Undur Diri</title>
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

            .container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .section {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        flex: 0 0 40%; /* 40% dari lebar kontainer */
        max-width: 40%; /* Batasan lebar maksimum */
        transition: background-color 0.3s, box-shadow 0.3s;
    }

    .preview-section {
        flex: 0 0 60%; /* 60% dari lebar kontainer */
        min-width: 400px; /* Ukuran minimum untuk kartu preview */
        min-height: 600px; /* Ukuran tinggi minimum untuk kartu preview */
        max-height: 600px; /* Menjaga tinggi maksimum */
        overflow-y: auto; /* Menambahkan scroll jika konten melebihi tinggi */
        border: 1px solid #ccc; /* Garis batas untuk menyerupai kertas */
        border-radius: 10px; /* Sudut melengkung */
        padding: 20px; /* Ruang dalam untuk teks surat */
        background-color: #ffffff; /* Latar belakang putih seperti kertas */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek kedalaman */
        font-family: 'Times New Roman', serif; /* Gaya font menyerupai surat resmi */
    }

    .section:hover {
        background-color: #f0f0f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .preview p {
        margin: 10px 0; /* Jarak antar paragraf */
        text-align: justify; /* Rata kiri dan kanan */
    }


        h2 {
            background-color: #00bfae;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 0;
            text-align: center;
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

        button:active {
            transform: translateY(0);
        }

        .form-section {
            display: none;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
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

        .preview-section {
            flex: 1;
            min-width: 300px;
            max-height: 600px;
            overflow-y: auto;
        }

        .preview-section h2 {
            text-align: center;
        }

        .preview {
    font-family: 'Times New Roman', serif;
    font-size: 12pt; /* Set font size to 12 points */
    padding: 20px;
    min-height: 450px;
    line-height: 1.5;
    color: #333;
    text-align: justify;
    position: relative;
    background-color: transparent;
    border: none;
}

.preview p {
    margin: 10px 0;
}


        .preview p:first-of-type {
            text-align: right;
        }

        .preview p:last-of-type {
            text-align: right;
        }
        .signature-upload {
            margin-top: 20px;
        }

        .signature-preview {
            margin-top: 10px;
            max-height: 100px;
            max-width: 200px;
        }
    </style>
</head>
<body>
    <a href="{{ route('generete') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

<div class="container">
    <div class="section">
        <button onclick="toggleSection('work-info', this)">
            <i class="fas fa-briefcase"></i> Informasi Pekerjaan
            <i class="fas fa-chevron-down toggle-icon"></i>
        </button>
        <div id="work-info" class="form-section">
            <label for="name">Nama *</label>
            <input type="text" id="name" placeholder="Nama Wajib Diisi!" oninput="updatePreview()" value="Rezi Suci Rahmadani">
            <label for="company">Nama Instansi/Perusahaan *</label>
            <input type="text" id="company" placeholder="Nama Instansi/Perusahaan Wajib Diisi!" oninput="updatePreview()" value="PT 123">

            <label for="position">Jabatan *</label>
            <input type="text" id="position" placeholder="Jabatan Wajib Diisi!" oninput="updatePreview()" value="Sekretaris">

            <label for="resign-date">Tanggal Pengunduran Diri *</label>
            <input type="date" id="resign-date" oninput="updatePreview()" value="2024-11-13">

            <label for="reason">Alasan Pengunduran Diri *</label>
            <textarea id="reason" rows="4" placeholder="Alasan Wajib Diisi!" oninput="updatePreview()">Saya ingin mengejar peluang karir yang lebih baik.</textarea>
        </div>

        <button onclick="toggleSection('letter-info', this)">
            <i class="fas fa-envelope"></i> Informasi Surat
            <i class="fas fa-chevron-down toggle-icon"></i>
        </button>
        <div id="letter-info" class="form-section">
            <label for="recipient">Kepada siapa surat ini ditujukan? *</label>
            <input type="text" id="recipient" placeholder="Penerima Surat Wajib Diisi!" oninput="updatePreview()" value="Yth. pimpinan">

            <label for="location">Tempat Surat Diterbitkan *</label>
            <input type="text" id="location" placeholder="Tempat Surat Wajib Diisi!" oninput="updatePreview()" value="Padang">

            <label for="date">Tanggal Surat Diterbitkan *</label>
            <input type="date" id="date" oninput="updatePreview()" value="2024-11-15">
        </div>
        <h3>Tanda Tangan Elektronik</h3>
        <input type="file" id="signatureInput" accept="image/*" onchange="previewSignature()" />
        <div id="signature-preview-placeholder" style="text-align: right;">
            <img id="signatureImg" src="" alt="Pratinjau Tanda Tangan" style="max-width: 100px; height: auto;">
        </div>
        <button type="button" onclick="downloadPDF()"><i class="fas fa-download"></i> Download PDF</button>
    </div>

    <div class="preview-section">
        <h2>Preview</h2>
        <div id="letter-preview" class="preview">
            <p>Padang, 15 November 2024</p>
            <p>Kepada<br>Yth. pimpinan<br>di Tempat</p>
            <p>Dengan hormat,</p>
            <p>Melalui surat ini, saya Rezi Suci Rahmadani dengan ini memberitahukan keputusan saya untuk mengundurkan diri dari jabatan saya sebagai Sekretaris di PT 123, terhitung mulai tanggal 13 November 2024.</p>
            <p>Saya sangat bersyukur atas kesempatan yang telah diberikan kepada saya untuk bekerja di PT 123. Namun setelah mempertimbangkan dengan matang, saya memutuskan untuk mengundurkan diri, dikarenakan saya ingin mengejar peluang karir yang lebih baik.</p>
            <p>Saya ucapkan banyak terima kasih atas dukungan dan bimbingan yang telah diberikan selama saya bekerja di PT 123. Dan tak lupa, saya memohon maaf atas segala ketidaknyamanan yang mungkin timbul dari keputusan saya ini.</p>
            <p>Demikian surat pengunduran diri saya buat dengan sebenar-benarnya dan penuh kesadaran.</p>
            <p>Hormat saya,<br> <br>Rezi Suci Rahmadani</p>
        </div>
    </div>
</div>

<script>
     let signatureImgSrc = "";

function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    section.style.display = section.style.display === 'none' || section.style.display === '' ? 'block' : 'none';
}

function updatePreview() {
    const name = document.getElementById('name').value;
    const company = document.getElementById('company').value;
    const position = document.getElementById('position').value;
    const resignDate = document.getElementById('resign-date').value;
    const reason = document.getElementById('reason').value;
    const recipient = document.getElementById('recipient').value;
    const location = document.getElementById('location').value;
    const date = document.getElementById('date').value;

    const months = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];


    const preview = `
        <p>${location}, ${new Date(date).toLocaleDateString()}</p>
        <p>Kepada<br>${recipient}<br>di Tempat</p>
        <p>Dengan hormat,</p>
        <p>Melalui surat ini, saya ${name} dengan ini memberitahukan keputusan saya untuk mengundurkan diri dari jabatan saya sebagai ${position} di ${company}, terhitung mulai tanggal ${new Date(resignDate).toLocaleDateString()}.</p>
        <p>Saya sangat bersyukur atas kesempatan yang telah diberikan kepada saya untuk bekerja di ${company}. Namun setelah mempertimbangkan dengan matang, saya memutuskan untuk mengundurkan diri, dikarenakan ${reason}.</p>
        <p>Saya ucapkan banyak terima kasih atas dukungan dan bimbingan yang telah diberikan selama saya bekerja di ${company}. Dan tak lupa, saya memohon maaf atas segala ketidaknyamanan yang mungkin timbul dari keputusan saya ini.</p>
        <p>Demikian surat pengunduran diri saya buat dengan sebenar-benarnya dan penuh kesadaran.</p>
        <p>Hormat saya,<br><br>
        ${signatureImgSrc ? `<img src="${signatureImgSrc}" style="max-width: 100px; height: auto;"><br>` : ''}
        ${name}</p>
    `;

    document.getElementById('letter-preview').innerHTML = preview;
}

function previewSignature() {
    const file = document.getElementById('signatureInput').files[0];
    const reader = new FileReader();
    reader.onloadend = function () {
        signatureImgSrc = reader.result;
        document.getElementById('signatureImg').src = signatureImgSrc;
        updatePreview(); // Update the preview with the signature
    };
    if (file) {
        reader.readAsDataURL(file);
    } else {
        signatureImgSrc = ""; // Reset if no file is selected
        updatePreview();
    }
}

function downloadPDF() {
    const element = document.getElementById("letter-preview");

    // Check if the preview element exists and is visible
    if (!element) {
        alert("The preview element was not found. Ensure the element is available.");
        return;
    }

    html2canvas(element, {
        scale: 2, // Higher scale for better quality
        useCORS: true, // Allow cross-origin images
        allowTaint: true, // Allow non-secure elements
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const pdf = new jspdf.jsPDF("p", "mm", "a4");

        const margin = 30;
        const pageWidth = pdf.internal.pageSize.getWidth() - 2 * margin;
        const pageHeight = pdf.internal.pageSize.getHeight() - 2 * margin;

        pdf.setFont("times", "normal");
        pdf.setFontSize(12);
        pdf.setLineHeightFactor(1.5);

        const imgWidth = pageWidth;
        const imgHeight = (canvas.height * imgWidth) / canvas.width;

        pdf.addImage(imgData, 'PNG', margin, margin, imgWidth, imgHeight);

        pdf.save("Surat_Undur_diri.pdf");
    });
}

</script>

</body>
</html>
