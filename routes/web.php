<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');

//Route::get('homeAdmin', [HomeAdminController::class, 'index'])->name('homeAdmin')->middleware('auth');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

//REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/action', [RegisterController::class, 'actionregister'])->name('actionregister');
Route::get('register/verify/{verify_key}', [RegisterController::class, 'verify'])->name('verify');

//LUPA PASSWORD
Route::get('password', [PasswordController::class, 'LupaPassword'])->name('password');
Route::post('password/forgot', [PasswordController::class, 'actionForgot'])->name('reset.password');
Route::get('password/input-reset/{verify_key}', [PasswordController::class, 'ResetPass'])->name('input-reset');
Route::post('password/reset', [PasswordController::class, 'prosesResetPassword'])->name('submit.resspassword');

Route::middleware('auth')->group(function () {
    Route::get('data-instansi/instansi', [InstansiController::class, 'index'])->name('content.instansi');
    Route::post('data-instansi/instansi/edit/{id}', [InstansiController::class, 'EditData'])->name('instansi.edit');
    Route::post('data-instansi/instansi/editgambar/{id}', [InstansiController::class, 'EditDataGambar'])->name('instansi.editgambar');
});

// DATA KETERANGAN
Route::middleware('auth')->group(function () {
    Route::get('data-keterangan/keterangan', [KeteranganController::class, 'index'])->name('content.keterangan');
    Route::post('data-keterangan/keterangan/tambah', [KeteranganController::class, 'TambahData'])->name('keterangan.tambah');
    Route::delete('data-keterangan/keterangan/hapus', [KeteranganController::class, 'HapusData'])->name('keterangan.hapus');
    Route::post('data-keterangan/keterangan/edit/{id}', [KeteranganController::class, 'EditData'])->name('keterangan.edit');
});

// DATA SURAT
Route::middleware('auth')->group(function () {
    Route::get('data-surat/surat', [SuratController::class, 'index'])->name('content.surat');
    Route::post('data-surat/surat/tambah', [SuratController::class, 'TambahData'])->name('surat.tambah');
    Route::post('data-surat/surat/edit/{id}', [SuratController::class, 'UbahData'])->name('surat.ubah');
    Route::delete('data-surat/surat/hapus/{id}', [SuratController::class, 'HapusData'])->name('surat.hapus');
});
// Route::controller(HomeController::class)->name('instansi.')->prefix('data-instansi/instansi')->group(function () {
//     Route::get('/','DataInstansi')->name('instansi');
// });

// Route::controller(HomeController::class)->name('keterangan.')->prefix('data-keterangan/keterangan')->group(function () {
//     Route::get('/','DataKeterangan')->name('keterangan');
// });

// Route::controller(HomeController::class)->name('surat.')->prefix('data-surat/surat')->group(function () {
//     Route::get('/','DataSurat')->name('surat');
// });