<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $defaultNumberPaginate = 12;
        $products = Product::with('admin');

        if (!Auth::guard('admin')->user()->isAdmin() )
            $products->where('created_by', Auth::guard('admin')->id());

        if ($search = $request->search)
        {
            $products->Where('title','like', '%'.$search.'%')
                ->orWhere('description','like', '%'.$search.'%');
        }

        if ($sort = $request->sort)
        {
            $products->orderBy($sort, 'desc');
        }

        $page = $defaultNumberPaginate;
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'products' => $products->paginate($page),
            'queries' => $request->query(),
        ];

        if ($request->list_type == 'table') {
            Session::put('list_type', 'table');
        }elseif ($request->list_type == 'grid') {
            Session::put('list_type', 'grid');
        }

        if (Session::get('list_type') == 'table') {
            return view('backend.products.list-table')->with($viewData);
        }
        return view('backend.products.list')->with($viewData);
    }

    public function create()
    {
        if (!Auth::guard('admin')->user()->status)
            return redirect(route('admin.products.list'));

        $viewData = [
            'categories' => Category::all(),
        ];

        return view('backend.products.add')->with($viewData);
    }

    public function store(ProductRequest $request)
    {
        if (!Auth::guard('admin')->user()->status)
            return redirect(route('admin.products.list'));

        $data = $this->getDataForStore($request, 'store');
        $product = Product::query()->create(array_merge($data));

        if ($image = $request->image)
        {
            $this->processImage($image, $product->id);
        }

        $requestCategories = $request->categories;
        if ($requestCategories)
        {
            foreach ($requestCategories as $category)
            {
                ProductCategory::query()->insert([
                    'product_id' => $product->id,
                    'category_id' => $category,
                ]);
            }
        }

        return redirect(route('admin.products.list'));
    }


    public function edit($id)
    {
        if (!$id)
        {
            return redirect()->back();
        }

        $product = Product::with('categories')->with('images')->findOrFail($id);
        if (!$product->canChange())
        {
            return redirect(route('admin.products.list'))->withErrors(['noPermission' => 'You have no permission to change this product!']);
        }

        $viewData = [
            'categories' => Category::all(),
            'product' => $product,
            'listIdCate' => $product->categories->pluck('id')->all(),
        ];
        return view('backend.products.edit')->with($viewData);
    }

    public function update(ProductRequest $request)
    {
        $id = $request->id;
        $product = Product::query()->findOrFail($request->id);
        //Update category of product
        $requestCategories = $request->categories;
        if ($requestCategories) {
            $currentCategories = array_column($product->categories->toArray(),'id');

            $deleteCate = array_diff($currentCategories, $requestCategories);
            $addCategories = array_diff($requestCategories, $currentCategories);
            foreach ($addCategories as  $addCate) {
                ProductCategory::query()->insertOrIgnore([
                    'product_id' => $id,
                    'category_id' => $addCate,
                ]);
            }

            ProductCategory::query()->where('product_id', $id)
                ->whereIn('category_id', $deleteCate)->delete();
        }

        $data = $this->getDataForStore($request, 'update');

        $product->update($data);

        if ($image = $request->image)
        {
            $this->processImage($image, $product->id);
        }

        return redirect(route('admin.products.edit', ['id' => $id]));
    }

    public function delete(Request $request)
    {
        $product = Product::with('images')->findOrFail($request->id);
        $images = $product->images;
        foreach ($images as $image)
        {
            File::delete(public_path('images').'\\'.$image->src);
        }
        if (Product::destroy($request->id)) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    public function changeShowStatus(Request $request)
    {
        $id = $request->id;
        $product = Product::query()->find($id);

        if (!$product)
        {
            return response()->json([
                'status' => false,
            ]);
        }


        if (!$product->canChange())
        {
            return response()->json([
                'status' => false,
            ]);
        }

        $product->update([
            'active' => !$product->active
        ]);

        return response()->json([
            'status' => true,
        ]);
    }

    public function getDataForStore(Request $request, string $action): array
    {
        $data = $request->only([
            'title',
            'message',
            'price',
            'description',
        ]);

        switch ($action) {
            case 'store':
                $data['created_by'] = Auth::guard('admin')->user()->id;
                break;
            case 'update':
                $id = $request->id;
                $product = Product::query()->findOrFail($id);
                if (!$product->canChange())
                {
                    return [];
                }
                if ($request->image)
                {
                    File::delete(public_path('images').'\\'.$product->image);
                    $image = \App\Models\Image::query()->where('entity_type', 'product')
                        ->where('entity_id', $id)
                        ->where('is_thumbnail', true)
                        ->first();
                    $image?->delete();
                }

                $data['updated_by'] = Auth::guard('admin')->user()->id;
                break;
        }
        return $data;
    }
    private function processImage($image, $productId): string
    {
        ini_set('memory_limit','256M');
        $name = time().'.'.$image->getClientOriginalExtension();
        Image::make($image)
            ->resize(null, 500, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->insert('img/watermark.png','top-right', 20,20)
            ->save(public_path('images').'/'.$name);

        \App\Models\Image::query()->create([
            'entity_type' => 'product',
            'entity_id' => $productId,
            'is_thumbnail' => true,
            'src' => $name,
        ]);
        return $name;
    }
}
