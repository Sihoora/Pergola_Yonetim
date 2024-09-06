<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuNavigate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;

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

    // Dashboard sayfası    
    Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard');

    // Proje ekleme sayfası
    Route::get('/dashboard/proje_ekle', [DashboardController::class, "index"])->name('proje_ekle');

    // Proje kaydetme işlemi
    Route::post('/proje-ekle', [ProjectController::class, 'store'])->name('proje.store');

    // Proje listeleme sayfası
    Route::get('/dashboard/proje-liste', [ProjectController::class, "index"])->name('proje-liste');

    // Proje düzenleme sayfası
    Route::get('/dashboard/proje-duzenle/{id}', [ProjectController::class, "edit"])->name('proje.edit');

    // Proje güncelleme işlemi
    Route::put('/proje-duzenle/{id}', [ProjectController::class, 'update'])->name('proje.update');

    // Proje silme işlemi
    Route::delete('/proje-sil/{id}', [ProjectController::class, 'destroy'])->name('proje.delete');

    // Ürün ekleme sayfası
    Route::post('/urun/store', [ProductController::class, 'storeUrun'])->name('urun.store');

    // Ürün listeleme sayfası
    Route::get('/proje/{id}/urunler', [ProductController::class, 'getUrunler'])->name('proje.urunler');

    // Ürün düzenleme sayfası
    Route::get('/dashboard/urun-duzenle/{id}', [ProductController::class, 'editUrun'])->name('urun.edit');

    // Ürün güncelleme işlemi
    Route::put('/urun-duzenle/{id}', [ProductController::class, 'updateUrun'])->name('urun.update');

    // Dosya yükleme işlemi
    Route::post('/file-upload', [FileController::class, 'upload'])->name('file.upload');
    
    // Dosya listeleme sayfası
    Route::get('/proje/{id}/files', [FileController::class, 'getFiles'])->name('proje.files');

    // Dosya indirme işlemi
    Route::get('/file-download/{id}', [FileController::class, 'download'])->name('file.download');

    // Dosya silme işlemi
    Route::delete('/file-delete/{id}', [FileController::class, 'delete'])->name('file.delete');

    Route::get('/file/preview/{id}', [FileController::class, 'preview'])->name('file.preview');

    Route::get('/dashboard/proje-detay/{id}', [ProjectController::class, 'show'])->name('proje.detay');

    
    Route::post('/proje-not-ekle', [ProjectController::class, 'storeNote'])->name('note.store');

    //updateNoteStatus
    Route::post('/proje-not-durum-guncelle', [ProjectController::class, 'updateNoteStatus'])->name('note.update');


    Route::post('/proje/{noteId}/toggle-checkbox', [ProjectController::class, 'toggleCheckbox']);
    
    Route::get('proje/ilerlet-surec/{id}', [ProjectController::class, 'ilerletSurec'])->name('proje.ilerletSurec');




});
