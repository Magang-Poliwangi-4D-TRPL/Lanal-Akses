@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
<div class="container bg-white rounded p-4 my-5">
    <div class="alert alert-success success-alert container">
        <p class="text-success"></p>
    </div>
    <div class="container-fluid row m-0 p-0">
        <div class="col-lg-6 col-sm-6 m-0 p-0 px-4" id="left-section">
            <h1 class="mt-4 text-uppercase">Selamat Anda telah melakukan absensi hari ini</h1>
            <p class="col-md-8 m-0 p-0 mt-5 mb-3">Terimakasih telah melakukan absensi hari ini, semoga hari anda menyenangkan!</p>
            <a href="{{ url()->previous() }}" class="btn btn-secondary bg-greendark"><i class="fa-solid fa-arrow-left"></i> Kembali ke halaman absensi</a>
        </div>
        <div class="col-lg-6 col-sm-6 m-0 p-0 " id="right-section">
            <img heigh="600px" src="{{ URL::asset('images/admin/Task.gif') }}" alt="success-absensi-gif">
        </div>
</div>
<script>
    // Ambil pesan sukses dari session
    var successMessage = "{{ session('success') }}";

    // Periksa apakah ada pesan sukses
    if (successMessage) {
        // Tampilkan pesan sukses pada elemen dengan class success-alert
        document.querySelector('.success-alert p').innerText = successMessage;

        // Hapus pesan sukses dari session agar tidak ditampilkan kembali
        {{ session()->forget('success') }};
    }
</script>
@endsection