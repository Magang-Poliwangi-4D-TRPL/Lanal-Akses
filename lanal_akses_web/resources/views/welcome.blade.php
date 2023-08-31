<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">

    <title>Dashboard | Lanal Akses</title>
  </head>
  <body>
    <nav class="navbar navbar-dark" style="background-color: #4E6766">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="https://i.ibb.co/MR438ww/logo-no-bg.png" alt="logo-no-bg" width="30" height="30"></a>
        
        <button class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
        
    </nav>

    <body>
        <div class="container py-5">
            <div class="row align-item-center p-5">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <div class="title-heading">
                        <h1 class="fw-bold text-black title-dark mt-2 mb-3">SELAMAT DATANG DI WEBSITE</h1>
                        <h1 class="fw-bold text-black title-dark mt-2 mb-3">LANAL <span style="color: #E1BF36">AKSES</span></h1>
                        <p class="lead">LANAL AKSES merupakan Website absensi dan data personil pangkalan TNI Angkatan V - Pangakalan TNI Angakatan Laut Banyuwangi. </p>
                        <a class="btn btn-primary btn-lg " href="#" role="button">Absen Sekarang <iconify-icon icon="mdi:clock" width="16"></iconify-icon></a>
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
        
    </body>

    <footer class="footer py-4" style="background-color: #4E6766">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <div class="footer-py-60">
                      <div class="row">
                          <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                              <a href="#" class="logo-footer">
                                  <img src="https://i.ibb.co/MR438ww/logo-no-bg.png" height="50" alt=""> <span class="text-white">LANAL AKSES</span>
                              </a>
                              <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                                  <li class="list-inline-item"><a href="https://www.instagram.com/lanal_banyuwangi/" target="_blank" class="rounded text-white"><iconify-icon icon="ri:instagram-fill" width="22"></iconify-icon></a></li>
                                  <li class="list-inline-item"><a href="https://mail.google.com/mail/u/0/?tf=cm&fs=1&to=lanal.banyuwangi.v@gmail.com" target="_blank" class="rounded text-white"><iconify-icon icon="mdi:gmail" width="22"></iconify-icon></a></li>
                                  <li class="list-inline-item"><a href="https://goo.gl/maps/Ge6e3Fwt7dE483hGA" target="_blank" class="rounded text-white"><iconify-icon icon="mdi:location" width="22"></iconify-icon></a></li>
                                  <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCWn8z46GeWsWFb93BG4DbVg/channels" target="_blank" class="rounded text-white"><iconify-icon icon="mdi:youtube" width="22"></iconify-icon></a></li>
                              </ul>
                          </div>
  
                          <div class="col-lg-4 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                              <h5 class="footer-head text-white">Alamat</h5>
                              <a class="text-white" href="https://goo.gl/maps/Ge6e3Fwt7dE483hGA" target="_blank">
                               V96X+GVW, Jl. Gatot Subroto, Lkr. Kp. Baru, Bulusan, Kec. Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68455, Indonesia
                              </a>
                          </div>
  
                          <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0 text-white">
                              <h5 class="footer-head">Telepon</h5>
                              <p class="mt-4">+62 333 510733</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  
      <div class="footer-py-30 footer-bar">
          <div class="container text-center text-white">
              <div class="row align-items-center">
                  <div class="col-sm-6">
                      <div class="text-sm-start">
                          <p class="mb-0">© 2023 Pangkalan Utama TNI AL V - Pangkalan TNI AL Banyuwangi</p>
                      </div>
                  </div>
                  <!--end col-->
              </div>
              <!--end row-->
          </div>
          <!--end container-->
      </div>
  </footer>

    <!-- Optional JavaScript -->
    {{-- Icon --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>