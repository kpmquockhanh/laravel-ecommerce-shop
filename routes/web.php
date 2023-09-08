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

Route::prefix('admin')->group(function () {
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', 'App\Http\Controllers\SettingController@analytic')->name('admin.dashboard');

        Route::prefix('products')->group(function () {
            Route::get('/', 'App\Http\Controllers\AdminProductController@index')->name('admin.products.list');
            Route::get('create', 'App\Http\Controllers\AdminProductController@create')->name('admin.products.create');
            Route::post('create', 'App\Http\Controllers\AdminProductController@store');
            Route::get('edit/{id}', 'App\Http\Controllers\AdminProductController@edit')->name('admin.products.edit');
            Route::post('update', 'App\Http\Controllers\AdminProductController@update')->name('admin.products.update');
            Route::post('remove', 'App\Http\Controllers\AdminProductController@delete')->name('admin.products.remove');
            Route::post('change-status', 'App\Http\Controllers\AdminProductController@changeShowStatus')->name('admin.products.change-status');
        });

        Route::prefix('categories')->group(function () {
            Route::get('/', 'App\Http\Controllers\CategoryController@index')->name('admin.categories.list');
            Route::get('create', 'App\Http\Controllers\CategoryController@create')->name('admin.categories.create');
            Route::post('create', 'App\Http\Controllers\CategoryController@store');
            Route::get('edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('admin.categories.edit');
            Route::post('update', 'App\Http\Controllers\CategoryController@update')->name('admin.categories.update');
        });


        Route::prefix('settings')->group(function () {
            Route::get('/', 'App\Http\Controllers\SettingController@index')->name('admin.settings.list');
            Route::get('/create', 'App\Http\Controllers\SettingController@create')->name('admin.settings.create');
            Route::post('/create', 'App\Http\Controllers\SettingController@add')->name('admin.settings.add');
            Route::get('/edit/{id}', 'App\Http\Controllers\SettingController@edit')->name('admin.settings.edit');
            Route::post('/edit/{id}', 'App\Http\Controllers\SettingController@update')->name('admin.settings.update');
            Route::get('/delete/{id}', 'App\Http\Controllers\SettingController@delete')->name('admin.settings.delete');
        });
    });

    Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::get('/register', 'App\Http\Controllers\Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
    Route::get('/logout', 'App\Http\Controllers\Auth\AdminLoginController@logout')->name('admin.logout');

    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.post');
    Route::post('/register', 'App\Http\Controllers\Auth\AdminRegisterController@register')->name('admin.register.post');
});

// For vue frontend
Route::get('{any}', function () {
   return view('vue');
})->where('any', '.*')
->where('any', '^(?!.*api).*$');
