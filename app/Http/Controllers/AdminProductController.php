<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Traits\ListTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AdminProductController extends Controller
{
    use ListTrait;
    use UploadTrait;

    public function index(Request $request)
    {
        $products = Product::with('admin', 'images');

        if (!Auth::guard('admin')->user()->isAdmin)
            $products->where('created_by', Auth::guard('admin')->id());

        if ($search = $request->search) {
            $products->Where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($sort = $request->sort) {
            $products->orderBy($sort, 'desc');
        }

        $page = config('app.per_pages')[0];
        if ($paginate = $request->paginate)
            $page = $paginate;

        $viewData = [
            'items' => $products->paginate($page),
            'products' => $products->paginate($page),
            'queries' => $request->query(),
            'route' => 'products',
            'header' => 'Products',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                    'func' => function ($item) {
                        return $item->id;
                    },
                ],
                'title' => [
                    'title' => 'Title',
                    'func' => function ($item) {
                        return Str::limit($item->title, 20, '...');
                    },
                ],
                'image' => [
                    'title' => 'Image',
                    'func' => function ($item) {
                        return $item->thumbnail;
                    },
                ],
                'created_by' => [
                    'title' => 'Created By',
                    'func' => function ($item) {
                        return $item->admin->name;
                    },
                ],
                'price' => [
                    'title' => 'Price',
                ],
                'created_at' => [
                    'title' => 'Created At',
                    'func' => function ($item) {
                        return $item->created_at->diffForHumans();
                    },
                ],
                'updated_at' => [
                    'title' => 'Updated At',
                    'func' => function ($item) {
                        return $item->updated_at->diffForHumans();
                    },
                ],
                'actions' => [
                    'title' => 'Actions',
                    'items' => [
                        'active' => true,
                        'edit' => true,
                        'delete' => true,
                    ]
                ],
            ],
        ];

        return $this->processListVIew($request, $viewData);
    }

    public function create()
    {
        $viewData = [
            'categories' => Category::all(),
        ];

        return view('backend.products.add')->with($viewData);
    }

    public function store(ProductRequest $request)
    {
        $data = $this->getDataForStore($request, 'store');
        $product = Product::query()->create(array_merge($data));

        if ($image = $request->image) {
            $this->doUpload($image, $product->id, 'product');
        }

        $requestCategories = $request->categories;
        if ($requestCategories) {
            foreach ($requestCategories as $category) {
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
        if (!$id) {
            return redirect()->back();
        }

        $product = Product::with('categories')->with('images')->findOrFail($id);
        if (!$product->canChange()) {
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
            $currentCategories = array_column($product->categories->toArray(), 'id');

            $deleteCate = array_diff($currentCategories, $requestCategories);
            $addCategories = array_diff($requestCategories, $currentCategories);
            foreach ($addCategories as $addCate) {
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

        if ($image = $request->image) {
            $this->doUpload($image, $product->id, 'product');
        }

        return redirect(route('admin.products.edit', ['id' => $id]));
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse
    {
        $product = Product::with('images')->findOrFail($request->id);
        $images = $product->images;
        foreach ($images as $image) {
            Storage::delete($image->src);
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

    public function changeShowStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->id;
        $product = Product::query()->find($id);

        if (!$product) {
            return response()->json([
                'status' => false,
            ]);
        }


        if (!$product->canChange()) {
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
            'slug',
        ]);

        switch ($action) {
            case 'store':
                $data['created_by'] = Auth::guard('admin')->user()->id;
                break;
            case 'update':
                $id = $request->id;
                $product = Product::query()->findOrFail($id);
                if (!$product->canChange()) {
                    return [];
                }
                if ($request->image) {
                    $image = \App\Models\Image::query()
                        ->where('entity_type', 'product')
                        ->where('entity_id', $id)
                        ->where('is_thumbnail', true)
                        ->first();
                    if ($image) {
                        Storage::delete($image->src);
                        $image?->delete();
                    }
                }

                $data['updated_by'] = Auth::guard('admin')->user()->id;
                break;
        }
        return $data;
    }

    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        if (!$request->file) {
            return response()->json([
                'status' => false,
            ]);
        }
        if ($image = $request->file) {
            $this->doUpload($image, $request->id, 'product', false);
        }

        return response()->json([
            'status' => true,
        ]);
    }

    public function deleteImage(Request $request): \Illuminate\Http\JsonResponse
    {
        ini_set('memory_limit', '16M');
        $image = \App\Models\Image::query()->findOrFail($request->id);
        $timeStamp = explode('-', $image->src)[0];
        $deleteIds = [];
        Storage::delete($image->src);
        $deleteIds[] = $image->id;
        // Also delete origin image
        $otherImages = \App\Models\Image::query()->where([
            'entity_type' => 'product',
            'entity_id' => $image->entity_id,
        ])
            ->where('src', 'like', "$timeStamp%")
            ->where('id', '!=', $image->id)
            ->get();

        foreach ($otherImages as $otherImage) {
            Storage::delete($otherImage->src);
            $deleteIds[] = $otherImage->id;
        }

        if (\App\Models\Image::destroy($deleteIds)) {
            return response()->json([
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }
}
