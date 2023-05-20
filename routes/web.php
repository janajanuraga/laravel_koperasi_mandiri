<?php

namespace App\Http\Controllers;
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

Route::get('/login', [UserController::class, 'index']);
Route::get('/', [UserController::class, 'home']);
Route::get('/register', [UserController::class, 'create']);
Route::get('/profil', [UserController::class, 'edit']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'destroy']);
Route::post('/profil', [UserController::class, 'update']);

Route::resource('anggota', AnggotaController::class, ['parameters' => ['anggota' => 'id']]);
Route::resource('/simpanan', SimpananController::class);
Route::resource('/karyawan', karyawanController::class);
Route::resource('/bunga', BungasimpananController::class);

Route::get('/cari', [SimpananController::class, 'searchResult']);

Route::get('/bungasimpanan', [BungaSimpananController::class, 'create_generate']);
Route::post('/bungasimpanan', [BungaSimpananController::class, 'generate']);

Route::get('/report/member', [ReportController::class, 'nasabah']);
Route::get('/report/harian', [ReportController::class, 'harian']);
Route::get('/report/mingguan', [ReportController::class, 'mingguan']);
Route::get('/report/bulanan', [ReportController::class, 'bulanan']);
Route::get('/report/tahunan', [ReportController::class, 'tahunan']);
Route::post('/report/member', [ReportController::class, 'report_nasabah']);