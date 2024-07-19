<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('cache.headers:public;max_age=2628000;etag')->get('{any}', function () {
    return view('vue');
})->where('any', '.*')
    ->where('any', '^(?!.*api).*$');
