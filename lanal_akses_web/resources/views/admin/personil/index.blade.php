@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <div class="container">
        <h1 class="text-black my-4">Data Personil</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            <table class="table thead-light">
                <p>halaman {{ $page }}</p>
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
                                    <button class="btn text-white btn-sm btn-danger m-2" >Hapus <span><iconify-icon icon="mingcute:delete-line"></iconify-icon></span></button>
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
            @if($personil->count() > 0)
                <a href="{{ route('admin.personil.index', ['page' => $page + 1]) }}" class="btn btn-primary">Halaman Selanjutnya</a>
            @endif
        </div>
    </div>
@endsection