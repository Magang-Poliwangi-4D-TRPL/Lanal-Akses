@extends('layout.admin.app')

@section('title-page', 'Personil | Data Pendidikan Kursus')

@section('content')
<div class="container">
    <h1 class="text-black my-4">Data Kursus {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            
            <a class="text-decoration-none" href="{{ route('admin.personil.kursus.create', ['nrp' => $nrpGanti]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Kursus Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="5%">no</th>
                    <th scope="col" width="15%">Nama Kursus</th>
                    <th scope="col" width="10%">Lama Kursus</th>
                    <th scope="col" width="10%">Tempat Kursus</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="20%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($kursus->count()<=0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($kursus as $data_kursus)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_kursus->nama_kursus }}</td>
                            <td>{{ $data_kursus->lama_kursus }}</td>
                            <td>{{ $data_kursus->tempat_kursus }}</td>
                            <td>{{ $data_kursus->keterangan }}</td>
                            <td>
                                <a class="text-decoration-none" href="{{ route('admin.personil.kursus.edit', ['nrp' => $nrpGanti, 'kursusId' => $data_kursus->id]) }}">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                <form action="{{ route('admin.personil.kursus.destroy', ['nrp' => $nrpGanti, 'kursusId' => $data_kursus->id]) }}" method="POST" style="display: inline;">
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
        
        <a class="text-decoration-none" href="{{ route('admin.personil.show', $nrpGanti) }}">
            <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
        </a>
    </div>
</div>
@endsection