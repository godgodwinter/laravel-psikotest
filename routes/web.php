<?php

use App\Helpers\Fungsi;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\adminkelascontroller;
use App\Http\Controllers\adminpenggunacontroller;
use App\Http\Controllers\adminsekolahcontroller;
use App\Http\Controllers\adminsemestercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsiswacontroller;
use App\Http\Controllers\admintahunajarancontroller;
use App\Http\Controllers\adminwalikelascontroller;
use App\Http\Controllers\pagesController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

// Route::get('/', [admindashboardcontroller::class, 'index'])->name('dashboard');

//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

    Route::get('/', [admindashboardcontroller::class, 'index'])->name('dashboard');
    Route::get('/admin/settings', [adminsettingscontroller::class, 'index'])->name('settings');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');

    //sekolah
    Route::get('/admin/sekolah', [adminsekolahcontroller::class, 'index'])->name('sekolah');
    Route::get('/admin/sekolah/{id}', [adminsekolahcontroller::class, 'edit'])->name('sekolah.edit');
    Route::put('/admin/sekolah/{id}', [adminsekolahcontroller::class, 'update'])->name('sekolah.update');
    Route::delete('/admin/sekolah/{id}', [adminsekolahcontroller::class, 'destroy'])->name('sekolah.destroy');
    Route::get('/admin/datasekolah/cari', [adminsekolahcontroller::class, 'cari'])->name('sekolah.cari');
    Route::get('/admin/datasekolah/create', [adminsekolahcontroller::class, 'create'])->name('sekolah.create');
    Route::post('/admin/datasekolah', [adminsekolahcontroller::class, 'store'])->name('sekolah.store');
    Route::delete('/admin/datasekolah/multidel', [adminsekolahcontroller::class, 'multidel'])->name('sekolah.multidel');
    Route::get('/admin/sekolah/{id}/detail', [admintahunajarancontroller::class, 'index'])->name('sekolah.show');

    //detailsekolah
    //tahunajaran
    Route::get('/admin/sekolah/{id}/tahun', [admintahunajarancontroller::class, 'index'])->name('sekolah.tahun');
    Route::get('/admin/sekolah/{id}/tahun/create', [admintahunajarancontroller::class, 'create'])->name('sekolah.tahun.create');
    Route::post('/admin/sekolah/{id}/tahun/create', [admintahunajarancontroller::class, 'store'])->name('sekolah.tahun.store');
    Route::get('/admin/sekolah/{id}/tahun/cari', [admintahunajarancontroller::class, 'cari'])->name('sekolah.tahun.cari');
    Route::get('/admin/sekolah/{id}/tahun/{data}', [admintahunajarancontroller::class, 'edit'])->name('sekolah.tahun.edit');
    Route::put('/admin/sekolah/{id}/tahun/{data}', [admintahunajarancontroller::class, 'update'])->name('sekolah.tahun.update');
    Route::delete('/admin/sekolah/{id}/tahun/{data}', [admintahunajarancontroller::class, 'destroy'])->name('sekolah.tahun.destroy');

    
    //semester
    Route::get('/admin/sekolah/{id}/semester', [adminsemestercontroller::class, 'index'])->name('sekolah.semester');
    Route::get('/admin/sekolah/{id}/semester/create', [adminsemestercontroller::class, 'create'])->name('sekolah.semester.create');
    Route::post('/admin/sekolah/{id}/semester/create', [adminsemestercontroller::class, 'store'])->name('sekolah.semester.store');
    Route::get('/admin/sekolah/{id}/semester/cari', [adminsemestercontroller::class, 'cari'])->name('sekolah.semester.cari');
    Route::get('/admin/sekolah/{id}/semester/{data}', [adminsemestercontroller::class, 'edit'])->name('sekolah.semester.edit');
    Route::put('/admin/sekolah/{id}/semester/{data}', [adminsemestercontroller::class, 'update'])->name('sekolah.semester.update');
    Route::delete('/admin/sekolah/{id}/semester/{data}', [adminsemestercontroller::class, 'destroy'])->name('sekolah.semester.destroy');

    
    //siswa
    Route::get('/admin/sekolah/{id}/siswa', [adminsiswacontroller::class, 'index'])->name('sekolah.siswa');
    Route::get('/admin/sekolah/{id}/siswa/create', [adminsiswacontroller::class, 'create'])->name('sekolah.siswa.create');
    Route::post('/admin/sekolah/{id}/siswa/create', [adminsiswacontroller::class, 'store'])->name('sekolah.siswa.store');
    Route::get('/admin/sekolah/{id}/siswa/cari', [adminsiswacontroller::class, 'cari'])->name('sekolah.siswa.cari');
    Route::get('/admin/sekolah/{id}/siswa/{data}', [adminsiswacontroller::class, 'edit'])->name('sekolah.siswa.edit');
    Route::put('/admin/sekolah/{id}/siswa/{data}', [adminsiswacontroller::class, 'update'])->name('sekolah.siswa.update');
    Route::delete('/admin/sekolah/{id}/siswa/{data}', [adminsiswacontroller::class, 'destroy'])->name('sekolah.siswa.destroy');

    
    //walikelas
    Route::get('/admin/sekolah/{id}/walikelas', [adminwalikelascontroller::class, 'index'])->name('sekolah.walikelas');
    Route::get('/admin/sekolah/{id}/walikelas/create', [adminwalikelascontroller::class, 'create'])->name('sekolah.walikelas.create');
    Route::post('/admin/sekolah/{id}/walikelas/create', [adminwalikelascontroller::class, 'store'])->name('sekolah.walikelas.store');
    Route::get('/admin/sekolah/{id}/walikelas/cari', [adminwalikelascontroller::class, 'cari'])->name('sekolah.walikelas.cari');
    Route::get('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'edit'])->name('sekolah.walikelas.edit');
    Route::put('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'update'])->name('sekolah.walikelas.update');
    Route::delete('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'destroy'])->name('sekolah.walikelas.destroy');

      //kelas
      Route::get('/admin/sekolah/{id}/kelas', [adminkelascontroller::class, 'index'])->name('sekolah.kelas');
      Route::get('/admin/sekolah/{id}/kelas/create', [adminkelascontroller::class, 'create'])->name('sekolah.kelas.create');
      Route::post('/admin/sekolah/{id}/kelas/create', [adminkelascontroller::class, 'store'])->name('sekolah.kelas.store');
      Route::get('/admin/sekolah/{id}/kelas/cari', [adminkelascontroller::class, 'cari'])->name('sekolah.kelas.cari');
      Route::get('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'edit'])->name('sekolah.kelas.edit');
      Route::put('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'update'])->name('sekolah.kelas.update');
      Route::delete('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'destroy'])->name('sekolah.kelas.destroy');
  

      
      //pengguna
      Route::get('/admin/sekolah/{id}/pengguna', [adminpenggunacontroller::class, 'index'])->name('sekolah.pengguna');
      Route::get('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'create'])->name('sekolah.pengguna.create');
      Route::post('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'store'])->name('sekolah.pengguna.store');
      Route::get('/admin/sekolah/{id}/pengguna/cari', [adminpenggunacontroller::class, 'cari'])->name('sekolah.pengguna.cari');
      Route::get('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'edit'])->name('sekolah.pengguna.edit');
      Route::put('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'update'])->name('sekolah.pengguna.update');
      Route::delete('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'destroy'])->name('sekolah.pengguna.destroy');
});
