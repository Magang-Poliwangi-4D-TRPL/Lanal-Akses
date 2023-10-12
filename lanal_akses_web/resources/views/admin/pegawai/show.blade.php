@extends('layout.admin.app')

@section('title-page', 'Admin | Data PNS')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Detail Pegawai PNS</div>

                <div class="card-body">
                    <div class="profile">
                        <div class="profile-image">
                            <!-- Tambahkan gambar profil pegawai jika ada -->
                            <!-- <img src="{{ asset('path-to-profile-image.jpg') }}" alt="Profile Image"> -->
                        </div>
                        <div class="profile-info">
                            <h2 class="profile-name">{{ $pegawai->nama_pegawai }}</h2>
                            <div class="profile-details">
                                <div class="detail-item">
                                    <strong>NIP:</strong> {{ $pegawai->nip }}
                                </div>
                                <div class="detail-item">
                                    <strong>Jabatan:</strong> {{ $pegawai->jabatan }}
                                </div>
                                <div class="detail-item">
                                    <strong>Golongan:</strong> {{ $pegawai->golongan }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
