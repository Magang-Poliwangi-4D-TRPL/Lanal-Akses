@extends('layout.admin.app')

@section('title-page', 'Personil | Edit Data Pendidikan Militer Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Pendidikan Militer</h1>
            <h4 class="mt-3">Ubah data pendidikan militer personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.pendidikanmiliter.update', ['nrp' => $nrpGanti, 'pendidikanMiliterId' => $pendidikanMiliter->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_pendidikan">Massukkan nama pendidikan militer baru</label>
                      <input type="text" class="form-control @error('nama_pendidikan') is-invalid @enderror" id="nama_pendidikan" name="nama_pendidikan" required autofocus placeholder="Nama Pendidikan" value="{{ $pendidikanMiliter->nama_pendidikan }}">
                      @error('nama_pendidikan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="lama_pendidikan">Massukkan lama pendidikan militer baru</label>
                      <input type="text" class="form-control @error('lama_pendidikan') is-invalid @enderror" id="lama_pendidikan" name="lama_pendidikan" required placeholder="Lama Pendidikan (x tahun)" value="{{ $pendidikanMiliter->lama_pendidikan }}">
                      @error('lama_pendidikan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tahun_lulus">Massukkan tahun lulus pendidikan militer baru</label>
                      <input type="text" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" required placeholder="Tahun Lulus (xxxx)" value="{{ $pendidikanMiliter->tahun_lulus }}">
                      @error('tahun_lulus')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $pendidikanMiliter->keterangan }}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.pendidikanmiliter.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection