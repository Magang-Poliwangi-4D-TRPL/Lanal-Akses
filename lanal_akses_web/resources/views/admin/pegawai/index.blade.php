@extends('layout.admin.app')

@section('title-page', 'Admin | Data Pegawai')

@section('content')
    <style>
        .active {
            text-decoration: underline;
            color: #0D21A1!important;
        }
        .pagination a {
            color: gray;
        }
    </style>
    <div class="container">
        <h1 class="text-black my-4">Data Pegawai Negeri Sipil</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            <div class="d-flex justify-content-between my-3">
                <a class="text-decoration-none" href="{{ route('admin.pegawai.create') }}">
                    <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data PNS<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
                </a>
                <a class="text-decoration-none" href="{{ route('admin.pegawai.cetak-data-pegawai') }}">
                    <button class="btn btn-blue btn-md text-white bg-bluedark">Cetak Data PNS<span><iconify-icon class="ml-2" icon="material-symbols:print-outline" width="16"></iconify-icon></span></button>
                </a>
            </div>
            <table class="table thead-light">
                <thead>
                    <tr class="bg-bluedark text-white text-bold">
                        <th scope="col" width="10%">No</th>
                        <th scope="col" width="15%">Nama Pegawai</th>
                        <th scope="col" width="20%">NIP</th>
                        <th scope="col" width="20%">Jabatan</th>
                        <th scope="col" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($pegawai->count() > 0)
                    @foreach ($pegawai as $data_pegawai)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data_pegawai->nama_pegawai }}</td>
                        <td>{{ $data_pegawai->nip }}</td>
                        <td>{{ $data_pegawai->jabatan }}</td>
                        <td>
                            @php
                                $nip = $data_pegawai->nip;
                                $nipGanti = str_replace(' ', '-', $nip);
                            @endphp
                            <a class="text-decoration-none" href="{{ route('admin.pegawai.show', $nipGanti) }}">
                                <button class="btn btn-blue btn-sm text-white bg-bluemain m-2">Lihat <span><iconify-icon icon="mdi:eye-outline"></iconify-icon></span></button>
                            </a>
                            <form action="{{ route('admin.pegawai.destroy', $nipGanti) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus <span><iconify-icon icon="mingcute:delete-line"></iconify-icon></span></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="5">Tidak ada data pegawai.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination">
                @if ($page > 1)
                    <a href="{{ route('admin.pegawai.index', ['page' => $page - 1]) }}" class="text-decoration-none mx-2 previous">&laquo; Sebelumnya</a>
                @endif
            
                @for ($i = $firstNav; $i <= $lastNav; $i++)
                    <a href="{{ route('admin.pegawai.index', ['page' => $i]) }}" class="text-decoration-none mx-2 {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            
                @if ($page < $totalPages)
                    <a href="{{ route('admin.pegawai.index', ['page' => $page + 1]) }}" class="text-decoration-none mx-2 next">Selanjutnya &raquo;</a>
                @endif
            </div>
        </div>
    </div>
@endsection
