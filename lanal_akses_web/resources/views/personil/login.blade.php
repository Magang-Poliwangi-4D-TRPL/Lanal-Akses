@extends('layout.absensi.app')

@section('title-page', 'Lanal Akses | Login')
  
@section('content')
<div class="container bg-white rounded p-4 my-5">
    <div class="container-fluid row m-0 p-0">
        <div class="col-lg-5 col-sm-6 m-0 p-0 bg-bluedark rounded" id="left-section">
            <div class="bg-bluedark rounded-top" style="height: 15%"></div>
            <div class="image-container rounded" style="height: 70%">
                <!-- Background image goes here -->
                <div class="text-overlay">
                    <h2>LANAL AKSES</h2>
                    <p>Website informasi administrasi dan absensi seluruh anggota Lanal Banyuwangi</p>
                </div>
            </div>
            <div class="bg-bluedark rounded-bottom" style="height: 15%"></div>
        </div>
    
        <div class="col-lg-7 col-sm-6 py-5 px-5">
            <h1 class="text-uppercase">Login LANAL AKSES</h1>
            <div class="container-fluid mt-5 row justify-content-between ">
                <img class="col-md-6" src="{{ URL::asset('images/admin/login-illustrasi.png') }}" alt="https://storyset.com/illustration/login/pana#385655FF&hide=&hide=complete" width="50%" height="auto">
                <div class="col-md-6 row d-flex align-item-center">
                    <h4 class="p-0 m-0 mt-5 text-uppercase"><b>Masuk dengan akun anda!</b></h4>
                    <p class="py-1 m-0 mb-5 ">Login dengann nrp dan password anda skarang untuk melihat informasi administrasi anda</p>
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
                <div class="container">
                    {{-- {{ route('login.post') }} --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-text bg-bluedark text-white"><i class="fa-solid fa-user"></i></div>
                                    <input type="text" class="form-control @error('input_type') is-invalid @enderror" id="input_type" name="input_type" value="{{ old('input_type') }}" placeholder="Masukkan username atau email anda">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-text bg-bluedark text-white"><i class="fa-solid fa-lock"></i></div>
                                    <input type="password"  class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password') }}" placeholder="Masukkan password anda">
                                    <div style="cursor: pointer" class="input-group-text bg-secondary text-white" id="show-password"><i class="fa-solid fa-eye-slash"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-secondary btn-md btn-block bg-bluedark">Login <i class="ml-2 fa fa-right-to-bracket"></i></button>
                            <p class="mt-4 mb-0 subtitle">Apakah anda ingin melakukan presensi? <a href="{{ route('personil.absensi') }}">Klik disini untuk melakukan Presensi</a></p>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    const passwordInput = document.querySelector("#password");
    const show_password = document.querySelector("#show-password");

    show_password.addEventListener('click', function (e) {
        // mengubah type input pada passwordInput
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        if (type === 'text') {
            show_password.querySelector('i').classList.remove('fa-eye-slash');
            show_password.querySelector('i').classList.add('fa-eye');
        } else {
            show_password.querySelector('i').classList.remove('fa-eye');
            show_password.querySelector('i').classList.add('fa-eye-slash');
        }
    });
</script>
@endsection
