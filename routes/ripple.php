<?php

use Illuminate\Support\Facades\Route;

Route::name('ripple.')->group(function () {

    // // Authentication Routes...
    // Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    // Route::post('login', 'Auth\LoginController@login')->name('login.send');
    // Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // // Ripple Main Routes...
    // Route::middleware('ripple.auth')->group(function () {
    //     Route::get('/', 'HomeController@index')->name('home');
    // });

    Route::get('/', 'HomeController@index')->name('home');

});
