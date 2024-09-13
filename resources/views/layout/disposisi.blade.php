
@extends('layout.navbar')
@section('konten')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>LEMBAR DISPOSISI</h1>
        </div>
        <div class="card-body">
            <p><strong>Nomor Agenda:</strong> {{ $surat->no_agenda }}</p>
            <p><strong>Sifat Surat:</strong> {{ $surat->sifatSurat->nama_sifat }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ $surat->tanggal_diterima }}</p>
            <p><strong>Tanggal Penyelesaian:</strong> {{ $surat->tanggal_penyelesaian ? $surat->tanggal_penyelesaian->format('d F Y') : '-' }}</p>
            <p><strong>Asal Surat:</strong> {{ $surat->instansi ? $surat->instansi->nama_instansi : 'Tidak diketahui' }}</p>
            <p><strong>Nomor Surat:</strong> {{ $surat->no_surat }}</p>
            <p><strong>Tanggal Surat:</strong> {{ $surat->tanggal_surat }}</p>
            <p><strong>Perihal:</strong> {{ $surat->perihal }}</p>
            <p><strong>Keterangan:</strong> {{ $surat->konten }}</p>

            <h2>INSTRUKSI / INFORMASI DITERUSKAN KEPADA</h2>
            <p>{{ $surat->instruksi }}</p>
        </div>
    </div>

    <a href="{{ route('surat.indexMasuk') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection
