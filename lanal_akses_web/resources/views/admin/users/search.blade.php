@extends('layout.admin.app')

@section('title-page', 'Admin | Cari Akun')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container" style="padding: 0 20px;">
            <h1>Hasil Pencarian Akun</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        
                        <!-- /.card-header -->
                        <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="table-responsive custom-table">
                            @if ($users->count()!=0)
                            <p>Hasil Pencarian {{ $query }}</p>
                            <table class="table table-bordered table-hover">
                                <thead class="table-blue" style="background-color: #0D21A1;">
                                    <tr>
                                        <th style="color: #ffffff;">Nama Lengkap</th>
                                        <th style="color: #ffffff;">Username</th>
                                        <th style="color: #ffffff;">Role</th>
                                        <th style="color: #ffffff;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->nama_lengkap }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            @else
                                <p>Hasil Pencarian {{ $query }} tidak ada</p>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-blue" style="background-color: #0D21A1;">
                                        <tr>
                                            <th style="color: #ffffff;">Nama Lengkap</th>
                                            <th style="color: #ffffff;">Username</th>
                                            <th style="color: #ffffff;">Role</th>
                                            <th style="color: #ffffff;">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            @endif
                            
                            </div>
                        </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container -->
    </section>
    <!-- /.content -->
@endsection
