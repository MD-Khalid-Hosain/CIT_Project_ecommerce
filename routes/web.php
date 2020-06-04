<?php

/*======Start Routes for FrontendController======*/
Route::get('/','FrontendController@index');
Route::get('/contact/page','FrontendController@contact');
Route::get('/about/page','FrontendController@about');
Route::get('/faq/page','FrontendController@faq');
Route::get('/shop/page','FrontendController@shop');

/*======End Routes for FrontendController======*/



/*======Start Routes for HomeController======*/
Route::get('/user/list', 'HomeController@user_list');

//form
Route::get('/faq/form', 'HomeController@faq_form')->name('faq_form');
Route::post('/faq/form/post', 'HomeController@faq_form_post')->name('faq_form_post');

//delete route
Route::get('/faq/form/delete/{faq_id}', 'HomeController@faq_form_delete')->name('faq_form_delete');
// edit route
Route::get('/faq/form/edit/{faq_id}', 'HomeController@faq_form_edit')->name('faq_form_edit');
Route::post('/faq/form/update', 'HomeController@faq_form_update')->name('faq_form_update');

//soft_delete
Route::get('/faq/soft_delete', 'HomeController@faq_soft_delete')->name('faq_soft_delete');
//restor
Route::get('/faq/undo/{faq_id}', 'HomeController@faq_undo')->name('faq_undo');
//force delete
Route::get('/faq/force/delete/{faq_id}', 'HomeController@faq_force_delete')->name('faq_force_delete');

//change Password
Route::post('/change/password', 'HomeController@change_password')->name('change_password');

Route::get('/edit/profile', 'HomeController@edit_profile');
/*======End Routes for HomeController======*/



//socialite routes
Route::get('login/github', 'GithubController@redirectToProvider');
Route::get('register/github/callback', 'GithubController@handleProviderCallback');

//google socialite routes
Route::get('login/google', 'GoogleController@redirectToProvider');
Route::get('register/google/callback', 'GoogleController@handleProviderCallback');

//cart controller start
Route::post('add/to/cart', 'CartController@addtocart');
Route::get('delete/from/cart/{cart_id}', 'CartController@delete_from_cart');
Route::post('update/cart', 'CartController@update_cart');
Route::get('cart', 'CartController@cart');
Route::get('cart/{coupon_name}', 'CartController@cart');

//cart controller end
 //checkout controller
 Route::post('checkout','CheckoutController@index');
 Route::post('checkout/post','CheckoutController@checkoutpost');
 // ajax request link
 Route::post('get/city/list','CheckoutController@get_city_list');
 Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');


// Resource controller
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('coupon', 'CouponController');


//middleware controller for customer
Route::get('home/customer', 'CustomerController@homecustomer');
Route::get('order/download/{order_id}', 'CustomerController@order_download');
Route::get('send/sms/{order_id}', 'CustomerController@sendsms');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');




// arithmetic oparation
Route::resource('arithmatic', 'ArithmaticController');
