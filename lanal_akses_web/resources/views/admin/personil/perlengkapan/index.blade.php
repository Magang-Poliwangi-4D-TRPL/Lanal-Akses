@extends('layout.admin.app')

@section('title-page', 'Personil | Data Perlengkapan')

@section('content')
<div class="container">
    <h1 class="text-black my-4">Data Perlengkapan {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            {{-- {{ route('admin.personil.perlengkapan.create', ['nrp' => $nrpGanti]) }} --}}
            <a class="text-decoration-none" href="">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Perlengkapan Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="5%">no</th>
                    <th scope="col" width="15%">Ukuran Baju</th>
                    <th scope="col" width="10%">Ukuran Celena</th>
                    <th scope="col" width="10%">No. Sepatu</th>
                    <th scope="col" width="10%">No. Topi</th>
                    <th scope="col" width="10%">No. MUT</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="20%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($perlengkapan->count()<=0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($perlengkapan as $data_perlengkapan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_perlengkapan->baju }}</td>
                            <td>{{ $data_perlengkapan->celana }}</td>
                            <td>{{ $data_perlengkapan->no_sepatu }}</td>
                            <td>{{ $data_perlengkapan->no_topi }}</td>
                            <td>{{ $data_perlengkapan->no_mut }}</td>
                            <td>{{ $data_perlengkapan->keterangan }}</td>
                            <td>
                                {{-- {{ route('admin.personil.perlengkapan.edit', ['nrp' => $nrpGanti, 'perlengkapanId' => $data_perlengkapan->id]) }} --}}
                                <a class="text-decoration-none" href="">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                {{-- {{ route('admin.personil.perlengkapan.destroy', ['nrp' => $nrpGanti, 'perlengkapanId' => $data_perlengkapan->id]) }} --}}
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