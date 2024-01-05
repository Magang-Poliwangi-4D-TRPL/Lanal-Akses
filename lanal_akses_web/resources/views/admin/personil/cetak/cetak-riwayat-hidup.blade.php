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
</head>
<body>
    <div class="container-fluid py-4">
        <div class="container row">
            <div class="col-md-4">
                <h6 class="">MARKAS BESAR TNI ANGKATAN LAUT<br><u> DINAS ADMINISTRASI PERSONEL</u></h6>
            </div>
        </div>
        <h4 class="text-center mt-4"><b><u>KUTIPAN RIWAYAT HIDUP</u></b></h4>
        <table class="container">
            <tr class="text-black">
                <th>NRP</th>
                <td>:</td>
                <th colspan="4">{{ $personil->nrp }}</th>
                <th rowspan="7">
                    @empty($personil->image)
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" width="200" height="auto" class="rounded image-profile">
                    
                    @else
                        <img src="{{ asset($personil->image_url) }}" alt="profile {{ $personil->nama_lengkap }}" border="0" width="200" height="auto" class="rounded image-profile">
                @endempty
                </th>
            </tr>
            <tr>
                <th>NAMA LENGKAP</th>
                <td>:</td>
                <th colspan="4">{{ strtoupper($personil->nama_lengkap) }}</th>
            </tr>
            <tr>
                <th>PANGKAT</th>
                <td>:</td>
                <td>{{ strtoupper($personil->pangkat) }}</td>
                <th>KORPS</th>
                <td>:</td>
                <td>{{ strtoupper($personil->korps) }}</td>
            </tr>
            <tr>
                <th>MASA DINAS DLM PANGKAT</th>
                <td>:</td>
                <td colspan="4">_</td>
            </tr>
            <tr>
                <th>TMT TNI</th>
                <td>:</td>
                <td>_</td>
                <th>TMT FIKTIF</th>
                <td>:</td>
                <td>_</td>
            </tr>
            <tr>
                <th>TEMPAT/TANGGAL LAHIR</th>
                <td>:</td>
                <td>{{ strtoupper($personil->tempat_lahir . $personil->tanggal_lahir) }}</td>
                <th>JENIS KELAMIN</th>
                <td>:</td>
                <td>{{ strtoupper($personil->jenis_kelamin) }}</td>
            </tr>
            <tr>
                <th>USIA</th>
                <td>:</td>
                <td colspan="4">_</td>
            </tr>
            <tr>
                <th>SUKU</th>
                <td>:</td>
                <td>{{ strtoupper($personil->suku_bangsa) }}</td>
                <th>AGAMA</th>
                <td>:</td>
                <td>{{ strtoupper($personil->agama) }}</td>
            </tr>
            <tr>
                <th>JABATAN</th>
                <td>:</td>
                <td colspan="4">KOARMADA II/LANTAMAL V SBY/LANAL BANYUWANGI/{{ strtoupper($personil->jabatan) }}</td>
            </tr>
            <tr>
                <th>LAMA JABATAN</th>
                <td>:</td>
                <td colspan="4">_</td>
            </tr>
            <tr>
                <th>ALAMAT</th>
                <td>:</td>
                <td colspan="4">{{ strtoupper($personil->alamat_sekarang) }}</td>
            </tr>
        </table>
        <div class="container-fluid mt-2">
            <h6><b>I PENDIDIKAN UMUM</b></h6>
            <table class="container">
                @if($pendidikanFormal->count()<=0)
                <tr>
                    <th>_</th>
                </tr>
                @else
                <tr>
                    @foreach ($pendidikanFormal as $item)
                    @if ($loop->iteration%3==0)
                    </tr>
                        <td>{{ strtoupper($item->nama_pendidikan) }} TAMAT TH. {{ $item->tahun_lulus }}</td>
                    <tr>
                    @else
                        <td>{{ strtoupper($item->nama_pendidikan) }} TAMAT TH. {{ $item->tahun_lulus }}</td>
                    @endif
                    @endforeach
                </tr>
                @endif
            </table>
        </div>
        
        <div class="container-fluid mt-2">
            <h6><b>II PENDIDIKAN MILITER</b></h6>
            <table class="container">
                @if($pendidikanMiliter->count()<=0)
                <tr>
                    <th>_</th>
                </tr>
                @else
                <tr>
                    @foreach ($pendidikanMiliter as $item)
                    @if ($loop->iteration%3==0)
                    </tr>
                        <td>{{ $item->tahun_lulus }} {{ strtoupper($item->nama_pendidikan) }}</td>
                    <tr>
                    @else
                        <td>{{ $item->tahun_lulus }} {{ strtoupper($item->nama_pendidikan) }}</td>
                    @endif
                    @endforeach
                </tr>
                @endif
            </table>
        </div>

        <div class="container-fluid mt-2">
            <h6><b>III BAHASA ASING</b></h6>
        </div>

        <div class="container-fluid mt-2">
            <h6><b>IV BAHASA DAERAH</b></h6>
        </div>

        <div class="container-fluid mt-2">
            <h6><b>V PROVESI</b></h6>
        </div>

        <div class="container-fluid mt-2">
            <h6><b>V RIWAYAT PANGKAT</b></h6>
            <table class="container">
                @if($dataKepangkatan->count()<=0)
                <tr>
                    <th>_</th>
                </tr>
                @else
                <tr>
                    @foreach ($dataKepangkatan as $item)
                    @if ($loop->iteration%3==0)
                    </tr>
                        <td>{{ $item->pangkat }}</td>
                    <tr>
                    @else
                        <td>{{ $item->pangkat }}</td>
                    @endif
                    @endforeach
                </tr>
                @endif
            </table>
        </div>
        
        <div class="container-fluid mt-2">
            <h6><b>VI RIWAYAT JABATAN</b></h6>
            <table class="container">
                @if($riwayatPenugasan->count()<=0)
                <tr>
                    <th>_</th>
                </tr>
                @else
                <tr>
                    @foreach ($riwayatPenugasan as $item)
                    @if ($loop->iteration%3==0)
                    </tr>
                        <td>{{ $item->tahun }} {{ $item->jabatan }}</td>
                    <tr>
                    @else
                        <td>{{ $item->tahun }} {{ $item->jabatan }}</td>
                    @endif
                    @endforeach
                </tr>
                @endif
            </table>
        </div>
        
        <div class="container-fluid mt-2">
            <h6><b>VII TANDA JASA</b></h6>
            <table class="container">
                @if($tandaJasa->count()<=0)
                <tr>
                    <th>_</th>
                </tr>
                @else
                <tr>
                    @foreach ($tandaJasa as $item)
                    @if ($loop->iteration%3==0)
                    </tr>
                        <td>{{ $item->nama_tanda_jasa }}</td>
                    <tr>
                    @else
                        <td>{{ $item->nama_tanda_jasa }}</td>
                    @endif
                    @endforeach
                </tr>
                @endif
            </table>
        </div>

        <h5 class="text-right">{{ date("d M Y") }}</h5>
    </div>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>