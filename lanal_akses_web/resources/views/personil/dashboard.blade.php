@extends('layout.personil.app')

@section('title-page', 'Personil | Dashboard')

@section('content')


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
        color: #fff; /* Mengatur warna teks menjadi putih */
    }

    .data-utama {
        color: #5786CA;
    }

    .border-all {
        border: 1px solid #5786CA;
    }

    .image-profile{
        width: 200px
    }

    #print-rh-button {
    position: fixed;
    bottom: 70px;
    right: 20px;
    z-index: 1; /* Digunakan untuk mengontrol tumpukan tombol di atas konten lainnya */
    }

    #print-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1; /* Digunakan untuk mengontrol tumpukan tombol di atas konten lainnya */
    }


    @media only screen and (max-width: 768px) {
    .image-profile{
        width: 100px
    }

    .jabatan {
        font-size: 1.5rem
    }

    .nama {
        font-size: 1rem
    }

    .informasi-title{
        font-size: 1.5rem
    }

    .judul-tabel {
        font-size: 1rem
    }
    
    table thead tr th{
        font-size: 6pt;
    }
}

    @media only screen and (max-width: 600px) {
    .image-profile{
        width: 150px
    }
    
    .jabatan {
        font-size: 2.5rem
    }

    .nama {
        font-size: 1.8rem
    }

    .informasi-title {
        font-size: 2.5rem
    }

    .judul-tabel {
        font-size: 1.5rem
    }

    table thead tr th{
        font-size: 8pt;
    }
  }

</style>
<a id="print-rh-button" class="text-decoration-none" href="#">
    <button class="btn btn-blue btn-md text-white bg-blueaccent">Cetak Riwayat Hidup<span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span></button>
</a>

<div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mt-4">
                <!-- Bagian Kiri -->
                <div class="bg-white p-4 text-center col-12 ">
                    <img src="images/admin/default-profile.jpg" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">
                    <h2 class="mt-3 bluedark text-left jabatan">Nama Jabatan</h2>
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="text-left nama">Nama Lengkap Personel</h4>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Edit Profil</a>
                    </div>
                    <p class="text-left" style="color: grey; border-bottom: 2px solid #0D21A1;">NRP Personel</p>
                </div>
                <div class="bg-white p-4">
                    <p class="data-utama mb-0">NIK</p>
                    <div class="container m-0 rounded border-all">
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">Tempat, Tanggal Lahir</p>
                    <div class="container m-0 rounded border-all">
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">Agama</p>
                    <div class="container m-0 rounded border-all">
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">Tinggi/Berat Badan</p>
                    <div class="container m-0 rounded border-all">
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">Alamat Sekarang</p>
                    <div class="container m-0 rounded border-all">
                        <p>_</p>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-4 bg-white">
                <!-- Bagian Kanan -->
                <div class=" p-4"  style="border-bottom: 2px solid #0D21A1;">
                    <div class="row d-flex justify-content-between align-items-center">
                        <h1 class="informasi-title bluedark pb-3 ">Informasi Pribadi</h1>
                    </div>
                </div>
                <div class=" p-4">
                    <div class="container">
                        <table class="table thead-light">
                            <thead>
                                <tr class="text-black">
                                  <th scope="col" width="45%">Nama Lengkap</th>
                                  <th scope="col" width="10%">:</th>
                                  <th scope="col" width="45%">Nama Lengkap Personel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="bluemain">Pangkat/KORPS/NRP</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Pangkat Terakhir</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">TMT. Dinas</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">TMT. Armada</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor KTA</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor KTP</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor ASBRI</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Tempat, Tanggal Lahir</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Agama/Suku Bangsa</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Tinggi/Berat Badan</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Jenis Kelamin</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Golongan Darah</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">DIKSPESIALISASI</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nilai SAMATA/STAKES</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Kecakapan Bahasa</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Alamat Sekarang/no. Hp</td>
                                    <td class="bluemain">:</td>
                                    <td>Tidak ada data</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-between align-items-center">
                            <h3 class="py-3 judul-tabel">Data Kepangkatan</h3>
                            <a href="#" class="btn btn-sm text-white btn-blue bg-bluedark">Kelola Kepangkatan</a>
                        </div>
                        <table class="table thead-light">
                            <thead>
                                <tr class="bg-blueaccent text-white text-bold">
                                    <th scope="col" width="10%">no</th>
                                    <th scope="col" width="15%">Pangkat</th>
                                    <th scope="col" width="10%">Dasar no. SKEP</th>
                                    <th scope="col" width="20%">Tmt. Pangkat</th>
                                    <th scope="col" width="15%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-light">
                                    <td colspan="5">Tidak ada data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="container">
                        <div class="row d-flex justify-content-between align-items-center">
                            <h3 class="py-3 judul-tabel">Riwayat Penugasan/Penempatan</h3>
                            <a href="#" class="btn btn-sm text-white btn-blue bg-bluedark">Kelola Riwayat Penugasan</a>
                        </div>
                        <table class="table thead-light">
                            <thead>
                                <tr class="bg-blueaccent text-white text-bold border">
                                    <th scope="col" width="10%">no</th>
                                    <th scope="col" width="15%">Tahun</th>
                                    <th scope="col" width="20%">Jabatan</th>
                                    <th scope="col" width="10%">Tempat</th>
                                    <th scope="col" width="15%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-light">
                                    <td colspan="5">Tidak ada data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="container">
                        <div class="row d-flex justify-content-between align-items-center">
                            <h3 class="py-3 judul-tabel">Sanksi Hukuman</h3>
                            <a href="#" class="btn btn-sm text-white btn-blue bg-bluedark">Kelola Sanksi Hukuman</a>
                        </div>
                        <table class="table thead-light">
                            <thead>
                                <tr class="bg-blueaccent text-white text-bold">
                                    <th scope="col" width="10%">No.</th>
                                    <th scope="col" width="15%">Nama Hukuman</th>
                                    <th scope="col" width="10%">Tahun</th>
                                    <th scope="col" width="15%">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border border-light">
                                    <td colspan="5">Tidak ada data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-4 mt-3" style="border-bottom: 2px solid #0D21A1; border-top: 2px solid #0D21A1;">
                        <div class="row">
                            <h1 class="informasi-title bluedark py-3">Informasi Keluarga</h1>
                        </div>
                    </div>

                    <div class="p-4">
                        <div class="container">
                            <div class="row d-flex justify-content-between align-items-center mb-4">
                                <p class="py-3">Informasi keluarga Personel meliputi: Istri/Suami, Anak, Ayah/Ibu, Ayah/Ibu Mertua</p>
                                <a href="#" class="btn btn-sm text-white btn-blue bg-bluedark">Kelola Informasi Keluarga</a>
                            </div>
                            <table class="table thead-light">
                                <thead>
                                    <tr class="text-black">
                                        <th scope="col" width="45%">Nama Lengkap</th>
                                        <th scope="col" width="10%">:</th>
                                        <th scope="col" width="45%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="bluemain">Tempat, Tanggal Lahir</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Agama/Suku Bangsa</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Tinggi/Berat Badan</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Golongan Darah</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Pekerjaan</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Alamat Sekarang</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Nomor KPI</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Tempat Nikah</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Nomor Surat Nikah</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Nomor KTA JALASENASTRI</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Nomor KTA JALASENASTRI</td>
                                        <td class="bluemain">:</td>
                                        <td>Tidak ada data.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

