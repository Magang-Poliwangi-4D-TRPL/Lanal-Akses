@extends('layout.admin.app')

@section('title-page', 'Personil | Data Tanggungan Keluarga')

@section('content')
<div class="container">
    <h1 class="text-black my-4">Data Tanggungan Keluarga {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            <a class="text-decoration-none" href="{{ route('admin.personil.tanggungan-keluarga.create', ['nrp' => $nrpGanti]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Tanggungan Keluarga<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="5%">no</th>
                    <th scope="col" width="15%">Nama Lengkap</th>
                    <th scope="col" width="20%">Tempat, Tanggal Lahir</th>
                    <th scope="col" width="10%">Status Hubungan</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="15%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($tanggungan_keluarga->count()<=0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($tanggungan_keluarga as $data_tanggungan_keluarga)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_tanggungan_keluarga->nama_lengkap }}</td>
                            <td>{{ $data_tanggungan_keluarga->tempat_tanggal_lahir }}</td>
                            <td>{{ $data_tanggungan_keluarga->status_hubungan }}</td>
                            <td>{{ $data_tanggungan_keluarga->keterangan }}</td>
                            <td>
                                <a class="text-decoration-none" href="{{ route('admin.personil.tanggungan-keluarga.edit', ['nrp' => $nrpGanti, 'tanggunganKeluargaId' => $data_tanggungan_keluarga->id]) }}">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                {{-- {{ route('admin.personil.kursus.destroy', ['nrp' => $nrpGanti, 'tanggunganKeluargaId' => $data_tanggungan_keluarga->id]) }} --}}
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