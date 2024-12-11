@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <style>
        table>.tbody>tr>td{
            border: solid 1px #e0e0e0 !important;
        }
    </style>
    @php
        $str_arr = explode ("-", $date);  
        $day = $str_arr[2];
        $month = $str_arr[1];
        $year = $str_arr[0];
    @endphp
    <div class="container">
        <h2 class="text-black my-4 text-center" style="text-transform: uppercase">Presensi Personel & Pegawai LANAL Banyuwangi</h2>
        {{-- Grafik Kinerja Personel dan Pegawai --}}
        <div class="container-fluid bg-white border rounded p-4 mt-4">
            <h4 class="text-center">Informasi Kinerja Personel & Pegawai Lanal Banyuwangi</h4>
            <hr>
            <div class="row">
                <!-- Donut Chart Personel -->
                <div class="col-md-6 ">
                    <h3>Kehadiran Personel</h3>
                    @if($personilStatusCounts)
                        <div class="col-md-10">
                            <canvas id="personilDonutChart" width="50" height="50"></canvas>
                        </div>
                    @else
                        <p>Belum ada data presensi bulan ini.</p>
                    @endif
                    <p class="py-auto mt-4">Data kehadiran personel bulan ini: {{ $jumlahKehadiranPersonelBulanIni }}</p>
                </div>
                
                <!-- Donut Chart Pegawai -->
                <div class="col-md-6">
                    <h3>Kehadiran Pegawai</h3>
                    @if($pegawaiStatusCounts)
                        <div class="col-md-10">
                            <canvas id="pegawaiDonutChart" width="50" height="50"></canvas>
                        </div>
                    @else
                        <p class="py-auto">Belum ada data presensi bulan ini.</p>
                    @endif
                        <p class="py-auto mt-4">Data kehadiran pegawai bulan ini: {{ $jumlahKehadiranPegawaiBulanIni }}</p>
                </div>
            </div>
            <hr>
            <div class="row justify-content-between">

                <p>Klik tombol disamping jika anda ingin melihat data presensi hari ini </p><a href="{{ route('admin.absensi.data-presensi') }}" class="btn btn-primary btn-fluid">Lihat Presensi Hari ini</a>
            </div>
        </div>
        
        <div class="container-fluid bg-white border rounded p-4 mt-4">
            <div class="row align-item-center justify-content-center">
                <div class="col-lg-4">
                    <table class="container-fluid">
                        <tr>
                            <th width="10%"><i class="fa-solid fa-calendar-days text-success"></i></th>
                            <th width="20%" style="text-transform: uppercase" class="text-success">Tanggal</th>
                            <th width="5%"  class="text-success">:</th>
                            <td width="75%"><span id="tanggal_sekarang"></span></td>
                        </tr>
                        <tr>
                            <th  class="text-info"><i class="fa-solid fa-clock"></i></i></th>
                            <th  class="text-info" style="text-transform: uppercase">Waktu</th>
                            <th colspan="3" class="text-info">:</th>
                            
                        </tr>
                        <tr>
                            <td colspan="4" class="py-5"><h2 class="text-center" id="waktu_sekarang"></h2></td>
                        </tr>
                    </table>
                </div>
    
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-greenmain">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Absensi Personel Hari Ini</h5>
                                    <p class="card-text text-white">{{ count($absensiPersonil)-count($countPresensiPersonilToday) }} / {{ count($absensiPersonil) }}</p>
                                    <a href="{{ route('admin.absensi.generate-presensi-personil-today', ['date' => $date]) }}" class="btn btn-outline-light">Hasilkan data absensi Hari ini</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-greendark">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Absensi Pegawai Hari Ini</h5>
                                    <p class="card-text text-white">{{ count($absensiPegawai)-count($countPresensiPegawaiToday) }} / {{ count($absensiPegawai) }}</p>
                                    <a href="{{ route('admin.absensi.generate-presensi-pegawai-today', ['date' => $date]) }}" class="btn btn-outline-light">Hasilkan data absensi Hari ini</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        
        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="row">
                <div class="col-md-3">
                    <h4 style="text-transform: uppercase">Rekap Data Presensi</h4>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-around">
                        <a target="_blank" href="{{ route('admin.absensi.cetak-presensi.bulanan')}}" class="btn btn-success">Cetak Data Bulanan <i class="fa-solid fa-print"></i></a>
                        <a href="{{ route('admin.absensi.filter-mingguan') }}" class="btn btn-primary">Cetak Data Mingguan <i class="fa-solid fa-print"></i></a>
                        <a href="{{ route('admin.absensi.filter') }}" class="btn btn-info">Cari dan Cetak Data Harian <i class="fa-solid fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="container-fluid bg-white border rounded p-4 mt-4">
            @if ($informasiJamKerja->count()<=0)
            <h4 class="text-center">Informasi Jam Kerja</h4>
            <div class="row container-fluid d-flex justify-content-around align-item-center mt-4">
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Masuk Mulai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">00:00</p>
                </div>
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Masuk Selesai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">00:00</p>
                </div>
            </div>
            <div class="row container-fluid d-flex justify-content-around align-item-center mt-3">
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Pulang Mulai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">00:00</p>
                </div>
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Pulang Selesai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">00:00</p>
                </div>
            </div>
            @else
            <h4 class="text-center text-uppercase">{{ $informasiJamKerja[0]->nama_waktu_kerja }}</h4>
            <div class="row container-fluid d-flex justify-content-around align-item-center mt-4">
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Masuk Mulai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">{{ $informasiJamKerja[0]->jam_masuk_mulai }}</p>
                </div>
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Batas Jam Masuk</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">{{ $informasiJamKerja[0]->jam_masuk_selesai }}</p>
                </div>
            </div>
            <div class="row container-fluid d-flex justify-content-around align-item-center mt-3">
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Jam Pulang Mulai</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">{{ $informasiJamKerja[0]->jam_pulang_mulai }}</p>
                </div>
                <div class="col-md-2 p-2">
                    <p class="m-0 p-0"><b>Batas Jam Pulang</b></p>
                </div>
                <div class="col-md-4 rounded border p-2 border-outline-secondary">
                    <p class="m-0 p-0">{{ $informasiJamKerja[0]->jam_pulang_selesai }}</p>
                </div>
            </div>
            <div class="container mt-4">
                @empty ($informasiJamKerja[0]->keterangan)
                @else
                <p>{{ $informasiJamKerja[0]->keterangan }}</p>
                @endEmpty
            </div>
            @endif
            <div class="row container justify-content-end py-4 mt-3 border-top border-primary">
                <div class="col-md-6 text-right">
                    @if ($informasiJamKerja->count()<=0)
                    <a href="{{ route('admin.absensi.data-jam-kerja.create') }}" class="btn btn-primary">Tambah Jam Kerja Baru <i class="fa-solid fa-add"></i></a>
                    
                    @else
                    <a href="{{ route('admin.absensi.data-jam-kerja.edit', ['idWaktuKerja' => $informasiJamKerja[0]->id]) }}" class="btn btn-primary bg-bluedark">Edit Jam Kerja <i style="font-size: 10pt" class="ml-1 fa-solid fa-pencil"></i></a>
                        
                    @endif

                </div>
            </div>
            
        </div>
        

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    @if($personilStatusCounts)
    <script>
        var ctxPersonil = document.getElementById('personilDonutChart').getContext('2d');
        var personilDonutChart = new Chart(ctxPersonil, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Terlambat', 'Tidak Hadir', 'Cuti'],
                datasets: [{
                    label: 'Kehadiran Personil',
                    data: @json(array_values($personilStatusCounts)),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Status Kehadiran Personil dalam Satu Bulan'
                    },
                    datalabels: {
                        color: '#000',
                        formatter: (value, ctx) => {
                            let total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = (value / total * 100).toFixed(1) + '%';
                            return value + ' (' + percentage + ')'; // Tampilkan jumlah dan persentase
                        },
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
    @endif

    @if($pegawaiStatusCounts)
    <script>
        var ctxPegawai = document.getElementById('pegawaiDonutChart').getContext('2d');
        var pegawaiDonutChart = new Chart(ctxPegawai, {
            type: 'doughnut',
            data: {
                labels: ['Hadir', 'Terlambat', 'Tidak Hadir', 'Cuti'],
                datasets: [{
                    label: 'Kehadiran Pegawai',
                    data: @json(array_values($pegawaiStatusCounts)),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Status Kehadiran Pegawai dalam Satu Bulan'
                    },
                    datalabels: {
                        color: '#000',
                        formatter: (value, ctx) => {
                            let total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                            let percentage = (value / total * 100).toFixed(1) + '%';
                            return value + ' (' + percentage + ')'; // Tampilkan jumlah dan persentase
                        },
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    </script>
    @endif
    <script>
       
        function displayWaktu() {
            var waktu = new Date(); 
            const formatHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const formatBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
            var options = {timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            var jam = waktu.toLocaleTimeString('id-ID', options);
            jam = jam.replace(/\./g, ' : ');
            document.getElementById('waktu_sekarang').innerText = jam;
    
            var namaHari = formatHari[waktu.getDay()];
            var namaBulan = formatBulan[waktu.getMonth()];
            var tanggal = `${waktu.getDate() < 10 ? '0' + waktu.getDate() : waktu.getDate()}`;
            var bulan = `${waktu.getMonth() + 1 < 10 ? '0' + (waktu.getMonth() + 1) : waktu.getMonth() + 1}`;
            var tahun = waktu.getFullYear();
    
            document.getElementById('tanggal_sekarang').innerText = namaHari + ', ' + tanggal + ' ' + namaBulan + ' ' + tahun;
    
            setTimeout(displayWaktu, 1000);
        }
    
        displayWaktu();
    </script>

    
@endsection