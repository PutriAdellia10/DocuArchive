<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Surat Keluar</title>
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
                <h4>Detail Data Surat Keluar</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('surat.keluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="data-surat-tab" data-bs-toggle="tab" data-bs-target="#data-surat" type="button" role="tab" aria-controls="data-surat" aria-selected="true">Data Surat</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dokumen-elektronik-tab" data-bs-toggle="tab" data-bs-target="#dokumen-elektronik" type="button" role="tab" aria-controls="dokumen-elektronik" aria-selected="false">Dokumen Elektronik</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="data-surat" role="tabpanel" aria-labelledby="data-surat-tab">
                            <div class="mt-3">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Nomor Agenda:</label>
                                    <div class="col-sm-9">
                                            <p class="form-control-plaintext">{{ $surat->no_agenda }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Tanggal Keluar:</label>
                                    <div class="col-sm-9">
                                            <p class="form-control-plaintext">{{ $surat->tanggal }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label">Pengirim</label>
                                    <div class="col-sm-9">
                                        <p class="form-control-plaintext ">{{ $surat->pengirim_eksternal ?? $surat->pengirim->jabatan }}</p>
                                    </div>
                                </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tujuan Surat:</label>
                                <div class="col-sm-9">
                                        <p class="form-control-plaintext ">
                                            @if ($surat->tujuan_pengguna_id)
                                                {{ $surat->tujuanPengguna->jabatan ?? '--' }}
                                            @elseif ($surat->tujuan_instansi_id)
                                                {{ $surat->tujuanInstansi->nama_instansi ?? '--' }}
                                            @else
                                                --
                                            @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Nomor Surat:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $surat->no_surat }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal Surat:</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $surat->tanggal_surat }}</p>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Perihal:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="perihal" class="form-control" value="{{ $surat->perihal }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label">Keterangan:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="konten" class="form-control" value="{{ $surat->konten }}">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    <div class="tab-pane fade" id="dokumen-elektronik" role="tabpanel" aria-labelledby="dokumen-elektronik-tab">
                        <div class="mt-3">
                            <iframe src="{{ asset('storage/dokumen_keluar/' . basename($surat->dokumen)) }}" style="width: 100%; height: 600px;" frameborder="0"></iframe>

                            <!-- Form for updating the document -->
                            <div class="mt-3">
                                <label for="dokumen">Upload Dokumen Baru (PDF, DOC, DOCX):</label>
                                <input type="file" class="form-control" name="dokumen">
                            </div>
                        </div>
                    </div>

                <div class="card-footer text-end">
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Tutup</button>
                    @if(auth()->user()->peran !== 'Pimpinan')
                    <button type="submit" class="btn btn-secondary">Update Surat</button>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
