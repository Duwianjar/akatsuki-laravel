<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\userController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\nilaiController;
use App\Http\Controllers\portalController;
use App\Http\Controllers\dashboardController;
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

Route::get('/', [dashboardController::class, "index"]);
Route::get('/about', [dashboardController::class, "about"]);
Route::get('/infrastruktur', [dashboardController::class, "infrastruktur"]);
Route::get('/berita', [dashboardController::class, "berita"]);
Route::get('/berita/detail', [dashboardController::class, "berita_detail"]);
Route::get('/pengumuman', [dashboardController::class, "pengumuman"]);
Route::get('/pengumuman/detail', [dashboardController::class, "pengumuman_detail"]);
Route::get('/agenda', [dashboardController::class, "agenda"]);
Route::get('/struktur', [dashboardController::class, "struktur"]);
Route::get('/prestasi/sekolah', [dashboardController::class, "prestasi_sekolah"]);
Route::get('/prestasi/siswa', [dashboardController::class, "prestasi_siswa"]);
Route::get('/invalid', [authController::class, "invalid"]);
Route::get('/auth/redirect', [authController::class, "redirect"])->middleware('guest');
Route::get('/auth/callback',  [authController::class, "callback"])->middleware('guest');

Route::domain('portal.' . env('APP_URL'))->group(function () {
    Route::get('/', [authController::class, "index"])->middleware('guest');
    Route::get('/authent', [authController::class, "index"])->middleware('guest');
    Route::get('/login', [authController::class, "index"])->middleware('guest');
    Route::get('/authent/login', [authController::class, "index"])->middleware('guest');
    Route::get('/authent/login/gagal', [authController::class, "logingagal"])->middleware('guest');
    Route::get('/request/{encryptedId}', [authController::class, "request"]);
    Route::redirect('home', 'profil');
    Route::get('/profil', [portalController::class, "index"])->middleware(['user']);
    Route::get('/mapel', [portalController::class, "mapel"])->middleware(['user']);
    Route::get('/mapel/index/{id}', [portalController::class, "mapelfromkelas"])->middleware(['user']);
    Route::get('/mapel/index', [portalController::class, "mapelindex"])->middleware(['user']);
    Route::get('/mapel/detail/{id}', [portalController::class, "mapeldetail"])->middleware(['user']);
    Route::get('/mapel/detail', [portalController::class, "mapeldetailindex"])->middleware(['user']);
    Route::get('/mapel/edit/{id}', [portalController::class, "mapeledit"])->middleware(['user']);
    Route::get('/mapel/edit', [portalController::class, "mapeleditindex"])->middleware(['user']);
    Route::post('/mapel/edit/index', [portalController::class, "mapeleditfinal"])->middleware(['user']);
    Route::get('/mapel/delete/{id}', [portalController::class, "mapeldelete"])->middleware(['user']);
    Route::get('/mapel/baru/{id}', [portalController::class, "newmapelcheck"])->middleware(['user']);
    Route::get('/mapel/baru', [portalController::class, "newmapel"])->middleware(['user']);
    Route::post('/mapel/baru/index', [portalController::class, "newmapelindex"])->middleware(['user']);


    Route::middleware(['user'])->group(function () {
        Route::get('/profil/edit', [userController::class, "editprofil"]);
        Route::match(['get', 'post'], '/profil/edit/post', [userController::class, "editprofilfinal"]);
        Route::match(['get', 'post'], '/profil/edit/password', [userController::class, "editpassword"]);
        Route::get('/profil/lupapassword', [userController::class, "lupapassword"]);
        Route::match(['get', 'post'], '/profil/edit/foto', [userController::class, "editfoto"]);
    });
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/users', [userController::class, "users"]);
        Route::get('/users/admin', [userController::class, "usersadmin"]);
        Route::get('/users/guru', [userController::class, "usersguru"]);
        Route::get('/users/murid/{idkelas}', [userController::class, "usersmurid"]);
        Route::get('/users/user', [userController::class, "usersuser"]);
        Route::get('/users/edit/{id}', [userController::class, "usersedit"]);
        Route::get('/users/edit', [userController::class, "userseditindex"]);
        Route::match(['get', 'post'], '/users/edit/index', [userController::class, "userseditfinal"]);
        Route::get('/users/baru', [userController::class, "usersbaru"]);
        Route::match(['get', 'post'], '/users/baru/index', [userController::class, "usersbaruindex"]);
        Route::get('/users/delete/{id}', [userController::class, "usersdelete"]);
    });

    Route::get('/nilai', [nilaiController::class, "index"])->middleware(['user']);
    Route::middleware(['user'])->group(function () {
        Route::get('/nilai/kelas/{id}', [nilaiController::class, "kelas"]);
        Route::get('/nilai/kelas', [nilaiController::class, "showmapelkelas"]);

        Route::get('/nilai/mapel/{id}', [nilaiController::class, "mapel"]);
        Route::get('/nilai/mapel', [nilaiController::class, "shownilaimapel"]);
        Route::get('/nilai/edit/{idmurid}/{idmapel}', [nilaiController::class, "editnilai"]);
        Route::get('/nilai/edit', [nilaiController::class, "editnilaimurid"]);
        Route::match(['get', 'post'], '/nilai/edit/index', [nilaiController::class, "editnilaifinal"]);
        Route::get('/nilai/cetak/{id}', [nilaiController::class, "cetak"]);
        Route::get('/nilai/cetak', [nilaiController::class, "cetaknilai"]);
    });

    Route::get('logout',[authController::class, "logout"]);
    Route::get('authent/logout',[authController::class, "logout"]);
    Route::post('authent/check',[authController::class, "check"]);
    Route::get('/invalid', [authController::class, "invalid"]);
});

Route::get('/enkripsi/{data}', [authController::class, "enkripsi"]);
Route::get('/deskripsi/{data}', [authController::class, "deskripsi"]);