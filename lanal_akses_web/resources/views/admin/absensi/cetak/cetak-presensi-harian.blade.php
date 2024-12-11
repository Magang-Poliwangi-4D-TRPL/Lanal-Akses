<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Presensi Harian</title>
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
        .status-hadir {
            color: darkgreen;
            font-weight: bold;
        }

        .status-tidak-hadir {
            color: red;
            font-weight: bold;
        }

        .status-terlambat {
            color: orange;
            font-weight: bold;
        }

        .status-cuti {
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
    <div class="container">
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
                <td>{{ $date }}</td>
            </tr>
            <tr>
                <th>Jenis Presensi</th>
                <td>Presensi Harian</td>
            </tr>
        </table>

        <!-- Data Presensi Personel -->
        <h4>Data Presensi Personel</h4>
        @if($absensiPersonil->count() != 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NRP</th>
                        <th>Tanggal Absensi</th>
                        <th>Status Kehadiran</th>
                        <th>Jam Masuk - Jam Pulang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensiPersonil as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->personil->nama_lengkap }}</td>
                            <td>{{ $item->personil->nrp }}</td>
                            <td>{{ $item->tanggal_kehadiran }}</td>
                            <td>
                                @if ($item->status_kehadiran == 'Hadir')
                                    <span class="status-hadir">{{ $item->status_kehadiran }}</span>
                                @elseif ($item->status_kehadiran == 'Tidak Hadir')
                                    <span class="status-tidak-hadir">{{ $item->status_kehadiran }}</span>
                                @elseif ($item->status_kehadiran == 'Terlambat')
                                    <span class="status-terlambat">{{ $item->status_kehadiran }}</span>
                                @elseif (strpos($item->status_kehadiran, 'Cuti') !== false)
                                    <span class="status-cuti">{{ $item->status_kehadiran }}</span>
                                @else
                                    {{ $item->status_kehadiran }}
                                @endif
                            </td>
                            <td>{{ $item->jam_masuk == null ? '-' : $item->jam_masuk }} - {{ $item->jam_pulang == null ? '' : $item->jam_pulang }}</td>
                            <td>{{ $item->keterangan == null ? '-' : $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada data personel</p>
        @endif

        <!-- Data Presensi Pegawai -->
        <h4>Data Presensi Pegawai</h4>
        @if($absensiPegawai->count() != 0)
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>NIP</th>
                        <th>Tanggal Absensi</th>
                        <th>Status Kehadiran</th>
                        <th>Jam Masuk - Jam Pulang</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensiPegawai as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pegawai->nama_pegawai }}</td>
                            <td>{{ $item->pegawai->nip }}</td>
                            <td>{{ $item->tanggal_kehadiran }}</td>
                            <td>
                                @if ($item->status_kehadiran == 'Hadir')
                                    <span class="status-hadir">{{ $item->status_kehadiran }}</span>
                                @elseif ($item->status_kehadiran == 'Tidak Hadir')
                                    <span class="status-tidak-hadir">{{ $item->status_kehadiran }}</span>
                                @elseif ($item->status_kehadiran == 'Terlambat')
                                    <span class="status-terlambat">{{ $item->status_kehadiran }}</span>
                                @elseif (strpos($item->status_kehadiran, 'Cuti') !== false)
                                    <span class="status-cuti">{{ $item->status_kehadiran }}</span>
                                @else
                                    {{ $item->status_kehadiran }}
                                @endif
                            </td>
                            <td>{{ $item->jam_masuk == null ? '-' : $item->jam_masuk }} - {{ $item->jam_pulang == null ? '' : $item->jam_pulang }}</td>
                            <td>{{ $item->keterangan == null ? '-' : $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="no-data">Belum ada data pegawai</p>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p>Banyuwangi, {{ date('d M Y') }}</p>
            <p>Yang Membuat,</p>

            <div class="signature">
                <p>________________________</p>
            </div>
        </div>
    </div>
</body>
</html>
