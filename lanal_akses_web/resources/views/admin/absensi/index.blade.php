@extends('layout.admin.app')

@section('title-page', 'Admin | Data Personil')

@section('content')
    <style>
        .active{
            text-decoration: underline;
            color: #0D21A1!important;
        }
        .pagination a{
            color: gray;
        }
    </style>
    <div class="container">
        <h1 class="text-black my-4">Data Personil</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            <p>data absensi hari ini</p>
        </div>
    </div>
@endsection