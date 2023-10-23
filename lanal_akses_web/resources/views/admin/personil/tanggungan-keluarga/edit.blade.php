@extends('layout.admin.app')

@section('title-page', 'Personil | Edit Data Tanggungan Keluarga Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Tanggungan Keluarga</h1>
            <h4 class="mt-3">Ubah data tanggungan keluarga personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.tanggungan-keluarga.update', ['nrp' => $nrpGanti, 'tanggunganKeluargaId' => $tanggungan_keluarga->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama lengkap baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" required autofocus placeholder="Nama Lengkap" value="{{ $tanggungan_keluarga->nama_lengkap }}">
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat_tanggal_lahir">Massukkan tempat, tanggal lahir baru</label>
                      <input type="text" class="form-control @error('tempat_tanggal_lahir') is-invalid @enderror" id="tempat_tanggal_lahir" name="tempat_tanggal_lahir" required placeholder="Contoh: Banyuwangi, 01 Januari 2001" value="{{ $tanggungan_keluarga->tempat_tanggal_lahir }}">
                      @error('tempat_tanggal_lahir')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="status_hubungan">Pilih Status Hubungan</label>
                        <select class="form-control" name="status_hubungan">
                          <option value="istri" {{  old('status_hubungan', $tanggungan_keluarga->status_hubungan) === 'istri' ? 'selected' : ''  }}>Istri</option>
                          <option value="suami" {{  old('status_hubungan', $tanggungan_keluarga->status_hubungan) === 'suami' ? 'selected' : ''  }}>Suami</option>
                          <option value="anak" {{  old('status_hubungan', $tanggungan_keluarga->status_hubungan) === 'anak' ? 'selected' : ''  }}>Anak</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $tanggungan_keluarga->keterangan }}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.tanggungan-keluarga.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection