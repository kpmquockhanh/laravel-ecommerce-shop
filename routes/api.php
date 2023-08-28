<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Product;
use \App\Http\Resources\ProductCollection;
use \App\Http\Resources\ProductResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/products')->group(function () {
    Route::get('/', function (Request $request) {
        $products = Product::with(['categories']);
        if ($request->category) {
            $products->whereHas('categories', function ($query) {
                $query->where('categories.id', request()->query('category'));
            });
        }
        if ($request->sort && in_array($request->sort, ['asc', 'desc'])) {
            $products->orderBy('id', request()->query('sort'));
        }

        $limit = 50;
        if ($request->limit) {
            $limit = $request->limit;
        }
        return new ProductCollection($products->paginate($limit)->appends(request()->query()));
    });
    Route::get('/newest', function () {
        return new ProductCollection(Product::with(['categories', 'images'])->orderBy('id', 'desc')->limit(8)->get());
    });
    Route::get('/featured', function () {
        return new ProductResource(Product::query()->first());
    });
    Route::get('/similar/{id}', function ($id) {
        $product = Product::with('categories')->findOrFail($id);
        $categoryIds = [];
        foreach ($product->categories as $category) {
            $categoryIds[] = $category->id;
        }
        return new ProductCollection(Product::with(['categories'])
            ->whereHas('categories', function ($query) use ($categoryIds) {
                return $query->where('categories.id', $categoryIds);
            })
            ->where('id', '!=', $id)
            ->orderBy('id', 'desc')->limit(8)->get());
    })->where('id', '\d+');
    Route::get('/{id}', function ($id) {
        return new ProductResource(Product::query()->findOrFail($id));
    })->where('id', '\d+');
    Route::get('/{slug}', function ($slug) {
        return new ProductResource(Product::with('images')->where(['slug' => $slug])->firstOrFail());
    });
});


Route::prefix('/categories')->group(function () {
    Route::get('/newest', function () {
        return new \App\Http\Resources\CategoryCollection(\App\Models\Category::query()->orderBy('id', 'desc')->limit(3)->get());
    });
    Route::get('/', function () {
        return new \App\Http\Resources\CategoryCollection(\App\Models\Category::query()->orderBy('id', 'desc')->limit(100)->get());
    });
});
