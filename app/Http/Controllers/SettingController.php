<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Setting::query();
        $page = 50;
        if ($paginate = $request->paginate) {
            $page = $paginate;
        }

        $viewData = [
            'items' => $categories->paginate($page),
            'queries' => $request->query(),
            'route' => 'settings',
            'header' => 'Settings',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                ],
                'key' => [
                    'title' => 'Key',
                ],
                'value' => [
                    'title' => 'Value',
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
                        'edit' => true,
                        'delete' => true,
                    ],
                ],
            ],
        ];

        return view('backend.layouts.crud.base_list_table')->with($viewData);
    }

    public function create()
    {
        return view('backend.settings.add');
    }

    public function indexUploadedImages(Request $request)
    {
        $images = Image::query();
        $page = 50;
        if ($paginate = $request->paginate) {
            $page = $paginate;
        }

        $viewData = [
            'items' => $images->paginate($page),
            'queries' => $request->query(),
            'route' => 'settings',
            'header' => 'Uploaded Images',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                    'func' => function ($item) {
                        return $item->id;
                    },
                ],
                'entity_type' => [
                    'title' => 'Entity Type',
                    'func' => function ($item) {
                        return Str::title($item->entity_type);
                    },
                ],
                'is_thumbnail' => [
                    'title' => 'Is Thumbnail',
                    'func' => function ($item) {
                        return $item->is_thumbnail ? 'Yes' : 'No';
                    },
                ],
                'image' => [
                    'title' => 'Image',
                    'func' => function ($item) {
                        return $item->href;
                    },
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
            ],
        ];

        return view('backend.layouts.crud.base_list_table')->with($viewData);
    }

    public function add(Request $request)
    {
        Setting::query()->create($request->all(['key', 'value']));
        return redirect(route('admin.settings.list'));
    }

    public function edit(Request $request)
    {
        $setting = Setting::query()->findOrFail($request->id);
        return view('backend.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::query()->where(['id' => $request->id]);
        $setting->update($request->all(['key', 'value']));
        return redirect(route('admin.settings.list'));
    }

    public function delete(Request $request)
    {
        if (Setting::destroy($request->id)) {
            return response()->json([
                'status' => true,
            ]);
        }

        return response()->json([
            'status' => false,
        ]);
    }

    public function analytic(Request $request)
    {
        $countProduct = Product::query()->count();
        $countProductByDay = Product::query()->whereDate('created_at', date('Y-m-d'))->count();
        $countProductPublish = Product::query()->where('active', true)->count();
        $labels = [
            'countProduct' => 'Products',
            'countProductByDay' => 'Products by day',
            'countProductPublish' => 'Products published',
        ];
        $icons = [
            'countProduct' => 'nc-tie-bow',
            'countProductByDay' => 'nc-tap-01',
            'countProductPublish' => 'nc-box-2',
        ];
        $data = [
            'countProduct' => $countProduct,
            'countProductByDay' => $countProductByDay,
            'countProductPublish' => "$countProductPublish/$countProduct",
        ];
        return view('backend.home')->with(
            [
                'labels' => $labels,
                'data' => $data,
                'icons' => $icons,
            ]
        );
    }
}
