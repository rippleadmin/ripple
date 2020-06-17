<?php

use Illuminate\Support\Facades\Route;

Route::name('water.')->group(function () {
    // Pages
    Route::get('/', 'HomeController@index')->name('home');

    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login.send');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});
