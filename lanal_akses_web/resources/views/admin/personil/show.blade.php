@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <div class="container">
        <h1>{{ $personil->nama_lengkap }}</h1>
        
    </div>

@endsection