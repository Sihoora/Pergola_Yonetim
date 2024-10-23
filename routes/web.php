<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuNavigate;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\OrderFileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;




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
    Route::get('/dashboard/proje_ekle', [ProjectController::class, "create"])->name('proje_ekle');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    Route::get('/dashboard/orders', [OrderController::class, 'index'])->name( 'order-create');

    Route::post('orders/store', [OrderController::class, 'store'])->name('orders.store');

    Route::get('orders-list', [OrderController::class, 'order_list'])->name('order.list');

    Route::get('orders-details/{id}', [OrderController::class, 'show'])->name('order.details');

    Route::post('/order-files/upload/{order}', [OrderFileController::class, 'upload'])->name('order-files.upload');
    Route::get('/order-files/{orderId}', [OrderFileController::class, 'getFiles'])->name('order-files.list');

    // Order File preview
    Route::get('/order-files/preview/{id}', [OrderFileController::class, 'preview'])->name('order-files.preview');
    Route::get('/file/preview/{id}', action: [FileController::class, 'preview'])->name('file.preview');

    Route::get('/order-files/{orderId}', [OrderFileController::class, 'getFiles'])->name('order-files.list');

        // Sipariş not ekleme işlemi
    Route::post('/siparis-not-ekle', [OrderController::class, 'storeNote'])->name('order.note.store');

    // Sipariş not durum güncelleme işlemi
    Route::post('/siparis-not-durum-guncelle', [OrderController::class, 'updateNoteStatus'])->name('order.note.update');

    // Sipariş not checkbox durum güncelleme işlemi
    Route::post('/siparis/{noteId}/toggle-checkbox', [OrderController::class, 'toggleCheckbox']);

    // Sipariş ilerletme işlemi
    Route::get('/siparis/ilerlet-surec/{id}', [OrderController::class, 'ilerletSurec'])->name('order.ilerletSurec');

    Route::get('/order-files/preview/{id}', [OrderFileController::class, 'preview'])->name('order-files.preview');
    Route::get('/order-files/download/{id}', [OrderFileController::class, 'download'])->name('order-files.download');
    Route::delete('/order-files/{id}', [OrderFileController::class, 'delete'])->name('order-files.delete');


    Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assignRole');

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

    // Dosya önizleme işlemi
    Route::get('/file/preview/{id}', action: [FileController::class, 'preview'])->name('file.preview');

    // Proje detay sayfası
    Route::get('/dashboard/proje-detay/{id}', [ProjectController::class, 'show'])->name('proje.detay');
    
    // Proje not ekleme işlemi
    Route::post('/proje-not-ekle', [ProjectController::class, 'storeNote'])->name('note.store');

    // Proje not durum güncelleme işlemi
    Route::post('/proje-not-durum-guncelle', [ProjectController::class, 'updateNoteStatus'])->name('note.update');

    // Proje not checkbox durum güncelleme işlemi
    Route::post('/proje/{noteId}/toggle-checkbox', [ProjectController::class, 'toggleCheckbox']);
    
    // Proje ilerletme işlemi
    Route::get('proje/ilerlet-surec/{id}', [ProjectController::class, 'ilerletSurec'])->name('proje.ilerletSurec');

    // Proje PDF oluşturma işlemi
    Route::get('/proje/{id}/pdf-olustur', [ProjectController::class, 'generatePDF'])->name('proje.pdf');



});
