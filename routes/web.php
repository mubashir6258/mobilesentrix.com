<?php

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
    return view('home');
})->name('home');

// Search Route
Route::get('/search', function () {
    $query = request('q');
    // TODO: Implement search functionality
    return view('search', ['query' => $query]);
})->name('search');

// Category Routes
Route::get('/apple', function () {
    return view('categories.apple');
})->name('category.apple');

Route::get('/samsung', function () {
    return view('categories.samsung');
})->name('category.samsung');

Route::get('/lg', function () {
    return view('categories.lg');
})->name('category.lg');

Route::get('/google-pixel', function () {
    return view('categories.google-pixel');
})->name('category.google-pixel');

Route::get('/motorola', function () {
    return view('categories.motorola');
})->name('category.motorola');

Route::get('/tools-accessories', function () {
    return view('categories.tools-accessories');
})->name('category.tools-accessories');

Route::get('/board-components', function () {
    return view('categories.board-components');
})->name('category.board-components');

Route::get('/refurbished', function () {
    return view('categories.refurbished');
})->name('category.refurbished');

// Other Routes
Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/products', function () {
    return view('products.index');
})->name('products.index');

Route::post('/newsletter/subscribe', function () {
    // TODO: Implement newsletter subscription
    return redirect()->back()->with('success', 'Thank you for subscribing!');
})->name('newsletter.subscribe');

// Static Pages
Route::get('/about-us', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/shipping-policy', function () {
    return view('pages.shipping-policy');
})->name('shipping-policy');

Route::get('/return-policy', function () {
    return view('pages.return-policy');
})->name('return-policy');

Route::get('/privacy-policy', function () {
    return view('pages.privacy-policy');
})->name('privacy-policy');

// Quick Order and Other Services
Route::get('/quickorder', function () {
    return view('services.quick-order');
})->name('quickorder');

Route::get('/lcd-buy-back', function () {
    return view('services.lcd-buyback');
})->name('lcd-buyback');

Route::get('/marketing-materials', function () {
    return view('services.marketing-materials');
})->name('marketing-materials');

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('login.post');
});

// Protected Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('logout');

    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);

    Route::post('orders/{order}/update-status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show']);
});
