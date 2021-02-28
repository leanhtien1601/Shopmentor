<?php

use Illuminate\Support\Facades\Route;


//ADMIN
Route::group([
    'prefix' => '/admin',
    'namespace' => 'Admin'
], function () {
    //dashboard
    Route::get('/', 'DashboardController@index')
        ->name('Dashboard');

    //invoice
    Route::match(['get', 'post'], '/invoice-coupon-{id}.html', 'OrderController@invoice')
        ->name('invoice');
    Route::match(['get', 'post'], '/invoice-{id}.html', 'OrderController@print_invoice')
        ->name('invoice.print');

    //view
    Route::match(['get', 'post'], '/view-{id}.html', 'ViewController@updateView')
        ->name('product.view');

    //coupon
    Route::match(['get', 'post'], '/list-coupon.html', 'CouponController@index')
        ->name('coupon.list');
    Route::match(['get', 'post'], '/add-coupon.html', 'CouponController@add')
        ->name('coupon.add');
    Route::match(['get', 'post'], '/update-coupon-{id}.html', 'CouponController@updateStatus')
        ->name('coupon.updateStatus');
    Route::match(['get', 'post'], '/updateTrue-coupon-{id}.html', 'CouponController@updateTrue')
        ->name('coupon.updateTrue');

    //information
    Route::match(['get', 'post'], '/add-information.html', 'InformationController@add')
        ->name('information.add');

    //FeedShip
    Route::match(['get', 'post'], '/add-feedShip.html', 'FeedShipController@add')
        ->name('feedShip.add');
    Route::match(['get', 'post'], '/insert-feedShip.html', 'FeedShipController@insert')
        ->name('feedShip.insert');
    Route::match(['get', 'post'], '/listfeedShip.html', 'FeedShipController@list')
        ->name('feedShip.list');
    Route::match(['get', 'post'], '/list-feedShip.html', 'FeedShipController@selectCity')
        ->name('select.city');

    //order
    Route::match(['get', 'post'], '/list-order.html', 'OrderController@index')
        ->name('order.list');
    Route::match(['get', 'post'], '/statusVery-{id}.html', 'OrderController@statusVery')
        ->name('order.statusVery');
    Route::match(['get', 'post'], '/statusFalse-{id}.html', 'OrderController@statusFalse')
        ->name('order.statusFalse');

    //sendMail
    Route::match(['get', 'post'], '/send-mail-{id}.html', 'SendMailController@send')
        ->name('sendMail.index');
    Route::match(['get', 'post'], '/sendMail.html', 'SendMailController@index')
        ->name('sendMail');

    //order detail
    Route::match(['get', 'post'], '/list-orderDetail-{id}.html', 'OrderDetailController@index')
        ->name('order_detail.list');

    //Category
    Route::match(['get', 'post'], '/category-add.html', 'CategoryController@add')
        ->name('category.add');
    Route::match(['get', 'post'], '/updateCategory-{id}-{slug}', 'CategoryController@update')
        ->name('category.update');
    Route::match(['get', 'post'], '/update-{id}', 'CategoryController@updateStatus')
        ->name('category.updateStatus');
    Route::match(['get', 'post'], '/updateTrue-{id}', 'CategoryController@updateTrue')
        ->name('category.updateTrue');
    Route::get('/category-list.html', 'CategoryController@index')
        ->name('category.list');

    //Product
    Route::match(['get', 'post'], '/product-add', 'ProductController@add')
        ->name('product.add');
    Route::match(['get', 'post'], '/product-list', 'ProductController@index')
        ->name('product.list');
    Route::match(['get', 'post'], '/updateProduct-{id}-{slug}', 'ProductController@update')
        ->name('product.update');
    Route::match(['get', 'post'], '/updateProduct-{id}', 'ProductController@updateStatus')
        ->name('product.updateStatus');
    Route::match(['get', 'post'], '/updateProductTrue-{id}', 'ProductController@updateTrue')
        ->name('product.updateTrue');

    //user Admin
    Route::match(['get', 'post'], '/admin-login', 'AdminController@login')
        ->name('admin.login');
    Route::match(['get', 'post'], '/admin-register', 'AdminController@register')
        ->name('admin.register');
    Route::match(['get', 'post'], '/admin-logout', 'AdminController@logout')
        ->name('admin.logout');

    //ImageProduct
    Route::match(['get', 'post'], '/addImage-{slug}', 'ImageProductController@add')
        ->name('imageProduct.add');
    Route::get('/product-{id}-{slug}', 'ImageProductController@index')
        ->name('imageProduct.list');
    Route::match(['get', 'post'], '/editImage-{id}', 'ImageProductController@edit')
        ->name('imageProduct.edit');

    //News
    Route::match(['get', 'post'], '/addNews', 'NewsController@add')
        ->name('news.add');
    Route::match(['get', 'post'], '/list-News', 'NewsController@index')
        ->name('news.list');
    Route::match(['get', 'post'], '/update-{slug}', 'NewsController@update')
        ->name('news.update');
});


//MAIN
Route::group([
    'prefix' => '/',
    'namespace' => 'Main'
], function () {
    //home
    Route::get('/', 'HomeController@index')
        ->name('Home');

    //search
    Route::match(['get','post'],'/search', 'HomeController@search')
        ->name('product.search');
    Route::match(['get','post'],'/search-detail', 'HomeController@searchProduct')
        ->name('product.searchProduct');

    //Login facebook
    Route::get('/login-facebook','UsersController@loginFace')
    ->name('facebook');
    Route::get('/callback','UsersController@callback');

    //add wish list
    Route::match(['get'],'/add-wishlist.html', 'WishListController@add')
        ->name('wishlist.add');
    Route::match(['get','post'],'/show-wishlist.html', 'WishListController@show')
        ->name('wishlist.show');
    Route::match(['get','post'],'/delete-{id}-wishlist.html', 'WishListController@delete')
        ->name('wishlist.delete');

    //product
    Route::get('/list{id}-{slug}.html', 'ProductController@index')
        ->name('list.product');
    Route::get('/product-{id}-{slug}.html', 'ProductController@detailProduct')
        ->name('detail.product');

    //Cart
    Route::match(['get','post'],'/cartAdd-product.html', 'CartController@addCart')
        ->name('cart.add');
    Route::match(['get','post'],'/cart-product.html', 'CartController@index')
        ->name('cart.product');
    Route::match(['get','post'],'/show-cart.html', 'CartController@showCart')
        ->name('cart.show');
    Route::match(['get','post'],'/delete-cart-{id}.html', 'CartController@deleteCart')
        ->name('cart.delete');
    Route::match(['get','post'],'/update-cart.html', 'CartController@update')
        ->name('cart.update');
    Route::match(['get','post'],'/huy-cart.html', 'CartController@delete')
        ->name('cart.huy');
    Route::match(['get', 'post'], '/use-coupon.html', 'CartController@checkCode')
        ->name('checkCode');


    //Checkout
    Route::match(['get','post'],'/checkout-cart.html', 'CheckoutController@index')
        ->name('checkout.add');
    Route::match(['get','post'],'/select-cart.html', 'CheckoutController@select')
        ->name('checkout.select');
    Route::match(['get','post'],'/count-cart.html', 'CheckoutController@count_fee')
        ->name('checkout.count_fee');
    Route::match(['get','post'],'/thank-you.html', 'CheckoutController@thankYou')
        ->name('thankyou');


    //Users
    Route::match(['get','post'],'/login', 'UsersController@login')
        ->name('users.login');
    Route::match(['get','post'],'/registration', 'UsersController@registration')
        ->name('users.registration');
    Route::match(['get','post'],'/logout', 'UsersController@logout')
        ->name('users.logout');
    Route::match(['get','post'],'/changepass-{id}', 'UsersController@changepass')
        ->name('users.changepass');
    Route::match(['get','post'],'/changeUser-{id}', 'UsersController@changeUser')
        ->name('users.changeUser');
    Route::match(['post', 'get'], 'forget-pass', 'UsersController@forgetPass')
        ->name('forget.pass');
    Route::match(['get', 'post'], 'recover-pass', 'UsersController@recoverPass')
        ->name('recover.pass');
    Route::get('update-new-pass', 'UsersController@updatePass')
        ->name('update.pass');
    Route::match(['get', 'post'], 'reset-pass', 'UsersController@resetPass')
        ->name('resetPass');

    //news
    Route::get('/list-new.html', 'PostController@index')
        ->name('list.post');
    Route::get('/post-{slug}.html', 'PostController@detailPost')
        ->name('detail.post');
});


