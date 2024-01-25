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
                <form method="POST" action="{{ route('admin.personil.tanggungan-keluarga.update', ['nrp' => $nrpGanti, 'tanggunganKeluargaId' => $tanggunganKeluarga->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama lengkap baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" required autofocus placeholder="Nama Lengkap" value="{{ $tanggunganKeluarga->nama_lengkap }}">
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $tanggunganKeluarga->tempat_lahir) }}">
                      </div>
                      @error('tempat_lahir')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-4">
                          <div class="input-group date" id="datepicker">
                              <input type="text" class="form-control" data-target="#datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir',$tanggunganKeluarga->tanggal_lahir) }}">
                              <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                        @error('tanggal_lahir')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                      <label for="status_hubungan" class="col-sm-2 col-form-label">Status Hubungan</label>
                      <div class="col-sm-4">
                          <select class="form-control  @error('status_hubungan') is-invalid @enderror" name="status_hubungan" id="status_hubungan">
                              <option value="Anak" {{ old('status_hubungan', $tanggunganKeluarga->status_hubungan) === 'Anak' ? 'selected' : '' }}>Anak</option>
                              <option value="Suami" {{ old('status_hubungan', $tanggunganKeluarga->status_hubungan) === 'Suami' ? 'selected' : '' }}>Suami</option>
                              <option value="Istri" {{ old('status_hubungan', $tanggunganKeluarga->status_hubungan) === 'Istri' ? 'selected' : '' }}>Istri</option>
                          </select>
                          @error('status_hubungan')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-4">
                          <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                              <option value="L" {{ old('jenis_kelamin', $tanggunganKeluarga->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                              <option value="P" {{ old('jenis_kelamin', $tanggunganKeluarga->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                          </select>
                          @error('jenis_kelamin')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                      
                    </div>
                    <script>
                      document.addEventListener("DOMContentLoaded", function () {
                        var jenisKelaminForm = document.getElementById("jenis_kelamin");
                        var statusHubunganForm = document.getElementById("status_hubungan");

                        statusHubunganForm.addEventListener("change", function () {
                          if (statusHubunganForm.value == 'Suami') {
                            jenisKelaminForm.value = 'L';
                            jenisKelaminForm.disabled = true;
                          } else if(statusHubunganForm.value == 'Istri'){
                            jenisKelaminForm.value = 'P';
                            jenisKelaminForm.disabled = true;
                          } else {
                            jenisKelaminForm.disabled = false;
                          }
                        });
                      });
                    </script>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $tanggunganKeluarga->keterangan }}">
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