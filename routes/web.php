<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomerAuthenticationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\subcategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ShopGridController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TeamController;

// customer login authentication
Route::get('/customer/authentication', [CustomerAuthenticationController::class, 'customer_authentication'])->name('customer.authentication');
Route::post('/customer/login', [CustomerAuthenticationController::class, 'customer_login_authentication']);
Route::post('/customer/register', [CustomerAuthenticationController::class, 'customer_register_authentication']);
Route::get('/customer/logout', [CustomerAuthenticationController::class, 'customer_logout'])->name('customer.logout');


// frontend 
Route::get('/master', [FrontendController::class, 'master'])->name('master');
Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/product/details/{product_id}', [FrontendController::class, 'product_details'])->name('product.details');
Route::get('/customer/account/', [FrontendController::class, 'customer_account'])->name('customer.account');
Route::post('/account/update', [FrontendController::class, 'customer_account_update']);

// invoice download
Route::get('/invoice/download/{id}', [InvoiceController::class, 'invoiceDownload'])->name('invoice.download');

// product search
Route::get('/product-list', [FrontendController::class, 'productListAjax']);
Route::post('/searched/product', [FrontendController::class, 'searchedProduct']);

// wishlist
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::post('/add/wishlist', [WishlistController::class, 'add_wishlist']);
Route::post('/remove/wishlist/product', [WishlistController::class, 'remove_wishlist']);
Route::post('/cart/add/product', [WishlistController::class, 'cart_product_add']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Dashboard
Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'admin_profile'])->name('admin.profile');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/user/delete/{id}', [DashboardController::class, 'user_delete'])->name('user.delete');
    // team
    Route::get('/team', [TeamController::class, 'index'])->name('team');
    Route::post('/team/member/store', [TeamController::class, 'store'])->name('store');
    Route::post('/team/member/delete', [TeamController::class, 'destroy'])->name('teamMember.delete');
    Route::get('/getMemberInfo/{id}', [TeamController::class, 'edit'])->name('edit');
    Route::post('/team/member/update', [TeamController::class, 'update'])->name('member.update');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('brand.store');
    Route::post('/change/status', [BrandController::class, 'status_change'])->name('change-status');

    // Category
    // Route::view('/category','category.category');
    Route::get('/category', [CategoryController::class, 'category'])->name('category');
    Route::get('/category/add', [CategoryController::class, 'category_add'])->name('category.add');
    Route::get('/category/trashed', [CategoryController::class, 'category_trashed'])->name('category.trashed');
    Route::post('/category/insert', [CategoryController::class, 'category_insert']);
    Route::get('/category/soft/delete/{id}', [CategoryController::class, 'category_soft_delete'])->name('category.soft.delete');
    Route::get('/category/restore/{id}', [CategoryController::class, 'category_restore'])->name('category.restore');
    Route::get('/category/hard/delete/{id}', [CategoryController::class, 'category_hard_delete'])->name('category.hard.delete');
    Route::get('/category/edit/{id}', [CategoryController::class, 'category_edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'category_update']);
    Route::post('/category/mark/delete', [CategoryController::class, 'category_mark_delete']);
    Route::post('/trashed/category/restore/delete', [CategoryController::class, 'category_mark_restore_delete']);

    // subcategories route
    Route::get('/subcategory/add', [subcategoryController::class, 'add_subcategory'])->name('subcategory.add');
    Route::get('/subcategory/index', [subcategoryController::class, 'index'])->name('subcategory');
    Route::post('/subcategory/insert', [subcategoryController::class, 'insert']);
    Route::get('/subcategory/delete/{id}', [subcategoryController::class, 'delete'])->name('subcategory.delete');
    Route::get('/subcategory/edit/{id}', [subcategoryController::class, 'edit'])->name('subcategory.edit');
    Route::post('/subcategory/update', [subcategoryController::class, 'update']);

    // products route
    Route::get('/product', [ProductController::class, 'index'])->name('add.product');
    Route::get('/product/view', [ProductController::class, 'view_products'])->name('view.product');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit_products'])->name('product.edit');
    Route::post('/product/insert', [ProductController::class, 'product_insert']);
    Route::get('/product/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');
    Route::post('/getCategory', [ProductController::class, 'getCategory']);
    Route::post('/product/update', [ProductController::class, 'product_update']);

    // coupon
    Route::get('/coupon', [CouponController::class, 'coupon'])->name('add.coupon');
    Route::post('/coupon/insert', [CouponController::class, 'coupon_insert']);
    Route::get('/coupon/delete/{id}', [CouponController::class, 'delete']);

    // orders details
    Route::get('/orders', [DashboardController::class, 'orderDetails'])->name('orders');
    Route::get('/order/delete/{id}', [DashboardController::class, 'orderDelete'])->name('order.delete');

    
    // contact
    Route::get('/contact/messages', [ContactController::class, 'contact_messages'])->name('contact.messages');
    Route::get('/contact/message/delete/{id}', [ContactController::class, 'contact_message_delete'])->name('contact.message.delete');
});
// about 
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/message/insert', [ContactController::class, 'contact_message_insert']);
// shop grid
Route::get('/shop/grid', [ShopGridController::class, 'index'])->name('shop.grid');
Route::get('/filter/category/product/{id}', [ShopGridController::class, 'filter_category_product'])->name('filter.category.product');
Route::post('/sort/product', [ShopGridController::class, 'sort_products']);

// cart
Route::post('/cart/insert', [CartController::class, 'cart_insert']);
Route::get('/cart/remove/{id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'cart_update']);
// Route::post('/cart', [CartController::class, 'cart']);


// checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

// orders
Route::post('/order/placed', [CheckoutController::class, 'order_insert']);
Route::post('/getCity', [CheckoutController::class, 'getCity']);
Route::get('/order/confirm', [CheckoutController::class, 'order_confirm'])->name('ordered_confirm');


// SSLCOMMERZ Start
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// subscribers
Route::post('/subscribe/submit', [SubscriberController::class, 'index'])->name('subscriber.insert');
