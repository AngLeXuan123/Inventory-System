<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DescController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentTokensController;
use App\Http\Controllers\Cart\CartController;



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

Auth::routes();

Route::resource('desc', DescController::class);
Route::resource('user', UserController::class);
Route::resource('brand', BrandController::class);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
Route::resource('order', OrderController::class);

//invoice route
Route::get('generate-invoice/{order_id}', [App\Http\Controllers\OrderController::class, 'invoice']);

//stripe & payment form
Route::get('paymentForm', [PaymentTokensController::class, 'payment_form']);

Route::post('stripe/{order_id}', [PaymentTokensController::class, 'stripePost'])->name('stripe.post');

// user protected routes
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', [HomeController::class, 'userHome'])->name('userHome');
    
});

//admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function(){
    Route::get('/', [HomeController::class, 'adminHome'])->name('adminHome');
});

//add to cart
Route::get('cart', [CartController::class, 'cart'])->name('product.cart');
Route::get('add-to-cart/{id}', [CartController::class,'addToCart'])->name('add.cart');
Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
Route::delete('delete-cart', [CartController::class, 'remove'])->name('delete.cart');







