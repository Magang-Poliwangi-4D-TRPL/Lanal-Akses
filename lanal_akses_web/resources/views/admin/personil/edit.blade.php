@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Data PNS')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Personil</h1>
            <h4 class="mt-3">Ubah data personil, untuk setiap tanda bintang (*) pada kolom isian bermakna kolom tersebut wajib diisi</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.update', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama baru personil (*)</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" required autofocus placeholder="Nama Lengkap Personil" value="{{ $personil->nama_lengkap }}">
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Massukkan jabatan baru personil(*)</label>
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required placeholder="Jabatan pegawai" value="{{ $personil->jabatan }}">
                      @error('jabatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis kelamin personil</label>
                      <div class="col-sm-3">
                          <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                              <option value="L" {{ old('jenis_kelamin', $personil->jenis_kelamin) === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                              <option value="P" {{ old('jenis_kelamin', $personil->jenis_kelamin) === 'P' ? 'selected' : '' }}>Perempuan</option>
                          </select>
                          @error('jenis_kelamin')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pangkat">Massukkan pangkat personil baru</label>
                      <input type="text" class="form-control @error('pangkat') is-invalid @enderror" id="pangkat" name="pangkat" placeholder="pangkat personil" value="{{ $personil->pangkat }}">
                      @error('pangkat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="korps">Massukkan korps personil baru</label>
                      <input type="text" class="form-control @error('korps') is-invalid @enderror" id="korps" name="korps"  placeholder="format penulisan: (KORPS)" value="{{ $personil->korps }}">
                      @error('korps')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="pangkat_terakhir">Massukkan pangkat terakhir personil baru</label>
                      <input type="text" class="form-control @error('pangkat_terakhir') is-invalid @enderror" id="pangkat_terakhir" name="pangkat_terakhir"  placeholder="pangkat terakhir personil" value="{{ $personil->pangkat_terakhir }}">
                      @error('pangkat_terakhir')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat_armada">Massukkan tempat dinas personil baru</label>
                      <input type="text" class="form-control @error('tempat_dinas') is-invalid @enderror" id="tempat_dinas" name="tempat_dinas"  placeholder="tempat dinas personil" value="{{ $personil->tempat_dinas }}">
                      @error('tempat_dinas')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat_armada">Massukkan tempat armada personil baru</label>
                      <input type="text" class="form-control @error('tempat_armada') is-invalid @enderror" id="tempat_armada" name="tempat_armada"  placeholder="tempat armada personil" value="{{ $personil->tempat_armada }}">
                      @error('tempat_armada')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nomor_kta">Massukkan nomor KTA personil baru</label>
                      <input type="text" class="form-control @error('nomor_kta') is-invalid @enderror" id="nomor_kta" name="nomor_kta"  placeholder="format penulisan: 000/AAA/AA/II/00/AAA" value="{{ $personil->nomor_kta }}">
                      @error('nomor_kta')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nomor_ktp">Massukkan nomor KTP personil baru</label>
                      <input type="text" class="form-control @error('nomor_ktp') is-invalid @enderror" id="nomor_ktp" name="nomor_ktp"  placeholder="format penulisan: 000000000000000" value="{{ $personil->nomor_ktp }}">
                      @error('nomor_ktp')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nomor_asbri">Massukkan nomor ASBRI personil baru</label>
                      <input type="text" class="form-control @error('nomor_asbri') is-invalid @enderror" id="nomor_asbri" name="nomor_asbri"  placeholder="format penulisan: CD-12345" value="{{ $personil->nomor_asbri }}">
                      @error('nomor_asbri')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    @php
                      $tempat_tanggal_lahir = [];
                      $tempat_lahir = '';
                      $tanggal_lahir = '';
                      if ($personil->tempat_tanggallahir == null) {
                        $tempat_lahir = '';
                        $tanggal_lahir = '';
                      } else {
                        $tempat_tanggal_lahir = explode(",", $personil->tempat_tanggallahir);
                        $tempat_lahir = $tempat_tanggal_lahir[0];
                        $tanggal_lahir = $tempat_tanggal_lahir[1];
                      }
                    @endphp
                    <div class="form-group row">
                      <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                      <div class="col-sm-4">
                          <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ $tempat_lahir }}">
                      </div>
                      <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                      <div class="col-sm-4">
                          <div class="input-group date" id="tanggal_lahir_picker" data-target-input="nearest">
                              <input type="text" class="form-control datetimepicker-input" data-target="#tanggal_lahir_picker" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ $tanggal_lahir }}">
                              <div class="input-group-append" data-target="#tanggal_lahir_picker" data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                              </div>
                          </div>
                        </div>
                  </div>
                    <div class="form-group">
                      <label for="tinggi_beratbadan">Massukkan tinggi & berat badan personil baru</label>
                      <input type="text" class="form-control @error('tinggi_beratbadan') is-invalid @enderror" id="tinggi_beratbadan" name="tinggi_beratbadan"  placeholder="XX cm/XX kg" value="{{ $personil->tinggi_beratbadan }}">
                      @error('tinggi_beratbadan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="agama_sukubangsa">Massukkan agama & suku bangsa personil baru</label>
                      <input type="text" class="form-control @error('agama_sukubangsa') is-invalid @enderror" id="agama_sukubangsa" name="agama_sukubangsa"  placeholder="agama/suku bangsa" value="{{ $personil->agama_sukubangsa }}">
                      @error('agama_sukubangsa')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="golongan_darah" class="col-sm-3 col-form-label">Golongan darah personil</label>
                      <div class="col-sm-3">
                          <select class="form-control  @error('golongan_darah') is-invalid @enderror" name="golongan_darah" id="golongan_darah">
                              <option value="A+" {{ old('golongan_darah', $personil->golongan_darah) === 'A+' ? 'selected' : '' }}>A+</option>
                              <option value="B+" {{ old('golongan_darah', $personil->golongan_darah) === 'B+' ? 'selected' : '' }}>B+</option>
                              <option value="AB+" {{ old('golongan_darah', $personil->golongan_darah) === 'AB+' ? 'selected' : '' }}>AB+</option>
                              <option value="O+" {{ old('golongan_darah', $personil->golongan_darah) === 'O+' ? 'selected' : '' }}>O+</option>
                              <option value="A-" {{ old('golongan_darah', $personil->golongan_darah) === 'A-' ? 'selected' : '' }}>A-</option>
                              <option value="B-" {{ old('golongan_darah', $personil->golongan_darah) === 'B-' ? 'selected' : '' }}>B-</option>
                              <option value="AB-" {{ old('golongan_darah', $personil->golongan_darah) === 'AB-' ? 'selected' : '' }}>AB-</option>
                              <option value="O-" {{ old('golongan_darah', $personil->golongan_darah) === 'O-' ? 'selected' : '' }}>O-</option>
                          </select>
                          @error('golongan_darah')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="dikspesialisasi">Massukkan DIKSPESIALISASI personil baru</label>
                      <input type="text" class="form-control @error('dikspesialisasi') is-invalid @enderror" id="dikspesialisasi" name="dikspesialisasi"  placeholder="0/00" value="{{ $personil->dikspesialisasi }}">
                      @error('dikspesialisasi')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nilai_samata_stakes">Massukkan nilai SAMATA/STAKES personil baru</label>
                      <input type="text" class="form-control @error('nilai_samata_stakes') is-invalid @enderror" id="nilai_samata_stakes" name="nilai_samata_stakes"  placeholder="nilai SAMATA/nilai STAKES" value="{{ $personil->nilai_samata_stakes }}">
                      @error('nilai_samata_stakes')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="kecakapan_bahasa">Kecakapan bahasa personil baru</label>
                      <input type="text" class="form-control @error('kecakapan_bahasa') is-invalid @enderror" id="kecakapan_bahasa" name="kecakapan_bahasa"  placeholder="Pisahkan dengan koma (,) jika memiliki lebih dari satu. Contoh bahasa indonesia, bahasa inggris" value="{{ $personil->kecakapan_bahasa }}">
                      @error('kecakapan_bahasa')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="alamat_sekarang">Masukkan alamat sekarang personil baru</label>
                      <input type="text" class="form-control @error('alamat_sekarang') is-invalid @enderror" id="alamat_sekarang" name="alamat_sekarang"  placeholder="Alamat sekarang" value="{{ $personil->alamat_sekarang }}">
                      @error('alamat_sekarang')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="nomor_hp">Masukkan nomor telepon personil baru</label>
                      <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" id="nomor_hp" name="nomor_hp"  placeholder="08 xxxx xxxx xx" value="{{ $personil->nomor_hp }}">
                      @error('nomor_hp')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                      <label for="status_rumah" class="col-sm-3 col-form-label">Status rumah personil</label>
                      <div class="col-sm-4">
                          <select class="form-control  @error('status_rumah') is-invalid @enderror" name="status_rumah" id="status_rumah">
                              <option value="Sendiri" {{ old('status_rumah', $personil->status_rumah) === 'Sendiri' ? 'selected' : '' }}>Sendiri</option>
                              <option value="Kontrak" {{ old('status_rumah', $personil->status_rumah) === 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                              <option value="Numpang" {{ old('status_rumah', $personil->status_rumah) === 'Numpang' ? 'selected' : '' }}>Numpang</option>
                              <option value="Rumdis" {{ old('status_rumah', $personil->status_rumah) === 'Rumdis' ? 'selected' : '' }}>Rumdis</option>
                          </select>
                          @error('status_rumah')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                      </div>
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.show', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection