@extends('layout.admin.app')

@section('title-page', 'Admin | Upload Foto')

@section('content')
    <form action="{{ route('upload.image', ['nrp'=> str_replace('/', '-', $personil->nrp)]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">Upload Gambar</button>
    </form>
@endsection