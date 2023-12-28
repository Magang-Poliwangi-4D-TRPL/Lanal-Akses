@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
    <style>
        .container {
            width: 966px;
            height: 556px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
        }

        .left-section {
            width: 433px;
            height: 556px;
            background: url('https://i.ibb.co/G9CdjRw/bglanal.jpg') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-top-left-radius: 4%;
            border-bottom-left-radius: 4%;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(13, 33, 161, 0.8); /* Warna biru tua dengan opacity 0.8 */
            border-top-left-radius: 4%;
            border-bottom-left-radius: 4%;
        }

        .icon {
            width: 137px;
            height: 137px;
            background: url('https://i.ibb.co/MR438ww/logo-no-bg.png') no-repeat center center;
            position: relative;
            margin: 20px 0; /* Menambahkan margin 20px atas dan bawah pada ikon */
        }

        .text {
            text-align: center;
            color: white; /* Warna teks Anda */
            position: relative;
            z-index: 1;
            margin: 10px 0; /* Menambahkan margin 10px atas dan bawah */
        }

        .right-section {
            width: 533px;
            height: 556px;
            background-color: #E5FFFF; /* Warna latar belakang pada right-section */
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Mengubah align-items menjadi flex-start */
            align-items: flex-start; /* Mengubah justify-content menjadi flex-start */
            border-top-right-radius: 4%;
            border-bottom-right-radius: 4%;
            padding: 20px 40px 20px 0; /* Padding bawah 20px dan padding kanan 40px */
            padding-left: 40px; /* Padding kiri 40px */
        }

        .header {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 10px;
        }

        .left-header {
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        .right-header {
            font-size: 14px;
            color: #555;
        }

        h1 {
            font-size: 24px;
            margin: 10px 0;
        }

        p {
            font-size: 14px;
            color: #555;
            margin: 0;
        }

        .kolom {
            display: flex;
            align-items: center;
            margin: 10px 0;
            border-radius: 4%;
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

        .button-container button {
            width: 409px;
            height: 41px;
            background-color: #0D21A1; /* Warna latar belakang */
            color: white; /* Warna teks */
            border: none;
            border-radius: 10px;
            margin: 6px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 3px 3px 5px #888888; /* Efek drop shadow */
        }

        .button-container button i {
            margin-right: 5px;
        }
    </style>

    <div class="container">
        <div class="left-section">
            <div class="overlay"></div>
            <div class="icon"></div>
            <div class="text">
                <h1>LANAL AKSES</h1>
                <p style="color: white; font-size: 16px;">Website Absensi dan Data Personel  Pangkalan TNI Angkatan Laut V - Pangkalan TNI AL Banyuwangi</p>
            </div>
        </div>
        <div class="right-section">
            <div class="header">
                <div class="left-header">
                    <a href="{{ route('personil.login') }}">
                        <i class="fas fa-angle-left"></i> Kembali
                    </a>
                </div>
                <div class="right-header" id="current-time"></div>
            </div>
            <h1>Absensi Personel</h1>
            <p>Lakukan absensi dengan nama dan NRP</p>
            <div class="kolom">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Nama">
                </div>
            </div>
            <div class="kolom">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="NRP">
                </div>
            </div>
            <p>tidak wajib diisi (jika personel tidak berada di pangkalan)</p>
            <div class="kolom">
                <div class="icon-col" style="background-color: #0D21A1;">
                <i class="fas fa-file" style="color: white;"></i> 
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Keterangan Jaga"> 
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="hadir">
                     Hadir  <i class="fas fa-check ml-2"></i>
                </button>
                <button type="submit" name="ajukan_perizinan" class="ajukan-button" style="background-color:#5786CA ;" >
                    <a href="{{ route('personil.perizinan') }}">
                        Ajukan Perizinan  <i class="far fa-file ml-2"></i>
                    </a>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    const updateTime = () => {
        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const day = days[now.getDay()];
        const date = now.getDate();
        const month = now.getMonth() + 1;
        const year = now.getFullYear();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        document.getElementById('current-time').innerText = `${day}, ${date < 10 ? '0' + date : date}/${month < 10 ? '0' + month : month}/${year} ${hours < 10 ? '0' + hours : hours}:${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    }

    updateTime();
    setInterval(updateTime, 1000);
</script>
@endsection
