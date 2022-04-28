<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NeomahasiswaController;
use App\Http\Controllers\NeodosenController;
use App\Http\Controllers\NeokelasController;
use App\Http\Controllers\NeoakmController;

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
Route::get('neodosen/detail/{aksi}/{id_dosen}', [NeodosenController::class, 'detail' ]);
Route::get('neodosen/biodata/{id_dosen}', [NeodosenController::class, 'biodata' ]);

Route::get('neokelas', [NeokelasController::class, 'index' ]);
Route::post('neokelas/listdata', [NeokelasController::class, 'listdata' ]);
Route::get('neokelas/detail/{aksi}/{id_kelas_kuliah}', [NeokelasController::class, 'detail' ]);
Route::get('neokelas/detailkelas/{id_kelas_kuliah}', [NeokelasController::class, 'detailkelas' ]);
Route::get('neokelas/tambah', [NeokelasController::class, 'tambah' ]);
Route::post('neokelas/insert', [NeokelasController::class, 'insert' ]);

Route::get('neoakm', [NeoakmController::class, 'index' ]);
Route::post('neoakm/listdata', [NeoakmController::class, 'listdata' ]);
Route::get('neoakm/detail/{aksi}/{id_mahasiswa}/{id_semester}', [NeoakmController::class, 'detail' ]);
Route::get('neoakm/detailakm/{id_mahasiswa}/{id_semester}', [NeoakmController::class, 'detailakm' ]);
Route::get('neoakm/tambah', [NeoakmController::class, 'tambah' ]);
Route::post('neoakm/insert', [NeoakmController::class, 'insert' ]);
Route::post('neoakm/update', [NeoakmController::class, 'update' ]);
Route::post('neoakm/cekkrs', [NeoakmController::class, 'cekkrs' ]);


