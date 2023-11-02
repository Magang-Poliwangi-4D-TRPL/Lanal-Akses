@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Login')
  
@section('content')

<style>

    a:hover{
        text-decoration: none;
    }

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
        justify-content: center; /* Mengubah align-items menjadi center */
        align-items: center; /* Mengubah justify-content menjadi center */
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

    h2 {
        font-size: 32px;
        color: #0D21A1;
    }

    p {
        font-size: 14px;
        color: #555;
        margin: 10px0;
    }

    .kolom {
        display: flex;
        align-items: center;
        margin: 10px 0;
        border-radius: 4%;
    }

    .masuk-absen {
        width: 409px;
        height: 41px;
        display: flex;
        align-items: center;
        margin-right: 10px;
    }

    .masuk-absen .icon-col {
        width: 57px;
        height: 48px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-top-left-radius: 20%;
        border-bottom-left-radius: 20%;
    }

    .masuk-absen .icon-col i {
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
        margin: 30px 0;
    }

    .button-container .masuk-button {
        width: 245px;
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

    .button-container .absen-button {
        width: 154px;
        height: 41px;
        background-color: #FFFFFF; /* Warna latar belakang */
        color: 5786CA; /* Warna teks */
        border: 1px solid #5786CA;
        border-radius: 10px;
        margin-left: 20px;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 3px 3px 5px #888888; /* Efek drop shadow */
    }

    .button-container .admin-button {
            width: 410px;
            height: 41px;
            background-color: #0D21A1; /* Warna latar belakang */
            color: white; /* Warna teks */
            border: none;
            border-radius: 10px;
            margin: 15px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 3px 3px 5px #888888; /* Efek drop shadow */
        }

    .button-container .absen-button i {
        margin-right: 5px;
    }
</style>

<div class="container">
    <div class="left-section">
        <div class="overlay"></div>
        <div class="icon"></div>
        <div class="text">
            <h1>LANAL AKSES</h1>
            <p style="color: white; font-size: 16px;">Website Absensi dan Data Personil  Pangkalan TNI Angkatan Laut V - Pangkalan TNI AL Banyuwangi</p>
        </div>
    </div>
    <div class="right-section">
        <h2 class="align-self-start">Masuk ke Akun Anda</h1>
        <p class="align-self-start"> Registrasi akun anda</p>
        <div class="kolom">
            <div class="masuk-absen">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-user"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Masukkan NRP Anda">
                </div>
            </div>
        </div>
        <div class="kolom">
            <div class="masuk-absen">
                <div class="icon-col" style="background-color: #0D21A1;">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="isian-col">
                    <input type="text" placeholder="Masukkan Password Anda">
                </div>
            </div>
        </div>

        <div class="button-container">
            <div class="masuk-absen">
                <button type="submit" name="masuk" class="masuk-button">
                    <a class="text-decoration-none" href="{{ route('personil.dashboard') }}">
                        Masuk <i class="fas fa-check ml-2"></i>
                    </a>
                </button>
                <button type="submit" name="absen" class="absen-button">
                    <a href="{{ route('personil.absensi') }}">
                        Absen <i class="fas fa-clock ml-2"></i>
                    </a>
                </button>
            </div>
            <a href="{{ route('admin.login') }}">
                <button type="submit" name="masuk_sebagai_admin" class="admin-button" style="background-color: #5786CA;">
                    Masuk Sebagai Admin <i class="fas fa-lock ml-2"></i>
                </button>
            </a>
        </div>
    </div>
</div>
</div>
@endsection

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


