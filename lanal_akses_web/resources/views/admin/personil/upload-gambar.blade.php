@extends('layout.admin.app')

@section('title-page', 'Admin | Upload Foto')

@section('content')
<div class="container">
    <div class="container">
        <h1 class="text-bold">Ganti/Upload Foto Personil</h1>
        <h4 class="mt-3">Ubah foto perseonil dengan ukuran/skala foto 4:3</h4>
            <div class="container bg-white border rounded p-5 mt-4">
                <form action="{{ route('upload.image', ['nrp'=> str_replace('/', '-', $personil->nrp)]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <p class="label">pilih foto dengan resolusi tinggi, format foto wajib jpg, jpeg atau png</p>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" name="image" class="custom-file-input" id="image-upload">
                            <label class="custom-file-label" for="image-upload" id="file-name">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button class="input-group-text btn-primary bg-bluedark text-white" type="submit">Upload Gambar</button>
                        </div>
                    </div>
                    @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('image-upload').addEventListener('change', function () {
                var fileName = this.files[0].name;
                document.getElementById('file-name').textContent = fileName;
            });
        </script>
@endsection