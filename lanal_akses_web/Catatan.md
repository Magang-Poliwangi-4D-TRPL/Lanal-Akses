<p align="center"><a href="https://imgbb.com/"><img src="https://i.ibb.co/MR438ww/logo-no-bg.png" alt="logo-no-bg" border="0"></a></p>

# Catatan untuk semua kebutuhan website

    definisikan semua kebutuhan website disini, tulis berdasarkan fitur perhalaman

halaman tampilan [UI website dan android](https://www.figma.com/file/kKbj42KxYo4Xh9eJWaSiwK/Absensi-LANAL-Banyuwangi?type=design&node-id=1%3A318&mode=design&t=48KxVjoChwJERDt9-1)

## Database
- ERD

## Frontend
- chart
- animation perpage

## Backend
- qr-code generator
- API


## Halaman Personil

### Halaman Absensi
### Halaman Perizinan
### Halaman Login
### Halaman Dashboard
### Halaman Profile
### Halaman Edit Profile
### Halaman Ubah password
### Halaman Cetak Riwayat Hidup

## Halaman Admin
## Notifikasi
    belum membuat notifikasi sukses membuat data, gagal membuat data, data tidak ditemukan, sukses menghapus data, sukses mengubah data, pencarian ditemukan, pencarian gagal ditemukan, gagal mengambil data, koneksi sambungan terputus, database error, kolom tidak ditemukan, tabel tidak ditemukan 
## Layouting
- navbar ✅
    - membuat tombol search di bagian navbar
    - membuat avatar admin dan dropdown di avatar admin
- sidebar ✅
    - membuat active link icon dan tombol menggunakan laravel conditional formating
    - membuat collapse sidebar menggunakan javascript 
    - membuat sidebar responsive
- footer ✅
    - membuat tampilan footer responsive
    - membuat linked text di social media dan alamat
- wrap content✅

### Halaman Dashboard
Informasi seluruh data personil

```php
PersonilModel::all()
```
Informasi seluruh data pns

```php
// Belum Buat
```


### Halaman Personil
#### Index Personil
Tabel personil memiliki relasi dengan user untuk menampilkan avatar image dan username dan password personil.
nrp pada tabel personil adalah unique.
tabel personil memiliki relasi dengan pendidikan militer, pendidikan formal, kursus, tanggungan keluarga, data perlengkapan, data tanda jasa, data kepangkatan, riwayat tempat penugasan, data sanksi hukuman data istri dan data keluarga

paginatiaon diatur dalam controller dengan mengambil 10 data perseluruh baris dalam tabel personil menggunakan perintah 
    
```php
PersonilModel::skip($offset)->take($perPage)->get();
```
     
dan navigasi diatur menggunakan logika if dengan variabel fisrtNav, lastNav, totalPage

```php
$totalPersonil = PersonilModel::count();
$totalPages = ceil($totalPersonil / $perPage);

// Hitung batasan angka navigasi
$maxNavLinks = 5;
$halfMaxLinks = floor($maxNavLinks / 2);
$firstNav = max(1, $page - $halfMaxLinks);
$lastNav = min($totalPages, $firstNav + $maxNavLinks - 1);
```

#### Show Personil
special user role: Komandan, Paset
- bisa mencetak RH dan data detail personil, 
- bisa mengubah password dan username personil
- bisa mengedit data lengkap personil
- bisa mengubah foto personil
- bisa menghapus data personil

common user role: Paspotmar, Kaakun, Pasintel, Pasminlog, 
- mencetak RH personil
- melihat data personil tanpa melihat username dan password personil
### Halaman Absensi

### Halaman PNS

### Halaman Admin
halaman admin untuk mengelola akses masuk ke tampilan semua controller dengan menggunakan login akun yang berbeda dengan akun personil. Admin disini memiliki beberapa role dan hak ases antara lain:

#### komandan
- membuat QRcode untuk absensi
- mengedit profile admin
- membuat, menghapus dan mengedit semua akun admin dan personil
- mencetak RH dan data lengkap personil
- mencari data personil
- membuat, menghapus, mengedit dan melihat seluruh data personil
- mengedit data lengkap personil
- membuat, menghapus, mengedit dan melihat seluruh data pns
- mengedit data lengkap pns


### personil
- dashboard
- edit data personil
- login personil
- absen personil

### admin
- login ke akun admin