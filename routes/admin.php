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

Route::prefix('')->group(function () {
    Route::middleware('auth.admin')->group(function () {
        Route::get('/', [App\Http\Controllers\SettingController::class, 'analytic'])->name('admin.dashboard');

        // Products
        Route::prefix('products')->group(function () {
            Route::middleware('can:'. \App\Enums\PermissionEnum::VIEW_PRODUCT->value)
                ->get('/', [App\Http\Controllers\AdminProductController::class, 'index'])
                ->name('admin.products.list');
            Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_PRODUCT->value)
                ->get('create', [App\Http\Controllers\AdminProductController::class, 'create'])
                ->name('admin.products.create');
            Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_PRODUCT->value)
                ->post('create', [App\Http\Controllers\AdminProductController::class, 'store']);
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_PRODUCT->value)
                ->get('edit/{id}', [App\Http\Controllers\AdminProductController::class, 'edit'])
                ->name('admin.products.edit');
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_PRODUCT->value)
                ->post('upload/{id}', [App\Http\Controllers\AdminProductController::class, 'upload'])
                ->name('admin.products.upload');
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_PRODUCT->value)
                ->post('update/{id}', [App\Http\Controllers\AdminProductController::class, 'update'])
                ->name('admin.products.update');
            Route::middleware('can:'. \App\Enums\PermissionEnum::DELETE_PRODUCT->value)
                ->post('remove', [App\Http\Controllers\AdminProductController::class, 'delete'])
                ->name('admin.products.remove');
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_PRODUCT->value)
                ->post('delete-image', [App\Http\Controllers\AdminProductController::class, 'deleteImage'])
                ->name('admin.products.delete_image');
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_PRODUCT->value)
                ->post('change-status', [App\Http\Controllers\AdminProductController::class, 'changeShowStatus'])
                ->name('admin.products.change-status');

            // Categories
            Route::prefix('categories')->group(function () {
                Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('admin.categories.list');
                Route::middleware('can:create_category')
                    ->get('create', [App\Http\Controllers\CategoryController::class, 'create'])
                    ->name('admin.categories.create');
                Route::middleware('can:create_category')
                    ->post('create', [App\Http\Controllers\CategoryController::class, 'store']);
                Route::middleware('can:edit_category')
                    ->get('edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])
                    ->name('admin.categories.edit');
                Route::middleware('can:edit_category')
                    ->post('update', [App\Http\Controllers\CategoryController::class, 'update'])
                    ->name('admin.categories.update');
            });
        });


        // BLogs
        Route::prefix('blogs')->group(function () {
            Route::middleware('can:'. \App\Enums\PermissionEnum::VIEW_BLOG->value)
                ->get('/', [App\Http\Controllers\BlogController::class, 'index'])
                ->name('admin.blogs.list');
            Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_BLOG->value)
                ->get('create', [App\Http\Controllers\BlogController::class, 'create'])
                ->name('admin.blogs.create');
            Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_BLOG->value)
                ->post('create', [App\Http\Controllers\BlogController::class, 'store']);
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_BLOG->value)
                ->get('edit/{id}', [App\Http\Controllers\BlogController::class, 'edit'])
                ->name('admin.blogs.edit');
            Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_BLOG->value)
                ->post('update', [App\Http\Controllers\BlogController::class, 'update'])
                ->name('admin.blogs.update');
            Route::middleware('can:'. \App\Enums\PermissionEnum::DELETE_BLOG->value)
                ->post('remove', [App\Http\Controllers\BlogController::class, 'delete'])
                ->name('admin.blogs.remove');

            // Blog Categories
            Route::prefix('categories')->group(function () {
                Route::middleware('can:'. \App\Enums\PermissionEnum::VIEW_BLOG_CATEGORY->value)
                    ->get('/', [App\Http\Controllers\BlogCategoryController::class, 'index'])
                    ->name('admin.blog_categories.list');
                Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_BLOG_CATEGORY->value)
                    ->get('create', [App\Http\Controllers\BlogCategoryController::class, 'create'])
                    ->name('admin.blog_categories.create');
                Route::middleware('can:'. \App\Enums\PermissionEnum::CREATE_BLOG_CATEGORY->value)
                    ->post('create', [App\Http\Controllers\BlogCategoryController::class, 'store']);
                Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_BLOG_CATEGORY->value)
                    ->get('edit/{id}', [App\Http\Controllers\BlogCategoryController::class, 'edit'])
                    ->name('admin.blog_categories.edit');
                Route::middleware('can:'. \App\Enums\PermissionEnum::EDIT_BLOG_CATEGORY->value)
                    ->post('update', [App\Http\Controllers\BlogCategoryController::class, 'update'])
                    ->name('admin.blog_categories.update');
            });
        });


        // Settings
        Route::prefix('settings')->middleware('can:'. \App\Enums\PermissionEnum::MANAGE_SETTINGS->value)->group(function () {
            Route::get('/', [App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.list');
            Route::get('/create', [App\Http\Controllers\SettingController::class, 'create'])->name('admin.settings.create');
            Route::post('/create', [App\Http\Controllers\SettingController::class, 'add'])->name('admin.settings.add');
            Route::get('/edit/{id}', [App\Http\Controllers\SettingController::class, 'edit'])->name('admin.settings.edit');
            Route::post('/edit/{id}', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');
            Route::post('/remove', [App\Http\Controllers\SettingController::class, 'delete'])->name('admin.settings.delete');

            // Images
            Route::get('/uploaded-imgs', [App\Http\Controllers\SettingController::class, 'indexUploadedImages'])
                ->middleware('can:'. \App\Enums\PermissionEnum::MANAGE_IMAGES->value)
                ->name('admin.settings.uploaded_images');
        });

        Route::prefix('accounts')->middleware('can:'. \App\Enums\PermissionEnum::MANAGE_ACCOUNTS->value)->group(function () {
            Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('admin.accounts.list');
            Route::get('/create', [App\Http\Controllers\AccountController::class, 'create'])->name('admin.accounts.create');
            Route::post('/create', [App\Http\Controllers\AccountController::class, 'add'])->name('admin.accounts.add');
            Route::get('/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit'])->name('admin.accounts.edit');
            Route::post('/edit/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('admin.accounts.update');
            Route::post('/remove', [App\Http\Controllers\AccountController::class, 'delete'])->name('admin.accounts.delete');
        });
    });

    // Auth
    Route::get('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::get('/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::post('/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.post');
    Route::post('/register', [App\Http\Controllers\Auth\AdminRegisterController::class, 'register'])->name('admin.register.post');
});

