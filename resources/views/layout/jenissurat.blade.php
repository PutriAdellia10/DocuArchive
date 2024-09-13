@extends('layout.navbar')

@section('konten')
    <div class="container mt-4">
        <h1 class="mb-4">Daftar Jenis Surat</h1>
        <a href="{{ route('jenis_surat.create') }}" class="btn btn-primary mb-3">Tambah Jenis Surat</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis</th>
                        <th>Deskripsi</th>
                        <th>Dibuat Pada</th>
                        <th>Diperbarui Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisSurat as $jenis)
                        <tr>
                            <td>{{ $jenis->id }}</td>
                            <td>{{ $jenis->nama_jenis }}</td>
                            <td>{{ $jenis->deskripsi }}</td>
                            <td>{{ $jenis->dibuat_pada->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $jenis->diperbarui_pada->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <a href="{{ route('jenis_surat.edit', $jenis->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('jenis_surat.destroy', $jenis->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada jenis surat ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
