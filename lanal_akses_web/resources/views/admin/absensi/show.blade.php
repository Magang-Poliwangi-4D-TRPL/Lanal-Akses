@extends('layout.admin.app')

@section('title-page', 'Admin | Detail Presensi'. 'Suhendra Kurniawan')

@section('content')
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="container py-4 row justify-content-between">
                <div class="col-md-6 row align-item-center justify-content-start">
                    <div class="mr-4">
                        <img src="{{ URL::asset('images/admin/default-profile.jpg') }}" class="rounded-circle" height="50px" width="50px">
                    </div>
                    <h2 class="mt-1">Suhendra Kurniawan</h2>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-light btn-lg"><li style="font-size:10pt" class="mr-1 fa-solid fa-arrow-left"></li> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 py-4 bg-white rounded">
        <div class="container border-bottom border-black py-4">
            <div class="row d-flex justify-content-between align-item-center">
                <div class="col-md-6">
                    <p class="btn btn-warning text-uppercase py-3 px-4">Status Kehadiran</p>
                </div>
                <div class="col-md-6 text-right">
                    <h5 class="py-2">Senin, 08 Januari 2024</h5>
                </div>
            </div>
        </div>
        <div class="container border-bottom border-black py-4">
            <h4 class="text-uppercase"><b>Letda Laut / Kh / 26266/P</b></h4>
            <p class="text-uppercase h5">PASET</p>
            
            <div class="container-fluid row mt-4">
                <div class="col-md-2 py-2">
                    <p class="m-0 p-0">Jam Masuk :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">00:00:00</p>
                </div>
                <div class="col-md-2 py-2">
                    <p class="m-0 p-0 ">Jam Pulang :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">00:00:00</p>
                </div>
            </div>
            <div class="container-fluid row mt-2">
                <div class="col-md-2">
                    <p class="m-0 p-0 py-2">Keterangan :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">-</p>
                </div>
            </div>
            <div class="row justify-content-end">
                <a href="" class="btn btn-primary">Ubah Data Presensi <li style="font-size:10pt" class="ml-1 fa-solid fa-pencil"></li></a>
            </div>
            
        </div>
        <div class="container border-bottom border-black py-4">
            
            <h4 class="text-uppercase mt-4"><b>riwayat absensi personil minggu ini</b></h4>
            <div class="container-fluid mt-4 p-0">
                <div class="container-fluid">
                    <table class="table ">
                        <thead class="bg-bluedark rounded-top text-white" style="text-transform: uppercase">
                            <tr>
                                <th width="5%">No</th>
                                <th width="20%">Nama Lengkap</th>
                                <th width="15%">tanggal absensi</th>
                                <th width="15%">status kehadiran</th>
                                <th width="10%">jam masuk</th>
                                <th width="10%">jam pulang</th>
                                <th width="5%">Keterangan</th>
                                <th width="10%">aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="container" style="height: {{ count($riwayatAbsensiPersonil)<5 ? 'auto' : '400px' }}; overflow: auto;">
                    <table class="table" id="dataTablePersonil">
                        @if (count($riwayatAbsensiPersonil)!=0)
                        @foreach ($riwayatAbsensiPersonil as $datariwayatAbsensiPersonil)
                            <tbody class="tbody">
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $datariwayatAbsensiPersonil['nama_lengkap'] }}</td>
                                    <td>{{ $datariwayatAbsensiPersonil['tanggal_absensi'] }}</td>
                                    <td class="text-center">
                                        @foreach ($statusKehadiran as $item)
                                        @if ($datariwayatAbsensiPersonil['status_kehadiran'] == $item)
                                        <div class="m-1 py-1 row justify-content-around align-items-center rounded border {{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                            <p class="px-0  m-0" style="">{{ $datariwayatAbsensiPersonil['status_kehadiran']}}</p>
                                            <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                        </div>
                                        @else
                                        
                                        @endif
                                        @endforeach    
                                    </td>
                                    <td>{{ $datariwayatAbsensiPersonil['jam_masuk'] }}</td>
                                    <td>{{ $datariwayatAbsensiPersonil['jam_pulang'] }}</td>
                                    <td>{{ $datariwayatAbsensiPersonil['keterangan'] }}</td>
                                    <td>
                                        <a href="{{ route('admin.absensi.show', ['tanggal_absensi' => $datariwayatAbsensiPersonil['tanggal_absensi'], 'idAnggota' => $loop->iteration ]) }}" class="btn btn-outline-primary">
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
                    <!-- Tambahkan pesan jika hasil pencarian kosong -->
                    <div id="emptyMessage" style="display: none;">
                        <p>Data yang dicari kosong</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection