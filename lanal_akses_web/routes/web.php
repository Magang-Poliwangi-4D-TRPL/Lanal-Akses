<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AkunPegawaiController;
use App\Http\Controllers\Admin\AkunPersonilController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\PendidikanFormalController;
use App\Http\Controllers\Admin\PendidikanMiliterController;
use App\Http\Controllers\Admin\PersonilController;
use App\Http\Controllers\Admin\TandaJasaController;
use App\Http\Controllers\Admin\TanggunganKeluargaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DataKepangkatanController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ImagePegawaiController;
use App\Http\Controllers\Admin\InformasiKeluargaController;
use App\Http\Controllers\Admin\PerlengkapanController;
use App\Http\Controllers\Admin\RiwayatPenugasanController;
use App\Http\Controllers\Admin\SanksiHukumanController;
use App\Http\Controllers\Personil\PersonilController as PersonilPersonilController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// controller for all personil & public page 
Route::get('/login', [PersonilPersonilController::class, 'login'])->name('personil.login');
Route::get('/personil', [PersonilPersonilController::class, 'personilDashboard'])->name('personil.dashboard');
Route::get('/personil/edit-profile', [PersonilPersonilController::class, 'edit'])->name('personil.edit');
Route::get('/absensi', [PersonilPersonilController::class, 'absensi'])->name('personil.absensi');
Route::get('/perizinan', [PersonilPersonilController::class, 'perizinan'])->name('personil.perizinan');

// == controlller for all admin page ==

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');


// Personil
Route::get('/admin/personil/{page}', [PersonilController::class, 'index'])
->name('admin.personil.index')
->where('page', '[1-9][0-9]*');
Route::get('/admin/tambah-personil', [PersonilController::class, 'create'])->name('admin.personil.create');
Route::post('/admin/personil/store', [PersonilController::class, 'store'])->name('admin.personil.store');
Route::get('/admin/personil/show/{nrp}', [PersonilController::class, 'show'])->name('admin.personil.show');
Route::get('/admin/personil/show/{nrp}/edit', [PersonilController::class, 'edit'])->name('admin.personil.edit');
Route::put('/admin/personil/show/{nrp}/update', [PersonilController::class, 'update'])->name('admin.personil.update');
Route::get('/admin/personil/search', [PersonilController::class, 'search'])->name('admin.personil.search');
Route::delete('/admin/personil/{id}', [PersonilController::class, 'destroy'])
    ->name('admin.personil.destroy');

// Fitur Gambar
Route::post('/personil/upload/{nrp}', [ImageController::class, 'upload'])->name('personil.upload.image');
Route::get('/personil/upload/{nrp}', [ImageController::class, 'editGambar'])->name('personil.edit-gambar');

// Fitur Cetak
Route::get('/admin/personil/cetak-data-personil', [PersonilController::class, 'cetakDataPersonil'])->name('personil.cetak-data');
Route::get('/admin/personil/{nrp}/cetak-riwayat-hidup', [PersonilController::class, 'cetakRiwayatHidup'])->name('personil.cetak-riwayat-hidup');
Route::get('/admin/personil/{nrp}/cetak-data-lengkap', [PersonilController::class, 'cetakDataLengkap'])->name('personil.cetak-data-lengkap');

// Personil -> PendidikanFormal
Route::get('/admin/personil/show/{nrp}/pendidikan-formal', [PendidikanFormalController::class, 'index'])->name('admin.personil.pendidikanformal.index');
Route::get('/admin/personil/show/{nrp}/pendidikan-formal/create', [PendidikanFormalController::class, 'create'])->name('admin.personil.pendidikanformal.create');
Route::post('/admin/personil/show/{nrp}/pendidikan-formal', [PendidikanFormalController::class, 'store'])->name('admin.personil.pendidikanformal.store');
Route::get('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}/edit', [PendidikanFormalController::class, 'edit'])->name('admin.personil.pendidikanformal.edit');
Route::put('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PendidikanFormalController::class, 'update'])->name('admin.personil.pendidikanformal.update');
Route::delete('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PendidikanFormalController::class, 'destroy'])
->name('admin.personil.pendidikanformal.destroy');

// Personil -> PendidikanMiliter
Route::get('/admin/personil/show/{nrp}/pendidikan-militer', [PendidikanMiliterController::class, 'index'])->name('admin.personil.pendidikanmiliter.index');
Route::get('/admin/personil/show/{nrp}/pendidikan-militer/create', [PendidikanMiliterController::class, 'create'])->name('admin.personil.pendidikanmiliter.create');
Route::post('/admin/personil/show/{nrp}/pendidikan-militer', [PendidikanMiliterController::class, 'store'])->name('admin.personil.pendidikanmiliter.store');
Route::get('/admin/personil/show/{nrp}/pendidikan-militer/{pendidikanMiliterId}/edit', [PendidikanMiliterController::class, 'edit'])->name('admin.personil.pendidikanmiliter.edit');
Route::put('/admin/personil/show/{nrp}/pendidikan-militer/{pendidikanMiliterId}', [PendidikanMiliterController::class, 'update'])->name('admin.personil.pendidikanmiliter.update');
Route::delete('/admin/personil/show/{nrp}/pendidikan-militer/{pendidikanMiliterId}', [PendidikanMiliterController::class, 'destroy'])
->name('admin.personil.pendidikanmiliter.destroy');

// Personil -> Kursus
Route::get('/admin/personil/show/{nrp}/kursus', [KursusController::class, 'index'])->name('admin.personil.kursus.index');
Route::get('/admin/personil/show/{nrp}/kursus/create', [KursusController::class, 'create'])->name('admin.personil.kursus.create');
Route::post('/admin/personil/show/{nrp}/kursus', [KursusController::class, 'store'])->name('admin.personil.kursus.store');
Route::get('/admin/personil/show/{nrp}/kursus/{kursusId}/edit', [KursusController::class, 'edit'])->name('admin.personil.kursus.edit');
Route::put('/admin/personil/show/{nrp}/kursus/{kursusId}', [KursusController::class, 'update'])->name('admin.personil.kursus.update');
Route::delete('/admin/personil/show/{nrp}/kursus/{kursusId}', [KursusController::class, 'destroy'])
->name('admin.personil.kursus.destroy');

// Personil -> TanggunganKeluarga
Route::get('/admin/personil/show/{nrp}/tanggungan-keluarga', [TanggunganKeluargaController::class, 'index'])->name('admin.personil.tanggungan-keluarga.index');
Route::get('/admin/personil/show/{nrp}/tanggungan-keluarga/create', [TanggunganKeluargaController::class, 'create'])->name('admin.personil.tanggungan-keluarga.create');
Route::post('/admin/personil/show/{nrp}/tanggungan-keluarga', [TanggunganKeluargaController::class, 'store'])->name('admin.personil.tanggungan-keluarga.store');
Route::get('/admin/personil/show/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}/edit', [TanggunganKeluargaController::class, 'edit'])->name('admin.personil.tanggungan-keluarga.edit');
Route::put('/admin/personil/show/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}', [TanggunganKeluargaController::class, 'update'])->name('admin.personil.tanggungan-keluarga.update');
Route::delete('/admin/personil/show/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}', [TanggunganKeluargaController::class, 'destroy'])
->name('admin.personil.tanggungan-keluarga.destroy');

// Personil -> Perlengkapan
Route::get('/admin/personil/show/{nrp}/perlengkapan', [PerlengkapanController::class, 'index'])->name('admin.personil.perlengkapan.index');
Route::get('/admin/personil/show/{nrp}/perlengkapan/create', [PerlengkapanController::class, 'create'])->name('admin.personil.perlengkapan.create');
Route::post('/admin/personil/show/{nrp}/perlengkapan', [PerlengkapanController::class, 'store'])->name('admin.personil.perlengkapan.store');
Route::get('/admin/personil/show/{nrp}/perlengkapan/{perlengkapanId}/edit', [PerlengkapanController::class, 'edit'])->name('admin.personil.perlengkapan.edit');
Route::put('/admin/personil/show/{nrp}/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'update'])->name('admin.personil.perlengkapan.update');
Route::delete('/admin/personil/show/{nrp}/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'destroy'])
->name('admin.personil.perlengkapan.destroy');

// Personil -> tanda-jasa
Route::get('/admin/personil/show/{nrp}/tanda-jasa', [TandaJasaController::class, 'index'])->name('admin.personil.tanda-jasa.index');
Route::get('/admin/personil/show/{nrp}/tanda-jasa/create', [TandaJasaController::class, 'create'])->name('admin.personil.tanda-jasa.create');
Route::post('/admin/personil/show/{nrp}/tanda-jasa', [TandaJasaController::class, 'store'])->name('admin.personil.tanda-jasa.store');
Route::get('/admin/personil/show/{nrp}/tanda-jasa/{tandaJasaId}/edit', [TandaJasaController::class, 'edit'])->name('admin.personil.tanda-jasa.edit');
Route::put('/admin/personil/show/{nrp}/tanda-jasa/{tandaJasaId}', [TandaJasaController::class, 'update'])->name('admin.personil.tanda-jasa.update');
Route::delete('/admin/personil/show/{nrp}/tanda-jasa/{tandaJasaId}', [TandaJasaController::class, 'destroy'])
->name('admin.personil.tanda-jasa.destroy');

// Personil -> data-kepangkatan
Route::get('/admin/personil/show/{nrp}/data-kepangkatan', [DataKepangkatanController::class, 'index'])->name('admin.personil.data-kepangkatan.index');
Route::get('/admin/personil/show/{nrp}/data-kepangkatan/create', [DataKepangkatanController::class, 'create'])->name('admin.personil.data-kepangkatan.create');
Route::post('/admin/personil/show/{nrp}/data-kepangkatan', [DataKepangkatanController::class, 'store'])->name('admin.personil.data-kepangkatan.store');
Route::get('/admin/personil/show/{nrp}/data-kepangkatan/{dataKepangkatanId}/edit', [DataKepangkatanController::class, 'edit'])->name('admin.personil.data-kepangkatan.edit');
Route::put('/admin/personil/show/{nrp}/data-kepangkatan/{dataKepangkatanId}', [DataKepangkatanController::class, 'update'])->name('admin.personil.data-kepangkatan.update');
Route::delete('/admin/personil/show/{nrp}/data-kepangkatan/{dataKepangkatanId}', [DataKepangkatanController::class, 'destroy'])
->name('admin.personil.data-kepangkatan.destroy');

// Personil -> riwayat-penugasan
Route::get('/admin/personil/show/{nrp}/riwayat-penugasan', [RiwayatPenugasanController::class, 'index'])->name('admin.personil.riwayat-penugasan.index');
Route::get('/admin/personil/show/{nrp}/riwayat-penugasan/create', [RiwayatPenugasanController::class, 'create'])->name('admin.personil.riwayat-penugasan.create');
Route::post('/admin/personil/show/{nrp}/riwayat-penugasan', [RiwayatPenugasanController::class, 'store'])->name('admin.personil.riwayat-penugasan.store');
Route::get('/admin/personil/show/{nrp}/riwayat-penugasan/{riwayatPenugasanId}/edit', [RiwayatPenugasanController::class, 'edit'])->name('admin.personil.riwayat-penugasan.edit');
Route::put('/admin/personil/show/{nrp}/riwayat-penugasan/{riwayatPenugasanId}', [RiwayatPenugasanController::class, 'update'])->name('admin.personil.riwayat-penugasan.update');
Route::delete('/admin/personil/show/{nrp}/riwayat-penugasan/{riwayatPenugasanId}', [RiwayatPenugasanController::class, 'destroy'])
->name('admin.personil.riwayat-penugasan.destroy');

// Personil -> sanksi-hukuman
Route::get('/admin/personil/show/{nrp}/sanksi-hukuman', [SanksiHukumanController::class, 'index'])->name('admin.personil.sanksi-hukuman.index');
Route::get('/admin/personil/show/{nrp}/sanksi-hukuman/create', [SanksiHukumanController::class, 'create'])->name('admin.personil.sanksi-hukuman.create');
Route::post('/admin/personil/show/{nrp}/sanksi-hukuman', [SanksiHukumanController::class, 'store'])->name('admin.personil.sanksi-hukuman.store');
Route::get('/admin/personil/show/{nrp}/sanksi-hukuman/{sanksiHukumanId}/edit', [SanksiHukumanController::class, 'edit'])->name('admin.personil.sanksi-hukuman.edit');
Route::put('/admin/personil/show/{nrp}/sanksi-hukuman/{sanksiHukumanId}', [SanksiHukumanController::class, 'update'])->name('admin.personil.sanksi-hukuman.update');
Route::delete('/admin/personil/show/{nrp}/sanksi-hukuman/{sanksiHukumanId}', [SanksiHukumanController::class, 'destroy'])
->name('admin.personil.sanksi-hukuman.destroy');

// Personil -> Akun
Route::get('/admin/personil/show/{nrp}/akun', [AkunPersonilController::class, 'index'])->name('admin.personil.akun.index');
Route::get('/admin/personil/show/{nrp}/akun/create', [AkunPersonilController::class, 'create'])->name('admin.personil.akun.create');
Route::post('/admin/personil/show/{nrp}/akun', [AkunPersonilController::class, 'store'])->name('admin.personil.akun.store');
Route::get('/admin/personil/show/{nrp}/akun/{akunId}/edit', [AkunPersonilController::class, 'edit'])->name('admin.personil.akun.edit');
Route::put('/admin/personil/show/{nrp}/akun/{akunId}/update', [AkunPersonilController::class, 'update'])->name('admin.personil.akun.update');
// Route::delete('/admin/personil/show/{nrp}/akun/{akunId}', [AkunPersonilController::class, 'destroy'])
// ->name('admin.personil.akun.destroy');

// Personil -> Informasi Keluarga
Route::get('/admin/personil/show/{nrp}/informasi-keluarga', [InformasiKeluargaController::class, 'index'])->name('admin.personil.informasi-keluarga.index');
    // Personil -> Informasi Keluarga
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-pasangan', [InformasiKeluargaController::class, 'createInformasiPasangan'])->name('admin.personil.informasi-pasangan.create');
    Route::post('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-pasangan', [InformasiKeluargaController::class, 'storeInformasiPasangan'])->name('admin.personil.informasi-pasangan.store');
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-pasangan/{informasiPasanganId}', [InformasiKeluargaController::class, 'editInformasiPasangan'])->name('admin.personil.informasi-pasangan.edit');
    Route::put('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-pasangan/{informasiPasanganId}', [InformasiKeluargaController::class, 'updateInformasiPasangan'])->name('admin.personil.informasi-pasangan.update');
    Route::delete('/admin/personil/show/{nrp}/informasi-keluarga/delete-informasi-pasangan/{informasiPasanganId}', [InformasiKeluargaController::class, 'deleteInformasiPasangan'])->name('admin.personil.informasi-pasangan.delete');
    // Personil -> Informasi Anak
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-anak', [InformasiKeluargaController::class, 'createInformasiAnak'])->name('admin.personil.informasi-anak.create');
    Route::post('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-anak', [InformasiKeluargaController::class, 'storeInformasiAnak'])->name('admin.personil.informasi-anak.store');
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-anak/{informasiAnakId}', [InformasiKeluargaController::class, 'editInformasiAnak'])->name('admin.personil.informasi-anak.edit');
    Route::put('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-anak/{informasiAnakId}', [InformasiKeluargaController::class, 'updateInformasiAnak'])->name('admin.personil.informasi-anak.update');
    Route::delete('/admin/personil/show/{nrp}/informasi-keluarga/delete-informasi-anak/{informasiAnakId}', [InformasiKeluargaController::class, 'deleteInformasiAnak'])->name('admin.personil.informasi-anak.delete');
    // Personil -> Informasi Orang Tua
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-orang-tua', [InformasiKeluargaController::class, 'createInformasiOrangTua'])->name('admin.personil.informasi-orang-tua.create');
    Route::post('/admin/personil/show/{nrp}/informasi-keluarga/create-informasi-orang-tua', [InformasiKeluargaController::class, 'storeInformasiOrangTua'])->name('admin.personil.informasi-orang-tua.store');
    Route::get('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-orang-tua/{informasiOrangTuaId}', [InformasiKeluargaController::class, 'editInformasiOrangTua'])->name('admin.personil.informasi-orang-tua.edit');
    Route::put('/admin/personil/show/{nrp}/informasi-keluarga/edit-informasi-orang-tua/{informasiOrangTuaId}', [InformasiKeluargaController::class, 'updateInformasiOrangTua'])->name('admin.personil.informasi-orang-tua.update');
    Route::delete('/admin/personil/show/{nrp}/informasi-keluarga/delete-informasi-orang-tua/{informasiOrangTuaId}', [InformasiKeluargaController::class, 'deleteInformasiOrangTua'])->name('admin.personil.informasi-orang-tua.delete');

// Absensi
Route::get('/admin/absensi/', [AbsensiController::class, 'index'])
->name('admin.absensi.index');

//data User Admin
Route::get('/admin/users/{page}', [UserController::class, 'index'])
->name('admin.users.index')
->where('page', '[1-9][0-9]*');
Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Data PNS
Route::get('/admin/pegawai/{page}', [PegawaiController::class, 'index'])
    ->name('admin.pegawai.index')
    ->where('page', '[1-9][0-9]*');
Route::get('/admin/pegawai/search', [PegawaiController::class, 'search'])->name('admin.pegawai.search');
Route::get('/admin/tambah-pegawai', [PegawaiController::class, 'create'])
    ->name('admin.pegawai.create'); 
Route::post('/admin/pegawai/store', [PegawaiController::class, 'store'])
    ->name('admin.pegawai.store'); 
Route::delete('/admin/pegawai/{id}', [PegawaiController::class, 'destroy'])
    ->name('admin.pegawai.destroy');
Route::get('/admin/pegawai/{nip}/show', [PegawaiController::class, 'show'])->name('admin.pegawai.show');
Route::get('/admin/pegawai/{nip}/edit', [PegawaiController::class, 'edit'])->name('admin.pegawai.edit');
Route::put('/admin/pegawai/{nip}', [PegawaiController::class, 'update'])->name('admin.pegawai.update');

// Fitur Gambar
Route::post('/pegawai/upload/{nip}', [ImagePegawaiController::class, 'upload'])->name('pegawai.upload.image');
Route::get('/pegawai/upload/{nip}', [ImagePegawaiController::class, 'editGambar'])->name('pegawai.edit-gambar');

// Fitur Cetak
Route::get('/admin/pegawai/cetak-data-pegawai', [PegawaiController::class, 'cetakDataPegawai'])->name('admin.pegawai.cetak-data-pegawai');


// Pegawai -> Akun
Route::get('/admin/pegawai/show/{nip}/akun', [AkunPegawaiController::class, 'index'])->name('admin.pegawai.akun.index');
Route::get('/admin/pegawai/show/{nip}/akun/create', [AkunPegawaiController::class, 'create'])->name('admin.pegawai.akun.create');
Route::post('/admin/pegawai/show/{nip}/akun', [AkunPegawaiController::class, 'store'])->name('admin.pegawai.akun.store');
Route::get('/admin/pegawai/show/{nip}/akun/{akunId}/edit', [AkunPegawaiController::class, 'edit'])->name('admin.pegawai.akun.edit');
Route::put('/admin/pegawai/show/{nip}/akun/{akunId}/update', [AkunPegawaiController::class, 'update'])->name('admin.pegawai.akun.update');
// Route::delete('/admin/pegawai/show/{nip}/akun/{akunId}', [AkunPegawaiController::class, 'destroy'])
// ->name('admin.pegawai.akun.destroy');
