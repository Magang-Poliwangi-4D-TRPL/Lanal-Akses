<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pegawai</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="https://i.ibb.co/MR438ww/logo-no-bg.png" type="image/x-icon">
</head>
<style>
    th,td{
            border: solid 1px darkgray !important;
        }
</style>
<body>
    <div class="container-fluid py-4">
        <h6 class="text-center text-danger"><u>RAHASIA</u></h6>

        <div class="container row">
            <div class="col-md-4">
                <h6 class="">MARKAS BESAR TNI ANGKATAN LAUT<br><u> DINAS ADMINISTRASI PERSONEL</u></h6>
            </div>
        </div>

        <div class="container-fluid mt-2">
            <h6 class="text-center my-4" style="text-transform:uppercase;"><b>Data Pegawai</b></h6>
            @if($pegawai->count()!=0)
                <table class="container table border" style="border-width: medium !important; border-color: #000;">
                    <tr style="text-transform:uppercase; background-color:aliceblue">
                        <th scope="col" width="5%">NO</th>
                        <th scope="col" width="25%">nama lengkap</th>
                        <th scope="col" width="20%">golongan</th>
                        <th scope="col" width="20%">NIP</th>
                        <th scope="col" width="30%">Jabatan</th>
                    </tr>
                    @if ($pegawai->count()<=0)
                        <tr style="text-transform:uppercase;">
                            <td colspan="5">Tidak ada data.</td>
                        </tr>
                    @else
                        @foreach ($pegawai as $item)
                            <tr style="text-transform:uppercase;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_pegawai }}</td>
                                <td>{{ $item->golongan }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->jabatan }}</td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            @else
                <p class="text-medium">belum ada data pegawai</p>
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