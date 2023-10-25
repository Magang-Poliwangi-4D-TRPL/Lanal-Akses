@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Perlengkapan Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Perlengkapan</h1>
            <h4 class="mt-3">Tambahkan data perlengkapan personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.perlengkapan.store', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group row">
                        <label for="baju" class="col-sm-3 col-form-label">Pilih Ukuran Baju</label>
                        <div class="col-sm-3">
                            <select class="form-control  @error('baju') is-invalid @enderror" name="baju" id="baju">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="XXXL">XXXL</option>
                            </select>
                            @error('baju')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>

                        <label for="celana" class="col-sm-3 col-form-label">Pilih Ukuran Celana</label>
                        <div class="col-sm-3">
                            <select class="form-control  @error('celana') is-invalid @enderror" name="celana" id="celana">
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="XXL">XXL</option>
                                <option value="XXXL">XXXL</option>
                            </select>
                            @error('celana')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-grup">

                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="sameValueCelana">
                          <label class="form-check-label" for="sameValueCelana">
                            ukuran baju dan celana sama
                          </label>
                        </div>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var checkboxCelana = document.getElementById("sameValueCelana");
                            var bajuField = document.getElementById("baju");
                            var celanaField = document.getElementById("celana");
                    
                            // Tambahkan event listener ke checkboxCelana
                            checkboxCelana.addEventListener("change", function () {
                                if (checkboxCelana.checked) {
                                    // CheckboxCelana diisi, ubah field "celana" menjadi sama dengan "baju"
                                    celanaField.value = bajuField.value;
                                    celanaField.disabled = true
                                    // Tambahkan event listener ke field "baju" untuk mengikuti perubahan nilai
                                    bajuField.addEventListener("input", function () {
                                        if (checkboxCelana.checked) {
                                            // Jika checkbox diisi, update nilai "celana" saat "baju" berubah
                                            celanaField.value = bajuField.value;
                                        }
                                    });
                                } else {
                                    // CheckboxCelana tidak diisi, kembalikan field "celana" ke kondisi normal
                                    celanaField.disabled = false
                                    celanaField.value = checkboxCelana.value;
                                }
                            });
                    
                        });
                    </script>
                    
                    <div class="mt-3 form-group">
                        <label for="no_sepatu">Masukkan ukuran sepatu</label>
                        <input type="number" class="form-control @error('no_sepatu') is-invalid @enderror" id="no_sepatu" name="no_sepatu" value="{{ old('no_sepatu')}}" placeholder="Ukuran Sepatu" autofocus>
                        @error('no_sepatu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div> 
                    <div class="form-group row">
                        <label for="no_topi" class="col-sm-3 col-form-label">Masukkan ukuran topi</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('no_topi') is-invalid @enderror" id="no_topi" name="no_topi" value="{{ old('no_topi')}}" placeholder="Ukuran Topi" autofocus>
                            @error('no_topi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    
                        <label for="no_mut" class="col-sm-3 col-form-label">Masukkan ukuran MUT</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('no_mut') is-invalid @enderror" id="no_mut" name="no_mut" value="{{ old('no_mut')}}" placeholder="Ukuran MUT" autofocus>
                            @error('no_mut')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="sameValueMUT">
                        <label class="form-check-label" for="sameValueMUT">
                          Sama dengan ukuran Topi
                        </label>
                    </div> 
                    <div class="mt-3 form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan')}}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.perlengkapan.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection