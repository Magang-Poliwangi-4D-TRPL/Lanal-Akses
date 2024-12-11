@extends('layout.admin.app')

@section('title-page', 'Admin | Data Jenis Cuti')

@section('content')
<div class="container ">
    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <div class="container-fluid bg-white border rounded p-4 mt-4 ">
        <div class="container-fluid mt-4 p-0">
            <div class="row p-4 justify-content-between align-item-center">
                <div class="col-md-6 py-auto">
                    <h4 class="h4 text-capitalize">Data Jenis Cuti Personel</h4>
                </div>
                <div class="col-md-6 py-auto text-right">
                    @if(auth()->user()->canany(['can access all']))
                    @if ($dataCutiPersonel->count() != 0)
                    {{-- {{ route('admin.pegawai.create') }} --}}
                    <a href="" class="btn btn-info text-capitalize">Perbarui semua data cuti Personel <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg></a>
                    
                    @else
                    <a href="" class="btn btn-primary text-capitalize">Tambah Batas Cuti Tahunan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg></a>
                    
                    @endif
                    @endif
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <input type="text" id="searchBox" class="form-control" placeholder="Cari Personil...">
                    </div>
                </div>
                <table class="table table-striped" id="dataCutiPersonelTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Personel</th>
                            <th>NIP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dataCuti as $dataCutiItem)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataCutiItem->personil->nama_lengkap }}</td>
                            <td>{{ $dataCutiItem->personil->nip }} hari</td>
                            <td>
                                <a href="" class="btn btn-primary">Edit</a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Data batas cuti belum dibuat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('searchBox').addEventListener('keyup', function() {
        let input = this.value.toLowerCase();
        let table = document.getElementById('dataCutiPersonelTable');
        let tr = table.getElementsByTagName('tr');
        let found = false;

        // Looping untuk cek setiap baris
        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[1]; // kolom nama personil
            if (td) {
                let textValue = td.textContent || td.innerText;
                if (textValue.toLowerCase().indexOf(input) > -1) {
                    tr[i].style.display = '';  // Tampilkan baris jika cocok
                    found = true; // Set flag found jika ada kecocokan
                } else {
                    tr[i].style.display = 'none'; // Sembunyikan baris jika tidak cocok
                }
            }
        }

        // Cek jika tidak ada baris yang ditemukan
        let noResultRow = document.getElementById('noResultRow');
        if (!found) {
            if (!noResultRow) {
                let noResult = document.createElement('tr');
                noResult.id = 'noResultRow';
                noResult.innerHTML = `
                    <td colspan="6" class="text-center">Tidak ada data dari keyword pencarian</td>
                `;
                table.getElementsByTagName('tbody')[0].appendChild(noResult);
            }
        } else {
            if (noResultRow) {
                noResultRow.remove();  // Hapus pesan "tidak ada data" jika ada hasil pencarian
            }
        }
    });
</script>

@endsection