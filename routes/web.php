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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Route::prefix('admin')->group(function(){

    //Dashboard Route

    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    //Login Route

    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    //Logout Route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    //Register Routes
    Route::get('/register', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'Auth\AdminRegisterController@register')->name('admin.register.submit');

    //Password Reset Route
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset')->name('admin.password.update');
});

Route::prefix('blogger')->group(function(){

    //Dashboard Route

    Route::get('/', 'BloggerController@index')->name('blogger.dashboard');
    //Login Route

    Route::get('/login', 'Auth\BloggerLoginController@showLoginForm')->name('blogger.login');
    Route::post('/login', 'Auth\BloggerLoginController@login')->name('blogger.login.submit');

    //Logout Route
    Route::post('/logout', 'Auth\BloggerLoginController@logout')->name('blogger.logout');

    //Register Routes
    Route::get('/register', 'Auth\BloggerRegisterController@showRegistrationForm')->name('blogger.register');
    Route::post('/register', 'Auth\BloggerRegisterController@register')->name('blogger.register.submit');

    //Password Reset Route
    Route::get('/password/reset', 'Auth\BloggerForgotPasswordController@showLinkRequestForm')->name('blogger.password.request');
    Route::post('/password/email', 'Auth\BloggerForgotPasswordController@sendResetLinkEmail')->name('blogger.password.email');
    Route::get('/password/reset/{token}', 'Auth\BloggerResetPasswordController@showResetForm')->name('blogger.password.reset');
    Route::post('/password/reset', 'Auth\BloggerResetPasswordController@reset')->name('blogger.password.update');
});
