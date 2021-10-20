<?php

use App\Helpers\Fungsi;
use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admindeteksicontroller;
use App\Http\Controllers\admingrafikcontroller;
use App\Http\Controllers\admininformasipsikologicontroller;
use App\Http\Controllers\admininputnilaipsikologicontroller;
use App\Http\Controllers\adminkelascontroller;
use App\Http\Controllers\adminmasternilaibidangstudicontroller;
use App\Http\Controllers\adminmasternilaipsikologicontroller;
use App\Http\Controllers\adminminatbakatcontroller;
use App\Http\Controllers\adminpenggunacontroller;
use App\Http\Controllers\adminreferensicontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminsekolahcontroller;
use App\Http\Controllers\adminsemestercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsiswacontroller;
use App\Http\Controllers\admintahunajarancontroller;
use App\Http\Controllers\adminuserscontroller;
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
    Route::get('/admin/sekolah/{id}/detail', [adminsekolahcontroller::class, 'show'])->name('sekolah.show');


    //User
    Route::get('/admin/users', [adminuserscontroller::class, 'index'])->name('users');
    Route::get('/admin/users/{id}', [adminuserscontroller::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminuserscontroller::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [adminuserscontroller::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/datausers/cari', [adminuserscontroller::class, 'cari'])->name('users.cari');
    Route::get('/admin/datausers/create', [adminuserscontroller::class, 'create'])->name('users.create');
    Route::post('/admin/datausers', [adminuserscontroller::class, 'store'])->name('users.store');
    Route::delete('/admin/datausers/multidel', [adminuserscontroller::class, 'multidel'])->name('users.multidel');

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


    //inputnilaipsikologi
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi', [admininputnilaipsikologicontroller::class, 'index'])->name('sekolah.inputnilaipsikologi');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/create', [admininputnilaipsikologicontroller::class, 'create'])->name('sekolah.inputnilaipsikologi.create');
    Route::post('/admin/sekolah/{id}/inputnilaipsikologi/create', [admininputnilaipsikologicontroller::class, 'store'])->name('sekolah.inputnilaipsikologi.store');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/cari', [admininputnilaipsikologicontroller::class, 'cari'])->name('sekolah.inputnilaipsikologi.cari');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'edit'])->name('sekolah.inputnilaipsikologi.edit');
    Route::put('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'update'])->name('sekolah.inputnilaipsikologi.update');
    Route::delete('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'destroy'])->name('sekolah.inputnilaipsikologi.destroy');


      //pengguna
      Route::get('/admin/sekolah/{id}/pengguna', [adminpenggunacontroller::class, 'index'])->name('sekolah.pengguna');
      Route::get('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'create'])->name('sekolah.pengguna.create');
      Route::post('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'store'])->name('sekolah.pengguna.store');
      Route::get('/admin/sekolah/{id}/pengguna/cari', [adminpenggunacontroller::class, 'cari'])->name('sekolah.pengguna.cari');
      Route::get('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'edit'])->name('sekolah.pengguna.edit');
      Route::put('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'update'])->name('sekolah.pengguna.update');
      Route::delete('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'destroy'])->name('sekolah.pengguna.destroy');

      //referensi
      Route::get('/admin/referensi', [adminreferensicontroller::class, 'index'])->name('referensi');
      Route::get('/admin/referensi/create', [adminreferensicontroller::class, 'create'])->name('referensi.create');
      Route::post('/admin/referensi/create', [adminreferensicontroller::class, 'store'])->name('referensi.store');
      Route::get('/admin/referensi/cari', [adminreferensicontroller::class, 'cari'])->name('referensi.cari');
      Route::get('/admin/referensi/edit/{data}', [adminreferensicontroller::class, 'edit'])->name('referensi.edit');
      Route::put('/admin/referensi/update/{data}', [adminreferensicontroller::class, 'update'])->name('referensi.update');
      Route::delete('/admin/referensi/delete/{data}', [adminreferensicontroller::class, 'destroy'])->name('referensi.destroy');
      Route::delete('/admin/datareferensi/multidel', [adminreferensicontroller::class, 'multidel'])->name('referensi.multidel');


      //informasipsikologi
      Route::get('/admin/informasipsikologi', [admininformasipsikologicontroller::class, 'index'])->name('informasipsikologi');
      Route::get('/admin/informasipsikologi/create', [admininformasipsikologicontroller::class, 'create'])->name('informasipsikologi.create');
      Route::post('/admin/informasipsikologi/create', [admininformasipsikologicontroller::class, 'store'])->name('informasipsikologi.store');
      Route::get('/admin/informasipsikologi/cari', [admininformasipsikologicontroller::class, 'cari'])->name('informasipsikologi.cari');
      Route::get('/admin/informasipsikologi/edit/{data}', [admininformasipsikologicontroller::class, 'edit'])->name('informasipsikologi.edit');
      Route::put('/admin/informasipsikologi/update/{data}', [admininformasipsikologicontroller::class, 'update'])->name('informasipsikologi.update');
      Route::delete('/admin/informasipsikologi/delete/{data}', [admininformasipsikologicontroller::class, 'destroy'])->name('informasipsikologi.destroy');
      Route::delete('/admin/datainformasipsikologi/multidel', [admininformasipsikologicontroller::class, 'multidel'])->name('informasipsikologi.multidel');

      //deteksi
      Route::get('/admin/sekolah/{id}/deteksi', [admindeteksicontroller::class, 'index'])->name('sekolah.deteksi');
      Route::get('/admin/sekolah/{id}/deteksi/create', [admindeteksicontroller::class, 'create'])->name('sekolah.deteksi.create');
      Route::post('/admin/sekolah/{id}/deteksi/create', [admindeteksicontroller::class, 'store'])->name('sekolah.deteksi.store');
      Route::get('/admin/sekolah/{id}/deteksi/cari', [admindeteksicontroller::class, 'cari'])->name('sekolah.deteksi.cari');
      Route::get('/admin/sekolah/{id}/deteksi/{data}', [admindeteksicontroller::class, 'edit'])->name('sekolah.deteksi.edit');
      Route::put('/admin/sekolah/{id}/deteksi/{data}', [admindeteksicontroller::class, 'update'])->name('sekolah.deteksi.update');
      Route::delete('/admin/sekolah/{id}/deteksi/{data}', [admindeteksicontroller::class, 'destroy'])->name('sekolah.deteksi.destroy');

      //masternilaipsikologi
      Route::get('/admin/masternilaipsikologi', [adminmasternilaipsikologicontroller::class, 'index'])->name('masternilaipsikologi');
      Route::get('/admin/masternilaipsikologi/create', [adminmasternilaipsikologicontroller::class, 'create'])->name('masternilaipsikologi.create');
      Route::post('/admin/masternilaipsikologi/create', [adminmasternilaipsikologicontroller::class, 'store'])->name('masternilaipsikologi.store');
      Route::get('/admin/masternilaipsikologi/cari', [adminmasternilaipsikologicontroller::class, 'cari'])->name('masternilaipsikologi.cari');
      Route::get('/admin/masternilaipsikologi/{data}', [adminmasternilaipsikologicontroller::class, 'edit'])->name('masternilaipsikologi.edit');
      Route::put('/admin/masternilaipsikologi/{data}', [adminmasternilaipsikologicontroller::class, 'update'])->name('masternilaipsikologi.update');
      Route::delete('/admin/masternilaipsikologi/{data}', [adminmasternilaipsikologicontroller::class, 'destroy'])->name('masternilaipsikologi.destroy');
      Route::delete('/admin/masternilaipsikologi', [adminmasternilaipsikologicontroller::class, 'multidel'])->name('masternilaipsikologi.multidel');


      //minatbakat
      Route::get('/admin/minatbakat', [adminminatbakatcontroller::class, 'index'])->name('minatbakat');
      Route::get('/admin/minatbakat/create', [adminminatbakatcontroller::class, 'create'])->name('minatbakat.create');
      Route::post('/admin/minatbakat/create', [adminminatbakatcontroller::class, 'store'])->name('minatbakat.store');
      Route::get('/admin/minatbakat/cari', [adminminatbakatcontroller::class, 'cari'])->name('minatbakat.cari');
      Route::get('/admin/minatbakat/{data}', [adminminatbakatcontroller::class, 'edit'])->name('minatbakat.edit');
      Route::put('/admin/minatbakat/{data}', [adminminatbakatcontroller::class, 'update'])->name('minatbakat.update');
      Route::delete('/admin/minatbakat/{data}', [adminminatbakatcontroller::class, 'destroy'])->name('minatbakat.destroy');
      Route::delete('/admin/minatbakat', [adminminatbakatcontroller::class, 'multidel'])->name('minatbakat.multidel');




      //masternilaibidangstudi
      Route::get('/admin/sekolah/{id}/masternilaibidangstudi', [adminmasternilaibidangstudicontroller::class, 'index'])->name('sekolah.masternilaibidangstudi');
      Route::get('/admin/sekolah/{id}/masternilaibidangstudi/create', [adminmasternilaibidangstudicontroller::class, 'create'])->name('sekolah.masternilaibidangstudi.create');
      Route::post('/admin/sekolah/{id}/masternilaibidangstudi/create', [adminmasternilaibidangstudicontroller::class, 'store'])->name('sekolah.masternilaibidangstudi.store');
      Route::get('/admin/sekolah/{id}/masternilaibidangstudi/cari', [adminmasternilaibidangstudicontroller::class, 'cari'])->name('sekolah.masternilaibidangstudi.cari');
      Route::get('/admin/sekolah/{id}/masternilaibidangstudi/{data}', [adminmasternilaibidangstudicontroller::class, 'edit'])->name('sekolah.masternilaibidangstudi.edit');
      Route::put('/admin/sekolah/{id}/masternilaibidangstudi/{data}', [adminmasternilaibidangstudicontroller::class, 'update'])->name('sekolah.masternilaibidangstudi.update');
      Route::delete('/admin/sekolah/{id}/masternilaibidangstudi/{data}', [adminmasternilaibidangstudicontroller::class, 'destroy'])->name('sekolah.masternilaibidangstudi.destroy');
      Route::delete('/admin/sekolah/{id}/masternilaibidangstudi/{data}', [adminmasternilaibidangstudicontroller::class, 'destroy'])->name('sekolah.masternilaibidangstudi.destroy');


        // Proses
      Route::get('admin/datasekolah/export', 'App\Http\Controllers\prosescontroller@exportsekolah')->name('sekolah.export');
      Route::post('admin/datasekolah/import', 'App\Http\Controllers\prosescontroller@importsekolah')->name('sekolah.import');

      Route::post('admin/datasekolah/importdetailsekolah/{id}', 'App\Http\Controllers\prosescontroller@importdetailsekolah')->name('detailsekolah.import');



        Route::post('admin/cleartemp', 'App\Http\Controllers\prosescontroller@cleartemp')->name('cleartemp');

        // API
        Route::get('/admin/api/inputnilaipsikologi', [adminapicontroller::class, 'inputnilaipsikologi'])->name('api.inputnilaipsikologi');

        //Seeder
        Route::post('/admin/seeder/sekolah', [adminseedercontroller::class, 'sekolah'])->name('seeder.sekolah');
        Route::post('/admin/seeder/masternilaipsikologi', [adminseedercontroller::class, 'masternilaipsikologi'])->name('seeder.masternilaipsikologi');
        Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

        //Example
        Route::get('/admin/example/grafik', [admingrafikcontroller::class, 'ex'])->name('testing.grafik');

});
