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
            <div class="row">
                <div class="col-md-6">
    
                    <h5 class="p-0 m-0 text-uppercase"> Pengajuan perizinan berlangsung</h5>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('personil.pengajuan-cuti.create') }}" class="btn btn-primary bg-darkGreen">Ajukan Cuti <span><iconify-icon class="ml-2" icon="material-symbols:add-box-outline" width="16"></iconify-icon></span> </a>
                </div>
            </div>
            <div class="row mt-3 py-3">
                @empty ($pengajuan_saat_ini->alasan_cuti)
                    <div class="col-md-8 rounded bg-light p-4">  
                        <p class="my-auto">Belum ada pengajuan saat ini</p>
                    </div>
                @else
                    <div class="col-md-8 rounded bg-light p-4"> 
                        <div class="row">
                            <div class="col-md-6 p-0 my-auto">
                                <h4 class="text-uppercase">CUTI {{ $pengajuan_saat_ini->jenis_cuti }}</h4>
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
                        <div class="col-md-4 text-right my-auto"><button href="" class="btn btn-success"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</button></div>
                        
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
                                    <h4 class="text-uppercase">CUTI {{ $pengajuan->jenis_cuti }}</h4>
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
                            <div class="col-md-4 text-right my-auto"><button href="" class="btn btn-success"><span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span> Cetak Surat Cuti</button></div>
                            
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
        
        {{-- <div class="card bg-white">
            <div class="card-body p-4">
                @foreach ($dataCuti as $cuti)
                    <div class="mb-3">
                        <h6 class="text-uppercase">{{ $cuti->nama_cuti }}</h6>
                        <div class="mb-2">
                            <span class="badge badge-info">Batas: {{ $cuti->jumlah_hari_cuti }} hari</span>
                            <span class="badge badge-warning">Digunakan: {{ $cuti->total_hari_diambil }} hari</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            @php
                                $percentage = ($cuti->jumlah_hari_cuti > 0) ? ($cuti->total_hari_diambil / $cuti->jumlah_hari_cuti) * 100 : 0;
                            @endphp
                            <div class="progress-bar 
                                @if($percentage < 50) bg-success 
                                @elseif($percentage < 75) bg-warning 
                                @else bg-danger @endif"
                                role="progressbar" 
                                style="width: {{ $percentage }}%;" 
                                aria-valuenow="{{ $percentage }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100"></div>
                        </div>
                        <p class="mt-2">Sisa Hari: <strong>{{ $cuti->sisa_hari_cuti }}</strong> hari</p>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div> --}}
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