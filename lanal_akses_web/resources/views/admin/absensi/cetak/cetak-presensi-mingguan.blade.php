<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Presensi Mingguan</title>
    <style>
        /* Styling dasar */
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            margin: 20px;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Header */
        .header {
            margin-bottom: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 18px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .header h2 {
            font-size: 16px;
            margin-top: 5px;
            text-transform: uppercase;
        }

        .header .confidential {
            color: red;
            font-size: 14px;
            font-weight: bold;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid black;
            padding: 4px;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .no-data {
            text-align: left;
            margin-top: 20px;
        }

        /* Status Kehadiran Colors */
        .H {
            color: #22bb33;
            font-weight: bold;
        }

        .A {
            color: red;
            font-weight: bold;
        }

        .T {
            color: orange;
            font-weight: bold;
        }

        .C {
            color: blue;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: right;
        }

        .footer .signature {
            margin-top: 60px;
            text-align: right;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>MARKAS BESAR TNI ANGKATAN LAUT</h1>
        <h2>DINAS ADMINISTRASI PERSONEL</h2>
        <p class="confidential"><u>RAHASIA</u></p>
    </div>
     <!-- Informasi Tanggal dan Jenis Presensi -->
     <table>
        <tr>
            <th>Tanggal Presensi</th>
            <td>{{ $startDate->format('d-m-Y') }} s/d {{ $endDate->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Jenis Presensi</th>
            <td>Presensi Mingguan</td>
        </tr>
    </table>
    <div>
        <p style="display: inline">Keterangan : </p>
        <p style="display: inline" class="H"> H : Hadir</p>
        <p style="display: inline" class="A"> A : Tidak Hadir (Absen)</p>
        <p style="display: inline" class="C"> C : Cuti</p>
        <p style="display: inline" class="T"> T : Terlambat</p>
    </div>
    <h4>Data Kehadiran Personel</h4>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Nama Lengkap</th>
                <th rowspan="2">NRP</th>
                <th colspan="7">Tanggal Presensi {{ $startDate->copy()->subDays(0)->format('m-Y') }}</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                
                @for($i = 6; $i >= 0; $i--)
                    <th>{{ $startDate->copy()->subDays($i)->format('d') }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiPersonil->groupBy('personil_id') as $personilId => $kehadiranPersonil)
                <tr>
                    <td>{{ $kehadiranPersonil->first()->personil->nama_lengkap }}</td>
                    <td>{{ $kehadiranPersonil->first()->personil->nrp }}</td>
                    @for($i = 6; $i >= 0; $i--)
                        @php
                            $tanggal = $startDate->copy()->subDays($i)->format('Y-m-d');
                            $kehadiran = $kehadiranPersonil->firstWhere('tanggal_kehadiran', $tanggal);
                        @endphp
                        <td class="{{ $kehadiran ? ($kehadiran->status_kehadiran == 'Hadir' ? 'H' : ($kehadiran->status_kehadiran == 'Tidak Hadir' ? 'A' : ($kehadiran->status_kehadiran == 'Terlambat' ? 'T' : 'C'))) : '' }}">
                            {{ $kehadiran ? ($kehadiran->status_kehadiran == 'Hadir' ? 'H' : ($kehadiran->status_kehadiran == 'Tidak Hadir' ? 'A' : ($kehadiran->status_kehadiran == 'Terlambat' ? 'T' : 'C'))) : '-' }}
                        </td>
                    @endfor
                    <td>{{ $kehadiranPersonil->first()->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    <h4>Data Kehadiran Pegawai</h4>
    <table>
        <thead>
            <tr>
                <th rowspan="2">Nama Lengkap</th>
                <th rowspan="2">NIP</th>
                <th colspan="7">Tanggal Presensi {{ $startDate->copy()->subDays(0)->format('m-Y') }}</th>
                <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
                
                @for($i = 6; $i >= 0; $i--)
                    <th>{{ $startDate->copy()->subDays($i)->format('d') }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($absensiPegawai->groupBy('pegawai_id') as $pegawaiId => $kehadiranPegawai)
                <tr>
                    <td>{{ $kehadiranPegawai->first()->Pegawai->nama_pegawai }}</td>
                    <td>{{ $kehadiranPegawai->first()->Pegawai->nip }}</td>
                    @for($i = 6; $i >= 0; $i--)
                        @php
                            $tanggal = $startDate->copy()->subDays($i)->format('Y-m-d');
                            $kehadiran = $kehadiranPegawai->firstWhere('tanggal_kehadiran', $tanggal);
                        @endphp
                        <td class="{{ $kehadiran ? ($kehadiran->status_kehadiran == 'Hadir' ? 'H' : ($kehadiran->status_kehadiran == 'Tidak Hadir' ? 'A' : ($kehadiran->status_kehadiran == 'Terlambat' ? 'T' : 'C'))) : '' }}">
                            {{ $kehadiran ? ($kehadiran->status_kehadiran == 'Hadir' ? 'H' : ($kehadiran->status_kehadiran == 'Tidak Hadir' ? 'A' : ($kehadiran->status_kehadiran == 'Terlambat' ? 'T' : 'C'))) : '-' }}
                        </td>
                    @endfor
                    <td>{{ $kehadiranPegawai->first()->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Footer -->
    <div class="footer">
        <p>Banyuwangi, {{ date('d M Y') }}</p>
        <p>Yang Membuat,</p>

        <div class="signature">
            <p>________________________</p>
        </div>
    </div>
</body>
</html>
