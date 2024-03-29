@extends('layout.admin.app')

@section('title-page', 'Admin | Index Presensi'. $date)

@section('content')
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="container py-4 row justify-content-between">
                <div class="col-md-2 d-flex justify-content-end">
                    <a href="{{ route('admin.absensi.filter') }}" class="btn btn-light btn-lg"><li style="font-size:10pt" class="mr-1 fa-solid fa-arrow-left"></li> Kembali</a>
                </div>
                <div class="col-md-8 row align-item-center justify-content-center">
                    <h3 class="mt-1">Data Presensi {{ \Carbon\Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</h3>
                </div>
                <div class="col-md-2 d-flex justify-content-end">
                    <a href="{{ route('admin.absensi.cetak-presensi.harian', ['date' => $date]) }}" class="btn btn-primary btn-lg bg-bluedark">Cetak Data Presensi <li style="font-size:10pt" class="mr-1 fa-solid fa-print"></li></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        {{-- DATA PRESENSI PERSONEL START  --}}
        <div class="container-fluid bg-white border rounded p-4 mt-4 " id="data-presensi-personel" >
            <div class="row justify-content-between"> 
                <div class="col-lg-4">
                    <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Personel</h6>
                    <h6 class="text-black" style="text-transform: uppercase">{{ $date }}</h6>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div  class="form-inline row container-fluid">
                      <input class="form-control col-lg-10 col-md-8" id="searchPersonil" type="search" name="qPersonil" placeholder="Search" aria-label="Cari berdasarkan nama" value="{{ request('qPersonil') }}"> 
                      <button disabled="true" class="btn text-white bg-bluedark my-2" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4 p-0">
                <div class="container-fluid">
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
                    </table>
                </div>
                <div class="container" style="height: {{ count($absensiPersonil)<10 ? 'auto' : '600px' }}; overflow: auto;">
                    <table class="table" id="dataTablePersonil">
                        @if (count($absensiPersonil)!=0)
                        @foreach ($absensiPersonil as $dataAbsensiPersonil)
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
                                    <td width="10%">
                                        <a href="{{ route('admin.absensi.show', ['tanggal_absensi' => $dataAbsensiPersonil->tanggal_kehadiran, 'idAnggota' => $dataAbsensiPersonil->personil->id, 'status_anggota' => 'personel' ]) }}" class="btn btn-outline-primary">
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
                    <div id="emptyMessagePersonil" style="display: none;">
                        <p>Data yang dicari kosong</p>
                    </div>
                </div>
                    
            </div>
        </div>


        {{-- DATA PRESENSI PEGAWAI START  --}}
        <div class="container-fluid bg-white border rounded p-4 mt-4 " id="data-presensi-pegawai" >
            <div class="container row justify-content-between"> 
                <div class="col-lg-4">
                    <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Pegawai</h6>
                    <h6 class="text-black" style="text-transform: uppercase">{{ $date }}</h6>
                </div>
                <div class="col-lg-6 d-flex justify-content-end">
                    <div  class="form-inline row container-fluid">
                    <input class="form-control col-lg-10 col-md-8" id="searchPegawai" type="search" name="qPegawai" placeholder="Search" aria-label="Cari berdasarkan nama" value="{{ request('qPegawai') }}"> 
                    <button disabled="true" class="btn text-white bg-bluedark my-2" type="submit"><i class="fa-solid fa-search"></i></button>
                    </div>
                </div>
            </div>

            <div class="container-fluid mt-4 p-0">
                <div class="container-fluid">
                    <table class="table ">
                        <thead class="bg-bluedark rounded-top text-white" style="text-transform: uppercase">
                            <tr>
                                <th width="5%">No</th>
                                <th width="10%">Nama Lengkap</th>
                                <th width="15%">NIP</th>
                                <th width="10%">tanggal absensi</th>
                                <th width="15%">status kehadiran</th>
                                <th width="10%">jam masuk</th>
                                <th width="10%">jam pulang</th>
                                <th width="10%">aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="container" style="height: {{ count($absensiPegawai)<10 ? 'auto' : '600px' }}; overflow: auto;">
                    <table class="table" id="dataTablePersonil">
                        @if (count($absensiPegawai)!=0)
                        @foreach ($absensiPegawai as $dataAbsensiPegawai)
                            <tbody class="tbody">
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    <td width="10%">{{ $dataAbsensiPegawai->pegawai->nama_pegawai }}</td>
                                    <td width="15%">{{ $dataAbsensiPegawai->pegawai->nip }}</td>
                                    <td width="10%">{{ $dataAbsensiPegawai->tanggal_kehadiran }}</td>
                                    <td width="15%" class="text-center">
                                        @foreach ($statusKehadiran as $item)
                                            @if ($dataAbsensiPegawai->status_kehadiran == $item)
                                            <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                                <p class="px-0  m-0" style="">{{ $dataAbsensiPegawai->status_kehadiran}}</p>
                                                <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                            </div>
                                            @else
                                                
                                            @endif
                                        @endforeach    
                                    </td>
                                    <td width="10%">{{ $dataAbsensiPegawai->jam_masuk == null? '-' : $dataAbsensiPegawai->jam_masuk }}</td>
                                    <td width="10%">{{ $dataAbsensiPegawai->jam_pulang == null? '-' : $dataAbsensiPegawai->jam_pulang }}</td>
                                    <td width="10%">
                                        <a href="{{ route('admin.absensi.show', ['tanggal_absensi' => $dataAbsensiPegawai->tanggal_kehadiran, 'idAnggota' => $dataAbsensiPegawai->pegawai->id, 'status_anggota' => 'pegawai' ]) }}" class="btn btn-outline-primary">
                                            lihat <li style="font-size:10pt" class="ml-1 fa-solid fa-eye"></li>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach    
                        @else
                            <tbody>
                                  <td colspan="8">Belum ada data absensi pegawai hari ini</td>  
                            </tbody>
                        @endif
                    </table>
                    <!-- Tambahkan pesan jika hasil pencarian kosong -->
                    <div id="emptyMessagePegawau" style="display: none;">
                        <p>Data yang dicari kosong</p>
                    </div>
                </div>
                    
            </div>
        </div>

    </div>
@endsection