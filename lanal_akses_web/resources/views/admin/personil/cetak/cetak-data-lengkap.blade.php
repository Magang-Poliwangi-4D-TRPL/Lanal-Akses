<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">

    <title>Cetak Riwayat Hidup</title>

    <style>
        .no-border>th,.no-border>td{
            border: 0 !important;
            border-top: 0 !important;
        }
        th,td{
            padding: 4px !important;
            border-left: solid 1px darkgray !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <h6 class="text-center text-danger"><u>RAHASIA</u></h6>

        <div class="container row">
            <div class="col-md-4">
                <h6 class="">MARKAS BESAR TNI ANGKATAN LAUT<br><u> DINAS ADMINISTRASI PERSONEL</u></h6>
            </div>
        </div>
        <h6 class="text-center mt-4"><b><u>DAFTAR RIWAYAT HIDUP</u></b></h6>
        <table class="container table no-border">
            <tr class="text-black no-border">
                <th>NAMA</th>
                <td>:</td>
                <th >{{ ucwords($personil->nama_lengkap) }}</th>
                <th rowspan="7">
                    @empty($personil->image_url)
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" width="150" height="auto" class="rounded image-profile">
                    
                    @else
                        <img src="{{ asset($personil->image_url) }}" alt="profile {{ $personil->nama_lengkap }}" border="0" width="150" height="auto" class="rounded image-profile">
                @endempty
                </th>
            </tr>
            <tr class="text-black no-border ">
                <th style="text-transform:uppercase;">pangkat/korps/nrp</th>
                <td>:</td>
                <th >{{ ucwords($personil->pangkat) . ' (' . ucwords($personil->korps). ') ' . ucwords($personil->nrp)}} </th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">pangkat terakhir</th>
                <td>:</td>
                <th >_</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">tmt. dinas</th>
                <td>:</td>
                <th>_</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">tmt. armada</th>
                <td>:</td>
                <th>_</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">nomor kta</th>
                <td>:</td>
                <th>{{ $personil->nomor_kta }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">nomor ktp</th>
                <td>:</td>
                <th>{{ $personil->nomor_ktp }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">nomor asbri</th>
                <td>:</td>
                <th colspan="4">{{ $personil->nomor_asbri }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">tempat tanggal lahir</th>
                <td>:</td>
                <th colspan="4">{{ $personil->tempat_lahir . ', ' . $personil->tanggal_lahir }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">agama/suku bangsa</th>
                <td>:</td>
                <th colspan="4">{{ $personil->agama .'/'. $personil->suku_bangsa }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">tinggi/berat badan</th>
                <td>:</td>
                <th colspan="4">{{ $personil->tinggi_badan .'cm/'. $personil->berat_badan .'kg' }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">gol. darah</th>
                <td>:</td>
                <th colspan="4">"{{ $personil->golongan_darah }}"</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">DIK SPESIALISASI</th>
                <td>:</td>
                <th colspan="4">{{ $personil->dikspesialisasi }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">nilai samapta/stakes</th>
                <td>:</td>
                <th colspan="4">{{ $personil->nilai_samata_stakes }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">brevet</th>
                <td>:</td>
                <th colspan="4">_</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">kecapakan bahasa</th>
                <td>:</td>
                <th colspan="4">{{ $personil->kecakapan_bahasa }}</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">alamat skearang/ no hp</th>
                <td>:</td>
                <th colspan="4" style="vertical-align: bottom">{{ $personil->alamat_sekarang }} <br>({{  $personil->nomor_hp   }})</th>
            </tr>
            <tr class="text-black no-border">
                <th style="text-transform:uppercase;">Status Rumah</th>
                <td>:</td>
                <th colspan="4" style="text-transform:uppercase;">
                    @php
                        $statusRumah = ['Sendiri', 'Kontrak', 'Numpang', 'Rumdis']    
                    @endphp
                    @foreach ($statusRumah as $item)
                        
                        @if ($item ===  $personil->status_rumah )
                            <del>{{ $item }}</del>
                        @else
                            {{ $item }}
                        @endif
                        @if ($loop->iteration != count($statusRumah))
                            /
                        @else
                            {{ '' }}
                        @endif
                            
                    @endforeach
                </th>
            </tr>
        </table>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>pendidikan/sus/dik Militer/tni al</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="30%">Nama SEKOLAH</th>
                    <th scope="col" width="25%">Lama dik</th>
                    <th scope="col" width="15%">tamat tahun</th>
                    <th scope="col" width="25%">Keterangan    </th>
                </tr>
                @if ($pendidikanMiliter->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($pendidikanMiliter as $data_pendidikan)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_pendidikan->nama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->lama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->tahun_lulus }}</td>
                            <td>{{ $data_pendidikan->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>pendidikan/sus/dik umum</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="30%">Nama SEKOLAH</th>
                    <th scope="col" width="25%">Lama dik</th>
                    <th scope="col" width="15%">tamat tahun</th>
                    <th scope="col" width="25%">Keterangan    </th>
                </tr>
                @if ($pendidikanFormal->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($pendidikanFormal as $data_pendidikan)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_pendidikan->nama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->lama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->tahun_lulus }}</td>
                            <td>{{ $data_pendidikan->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>tanggungan keluarga</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="30%">Nama lengkap</th>
                    <th scope="col" width="15%">tgl lahir</th>
                    <th scope="col" width="20%">lahir di</th>
                    <th scope="col" width="5%">LK/PR</th>
                    <th scope="col" width="25%">Keterangan</th>
                </tr>
                @if ($tanggunganKeluarga->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($tanggunganKeluarga as $data_tanggungan_keluarga)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_tanggungan_keluarga->nama_lengkap }}</td>
                            <td>{{ $data_tanggungan_keluarga->tanggal_lahir }}</td>
                            <td>{{ $data_tanggungan_keluarga->tempat_lahir }}</td>
                            <td>{{ $data_tanggungan_keluarga->jenis_kelamin }}</td>
                            <td>{{ $data_tanggungan_keluarga->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>perlengkapan</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="30%">Baju/Celana</th>
                    <th scope="col" width="20%">no sepatu</th>
                    <th scope="col" width="20%">no topi/mut</th>
                    <th scope="col" width="25%">Keterangan</th>
                </tr>
                @if ($perlengkapan->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($perlengkapan as $data_perlengkapan)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_perlengkapan->baju .'/'. $data_perlengkapan->celana }}</td>
                            <td>{{ $data_perlengkapan->no_sepatu }}</td>
                            <td>{{ $data_perlengkapan->no_topi.'/'. $data_perlengkapan->no_mut }}</td>
                            <td>{{ $data_perlengkapan->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>tanda jasa yang dimiliki/diperoleh</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="40%">nama tanda jasa/ nama satya lencana</th>
                    <th scope="col" width="30%">no skep</th>
                    <th scope="col" width="25%">Keterangan</th>
                </tr>
                @if ($tandaJasa->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($tandaJasa as $data_tandaJasa)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_tandaJasa->nama_tanda_jasa }}</td>
                            <td>{{ $data_tandaJasa->no_skep }}</td>
                            <td>{{ $data_tandaJasa->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>data Kepangkatan</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="20%">pangkat</th>
                    <th scope="col" width="50%">dasar nomor skep</th>
                    <th scope="col" width="25%">tmt pangkat</th>
                </tr>
                @if ($dataKepangkatan->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($dataKepangkatan as $item)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pangkat }}</td>
                            <td>{{ $item->no_skep }}</td>
                            <td>{{ $item->tempat_pangkat }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Riwayat penugasan / Penempatan</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="10%">tahun</th>
                    <th scope="col" width="40%">jabatan</th>
                    <th scope="col" width="25%">tmt pangkat</th>
                    <th scope="col" width="15%">keterangan</th>
                </tr>
                @if ($riwayatPenugasan->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($riwayatPenugasan as $item)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tahun }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->tempat }}</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Sanksi hukuman</b></h6>
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase;">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="50%">nama hukuman</th>
                    <th scope="col" width="20%">tahun</th>
                    <th scope="col" width="25%">keterangan</th>
                </tr>
                @if ($sanksiHukuman->count()<=0)
                    <tr style="text-transform:uppercase;">
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($sanksiHukuman as $item)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_hukuman }}</td>
                            <td>{{ $item->tahun_hukuman }}</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Data Pasangan</b></h6>
            @if($informasiPasangan->count()!=0)
            
                <table class="container table no-border" style="text-transform:uppercase;">
                    <tr class="text-black no-border">
                        <th>NAMA</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->nama_lengkap }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>tempat/tanggal lahir</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->tempat_lahir .','. $informasiPasangan[0]->tanggal_lahir }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>agama/suku bangsa</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->agama .'/'. $informasiPasangan[0]->suku_bangsa }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>tinggi/berat badan</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->tinggi_badan .'cm/ '. $informasiPasangan[0]->berat_badan .'kg' }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>golongan darah</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->golongan_darah }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>pekerjaan</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->pekerjaan }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>dik umum terakhir</th>
                        <td>:</td>
                        <td>_</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>alamat sekarang</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->alamat_sekarang}}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>nomor kpi</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->nomor_kpi }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>tempat Nikah</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->tempat_nikah}}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>nomor surat Nikah</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->nomor_surat_nikah }}</td>
                    </tr>
                    <tr class="text-black no-border">
                        <th>nomor kta JALASENASTRI</th>
                        <td>:</td>
                        <td>{{ $informasiPasangan[0]->nomor_kta_jalasenastri}}</td>
                    </tr>
                </table>
            @else
                <p class="text-medium">belum ada data pasangan</p>
            @endif
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Data Anak</b></h6>
            @if($informasiAnak->count()!=0)
                <table class="container table border" style="border-width: medium !important; border-color: #000;">
                    <tr style="text-transform:uppercase;">
                        <th scope="col" width="5%">NO</th>
                        <th scope="col" width="40%">nama lengkap</th>
                        <th scope="col" width="20%">tempat lahir</th>
                        <th scope="col" width="20%">tanggal lahir</th>
                        <th scope="col" width="15%">LK/PR</th>
                    </tr>
                    @if ($informasiAnak->count()<=0)
                        <tr style="text-transform:uppercase;">
                            <td colspan="5">Tidak ada data.</td>
                        </tr>
                    @else
                        @foreach ($informasiAnak as $item)
                            <tr style="text-transform:uppercase;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->tempat_lahir }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            @else
                <p class="text-medium">belum ada data pasangan</p>
            @endif
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Data OrangTua</b></h6>
            @if($informasiOrangTua->count()!=0)
                <table class="container table border" style="border-width: medium !important; border-color: #000;">
                    <tr style="text-transform:uppercase;">
                        <th scope="col" width="5%">NO</th>
                        <th scope="col" width="45%">nama lengkap</th>
                        <th scope="col" width="20%">agama</th>
                        <th scope="col" width="30%">status hubungan</th>
                    </tr>
                    @if ($informasiOrangTua->count()<=0)
                        <tr style="text-transform:uppercase;">
                            <td colspan="5">Tidak ada data.</td>
                        </tr>
                    @else
                        @foreach ($informasiOrangTua as $item)
                            <tr style="text-transform:uppercase;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->status_hubungan }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            @else
                <p class="text-medium">belum ada data pasangan</p>
            @endif
        </div>

        <div class="container align-item-right">
            <div class="col-md-4 text-right mt-4">
                <p>Banyuwangi, {{ date("d M Y") }}</p>
                <p class="mb-4">Yang Membuat</p>
                <br>
                <p class="mt-4">________________________</p>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>