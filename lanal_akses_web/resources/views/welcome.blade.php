
@extends('layout.public.app')

@section('title-page', 'Lanal Akses | Home')
  
@section('content')


<nav class="navbar navbar-dark" style="background-color: #4E6766">
  <a class="navbar-brand" href="{{ url('/') }}"><img src="https://i.ibb.co/MR438ww/logo-no-bg.png" alt="logo-no-bg" width="30" height="30"></a>
  
  <a href="{{ route('personil.login') }}"><button class="btn btn-success my-2 my-sm-0" type="submit">Login</button></a>
  
</nav>

<body>
  <div class="container py-5">
      <div class="row align-item-center p-5">
          <div class="col-lg-7 col-md-6 col-sm-12">
              <div class="title-heading">
                  <h1 class="fw-bold text-black title-dark mt-2 mb-3">SELAMAT DATANG DI WEBSITE</h1>
                  <h1 class="fw-bold text-black title-dark mt-2 mb-3">LANAL <span style="color: #E1BF36">AKSES</span></h1>
                  <p class="lead">LANAL AKSES merupakan Website absensi dan data personil pangkalan TNI Angkatan V - Pangakalan TNI Angakatan Laut Banyuwangi. </p>
                  <a class="btn btn-primary-1 btn-lg " href="#" role="button">Absen Sekarang <iconify-icon icon="mdi:clock" width="16"></iconify-icon></a>
              </div>
          </div>
      </div>
  </div>
  
  {{-- CARD DISPLAY --}}
  <div class="container-fluid bg-light py-2 align-item-center">
    <div class="row justify-content-center mt-5">
      
      <div class="card col-lg-5 col-md-6  m-3 p-4">
          <div class="card-body">
            <h5 class="card-title"><iconify-icon icon="mdi:clock" width="36" style="color: #4E6766"></iconify-icon></h5>
            <h6 class="card-subtitle mb-2 text-black">Sistem Absensi Personil</h6>
            <p class="card-text">Absensi personil menggunakan QRcode scanner berbasis mobile dan akses koordinat menggunakan GPS.</p>
          </div>
      </div>
      
      <div class="card col-lg-5 col-md-6  m-3 p-4">
          <div class="card-body">
            <h5 class="card-title"><iconify-icon icon="material-symbols:group" width="36" style="color: #4E6766"></iconify-icon></h5>
            <h6 class="card-subtitle mb-2 text-black">Data Personil & PNS</h6>
            <p class="card-text">Data personil & PNS yang disimpan secara digital menggunakan server SQL dengan akses mudah melalui website</p>
          </div>
      </div>  

    </div>

    <div class="row justify-content-center my-5">

      <div class="card col-lg-5 col-md-6  m-3 p-4">
        <div class="card-body">
          <h5 class="card-title"><iconify-icon icon="material-symbols:print" width="36" style="color: #4E6766"></iconify-icon></h5>
          <h6 class="card-subtitle mb-2 text-black">Cetak Riwayat Hidup dan Data Lengkap Personil</h6>
          <p class="card-text">Fitur yang memudahkan personil untuk dapat mencetak Riwayat Hidup dengan format sesuai dengan yang ditentukan di Staf Minlog</p>
        </div>
      </div>
      
      <div class="card col-lg-5 col-md-6  m-3 p-4">
        <div class="card-body">
          <h5 class="card-title"><iconify-icon icon="clarity:directory-solid" width="36" style="color: #4E6766"></iconify-icon></h5>
          <h6 class="card-subtitle mb-2 text-black">Arsip Data Absensi</h6>
          <p class="card-text">Data Personil yang telah melakukan absensi bisa dicetak dan dieksport berdasarkan jangka waktu harian, mingguan dan bulanan</p>
        </div>
      </div>

    </div>
  </div>

  {{-- DESKRIPSI --}}
  <div class="container-fluid bg-white p-5">
    <div class="row align-item-center p-5">
        <div class="col-lg-7 col-md-6 col-sm-12">
            <div class="title-heading">
               <h3 class="fw-bold text-black title-dark mt-2 mb-3">Deskripsi Singkat Mengenai Lanal Banyuwangi</h3>
                <p class="lead">Lanal Banyuwangi yang beralamat di Jl. Gatot Subroto, Lkr. Kp. Baru, Bulusan, Kec. Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68455, Indonesia merupakan satuan TNI AL yang berada di bawah Pangkalan Utama TNI Angkatan Laut (Lantamal) V, Koarmada II.</p>
            </div>
        </div>
    </div>
</div>


@endsection
