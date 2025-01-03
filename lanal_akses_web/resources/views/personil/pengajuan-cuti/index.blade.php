@extends('layout.personil.app')

@section('title-page', 'Personil | Dashboard')

@section('content')

<div class="row">

    <div class="col-md-8 container">
        <h2 class="text-black my-4 text-center" style="text-transform: uppercase">Data Riwayat Pengajuan Cuti</h2>
        <div class="container-fluid bg-white border rounded p-4 mt-4">
            {{-- pop up message --}}
        @if (Session::get('alert'))
            <div class="alert alert-danger">
                {{ Session::get('alert') }}
            </div>
        @endif
    
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
    
        @if (Session::get('warning'))
            <div class="alert alert-warning">
                {{ Session::get('warning') }}
            </div>
        @endif
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
            <div class="row">
                <div class="col-md-6">
    
                    <h5 class="p-0 m-0 text-uppercase"> Pengajuan perizinan berlangsung</h5>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('personil.pengajuan-cuti.create') }}" class="btn btn-primary bg-darkGreen">Ajukan Cuti <span><iconify-icon class="ml-2" icon="material-symbols:add-box-outline" width="16"></iconify-icon></span> </a>
                </div>
            </div>
            <div class="row mt-3 py-3">
                @empty ($pengajuan_saat_ini->id)
                    <div class="col-md-8 rounded bg-light p-4">  
                        <p class="my-auto">Belum ada pengajuan saat ini</p>
                    </div>
                @else
                    <div class="col-md-8 rounded bg-light p-4"> 
                        <div class="row">
                            <div class="col-md-6 p-0 my-auto">
                                <h4 class="text-uppercase">{{ $pengajuan_saat_ini->cuti->nama_cuti }}</h4>
                                <p class="text-secondary">{{ $pengajuan_saat_ini->tanggal_mulai_cuti ." s/d ". $pengajuan_saat_ini->tanggal_selesai_cuti }}</p>
                            </div>
                            <div class="col-md-4 text-center my-auto p-0">
                                @php
                                        // Tentukan class berdasarkan status surat
                                        $statusClass = '';
                                        switch ($pengajuan_saat_ini->status) {
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
                                        <p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan_saat_ini->status}}</p>    
                            </div>
                            <div class="col-md-2 my-auto text-right"><a href="{{ route('personil.pengajuan-cuti.detail', $pengajuan_saat_ini->id) }}" class="btn btn-sm btn-outline-primary">lihat detail</a> </div>
                        </div>
                    </div>
                    @empty ($pengajuan_saat_ini)
                        
                        @if ($pengajuan_saat_ini->responCuti->status_komandan == "Disetujui")
                        <div class="col-md-4 text-right my-auto"><button href="{{ route('personil.pengajuan-cuti.cetak-surat-cuti', ['id' => $pengajuan_saat_ini->id]) }}" class="btn btn-success" target="_blank"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</button></div>
                        
                        @else
                        <div class="col-md-4 text-right my-auto"><button disabled href="" class="btn btn-secondary"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</button></div>
                        
                        @endif
                    @endempty
                @endempty
                
                
            </div>
            
            <hr>
            <h5 class="p-0 m-0 text-uppercase"> Data Riwayat Pengajuan Cuti</h5>
            
            <div class="row mt-3 py-3">
                @if ($riwayat_pengajuan_cuti->count() == 0)
                <div class="col-md-8 rounded bg-light p-4">  
                    <p class="my-auto">Belum ada pengajuan saat ini</p>
                </div>
                @else
                @foreach ($riwayat_pengajuan_cuti as $pengajuan)
                        <div class="col-md-8 rounded bg-light p-4"> 
                            <div class="row">
                                <div class="col-md-6 p-0 my-auto">
                                    <h4 class="text-uppercase">{{ $pengajuan->cuti->nama_cuti }}</h4>
                                    <p class="text-secondary">{{ $pengajuan->tanggal_mulai_cuti ." s/d ". $pengajuan->tanggal_selesai_cuti }}</p>
                                </div>
                                <div class="col-md-4 text-center my-auto p-0">
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
                                            <p class="p-1 rounded {{ $statusClass }} text-center">{{ $pengajuan->status}}</p>    
                                </div>
                                <div class="col-md-2 my-auto text-right"><a href="{{ route('personil.pengajuan-cuti.detail', $pengajuan->id) }}" class="btn btn-sm btn-outline-primary">lihat detail</a> </div>
                            </div>
                        </div>
                        @if ($pengajuan->status != "Ditolak")
                            <div class="col-md-4 text-right my-auto"><a href="{{ route('personil.pengajuan-cuti.cetak-surat-cuti', ['id' => $pengajuan->id]) }}" class="btn btn-success" target="_blank"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</a></div>
                            
                            @else
                            <div class="col-md-4 text-right my-auto"><button disabled href="" class="btn btn-secondary"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</button></div>
                        
                        @endif
                        @endforeach
                        
                        @endif
            </div>
    
        </div>
    </div>
    <div class="col-md-4 container">
        <h3 class="text-black my-4 text-center" style="text-transform: uppercase">Informasi Sisa Cuti</h3>
        <table class="table border border-all">
            <thead>
                <tr class="bg-info text-white">
                    <th>Nama Cuti</th>
                    <th>Batas</th>
                    <th>Total Hari</th>
                    <th>Sisa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataCuti as $cuti)
                    <tr>
                        <td>{{ $cuti->nama_cuti }}</td>
                        <td>{{ $cuti->jumlah_hari_cuti }}</td>
                        <td>{{ $cuti->total_hari_diambil }}</td>
                        <td>{{ $cuti->sisa_hari_cuti }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
</div>
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

@endsection