<?php

use App\Http\Controllers\Api\apilogincontroller;
use App\Http\Controllers\Api\apisekolahcontroller;
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

// Route::get('user', [apilogincontroller::class, 'getuser']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [apilogincontroller::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/sekolah', [apisekolahcontroller::class, 'index']);

    Route::post('/validasitoken', [apilogincontroller::class, 'validasitoken']);
    Route::post('/logout', [apilogincontroller::class, 'logout']);
    // Route::post('/logoutall', [apilogincontroller::class, 'logoutall']);
    // Route::post('logoutall', 'AuthController@logoutall');
});

