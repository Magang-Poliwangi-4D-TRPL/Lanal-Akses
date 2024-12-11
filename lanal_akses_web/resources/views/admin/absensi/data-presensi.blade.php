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
    <h4 class="text-black my-4 text-center" style="text-transform: uppercase">data presensi hari ini</h4>
    <div class="container-fluid bg-white border rounded p-4 mt-4">
        <div class="container p-4 border-bottom border-black">
            <h6>Keterangan :</h6>
            <div class="container row justify-content-arround align-item-center">
                    @foreach ($statusKehadiran as $item)
                    <div class="col-md-6">
                        <div class="row container-fluid justify-content-between">
    
                            <div class="my-1 py-1 col-md-4 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$item] }}">
                                <p class="px-0  m-0" style="">{{ $item}}</p>
                                <i class="fa-solid fa-{{ $statusKehadiranIcon[$item] }} {{ $iconColor[$item] }} " style="font-size:10pt"></i>
                            </div>
                            <div class="col-md-8">
                                <p>: presensi berarti "{{ $item }}"</p>
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
            </div>
        </div>
        <div class="container mt-4 row">
            <div class="col-md-6">
                <a href="{{ route('admin.absensi.rekap-data-kemarin') }}" class="btn btn-danger">Perbarui status kehadiran data kemarin <i class="fa-solid fa-gear"></i></a>
                <p class="mt-2">Tombol ini berfungsi untuk memperbarui data status kehadiran kemarin yang sebelumnya "Belum Absen" menjadi "Tidak Hadir"</p>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.absensi.hasilkan-data-absensi-besok') }}" class="btn btn-info">Hasilkan data absensi untuk besok <i class="fa-solid fa-file"></i></a>
                <p class="mt-2">Tombol ini berfungsi untuk membuat data absensi di hari besok supaya personel dan pegawai dapat melakukan absensi</p>
            </div>
        </div>
    </div>
    {{-- DATA PRESENSI PERSONEL START  --}}
    <div class="container-fluid bg-white border rounded p-4 mt-4 " id="data-presensi-personel" >
        <div class="row justify-content-between"> 
            <div class="col-lg-4">
                <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Personel</h6>
                <h6 class="text-black" style="text-transform: uppercase">{{ \Carbon\Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</h6>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <div  class="form-inline row container-fluid">
                <input class="form-control col-lg-10 col-md-8" id="searchPersonil" type="search" name="qPersonil" placeholder="Search" aria-label="Cari berdasarkan nama" value="{{ request('qPersonil') }}"> 
                <button disabled="true" class="btn text-white bg-bluedark my-2" type="submit"><i class="fa-solid fa-search"></i></button>
                </div>
            </div>
            <div class="col-lg-2 d-flex py-2 justify-content-end align-item-center">
                <a href="{{ route('admin.absensi.filter') }}" class="btn btn-outline-secondary">
                    filter data <i class="fa-solid fa-sliders"></i>
                </a>
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
                                    <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$dataAbsensiPersonil->status_kehadiran] }}">
                                        <p class="px-0  m-0 " style="">{{ $dataAbsensiPersonil->status_kehadiran}}</p>
                                        <i class="fa-solid fa-{{ $statusKehadiranIcon[$dataAbsensiPersonil->status_kehadiran] }} {{ $iconColor[$dataAbsensiPersonil->status_kehadiran] }} " style="font-size:10pt"></i>
                                    </div>
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
        <div class="pagination">
            <div class="row container-fluid justify-content-end py-4">
                
                <div class="col-md-6 text-right">
                    <a target="_blank" href="{{ route('admin.absensi.cetak-presensi.harian', ['date' => $date]) }}" class="btn btn-primary">Cetak Data Hari ini <i class="fa-solid fa-print"></i></a>

                </div>
            </div>
        </div>
    </div>

    {{-- DATA PRESENSI PEGAWAI START  --}}
    <div class="container-fluid bg-white border rounded p-4 mt-4 " id="data-presensi-pegawai" >
        <div class="row justify-content-between"> 
            <div class="col-lg-4">
                <h6 class="text-black" style="text-transform: uppercase">DATA Presensi Pegawai</h6>
                <h6 class="text-black" style="text-transform: uppercase">{{ \Carbon\Carbon::parse($date)->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</h6>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <div  class="form-inline row container-fluid">
                <input class="form-control col-lg-10 col-md-8" id="searchPegawai" type="search" name="qPegawai" placeholder="Search" aria-label="Cari berdasarkan nama" value="{{ request('qPegawai') }}"> 
                <button disabled="true" class="btn text-white bg-bluedark my-2" type="submit"><i class="fa-solid fa-search"></i></button>
                </div>
            </div>
            <div class="col-lg-2 d-flex py-2 justify-content-end align-item-center">
                <a href="{{ route('admin.absensi.filter') }}" class="btn btn-outline-secondary">
                    filter data <i class="fa-solid fa-sliders"></i>
                </a>
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
                <table class="table" id="dataTablePegawai">
                    @if (count($absensiPegawai)!=0)
                    @foreach ($absensiPegawai as $dataAbsensiPegawai)
                        <tbody class="tbody">
                            <tr>
                                <td width="5%">{{ $loop->iteration }}</td>
                                <td width="10%">{{ $dataAbsensiPegawai->pegawai->nama_pegawai }}</td>
                                <td width="15%">{{ $dataAbsensiPegawai->pegawai->nip }}</td>
                                <td width="10%">{{ $dataAbsensiPegawai->tanggal_kehadiran }}</td>
                                <td width="15%" class="text-center">
                                    <div class="m-1 py-1 row justify-content-around align-items-center rounded border border-{{ $bgStatusKehadiran[$dataAbsensiPegawai->status_kehadiran] }}">
                                        <p class="px-0  m-0" style="">{{ $dataAbsensiPegawai->status_kehadiran}}</p>
                                        <i class="fa-solid fa-{{ $statusKehadiranIcon[$dataAbsensiPegawai->status_kehadiran] }} {{ $iconColor[$dataAbsensiPegawai->status_kehadiran] }} " style="font-size:10pt"></i>
                                    </div>
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
                <div id="emptyMessagePegawai" style="display: none;">
                    <p>Data yang dicari kosong</p>
                </div>
            </div>
                
        </div>
        <div class="pagination">
            <div class="row container-fluid justify-content-end py-4">
                <div class="col-md-6 text-right">
                    <a target="_blank" href="{{ route('admin.absensi.cetak-presensi.harian', ['date' => $date]) }}" class="btn btn-primary">Cetak Data Hari ini <i class="fa-solid fa-print"></i></a>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Fungsi untuk melakukan pencarian data presensi personil
function cariDataPersonil() {
    var input, filter, table, tr, td, i, txtValue, searchResult;
    input = document.getElementById("searchPersonil");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTablePersonil");
    tr = table.getElementsByTagName("tr");
    searchResult = false; // Menandakan apakah ada hasil pencarian atau tidak

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Ganti angka dengan indeks kolom yang ingin Anda cari (dimulai dari 0)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                searchResult = true;
            } else {
                tr[i].style.display = "none";
            }
        }
    }

    // Menampilkan pesan jika hasil pencarian kosong
    var emptyMessage = document.getElementById("emptyMessagePersonil");
    if (!searchResult) {
        emptyMessage.style.display = "block";
    } else {
        emptyMessage.style.display = "none";
    }
}
//     // Fungsi untuk melakukan pencarian data presensi pegawai
//     function cariDataPegawai() {
//         var input, filter, table, tr, td, i, txtValue, searchResult;
//         input = document.getElementById("searchPegawai");
//         filter = input.value.toUpperCase();
//         table = document.getElementById("dataTablePegawai");
//         tr = table.getElementsByTagName("tr");
//         searchResult = false; // Menandakan apakah ada hasil pencarian atau tidak

//         for (i = 0; i <script tr.length; i++) {
//             td = tr[i].getElementsByTagName("td")[1]; // Ganti angka dengan indeks kolom yang ingin Anda cari (dimulai dari 0)
//             if (td) {
//                 txtValue = td.textContent || td.innerText;
//                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
//                     tr[i].style.display = "";
//                     searchResult = true;
//                 } else {
//                     tr[i].style.display = "none";
//                 }
//             }
//         }

//         // Menampilkan pesan jika hasil pencarian kosong
//         var emptyMessage = document.getElementById("emptyMessagePegawai");
//         if (!searchResult) {
//             emptyMessage.style.display = "block";
//         } else {
//             emptyMessage.style.display = "none";
//         }
// }

    // Mendengarkan perubahan pada input pencarian
    document.getElementById("searchPersonil").addEventListener("keyup", cariDataPersonil);
    document.getElementById("searchPegawai").addEventListener("keyup", cariDataPegawai);
</script>


@endsection