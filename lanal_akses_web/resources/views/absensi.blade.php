@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
    <div class="container bg-white rounded p-4 my-5">
        <div class="container-fluid row m-0 p-0">
            <div class="col-lg-5 col-sm-6 m-0 p-0 bg-bluedark rounded" id="left-section">
                <div class="image-container rounded">
                    <!-- Background image goes here -->
                    <div class="text-overlay">
                        <h2>LANAL AKSES</h2>
                        <p>Website informasi administrasi dan absensi seluruh anggota Lanal Banyuwangi</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7 col-sm-6 py-5 px-5">
                <div class="container rounded  border border-info  row justify-content-between align-item-center mb-3 p-2">
                    <h5 class="p-0 m-0" id="current_time"></h5>
                    <h5 class="p-0 m-0 " id="current_date"></h5>
                </div>
                <div class="container-fluid mt-5 row justify-content-between ">
                    <img class="col-md-6" src="{{ URL::asset('images/admin/absensi-illustrasi.png') }}" alt="https://storyset.com/illustration/confirmed-attendance/pana#385655FF&hide=&hide=complete" width="50%">
                    <div class="col-md-6 row d-flex align-item-center">
                        <h4 class="p-0 m-0 mt-5 text-uppercase"><b>Selamat Datang!</b></h4>
                        <p class="py-1 m-0 mb-5 ">Absen sekarang dengan menggunakan nama dan NRP anda</p>
                    </div>
                </div>
                @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-absensi row justify-content-center mt-3">
                    <div class="container-fluid">
                        <form method="POST" action="{{ route('personil.absensi.store') }}">
                            @csrf
                            {{-- <p>{{ $waktu_kerja[0]->jam_masuk_mulai }}</p> --}}
                            <input hidden type="text" class="form-control" name="tanggal_absensi" id="tanggal_absensi" value="{{ $date }}">
                            <input hidden type="text" class="form-control" name="waktu_kerja_id" id="waktu_kerja_id" value="{{ $waktu_kerja[0]->id }}">
                            <div class="form-group">
                                <label for="nama_lengkap">Massukkan nama lengkap</label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap')}}" placeholder="Nama Lengkap" autofocus>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nrp">Massukkan NRP anda</label>
                                <input type="text" class="form-control @error('nrp') is-invalid @enderror" id="nrp" name="nrp" value="{{ old('nrp')}}" placeholder="NRP Anda">
                                @error('nrp')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                @enderror
                              </div>
                            <div class="form-group row">
                                <label for="status_kehadiran" class="col-sm-5 col-form-label">Status Kehadiran</label>
                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-text bg-greenmain text-white"><i class="fa-solid fa-pen-to-square"></i></div>
                                        <select class="form-control  @error('status_kehadiran') is-invalid @enderror" name="status_kehadiran" id="status_kehadiran">
                                            <option value="Hadir" {{ old('status_kehadiran') === "Hadir" ? 'selected' : '' }}>Hadir</option>
                                            <option value="Ijin" {{ old('status_kehadiran') === "Ijin" ? 'selected' : '' }}>Ijin</option>
                                        </select>
                                    </div>
                                    @error('status_kehadiran')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <div class="input-group-text bg-greenmain text-white"><i class="fa-solid fa-location"></i></div>
                                        <input readonly type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" placeholder="Lokasi anda saat ini">
                                        <button class="btn btn-success" type="button" onclick="getLocation()">Dapatkan Lokasi</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan (opsional)</label>
                                <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Masukkan keterangan" value="{{ old('keterangan') }}">
                                @error('keterangan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                @enderror
                            </div>
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-secondary btn-md btn-block bg-greendark">Absen Sekarang <i class="ml-2 fa fa-check"></i></button>
                                <p class="mt-4 mb-0 subtitle">Apakah anda pegawai? <a href="{{ url()->previous() }}">Klik disini untuk melakukan Presensi</a></p>
                                <p class="mt-1 mb-0">atau</p>
                                <a class="mt-1" href="{{ route('personil.login') }}"><i class="fa fa-arrow-left mr-2"></i> kembali ke halaman login</a>
                            </div>
                          </form>

                    </div>
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