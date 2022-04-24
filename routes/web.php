<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NeomahasiswaController;
use App\Http\Controllers\NeodosenController;

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
Route::get('dashboard', [DashboardController::class, 'index' ]);
Route::post('login', [LoginController::class, 'index' ]);
Route::get('login/logout', [LoginController::class, 'logout' ]);

//mahasiswa
Route::get('neomahasiswa', [NeomahasiswaController::class, 'index' ]);
Route::post('neomahasiswa/listdata', [NeomahasiswaController::class, 'listdata' ]);
Route::get('neomahasiswa/detail/{aksi}/{id_mahasiswa}', [NeomahasiswaController::class, 'detail' ]);
Route::get('neomahasiswa/biodata/{id_mahasiswa}', [NeomahasiswaController::class, 'biodata' ]);
Route::get('neomahasiswa/historiypendidikan/{id_mahasiswa}', [NeomahasiswaController::class, 'historiypendidikan' ]);
Route::get('neomahasiswa/krs/{id_mahasiswa}', [NeomahasiswaController::class, 'krs' ]);
Route::get('neomahasiswa/nilai/{id_mahasiswa}', [NeomahasiswaController::class, 'nilai' ]);

Route::get('neodosen', [NeodosenController::class, 'index' ]);
Route::post('neodosen/listdata', [NeodosenController::class, 'listdata' ]);



