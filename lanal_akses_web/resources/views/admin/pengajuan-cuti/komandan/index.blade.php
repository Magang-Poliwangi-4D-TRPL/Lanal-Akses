@extends('layout.admin.app')

@section('title-page', 'Admin | Data Surat Cuti')

@section('content')
<div class="container ">
    

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
                                        switch ($pengajuan->responCuti->status_komandan) {
                                            case 'Disetujui':
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

                                    <td ><p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan->responCuti->status_komandan }}</p></td>
                                    <td>
                                        <!-- Contoh aksi untuk detail pengajuan cuti -->
                                        {{-- {{ route('pengajuan_cuti.show', $pengajuan->id) }} --}}
                                        <a href="{{ route('admin.surat-cuti.komandan.show', $pengajuan->id) }}" class="btn btn-primary">Lihat Detail</a>
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
                                <th>Respon Anda</th>
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
                                        switch ($pengajuan->responCuti->status_komandan) {
                                            case 'Disetujui':
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
                                    <td ><p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan->responCuti->status_komandan }}</p></td>
                                    <td>
                                        <!-- Contoh aksi untuk detail pengajuan cuti -->
                                        {{-- {{ route('pengajuan_cuti.show', $pengajuan->id) }} --}}
                                        <a href="{{ route('admin.surat-cuti.komandan.show', $pengajuan->id) }}" class="btn btn-primary">Lihat Detail</a>
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