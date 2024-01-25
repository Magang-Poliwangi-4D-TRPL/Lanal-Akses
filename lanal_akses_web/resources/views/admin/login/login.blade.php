@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Absensi')
  
@section('content')
<div class="container bg-white rounded p-4 my-5">
    <div class="container-fluid row m-0 p-0 justify-content-center">
        <div class="col-lg-6 py-auto">
            <div class="container">
                <img src="{{ URL::asset('images/admin/login-illustrasi.png') }}" alt="https://storyset.com/illustration/login/pana#385655FF&hide=&hide=complete" width="100%" height="auto">
                
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 py-5 px-5">
            <h1 class="text-uppercase">Login Admin</h1>
            <div class="container-fluid mt-5 row justify-content-between ">
                <div class="col-md-12 row d-flex align-item-center">
                    <h4 class="p-0 m-0 mt-5 text-uppercase"><b>Masuk dengan Admin akun anda!</b></h4>
                    <p class="py-1 m-0 mb-5 ">Login dengann username dan password anda sekarang untuk mengakses halaman pengelola</p>
                </div>
            </div>
            @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <div class="form-absensi row justify-content-center mt-3">
                <div class="container-fluid">
                    <form method="POST" action="">
                        @csrf
                        
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-text bg-bluedark text-white"><i class="fa-solid fa-user"></i></div>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan NRP/NIP anda">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-text bg-bluedark text-white"><i class="fa-solid fa-lock"></i></div>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Masukkan password anda">
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-secondary btn-md btn-block bg-bluedark">Login <i class="ml-2 fa fa-right-to-bracket"></i></button>
                            <p class="mt-4 mb-0 subtitle">Apakah anda ingin melakukan presensi? <a href="">Klik disini untuk melakukan Presensi</a></p>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
