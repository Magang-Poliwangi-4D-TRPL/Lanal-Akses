@extends('layout.admin.app')

@section('title-page', 'Admin | Detail Surat Cuti')

@section('content')
<style>
    .image-profile{
        width: 8rem
    }
</style>

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
                <div class="col-md-6 text-right">
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
        
                    <!-- Tampilkan tombol dengan class yang sesuai -->
                    <div class="btn btn-lg {{ $statusClass }}">
                        {{ $suratPengajuan->responCuti->status_palaksa }}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container-fluid mt-4 p-0 border-bottom">
            <h4 class="h4">Profil Anggota</h4>
            @empty($suratPengajuan->dataCutiPersonel->id)
            <div class="row justify-content-start">
                <div class="col-md-2 ">
                    @empty($suratPengajuan->dataCutiPegawai->pegawai->image_url)
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">
                        
                    @else
                        <img src="{{ asset($suratPengajuan->dataCutiPegawai->pegawai->image_url) }}" alt="Profil {{ $suratPengajuan->dataCutiPegawai->pegawai->nama_pegawai }}" border="0" height="auto" class="rounded image-profile">
                    @endempty
                </div>
                <div class="col-md-8 align-item-start ">
                    <h4><b>{{ $suratPengajuan->dataCutiPegawai->pegawai->nama_pegawai }}</b></h4>
                    <p class="text-secondary">{{ $suratPengajuan->dataCutiPegawai->pegawai->nip }}</p>
                    <a class="btn btn-sm btn-light" href="{{ route('admin.pegawai.show', $suratPengajuan->dataCutiPegawai->pegawai->nip) }}" target="_blank" rel="noopener noreferrer">Lihat Profil Anggota</a>
                </div>
            </div>
            @else    
            <div class="row justify-content-start">
                <div class="col-md-2 ">
                    @empty($suratPengajuan->dataCutiPersonel->personil->image_url)
                        <img src="{{  URL::asset('images/admin/default-profile.jpg') }}" alt="default-profile" border="0" height="auto" class="rounded-circle image-profile">
                        
                    @else
                        <img src="{{ asset($suratPengajuan->dataCutiPersonel->personil->image_url) }}" alt="Profil {{ $suratPengajuan->dataCutiPersonel->personil->nama_lengkap }}" border="0" height="auto" class="rounded image-profile">
                    @endempty
                </div>
                <div class="col-md-8 align-item-start ">
                    <h4><b>{{ $suratPengajuan->dataCutiPersonel->personil->nama_lengkap }}</b></h4>
                    <p class="text-secondary">{{ $suratPengajuan->dataCutiPersonel->personil->nrp }}</p>
                    <a class="btn btn-sm btn-light" href="{{ route('admin.personil.show', $suratPengajuan->dataCutiPersonel->personil->nrp) }}" target="_blank" rel="noopener noreferrer">Lihat Profil Anggota</a>
                </div>
            </div>
            @endempty
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
                    <p class="border border-primary p-2 mt-2 rounded">{{ $suratPengajuan->cuti->nama_cuti  }}</p>
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
        @if ($suratPengajuan->responCuti->status_palaksa !== 'Menunggu Persetujuan' )
            <p class="mt-3">Surat Pengajuan ini telah <span class="p-2 rounded {{ $statusClass }} text-center">{{ $suratPengajuan->responCuti->status_palaksa }}</span> oleh anda.</p>
        
        @elseif($suratPengajuan->responCuti->status_atasan === 'Menunggu Persetujuann')
        <p class="mt-3">Surat Pengajuan ini belum disetujui oleh kepala satuan kerja. Mohon tunggu hingga surat ini disetujui</p>

        @else
             
        <div class="container py-4">
            <form method="POST" action="{{ route('admin.surat-cuti.palaksa.createRespon', $suratPengajuan->id) }}">
                @csrf
                <div class="form-group">
                    <label for="status_palaksa">Respon Anda</label>
                    <select class="form-control @error('status_palaksa') is-invalid @enderror" id="status_palaksa" name="status_palaksa" required>
                        <option value="">Pilih Respon Anda</option>
                        <option value="Disetujui" {{ old('status_palaksa') == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ old('status_palaksa') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status_palaksa')
                    <div class="alert alert-danger" role="alert">
                        <p class="p-0 m-0">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="keterangan_palaksa">Keterangan</label>
                    <input type="text" class="form-control @error('keterangan_palaksa') is-invalid @enderror" value="{{ old('keterangan_palaksa') }}" id="keterangan_palaksa" name="keterangan_palaksa" placeholder="Masukkan keterangan anda (tidak wajib)">
                    @error('keterangan_palaksa')
                    <div class="alert alert-danger" role="alert">
                        <p class="p-0 m-0">{{ $message }}</p>
                    </div>
                    @enderror
                </div>

                
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <a href="{{ url()->previous() }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-primary">Kirim Respon <i class="bi bi-check-circle"></i></button>
                    </div>
                </div>
            </form>
        </div>
        @endif

    </div>
</div>
@endsection