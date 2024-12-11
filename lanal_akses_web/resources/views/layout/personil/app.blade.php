<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/admin/admin.style.css') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="{{ URL::asset('images/admin/logo-no-bg.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title-page')</title>
  </head>
  <style>
    .navbar-nav {
        display: flex;
        align-items: center;
    }
    .navbar-nav .nav-item {
        margin-right: 15px; /* Menambahkan jarak antara item navbar */
    }
    .navbar-nav .nav-item:last-child {
        margin-right: 0; /* Menghapus jarak pada item terakhir */
    }
    .navbar-nav .nav-link {
        color: #1abc9c;
    }
    
    /* Tambahan untuk active item */
    .active-navbar-item {
        color: #fff;
        background-color: #1abc9c;
    }
  </style>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #4E6766">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ URL::asset('images/admin/logo-no-bg.png') }}" alt="logo-no-bg" width="50" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div >
                <ul class="navbar-nav ml-auto"> 
                    <li class="nav-item">
                        <a class="nav-link text-uppercase rounded {{ (request()->is('personel')) ? 'active-navbar-item text-light bg-greendark' : '' }}" href="{{ route('personil.dashboard') }}">
                            Home 
                            <iconify-icon class="ml-3" icon="ic:{{ (request()->is('personel')) ? 'home' : 'outline-home' }}" href="{{  url('#') }}" width="20"></iconify-icon>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase rounded {{ (request()->is('personel/presensi/*')) ? 'active-navbar-item text-light bg-greendark' : '' }}" href="{{ route('personil.riwayat-presensi') }}">
                            Presensi
                            <iconify-icon class="ml-3" icon="mdi:{{ (request()->is('personel/presensi/*')) ? 'clock' : 'clock-outline' }}" width="20"></iconify-icon>
                        
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase rounded {{ (request()->is('personel/pengajuan-cuti/*')) ? 'active-navbar-item text-light bg-greendark' : '' }}" href="{{ route('personil.pengajuan-cuti.index') }}">
                            Pengajuan Cuti
                            <iconify-icon class="mr-3" icon="mdi:{{ (request()->is('personel/pengajuan-cuti/*')) ? 'file-document' : 'file-document-outline' }}" width="20"></iconify-icon>
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button id="logout-button" class="btn btn-sm btn-outline-light ml-2 p-2 rounded-lg">Logout <iconify-icon class="align-middle" icon="ion:exit-outline" width="18"></iconify-icon></button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    
    @yield('content')

    @extends('layout.public.footer')
    <!-- Optional JavaScript -->
    {{-- Icon --}}
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://kit.fontawesome.com/7a57481531.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
            $(document).ready(function() {
                $('.select2').select2();
            });
    </script>
    <script src="{{ URL::asset('asset/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
      $(document).ready(function () {
        $('#datepicker').datepicker({
          format: 'dd-mm-yyyy', // Sesuaikan format tanggal dengan kebutuhan Anda
          autoclose: true
        });
      });
    </script>

</body>
</html>