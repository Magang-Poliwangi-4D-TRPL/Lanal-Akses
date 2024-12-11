@extends('layout.personil.app')

@section('title-page', 'Personil | Dashboard')

@section('content')
<div class="container">
    <h2 class="text-black my-4 text-center" style="text-transform: uppercase">Presensi Personel & Pegawai LANAL Banyuwangi</h2>
    <div class="container-fluid bg-white border rounded p-4 mt-4">
        <div class="row">
            <div class="col-md-6">

                <h5 class="p-0 m-0" id="current_time"></h5>
            </div>
            <div class="col-md-6 container rounded  border border-info  row justify-content-between align-item-center mb-3 p-2">

                <h5 class="p-0 m-0 " id="current_date"></h5>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6 justify-content-start">
                <h2 class="mt-3 bluedark text-left jabatan">{{ auth()->user()->personil->jabatan }}</h2>
                <h4 class="text-left nama">{{ auth()->user()->personil->nama_lengkap }} </h4>
                <p class="text-left text-secondary">{{ auth()->user()->personil->nrp }}</p>
            </div>
            <div class="col-md-6 my-auto">
                <div class="row rounded bg-light py-4">
                    <div class="col-md-4">
                        @foreach ($statusKehadiran as $item)
                            @if ($presensi_hari_ini->status_kehadiran === $item)
                                <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                    <p class="px-0  m-0" style="">{{ $presensi_hari_ini->status_kehadiran}}</p>
                                    <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                </div>
                            @else
                                                                
                            @endif
                        @endforeach    
                    </div>
                    @if($presensi_hari_ini->status_kehadiran == 'Belum Absen')
                        <div class="col-md-8">
                            <a href="{{ route('personil.absensi') }}" class="btn btn-secondary btn-md btn-block bg-greendark">Presensi Sekarang<i class="ml-2 fa fa-check"></i></a>

                        </div>
                    @else
                        <div class="col-md-8">
                            <a class="btn btn-success btn-md btn-block text-white">Anda sudah melakukan presensi hari ini.<i class="ml-2 fa fa-check"></i></a>

                        </div>
                    
                    @endif
                        
                        
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-white border rounded p-4 my-4">
        <h3>Riwayat Presensi Personel Minggu ini</h3>
        <div class="container-fluid mt-4">
            <table class="table ">
                <thead class="bg-bluedark rounded-top text-white" style="text-transform: uppercase">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Nama Lengkap</th>
                        <th width="5%">NRP</th>
                        <th width="15%">tanggal absensi</th>
                        <th width="15%">status kehadiran</th>
                        <th width="10%">jam masuk</th>
                        <th width="10%">jam pulang</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="container" style="height: {{ count($riwayat_presensi)<10 ? 'auto' : '600px' }}; overflow: auto;">
            <table class="table" id="dataTablePersonil">
                @if (count($riwayat_presensi)!=0)
                @foreach ($riwayat_presensi as $dataAbsensiPersonil)
                    <tbody class="tbody">
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td width="20%">{{ $dataAbsensiPersonil->personil->nama_lengkap }}</td>
                            <td width="5%">{{ $dataAbsensiPersonil->personil->nrp }}</td>
                            <td width="15%">{{ $dataAbsensiPersonil->tanggal_kehadiran }}</td>
                            <td width="15%" class="text-center">
                                @foreach ($statusKehadiran as $item)
                                    @if ($dataAbsensiPersonil->status_kehadiran == $item)
                                    <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                        <p class="px-0  m-0" style="">{{ $dataAbsensiPersonil->status_kehadiran}}</p>
                                        <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                    </div>
                                    @else
                                        
                                    @endif
                                @endforeach    
                            </td>
                            <td width="10%">{{ $dataAbsensiPersonil->jam_masuk == null? '-' : $dataAbsensiPersonil->jam_masuk }}</td>
                            <td width="10%">{{ $dataAbsensiPersonil->jam_pulang == null? '-' : $dataAbsensiPersonil->jam_pulang }}</td>
                        </tr>
                    </tbody>
                @endforeach    
                @else
                    <tbody>
                          <td colspan="8">Belum ada data absensi personil hari ini</td>  
                    </tbody>
                @endif
            </table>
            <!-- Tambahkan pesan jika hasil pencarian kosong -->
            <div id="emptyMessagePersonil" style="display: none;">
                <p>Data yang dicari kosong</p>
            </div>
        </div>
    </div>
</div>
<script>
    function displayWaktu() {
        var waktu = new Date(); 
        var options = {timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        var jam = waktu.toLocaleTimeString('id-ID', options);
        jam = jam.replace(/\./g, ' : ');
        document.getElementById('current_time').innerText = jam;

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const day = days[waktu.getDay()];
        const date = waktu.getDate();
        const month = waktu.getMonth() + 1;
        const year = waktu.getFullYear();
            document.getElementById('current_date').innerText = `${day}, ${date < 10 ? '0' + date : date}-${month < 10 ? '0' + month : month}-${year}`;
            
            setTimeout(displayWaktu, 1000);
    }
    displayWaktu();
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    }

    function showPosition(position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Setel nilai input lokasi pada formulir
        document.getElementById("lokasi").value = latitude + ',' + longitude;

        // Tampilkan lokasi pada elemen kontainer
        // document.getElementById("lokasi-value").innerHTML = "Lokasi: " + latitude + ', ' + longitude;
    }
</script>
@endsection