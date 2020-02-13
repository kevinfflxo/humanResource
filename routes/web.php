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
    | Login route
    |----------------------------------------------
    */
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');;
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    
    /*
    |----------------------------------------------
    | password reset route
    |----------------------------------------------
    */
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
    Route::get('password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    /*
    |----------------------------------------------
    | admin pages route
    |----------------------------------------------
    */
    Route::get('/', 'AdminPagesController@index')->name('admin.index');
    Route::get('posts', 'AdminPagesController@create')->name('admin.create');
    Route::post('posts', 'AdminPagesController@store')->name('admin.store');
});

Route::prefix('user')->group(function () {
	Route::get('/', 'PagesController@index')->name('user.index');
	Route::get('/userLogout', 'Auth\LoginController@userLogout')->name('user.logout');
});