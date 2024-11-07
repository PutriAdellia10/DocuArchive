<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perjanjian Karyawan</title>
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
        position: relative;
    }

    .container {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px; /* Kurangi jarak antar kartu */
    }

    .form-section, .preview-section {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        flex: 1;
        min-width: 300px;
        max-width: 48%; /* Mengurangi lebar maksimal kartu */
    }

    h2 {
        background-color: #0077B6;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-top: 0;
        text-align: center;
    }

    .label {
        display: inline-block;
        min-width: 150px; /* Tentukan lebar minimal untuk label */
        margin-right: 10px; /* Memberikan sedikit jarak */
    }

    .value {
        padding-left: 20px; /* Memberikan indentasi */
    }.label {
        display: inline-block;
        min-width: 150px; /* Tentukan lebar minimal untuk label */
        margin-right: 10px; /* Memberikan sedikit jarak */
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

    input:focus, textarea:focus {
        border: 1px solid #CAF0F8;
        outline: none;
    }

    button {
        background-color: #00bfae;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        transition: background-color 0.3s, transform 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    button:hover {
        background-color: #009e91;
        transform: translateY(-2px);
    }

    .icon-button i {
        margin-right: 10px;
    }

    .icon-button .arrow-down {
        transition: transform 0.3s ease;
    }

    .icon-button.active .arrow-down {
        transform: rotate(180deg);
    }

    .preview-section h2 {
        text-align: center;
    }

    .preview {
            padding: 20px;
            min-height: 450px;
            line-height: 1.5;
            font-size: 12px;
            color: #333;
            text-align: justify;
            position: relative;
            background-color: transparent; /* Ubah menjadi transparan */
            border: none; /* Hilangkan border */
    .preview p {
        margin: 10px 0;
    }

    .preview p:first-of-type,
    .preview p:last-of-type {
        text-align: right;
    }

    .right-align {
        text-align: right;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            gap: 10px; /* Menambahkan jarak antara kolom pada perangkat kecil */
        }
    }

    .margin-top {
        margin-top: 20px;
    }

    .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: transparent;
        color: #00bfae;
        border: none;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Styles for signature image */
    #signature-preview {
        margin-top: 20px;
        display: none;
    }
    #signature-preview img {
        max-width: 100%;
        height: auto;
    }

    /* Signature positioning */
    #signature-preview-placeholder img {
        display: block;
        margin: 0 auto;
        max-width: 100px;
        height: auto;
    }


    </style>
</head>
<body>

    <a href="{{ route('generete') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="container">
        <div class="form-section">
            <h2>Surat Perjanjian Karyawan</h2>

            <button class="icon-button" onclick="toggleSection('biodataSection', this)">
                <i class="fas fa-user"></i> Biodata Diri <i class="fas fa-chevron-down arrow-down"></i>
            </button>
            <div id="biodataSection" style="display:none;">
                <label for="name">Nama *</label>
                <input type="text" id="name" placeholder="Nama Wajib Diisi!" oninput="updatePreview()">

                <label for="birthplace">Tempat, Tgl Lahir *</label>
                <input type="text" id="birthplace" placeholder="Contoh: Padang, 13 Nov 2002" oninput="updatePreview()">

                <label for="address">Alamat *</label>
                <input type="text" id="address" placeholder="Alamat Wajib Diisi!" oninput="updatePreview()">

                <label for="position">Jabatan *</label>
                <input type="text" id="position" placeholder="Jabatan Wajib Diisi!" oninput="updatePreview()">

                 <label for="letterDate">Tanggal Surat *</label>
            <input type="text" id="letterDate" placeholder="Contoh: 18 Oktober 2024" oninput="updatePreview()">

            <label for="letterPlace">Tempat Surat *</label>
            <input type="text" id="letterPlace" placeholder="Contoh: Jakarta" oninput="updatePreview()">
            </div>

            <button class="icon-button" onclick="toggleSection('errorSection', this)">
                <i class="fas fa-exclamation-triangle"></i> Kesalahan <i class="fas fa-chevron-down arrow-down"></i>
            </button>
            <div id="errorSection" style="display:none;">
                <label for="mistake">Kesalahan *</label>
                <textarea id="mistake" placeholder="Jelaskan kesalahan yang dilakukan..." rows="4" oninput="updatePreview()"></textarea>
            </div>

            <h3>Tanda Tangan Elektronik</h3>
            <input type="file" id="signatureInput" accept="image/*" onchange="previewSignature()" />
            <div id="signature-preview">
                <img id="signatureImg" src="" alt="Preview Tanda Tangan">
            </div>

            <button type="button" class="margin-top" onclick="downloadPDF()">
                <i class="fas fa-download"></i> Download PDF
            </button>
        </div>

        <div class="preview-section">
            <h2>Preview</h2>
            <div id="letter-preview" class="preview">
                <p style="text-align:center; font-weight: bold; text-transform: uppercase;">
                    SURAT PERJANJIAN TIDAK MENGULANGI KESALAHAN
                </p>

                <p>Saya yang bertanda tangan di bawah ini:</p>
                <p style="color: #000000;">
            <span class="label">Nama</span>: <span class="value">${name}</span><br>
            <span class="label">Tempat, Tgl Lahir</span>: <span class="value">${birthplace}</span><br>
            <span class="label">Alamat</span>: <span class="value">${address}</span><br>
            <span class="label">Jabatan</span>: <span class="value">${position}</span>
        </p>

        <p style="color: #000000; text-indent: 20px;">
            Dengan ini saya mengakui telah melanggar peraturan perusahaan yaitu: <br>[Kesalahan]<br>
            dan saya berjanji tidak akan mengulangi kesalahan tersebut. Apabila di kemudian hari saya melakukan kesalahan yang sama maka saya bersedia mendapatkan sanksi dari perusahaan sesuai dengan peraturan yang berlaku.
        </p>

        <p style="color: #000000; text-indent: 20px;">
            Demikian Surat Perjanjian ini saya buat dengan sebenar-benarnya dan penuh kesadaran tanpa ada paksaan dari pihak manapun.
        </p>


                <p style="text-align:right;">Jakarta, 18 Oktober 2024</p>
                <p style="text-align:right;">Yang Menyatakan</p>

                <div id="signature-preview-placeholder" style="text-align: right;">
                    <img id="signatureImg" src="" alt="Pratinjau Tanda Tangan" style="max-width: 100px; height: auto;">
                </div>
                <p style="text-align:right;">( [Nama] )</p>


            </div>
        </div>
    </div>

    <script>
        function toggleSection(sectionId, button) {
            const section = document.getElementById(sectionId);
            if (section.style.display === 'none') {
                section.style.display = 'block';
                button.classList.add('active');
            } else {
                section.style.display = 'none';
                button.classList.remove('active');
            }
        }

        function updatePreview() {
    const name = document.getElementById('name').value || '[Nama]';
    const birthplace = document.getElementById('birthplace').value || '[Tempat, Tgl Lahir]';
    const address = document.getElementById('address').value || '[Alamat]';
    const position = document.getElementById('position').value || '[Jabatan]';
    const mistake = document.getElementById('mistake').value || '[Kesalahan]';
    const letterDate = document.getElementById('letterDate').value || '[Tanggal Surat]';
    const letterPlace = document.getElementById('letterPlace').value || '[Tempat Surat]';

    const signatureImg = document.getElementById('signatureImg');
    const signatureImgSrc = signatureImg ? signatureImg.src : '';

    const letterPreview = document.getElementById('letter-preview');
    letterPreview.innerHTML = `
        <p style="text-align:center; font-weight: bold; text-transform: uppercase;">
            SURAT PERJANJIAN TIDAK MENGULANGI KESALAHAN
        </p>

        <p>Saya yang bertanda tangan di bawah ini:</p>
        <p style="color: #000000;">
            <span class="label">Nama</span>: ${name}<br>
            <span class="label">Tempat, Tgl Lahir</span>: ${birthplace}<br>
            <span class="label">Alamat</span>: ${address}<br>
            <span class="label">Jabatan</span>: ${position}
        </p>

        <p style="color: #000000; text-indent: 20px;">
            Dengan ini saya mengakui telah melanggar peraturan perusahaan yaitu:<br>${mistake}<br>
            dan saya berjanji tidak akan mengulangi kesalahan tersebut. Apabila di kemudian hari saya melakukan kesalahan yang sama maka saya bersedia mendapatkan sanksi dari perusahaan sesuai dengan peraturan yang berlaku.
        </p>

        <p style="color: #000000; text-indent: 20px;">
            Demikian Surat Perjanjian ini saya buat dengan sebenar-benarnya dan penuh kesadaran tanpa ada paksaan dari pihak manapun.
        </p>

        <p style="text-align:right; padding-right: 20px;">${letterPlace}, ${letterDate}</p>
        <p style="text-align:right; padding-right: 20px;">Yang Menyatakan</p>

        <div style="position: relative; text-align: right;">
            ${signatureImgSrc ? `<img src="${signatureImgSrc}" style="position: absolute; top: -40px; right: 0; max-width: 100px; height: auto;" />` : ''}
            <p style="text-align:right; margin-top: 40px;">( ${name} )</p>
        </div>
    `;
}




function previewSignature() {
    const file = document.getElementById('signatureInput').files[0];
    const reader = new FileReader();
    reader.onloadend = function () {
        document.getElementById('signatureImg').src = reader.result;
        document.getElementById('signature-preview').style.display = 'block';
        updatePreview(); // Perbarui pratinjau dengan gambar tanda tangan
    };
    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById('signature-preview').style.display = 'none';
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

            // Define margins in mm (3 cm = 30 mm)
            const margin = 30;
            const pageWidth = pdf.internal.pageSize.getWidth() - 2 * margin;
            const pageHeight = pdf.internal.pageSize.getHeight() - 2 * margin;

            pdf.setFont("times", "normal"); // Set font to Times New Roman
            pdf.setFontSize(12); // Set font size to 12 pt
            pdf.setLineHeightFactor(1.5); // Set line height to 1.5

            // Calculate image size to fit within A4 page with margins
            const imgWidth = pageWidth;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            // Add the image with margins
            pdf.addImage(imgData, 'PNG', margin, margin, imgWidth, imgHeight);

            pdf.save("Surat_Perjanjian_Karyawan.pdf");
        });
    }
    </script>
</body>
</html>
