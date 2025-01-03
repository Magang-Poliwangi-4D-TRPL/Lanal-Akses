<?php
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AkunPegawaiController;
use App\Http\Controllers\Admin\AkunPersonilController;
use App\Http\Controllers\Admin\CutiController;
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
use App\Http\Controllers\Admin\PengajuanCutiController;
use App\Http\Controllers\Admin\PerlengkapanController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RiwayatPenugasanController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SanksiHukumanController;
use App\Http\Controllers\Admin\SisaCutiController;
use App\Http\Controllers\Admin\WaktuKerjaController;
use App\Http\Controllers\Personil\DataKepangkatanController as PersonilDataKepangkatanController;
use App\Http\Controllers\Personil\InformasiKeluargaController as PersonilInformasiKeluargaController;
use App\Http\Controllers\Personil\KursusController as PersonilKursusController;
use App\Http\Controllers\Personil\PendidikanFormalController as PersonilPendidikanFormalController;
use App\Http\Controllers\Personil\PendidikanMiliterController as PersonilPendidikanMiliterController;
use App\Http\Controllers\Personil\PersonilController as PersonilPersonilController;
use App\Http\Controllers\Personil\PengajuanCutiController as PersonilPengajuanCutiController;
use App\Http\Controllers\Personil\PerlengkapanController as PersonilPerlengkapanController;
use App\Http\Controllers\Personil\PresensiCotroller;
use App\Http\Controllers\Personil\RiwayatPenugasanController as PersonilRiwayatPenugasanController;
use App\Http\Controllers\Personil\SanksiHukumanController as PersonilSanksiHukumanController;
use App\Http\Controllers\Personil\TandaJasaController as PersonilTandaJasaController;
use App\Http\Controllers\Personil\TanggunganKeluargaController as PersonilTanggunganKeluargaController;
use App\Http\Controllers\Personil\UserController as PersonilUserController;
use App\Http\Controllers\PublicController;
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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Controller untuk Personel 
Route::get('/public/login', [PersonilPersonilController::class, 'login'])->name('personil.login');
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/personel/edit', [PersonilPersonilController::class, 'edit'])->name('personil.edit');
    Route::put('/personel/edit/{nrp}/update', [PersonilPersonilController::class, 'update'])->name('personil.update');

    Route::get('/personel', [PersonilPersonilController::class, 'personilDashboard'])->name('personil.dashboard');

    // Fitur Gambar
    Route::post('/personel/upload/', [PersonilPersonilController::class, 'upload'])->name('personil.upload-gambar');
    Route::get('/personel/upload/', [PersonilPersonilController::class, 'editGambar'])->name('personil.editGambar');

    Route::get('/personel/{nrp}/cetak-riwayat-hidup', [PersonilPersonilController::class, 'cetakRiwayatHidup'])->name('personel.cetak-riwayat-hidup');

    Route::get('/personel/presensi/riwayat-presensi', [PresensiCotroller::class, 'index'])->name('personil.riwayat-presensi');

    // Pengajuan Cuti
    Route::get('/personel/pengajuan-cuti/riwayat-pengajuan-cuti', [PersonilPengajuanCutiController::class, 'index'])->name('personil.pengajuan-cuti.index');
    Route::get('/personel/pengajuan-cuti/riwayat-pengajuan-cuti/create', [PersonilPengajuanCutiController::class, 'create'])->name('personil.pengajuan-cuti.create');
    Route::post('/personel/pengajuan-cuti/riwayat-pengajuan-cuti/store', [PersonilPengajuanCutiController::class, 'store'])->name('personil.pengajuan-cuti.store');
    Route::get('/personel/pengajuan-cuti/riwayat-pengajuan-cuti/{id}', [PersonilPengajuanCutiController::class, 'show'])->name('personil.pengajuan-cuti.detail');
    Route::get('/personel/pengajuan-cuti/cetak-surat-cuti/{id}', [PersonilPengajuanCutiController::class, 'cetak_surat_cuti'])->name('personil.pengajuan-cuti.cetak-surat-cuti');

    // Personil -> PendidikanFormal
    Route::get('/personel/{nrp}/pendidikan-formal', [PersonilPendidikanFormalController::class, 'index'])->name('personel.pendidikanformal.index');
    Route::get('/personel/{nrp}/pendidikan-formal/create', [PersonilPendidikanFormalController::class, 'create'])->name('personel.pendidikanformal.create');
    Route::post('/personel/{nrp}/pendidikan-formal', [PersonilPendidikanFormalController::class, 'store'])->name('personel.pendidikanformal.store');
    Route::get('/personel/{nrp}/pendidikan-formal/{pendidikanFormalId}/edit', [PersonilPendidikanFormalController::class, 'edit'])->name('personel.pendidikanformal.edit');
    Route::put('/personel/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PersonilPendidikanFormalController::class, 'update'])->name('personel.pendidikanformal.update');
    Route::delete('/personel/{nrp}/pendidikan-formal/{pendidikanFormalId}', [PersonilPendidikanFormalController::class, 'destroy'])
    ->name('personel.pendidikanformal.destroy');

    // Personil -> PendidikanMiliter
    Route::get('/personel/{nrp}/pendidikan-militer', [PersonilPendidikanMiliterController::class, 'index'])->name('personel.pendidikanmiliter.index');
    Route::get('/personel/{nrp}/pendidikan-militer/create', [PersonilPendidikanMiliterController::class, 'create'])->name('personel.pendidikanmiliter.create');
    Route::post('/personel/{nrp}/pendidikan-militer', [PersonilPendidikanMiliterController::class, 'store'])->name('personel.pendidikanmiliter.store');
    Route::get('/personel/{nrp}/pendidikan-militer/{pendidikanMiliterId}/edit', [PersonilPendidikanMiliterController::class, 'edit'])->name('personel.pendidikanmiliter.edit');
    Route::put('/personel/{nrp}/pendidikan-militer/{pendidikanMiliterId}', [PersonilPendidikanMiliterController::class, 'update'])->name('personel.pendidikanmiliter.update');
    Route::delete('/personel/{nrp}/pendidikan-militer/{pendidikanMiliterId}', [PersonilPendidikanMiliterController::class, 'destroy'])
    ->name('personel.pendidikanmiliter.destroy');

    // Personil -> Kursus
    Route::get('/personel/{nrp}/kursus', [PersonilKursusController::class, 'index'])->name('personel.kursus.index');
    Route::get('/personel/{nrp}/kursus/create', [PersonilKursusController::class, 'create'])->name('personel.kursus.create');
    Route::post('/personel/{nrp}/kursus', [PersonilKursusController::class, 'store'])->name('personel.kursus.store');
    Route::get('/personel/{nrp}/kursus/{kursusId}/edit', [PersonilKursusController::class, 'edit'])->name('personel.kursus.edit');
    Route::put('/personel/{nrp}/kursus/{kursusId}', [PersonilKursusController::class, 'update'])->name('personel.kursus.update');
    Route::delete('/personel/{nrp}/kursus/{kursusId}', [PersonilKursusController::class, 'destroy'])
    ->name('personel.kursus.destroy');

    // Personil -> TanggunganKeluarga
    Route::get('/personel/{nrp}/tanggungan-keluarga', [PersonilTanggunganKeluargaController::class, 'index'])->name('personel.tanggungan-keluarga.index');
    Route::get('/personel/{nrp}/tanggungan-keluarga/create', [PersonilTanggunganKeluargaController::class, 'create'])->name('personel.tanggungan-keluarga.create');
    Route::post('/personel/{nrp}/tanggungan-keluarga', [PersonilTanggunganKeluargaController::class, 'store'])->name('personel.tanggungan-keluarga.store');
    Route::get('/personel/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}/edit', [PersonilTanggunganKeluargaController::class, 'edit'])->name('personel.tanggungan-keluarga.edit');
    Route::put('/personel/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}', [PersonilTanggunganKeluargaController::class, 'update'])->name('personel.tanggungan-keluarga.update');
    Route::delete('/personel/{nrp}/tanggungan-keluarga/{tanggunganKeluargaId}', [PersonilTanggunganKeluargaController::class, 'destroy'])
    ->name('personel.tanggungan-keluarga.destroy');

    // Personil -> Perlengkapan
    Route::get('/personel/{nrp}/perlengkapan', [PersonilPerlengkapanController::class, 'index'])->name('personel.perlengkapan.index');
    Route::get('/personel/{nrp}/perlengkapan/create', [PersonilPerlengkapanController::class, 'create'])->name('personel.perlengkapan.create');
    Route::post('/personel/{nrp}/perlengkapan', [PersonilPerlengkapanController::class, 'store'])->name('personel.perlengkapan.store');
    Route::get('/personel/{nrp}/perlengkapan/{perlengkapanId}/edit', [PersonilPerlengkapanController::class, 'edit'])->name('personel.perlengkapan.edit');
    Route::put('/personel/{nrp}/perlengkapan/{perlengkapanId}', [PersonilPerlengkapanController::class, 'update'])->name('personel.perlengkapan.update');
    Route::delete('/personel/{nrp}/perlengkapan/{perlengkapanId}', [PersonilPerlengkapanController::class, 'destroy'])
    ->name('personel.perlengkapan.destroy');

    // Personil -> tanda-jasa
    Route::get('/personel/{nrp}/tanda-jasa', [PersonilTandaJasaController::class, 'index'])->name('personel.tanda-jasa.index');
    Route::get('/personel/{nrp}/tanda-jasa/create', [PersonilTandaJasaController::class, 'create'])->name('personel.tanda-jasa.create');
    Route::post('/personel/{nrp}/tanda-jasa', [PersonilTandaJasaController::class, 'store'])->name('personel.tanda-jasa.store');
    Route::get('/personel/{nrp}/tanda-jasa/{tandaJasaId}/edit', [PersonilTandaJasaController::class, 'edit'])->name('personel.tanda-jasa.edit');
    Route::put('/personel/{nrp}/tanda-jasa/{tandaJasaId}', [PersonilTandaJasaController::class, 'update'])->name('personel.tanda-jasa.update');
    Route::delete('/personel/{nrp}/tanda-jasa/{tandaJasaId}', [PersonilTandaJasaController::class, 'destroy'])
    ->name('personel.tanda-jasa.destroy');

    // Personil -> data-kepangkatan
    Route::get('/personel/{nrp}/data-kepangkatan', [PersonilDataKepangkatanController::class, 'index'])->name('personel.data-kepangkatan.index');
    Route::get('/personel/{nrp}/data-kepangkatan/create', [PersonilDataKepangkatanController::class, 'create'])->name('personel.data-kepangkatan.create');
    Route::post('/personel/{nrp}/data-kepangkatan', [PersonilDataKepangkatanController::class, 'store'])->name('personel.data-kepangkatan.store');
    Route::get('/personel/{nrp}/data-kepangkatan/{dataKepangkatanId}/edit', [PersonilDataKepangkatanController::class, 'edit'])->name('personel.data-kepangkatan.edit');
    Route::put('/personel/{nrp}/data-kepangkatan/{dataKepangkatanId}', [PersonilDataKepangkatanController::class, 'update'])->name('personel.data-kepangkatan.update');
    Route::delete('/personel/{nrp}/data-kepangkatan/{dataKepangkatanId}', [PersonilDataKepangkatanController::class, 'destroy'])
    ->name('personel.data-kepangkatan.destroy');

    // Personil -> riwayat-penugasan
    Route::get('/personel/{nrp}/riwayat-penugasan', [PersonilRiwayatPenugasanController::class, 'index'])->name('personel.riwayat-penugasan.index');
    Route::get('/personel/{nrp}/riwayat-penugasan/create', [PersonilRiwayatPenugasanController::class, 'create'])->name('personel.riwayat-penugasan.create');
    Route::post('/personel/{nrp}/riwayat-penugasan', [PersonilRiwayatPenugasanController::class, 'store'])->name('personel.riwayat-penugasan.store');
    Route::get('/personel/{nrp}/riwayat-penugasan/{riwayatPenugasanId}/edit', [PersonilRiwayatPenugasanController::class, 'edit'])->name('personel.riwayat-penugasan.edit');
    Route::put('/personel/{nrp}/riwayat-penugasan/{riwayatPenugasanId}', [PersonilRiwayatPenugasanController::class, 'update'])->name('personel.riwayat-penugasan.update');
    Route::delete('/personel/{nrp}/riwayat-penugasan/{riwayatPenugasanId}', [PersonilRiwayatPenugasanController::class, 'destroy'])
    ->name('personel.riwayat-penugasan.destroy');

    // Personil -> sanksi-hukuman
    Route::get('/personel/{nrp}/sanksi-hukuman', [PersonilSanksiHukumanController::class, 'index'])->name('personel.sanksi-hukuman.index');
    Route::get('/personel/{nrp}/sanksi-hukuman/create', [PersonilSanksiHukumanController::class, 'create'])->name('personel.sanksi-hukuman.create');
    Route::post('/personel/{nrp}/sanksi-hukuman', [PersonilSanksiHukumanController::class, 'store'])->name('personel.sanksi-hukuman.store');
    Route::get('/personel/{nrp}/sanksi-hukuman/{sanksiHukumanId}/edit', [PersonilSanksiHukumanController::class, 'edit'])->name('personel.sanksi-hukuman.edit');
    Route::put('/personel/{nrp}/sanksi-hukuman/{sanksiHukumanId}', [PersonilSanksiHukumanController::class, 'update'])->name('personel.sanksi-hukuman.update');
    Route::delete('/personel/{nrp}/sanksi-hukuman/{sanksiHukumanId}', [PersonilSanksiHukumanController::class, 'destroy'])
    ->name('personel.sanksi-hukuman.destroy');

    // Personil -> Informasi Keluarga
    Route::get('/personel/{nrp}/informasi-keluarga', [PersonilInformasiKeluargaController::class, 'index'])->name('personel.informasi-keluarga.index');
        // Personil -> Informasi Keluarga
        Route::get('/personel/{nrp}/informasi-keluarga/create-informasi-pasangan', [PersonilInformasiKeluargaController::class, 'createInformasiPasangan'])->name('personel.informasi-pasangan.create');
        Route::post('/personel/{nrp}/informasi-keluarga/create-informasi-pasangan', [PersonilInformasiKeluargaController::class, 'storeInformasiPasangan'])->name('personel.informasi-pasangan.store');
        Route::get('/personel/{nrp}/informasi-keluarga/edit-informasi-pasangan/{informasiPasanganId}', [PersonilInformasiKeluargaController::class, 'editInformasiPasangan'])->name('personel.informasi-pasangan.edit');
        Route::put('/personel/{nrp}/informasi-keluarga/edit-informasi-pasangan/{informasiPasanganId}', [PersonilInformasiKeluargaController::class, 'updateInformasiPasangan'])->name('personel.informasi-pasangan.update');
        Route::delete('/personel/{nrp}/informasi-keluarga/delete-informasi-pasangan/{informasiPasanganId}', [PersonilInformasiKeluargaController::class, 'deleteInformasiPasangan'])->name('personel.informasi-pasangan.delete');
        // Personil -> Informasi Anak
        Route::get('/personel/{nrp}/informasi-keluarga/create-informasi-anak', [PersonilInformasiKeluargaController::class, 'createInformasiAnak'])->name('personel.informasi-anak.create');
        Route::post('/personel/{nrp}/informasi-keluarga/create-informasi-anak', [PersonilInformasiKeluargaController::class, 'storeInformasiAnak'])->name('personel.informasi-anak.store');
        Route::get('/personel/{nrp}/informasi-keluarga/edit-informasi-anak/{informasiAnakId}', [PersonilInformasiKeluargaController::class, 'editInformasiAnak'])->name('personel.informasi-anak.edit');
        Route::put('/personel/{nrp}/informasi-keluarga/edit-informasi-anak/{informasiAnakId}', [PersonilInformasiKeluargaController::class, 'updateInformasiAnak'])->name('personel.informasi-anak.update');
        Route::delete('/personel/{nrp}/informasi-keluarga/delete-informasi-anak/{informasiAnakId}', [PersonilInformasiKeluargaController::class, 'deleteInformasiAnak'])->name('personel.informasi-anak.delete');
        // Personil -> Informasi Orang Tua
        Route::get('/personel/{nrp}/informasi-keluarga/create-informasi-orang-tua', [PersonilInformasiKeluargaController::class, 'createInformasiOrangTua'])->name('personel.informasi-orang-tua.create');
        Route::post('/personel/{nrp}/informasi-keluarga/create-informasi-orang-tua', [PersonilInformasiKeluargaController::class, 'storeInformasiOrangTua'])->name('personel.informasi-orang-tua.store');
        Route::get('/personel/{nrp}/informasi-keluarga/edit-informasi-orang-tua/{informasiOrangTuaId}', [PersonilInformasiKeluargaController::class, 'editInformasiOrangTua'])->name('personel.informasi-orang-tua.edit');
        Route::put('/personel/{nrp}/informasi-keluarga/edit-informasi-orang-tua/{informasiOrangTuaId}', [PersonilInformasiKeluargaController::class, 'updateInformasiOrangTua'])->name('personel.informasi-orang-tua.update');
        Route::delete('/personel/{nrp}/informasi-keluarga/delete-informasi-orang-tua/{informasiOrangTuaId}', [PersonilInformasiKeluargaController::class, 'deleteInformasiOrangTua'])->name('personel.informasi-orang-tua.delete');

        // User Personel
        Route::get('/personel/{nrp}/akun', [PersonilUserController::class, 'index'])->name('personel.akun.index');
        Route::get('/personel/{nrp}/akun/{akunId}/edit', [PersonilUserController::class, 'edit'])->name('personel.akun.edit');
        Route::put('/personel/{nrp}/akun/{akunId}/update', [PersonilUserController::class, 'update'])->name('personel.akun.update');

});

// ABSENSI
Route::get('/personel/absensi', [PublicController::class, 'absensiPersonil'])->name('personil.absensi');
Route::post('/personel/absensi', [PublicController::class, 'absensiPersonilStore'])->name('personil.absensi.store');
Route::get('/pegawai/absensi', [PublicController::class, 'absensiPegawai'])->name('pegawai.absensi');
Route::post('/pegawai/absensi', [PublicController::class, 'absensiPegawaiStore'])->name('pegawai.absensi.store');
// Route::get('/perizinan', [PersonilPersonilController::class, 'perizinan'])->name('personil.perizinan');

Route::get('/personel/absensi/success-absensi', [PublicController::class, 'absensiSuccess'])->name('absensi.success');
Route::get('/personel/absensi/success-absensi-masuk', [PublicController::class, 'absensiMasukSuccess'])->name('absensi.masuk.success');


// == CONTROLLER FOR ALL ADMIN PAGE ==
Route::group(['middleware' => ['auth:web', 'role:pasmin|kaakun|paspotmar|palaksa|pasintel|kasatkom|pasprogar|danposal|komandan|paset|admin']], function () {
    Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');

    Route::middleware(['role:komandan|paset|admin|pasmin|kaakun|paspotmar|palaksa|pasintel|kasatkom|pasprogar|danposal'])->group(function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        
    });
    Route::get('/admin/create-all-user-pegawai', [DashboardController::class, 'createAllUserPegawai'])->name('admin.dashboard.create.all-user-pegawai');
    Route::get('/admin/create-all-user-personel', [DashboardController::class, 'createAllUserPersonil'])->name('admin.dashboard.create.all-user-personil');


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
    
    Route::group(['middleware' => ['permission:can access all|manage role']], function () {
        Route::get('admin/role', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('admin/role/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('admin/role/create', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('admin/role/edit/{idRole}', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::put('admin/role/edit/{idRole}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('admin/role/{idRole}', [RoleController::class, 'destroy'])->name('admin.role.delete');
    });
    Route::group(['middleware' => ['permission:can access all|manage permission']], function () {
        Route::get('admin/permission', [PermissionController::class, 'index'])->name('admin.permission.index');
        Route::get('admin/permission/create', [PermissionController::class, 'create'])->name('admin.permission.create');
        Route::post('admin/permission/create', [PermissionController::class, 'store'])->name('admin.permission.store');
        Route::get('admin/permission/edit/{idPermission}', [PermissionController::class, 'edit'])->name('admin.permission.edit');
        Route::put('admin/permission/edit/{idPermission}', [PermissionController::class, 'update'])->name('admin.permission.update');
        Route::delete('admin/permission/{idPermission}', [PermissionController::class, 'destroy'])->name('admin.permission.delete');
    });
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
    Route::get('/admin/absensi/index', [AbsensiController::class, 'index'])
    ->name('admin.absensi.index');
    Route::get('/admin/absensi/data-presensi', [AbsensiController::class, 'dataPresensi'])
    ->name('admin.absensi.data-presensi');
    Route::get('/admin/absensi/show/{tanggal_absensi}/{idAnggota}/{status_anggota}', [AbsensiController::class, 'show'])
    ->name('admin.absensi.show');
    Route::get('/admin/absensi/show/{idKehadiran}/edit', [AbsensiController::class, 'edit'])
    ->name('admin.absensi.edit');
    Route::put('/admin/absensi/show/{idKehadiran}/edit', [AbsensiController::class, 'update'])
    ->name('admin.absensi.update');

    // Absensi -> filter
    Route::get('/admin/absensi/filter', [AbsensiController::class, 'filterAbsensi'])
    ->name('admin.absensi.filter');
    Route::post('/admin/absensi/filter', [AbsensiController::class, 'filterAbsensiPost'])
    ->name('admin.absensi.filter.cari');
    Route::get('/admin/absensi/filter/index/{date}', [AbsensiController::class, 'indexFilterAbsensi'])
    ->name('admin.absensi.filter.index');
    
    // filter mingguan
    Route::get('/admin/absensi/filter-mingguan', [AbsensiController::class, 'filterPresensiMingguan'])
    ->name('admin.absensi.filter-mingguan');
    Route::post('/admin/absensi/filter-mingguan/index/', [AbsensiController::class, 'cetakPresensiMingguan'])
    ->name('admin.absensi.filter-mingguan.index');


    Route::get('/admin/absensi/tambah-data-jam-kerja', [WaktuKerjaController::class, 'create'])
    ->name('admin.absensi.data-jam-kerja.create');
    Route::post('/admin/absensi/tambah-data-jam-kerja', [WaktuKerjaController::class, 'store'])
    ->name('admin.absensi.data-jam-kerja.store');
    Route::get('/admin/absensi/edit-data-jam-kerja/{idWaktuKerja}', [WaktuKerjaController::class, 'edit'])
    ->name('admin.absensi.data-jam-kerja.edit');
    Route::put('/admin/absensi/edit-data-jam-kerja/{idWaktuKerja}', [WaktuKerjaController::class, 'update'])
    ->name('admin.absensi.data-jam-kerja.update');

    // Absensi -> Cetak
    Route::get('/admin/absensi/cetak-presensi-bulanan', [AbsensiController::class, 'cetakPresensiBulanan'])->name('admin.absensi.cetak-presensi.bulanan');
    Route::get('/admin/absensi/{date}/cetak-presensi-harian', [AbsensiController::class, 'cetakPresensiHarian'])->name('admin.absensi.cetak-presensi.harian');

    // Absensi -> generate presensi
    Route::get('/admin/absensi/generate-presensi-personel-today/{date}', [AbsensiController::class, 'generatePresensiPersonelToday'])->name('admin.absensi.generate-presensi-personil-today');
    Route::get('/admin/absensi/generate-presensi-pegawai-today/{date}', [AbsensiController::class, 'generatePresensiPegawaiToday'])->name('admin.absensi.generate-presensi-pegawai-today');

    Route::get('/admin/absensi/rekap-data-kemarin', [AbsensiController::class, 'rekapDataYesterday'])->name('admin.absensi.rekap-data-kemarin');
    Route::get('/admin/absensi/hasilkan-data-absensi-besok', [AbsensiController::class, 'hasilkanDataAbsensiBesok'])->name('admin.absensi.hasilkan-data-absensi-besok');

    //data User Admin
    Route::get('/admin/users/all-user/{page}', [UserController::class, 'index'])
    ->name('admin.users.index')
    ->where('page', '[1-9][0-9]*');
    Route::get('/admin/users/personil/{page}', [UserController::class, 'indexPersonil'])
    ->name('admin.akun-personil.index')
    ->where('page', '[1-9][0-9]*');
    Route::get('/admin/users/pegawai/{page}', [UserController::class, 'indexPegawai'])
    ->name('admin.akun-pegawai.index')
    ->where('page', '[1-9][0-9]*');
    Route::get('/admin/users/admin/{page}', [UserController::class, 'indexAdmin'])
    ->name('admin.akun-admin.index')
    ->where('page', '[1-9][0-9]*');

    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');
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

    // Fitur Data Surat Cuti
   
    Route::group(['middleware' => ['permission:can access all', 'role:admin|komandan']], function () {
        Route::get('admin/pengajuan-cuti', [PengajuanCutiController::class, 'index'])->name('admin.surat-cuti.index');
        // Route::get('/admin/pengajuan-cuti/buat', [PengajuanCutiController::class, 'tambah'])->name('admin.surat-cuti.tambah');
        
        Route::put('admin/pengajuan-cuti/edit/{id}', [PengajuanCutiController::class, 'update'])->name('admin.surat-cuti.update');
        Route::get('admin/pengajuan-cuti/edit/{id}', [PengajuanCutiController::class, 'edit'])->name('admin.surat-cuti.edit');
        
        Route::get('admin/pengajuan-cuti/show/{id}', [PengajuanCutiController::class, 'show'])->name('admin.surat-cuti.show');
        Route::post('admin/pengajuan-cuti', [PengajuanCutiController::class, 'store'])->name('admin.surat-cuti.store');
        Route::get('admin/pengajuan-cuti/create', [PengajuanCutiController::class, 'tambah'])->name('admin.surat-cuti.create');

        // Sisa Cuti
        Route::get('admin/sisa-cuti/index', [SisaCutiController::class, 'index'])->name('admin.sisa-cuti.index');
        Route::get('admin/sisa-cuti/create', [SisaCutiController::class, 'create'])->name('admin.sisa-cuti.create');
        Route::get('admin/sisa-cuti/update-all-cuti', [SisaCutiController::class, 'updateAllCuti'])->name('admin.sisa-cuti.update-all-cuti');
        Route::post('admin/sisa-cuti', [SisaCutiController::class, 'store'])->name('admin.sisa-cuti.store');
        Route::get('admin/sisa-cuti/edit/{id}', [SisaCutiController::class, 'edit'])->name('admin.sisa-cuti.edit');
        Route::put('admin/sisa-cuti/edit/{id}', [SisaCutiController::class, 'update'])->name('admin.sisa-cuti.update');
        
        // Jenis Cuti
        Route::get('admin/cuti/index', [CutiController::class, 'index'])->name('admin.cuti.index');
        Route::get('admin/cuti/create', [CutiController::class, 'create'])->name('admin.cuti.create');
        Route::post('admin/cuti/store', [CutiController::class, 'store'])->name('admin.cuti.store');
        Route::get('admin/cuti/edit/{id}', [CutiController::class, 'edit'])->name('admin.cuti.edit');
        Route::put('admin/cuti/edit/{id}', [CutiController::class, 'update'])->name('admin.cuti.update');
        Route::delete('admin/cuti/{id}', [CutiController::class, 'delete'])->name('admin.cuti.delete');
        // // Route::get('admin/cuti/update-all-cuti', [CutiController::class, 'updateAllCuti'])->name('admin.cuti.update-all-cuti');
    });
    
    Route::group(['middleware' => ['role:pasmin|kaakun|paspotmar|palaksa|pasintel|kasatkom|pasprogar|danposal']], function () {
        Route::get('admin/satker/pengajuan-cuti/', [PengajuanCutiController::class, 'indexSatker'])->name('admin.surat-cuti.satker.index');
        Route::get('admin/satker/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'showSatker'])->name('admin.surat-cuti.satker.show');
        Route::post('admin/satker/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'createResponSatker'])->name('admin.surat-cuti.satker.createRespon');
    });

    Route::group(['middleware' => ['role:palaksa']], function () {
        Route::get('admin/palaksa/pengajuan-cuti/', [PengajuanCutiController::class, 'indexPalaksa'])->name('admin.surat-cuti.palaksa.index');
        Route::get('admin/palaksa/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'showPalaksa'])->name('admin.surat-cuti.palaksa.show');
        Route::post('admin/palaksa/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'createResponPalaksa'])->name('admin.surat-cuti.palaksa.createRespon');
    });

    Route::group(['middleware' => ['role:paset']], function () {
        Route::get('admin/sekretaris/pengajuan-cuti/', [PengajuanCutiController::class, 'indexSekretaris'])->name('admin.surat-cuti.sekretaris.index');
        Route::get('admin/sekretaris/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'showSekretaris'])->name('admin.surat-cuti.sekretaris.show');
        Route::post('admin/sekretaris/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'createResponSekretaris'])->name('admin.surat-cuti.sekretaris.createRespon');
        Route::get('admin/sekretaris/pengajuan-cuti/{id}/edit', [PengajuanCutiController::class, 'editNomorSurat'])->name('admin.surat-cuti.sekretaris.editNoSurat');
        Route::put('admin/sekretaris/pengajuan-cuti/{id}/edit', [PengajuanCutiController::class, 'updateNomorSurat'])->name('admin.surat-cuti.sekretaris.updateNoSurat');
    });

    Route::group(['middleware' => ['role:komandan']], function () {
        Route::get('admin/komandan/pengajuan-cuti/', [PengajuanCutiController::class, 'indexKomandan'])->name('admin.surat-cuti.komandan.index');
        Route::get('admin/komandan/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'showKomandan'])->name('admin.surat-cuti.komandan.show');
        Route::post('admin/komandan/pengajuan-cuti/{id}', [PengajuanCutiController::class, 'createResponKomandan'])->name('admin.surat-cuti.komandan.createRespon');
    });

});
