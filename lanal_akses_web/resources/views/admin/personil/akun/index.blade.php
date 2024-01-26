@extends('layout.admin.app')

@section('title-page', 'Personil | Akun')

@section('content')
<style>
    .border-all {
        border: 1px solid #5786CA;
    }
</style>
<div class="container">
    <h1 class="text-black my-4">Data Akun {{ $personil->nama_lengkap }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">            
            @if($user->count() == 0)
            <a class="text-decoration-none" href="{{ route('admin.personil.akun.create', ['nrp' => str_replace('/', '-', $personil->nrp)]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Buat Akun Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
            @else
            <a class="text-decoration-none" href="{{ route('admin.personil.akun.edit', ['nrp' => str_replace('/', '-', $personil->nrp), 'akunId' => $user[0]->id],) }}">
                <button class="btn btn-blue btn-md text-white bg-bluedark">Edit Akun Personil<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
            @endif
        </div>
        
        <div class="bg-white">
            <div class="container row my-3">
                <div class="col-4">
                    <p class="p-2 m-0">Username</p>
                </div>
                <div class="col-8">
                    <div class="container m-0 p-2 rounded border-all">
                        @empty($user->isNotEmpty())
                        <p class='mb-0'>_</p>
                        @else
                        <p class="mb-0">{{ $user->first()->username }}</p>
                        @endempty
                    </div>
                </div>
            </div>
            <div class="container row my-3">
                <div class="col-4">
                    <p class="p-2 m-0">Role</p>
                </div>
                <div class="col-8">
                    <div class="container m-0 p-2 rounded border-all">
                        @empty($user->isNotEmpty())
                        <p class='mb-0'>_</p>
                        @else
                        <p class="mb-0">{{ $user->first()->getRoleNames()->first() }}</p>
                        @endempty
                    </div>
                </div>
            </div>
            
        </div>
        <a class="text-decoration-none" href="{{ route('admin.personil.show', str_replace('/', '-', $personil->nrp)) }}">
            <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
        </a>
    </div>
</div>

@endsection