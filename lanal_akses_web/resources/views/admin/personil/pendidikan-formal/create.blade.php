@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Pendidikan Formal Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Pendidikan Formal</h1>
            <h4 class="mt-3">Tambahkan data pendidikan formal personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.pendidikanformal.store', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    <div class="form-group">
                      <label for="nama_pendidikan">Massukkan nama pendidikan baru</label>
                      <input type="text" class="form-control" id="nama_pendidikan" name="nama_pendidikan" required placeholder="Nama Pendidikan">
                    </div>
                    <div class="form-group">
                      <label for="lama_pendidikan">Massukkan lama pendidikan baru</label>
                      <input type="text" class="form-control" id="lama_pendidikan" name="lama_pendidikan" required placeholder="Lama Pendidikan (x tahun)">
                    </div>
                    <div class="form-group">
                      <label for="tahun_lulus">Massukkan tahun lulus pendidikan baru</label>
                      <input type="text" class="form-control" id="tahun_lulus" name="tahun_lulus" required placeholder="Tahun Lulus (xxxx)">
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control" id="keterangan" name="keterangan" required placeholder="Keterangan">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection