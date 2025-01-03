<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Cuti</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        body {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;    
            margin: 2.4cm 2.4cm 2.4cm 2.4cm;
        }

        .s1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s2 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: underline;
            font-size: 12pt;
        }

        h1 {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 12pt;
        }

        p {
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
            margin: 0pt;
            text-align: justify;
        }

        li {
            display: block;
        }

        #l1 {
            padding-left: 0pt;
            counter-reset: c1 1;
        }

        #l1>li>*:first-child:before {
            counter-increment: c1;
            content: counter(c1, decimal)". ";
            color: black;
            font-family: Calibri, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
            text-align: justify;
        }

        #l1>li:first-child>*:first-child:before {
            counter-increment: c1 0;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
    </style>
</head>
<body>
    <table style="border-collapse:collapse" cellspacing="0">
        <tr style="height:14pt">
            <td style="width:200pt">
                <p class="s1" style="text-indent: 0pt;line-height: 1.15cm;text-align: center;">PANGKALAN UTAMA TNI AL V
                </p>
            </td>
        </tr>
        <tr style="height:14pt">
            <td style="width:200pt">
                <p class="s2" style="text-indent: 0pt;text-align: center;">PANGKALAN TNI AL BANYUWANGI
                </p>
            </td>
        </tr>
    </table>
    <h1 style="padding-top: 24pt;text-indent: 0pt;text-align: center;">SURAT CUTI</h1>
    <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">{{ $suratCuti->nomor_surat }}</p>
    <p style="padding-top: 9pt;padding-left: 5pt;text-indent: 0pt;line-height: 1.15cm%;;">Berdasarkan
        Keputusan Kepala Staf Anfatan Laut Nomor Kep/634/VII/2018 tanggal 20 Juli 2018 tentang Buku Petunjuk
        Penyelenggaraan Pewatan Prajurit TNI-AL.</p>
        <p style="padding-top: 12pt;text-indent: 0pt;text-align: center;">MEMBERIKAN CUTI KEPADA :</p>
    <table style="width: 100%; padding-top: 12pt;">
        <tr>
            <td style="width: 40%">Nama</td>
            <td style="width: 60%">: {{ $suratCuti->dataCutiPersonel->personil->nama_lengkap }}</td>
        </tr>
        <tr>
            <td style="width: 40%">Pangkat, NRP</td>
            <td style="width: 60%">: {{ $suratCuti->dataCutiPersonel->personil->pangkat }} {{ $suratCuti->dataCutiPersonel->personil->nrp }}</td>
        </tr>
        <tr>
            <td style="width: 40%">Jabatan, Kesatuan </td>
            <td style="width: 60%">: {{ $suratCuti->dataCutiPersonel->personil->jabatan }}</td>
        </tr>
        <tr>
            <td style="width: 40%">Jenis Cuti </td>
            <td style="width: 60%">: {{ $suratCuti->cuti->nama_cuti }}</td>
        </tr>
        <tr>
            <td style="width: 40%">Lama Cuti </td>
            <td style="width: 60%">: {{ $suratCuti->dataCutiPersonel->jumlah_hari }} Hari</td>
        </tr>
        <tr>
            <td style="width: 40%">Terhitung Mulai tanggal </td>
            <td style="width: 60%">: {{ \Carbon\Carbon::parse($suratCuti->tanggal_mulai_cuti)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td style="width: 40%">Sampai Dengan Tanggal </td>
            <td style="width: 60%">: {{ \Carbon\Carbon::parse($suratCuti->tanggal_selesai_cuti)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>
    <p style="text-indent: 0pt;;"><br /></p>
    <table style="border-collapse:collapse;" cellspacing="0">
        <tr style="height:42pt">
            <td style="width:91pt">
                <p class="s1" style="padding-left: 2pt;text-indent: 0pt;">Catatan</p>
            </td>
            <td style="width:59pt">
                <p class="s1" style="padding-right: 4pt;text-indent: 0pt;text-align: right">:</p>
            </td>
            <td style="width:310pt">
                <ol id="l1">
                    <li data-list-text="1.">
                        <p class="s1" style="padding-left: 22pt;text-indent: -17pt;">
                            Sebelum dan sesudah melaksanakan cuti wajib lapor kepada pejabat yang ditunjuk</p>
                    </li>
                    <li data-list-text="2.">
                        <p class="s1" style="padding-left: 22pt;text-indent: -17pt;line-height: 1.15cm;">
                            Surat Cuti ini berlaku sebagai Surat Ijin Jalan</p>
                    </li>
                </ol>
            </td>
        </tr>
    </table>
    <p style="padding-top: 12pt;text-indent: 0pt;;"><br /></p>
    <p style="padding-left: 254pt;text-indent: 0pt;">Dikeluarkan di Banyuwangi pada
    tanggal <u>{{ \Carbon\Carbon::parse($suratCuti->responCuti->updated_at)->translatedFormat('d F Y') }}</u></p>
    <p style="padding-left: 254pt;text-indent: 0pt;">Komandan Lanal Banyuwangi</p>
    <p style="text-indent: 0pt;;"><br><br><br><br></p>
    <p style="padding-left: 254pt;text-indent: 0pt;;">{{ $suratCuti->responCuti->komandan->nama_lengkap }}</p>
    <p style="padding-top: 1pt;padding-left: 254pt;text-indent: 0pt;;">{{ $suratCuti->responCuti->komandan->pangkat }} Inf NRP {{ $suratCuti->responCuti->komandan->nrp }}</p>
</body>
</html>