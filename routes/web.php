<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use App\Models\Item;
use App\Models\Cart;

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

Route::get('/dashboard', function () {
    $user = Auth::user();
    $item = Item::all();
    $cart = Cart::all();

    return view('dashboard', ['user' => $user, 'items' => $item, 'carts' => $cart]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/dashboard', [ItemController::class, 'itemAdd'])->name('items.store');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::post('/dashboard/{item}/add', [CartController::class, 'itemAdd'])->name('cart.store');
Route::delete('/dashboard/{cart}/delete', [CartController::class, 'itemDestroy'])->name('cart.destroy');
Route::post('/dashboard/{cart}/edit', [CartController::class, 'itemEdit'])->name('cart.edit');

Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('payment.store');

Route::get('/success', 'App\Http\Controllers\StripeController@success')->name('success');

require __DIR__.'/auth.php';

Route::get('/payment', function () {
    $item = Item::all();
    $user = Auth::user();
    $cart = Cart::all();

    return view('payment', ['items' => $item, 'user' => $user, 'carts' => $cart]);
})->middleware(['auth', 'verified'])->name('payment');;