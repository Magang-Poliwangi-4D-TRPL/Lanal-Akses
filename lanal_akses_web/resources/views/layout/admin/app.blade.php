<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- file CSS lainnya --}}
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/admin/admin.style.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/admin/admin.sidebar.css') }} ">
    <link rel="stylesheet" href="{{ URL::asset('asset/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css') }}">
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">

    <title> @yield('title-page') </title>
  </head>
  <body>

    <!-- Notifikasi Popup -->
    <!-- Di dalam elemen notifikasi -->
    <div id="notification-popup">
      <span id="notification-message"></span>
    </div>
    
    @extends('layout.admin.sidebar')
    
    <main class="content-margin content-wrap">
      
        @extends('layout.admin.navbar')
        
        @yield('content')
    
    </main>
    @extends('layout.admin.footer')


    <!-- Icon -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="https://kit.fontawesome.com/7a57481531.js" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Optional JavaScript -->
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