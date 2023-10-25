@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
    <style>
        .container {
            display: flex;
            justify-content: center; /* Memusatkan secara horizontal */
            align-items: center; /* Memusatkan secara vertikal */
            height: 100vh; /* Mengisi tinggi seluruh halaman */
        }


        .right-section {
            width: 533px;
            height: 556px;
            background-color: #E5FFFF; /* Warna latar belakang pada right-section */
            display: center;
            flex-direction: column;
            justify-content: center; /* Mengubah align-items menjadi flex-start */
            align-items: center; /* Mengubah justify-content menjadi flex-start */
            border-radius: 4%;
            padding: 20px 40px 20px 0; /* Padding bawah 20px dan padding kanan 40px */
            padding-left: 40px; /* Padding kiri 40px */
        }

        .header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 10px;
        }

        .right-header {
            font-size: 14px;
            color: #555;
        }

        h1 {
            font-size: 26px;
            margin: 20px 0;
            color: #0D21A1;
        }

        p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px; /* Menambahkan margin ke bawah sekitar 20px */
        }

        .kolom {
            display: flex;
            align-items: center;
            margin: 15px 0;
            border-radius: 4%;
            width: 100%; /* Menjadikan kolom lebar 100% dari right-section */
        }

        .button-container button {
            width: 100%; /* Menjadikan tombol lebar 100% dari right-section */
            height: 41px;
            background-color: #0D21A1;
            color: white;
            border: none;
            border-radius: 10px;
            margin: 10px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 3px 3px 5px #888888;
        }

        .icon-col {
            width: 57px;
            height: 48px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-left-radius: 20%;
            border-bottom-left-radius: 20%;
        }

        .icon-col i {
            font-size: 16px;
            color: #FFFFFF;
        }

        .isian-col {
            width: 352px;
            height: 48px;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        input {
            width: 100%;
            height: 100%;
            padding: 10px;
            border: none;
            outline: none;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px 0;
        }

        .button-container button i {
            margin-right: 5px;
        }
    </style>

    <div class="container">
        <div class="right-section">
            <div class="header">
                <div class="left-header">
                    <i class="fas fa-angle-left"></i> Kembali
                </div>
            </div>
            <h1>Masuk ke Akun Admin</h1>
            <p>Masukkan Nama Pengguna dan Kata Sandi Admin</p>
            <div class="kolom">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Masukkan nama pengguna admin">
                </div>
            </div>
            <div class="kolom">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Masukkan password admin">
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="masuk">
                     Masuk  <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
