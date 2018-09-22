<?php

Route::get('/', function () {
    return view('welcome');
});

//--->webshop
Route::get('index','ShoppingController@index')->name('shop.index');

Route::get('index/detail/{id}','ShoppingController@detail')->name('shop.detail');

Route::get('index/detail/cart/{id}','ShoppingController@cart')->name('shop.addcart');

// Route::get('index/','ShoppingController@detail')->name('shop.detail');

Route::get('index/cart','ShoppingCart@index')->name('shop.cart');



//--->webshop
Route::get('admin','AdminController@index')->name('admin-shopping.index');

//--->webshoplogin

 // route dành cho admin
Route::prefix('admin')->group(function(){

	Route::get('login', 'AdminAuth\LoginController@showLoginForm')->name('admin_login');

	Route::post('login', 'AdminAuth\LoginController@login')->name('admin.login');
	
	Route::post('logout', 'AdminAuth\LoginController@logout')->name('adminlogout');

	// Registration Routes...
	Route::get('register', 'AdminAuth\RegisterController@showRegistrationForm')->name('admin_register');
	//route đăng kí admin
	Route::post('register', 'AdminAuth\RegisterController@register')->name('admin.register');

	// Password Reset Routes...
	Route::get('password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'AdminAuth\ResetPasswordController@reset');

	//sau khi đăng nhập xong sẽ được vào 
	Route::middleware('admin.auth')->group(function(){
		Route::get('dashboard',function(){
			return view('dashboard');

		});

	//-->quản lý products
	Route::get('product', 'ProductController@index')->name('product.index');


	Route::post('product/store','ProductController@store')->name('product.store');

	Route::post('upLoadImage','ProductController@upload')->name('product.upload');

	Route::get('product/show/{id}','ProductController@show')->name('product.show');

	Route::get('product/listProducts','ProductController@dataTableListProduct')->name('product.list');

	Route::get('product/{id}/edit','ProductController@edit')->name('product.edit');

	Route::post('product/{id}','ProductController@update')->name('product.update');

	Route::delete('product/{id}','ProductController@destroy');


	//Route add-detail-product
	Route::get('product/listProducts/detail/{id}','SubProductController@subDataTableProduct')->name('subProduct.list');

	Route::get('product/listProducts/{id}/edit','SubProductController@edit')->name('subProduct.edit');

	Route::post('product/listProducts/{id}','SubProductController@update')->name('subProduct.update');

	Route::post('product/listProducts/store/{id}','SubProductController@storeDetail')->name('subProduct.storeDetail');

	Route::delete('product/listProducts/{id}/delete/','SubProductController@destroy')->name('subProduct.destroy');



	//route admin
	//-->quản lý users
	Route::get('user', 'UserController@index')->name('user.index');

	Route::get('listUser','UserController@dataTableListUser')->name('user.list');

	Route::delete('user/delete/{id}','UserController@destroy');

	Route::get('user/show/{id}','UserController@show');

	Route::get('user/edit/{id}','UserController@edit')->name('user.edit');

	Route::put('user/update/{id}','UserController@update')->name('user.update'); 

	Route::post('user/store','UserController@store')->name('user.store');


	});


});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');







