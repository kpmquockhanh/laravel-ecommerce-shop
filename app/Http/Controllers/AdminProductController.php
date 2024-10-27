<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariant;
use App\Traits\ListTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

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
                    'class' => 'font-weight-bold',
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
                    'type' => 'currency',
                ],
                'compare_price' => [
                    'title' => 'Compare Price',
                    'func' => function ($item) {
                        return $item->compare_price ?? 0;
                    },
                    'type' => 'currency',

                ],
                'created_at' => [
                    'title' => 'Created At',
                    'func' => function ($item) {
                        return $item->created_at->diffForHumans();
                    },
                    'class' => 'text-italic',
                ],
                'updated_at' => [
                    'title' => 'Updated At',
                    'func' => function ($item) {
                        return $item->updated_at->diffForHumans();
                    },
                    'class' => 'text-italic',
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

        $product = Product::with('categories', 'images', 'variants')->findOrFail($id);
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

        $variantNames = $request->get('variant_names');
        $prices = $request->get('prices');
        $comparePrices = $request->get('compare_prices');
        $variantIds = $request->get('variant_ids');

        $insertVariants = [];
        $updateVariants = [];

        foreach ($variantNames as $key => $variantName) {
            if (!$variantName || !$prices[$key]) {
                continue;
            }

            $variantId = $variantIds[$key];

            if ($variantId) {
                $updateVariants[] = [
                    'id' => $variantId,
                    'name' => $variantName,
                    'price' => $prices[$key],
                    'compare_price' => $comparePrices[$key],
                    'product_id' => $id,
                    "updated_at" => date('Y-m-d H:i:s'),
                ];
                continue;
            }

            $insertVariants[] = [
                'name' => $variantName,
                'price' => $prices[$key],
                'compare_price' => $comparePrices[$key],
                'id' => $variantIds[$key],
                'product_id' => $id,
                'sku' => Str::random(10),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s'),
            ];
        }

        if (count($insertVariants) > 0) {
            ProductVariant::query()->insertOrIgnore($insertVariants);
        }
        foreach ($updateVariants as $updateVariant) {
            $updateId = $updateVariant['id'];
            unset($updateVariant['id']);
            ProductVariant::query()->findOrFail($updateId)->update($updateVariant);
        }

        //Update category of product
        $this->processCategory($request, $product);
        $data = $this->getDataForStore($request, 'update');
        if ($image = $request->image) {
            $this->doUpload($image, $id, 'product');
        }
        $product->update($data);

        return redirect(route('admin.products.edit', ['id' => $id]));
    }

    private function processCategory($request, $product)
    {
        $requestCategories = $request->categories;
        if ($requestCategories) {
            $currentCategories = array_column($product->categories->toArray(), 'id');

            $deleteCate = array_diff($currentCategories, $requestCategories);
            $addCategories = array_diff($requestCategories, $currentCategories);
            foreach ($addCategories as $addCate) {
                ProductCategory::query()->insertOrIgnore([
                    'product_id' => $product->id,
                    'category_id' => $addCate,
                ]);
            }

            ProductCategory::query()->where('product_id', $product->id)
                ->whereIn('category_id', $deleteCate)->delete();
        }
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
            'compare_price',
            'prices',
            'compare_prices',
            'variant_names',
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

                $data['updated_by'] = Auth::guard('admin')->id();
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
        $image = Image::query()->findOrFail($request->id);
        $deleteIds = [];
        Storage::delete($image->src);
        $deleteIds[] = $image->id;

        if ($image->is_thumbnail) {
            $image = Image::query()->where([
                'entity_type' => 'product',
                'entity_id' => $image->entity_id,
                'is_thumbnail' => false,
            ])->first();

            $image?->update([
                'is_thumbnail' => true
            ]);
        }

        if (Image::destroy($deleteIds)) {
            return response()->json([
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function import()
    {
        return view('backend.products.import')->with([
            'image' => asset('backend/img/placeholder.jpg'),
        ]);
    }
    public function importProduct(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file');
        // Process the file as needed, e.g., parsing CSV, etc.
        $reader = new Xlsx();
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $excelData = $sheet->rangeToArray('A1:AJ81', null, true, false, true);

        $excelData = array_map(function($row) {
            return array_filter($row, function($value) {
                return !is_null($value);
            });
        }, $excelData);

        $items = [];
        foreach ($excelData as $row => $rowItem) {
            if (count($rowItem) < 1) {
                continue;
            }

            foreach ($rowItem as $col => $cellValue) {
                if (Str::contains($cellValue, '-')) {
                    $items["$row-$col"] = [
                        'sku' => $cellValue
                    ];
                }
            }
        }

        foreach ($items as $key => $item) {
            [$row, $col] = explode('-', $key);

            for ($i = (int)$row + 1; $i < count($excelData); $i++) {
                $rowItem = $excelData[$i];
                if (count($rowItem) < 1) {
                    continue;
                }

                if (isset($rowItem[$col]) && (Str::contains($rowItem[$col], 'k') || $rowItem[$col] > 800)) {
                    $items[$key]['price'] = (int)Str::replace('k', '', $rowItem[$col]) * 1000;
                    break;
                }

                if (isset($rowItem[$col])) {
                    $items[$key]['variants'][] = $rowItem[$col];
                }
            }
        }

//            dd($items);
//            $items = [$items["3-B"]];
        foreach ($items as $item) {
            $product = Product::query()->where('slug', Str::slug($item['sku']))->first();
            if ($product) {
                $product->update([
                    'price' => $item['price'] ?? 0,
                ]);

                foreach ($item['variants'] as $variant) {
                    $productVariant = ProductVariant::query()->where('sku', "$product->slug-$variant")->first();
                    if ($productVariant) {
                        $productVariant->update([
                            'price' => $item['price'] ?? 0,
                        ]);
                        continue;
                    }

                    ProductVariant::query()->create([
                        'sku' => "$product->slug-$variant",
                        'price' => $item['price'] ?? 0,
                        'name' => $variant,
                        'product_id' => $product->id
                    ]);
                }
                continue;
            }

            $product = Product::query()->create([
                'sku' => $item['sku'],
                'price' => $item['price'] ?? 0,
                'slug' => Str::slug($item['sku']),
                'title' => $item['sku'],
                'active' => 1,
                'created_by' => Auth::id(),
            ]);

            foreach ($item['variants'] as $variant) {
                ProductVariant::query()->create([
                    'sku' => "$product->slug-$variant",
                    'price' => $item['price'] ?? 0,
                    'name' => $variant,
                    'product_id' => $product->id
                ]);
            }
        }

        dd('done');

        return response()->json([
            'status' => true,
            'message' => 'Import successful'
        ]);

        try {

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Import failed: ' . $e->getMessage()
            ]);
        }
    }
}
