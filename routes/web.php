<?php

/*======Start Routes for FrontendController======*/
Route::get('/','FrontendController@index');
Route::get('/contact/page','FrontendController@contact');
Route::get('/about/page','FrontendController@about');
Route::get('/faq/page','FrontendController@faq');

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
Route::get('register/github', 'GithubController@redirectToProvider');
Route::get('register/github/callback', 'GithubController@handleProviderCallback');





// Resource controller
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');


//middleware controller for customer
Route::get('home/customer', 'CustomerController@homecustomer');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');




// arithmetic oparation
Route::resource('arithmatic', 'ArithmaticController');
