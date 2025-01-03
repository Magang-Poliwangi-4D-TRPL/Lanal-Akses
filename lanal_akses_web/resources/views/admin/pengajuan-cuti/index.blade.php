@extends('layout.admin.app')

@section('title-page', 'Admin | Data Surat Cuti')

@section('content')
<div class="container ">
    <div class="container-fluid bg-white border rounded p-4 mt-4 ">
        {{-- pop up message --}}
    @if (Session::has('alert'))
        <div class="alert alert-danger">
            {{ Session::get('alert') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }}
        </div>
    @endif
    <script>
        // Hapus alert setelah 5 detik (5000ms)
        setTimeout(function() {
            let alert = document.querySelector('.alert');
            if (alert) {
                alert.style.transition = "opacity 0.3s ease-out";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 00); // Hapus dari DOM setelah transisi selesai
            }
        }, 5000); // Ganti 5000 dengan waktu yang diinginkan dalam milidetik
    </script>
        <div class="row p-4 justify-content-between align-item-center">
            <div class="col-md-6 py-auto">
                <h4 class="h4 text-capitalize">Tambah Jenis Cuti</h4>
            </div>
            <div class="col-md-6 py-auto text-right">
                @if(auth()->user()->canany(['can access all']))
                {{-- {{ route('admin.pegawai.create') }} --}}
                <a href="{{ route('admin.cuti.create') }}" class="btn btn-primary text-capitalize">Tambah Data Jenis Cuti <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg></a>
                @endif
            </div>
        </div>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Cuti</th>
                        <th>Kode Cuti</th>
                        <th>Batas Hari Cuti</th>
                        {{-- <th>Keterangan</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisCuti as $cuti)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $cuti->nama_cuti }}</td>
                            <td>{{ $cuti->kode_cuti }}</td>
                            <td>{{ $cuti->jumlah_hari_cuti }}</td>
                            {{-- <td >{{ $cuti->deskripsi}}</p></td> --}}
                            <td>
                                <!-- Tombol untuk memicu modal -->
                                <button 
                                    class="btn btn-info" 
                                    data-toggle="modal" 
                                    data-target="#detailModal{{ $cuti->id }}">
                                    Lihat Info <i class="bi bi-info-circle"></i>
                                </button>
    
                                <!-- Modal Detail Jenis Cuti -->
                                <div 
                                    class="modal fade" 
                                    id="detailModal{{ $cuti->id }}" 
                                    tabindex="-1" 
                                    aria-labelledby="detailModalLabel{{ $cuti->id }}" 
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $cuti->id }}">Detail Jenis Cuti</h5>
                                                <button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close"><i class="bi bi-x-circle text-white"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama Cuti:</strong> {{ $cuti->nama_cuti }}</p>
                                                <p><strong>Kode Cuti:</strong> {{ $cuti->kode_cuti }}</p>
                                                <p><strong>Batas Hari Cuti:</strong> {{ $cuti->jumlah_hari_cuti }}</p>
                                                <p><strong>Deskripsi:</strong> {{ $cuti->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                                            </div>
                                            <div class="modal-footer row justify-content-around">
                                                <form action="{{ route('admin.cuti.delete',['id' => 3]) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus <i class="bi bi-trash"></i></button>
                                                </form>
                                                <a href="{{ route('admin.cuti.edit',['id' => $cuti->id] ) }}" class="btn btn-primary">Edit <i class="bi bi-pencil-square"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Data jenis cuti belum dibuat, silahkan buat terlebih dahulu!.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h4 class="text-black my-4 text-center" style="text-transform: uppercase">Pengajuan Cuti Menunggu Persetujuan</h4>
        {{-- DATA SURAT PENGAJUAN START  --}}
        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="container-fluid mt-4 p-0">
                <div class="row p-4 justify-content-between align-item-center">
                    <div class="col-md-6 py-auto">
                        <h4 class="h4 text-capitalize">Data Pengajuan Cuti Menunggu Persetujuan</h4>
                    </div>
                    <div class="col-md-6 py-auto text-right">
                        @if(auth()->user()->canany(['can access all']))
                        {{-- {{ route('admin.pegawai.create') }} --}}
                        <a href="{{ route('admin.surat-cuti.create') }}" class="btn btn-primary text-capitalize">Tambah Pengajuan Cuti <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                          </svg></a>
                        @endif
                    </div>
                </div>
                <div class="container-fluid">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anggota</th>
                                <th>No. Identitas</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuanMenunggu as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @empty($pengajuan->dataCutiPersonel->personil->nama_lengkap)
                                        {{ $pengajuan->dataCutiPegawai->pegawai->nama_pegawai }}
                                        @else
                                        {{ $pengajuan->dataCutiPersonel->personil->nama_lengkap  }}
                                        @endempty
                                    </td>
                                    <td>
                                        @empty($pengajuan->dataCutiPersonel->personil->nrp)
                                        {{ $pengajuan->dataCutiPegawai->pegawai->nip }}
                                        @else
                                        {{ $pengajuan->dataCutiPersonel->personil->nrp  }}
                                        @endempty
                                    </td>
                                    <td>{{ $pengajuan->tanggal_mulai_cuti }}</td>
                                    <td>{{ $pengajuan->tanggal_selesai_cuti }}</td>

                                    @php
                                    // Tentukan class berdasarkan status surat
                                    $statusClass = '';
                                    switch ($pengajuan->status) {
                                        case 'Disetujui Atasan':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Palaksa':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Sekretaris':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Komandan':
                                            $statusClass = 'bg-success text-white';
                                            break;
                                        case 'Menunggu Persetujuan':
                                            $statusClass = 'bg-warning';
                                            break;
                                        case 'Ditolak':
                                            $statusClass = 'bg-danger text-white';
                                            break;
                                        default:
                                            $statusClass = 'bg-secondary text-white'; // Default jika status tidak dikenal
                                    }
                                    @endphp                                     
                                    <td ><p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan->status}}</p></td>
                                    <td>
                                    <td>
                                        <!-- Contoh aksi untuk detail pengajuan cuti -->
                                        {{-- {{ route('pengajuan_cuti.show', $pengajuan->id) }} --}}
                                        <a href="{{ route('admin.surat-cuti.show', $pengajuan->id) }}" class="btn btn-primary">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada pengajuan cuti yang menunggu persetujuan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <h4 class="text-black my-4 text-center" style="text-transform: uppercase">Pengajuan Cuti Selesai</h4>
        {{-- DATA SURAT CUTI SELESAI START  --}}
        <div class="container-fluid bg-white border rounded p-4 mt-4 ">
            <div class="container-fluid mt-4 p-0">
                <div class="container-fluid">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Anggota</th>
                                <th>No. Identitas</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Status Komandan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pengajuanSelesai as $pengajuan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @empty($pengajuan->dataCutiPersonel->personil->nama_lengkap)
                                        {{ $pengajuan->dataCutiPegawai->pegawai->nama_pegawai }}
                                        @else
                                        {{ $pengajuan->dataCutiPersonel->personil->nama_lengkap  }}
                                        @endempty
                                    </td>
                                    <td>
                                        @empty($pengajuan->dataCutiPersonel->personil->nrp)
                                        {{ $pengajuan->dataCutiPegawai->pegawai->nip }}
                                        @else
                                        {{ $pengajuan->dataCutiPersonel->personil->nrp  }}
                                        @endempty
                                    </td>
                                    <td>{{ $pengajuan->tanggal_mulai_cuti }}</td>
                                    <td>{{ $pengajuan->tanggal_selesai_cuti }}</td>

                                    @php
                                    // Tentukan class berdasarkan status surat
                                    $statusClass = '';
                                    switch ($pengajuan->status) {
                                        case 'Disetujui Atasan':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Palaksa':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Sekretaris':
                                            $statusClass = 'bg-info text-white';
                                            break;
                                        case 'Disetujui Komandan':
                                            $statusClass = 'bg-success text-white';
                                            break;
                                        case 'Menunggu Persetujuan':
                                            $statusClass = 'bg-warning';
                                            break;
                                        case 'Ditolak':
                                            $statusClass = 'bg-danger text-white';
                                            break;
                                        default:
                                            $statusClass = 'bg-secondary text-white'; // Default jika status tidak dikenal
                                    }
                                    @endphp 

                                    <td ><p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan->status}}</p></td>
                                    <td>
                                    <td>
                                        <!-- Contoh aksi untuk detail pengajuan cuti -->
                                        {{-- {{ route('pengajuan_cuti.show', $pengajuan->id) }} --}}
                                        <a href="{{ route('admin.surat-cuti.show', $pengajuan->id) }}" class="btn btn-primary">Lihat Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada pengajuan cuti yang selesai.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection