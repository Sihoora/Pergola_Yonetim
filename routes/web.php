<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminYonetim;
use App\Http\Controllers\ProjeController;
use App\Http\Controllers\DashboardController;

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

// Anasayfa ve Giriş Yap/Kayıt Ol sayfaları için
Route::get('/', function () {
    return view('welcome');
})->middleware('guest'); // Sadece misafirler erişebilir.

// Kullanıcı girişi yapıldıktan sonra erişilebilir olan sayfalar
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');

    
    // Proje ekleme sayfası
    Route::get('/dashboard/proje_ekle',[App\Http\Controllers\MenuNavigate::class,"index"])->name('proje_ekle');

    // Proje kaydetme işlemi
    Route::post('/proje-ekle', [ProjeController::class, 'store'])->name('proje.store');
});

