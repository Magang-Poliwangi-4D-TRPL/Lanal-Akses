@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Tanda Jasa Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Tanda Jasa/Satya Lencana</h1>
            <h4 class="mt-3">Tambahkan data tanda jasa/satya lencana personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{--  --}}
                <form method="POST" action="{{ route('admin.personil.tanda-jasa.store', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                        <label for="nama_tanda_jasa">Massukkan nama Tanda Jasa/Satya Lencana baru</label>
                        <input type="text" class="form-control @error('nama_tanda_jasa') is-invalid @enderror" id="nama_tanda_jasa" name="nama_tanda_jasa" required autofocus placeholder="Nama Tanda Jasa/Satya Lencana" value="{{ old('nama_tanda_jasa') }}">
                        @error('nama_tanda_jasa')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                      </div>
                    <div class="form-group">
                        <label for="no_skep">Masukkan Nomor SKEP baru</label>
                        <input type="text" class="form-control @error('no_skep') is-invalid @enderror" id="no_skep" name="no_skep" required autofocus placeholder="format: KED/x/x/x" value="{{ old('no_skep') }}">
                        @error('no_skep')
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
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.tanda-jasa.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection