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

Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| laravel Auth route
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| Kevin auth route
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    /*
    |----------------------------------------------
    | admin login route
    |----------------------------------------------
    */
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');;
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    /*
    |----------------------------------------------
    | admin password reset route
    |----------------------------------------------
    */
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    /*
    |----------------------------------------------
    | admin notifictions route
    |----------------------------------------------
    */
    Route::get('/notifications', 'AdminNotificationsController@index')->name('admin.notification.index');
    Route::get('/notifications/{id}', 'AdminNotificationsController@show')->name('admin.notification.show');
    Route::get('/notifications/{id}/edit', 'AdminNotificationsController@edit')->name('admin.notification.edit');
    Route::put('/notifications/{id}', 'AdminNotificationsController@update')->name('admin.notification.update');
    Route::delete('/notifications/{id}', 'AdminNotificationsController@destroy')->name('admin.notification.destroy');
    /*
    |----------------------------------------------
    | admin pages route
    |----------------------------------------------
    */
    Route::get('/', 'AdminPagesController@index')->name('admin.index');
    Route::get('/posts', 'AdminPagesController@create')->name('admin.create');
    Route::post('/posts', 'AdminPagesController@store')->name('admin.store');
    Route::get('/{id}', 'AdminPagesController@show')->name('admin.show');
    Route::get('/{id}/edit', 'AdminPagesController@edit')->name('admin.edit');
    Route::put('/{id}', 'AdminPagesController@update')->name('admin.update');
    Route::delete('/{id}', 'AdminPagesController@destroy')->name('admin.destroy');
    
});

Route::prefix('user')->group(function () {
    /*
    |----------------------------------------------
    | user pages route
    |----------------------------------------------
    */
	Route::get('/', 'PagesController@index')->name('user.index');
	Route::get('/userLogout', 'Auth\LoginController@userLogout')->name('user.logout');
    Route::get('/{id}', 'PagesController@show')->name('user.show');
    Route::get('/{id}/edit', 'PagesController@edit')->name('user.edit');
    Route::put('/{id}', 'PagesController@update')->name('user.update');
});

/*
|----------------------------------------------
| display image route
|----------------------------------------------
*/
Route::get('image/{filename}', 'ImageController@displayImage')->name('image.displayImage');