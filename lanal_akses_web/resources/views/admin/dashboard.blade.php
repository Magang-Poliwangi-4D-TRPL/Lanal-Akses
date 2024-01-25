@extends('layout.admin.app')

@section('title-page', 'Admin | Dashboard')

@section('content')

<div class="container">
  <div class="container">
    <div class="card-columns mx-auto">
      <div class="card bg-bluemain">
        <div class="card-body ">
          <h5 class="card-title text-white">JUMLAH PERSONEL</h5>
          <p class="card-text mb-4 text-white">Jumlah Data Personel :</p>
          <h2 class="text-center text-white">{{ $personil->count() }}</h2>
        </div>
      </div>
      
      <div class="card bg-blueaccent ">
        <div class="card-body ">
          <h5 class="card-title text-white">JUMLAH PNS</h5>
          <p class="card-text mb-4 text-white">Jumlah Seluruh PNS :</p>
          <h2 class="text-center text-white">{{ $pns->count() }}</h2>
          </div>
      </div>
      
    </div> 
    
    <div class="container-fluid py-4 px-0 my-4">
      <a href="{{ route('admin.dashboard.create.all-user-personil') }}" class="btn-fluid btn-lg mr-2 bg-white border btn-light" style="border-width: 4px !important; border-color: #7EBFFF !important
      ">Buat akun untuk seluruh personel<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></a>
        
        {{-- {{ route('admin.dashboard.create.all-user-pegawai') }} --}}
      <a href="{{ route('admin.dashboard.create.all-user-pegawai') }}" class="btn-fluid btn-lg mr-2 bg-white border btn-light" style="border-width: 4px !important; border-color: #5786CA !important
      ">Buat akun untuk seluruh pegawai<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></a>
        
      
    </div>

    <div class="container bg-white mt-4 p-4" style=" padding-top: 3rem !important;">
        <h1 class="text-black">Hasilkan Qr-Code</h1>
        <p class="muted-text">Cetak semua QR-Code berdasarkan kode unik PNS/Personel</p>

        <div class="card-columns">
          <div class="card">
            <div class="card-body ">
              <h5 class="card-title">DATA PERSONEL</h5>
              <p class="card-text ">Total data Personel :</p>
              <div class="container border-bottom mb-4 mt-2">
                <p class="text-muted text-center">{{ $personil->count() }}</p>
              </div>
              <p class="text-subtitle">
                Cetak Semua QR-Code 
              </p>
              <button class="btn btn-lg text-white bg-bluemain" type="submit" style="height: 5rem; width: 100%"><iconify-icon class="mt-2" icon="ph:qr-code-bold" width="36"></iconify-icon></button>
            </div>
          </div>
          
            <div class="card">
              <div class="card-body ">
                <h5 class="card-title">DATA PNS</h5>
                <p class="card-text ">Total data PNS :</p>
                <div class="container border-bottom mb-4 mt-2">
                  <p class="text-muted text-center">{{ $pns->count() }}</p>
                </div>
                <p class="text-subtitle">
                  Cetak Semua QR-Code 
                </p>
                <button class="btn btn-lg text-white bg-blueaccent" type="submit" style="height: 5rem; width: 100%"><span><iconify-icon class="my-3" width="36" icon="ph:qr-code-bold"></iconify-icon></span></button>
              </div>
            </div>
         
        </div>
    
      </div>
    </div>

    
    
</div>


@endsection