@extends('layout.admin.app')

@section('title-page', 'Personil | Edit Data Riwayat Penugasan/Penempatan Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Riwayat Penugasan/Penempatan</h1>
            <h4 class="mt-3">Ubah data riwayat penugasan/penempatan personil</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{-- {{ route('admin.personil.riwayat-penugasan.update', ['nrp' => $nrpGanti, 'riwayatPenugasanId' => $riwayatPenugasan->id]) }} --}}
                <form method="POST" action="{{ route('admin.personil.riwayat-penugasan.update', ['nrp' => $nrpGanti, 'riwayatPenugasanId' => $riwayatPenugasan->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="tahun">Massukkan Tahun Penugasan/Penempatan baru</label>
                      <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" required autofocus placeholder="YYYY" value="{{ $riwayatPenugasan->tahun }}">
                      @error('tahun')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Massukkan Jabatan Penugasan/Penempatan baru</label>
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required placeholder="nama jabatan" value="{{ $riwayatPenugasan->jabatan }}">
                      @error('jabatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat">Massukkan tempat Penugasan/Penempatan baru</label>
                      <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" required placeholder="Tempat Penugasan/Penempatan" value="{{ $riwayatPenugasan->tempat }}">
                      @error('tempat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $riwayatPenugasan->keterangan }}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.riwayat-penugasan.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection