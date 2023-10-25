@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Riwayat Penugasan Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Riwayat Penugasan/Penempatan</h1>
            <h4 class="mt-3">Tambahkan data riwayat penugasan/penempatan personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{-- {{ route('admin.personil.riwayat-penugasan.store', ['nrp' => $nrpGanti]) }} --}}
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                        <label for="tahun">Massukkan tahun penugasan/penempatan baru</label>
                        <input type="text" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun')}}" placeholder="YYYY" autofocus>
                        @error('tahun')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Masukkan jabatan penugasan/penempatan baru</label>
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" placeholder="nama jabatan" value="{{ old('jabatan')}}">
                      @error('jabatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat">Massukkan tempat penugasan/penempatan baru</label>
                      <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" placeholder="Tempat penugasan/penempatan" value="{{ old('tempat')}}">
                      @error('tempat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan')}}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.riwayat-penugasan.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection