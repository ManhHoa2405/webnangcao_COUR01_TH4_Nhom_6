<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CheckoutController;
use App\Models\User;
use App\Models\Product;

// home + admin page
Route::get('/', function(){ return view('home'); })->name('home');
Route::get('/adminPage', function(){ return view('admin.adminPage'); })->name('adminPage')->middleware('auth','is_admin');

Route::get('/intro', function () {
    return view('intro'); 
});

// Route::get('/products', function () {
//     return view('products'); 
// });

// Route::get('/adminPage', function () {
//     return view('admin.adminPage');
// });

// Route::get('/addProduct', function () {
//     return view('admin.addProduct');
// })->name('products.create');

Route::resource('products', ProductController::class);
Route::resource('users', UserController::class);

// User xem thông tin
Route::get('/user/{id}', [UserController::class, 'show'])->name('users.show');

// User cập nhật thông tin (khác admin update)
Route::put('/user/{id}/update', [UserController::class, 'updateProfile'])->name('profile.update');


// Route::put('/products/{id}', 
// [ProductController::class, 'update'])->name('products.update');


// Route::post('/products', 
// [ProductController::class, 'store'])->name('products.store');

// Route::get('/editProduct', 
// [ProductController::class, 'edit'])->name('products.edit');

// Auth
Route::post('/login', [UserController::class,'login'])->name('login');
Route::get('/login', function () {
    return redirect()->back()->with('error', 'Bạn cần đăng nhập để tiếp tục!');
})->name('login.form');


Route::post('/register', [UserController::class,'register'])->name('register');

// Logout: bắt POST (an toàn)
Route::post('/logout', [UserController::class,'logout'])->name('logout');


Route::get('/provinces', [AddressController::class, 'getProvinces']);
Route::get('/districts/{province_id}', [AddressController::class, 'getDistricts']);
Route::get('/wards/{district_id}', [AddressController::class, 'getWards']);

//hien thi san pham
Route::get('/menu-products', [ShopController::class, 'index'])->name('menuProducts');
Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
// Trang menu theo category (vẫn load ra view menuProducts)
Route::get('/menu-products/{category}', [ShopController::class, 'category'])->name('shop.category');

Route::middleware('auth')->group(function () {
    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Trang danh sách đơn hàng
Route::get('/admin/orders', [OrderController::class, 'index'])->name('admin.orders.index');

// Trang chi tiết đơn hàng
Route::get('/admin/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
