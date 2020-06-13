<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

// Assets
Route::get('/assets/{file}', 'AssetController')->where('file', '.*')->name('water.asset');
