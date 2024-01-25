@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
<div class="container bg-white rounded p-4 my-5">
    @if(session('success'))
        <div class="alert alert-success success-alert container">
            <p class="text-success">{{ session('success') }}</p>
        </div>
    @elseif(session('warning'))
        <div class="alert alert-warning warning-alert container">
            <p class="text-warning">{{ session('warning') }}</p>
        </div>
    @endif
    <div class="container-fluid row m-0 p-0">
        <div class="col-lg-6 col-sm-6 m-0 p-0 px-4" id="left-section">
            <h1 class="mt-4 text-uppercase">Terimakasih telah melakukan absensi masuk</h1>
            <p class="col-md-8 m-0 p-0 mt-5 mb-3">Anda telah melakukan absensi masuk, jangan lupa untuk melakukan absensi pulang!</p>
            <a href="{{ url()->previous() }}" class="btn btn-secondary bg-greendark"><i class="fa-solid fa-arrow-left"></i> Kembali ke halaman absensi</a>
        </div>
        <div class="col-lg-6 col-sm-6 m-0 p-0 " id="right-section">
            <img heigh="600px" src="{{ URL::asset('images/admin/Work-in-progress.gif') }}" alt="success-absensi-gif">
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