<?php

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


use App\Http\Controllers\Ecommerce\FrontController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\LoginController;
use App\Http\Controllers\Ecommerce\OrderController;
use App\Http\Controllers\OrderController as ControllersOrderController;
use App\Http\Controllers\HomeController;


Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/products', [FrontController::class, 'products'])->name('front.product');
Route::get('/category/{slug}', [FrontController::class, 'categoryProduct'])->name('front.category');
Route::get('/product/{slug}', [FrontController::class, 'show'])->name('front.show_product');

Route::post('cart', [CartController::class, 'addToCart'])->name('front.cart');
Route::get('/cart', [CartController::class, 'listCart'])->name('front.list_cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('front.update_cart');

Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/checkout', [CartController::class, 'processCheckout'])->name('front.store_checkout');
Route::get('/checkout/{invoice}', [CartController::class, 'checkoutFinish'])->name('front.finish_checkout');

Route::get('/product/ref/{user}/{product}', [FrontController::class, 'referalProduct'])->name('front.afiliasi');

Route::group(['prefix' => 'member', 'namespace' => 'Ecommerce'], function () {
    Route::get('login', [LoginController::class, 'loginForm'])->name('customer.login');
    Route::post('login', [LoginController::class, 'login'])->name('customer.post_login');
    Route::post('register', [LoginController::class, 'register'])->name('customer.post_register');
    Route::get('verify/{token}', [FrontController::class, 'verifyCustomerRegistration'])->name('customer.verify');

    Route::group(['middleware' => 'customer'], function () {
        Route::get('dashboard', [LoginController::class, 'dashboard'])->name('customer.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('customer.logout');

        Route::get('orders', [OrderController::class, 'index'])->name('customer.orders');
        Route::get('orders/{invoice}', [OrderController::class, 'view'])->name('customer.view_order');
        Route::get('orders/pdf/{invoice}', [OrderController::class, 'pdf'])->name('customer.order_pdf');
        Route::post('orders/accept', [OrderController::class, 'acceptOrder'])->name('customer.order_accept');
        Route::get('orders/return/{invoice}', [OrderController::class, 'returnForm'])->name('customer.order_return');
        Route::put('orders/return/{invoice}', [OrderController::class, 'processReturn'])->name('customer.return');

        Route::get('payment', [OrderController::class, 'paymentForm'])->name('customer.paymentForm');
        Route::post('payment', [OrderController::class, 'storePayment'])->name('customer.savePayment');

        Route::get('setting', [FrontController::class, 'customerSettingForm'])->name('customer.settingForm');
        Route::post('setting', [FrontController::class, 'customerUpdateProfile'])->name('customer.setting');

        Route::get('/afiliasi', [FrontController::class, 'listCommission'])->name('customer.affiliate');
    });
});

Auth::routes();

Route::group(['prefix' => 'administrator', 'middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::resource('category', CategoryController::class)->except(['create', 'show']);
    Route::resource('product', ProductController::class)->except(['show']);
    Route::get('/product/bulk', [App\Http\Controllers\ProductController::class, 'massUploadForm'])->name('product.bulk');
    Route::post('/product/bulk', [App\Http\Controllers\ProductController::class, 'massUpload'])->name('product.saveBulk');
    Route::post('/product/marketplace', [App\Http\Controllers\ProductController::class, 'uploadViaMarketplace'])->name('product.marketplace');

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [ControllersOrderController::class, 'index'])->name('orders.index');
        Route::get('/{invoice}', [ControllersOrderController::class, 'view'])->name('orders.view');
        Route::get('/payment/{invoice}', [ControllersOrderController::class, 'acceptPayment'])->name('orders.approve_payment');
        Route::post('/shipping', [ControllersOrderController::class, 'shippingOrder'])->name('orders.shipping');
        Route::delete('/{id}', [ControllersOrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/return/{invoice}', [ControllersOrderController::class, 'return'])->name('orders.return');
        Route::post('/return', [ControllersOrderController::class, 'approveReturn'])->name('orders.approve_return');
    });

    Route::group(['prefix' => 'reports'], function () {
        Route::get('/order', [HomeController::class, 'orderReport'])->name('report.order');
        Route::get('/order/pdf/{daterange}', [HomeController::class, 'orderReportPdf'])->name('report.order_pdf');
        Route::get('/return', [HomeController::class, 'returnReport'])->name('report.return');
        Route::get('/return/pdf/{daterange}', [HomeController::class, 'returnReportPdf'])->name('report.return_pdf');
    });
});
