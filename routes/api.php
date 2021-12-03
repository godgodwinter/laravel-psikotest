<?php

use App\Http\Controllers\Api\apilogincontroller;
use App\Http\Controllers\siakadadmininputnilaicontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/logout', [apilogincontroller::class, 'logout']);
Route::post('login', [apilogincontroller::class, 'login']);
// Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function() {
Route::group(['middleware' => ['auth:sanctum']], function() {
    // manggil controller sesuai bawaan laravel 8
    Route::post('/logout', [apilogincontroller::class, 'logout']);
    // manggil controller dengan mengubah namespace di RouteServiceProvider.php biar bisa kayak versi2 sebelumnya

Route::post('/logoutall', [apilogincontroller::class, 'logoutall']);
    // Route::post('logoutall', 'AuthController@logoutall');
});

Route::get('admin/inputnilai/mapel/{dataajar}', 'App\Http\Controllers\siakadadmininputnilaicontroller@api_index')->name('api.siakad.inputnilai.mapel');
Route::get('admin/inputnilai/periksamapel/{siswa_nis}/{kelas_nama}/{pelajaran_nama}/{jenisnilai_nama}/{semester_nama}', 'App\Http\Controllers\siakadadmininputnilaicontroller@api_nilaipelajaran')->name('api.siakad.inputnilai.periksamapel');
// Route::resource('/post', siakadadmininputnilaicontroller::class);
