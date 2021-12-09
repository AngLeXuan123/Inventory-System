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
use App\Http\Controllers\Cart\CartpaymentController;
use App\Http\Controllers\RoleController;



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
    $prod = \DB::table('products')->orderBy('created_at', 'desc')->get();
    return view('welcome',[
        'prod' => $prod
    ]);
})->name('welcome');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('adminHome');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('desc', DescController::class);
    Route::resource('users', UserController::class);
    Route::resource('brand', BrandController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
});

//invoice route
Route::get('generate-invoice/{order_id}', [App\Http\Controllers\OrderController::class, 'invoice']);

//stripe payment form -> manually order
Route::get('paymentForm', [PaymentTokensController::class, 'payment_form']);
Route::post('stripe/{order_id}', [PaymentTokensController::class, 'stripePost'])->name('stripe.post');

//add to cart
Route::get('cart', [CartController::class, 'cart'])->name('product.cart');
Route::get('add-to-cart/{id}', [CartController::class,'addToCart'])->name('add.cart');
Route::put('update-cart/{id}', [CartController::class, 'update']);
Route::delete('delete-cart/{id}', [CartController::class, 'remove']);

//stripe payment form -> customer site (checkout)
Route::post('selected-item-order/{user_id}', [CartpaymentController::class,'create_Order'])->name('select.item.order');
Route::get('cust-paymentForm/{user_id}/{order_id}',[CartpaymentController::class, 'cust_payment_form'])->name('cust.payment.form');
Route::post('cust-stripe/{user_id}/{order_id}', [CartpaymentController::class, 'cust_stripe_post'])->name('cust.stripe.post');


