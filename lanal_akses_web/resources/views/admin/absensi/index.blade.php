@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <style>
        table>.tbody>tr>td{
            border: solid 1px #e0e0e0 !important;
        }
    </style>
    @php
        $absensiPersonil = array(
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "nrp" => "26266/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Indra Nusha R",
                "nrp" => "16572/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_lengkap" => "Rochmat Abdullah",
                "nrp" => "17374/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_lengkap" => "Rianto, S.H",
                "nrp" => "21037/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_lengkap" => "Eko Meiyanto",
                "nrp" => "21574/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "nrp" => "26266/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Indra Nusha R",
                "nrp" => "16572/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_lengkap" => "Rochmat Abdullah",
                "nrp" => "17374/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_lengkap" => "Rianto, S.H",
                "nrp" => "21037/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_lengkap" => "Eko Meiyanto",
                "nrp" => "21574/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ],
);

        $absensiPegawai = array(
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_pegawai" => "Suhartono",
                "nip" => "19681021 199303 1 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ],
);

$date = '08-01-2024';

        $statusKehadiranIcon = [
            'check',
            'xmark',
            'clock',
            'file',
            'circle-exclamation',
];
        $statusKehadiran = [
            'hadir',
            'tidak hadir',
            'terlambat',
            'ijin',
            'belum absen',
];
        $bgStatusKehadiran = [
            'border-success',
            'border-danger',
            'border-warning',
            'border-primary',
            'border-secondary',
];
        $iconColor = [
            'text-success',
            'text-danger',
            'text-warning',
            'text-primary',
            'text-secondary',
];
    @endphp
    <div class="container">
        <h2 class="text-black my-4 text-center" style="text-transform: uppercase">Presensi Personel & Pegawai LANAL Banyuwangi</h2>
        
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
                            <th  class="text-info">:</th>
                            <td><span id="waktu_sekarang"></span></td>
                        </tr>
                    </table>
                </div>
    
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-greenmain">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Absensi Personel Hari Ini</h5>
                                    <p class="card-text text-white">{{ count($absensiPersonil) }} / {{ '190' }}</p>
                                    <a href="#" class="btn btn-outline-light">More info</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-greendark">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Jumlah Absensi Pegawai Hari Ini</h5>
                                    <p class="card-text text-white">{{ count($absensiPersonil) }} / {{ '13' }}</p>
                                    <a href="#" class="btn btn-outline-light">More info</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
        
        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <h4 style="text-transform: uppercase">Edit Jam kerja</h4>
            <form method="POST" action="">
                @csrf
                <div class="form-group row">
                    <label for="jam_masuk_mulai" class="col-sm-2 col-form-label">Jam Masuk Mulai</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="jam_masuk_mulai" placeholder="00:00" value="{{ old('jam_masuk_mulai') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_masuk_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    <label for="jam_masuk_selesai" class="col-sm-2 col-form-label">Jam Masuk Selesai</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="jam_masuk_selesai" placeholder="00:00" value="{{ old('jam_masuk_selesai') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_masuk_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                </div>
                <div class="form-group row">
                    <label for="jam_pulang_mulai" class="col-sm-2 col-form-label">Jam Pulang Mulai</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="jam_pulang_mulai" placeholder="00:00" value="{{ old('jam_pulang_mulai') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_pulang_mulai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    <label for="jam_pulang_selesai" class="col-sm-2 col-form-label">Jam Pulang Selesai</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                            <input type="text" class="form-control" name="jam_pulang_selesai" placeholder="00:00" value="{{ old('jam_pulang_selesai') }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_pulang_selesai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                </div>
                <div class="form-group">
                    <label for="keterangan_jam_kerja">Massukkan keterangan jam kerja</label>
                    <input type="area" class="form-control @error('keterangan_jam_kerja') is-invalid @enderror" id="keterangan_jam_kerja" name="keterangan_jam_kerja" value="{{ old('keterangan_jam_kerja')}}" placeholder="keterangan" autofocus>
                    @error('keterangan_jam_kerja')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                <div class="pt-4 border-top border-black text-right">
                    <button type="submit" class="btn btn-md btn-primary" style="text-transform: capitalize">Tambah data jam kerja <i class="fa-solid fa-plus"></i></button>
                </div>
            </form>
        </div>
        
        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="row">
                <div class="col-md-3">
                    <h4 style="text-transform: uppercase">Rekap Data Presensi</h4>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-around">
                        <a href="#" class="btn btn-success">Cetak Data Bulanan <i class="fa-solid fa-print"></i></a>
                        <a class="btn btn-primary text-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-print"></i> Cetak Data Mingguan</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Minggu ke-1</a>
                            <a class="dropdown-item" href="#">Minggu ke-2</a>
                            <a class="dropdown-item" href="#">Minggu ke-3</a>
                            <a class="dropdown-item" href="#">Minggu ke-4</a>
                            <a class="dropdown-item" href="#">Minggu ke-5</a>
                        </div>
                        <a href="#" class="btn btn-info">Cetak Data Harian <i class="fa-solid fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="row justify-content-between"> 
                <div class="col-lg-8">
                    <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Personel</h6>
                    <h6 class="text-black" style="text-transform: uppercase">{{ $date }}</h6>
                </div>
            </div>

            <div class="container-fluid mt-4 p-0">
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
                            <th width="10%">aksi</th>
                        </tr>
                    </thead>
                    @if (count($absensiPersonil)!=0)
                    @foreach ($absensiPersonil as $dataAbsensiPersonil)
                        <tbody class="tbody">
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataAbsensiPersonil['nama_lengkap'] }}</td>
                                <td>{{ $dataAbsensiPersonil['nrp'] }}</td>
                                <td>{{ $dataAbsensiPersonil['tanggal_absensi'] }}</td>
                                <td class="text-center">
                                    @foreach ($statusKehadiran as $item)
                                        @if ($dataAbsensiPersonil['status_kehadiran'] == $item)
                                        <div class="m-1 py-1 row justify-content-around align-items-center rounded border {{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                            <p class="px-0  m-0" style="">{{ $dataAbsensiPersonil['status_kehadiran']}}</p>
                                            <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                        </div>
                                        @else
                                            
                                        @endif
                                    @endforeach    
                                </td>
                                <td>{{ $dataAbsensiPersonil['jam_masuk'] }}</td>
                                <td>{{ $dataAbsensiPersonil['jam_pulang'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        lihat <li style="font-size:10pt" class="ml-1 fa-solid fa-eye"></li>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach    
                    @else
                        <tbody>
                              <td colspan="8">Belum ada data absensi personil hari ini</td>  
                        </tbody>
                    @endif
                </table>
            </div>
        </div>

        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="row justify-content-between"> 
                <div class="col-lg-8">
                    <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Pegawai</h6>
                    <h6 class="text-black" style="text-transform: uppercase">{{ $date }}</h6>
                </div>

            </div>

            <div class="container-fluid mt-4 p-0">
                <table class="table ">
                    <thead class="bg-bluedark rounded-top text-white" style="text-transform: uppercase">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Nama Lengkap</th>
                            <th width="10%">NIP</th>
                            <th width="15%">tanggal absensi</th>
                            <th width="15%">status kehadiran</th>
                            <th width="10%">jam masuk</th>
                            <th width="10%">jam pulang</th>
                            <th width="10%">aksi</th>
                        </tr>
                    </thead>
                    @if (count($absensiPegawai)!=0)
                    @foreach ($absensiPegawai as $dataAbsensiPegawai)
                        <tbody class="tbody">
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataAbsensiPegawai['nama_pegawai'] }}</td>
                                <td>{{ $dataAbsensiPegawai['nip'] }}</td>
                                <td>{{ $dataAbsensiPegawai['tanggal_absensi'] }}</td>
                                <td class="text-center">
                                    @foreach ($statusKehadiran as $item)
                                        @if ($dataAbsensiPegawai['status_kehadiran'] == $item)
                                        <div class="m-1 py-1 row justify-content-around align-items-center rounded border {{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                            <p class="px-0  m-0" style="">{{ $dataAbsensiPegawai['status_kehadiran']}}</p>
                                            <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                        </div>
                                        @else
                                            
                                        @endif
                                    @endforeach    
                                </td>
                                <td>{{ $dataAbsensiPegawai['jam_masuk'] }}</td>
                                <td>{{ $dataAbsensiPegawai['jam_pulang'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-outline-primary">
                                        lihat <li style="font-size:10pt" class="ml-1 fa-solid fa-eye"></li>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach    
                    @else
                        <tbody>
                              <td colspan="8">Belum ada data absensi personil hari ini</td>  
                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
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