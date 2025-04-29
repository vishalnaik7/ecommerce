<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                                |
|--------------------------------------------------------------------------|
| Here is where you can register web routes for your application.           |
| These routes are loaded by the RouteServiceProvider and all of them will |
| be assigned to the "web" middleware group. Make something great!          |
|--------------------------------------------------------------------------|
*/

// Admin login routes
Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('/get-product-details/{id}', [App\Http\Controllers\HomeController::class, 'getProductDetails']);
Route::post('/add-to-cart/{id}', [HomeController::class, 'add'])->name('cart.add'); 
Route::get('/cart/list', [HomeController::class, 'list'])->name('cart.list'); 
Route::post('/cart/remove', [HomeController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [HomeController::class, 'cartPage'])->name('cart.page');
Route::get('/checkOut', [HomeController::class, 'checkOut'])->name('checkOut'); 
Route::post('/cart/update-quantity', [HomeController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::post('/payment-success', [HomeController::class, 'paymentSuccess']); 
Route::post('/create-order', [HomeController::class, 'createRazorpayOrder']);
Route::get('/order-success', [HomeController::class, 'orderSuccess'])->name('order.success');
Route::get('/orders', [HomeController::class, 'allOrders'])->name('orders.index');
Route::put('admin/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
Route::post('admin/products/{id}/upload-images', [ProductController::class, 'uploadImages'])->name('admin.products.uploadImages');
Route::delete('admin/products/image/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.deleteImage');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth:admin'])->group(function () {
    // Route::get('admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');
    Route::get('/admin/dashboard', [ProductController::class, 'index'])->name('admin.dashboard');

    // Admin product management routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
        Route::delete('products/{image}/image', [ProductController::class, 'deleteImage'])->name('products.deleteImage');
    });
});
Route::get('/', [HomeController::class, 'index'])->name('home');
