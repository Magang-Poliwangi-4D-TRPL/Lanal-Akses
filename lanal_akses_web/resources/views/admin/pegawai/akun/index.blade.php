@extends('layout.admin.app')

@section('title-page', 'Pegawai | Akun')

@section('content')
<style>
    .border-all {
        border: 1px solid #5786CA;
    }
</style>
<div class="container">
    <h1 class="text-black my-4">Data Akun {{ $pegawai->nama_pegawai }}</h1>
    <div class="container bg-white border rounded p-5 mt-4">
        <div class="d-flex justify-content-between  my-3">            
            @if($user->count() == 0)
            <a class="text-decoration-none" href="{{ route('admin.pegawai.akun.create', ['nip' => str_replace(' ', '-', $pegawai->nip)]) }}">
                <button class="btn btn-blue btn-md text-white bg-blueaccent">Buat Akun Pegawai<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
            </a>
            @else
            <a class="text-decoration-none" href="{{ route('admin.pegawai.akun.edit', ['nip' => str_replace(' ', '-', $pegawai->nip), 'akunId' => $user[0]->id],) }}">
                <button class="btn btn-blue btn-md text-white bg-bluedark">Edit Akun Pegawai<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
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
                        <p class="mb-0">{{ $user->first()->role }}</p>
                        @endempty
                    </div>
                </div>
            </div>
            
        </div>
        <a class="text-decoration-none" href="{{ route('admin.pegawai.show', str_replace('/', '-', $pegawai->nip)) }}">
            <button class="btn btn-blue btn-sm text-white bg-bluedark m-2" >Kembali ke halaman sebelumnya<span><iconify-icon icon="mdi:back"></iconify-icon></span></button>
        </a>
    </div>
</div>

@endsection