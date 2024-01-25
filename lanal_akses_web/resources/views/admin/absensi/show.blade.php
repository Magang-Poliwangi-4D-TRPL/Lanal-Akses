@extends('layout.admin.app')

@section('title-page', 'Admin | Detail Presensi'. 'Suhendra Kurniawan')

@section('content')
    <div class="container-fluid bg-white">
        <div class="container">
            <div class="container py-4 row justify-content-between">
                <div class="col-md-6 row align-item-center justify-content-start">
                    <div class="mr-4">
                        @if ($detailPresensiAnggota->personil_id == null)
                            @empty($detailPresensiAnggota->pegawai->image_url)
                                <div class="rounded-circle image-profile" style="height: 50px; width: 50px; background-image: url({{ URL::asset('images/admin/default-profile.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            @else
                                <div class="rounded-circle image-profile" style="height: 50px; width: 50px; background-image: url({{ asset($detailPresensiAnggota->pegawai->image_url) }}); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            @endempty
                        @else
                            @empty($detailPresensiAnggota->personil->image_url)
                                <div class="rounded-circle image-profile" style="height: 50px; width: 50px; background-image: url({{ URL::asset('images/admin/default-profile.jpg') }}); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            @else
                                <div class="rounded-circle image-profile" style="height: 50px; width: 50px; background-image: url({{ asset($detailPresensiAnggota->personil->image_url) }}); background-position: center; background-repeat: no-repeat; background-size: cover;"></div>
                            @endempty
                        @endif
                    </div>
                    <h2 class="mt-1">{{ $detailPresensiAnggota->personil_id == null? $detailPresensiAnggota->pegawai->nama_pegawai : $detailPresensiAnggota->personil->nama_lengkap}}</h2>
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
                    @foreach ($statusKehadiran as $item)
                    @if ($item == $detailPresensiAnggota->status_kehadiran)
                        <p class="btn btn-{{ $bgStatusKehadiran[$loop->iteration-1] }} text-uppercase py-3 px-4">{{ $detailPresensiAnggota->status_kehadiran }}</p>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-6 text-right">
                    <h5 class="py-2">{{ \Carbon\Carbon::parse($detailPresensiAnggota->tanggal_kehadiran)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</h5>
                </div>
            </div>
        </div>
        <div class="container border-bottom border-black py-4">
            @if ($detailPresensiAnggota->personil_id == null)
                <h4 class="text-uppercase"><b>{{ $detailPresensiAnggota->pegawai->nip . '/' . $detailPresensiAnggota->pegawai->golongan }}</b></h4>
                <p class="text-uppercase h5">{{ $detailPresensiAnggota->pegawai->jabatan }}</p>
            @else 
                <h4 class="text-uppercase"><b>{{ $detailPresensiAnggota->personil->pangkat .' / '. $detailPresensiAnggota->personil->korps.' / '.$detailPresensiAnggota->personil->nrp }}</b></h4>
                <p class="text-uppercase h5">{{ $detailPresensiAnggota->personil->jabatan }}</p>
            @endif
            
            <div class="container-fluid row mt-4">
                <div class="col-md-2 py-2">
                    <p class="m-0 p-0">Jam Masuk :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">{{ $detailPresensiAnggota->jam_masuk == null? '-' : $detailPresensiAnggota->jam_masuk }}</p>
                </div>
                <div class="col-md-2 py-2">
                    <p class="m-0 p-0 ">Jam Pulang :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">{{ $detailPresensiAnggota->jam_pulang == null? '-' : $detailPresensiAnggota->jam_pulang }}</p>
                </div>
            </div>
            <div class="container-fluid row mt-2">
                <div class="col-md-2">
                    <p class="m-0 p-0 py-2">Keterangan :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    <p class="m-0 p-0">{{ $detailPresensiAnggota->keterangan == null? '-' : $detailPresensiAnggota->keterangan }}</p>
                </div>
                <div class="col-md-2">
                    <p class="m-0 p-0 py-2">Lokasi :</p>
                </div>
                <div class="col-md-4 m-0 py-2 rounded border border-primary">
                    @empty($detailPresensiAnggota->lokasi)
                    <p class="m-0 p-0">-</p>
                    @else
                    <a target="_blank" href="https://www.google.com/maps/place/{{ $detailPresensiAnggota->lokasi }}" class="btn btn-info">Lihat lokasi</a>
                    @endempty
                </div>
            </div>
            <div class="row mt-3 justify-content-end">
                <a href="{{ route('admin.absensi.edit', ['idKehadiran'=> $detailPresensiAnggota->id]) }}" class="btn btn-primary">Ubah Data Presensi <li style="font-size:10pt" class="ml-1 fa-solid fa-pencil"></li></a>
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
                                <th width="10%">Keterangan</th>
                                <th width="5%">aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="container" style="height: {{ count($riwayatPresensiAnggota)<5 ? 'auto' : '400px' }}; overflow: auto;">
                    <table class="table" id="dataTablePersonil">
                        @if (count($riwayatPresensiAnggota)!=0)
                        @foreach ($riwayatPresensiAnggota as $datariwayatPresensiAnggota)
                            <tbody class="tbody">
                                <tr>
                                    <td width="5%">{{ $loop->iteration }}</td>
                                    <td width="20%">{{ $datariwayatPresensiAnggota->personil_id == null? $datariwayatPresensiAnggota->pegawai->nama_pegawai : $datariwayatPresensiAnggota->personil->nama_lengkap }}</td>
                                    <td width="15%">{{ $datariwayatPresensiAnggota->tanggal_kehadiran }}</td>
                                    <td width="15%" class="text-center">
                                        @foreach ($statusKehadiran as $item)
                                        @if ($datariwayatPresensiAnggota->status_kehadiran == $item)
                                        <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$loop->iteration-1] }}">
                                            <p class="px-0  m-0" style="">{{ $item}}</p>
                                            <i class="fa-solid fa-{{ $statusKehadiranIcon[$loop->iteration-1] }} {{ $iconColor[$loop->iteration-1] }} " style="font-size:10pt"></i>
                                        </div>
                                        @else
                                        
                                        @endif
                                        @endforeach    
                                    </td>
                                    <td width="10%">{{ $datariwayatPresensiAnggota->jam_masuk == null? '-' : $datariwayatPresensiAnggota->jam_masuk }}</td>
                                    <td width="10%">{{ $datariwayatPresensiAnggota->jam_pulang == null? '-' : $datariwayatPresensiAnggota->jam_pulang}}</td>
                                    <td width="10%">{{ $datariwayatPresensiAnggota->keterangan == null? '-' : $datariwayatPresensiAnggota->keterangan }}</td>
                                    <td width="5%">
                                        <a href="{{ route('admin.absensi.show', ['tanggal_absensi' => $datariwayatPresensiAnggota->tanggal_kehadiran, 'idAnggota' => $datariwayatPresensiAnggota->personil_id == null? $datariwayatPresensiAnggota->pegawai_id : $datariwayatPresensiAnggota->personil_id, 'status_anggota' => $datariwayatPresensiAnggota->personil_id == null? 'pegawai' : 'personel' ]) }}" class="btn btn-outline-primary">
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