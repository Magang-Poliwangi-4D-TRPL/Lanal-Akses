@extends('layout.admin.app')

@section('title-page', 'Personil | Data Pendidikan Formal')

@section('content')
<div class="container">
    <h1 class="text-black my-4">Data Semua Pendidikan Formal</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            <a class="text-decoration-none" href="">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Pendidikan Formal Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="10%">no</th>
                    <th scope="col" width="15%">Nama Pendidikan</th>
                    <th scope="col" width="10%">Lama Pendidikan</th>
                    <th scope="col" width="20%">Tahun Lulus</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="15%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($pendidikanFormal->count() <= 0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($pendidikanFormal as $data_pendidikan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_pendidikan->nama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->lama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->tahun_lulus }}</td>
                            <td>{{ $data_pendidikan->keterangan }}</td>
                            <td>
                                <a class="text-decoration-none" href="">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                <form action="" method="POST" style="display: inline;">
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
    </div>
</div>
@endsection