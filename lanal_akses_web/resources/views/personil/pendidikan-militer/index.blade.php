@extends('layout.personil.app')

@section('title-page', 'Personel | Data Pendidikan Militer')

@section('content')
<div class="container">
    {{-- pop up message --}}
    @if (Session::has('alert'))
        <div class="alert alert-danger">
            {{ Session::get('alert') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }}
        </div>
    @endif
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
    <h1 class="text-black my-4">Data Pendidikan Militer {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            <a class="text-decoration-none" href="{{ route('personel.pendidikanmiliter.create', ['nrp' => $nrpGanti]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Data Pendidikan Militer Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
        </div>
        <table class="table thead-light">
            <thead>
                <tr class="bg-blueaccent text-white text-bold">
                    <th scope="col" width="5%">no</th>
                    <th scope="col" width="15%">Nama Pendidikan</th>
                    <th scope="col" width="10%">Lama Pendidikan</th>
                    <th scope="col" width="10%">Tahun Lulus</th>
                    <th scope="col" width="15%">Keterangan</th>
                    <th scope="col" width="20%">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @if($pendidikanMiliter->count()<=0)
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                @else
                    @foreach ($pendidikanMiliter as $data_pendidikan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data_pendidikan->nama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->lama_pendidikan }}</td>
                            <td>{{ $data_pendidikan->tahun_lulus }}</td>
                            <td>{{ $data_pendidikan->keterangan }}</td>
                            <td>
                                <a class="text-decoration-none" href="{{ route('personel.pendidikanmiliter.edit', ['nrp' => $nrpGanti, 'pendidikanMiliterId' => $data_pendidikan->id]) }}">
                                    <button class="btn btn-blue btn-sm text-white bg-bluemain m-2" >Edit <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></button>
                                </a>
                                <form action="{{ route('personel.pendidikanmiliter.destroy', ['nrp' => $nrpGanti, 'pendidikanMiliterId' => $data_pendidikan->id]) }}" method="POST" style="display: inline;">
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
            <a class="text-decoration-none" href="{{ route('personil.dashboard') }}">
                <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
            </a>
    </div>
</div>
@endsection