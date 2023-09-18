<?php

use App\Http\Controllers\PersonilController;
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

Route::get('/admin/personil/{page}', [PersonilController::class, 'index'])->name('admin.personil.index');
Route::get('/admin/personil/show/{nrp}', [PersonilController::class, 'show'])->name('admin.personil.show');;
