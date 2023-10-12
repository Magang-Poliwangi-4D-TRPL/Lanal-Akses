@extends('layout.admin.app')

@section('title-page', 'Personil | Edit Data Pendidikan Formal Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Pendidikan Formal</h1>
            <h4 class="mt-3">Ubah data pendidikan formal personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.pendidikanformal.update', ['nrp' => $nrpGanti, 'pendidikanFormalId' => $pendidikanFormal->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_pendidikan">Massukkan nama pendidikan baru</label>
                      <input type="text" class="form-control" id="nama_pendidikan" name="nama_pendidikan" required autofocus placeholder="Nama Pendidikan" value="{{ $pendidikanFormal->nama_pendidikan }}">
                    </div>
                    <div class="form-group">
                      <label for="lama_pendidikan">Massukkan lama pendidikan baru</label>
                      <input type="text" class="form-control" id="lama_pendidikan" name="lama_pendidikan" required placeholder="Lama Pendidikan (x tahun)" value="{{ $pendidikanFormal->lama_pendidikan }}">
                    </div>
                    <div class="form-group">
                      <label for="tahun_lulus">Massukkan tahun lulus pendidikan baru</label>
                      <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" required placeholder="Tahun Lulus (xxxx)" value="{{ $pendidikanFormal->tahun_lulus }}">
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $pendidikanFormal->keterangan }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection