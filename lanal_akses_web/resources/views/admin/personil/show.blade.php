@extends('layout.admin.app')

@section('title-page', 'Admin | '. $personil->nama_lengkap)

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
<a id="print-rh-button" class="text-decoration-none" href="#">
    <button class="btn btn-blue btn-md text-white bg-blueaccent">Cetak Riwayat Hidup<span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span></button>
</a>
<a id="print-button" class="text-decoration-none" href="#">
    <button class="btn btn-blue btn-md text-white bg-bluedark">Cetak Data Lengkap<span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span></button>
</a>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mt-4">
                <!-- Bagian Kiri -->
                <div class="bg-white p-4 text-center col-12 ">
                    <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">

                    <h2 class="mt-3 bluedark text-left jabatan">{{ $personil->jabatan}}</h2>
                    <h4 class="text-left nama">{{ $personil->nama_lengkap }}</h4>
                    <p class="text-left" style="color: grey; border-bottom: 2px solid #0D21A1;">{{ $personil->nrp }}</p>
                </div>
                <div class="bg-white p-4">
                    <p class="data-utama mb-0">Username</p>
                    <div class="container m-0 rounded border-all">
                        {{-- @empty($personil->nik)
                            <p>_</p>
                        @else
                            <p>{{ $personil->nik }}</p>
                        @endempty --}}
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">password</p>
                    <div class="container m-0 rounded border-all">
                        {{-- @empty($personil->tempat_tanggallahir)
                            <p>_</p>
                        @else
                            <p>{{ $personil->tempat_tanggallahir }}</p>
                        @endempty --}}
                        <p>_</p>
                    </div>
                    <p class="data-utama mb-0">NIK</p>
                    <div class="container m-0 rounded border-all">
                        @empty($personil->nik)
                            <p>_</p>
                        @else
                            <p>{{ $personil->nik }}</p>
                        @endempty
                    </div>
                    
                </div>
            </div>
            <div class="col-md-7 mt-4 bg-white">
                <!-- Bagian Kanan -->
                <div class=" p-4"  style="border-bottom: 2px solid #0D21A1;">
                    <div class="row d-flex justify-content-between align-items-center">
                        <h1 class="informasi-title bluedark pb-3 ">Informasi Pribadi</h1>
                        <a href="#" class="btn btn-sm btn-outline-secondary">Edit Profil</a>
                        
                    </div>
                </div>
                <div class=" p-4">
                    <div class="container">
                        <table class="table thead-light">
                            <thead>
                                <tr class="text-black   ">
                                  <th scope="col" width="45%">Nama Lengkap</th>
                                  <th scope="col" width="10%">:</th>
                                  <th scope="col" width="45%">{{ $personil->nama_lengkap }}</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <td class="bluemain">Pangkat/KORPS/NRP</td>
                                    <td class="bluemain">:</td>
                                    <td>{{ $personil->pangkat }} {{ $personil->korps }} / {{ $personil->nrp }}</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Pangkat Terakhir</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->pangkat_terakhir)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->pangkat_terakhir }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">TMT. Dinas</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->tempat_dinas)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->tempat_dinas }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">TMT. Armada</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->tempat_armada)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->tempat_armada }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor KTA</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->nomor_kta)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->nomor_kta }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor KTP</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->nomor_ktp)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->nomor_ktp }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nomor ASBRI</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->nomor_asbri)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->nomor_asbri }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Tempat, Tanggal Lahir</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->tempat_tanggallahir)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->tempat_tanggallahir }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Agama/Suku Bangsa</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->agama_sukubangsa)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->agama_sukubangsa }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Tinggi/Berat Badan</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->tinggi_beratbadan)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->tinggi_beratbadan }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Jenis Kelamin</td>
                                    <td class="bluemain">:</td>
                                    <td>{{ $personil->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Golongan Darah</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->golongan_darah)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->golongan_darah }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">DIKSPESIALISASI</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->dikspesialisasi)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->dikspesialisasi }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Nilai SAMATA/STAKES</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->nilai_samata_stakes)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->nilai_samata_stakes }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Kecakapan Bahasa</td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->kecakapan_bahasa)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->kecakapan_bahasa }}</p>
                                        @endempty
                                    </td>
                                </tr>
                                <tr>
                                    <td class="bluemain">Alamat Sekarang/no. Hp </td>
                                    <td class="bluemain">:</td>
                                    <td>
                                        @empty($personil->alamat_sekarang)
                                            Tidak ada data
                                        @else
                                            <p>{{ $personil->alamat_sekarang }}/{{ $personil->nomor_hp }}</p>
                                        @endempty
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="px-4 mb-4 mt-3"  style="border-bottom: 2px solid #0D21A1;border-top: 2px solid #0D21A1;">
                    <div class="row">
                        <h1 class="informasi-title bluedark py-3">Informasi Akademik</h1>
                        
                    </div>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Pendidikan Militer</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Nama Pendidikan</th>
                              <th scope="col" width="10%">Lama Pendidikan</th>
                              <th scope="col" width="20%">Tahun Lulus</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <div class="row d-flex justify-content-between align-items-center">
                        <h3 class="py-3 judul-tabel">Pendidikan Formal</h3>
                        @php
                            $nrp = $personil->nrp;
                            $nrpGanti = str_replace('/', '-', $nrp);
                        @endphp
                        <a href="{{ route('admin.personil.pendidikanformal.index', ['nrp' => $nrpGanti]) }}" class="btn btn-sm text-white btn-blue bg-bluedark">Kelola Pendidikan Formal</a>
                        
                    </div>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Nama Pendidikan</th>
                              <th scope="col" width="10%">Lama Pendidikan</th>
                              <th scope="col" width="20%">Tahun Lulus</th>
                              <th scope="col" width="15%">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            @empty($pendidikanFormal)
                                <tr>
                                    <td colspan="5">Tidak ada data.</td>
                                </tr>
                            @else
                                @foreach ($pendidikanFormal as $data_pendidikan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data_pendidikan->nama_pendidikan }}</td>
                                        <td>{{ $data_pendidikan->lama_pendidikan }}</td>
                                        <td>{{ $data_pendidikan->tahun_lulus }}</td>
                                        <td>{{ $data_pendidikan->keterangan }}</td>
                                    </tr>
                                @endforeach
                            @endempty
                        </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Kursus</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Nama Kursus</th>
                              <th scope="col" width="10%">Lama Kursus</th>
                              <th scope="col" width="20%">Tmt. Kursus</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="px-4 mb-4 mt-3"  style="border-bottom: 2px solid #0D21A1;border-top: 2px solid #0D21A1;">
                    <div class="row">
                        <h1 class="informasi-title bluedark py-3">Informasi Lainnya</h1>
                    </div>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Tanggungan Keluarga</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Nama Lengkap</th>
                              <th scope="col" width="10%">Tempat, TL</th>
                              <th scope="col" width="20%">Status Hub.</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Perlengkapan</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">Baju/Celana</th>
                              <th scope="col" width="15%">No. Sepatu</th>
                              <th scope="col" width="10%">No. Topi/MUT</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Tanda jasa yang dimiliki/diperoleh</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">No.</th>
                              <th scope="col" width="15%">Nama Tanda Jasa/ Nama Satya Lencana</th>
                              <th scope="col" width="10%">No. SKEP</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Data Kepangkatan</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Pangkat</th>
                              <th scope="col" width="10%">Dasar no. SKEP</th>
                              <th scope="col" width="20%">Tmt. Pangkat</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Riwayat Penugasan/Penempatan</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold border">
                              <th scope="col" width="10%">no</th>
                              <th scope="col" width="15%">Tahun</th>
                              <th scope="col" width="20%">Jabatan</th>
                              <th scope="col" width="10%">Tempat</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="container ">
                    <h3 class="py-3 judul-tabel">Sanksi Hukuman</h3>
                    <table class="table thead-light">
                        <thead>
                            <tr class="bg-blueaccent text-white text-bold">
                              <th scope="col" width="10%">No.</th>
                              <th scope="col" width="15%">Nama Hukuman</th>
                              <th scope="col" width="10%">Tahun</th>
                              <th scope="col" width="15%">Keterangan    </th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="border border-light">
                                <td colspan="5">Tidak ada data.</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <div class="px-4 mb-4 mt-3"  style="border-bottom: 2px solid #0D21A1;border-top: 2px solid #0D21A1;">
                    <div class="row">
                        <h1 class="informasi-title bluedark py-3">Informasi Keluarga</h1>
                    </div>
                </div>
                <div class=" p-4">
                    <div class="container">
                        <table class="table thead-light">
                            <thead>
                                <tr class="text-black   ">
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

@endsection