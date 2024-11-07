<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Permohonan Cuti Kerja</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

        <style>
            body {
                font-family: 'Arial', sans-serif;
                margin: 0;
                padding: 20px;
                background-color: #e8f6f7;
            }
            .container {
                display: flex; /* Using Flexbox for horizontal layout */
                gap: 20px; /* Space between elements */
            }
            .form-section, .preview {
                background-color: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                flex: 1; /* Both sections take equal space */
            }
            .preview {
                border: 1px solid #ffffff; /* Add a border for visualization */
                background-color: #ffffff; /* Background color for preview */
                font-family: 'Times New Roman', Times, serif; /* Set font for preview */
                font-size: 12pt; /* Set standard letter size */
            }
            .icon-button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                cursor: pointer;
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                margin-bottom: 10px;
            }
            label {
                display: inline-block;
                margin-bottom: 5px;
                font-weight: bold;
                width: 30%; /* Membuat label lebih sempit */
                vertical-align: middle; /* Menyelaraskan label secara vertikal */
            }

            .label-container {
    display: flex;
    justify-content: space-between;
    width: 30%; /* Lebar total elemen label */
    margin-bottom: 5px;
}

.label-text {
    font-weight: bold;
    margin-right: 5px; /* Jarak antara teks dan titik dua */
}

.label-colon {
    margin-left: auto; /* Dorong titik dua ke kanan */
}

input[type="text"], input[type="date"], textarea {
    width: 65%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}


            input[type="text"], input[type="date"], textarea {
                width: 65%; /* Lebar input lebih besar dibandingkan label */
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 5px;
                display: inline-block;
                vertical-align: middle; /* Menyelaraskan input secara vertikal */
            }
            input, textarea {
                    width: 100%;
                    padding: 10px;
                    margin: 10px 0 20px 0;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    box-sizing: border-box;
                    transition: border 0.3s ease;
                }

            .margin-top {
                margin-top: 15px;
                background-color: #28a745;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
            }
            #signature-container {
                margin-top: 20px;
                position: relative;
                height: 200px;
                border: 1px dashed #ffffff;
                border-radius: 5px;
            }
            #signature-preview-img {
                width: 100px;
                height: auto;
            }
            .back-button {
                display: inline-block;
                color: #007bff;
                text-decoration: none;
                margin-bottom: 20px;
                font-weight: bold;
            }
            .back-button i {
                margin-right: 5px;
            }

                    @media print {
            body {
                font-family: 'Times New Roman', Times, serif;
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
            p, div {
                margin: 0;
                padding: 0;
            }
        }
        </style>
    </head>
    <body>

        <a href="#" class="back-button">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="container">
            <div class="form-section">
                <h2>Permohonan Cuti</h2>

                <button class="icon-button" onclick="toggleSection('biodataSection', this)">
                    <i class="fas fa-user"></i> Biodata Diri <i class="fas fa-chevron-down arrow-down"></i>
                </button>
                <div id="biodataSection" style="display:none;">
                    <label for="name">Nama *</label>
                    <input type="text" id="name" placeholder="Nama Wajib Diisi!" oninput="updatePreview()">
                    <label for="address">Alamat *</label>
                    <input type="text" id="address" placeholder="Alamat Wajib Diisi!" oninput="updatePreview()">
                    <label for="position">Jabatan *</label>
                    <input type="text" id="position" placeholder="Jabatan Wajib Diisi!" oninput="updatePreview()">
                </div>

                <button class="icon-button" onclick="toggleSection('reasonSection', this)">
                    <i class="fas fa-file-alt"></i> Alasan Cuti <i class="fas fa-chevron-down arrow-down"></i>
                </button>
                <div id="reasonSection" style="display:none;">
                    <label for="leave-start">Tanggal Mulai Cuti *</label>
                    <input type="date" id="leave-start" oninput="updatePreview()">
                    <label for="leave-end">Tanggal Selesai Cuti *</label>
                    <input type="date" id="leave-end" oninput="updatePreview()">
                    <label for="leave-reason">Alasan Cuti *</label>
                    <textarea id="leave-reason" placeholder="Alasan Cuti Wajib Diisi!" oninput="updatePreview()"></textarea>

                    <label for="recipient">Kepada Siapa Surat Ini Ditujukan *</label>
                    <input type="text" id="recipient" placeholder="Penerima Surat Wajib Diisi!" oninput="updatePreview()">
                    <label for="location">Tempat Surat Diterbitkan *</label>
                    <input type="text" id="location" placeholder="Tempat Surat Wajib Diisi!" oninput="updatePreview()">
                    <label for="issue-date">Tanggal Surat *</label>
                    <input type="date" id="issue-date" oninput="updatePreview()">
                </div>

                <h3>Tanda Tangan Elektronik</h3>
                <input type="file" id="signatureInput" accept="image/*" onchange="previewSignature()" />
                <div id="signature-container">
                    <div id="signature-preview-placeholder" class="signature-preview">
                        <img id="signature-preview-img" src="" alt="Preview Tanda Tangan">
                    </div>
                </div>


                <button type="button" class="margin-top" onclick="downloadPDF()">
                    <i class="fas fa-download"></i> Download PDF
                </button>
            </div>

            <div id="letter-preview" class="preview">
                <p style="text-align:right;">[lokasi], [Tanggal]</p>
                <div class="form-label-group">
                    <span class="form-label">Lampiran</span><span class="label-separator">:</span> <span>1 lembar</span>
                </div>
                <div class="form-label-group">
                    <span class="form-label">Perihal</span><span class="label-separator">:</span> <span>Undangan</span>
                </div>
                <p>Kepada Yth.<br>[Kepada]<br>Di tempat</p>
                <p>Dengan Hormat,</p>
                <p style="text-indent: 20px;">Saya yang bertanda tangan di bawah ini:</p>
                <div style="text-indent: 20px;">
                    <div style="display: flex;">
                        <span style="width: 80px;">Nama</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>[Nama]</span>
                    </div>
                    <div style="display: flex;">
                        <span style="width: 80px;">Alamat</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>[Alamat]</span>
                    </div>
                    <div style="display: flex;">
                        <span style="width: 80px;">Jabatan</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>[Jabatan]</span>
                    </div>
                </div>

                <p style="text-indent: 20px;">
                    Dengan ini saya mengajukan permohonan izin cuti bekerja karena terhitung mulai tanggal [tanggal_mulai] sampai [tanggal_selesai].
                </p>
                <p>
                    Demikian Surat Permohonan Izin Cuti ini saya ajukan. Besar harapan saya agar permohonan ini dapat dikabulkan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.
                </p>
                <p style="text-align: right; margin-top: 40px;">
                    Hormat Saya,<br><br>
                    <img src="[URL Gambar Tanda Tangan]" id="signature-preview-img" style="width: 100px; height: auto;"><br>
                    [Nama]
                </p>
            </div>

        <script>
            function toggleSection(sectionId, button) {
                const section = document.getElementById(sectionId);
                section.style.display = section.style.display === "none" ? "block" : "none";
                button.classList.toggle("active");
            }

            function updatePreview() {
        const name = document.getElementById('name').value || "[NAMA]";
        const address = document.getElementById('address').value || "Payakumbuh";
        const position = document.getElementById('position').value || "Manager";

        // Format tanggal menggunakan `toLocaleDateString`
        const leaveStart = document.getElementById('leave-start').value
            ? new Date(document.getElementById('leave-start').value).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
            : "13 November";
        const leaveEnd = document.getElementById('leave-end').value
            ? new Date(document.getElementById('leave-end').value).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
            : "13 Desember";
        const leaveReason = document.getElementById('leave-reason').value || "Karena.";
        const recipient = document.getElementById('recipient').value || "Pimpinan";
        const location = document.getElementById('location').value || "Jakarta";
        const issueDate = document.getElementById('issue-date').value
            ? new Date(document.getElementById('issue-date').value).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
            : "01 November 2024";
        const signatureImg = document.getElementById('signature-preview-img').src;

        const letterPreview = document.getElementById('letter-preview');
        letterPreview.innerHTML = `
            <p style="text-align:right;">${location}, ${issueDate}</p>
                <div class="form-label-group">
                    <span class="form-label">Lampiran</span><span class="label-separator">:</span> <span>1 lembar</span>
                </div>
                <div class="form-label-group">
                    <span class="form-label">Perihal</span><span class="label-separator">:</span> <span>Undangan</span>
                </div>
                <p>Kepada Yth.<br>${recipient}<br>Di tempat</p>
                <p>Dengan Hormat,</p>
                <p style="text-indent: 20px;">Saya yang bertanda tangan di bawah ini:</p>
                <div style="text-indent: 20px;">
                    <div style="display: flex;">
                        <span style="width: 80px;">Nama</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>${name}</span>
                    </div>
                    <div style="display: flex;">
                        <span style="width: 80px;">Alamat</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>${address}</span>
                    </div>
                    <div style="display: flex;">
                        <span style="width: 80px;">Jabatan</span>
                        <span style="margin-right: 5px;">:</span>
                        <span>${position}</span>
                    </div>
                </div>
                <p style="text-indent: 20px;">
                    Dengan ini saya mengajukan permohonan izin cuti bekerja karena ${leaveReason} terhitung mulai tanggal ${leaveStart} sampai ${leaveEnd}.
                </p>
                <p>
                    Demikian Surat Permohonan Izin Cuti ini saya ajukan. Besar harapan saya agar permohonan ini dapat dikabulkan, atas perhatian Bapak/Ibu saya ucapkan terima kasih.
                </p>
                <p style="text-align: right; margin-top: 50px;">Hormat Saya,<br><img src="${signatureImg}" id="signature-preview-img" style="width: 100px; height: auto;"></p>
                <p style="text-align: right;">${name}</p>
        `;
    }


    function previewSignature() {
    const file = document.getElementById('signatureInput').files[0];
    const reader = new FileReader();
    reader.onloadend = function () {
        // Pastikan ID di sini sesuai dengan elemen gambar preview
        document.getElementById('signature-preview-img').src = reader.result;
        document.getElementById('signature-preview-img').style.display = 'block'; // Pastikan gambar ditampilkan
        updatePreview(); // Perbarui pratinjau dengan gambar tanda tangan
    };
    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById('signature-preview-img').style.display = 'none'; // Sembunyikan gambar jika tidak ada file
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

        pdf.save("Surat_Permohonan_Cuti.pdf");
    });
}


        </script>
    </body>
    </html>
