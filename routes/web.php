<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;


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




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ItemController::class, 'userPage'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {  //一般ユーザー

    Route::post('/upload', [ItemController::class, 'upload'])->name('upload');
    // カートの中身を表示
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    // カートにアイテムを追加
    Route::post('/cart/{item_id}', [CartController::class, 'addToCart'])->name('cart.add');
    //削除
    Route::get('/delete/{id}', [CartController::class, 'delete'])->name('cart.delete');
    // 商品詳細画面
    Route::get('/item_detail{id}', [ItemController::class, 'itemDetailPage'])->name('item_detail');
    
    Route::get('/payment', [PaymentController::class, 'showPayment'])->name('payment.show');
    Route::post('/payment', [PaymentController::class, 'storePayment'])->name('payment.store');


    
});



require __DIR__.'/auth.php';
require __DIR__.'/admin.php';










