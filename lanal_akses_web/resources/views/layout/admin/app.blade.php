<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- file CSS lainnya --}}
    <link rel="stylesheet" href="{{ URL::asset('css/app.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/admin/admin.style.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/admin/admin.sidebar.css'); }} ">
    
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">

    <title> @yield('title-page') </title>
  </head>
  <body>

    <!-- Notifikasi Popup -->
    <!-- Di dalam elemen notifikasi -->
    <div id="notification-popup" class="notification-popup">
      <span id="notification-message"></span>
    </div>
    
    @extends('layout.admin.sidebar')
    
    <main class="content-margin content-wrap">
      
      @if (request()->is('/admin'))
        @extends('layout.admin.navbar')
        @yield('content')
      @else
        @yield('content')

      @endif
    </main>
    @extends('layout.admin.footer')


    <!-- Optional JavaScript -->
    <!-- Membuat tampilan notif pop up JavaScript -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          var notificationPopup = document.getElementById('notification-popup');
          var notificationMessage = document.getElementById('notification-message');
          var notificationIcon = document.getElementById('notification-icon');
          // Cek apakah ada pesan notifikasi dalam session
          var successMessage = "{{ session('success') }}";
          var errorMessage = "{{ session('error') }}"; // Tambahkan variabel errorMessage
          if (successMessage) {
              // Tampilkan notifikasi dengan latar belakang warna hijau
              notificationMessage.innerHTML = successMessage;
              notificationPopup.style.backgroundColor = '#4CAF50'; // Warna hijau
          } else if (errorMessage) {
              // Tampilkan notifikasi dengan latar belakang warna merah
              notificationMessage.innerHTML = errorMessage;
              notificationPopup.style.backgroundColor = '#FF5733'; // Warna merah
          }
          notificationPopup.style.color = '#fff'; // Tambahkan warna teks putih
          notificationPopup.style.display = 'block';
          setTimeout(function() {
              notificationPopup.style.display = 'none';
          }, 5000); // Notifikasi akan hilang setelah 5 detik
        });
    </script>

    <!-- Icon -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>