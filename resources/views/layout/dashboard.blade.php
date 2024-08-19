@extends('layout.navbar')

@section('konten')
<main class="main-content">
    <header>
        <div class="welcome">
            <div class="welcome-image">
                <img src="{{ asset('img/bg3.jpg') }}" alt="Background Image">
            </div>
            <div class="welcome-text">
                <h1>Selamat Datang di Docu Archive</h1>
                <p>Atur dan Arsipkan Dokumen Anda dengan Mudah dan Aman</p>
                <button>Surat Masuk</button>
                <button>Surat Keluar</button>
            </div>
        </div>
        <div class="profile">
            <img src="{{ asset('img/user profile.png') }}" alt="User Profile">
        </div>
    </header>

    <section class="cards">
        <div class="card">
            <img src="{{ asset('img/surat masuk.png') }}" alt="Surat Masuk Icon">
            <h3>Surat Masuk</h3>
            <p>0</p>
        </div>
        <div class="card">
            <img src="{{ asset('img/surat keluar.png') }}" alt="Surat Keluar Icon">
            <h3>Surat Keluar</h3>
            <p>0</p>
        </div>
        <div class="card">
            <img src="{{ asset('img/surat masuk th.png') }}" alt="Surat Masuk Pertahun Icon">
            <h3>Surat Masuk Pertahun</h3>
            <p>0</p>
        </div>
        <div class="card">
            <img src="{{ asset('img/surat keluar th.png') }}" alt="Surat Keluar Pertahun Icon">
            <h3>Surat Keluar Pertahun</h3>
            <p>0</p>
        </div>
        <div class="card">
            <img src="{{ asset('img/total surat.png') }}" alt="Total Surat Icon">
            <h3>Total Surat</h3>
            <p>0</p>
        </div>
        <div class="card">
            <img src="{{ asset('img/instansi surat.png') }}" alt="Instansi Icon">
            <h3>Instansi</h3>
            <p>0</p>
        </div>
    </section>
</main>
@endsection

