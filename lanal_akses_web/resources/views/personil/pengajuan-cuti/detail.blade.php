@extends('layout.personil.app')

@section('title-page', 'Personil | Dashboard')

@section('content')
<div class="container ">
    <div class="container-fluid bg-white border rounded p-4 mt-4 ">
        <div class="container-fluid p-0 border-bottom">
            <h1 class="h1 text-capitalize"><b>Detail Surat Cuti</b></h1>
            <div class="row py-3 align-items-center">
                <div class="col-md-6 align-items-start">
                    <h4 class="h4 text-capitalize text-secondary">
                        {{ !empty($suratPengajuan->nomor_surat) ? $suratPengajuan->nomor_surat : '_/_/_' }}
                    </h4>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    @php
                                    // Tentukan class berdasarkan status surat
                                    $statusClass = '';
                                    switch ($suratPengajuan->status) {
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
        
                    <!-- Tampilkan tombol dengan class yang sesuai -->
                    <div class="btn btn-lg {{ $statusClass }}">
                        {{ $suratPengajuan->status }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid mt-4 p-0 border-bottom">
            <h4 class="h4">Profil Anggota</h4>
            <div class="row justify-content-start">
                <div class="col-md-2 ">
                    @empty($suratPengajuan->personil->image_url)
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">
                        
                    @else
                        <img src="{{ asset($suratPengajuan->personil->image_url) }}" alt="Profil {{ $suratPengajuan->personil->nama_lengkap }}" border="0" height="auto" class="rounded image-profile">
                    @endempty
                </div>
                <div class="col-md-8 align-item-start ">
                    <h4><b>{{ $suratPengajuan->personil->nama_lengkap }}</b></h4>
                    <p class="text-secondary">{{ $suratPengajuan->personil->nrp }}</p>
                    <a class="btn btn-sm btn-light" href="{{ route('admin.personil.show', $suratPengajuan->personil->nrp) }}" target="_blank" rel="noopener noreferrer">Lihat Profil Anggota</a>
                </div>
            </div>
            <h5 class="h5 text-secondary mt-4">Detail Surat Pengajuan Cuti</h5>
            <div class="row mt-1">
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">tanggal mulai cuti <span><iconify-icon class="ml-2" icon="material-symbols:calendar-month-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->tanggal_mulai_cuti }}</p>
                </div>
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">tanggal selesai cuti <span><iconify-icon class="ml-2" icon="material-symbols:calendar-month-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->tanggal_selesai_cuti }}</p>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">nomor telepon saat cuti <span><iconify-icon class="ml-2" icon="material-symbols:phone-enabled-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->no_telepon }}</p>
                </div>
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">jenis cuti <span><iconify-icon class="ml-2" icon="material-symbols:unknown-document-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->jenis_cuti }}</p>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">alasan cuti <span><iconify-icon class="ml-2" icon="material-symbols:clinical-notes-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->alasan_cuti }}</p>
                </div>
                <div class="col-md-6">
                    <p class="p-0 m-0 text-secondary">alamat saat cuti <span><iconify-icon class="ml-2" icon="material-symbols:location-on-outline" width="16"></iconify-icon></span></p>
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->alamat_cuti }}</p>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-4 p-0 border-bottom">
            <h5 class="h5 text-secondary mt-4">Status Surat Pengajuan Cuti</h5>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-3">{{ $suratPengajuan->responCuti->atasan->nama_lengkap }}</h3>
                        <p class="small mb-0"><iconify-icon class="ml-2" icon="material-symbols:id-card-outline" width="16"></iconify-icon> <span class="mx-2">{{ $suratPengajuan->responCuti->atasan->nrp }}</span> | <strong>{{ $suratPengajuan->responCuti->atasan->jabatan }}</strong></p>

                    </div>
                    @php
                    // Tentukan class berdasarkan status surat
                    $statusClass = '';
                    switch ($suratPengajuan->responCuti->status_atasan) {
                        case 'Disetujui':
                            $statusClass = 'btn-success';
                            break;
                        case 'Menunggu Persetujuan':
                            $statusClass = 'btn-warning';
                            break;
                        case 'Ditolak':
                            $statusClass = 'btn-danger';
                            break;
                        default:
                            $statusClass = 'btn-secondary'; // Default jika status tidak dikenal
                        }
                    @endphp

                    <div class="col-md-8 text-right">
                        <button class="btn {{ $statusClass }}">
                            {{ $suratPengajuan->responCuti->status_atasan }}
                        </button>
                    </div>
                </div>

                <hr class="my-4">
                <p class="mb-0 text-uppercase">Keterangan Atasan <span><iconify-icon class="ml-2" icon="material-symbols:chat-info-outline" width="16"></iconify-icon></span> : {{ $suratPengajuan->responCuti->keterangan_atasan }}</p>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-3">{{ $suratPengajuan->responCuti->palaksa->nama_lengkap }}</h3>
                        <p class="small mb-0"><iconify-icon class="ml-2" icon="material-symbols:id-card-outline" width="16"></iconify-icon> <span class="mx-2">{{ $suratPengajuan->responCuti->palaksa->nrp }}</span> | <strong>{{ $suratPengajuan->responCuti->palaksa->jabatan }}</strong></p>

                    </div>
                    @php
                    // Tentukan class berdasarkan status surat
                    $statusClass = '';
                    switch ($suratPengajuan->responCuti->status_palaksa) {
                        case 'Disetujui':
                            $statusClass = 'btn-success';
                            break;
                        case 'Menunggu Persetujuan':
                            $statusClass = 'btn-warning';
                            break;
                        case 'Ditolak':
                            $statusClass = 'btn-danger';
                            break;
                        default:
                            $statusClass = 'btn-secondary'; // Default jika status tidak dikenal
                        }
                    @endphp

                    <div class="col-md-8 text-right">
                        <button class="btn {{ $statusClass }}">
                            {{ $suratPengajuan->responCuti->status_palaksa }}
                        </button>
                    </div>
                </div>

                <hr class="my-4">
                
                  <p class="mb-0 text-uppercase">Keterangan palaksa <span><iconify-icon class="ml-2" icon="material-symbols:chat-info-outline" width="16"></iconify-icon></span> : {{ $suratPengajuan->responCuti->keterangan_palaksa }}</p>

            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-3">{{ $suratPengajuan->responCuti->sekretaris->nama_lengkap }}</h3>
                        <p class="small mb-0"><iconify-icon class="ml-2" icon="material-symbols:id-card-outline" width="16"></iconify-icon> <span class="mx-2">{{ $suratPengajuan->responCuti->sekretaris->nrp }}</span> | <strong>{{ $suratPengajuan->responCuti->sekretaris->jabatan }}</strong></p>

                    </div>
                    @php
                    // Tentukan class berdasarkan status surat
                    $statusClass = '';
                    switch ($suratPengajuan->responCuti->status_sekretaris) {
                        case 'Disetujui':
                            $statusClass = 'btn-success';
                            break;
                        case 'Menunggu Persetujuan':
                            $statusClass = 'btn-warning';
                            break;
                        case 'Ditolak':
                            $statusClass = 'btn-danger';
                            break;
                        default:
                            $statusClass = 'btn-secondary'; // Default jika status tidak dikenal
                        }
                    @endphp

                    <div class="col-md-8 text-right">
                        <button class="btn {{ $statusClass }}">
                            {{ $suratPengajuan->responCuti->status_sekretaris }}
                        </button>
                    </div>
                </div>

                <hr class="my-4">
                
                  <p class="mb-0 text-uppercase">Keterangan sekretaris <span><iconify-icon class="ml-2" icon="material-symbols:chat-info-outline" width="16"></iconify-icon></span> : {{ $suratPengajuan->responCuti->keterangan_sekretaris }}</p>

            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="mb-3">{{ $suratPengajuan->responCuti->komandan->nama_lengkap }}</h3>
                        <p class="small mb-0"><iconify-icon class="ml-2" icon="material-symbols:id-card-outline" width="16"></iconify-icon> <span class="mx-2">{{ $suratPengajuan->responCuti->komandan->nrp }}</span> | <strong>{{ $suratPengajuan->responCuti->komandan->jabatan }}</strong></p>

                    </div>
                    @php
                    // Tentukan class berdasarkan status surat
                    $statusClass = '';
                    switch ($suratPengajuan->responCuti->status_komandan) {
                        case 'Disetujui':
                            $statusClass = 'btn-success';
                            break;
                        case 'Menunggu Persetujuan':
                            $statusClass = 'btn-warning';
                            break;
                        case 'Ditolak':
                            $statusClass = 'btn-danger';
                            break;
                        default:
                            $statusClass = 'btn-secondary'; // Default jika status tidak dikenal
                        }
                    @endphp

                    <div class="col-md-8 text-right">
                        <button class="btn {{ $statusClass }}">
                            {{ $suratPengajuan->responCuti->status_komandan }}
                        </button>
                    </div>
                </div>

                <hr class="my-4">
                
                  <p class="mb-0 text-uppercase">Keterangan komandan <span><iconify-icon class="ml-2" icon="material-symbols:chat-info-outline" width="16"></iconify-icon></span> : {{ $suratPengajuan->responCuti->keterangan_komandan }}</p>

            </div>
        </div>
    </div>
</div>
@endsection