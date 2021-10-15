<?php

use App\Helpers\Fungsi;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\adminsekolahcontroller;
use App\Http\Controllers\adminsettingscontroller;
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
    // Route::get('/admin/datasekolah/{id}', [adminsekolahcontroller::class, 'show'])->name('sekolah.show');
    Route::get('/admin/datasekolah/create', [adminsekolahcontroller::class, 'create'])->name('sekolah.create');
    Route::post('/admin/datasekolah', [adminsekolahcontroller::class, 'store'])->name('sekolah.store');
    Route::delete('/admin/datasekolah/multidel', [adminsekolahcontroller::class, 'multidel'])->name('sekolah.multidel');
});
