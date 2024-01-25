<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Presensi Harian</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">
    <style>
        th,td{
                border: solid 1px darkgray !important;
            }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="container row">
            <div class="col-md-4">
                <h6 class="text-uppercase">MARKAS BESAR TNI ANGKATAN LAUT<br><u> DINAS ADMINISTRASI PERSONEL</u></h6>
            </div>
            <div class="col-md-8">
                <h6 class="text-center text-danger"><u>RAHASIA</u></h6>
            </div>
        </div>
        <div class="container col-md-6  mt-4">
            <table>
                <tr>
                    <th>Tanggal Presensi</th>
                    <th>:</th>
                    <td>{{ $date }}</td>
                </tr>
                <tr>
                    <th>Jenis Presensi</th>
                    <th>:</th>
                    <td>Presensi Harian</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="container-fluid mt-2">
        <h6 class="text-left my-4" style="text-transform:uppercase;"><b>Data Presensi personel </b></h6>
        @if($absensiPersonil->count()!=0)
            <table class="container table border" style="border-width: medium !important; border-color: #000;">
                <tr style="text-transform:uppercase; background-color:aliceblue">
                    <th scope="col" width="5%">NO</th>
                    <th scope="col" width="10%">Nama Lengkap</th>
                    <th scope="col" width="5%">NRP</th>
                    <th scope="col" width="10%">Tanggal Absensi</th>
                    <th scope="col" width="10%">Status Kehadiran</th>
                    <th scope="col" width="10%">Jam Masuk - Jam Pulang</th>
                    <th scope="col" width="10%">Keterangan</th>
                </tr>
                    @foreach ($absensiPersonil as $item)
                        <tr style="text-transform:uppercase;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->personil->nama_lengkap }}</td>
                            <td>{{ $item->personil->nrp }}</td>
                            <td>{{ $item->tanggal_kehadiran }}</td>
                            <td>{{ $item->status_kehadiran }}</td>
                            <td>{{ $item->jam_masuk == null? '-' : $item->jam_masuk }}{{ $item->jam_pulang == null? '' : '-'.$item->jam_pulang  }}</td>
                            <td>{{ $item->keterangan == null? '-' : $item->keterangan }}</td>
                        </tr>
                    @endforeach
            </table>
        @else
            <p class="text-medium">belum ada data personel</p>
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
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</body>
</html>