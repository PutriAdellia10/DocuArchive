@extends('layout.navbar')

@section('konten')

        <div class="main-content">
            <header>
                <h1>Surat Masuk</h1>
                <div class="profile">
                    <img src="{{ asset('img/user profile.png') }}" alt="Profile Icon">
                </div>
            </header>

            <section class="content">
                <div class="card">
                    <div class="card-header">
                        <img src="{{ asset('img/surat masuk.png') }}" alt="Surat Masuk Icon">
                        <h3>Data Surat Masuk</h3>
                        <button>Tambah Surat</button>
                    </div>
                    <div class="card-body">
                        <div class="table-controls">
                            <label for="entries">Tampilkan:
                                <select id="entries">
                                    <option value="1">1</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                </select> data
                            </label>
                            <input type="text" placeholder="Cari:">
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No Agenda</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Asal Surat</th>
                                    <th>No Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Perihal</th>
                                    <th>Sifat Surat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>001</td>
                                    <td>15-juli-2024</td>
                                    <td>PT. Mandiri</td>
                                    <td>001/SPK/HRD/VI/2024</td>
                                    <td>15-juli-2024</td>
                                    <td>Undangan</td>
                                    <td>Penting</td>
                                    <td><button>Pilih</button></td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="table-footer">
                            <p>Menampilkan 1 sampai 4 dari 4 data</p>
                            <div class="pagination">
                                <button>Sebelumnya</button>
                                <span>1</span>
                                <button>Berikutnya</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @endsection
