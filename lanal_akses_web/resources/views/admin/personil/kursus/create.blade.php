@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Kursus Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Kursus</h1>
            <h4 class="mt-3">Tambahkan data kursus personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.kursus.store', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_kursus">Massukkan nama kursus baru</label>
                      <input type="text" class="form-control @error('nama_kursus') is-invalid @enderror" id="nama_kursus" name="nama_kursus" value="{{ old('nama_kursus')}}" placeholder="Nama Kursus" autofocus>
                      @error('nama_kursus')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="lama_kursus">Lama pendidikan kursus</label>
                      <input type="text" class="form-control @error('lama_kursus') is-invalid @enderror" id="lama_kursus" name="lama_kursus" placeholder="Lama Pendidikan Kursus (x tahun/bulan)" value="{{ old('lama_kursus')}}">
                      @error('lama_kursus')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat_kursus">Massukkan tempat kursus baru</label>
                      <input type="text" class="form-control @error('tempat_kursus') is-invalid @enderror" id="tempat_kursus" name="tempat_kursus" placeholder="Tempat Kursus" value="{{ old('tempat_kursus')}}">
                      @error('tempat_kursus')
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
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.kursus.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection