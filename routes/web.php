<?php

use App\Helpers\Fungsi;
use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admincatatankasuscontroller;
use App\Http\Controllers\admincatatanpengembangandiricontroller;
use App\Http\Controllers\admincatatanprestasicontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admindeteksicontroller;
use App\Http\Controllers\admingrafikcontroller;
use App\Http\Controllers\adminhasilpsikologicontroller;
use App\Http\Controllers\admininformasipsikologicontroller;
use App\Http\Controllers\admininputminatbakatcontroller;
use App\Http\Controllers\admininputnilaipsikologicontroller;
use App\Http\Controllers\adminkelascontroller;
use App\Http\Controllers\adminklasifikasijabatancontroller;
use App\Http\Controllers\adminmasternilaibidangstudicontroller;
use App\Http\Controllers\adminmasternilaipsikologicontroller;
use App\Http\Controllers\adminminatbakatcontroller;
use App\Http\Controllers\adminpenggunacontroller;
use App\Http\Controllers\adminpenjurusancontroller;
use App\Http\Controllers\adminreferensicontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminsekolahcontroller;
use App\Http\Controllers\adminsemestercontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\adminsiswacontroller;
use App\Http\Controllers\admintahunajarancontroller;
use App\Http\Controllers\adminuserscontroller;
use App\Http\Controllers\adminwalikelascontroller;
use App\Http\Controllers\adminyayasancontroller;
use App\Http\Controllers\adminyayasandetailcontroller;
use App\Http\Controllers\bkberandacontroller;
use App\Http\Controllers\bkberandanonaktifcontroller;
use App\Http\Controllers\bkcetakcontroller;
use App\Http\Controllers\bkgrafikcontroller;
use App\Http\Controllers\bkinputnilaipsikologicontroller;
use App\Http\Controllers\bkkelascontroller;
use App\Http\Controllers\bkpenggunacontroller;
use App\Http\Controllers\bksiswacontroller;
use App\Http\Controllers\bkwalikelascontroller;
use App\Http\Controllers\bkcatatankasussiswacontroller;
use App\Http\Controllers\bkcatatanpengembangandirisiswacontroller;
use App\Http\Controllers\bkcatatanprestasisiswacontroller;
use App\Http\Controllers\bkinputminatbakatcontroller;
use App\Http\Controllers\bkpenjurusancontroller;
use App\Http\Controllers\bksettingpenggunacontroller;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\prosescontroller;
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
    Route::get('/admin/profile', [adminsettingscontroller::class, 'profile'])->name('profile');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');
    Route::put('/admin/profile/{id}', [adminsettingscontroller::class, 'updateprofile'])->name('profile.update');

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
    Route::delete('/admin/sekolah/siswa/multidel/{id}', [adminsiswacontroller::class, 'multidel'])->name('sekolah.siswa.multidel');


    //walikelas
    Route::get('/admin/sekolah/{id}/walikelas', [adminwalikelascontroller::class, 'index'])->name('sekolah.walikelas');
    Route::get('/admin/sekolah/{id}/walikelas/create', [adminwalikelascontroller::class, 'create'])->name('sekolah.walikelas.create');
    Route::post('/admin/sekolah/{id}/walikelas/create', [adminwalikelascontroller::class, 'store'])->name('sekolah.walikelas.store');
    Route::get('/admin/sekolah/{id}/walikelas/cari', [adminwalikelascontroller::class, 'cari'])->name('sekolah.walikelas.cari');
    Route::get('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'edit'])->name('sekolah.walikelas.edit');
    Route::put('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'update'])->name('sekolah.walikelas.update');
    Route::delete('/admin/sekolah/{id}/walikelas/{data}', [adminwalikelascontroller::class, 'destroy'])->name('sekolah.walikelas.destroy');
    Route::delete('/admin/sekolah/walikelas/multidel/{id}', [adminwalikelascontroller::class, 'multidel'])->name('sekolah.walikelas.multidel');

      //kelas
      Route::get('/admin/sekolah/{id}/kelas', [adminkelascontroller::class, 'index'])->name('sekolah.kelas');
      Route::get('/admin/sekolah/{id}/kelas/create', [adminkelascontroller::class, 'create'])->name('sekolah.kelas.create');
      Route::post('/admin/sekolah/{id}/kelas/create', [adminkelascontroller::class, 'store'])->name('sekolah.kelas.store');
      Route::get('/admin/sekolah/{id}/kelas/cari', [adminkelascontroller::class, 'cari'])->name('sekolah.kelas.cari');
      Route::get('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'edit'])->name('sekolah.kelas.edit');
      Route::put('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'update'])->name('sekolah.kelas.update');
      Route::delete('/admin/sekolah/{id}/kelas/{data}', [adminkelascontroller::class, 'destroy'])->name('sekolah.kelas.destroy');
      Route::delete('/admin/sekolah/kelas/multidel/{id}', [adminkelascontroller::class, 'multidel'])->name('sekolah.kelas.multidel');


    //inputnilaipsikologi
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi', [admininputnilaipsikologicontroller::class, 'index'])->name('sekolah.inputnilaipsikologi');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/create', [admininputnilaipsikologicontroller::class, 'create'])->name('sekolah.inputnilaipsikologi.create');
    Route::post('/admin/sekolah/{id}/inputnilaipsikologi/create', [admininputnilaipsikologicontroller::class, 'store'])->name('sekolah.inputnilaipsikologi.store');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/cari', [admininputnilaipsikologicontroller::class, 'cari'])->name('sekolah.inputnilaipsikologi.cari');
    Route::get('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'edit'])->name('sekolah.inputnilaipsikologi.edit');
    Route::put('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'update'])->name('sekolah.inputnilaipsikologi.update');
    Route::delete('/admin/sekolah/{id}/inputnilaipsikologi/{data}', [admininputnilaipsikologicontroller::class, 'destroy'])->name('sekolah.inputnilaipsikologi.destroy');

    //inputminatbakat
    Route::get('/admin/sekolah/{id}/inputminatbakat', [admininputminatbakatcontroller::class, 'index'])->name('sekolah.inputminatbakat');
    Route::get('/admin/sekolah/{id}/inputminatbakat/create', [admininputminatbakatcontroller::class, 'create'])->name('sekolah.inputminatbakat.create');
    Route::post('/admin/sekolah/{id}/inputminatbakat/create', [admininputminatbakatcontroller::class, 'store'])->name('sekolah.inputminatbakat.store');
    Route::get('/admin/sekolah/{id}/inputminatbakat/cari', [admininputminatbakatcontroller::class, 'cari'])->name('sekolah.inputminatbakat.cari');
    Route::get('/admin/sekolah/{id}/inputminatbakat/{siswa}', [admininputminatbakatcontroller::class, 'edit'])->name('sekolah.inputminatbakat.edit');
    Route::put('/admin/sekolah/{id}/inputminatbakat/{siswa}', [admininputminatbakatcontroller::class, 'update'])->name('sekolah.inputminatbakat.update');
    Route::delete('/admin/sekolah/{id}/inputminatbakat/{data}', [admininputminatbakatcontroller::class, 'destroy'])->name('sekolah.inputminatbakat.destroy');
    //export
    Route::get('/admin/datainputminatbakat/{id}/export', [admininputminatbakatcontroller::class, 'export'])->name('sekolah.inputminatbakat.export');
    //import
    Route::post('/admin/datainputminatbakat/{id}/import',[admininputminatbakatcontroller::class, 'import'])->name('sekolah.inputminatbakat.import');
    Route::get('/admin/sekolah/{id}/datainputminatbakat/cetak/{siswa}', [admininputminatbakatcontroller::class, 'cetakpersiswa'])->name('sekolah.inputminatbakat.cetakpersiswa');



    //penjurusan
    Route::get('/admin/sekolah/{id}/penjurusan', [adminpenjurusancontroller::class, 'index'])->name('sekolah.penjurusan');
    Route::get('/admin/sekolah/{id}/penjurusan/cari', [adminpenjurusancontroller::class, 'cari'])->name('sekolah.penjurusan.cari');
    Route::get('/admin/sekolah/{id}/penjurusan/{siswa}', [adminpenjurusancontroller::class, 'edit'])->name('sekolah.penjurusan.edit');
    Route::put('/admin/sekolah/{id}/penjurusan/{siswa}', [adminpenjurusancontroller::class, 'update'])->name('sekolah.penjurusan.update');
    Route::get('/admin/sekolah/{id}/penjurusan/cetak/{siswa}', [adminpenjurusancontroller::class, 'cetakpersiswa'])->name('sekolah.penjurusan.cetakpersiswa');

    //hasilpsikologi
    Route::get('/admin/sekolah/{id}/hasilpsikologi', [adminhasilpsikologicontroller::class, 'index'])->name('sekolah.hasilpsikologi');
    Route::get('/admin/sekolah/{id}/hasilpsikologi/create', [adminhasilpsikologicontroller::class, 'create'])->name('sekolah.hasilpsikologi.create');
    Route::post('/admin/sekolah/{id}/hasilpsikologi/create', [adminhasilpsikologicontroller::class, 'store'])->name('sekolah.hasilpsikologi.store');
    Route::get('/admin/sekolah/{id}/hasilpsikologi/cari', [adminhasilpsikologicontroller::class, 'cari'])->name('sekolah.hasilpsikologi.cari');
    Route::get('/admin/sekolah/{id}/hasilpsikologi/{data}', [adminhasilpsikologicontroller::class, 'edit'])->name('sekolah.hasilpsikologi.edit');
    Route::put('/admin/sekolah/{id}/hasilpsikologi/{data}', [adminhasilpsikologicontroller::class, 'update'])->name('sekolah.hasilpsikologi.update');
    Route::delete('/admin/sekolah/{id}/hasilpsikologi/{data}', [adminhasilpsikologicontroller::class, 'destroy'])->name('sekolah.hasilpsikologi.destroy');
    //export
    Route::get('/admin/datahasilpsikologi/{id}/export', [adminhasilpsikologicontroller::class, 'export'])->name('sekolah.hasilpsikologi.export');
    //import
    Route::post('/admin/datahasilpsikologi/{id}/import',[adminhasilpsikologicontroller::class, 'import'])->name('sekolah.hasilpsikologi.import');


    //catatankasus
    Route::get('/admin/sekolah/{id}/catatankasus', [admincatatankasuscontroller::class, 'index'])->name('sekolah.catatankasus');
    Route::get('/admin/sekolah/{id}/catatankasus/create', [admincatatankasuscontroller::class, 'create'])->name('sekolah.catatankasus.create');
    Route::post('/admin/sekolah/{id}/catatankasus/create', [admincatatankasuscontroller::class, 'store'])->name('sekolah.catatankasus.store');
    Route::get('/admin/sekolah/{id}/catatankasus/cari', [admincatatankasuscontroller::class, 'cari'])->name('sekolah.catatankasus.cari');
    Route::get('/admin/sekolah/{id}/catatankasus/{data}', [admincatatankasuscontroller::class, 'edit'])->name('sekolah.catatankasus.edit');
    Route::put('/admin/sekolah/{id}/catatankasus/{data}', [admincatatankasuscontroller::class, 'update'])->name('sekolah.catatankasus.update');
    Route::delete('/admin/sekolah/{id}/catatankasus/{data}', [admincatatankasuscontroller::class, 'destroy'])->name('sekolah.catatankasus.destroy');
    Route::delete('/admin/sekolah/catatankasus/multidel/{id}', [admincatatankasuscontroller::class, 'multidel'])->name('sekolah.catatankasus.multidel');
    Route::get('/admin/sekolah/{id}/catatankasus/cetak/{data}', [admincatatankasuscontroller::class, 'cetakpersiswa'])->name('sekolah.catatankasus.cetakpersiswa');
    Route::get('/admin/sekolah/{id}/catatankasus/preview/{data}', [admincatatankasuscontroller::class, 'preview'])->name('sekolah.catatankasus.preview');

    //catatanpengembangandiri
    Route::get('/admin/sekolah/{id}/catatanpengembangandiri', [admincatatanpengembangandiricontroller::class, 'index'])->name('sekolah.catatanpengembangandiri');
    Route::get('/admin/sekolah/{id}/catatanpengembangandiri/create', [admincatatanpengembangandiricontroller::class, 'create'])->name('sekolah.catatanpengembangandiri.create');
    Route::post('/admin/sekolah/{id}/catatanpengembangandiri/create', [admincatatanpengembangandiricontroller::class, 'store'])->name('sekolah.catatanpengembangandiri.store');
    Route::get('/admin/sekolah/{id}/catatanpengembangandiri/cari', [admincatatanpengembangandiricontroller::class, 'cari'])->name('sekolah.catatanpengembangandiri.cari');
    Route::get('/admin/sekolah/{id}/catatanpengembangandiri/{data}', [admincatatanpengembangandiricontroller::class, 'edit'])->name('sekolah.catatanpengembangandiri.edit');
    Route::put('/admin/sekolah/{id}/catatanpengembangandiri/{data}', [admincatatanpengembangandiricontroller::class, 'update'])->name('sekolah.catatanpengembangandiri.update');
    Route::delete('/admin/sekolah/{id}/catatanpengembangandiri/{data}', [admincatatanpengembangandiricontroller::class, 'destroy'])->name('sekolah.catatanpengembangandiri.destroy');
    Route::delete('/admin/sekolah/catatanpengembangandiri/multidel/{id}', [admincatatanpengembangandiricontroller::class, 'multidel'])->name('sekolah.catatanpengembangandiri.multidel');
    Route::get('/admin/sekolah/{id}/catatanpengembangandiri/cetak/{data}', [admincatatanpengembangandiricontroller::class, 'cetakpersiswa'])->name('sekolah.catatanpengembangandiri.cetakpersiswa');


    //catatanprestasi
    Route::get('/admin/sekolah/{id}/catatanprestasi', [admincatatanprestasicontroller::class, 'index'])->name('sekolah.catatanprestasi');
    Route::get('/admin/sekolah/{id}/catatanprestasi/create', [admincatatanprestasicontroller::class, 'create'])->name('sekolah.catatanprestasi.create');
    Route::post('/admin/sekolah/{id}/catatanprestasi/create', [admincatatanprestasicontroller::class, 'store'])->name('sekolah.catatanprestasi.store');
    Route::get('/admin/sekolah/{id}/catatanprestasi/cari', [admincatatanprestasicontroller::class, 'cari'])->name('sekolah.catatanprestasi.cari');
    Route::get('/admin/sekolah/{id}/catatanprestasi/{data}', [admincatatanprestasicontroller::class, 'edit'])->name('sekolah.catatanprestasi.edit');
    Route::put('/admin/sekolah/{id}/catatanprestasi/{data}', [admincatatanprestasicontroller::class, 'update'])->name('sekolah.catatanprestasi.update');
    Route::delete('/admin/sekolah/{id}/catatanprestasi/{data}', [admincatatanprestasicontroller::class, 'destroy'])->name('sekolah.catatanprestasi.destroy');
    Route::delete('/admin/sekolah/catatanprestasi/multidel/{id}', [admincatatanprestasicontroller::class, 'multidel'])->name('sekolah.catatanprestasi.multidel');
    Route::get('/admin/sekolah/{id}/catatanprestasi/cetak/{data}', [admincatatanprestasicontroller::class, 'cetakpersiswa'])->name('sekolah.catatanprestasi.cetakpersiswa');


      //pengguna
      Route::get('/admin/sekolah/{id}/pengguna', [adminpenggunacontroller::class, 'index'])->name('sekolah.pengguna');
      Route::get('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'create'])->name('sekolah.pengguna.create');
      Route::post('/admin/sekolah/{id}/pengguna/create', [adminpenggunacontroller::class, 'store'])->name('sekolah.pengguna.store');
      Route::get('/admin/sekolah/{id}/pengguna/cari', [adminpenggunacontroller::class, 'cari'])->name('sekolah.pengguna.cari');
      Route::get('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'edit'])->name('sekolah.pengguna.edit');
      Route::put('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'update'])->name('sekolah.pengguna.update');
      Route::delete('/admin/sekolah/{id}/pengguna/{data}', [adminpenggunacontroller::class, 'destroy'])->name('sekolah.pengguna.destroy');
      Route::delete('/admin/sekolah/pengguna/multidel/{id}', [adminpenggunacontroller::class, 'multidel'])->name('sekolah.pengguna.multidel');

      //klasifikasijabatan
      Route::get('/admin/klasifikasijabatan', [adminklasifikasijabatancontroller::class, 'index'])->name('klasifikasijabatan');
      Route::get('/admin/klasifikasijabatan/create', [adminklasifikasijabatancontroller::class, 'create'])->name('klasifikasijabatan.create');
      Route::post('/admin/klasifikasijabatan/create', [adminklasifikasijabatancontroller::class, 'store'])->name('klasifikasijabatan.store');
      Route::get('/admin/klasifikasijabatan/cari', [adminklasifikasijabatancontroller::class, 'cari'])->name('klasifikasijabatan.cari');
      Route::get('/admin/klasifikasijabatan/edit/{data}', [adminklasifikasijabatancontroller::class, 'edit'])->name('klasifikasijabatan.edit');
      Route::put('/admin/klasifikasijabatan/update/{data}', [adminklasifikasijabatancontroller::class, 'update'])->name('klasifikasijabatan.update');
      Route::delete('/admin/klasifikasijabatan/delete/{data}', [adminklasifikasijabatancontroller::class, 'destroy'])->name('klasifikasijabatan.destroy');
      Route::delete('/admin/dataklasifikasijabatan/multidel', [adminklasifikasijabatancontroller::class, 'multidel'])->name('klasifikasijabatan.multidel');


      //referensi
      Route::get('/admin/referensi', [adminreferensicontroller::class, 'index'])->name('referensi');
      Route::get('/admin/referensi/create', [adminreferensicontroller::class, 'create'])->name('referensi.create');
      Route::post('/admin/referensi/create', [adminreferensicontroller::class, 'store'])->name('referensi.store');
      Route::get('/admin/referensi/cari', [adminreferensicontroller::class, 'cari'])->name('referensi.cari');
      Route::get('/admin/referensi/edit/{data}', [adminreferensicontroller::class, 'edit'])->name('referensi.edit');
      Route::put('/admin/referensi/update/{data}', [adminreferensicontroller::class, 'update'])->name('referensi.update');
      Route::delete('/admin/referensi/delete/{data}', [adminreferensicontroller::class, 'destroy'])->name('referensi.destroy');
      Route::delete('/admin/datareferensi/multidel', [adminreferensicontroller::class, 'multidel'])->name('referensi.multidel');


      //yayasan
      Route::get('/admin/yayasan', [adminyayasancontroller::class, 'index'])->name('yayasan');
      Route::get('/admin/yayasan/create', [adminyayasancontroller::class, 'create'])->name('yayasan.create');
      Route::post('/admin/yayasan/create', [adminyayasancontroller::class, 'store'])->name('yayasan.store');
      Route::get('/admin/yayasan/cari', [adminyayasancontroller::class, 'cari'])->name('yayasan.cari');
      Route::get('/admin/yayasan/edit/{data}', [adminyayasancontroller::class, 'edit'])->name('yayasan.edit');
      Route::put('/admin/yayasan/update/{data}', [adminyayasancontroller::class, 'update'])->name('yayasan.update');
      Route::delete('/admin/yayasan/delete/{data}', [adminyayasancontroller::class, 'destroy'])->name('yayasan.destroy');
      Route::delete('/admin/datayayasan/multidel', [adminyayasancontroller::class, 'multidel'])->name('yayasan.multidel');


      //yayasandetail
      Route::get('/admin/yayasandetail/{yayasan}', [adminyayasandetailcontroller::class, 'index'])->name('yayasandetail');
      Route::get('/admin/yayasandetail/create/{yayasan}', [adminyayasandetailcontroller::class, 'create'])->name('yayasandetail.create');
      Route::post('/admin/yayasandetail/create/{yayasan}', [adminyayasandetailcontroller::class, 'store'])->name('yayasandetail.store');
      Route::get('/admin/yayasandetail/cari/{yayasan}', [adminyayasandetailcontroller::class, 'cari'])->name('yayasandetail.cari');
      Route::get('/admin/yayasandetail/edit/{yayasan}/{data}', [adminyayasandetailcontroller::class, 'edit'])->name('yayasandetail.edit');
      Route::put('/admin/yayasandetail/update/{yayasan}/{data}', [adminyayasandetailcontroller::class, 'update'])->name('yayasandetail.update');
      Route::delete('/admin/yayasandetail/delete/{yayasan}/{data}', [adminyayasandetailcontroller::class, 'destroy'])->name('yayasandetail.destroy');
      Route::delete('/admin/datayayasandetail/multidel/{yayasan}', [adminyayasandetailcontroller::class, 'multidel'])->name('yayasandetail.multidel');

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
  //export
  Route::get('/admin/datasekolah/exportdetailsekolah/{id}', [prosescontroller::class, 'exportdetailsekolah'])->name('detailsekolah.export');

  //import
      Route::post('admin/datasekolah/importdetailsekolah/{id}', 'App\Http\Controllers\prosescontroller@importdetailsekolah')->name('detailsekolah.import');



        Route::post('admin/cleartemp', 'App\Http\Controllers\prosescontroller@cleartemp')->name('cleartemp');

        // API
        Route::get('/admin/api/inputnilaipsikologi', [adminapicontroller::class, 'inputnilaipsikologi'])->name('api.inputnilaipsikologi');
        Route::get('/admin/api/inputnilaipsikologibk', [adminapicontroller::class, 'inputnilaipsikologibk'])->name('api.inputnilaipsikologibk');
        Route::get('/admin/api/sekolah/updatestatus/{id}', [adminapicontroller::class, 'updatestatusskolah'])->name('api.sekolah.updatestatus');

        //Seeder
        Route::post('/admin/seeder/sekolah', [adminseedercontroller::class, 'sekolah'])->name('seeder.sekolah');
        Route::post('/admin/seeder/masternilaipsikologi', [adminseedercontroller::class, 'masternilaipsikologi'])->name('seeder.masternilaipsikologi');
        Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

        //Example
        Route::get('/admin/example/grafik', [admingrafikcontroller::class, 'ex'])->name('testing.grafik');



        // bk
        //bk dashboard
        Route::get('/bk/beranda', [bkberandacontroller::class, 'index'])->name('bk.beranda');
        Route::get('/bk/berandanon', [bkberandanonaktifcontroller::class, 'index'])->name('bk.non');

        Route::get('/bk/referensi', [bkberandacontroller::class, 'referensi'])->name('bk.referensi');
        Route::get('/bk/referensi/cari', [bkberandacontroller::class, 'cari_ref'])->name('bk.referensi.cari');
        //informasipsikologi
        Route::get('/bk/informasipsikologi', [bkberandacontroller::class, 'informasipsikologi'])->name('bk.informasipsikologi');
        Route::get('/bk/informasipsikologi/cari', [bkberandacontroller::class, 'cari_infp'])->name('bk.informasipsikologi.cari');
        //siswa
        Route::get('/bk/siswa', [bksiswacontroller::class, 'index'])->name('bk.siswa');
        Route::get('/bk/siswa/cari', [bksiswacontroller::class, 'cari'])->name('bk.siswa.cari');
        Route::get('/bk/siswa/create', [bksiswacontroller::class, 'create'])->name('bk.siswa.create');
        Route::post('/bk/siswa/create', [bksiswacontroller::class, 'store'])->name('bk.siswa.store');
        Route::get('/bk/siswa/{data}', [bksiswacontroller::class, 'edit'])->name('bk.siswa.edit');
        Route::put('/bk/siswa/{data}', [bksiswacontroller::class, 'update'])->name('bk.siswa.update');
        Route::delete('/bk/siswa/{data}', [bksiswacontroller::class, 'destroy'])->name('bk.siswa.destroy');
        Route::delete('/bk/siswa/multidel', [bksiswacontroller::class, 'multidel'])->name('bk.siswa.multidel');

        //walikelas
        Route::get('/bk/walikelas', [bkwalikelascontroller::class, 'index'])->name('bk.walikelas');
        Route::get('/bk/walikelas/cari', [bkwalikelascontroller::class, 'cari'])->name('bk.walikelas.cari');
        Route::get('/bk/walikelas/create', [bkwalikelascontroller::class, 'create'])->name('bk.walikelas.create');
        Route::post('/bk/walikelas/create', [bkwalikelascontroller::class, 'store'])->name('bk.walikelas.store');
        Route::get('/bk/walikelas/{data}', [bkwalikelascontroller::class, 'edit'])->name('bk.walikelas.edit');
        Route::put('/bk/walikelas/{data}', [bkwalikelascontroller::class, 'update'])->name('bk.walikelas.update');
        Route::delete('/bk/walikelas/{data}', [bkwalikelascontroller::class, 'destroy'])->name('bk.walikelas.destroy');
        Route::delete('/bk/walikelas/multidel', [bkwalikelascontroller::class, 'multidel'])->name('bk.walikelas.multidel');
        //kelas
        Route::get('/bk/kelas', [bkkelascontroller::class, 'index'])->name('bk.kelas');
        Route::get('/bk/kelas/cari', [bkkelascontroller::class, 'cari'])->name('bk.kelas.cari');
        Route::get('/bk/kelas/create', [bkkelascontroller::class, 'create'])->name('bk.kelas.create');
        Route::post('/bk/kelas/create', [bkkelascontroller::class, 'store'])->name('bk.kelas.store');
        Route::get('/bk/kelas/{data}', [bkkelascontroller::class, 'edit'])->name('bk.kelas.edit');
        Route::put('/bk/kelas/{data}', [bkkelascontroller::class, 'update'])->name('bk.kelas.update');
        Route::delete('/bk/kelas/{data}', [bkkelascontroller::class, 'destroy'])->name('bk.kelas.destroy');
        Route::delete('/bk/kelas/multidel', [bkkelascontroller::class, 'multidel'])->name('bk.kelas.multidel');
        //menu pengguna
        Route::get('/bk/pengguna', [bkpenggunacontroller::class, 'index'])->name('bk.pengguna');
        Route::get('/bk/pengguna/cari', [bkpenggunacontroller::class, 'cari'])->name('bk.pengguna.cari');
        Route::get('/bk/pengguna/create', [bkpenggunacontroller::class, 'create'])->name('bk.pengguna.create');
        Route::post('/bk/pengguna/create', [bkpenggunacontroller::class, 'store'])->name('bk.pengguna.store');
        Route::get('/bk/pengguna/{data}', [bkpenggunacontroller::class, 'edit'])->name('bk.pengguna.edit');
        Route::put('/bk/pengguna/{data}', [bkpenggunacontroller::class, 'update'])->name('bk.pengguna.update');
        Route::delete('/bk/pengguna/{data}', [bkpenggunacontroller::class, 'destroy'])->name('bk.pengguna.destroy');
        Route::delete('/bk/pengguna/multidel', [bkpenggunacontroller::class, 'multidel'])->name('bk.pengguna.multidel');
        //menu inputnilaipsikologi
        Route::get('/bk/inputnilaipsikologi', [bkinputnilaipsikologicontroller::class, 'index'])->name('bk.inputnilaipsikologi');
        //penjurusan
        Route::get('/bk/penjurusan', [bkpenggunacontroller::class, 'index'])->name('bk.penjurusan');
        //inputminatbakat
        Route::get('/bk/inputminatbakat', [bkpenggunacontroller::class, 'index'])->name('bk.inputminatbakat');
        //catatankasussiswa
        Route::get('/bk/catatankasussiswa', [bkcatatankasussiswacontroller::class, 'index'])->name('bk.catatankasussiswa');
        Route::get('/bk/catatankasussiswa/cari', [bkcatatankasussiswacontroller::class, 'cari'])->name('bk.catatankasussiswa.cari');
        Route::get('/bk/catatankasussiswa/{datasa}', [bkcatatankasussiswacontroller::class, 'edit'])->name('bk.catatankasussiswa.edit');
        Route::put('/bk/catatankasussiswa/{datasa}', [bkcatatankasussiswacontroller::class, 'update'])->name('bk.catatankasussiswa.update');
        Route::delete('/bk/catatankasussiswa/{id}', [bkcatatankasussiswacontroller::class, 'destroy'])->name('bk.catatankasussiswa.destroy');
        Route::get('/bk/datacatatankasussiswa/create', [bkcatatankasussiswacontroller::class, 'create'])->name('bk.catatankasussiswa.create');
        Route::post('/bk/datacatatankasussiswa', [bkcatatankasussiswacontroller::class, 'store'])->name('bk.catatankasussiswa.store');
        Route::delete('/bk/datacatatankasussiswa/multidel', [bkcatatankasussiswacontroller::class, 'multidel'])->name('bk.catatankasussiswa.multidel');

        //catatanpengembangandirisiswa
        Route::get('/bk/catatanpengembangandirisiswa', [bkcatatanpengembangandirisiswacontroller::class, 'index'])->name('bk.catatanpengembangandirisiswa');
        Route::get('/bk/catatanpengembangandirisiswa/cari', [bkcatatanpengembangandirisiswacontroller::class, 'cari'])->name('bk.catatanpengembangandirisiswa.cari');
        Route::get('/bk/catatanpengembangandirisiswa/{data}', [bkcatatanpengembangandirisiswacontroller::class, 'edit'])->name('bk.catatanpengembangandirisiswa.edit');
        Route::put('/bk/catatanpengembangandirisiswa/{data}', [bkcatatanpengembangandirisiswacontroller::class, 'update'])->name('bk.catatanpengembangandirisiswa.update');
        Route::delete('/bk/catatanpengembangandirisiswa/{id}', [bkcatatanpengembangandirisiswacontroller::class, 'destroy'])->name('bk.catatanpengembangandirisiswa.destroy');
        Route::get('/bk/datacatatanpengembangandirisiswa/create', [bkcatatanpengembangandirisiswacontroller::class, 'create'])->name('bk.catatanpengembangandirisiswa.create');
        Route::post('/bk/datacatatanpengembangandirisiswa', [bkcatatanpengembangandirisiswacontroller::class, 'store'])->name('bk.catatanpengembangandirisiswa.store');
        Route::delete('/bk/datacatatanpengembangandirisiswa/multidel', [bkcatatanpengembangandirisiswacontroller::class, 'multidel'])->name('bk.catatanpengembangandirisiswa.multidel');

        //catatanprestasisiswa
        Route::get('/bk/catatanprestasisiswa', [bkcatatanprestasisiswacontroller::class, 'index'])->name('bk.catatanprestasisiswa');
        Route::get('/bk/catatanprestasisiswa/cari', [bkcatatanprestasisiswacontroller::class, 'cari'])->name('bk.catatanprestasisiswa.cari');
        Route::get('/bk/catatanprestasisiswa/{data}', [bkcatatanprestasisiswacontroller::class, 'edit'])->name('bk.catatanprestasisiswa.edit');
        Route::put('/bk/catatanprestasisiswa/{data}', [bkcatatanprestasisiswacontroller::class, 'update'])->name('bk.catatanprestasisiswa.update');
        Route::delete('/bk/catatanprestasisiswa/{id}', [bkcatatanprestasisiswacontroller::class, 'destroy'])->name('bk.catatanprestasisiswa.destroy');
        Route::get('/bk/datacatatanprestasisiswa/create', [bkcatatanprestasisiswacontroller::class, 'create'])->name('bk.catatanprestasisiswa.create');
        Route::post('/bk/datacatatanprestasisiswa', [bkcatatanprestasisiswacontroller::class, 'store'])->name('bk.catatanprestasisiswa.store');
        Route::delete('/bk/datacatatanprestasisiswa/multidel', [bkcatatanprestasisiswacontroller::class, 'multidel'])->name('bk.catatanprestasisiswa.multidel');

        //bkminatbakat
        Route::get('/bk/inputminatbakat/', [bkinputminatbakatcontroller::class, 'index'])->name('bk.inputminatbakat');
        Route::get('/bk/inputminatbakat/cari', [bkinputminatbakatcontroller::class, 'cari'])->name('bk.inputminatbakat.cari');
        Route::get('/bk/inputminatbakat/{siswa}', [bkinputminatbakatcontroller::class, 'edit'])->name('bk.inputminatbakat.edit');
        Route::put('/bk/inputminatbakat/{siswa}', [bkinputminatbakatcontroller::class, 'update'])->name('bk.inputminatbakat.update');
        Route::delete('/bk/inputminatbakat/{id}', [bkinputminatbakatcontroller::class, 'destroy'])->name('bk.inputminatbakat.destroy');
        Route::get('/bk/datainputminatbakat/create', [bkinputminatbakatcontroller::class, 'create'])->name('bk.inputminatbakat.create');
        Route::post('/bk/datainputminatbakat', [bkinputminatbakatcontroller::class, 'store'])->name('bk.inputminatbakat.store');
        Route::delete('/bk/datainputminatbakat/multidel', [bkinputminatbakatcontroller::class, 'multidel'])->name('bk.inputminatbakat.multidel');

        //penjurusan
        Route::get('/bk/penjurusan', [bkpenjurusancontroller::class, 'index'])->name('bk.penjurusan');
        Route::get('/bk/penjurusan/cari', [bkpenjurusancontroller::class, 'cari'])->name('bk.penjurusan.cari');
        Route::get('/bk/penjurusan/{siswa}', [bkpenjurusancontroller::class, 'edit'])->name('bk.penjurusan.edit');
        Route::put('/bk/penjurusan/{siswa}', [bkpenjurusancontroller::class, 'update'])->name('bk.penjurusan.update');

        //setting pengguna bk
        //Route::get('/bk/settingpengguna', [bksettingpenggunacontroller::class, 'index'])->name('bk.settingpengguna');
        // Route::get('/bk/settingpengguna', [bksettingpenggunacontroller::class, 'index'])->name('profilebk');
        Route::put('/bk/settingpengguna/{id}', [bksettingpenggunacontroller::class, 'update'])->name('bk.settingpengguna.update');


        //bkcetak
        Route::get('/bk/cetak/nilaipsikologi', [bkcetakcontroller::class, 'nilaipsikologi'])->name('bk.cetak.nilaipsikologi');
        Route::get('/bk/cetak/catatankasussiswa', [bkcetakcontroller::class, 'cetakcatatankasussiswa'])->name('bk.cetak.catatankasussiswa');
        Route::get('/bk/cetak/catatanpengembangandirisiswa', [bkcetakcontroller::class, 'cetakcatatanpengembangandirisiswa'])->name('bk.cetak.catatanpengembangandirisiswa');
        Route::get('/bk/cetak/catatanprestasisiswa', [bkcetakcontroller::class, 'cetakcatatanprestasisiswa'])->name('bk.cetak.catatanprestasisiswa');
        //bkcetak
        Route::get('/bk/grafik/nilaipsikologi', [bkgrafikcontroller::class, 'nilaipsikologi'])->name('bk.grafik.nilaipsikologi');


});
