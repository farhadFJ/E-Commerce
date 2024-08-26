<?php

use App\Livewire\User\UserOrderDetailsComponent;
use App\Livewire\User\UserOrdersComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\OrderController;
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
})->name('home');


Route::get('/login',[AuthManager::class,'login'])->name('login');   // endpoint for function in controller , name for in route
Route::post('/login',[AuthManager::class,'loginPost'])->name('login.post');

Route::get('/registration',[AuthManager::class,'registration'])->name('registration');
Route::post('/registration',[AuthManager::class,'registrationPost'])->name('registration.post');

Route::get('/logout',[AuthManager::class,'logout'])->name('logout');

//product creatting
Route::get('/productsCreate',[ProductsController::class,'createIndex'])->name('productsCreate');


//product list show
Route::get('/productFooter',[ProductsController::class,'productFooter'])->name('productFooterList');
Route::get('/productsListIndex',[ProductsController::class,'index'])->name('productsList');
Route::post('/products',[ProductsController::class,'store'])->name('productsStore');
// loading more detail of product
Route::get('/product/{id}',[ProductsController::class,'showProduct'])->name('product.show');

// product delete  für admin
Route::get('/delete-product/{id}',[ProductsController::class,'deleteProduct'])->name('product.delete');

Route::get('cart',[ProductsController::class,'cart'])->name('cart');
Route::get('add_to_cart/{id}',[ProductsController::class,'addToCart'])->name('add_to_cart');

//in warenkorb kannst du die zahl ändern
Route::patch('update_cart/{id}',[ProductsController::class,'update'])->name('update_cart');

//remove_from_cart
Route::delete('remove_from_cart',[ProductsController::class,'remove'])->name('remove_from_cart');

Route::get('invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::post('invoice',[InvoiceController::class,'store'])->name('invoice.store');

Route::get('pdf/{id}', [InvoiceController::class,'createPdf'])->name('invoice.pdf');

//payment
Route::post('/pay',[PayPalController::class,'pay'])->name('paypal.payment');
Route::get('success/{id}',[PayPalController::class,'success']);
Route::get('error',[PayPalController::class,'error']);

// my orders
Route::get('/history', [InvoiceController::class, 'history'])->name('history');


