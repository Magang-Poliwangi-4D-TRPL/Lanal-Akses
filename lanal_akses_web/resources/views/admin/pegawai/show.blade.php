@extends('layout.admin.app')

@section('title-page', 'Admin | Data PNS')

@section('content')
<style>
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
<div class="container-fluid">
        <div class="row">
                <div class="col-md-5 mt-4">
                    <div class="bg-white p-4 text-center col-12 ">
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">
    
                        <h2 class="mt-3 bluedark text-left jabatan">{{ $pegawai->jabatan}}</h2>
                        <h4 class="text-left nama">{{ $pegawai->nama_pegawai }}</h4>
                        <p class="text-left" style="color: grey; border-bottom: 2px solid #0D21A1;">{{ $pegawai->nip }}</p>
                    </div>
                    <div class="bg-white px-4 pb-4">
                        <p class="data-utama mb-0">Username</p>
                        <div class="container m-0 rounded border-all">
                            {{-- @empty($pegawai->nik)
                                <p>_</p>
                            @else
                                <p>{{ $pegawai->nik }}</p>
                            @endempty --}}
                            <p>_</p>
                        </div>
                        <p class="data-utama mb-0">password</p>
                        <div class="container m-0 rounded border-all">
                            {{-- @empty($pegawai->tempat_tanggallahir)
                                <p>_</p>
                            @else
                                <p>{{ $pegawai->tempat_tanggallahir }}</p>
                            @endempty --}}
                            <p>_</p>
                        </div>
                        
                        <a href="{{ route('admin.pegawai.index', ['page' => 1]) }}" class="btn btn-primary-1 mt-3">Kembali</a>
                    </div>
                </div>
                <div class="col-md-7 mt-4 bg-white">
                    <!-- Bagian Kanan -->
                    <div class=" p-4">
                        <div class="row d-flex justify-content-between align-items-center" style="border-bottom: 2px solid #0D21A1;">
                            <h1 class="informasi-title bluedark pb-3 ">Informasi Pribadi</h1>
                            @php
                                $nip = $pegawai->nip;
                                $nipGanti = str_replace(' ', '-', $nip);
                            @endphp
                            <a href="{{ route('admin.pegawai.edit', $nipGanti) }}" class="btn btn-sm btn-outline-secondary">Edit Profil</a>
                        </div>
                        <div class="container">
                            <table class="table thead-light">
                                <thead>
                                    <tr class="text-black   ">
                                    <th scope="col" width="45%">Nama Lengkap</th>
                                    <th scope="col" width="10%">:</th>
                                    <th scope="col" width="45%">{{ $pegawai->nama_pegawai }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="bluemain">NIP</td>
                                        <td class="bluemain">:</td>
                                        <td>{{ $pegawai->nip }}</td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Jabatan</td>
                                        <td class="bluemain">:</td>
                                        <td>
                                            @empty($pegawai->jabatan)
                                                Tidak ada data
                                            @else
                                                <p>{{ $pegawai->jabatan }}</p>
                                            @endempty
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Golongan</td>
                                        <td class="bluemain">:</td>
                                        <td>
                                            @empty($pegawai->golongan)
                                                Tidak ada data
                                            @else
                                                <p>{{ $pegawai->golongan }}</p>
                                            @endempty
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Email</td>
                                        <td class="bluemain">:</td>
                                        <td>
                                            @empty($pegawai->email)
                                                Tidak ada data
                                            @else
                                                <p>{{ $pegawai->email }}</p>
                                            @endempty
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Nomor Telepon</td>
                                        <td class="bluemain">:</td>
                                        <td>
                                            @empty($pegawai->no_telepon)
                                                Tidak ada data
                                            @else
                                                <p>{{ $pegawai->no_telepon }}</p>
                                            @endempty
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bluemain">Alamat</td>
                                        <td class="bluemain">:</td>
                                        <td>
                                            @empty($pegawai->alamat)
                                                Tidak ada data
                                            @else
                                                <p>{{ $pegawai->alamat }}</p>
                                            @endempty
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
</div>
@endsection
