@extends('layout.admin.app')

@section('title-page', 'Admin | Dashboard')

@section('content')

<div class="container">
  <h1 class="text-black mt-4">Dashboard</h1>
  <div class="container bg-white border rounded p-5 mt-4">
    <div class="row">
      <div class="col-md-4 border-right solid black">
        <p style="color: #3F51C4"><iconify-icon class="mr-3" icon="material-symbols:group" width="24"></iconify-icon> Jumlah Personel</p>
        <p class="m-0 p-0" style="color: #3F51C4"><span style="font-size: 36pt; color: #1e1e1e !important">{{ $personil->count() }}</span> Orang</p>
      </div>
      <div class="col-md-4">
        <p class="text-gray"><iconify-icon class="mr-3" icon="material-symbols:group" width="24"></iconify-icon> Jumlah PNS</p>
        <p class="text-gray m-0 p-0"><span style="font-size: 36pt; color: #1e1e1e !important">{{ $pns->count() }}</span> Orang</p>
      </div>
      <div class="col-md-4 border-left solid black">
        <p class="text-danger "><iconify-icon class="mr-3" icon="material-symbols:group" width="24"></iconify-icon> Akun Kepala Satuan Kerja</p>
        <p class="text-danger m-0 p-0"><span style="font-size: 36pt; color: #1e1e1e !important">{{ $admin->count() }}</span> Akun</p>
      </div>
    </div>
  </div>  
  <div class="container bg-white border rounded p-5 mt-4">
    
    <div class="row mb-4 ">
        <div class="col-md-4">
          <h2 style="font-weight:400 !important">Presensi Anggota</h2>
        </div>
        <div class="col-md-8 d-flex justify-content-between">
          <h2 style="font-weight:400 !important" class="p-auto" id="waktu_sekarang"></h2>
          <h2 style="font-weight:400 !important" class="m-auto" id="tanggal_sekarang"></h2>
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
    <div class="row justify-content-center">
        <div class="col-md-5">
              <div class="card bg-greenmain">
                  <div class="card-body">
                      <h5 class="card-title text-white">Kehadiran Personel Hari Ini</h5>
                      <p class="card-text text-white"><span style="font-size: 36pt">{{ count($absensiPersonil)-count($countPresensiPersonilToday) }}</span> / {{ count($absensiPersonil) }}</p>
                      <a href="{{ route('admin.absensi.data-presensi') }}" class="btn btn-outline-light">Lihat Data</a>
                  </div>
              </div>
          </div>
          <div class="col-md-5">
              <div class="card" style="background-color: #856F14 !important">
                  <div class="card-body">
                      <h5 class="card-title text-white">Kehadiran Pegawai Hari Ini</h5>
                      <p class="card-text text-white"><span style="font-size: 36pt">{{ count($absensiPegawai)-count($countPresensiPegawaiToday) }}</span> / {{ count($absensiPegawai) }}</p>
                      <a href="{{ route('admin.absensi.data-presensi') }}" class=" btn btn-outline-light">Lihat Data</a>
                  </div>
              </div>
          </div>
          <div class="container py-4">

            <p class="text-secondary">Jumlah yang mengajukan cuti bulan ini: <span  style="color: #1e1e1e !important">{{ $pengajuanCuti->count() }} Pengajuan</span></p>
          </div>
      </div>
  
  </div>
</div>


@endsection