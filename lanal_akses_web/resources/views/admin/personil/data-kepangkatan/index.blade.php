@extends('layout.admin.app')

@section('title-page', 'Personil | Data Kepangkatan')

@section('content')
<div class="container">
    <h1 class="text-black my-4">Data Kepangkatan {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            
            <a class="text-decoration-none" href="{{ route('admin.personil.data-kepangkatan.create', ['nrp' => $nrpGanti]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Kepangkatan Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="5%">no</th>
                    <th scope="col" width="15%">Pangkat</th>
                    <th scope="col" width="10%">Dasar No. SKEP</th>
                    <th scope="col" width="10%">Tempat Pangkat</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="20%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($dataKepangkatan->count()<=0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($dataKepangkatan as $item_dataKepangkatan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item_dataKepangkatan->pangkat }}</td>
                            <td>{{ $item_dataKepangkatan->no_skep }}</td>
                            <td>{{ $item_dataKepangkatan->tempat_pangkat }}</td>
                            <td>{{ $item_dataKepangkatan->keterangan }}</td>
                            <td>
                                <a class="text-decoration-none" href="{{ route('admin.personil.data-kepangkatan.edit', ['nrp' => $nrpGanti, 'dataKepangkatanId' => $item_dataKepangkatan->id]) }}">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                {{--  --}}
                                <form action="{{ route('admin.personil.data-kepangkatan.destroy', ['nrp' => $nrpGanti, 'dataKepangkatanId' => $item_dataKepangkatan->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus <span><iconify-icon icon="mingcute:delete-line"></iconify-icon></span></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            <a class="text-decoration-none" href="{{ route('admin.personil.show', $nrpGanti) }}">
                <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
            </a>
    </div>
</div>
@endsection