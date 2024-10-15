<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Surat Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .card-header {
            background-color: #343a40; /* Dark gray */
            color: #ffffff; /* White text */
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff; /* Primary blue for active tab */
            color: #ffffff; /* White text for active tab */
        }
        .nav-tabs .nav-link {
            color: #007bff; /* Primary blue for inactive tabs */
        }
        .nav-tabs .nav-link:hover {
            color: #0056b3; /* Darker blue on hover */
        }
        .form-control-plaintext {
            background-color: #e9ecef; /* Light gray background for read-only fields */
            border-radius: 4px;
            padding: 8px;
            color: #495057; /* Dark gray text */
        }
        .btn-primary {
            background-color: #007bff; /* Primary blue */
            border-color: #007bff; /* Same color for border */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Matching border color on hover */
        }
        .btn-secondary {
            background-color: #6c757d; /* Gray for secondary button */
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268; /* Darker gray on hover */
            border-color: #545b62;
        }
        .card-footer {
            background-color: #f8f9fa; /* Match body background */
            border-top: 1px solid #dee2e6; /* Light border */
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Dokumen Elektronik</h4>
            </div>
            <div class="card-body">
                <div class="mt-3">
<iframe src="{{ asset('storage/dokumen_masuk/' . basename($surat->dokumen)) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="button" class="btn btn-secondary" onclick="location.href='{{ route('surat.index') }}'">Tutup</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
