@extends('layout.admin.app')

@section('title-page', 'Personil | Data Pendidikan Kursus')

@section('content')
<style>
    .border-all {
        border: 1px solid #5786CA;
        background-color: #fefefe;
    }
</style>
<div class="container">
    <h1 class="text-black my-4">Data Informasi Keluarga {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white py-4 border rounded p-5 mt-4">
        <div class="row d-flex justify-content-between align-items-center mb-4 border-bottom border-black">
            <h3 class="bluedark my-4" >Informasi Pasangan</h3>
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            @if($informasiPasangan->count()==0)
                <a class="btn btn-blue btn-md text-white bg-blueaccent" href="{{ route('admin.personil.informasi-pasangan.create', ['nrp' => $nrpGanti]) }}">
                    Tambah Data Pasangan Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" class="px-2"></iconify-icon></span>
                </a>
            @else
                <div class="row justify-content-between">
                    <a href="{{ route('admin.personil.informasi-pasangan.edit', ['nrp' => $nrpGanti, 'informasiPasanganId' => $informasiPasangan[0]->id]) }}" class="btn btn-sm text-white btn-blue bg-bluedark mr-3">Edit data Pasangan <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></a>
                    <form action="{{ route('admin.personil.informasi-pasangan.delete', ['nrp' => $nrpGanti, 'informasiPasanganId' => $informasiPasangan[0]->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus data pasangan<span><iconify-icon icon="mingcute:delete-line" class="px-2"></iconify-icon></span></button>
                    </form>
                </div>
            @endif
        </div>
        @if($informasiPasangan->count()!=0)
            <div class="container align-items-center">
                <h4 class="text-black my-4" >{{ $informasiPasangan[0]->nama_lengkap }}</h4>
            </div>
            <table class="table thead-light">
                <tbody>
                    <tr>
                      <td scope="col" width="45%">Tempat, Tanggal Lahir</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->tempat_lahir )
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->tempat_lahir . ' ,' . $informasiPasangan[0]->tanggal_lahir}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Agama/Suku Bangsa</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->agama )
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->agama . '/' . $informasiPasangan[0]->suku_bangsa}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Tinggi/Berat Badan</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->tinggi_badan && $informasiPasangan[0]->berat_badan )
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->tinggi_badan . ' CM/' .  $informasiPasangan[0]->berat_badan . ' KG'}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Golongan Darah</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->golongan_darah)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->golongan_darah}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Pekerjaan</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->pekerjaan)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->pekerjaan}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Alamat Sekarang</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->alamat_sekarang)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->alamat_sekarang}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">No. KPI</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->nomor_kpi)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->nomor_kpi}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Tempat Nikah</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->tempat_nikah)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->tempat_nikah}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Nomor Surat Nikah</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->nomor_surat_nikah)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->nomor_surat_nikah}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                    <tr>
                      <td scope="col" width="45%">Nomor KTA JALASENASTRI</td>
                      <td scope="col" width="10%">:</td>
                      <td scope="col" width="45%" >
                        @empty($informasiPasangan[0]->nomor_kta_jalasenastri)
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                _
                            </div>
                        @else
                            <div class="container m-0 px-4 py-2 rounded border-all">
                                {{ $informasiPasangan[0]->nomor_kta_jalasenastri}}
                            </div>
                        @endempty
                      </td>
                    </tr>
                </tbody>
            </table>
        @else
        <div class="container align-items-center">
            <h4 class="text-black my-4" >Belum ada data pasangan</h4>
        </div>
        @endif
        <a class="text-decoration-none" href="{{ route('admin.personil.show', $nrpGanti) }}">
            <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
        </a>
    </div>

    <div class="container bg-white py-4 border rounded p-5 mt-4">
        <div class="row d-flex justify-content-between align-items-center mb-2 border-bottom border-black">
            <h3 class="bluedark mt-4" >Informasi Anak</h3>
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            {{--  --}}
            <a class="btn btn-blue btn-md text-white bg-blueaccent" href="{{ route('admin.personil.informasi-anak.create', ['nrp' => $nrpGanti]) }}">
                Tambah Data Anak Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" class="px-2"></iconify-icon></span>
            </a>
                
        </div>
        @if($informasiAnak->count()!=0)
        <div class="row justify-content-between">
            @foreach($informasiAnak as $dataInformasiAnak)
            <div class="col-sm-6 mt-4 py-4 border border-black rounded">
                <h4 class="text-black my-4" >{{ $dataInformasiAnak->nama_lengkap }}</h4>
                <table class="table thead-light">
                    <tbody>
                        <tr>
                          <td scope="col" width="45%">Tempat, Tanggal Lahir</td>
                          <td scope="col" width="10%">:</td>
                          <td scope="col" width="45%" >
                            @empty($dataInformasiAnak->tempat_lahir )
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    _
                                </div>
                            @else
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    {{ $dataInformasiAnak->tempat_lahir . ' ,' . $dataInformasiAnak->tanggal_lahir}}
                                </div>
                            @endempty
                          </td>
                        </tr>
                        <tr>
                          <td scope="col" width="45%">Jenis Kelamin</td>
                          <td scope="col" width="10%">:</td>
                          <td scope="col" width="45%" >
                            @empty($dataInformasiAnak->jenis_kelamin )
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    _
                                </div>
                            @else
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    @if($dataInformasiAnak->jenis_kelamin == 'L')
                                        Laki-Laki
                                    @else
                                        Perempuan
                                    @endif
                                </div>
                            @endempty
                          </td>
                        </tr>
                    </tbody>
                </table>
                <div class="px-4 row justify-content-end">
                    <a href="{{ route('admin.personil.informasi-anak.edit', ['nrp' => $nrpGanti, 'informasiAnakId' => $dataInformasiAnak->id]) }}" class="btn btn-sm text-white btn-blue bg-bluedark mr-1">Edit data Anak <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></a>
                    {{--  --}}
                    <form action="{{ route('admin.personil.informasi-anak.delete', ['nrp' => $nrpGanti, 'informasiAnakId' => $dataInformasiAnak->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus data Anak<span><iconify-icon icon="mingcute:delete-line" class="px-2"></iconify-icon></span></button>
                    </form>
                </div>
                
            </div>
            @endforeach
        </div>
        @else
        <div class="container align-items-center">
            <h4 class="text-black my-4" >Belum ada data anak</h4>
        </div>
        @endif
        
    </div>

    <div class="container bg-white py-4 border rounded p-5 mt-4">
        <div class="row d-flex justify-content-between align-items-center mb-2 border-bottom border-black">
            <h3 class="bluedark my-4" >Informasi Orang Tua</h3>
            @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
            @endphp
            {{--  --}}
            <a class="btn btn-blue btn-md text-white bg-blueaccent" href="{{ route('admin.personil.informasi-orang-tua.create', ['nrp' => $nrpGanti]) }}">
                Tambah Data Orang Tua Personel<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" class="px-2"></iconify-icon></span>
            </a>
                
        </div>
        @if($informasiOrangTua->count()!=0)
        <div class="row justify-content-between">
            @foreach($informasiOrangTua as $dataInformasiOrangTua)
            <div class="col-sm-6 mt-4 py-4 border border-black rounded">
                <h4 class="text-black my-4" >{{ $dataInformasiOrangTua->nama_lengkap }}</h4>
                <table class="table thead-light">
                    <tbody>
                        <tr>
                          <td scope="col" width="45%">Agama</td>
                          <td scope="col" width="10%">:</td>
                          <td scope="col" width="45%" >
                            @empty($dataInformasiOrangTua->agama )
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    _
                                </div>
                            @else
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    {{ $dataInformasiOrangTua->agama }}
                                </div>
                            @endempty
                          </td>
                        </tr>
                        <tr>
                          <td scope="col" width="45%">Status Hubungan</td>
                          <td scope="col" width="10%">:</td>
                          <td scope="col" width="45%" >
                            @empty($dataInformasiOrangTua->status_hubungan )
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    _
                                </div>
                            @else
                                <div class="container m-0 px-4 py-2 rounded border-all">
                                    {{ $dataInformasiOrangTua->status_hubungan }}
                                </div>
                            @endempty
                          </td>
                        </tr>
                    </tbody>
                </table>
                <div class="px-4 row justify-content-end">
                    <a href="{{ route('admin.personil.informasi-orang-tua.edit', ['nrp' => $nrpGanti, 'informasiOrangTuaId' => $dataInformasiOrangTua->id]) }}" class="btn btn-sm text-white btn-blue bg-bluedark mr-1">Edit data orang tua <span><iconify-icon icon="clarity:note-line"></iconify-icon></span></a>
                    {{--  --}}
                    <form action="{{ route('admin.personil.informasi-orang-tua.delete', ['nrp' => $nrpGanti, 'informasiOrangTuaId' => $dataInformasiOrangTua->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus data orang tua<span><iconify-icon icon="mingcute:delete-line" class="px-2"></iconify-icon></span></button>
                    </form>
                </div>
                
            </div>
            @endforeach
        </div>
        @else
        <div class="container align-items-center">
            <h4 class="text-black my-4" >Belum ada data orang tua</h4>
        </div>
        @endif
        
    </div>
</div>
@endsection