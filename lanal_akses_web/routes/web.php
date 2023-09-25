<?php

use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\PersonilController;
use App\Http\Controllers\Admin\UserController;
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

// == controlller for all admin page ==

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/admin/personil/{page}', [PersonilController::class, 'index'])
->name('admin.personil.index')
->where('page', '[1-9][0-9]*');
Route::get('/admin/tambah-personil', [PersonilController::class, 'add'])->name('admin.personil.add');
Route::post('/admin/personil/store', [PersonilController::class, 'store'])->name('admin.personil.store');
Route::get('/admin/personil/show/{nrp}', [PersonilController::class, 'show'])->name('admin.personil.show');
Route::get('/admin/personil/search', [PersonilController::class, 'search'])->name('admin.personil.search');
Route::delete('/admin/personil/{id}', [PersonilController::class, 'destroy'])
    ->name('admin.personil.destroy');


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

