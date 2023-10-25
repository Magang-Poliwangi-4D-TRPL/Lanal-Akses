<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\PendidikanFormalController;
use App\Http\Controllers\Admin\PendidikanMiliterController;
use App\Http\Controllers\Admin\PersonilController;
use App\Http\Controllers\Admin\TanggunganKeluargaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PerlengkapanController;
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
});

Route::get('/personil', function () {
    return view('personil.dashboard');
});

Route::get('personil/editprofile', function () {
    return view('personil.editprofile');
});


// == controlller for all admin page ==

Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');


// Personil
Route::get('/admin/personil/{page}', [PersonilController::class, 'index'])
->name('admin.personil.index')
->where('page', '[1-9][0-9]*');
Route::get('/admin/tambah-personil', [PersonilController::class, 'create'])->name('admin.personil.create');
Route::post('/admin/personil/store', [PersonilController::class, 'store'])->name('admin.personil.store');
Route::get('/admin/personil/show/{nrp}', [PersonilController::class, 'show'])->name('admin.personil.show');
Route::get('/admin/personil/search', [PersonilController::class, 'search'])->name('admin.personil.search');
Route::delete('/admin/personil/{id}', [PersonilController::class, 'destroy'])
    ->name('admin.personil.destroy');

// Personil -> PendidikanFormal
Route::get('/admin/personil/show/{nrp}/pendidikan-formal', [PendidikanFormalController::class, 'index'])->name('admin.personil.pendidikanformal.index');
Route::get('/admin/personil/show/{nrp}/pendidikan-formal/create', [PendidikanFormalController::class, 'create'])->name('admin.personil.pendidikanformal.create');
Route::post('/admin/personil/show/{nrp}/pendidikan-formal', [PendidikanFormalController::class, 'store'])->name('admin.personil.pendidikanformal.store');
Route::get('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}/edit', [PendidikanFormalController::class, 'edit'])->name('admin.personil.pendidikanformal.edit');
Route::put('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PendidikanFormalController::class, 'update'])->name('admin.personil.pendidikanformal.update');
Route::delete('/admin/personil/show/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PendidikanFormalController::class, 'destroy'])
->name('admin.personil.pendidikanformal.destroy');
// Route::get('/admin/pendidikan-formal', [PendidikanFormalController::class, 'index2'])->name('admin.personil.pendidikanformal.index2');

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
// Route::put('/admin/personil/show/{nrp}/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'update'])->name('admin.personil.perlengkapan.update');
Route::delete('/admin/personil/show/{nrp}/perlengkapan/{perlengkapanId}', [PerlengkapanController::class, 'destroy'])
->name('admin.personil.perlengkapan.destroy');


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
Route::get('/admin/tambah-pegawai', [PegawaiController::class, 'create'])
    ->name('admin.pegawai.create'); // Ubah dari 'pegawai.create' menjadi 'admin.pegawai.create'
Route::post('/admin/pegawai/store', [PegawaiController::class, 'store'])
    ->name('admin.pegawai.store'); // Ubah dari 'pegawai.store' menjadi 'admin.pegawai.store'
Route::delete('/admin/pegawai/{id}', [PegawaiController::class, 'destroy'])
    ->name('admin.pegawai.destroy');


