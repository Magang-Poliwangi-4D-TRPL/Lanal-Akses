@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <style>
        .active{
            text-decoration: underline;
            color: #0D21A1!important;
        }
        .pagination a{
            color: gray;
        }
    </style>
    <div class="container">
        <h1 class="text-black my-4">Data Personil</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            <div class="d-flex justify-content-between"> <!-- Tambahkan class ini untuk menggeser tombol ke kanan -->
                <a class="text-decoration-none" href="{{ route('admin.personil.create') }}">
                    <button class="btn btn-blue btn-md text-white bg-blueaccent my-2">Tambah Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
                </a>
                
            </div>
            <table class="table thead-light">
                <thead>
                    <tr class="bg-bluedark text-white text-bold">
                      <th scope="col" width="10%">no</th>
                      <th scope="col" width="15%">Nama Lengkap</th>
                      <th scope="col" width="10%">NRP/KORPS</th>
                      <th scope="col" width="20%">Jabatan</th>
                      <th scope="col" width="15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($personil->count() > 0)
                        @foreach ($personil as $data_personil)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data_personil->nama_lengkap }}</td>
                                <td>{{ $data_personil->nrp }}</td>
                                <td>{{ $data_personil->jabatan }}</td>
                                <td>
                                    @php
                                    $nrp = $data_personil->nrp;
                                    $nrpGanti = str_replace('/', '-', $nrp);
                                    @endphp
                                    <a class="text-decoration-none" href="{{ route('admin.personil.show', $nrpGanti) }}">
                                        <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Lihat <span><iconify-icon icon="mdi:eye-outline"></iconify-icon></span></button>
                                    </a>
                                    <form action="{{ route('admin.personil.destroy', $data_personil->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                    @endif
                    
                  </tbody>
                  
            </table>
        </div>
    </div>
@endsection