<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Setting;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    use UploadTrait;
    public function index_tmp(Request $request)
    {
        $categories = Setting::with('images');
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
                'image' => [
                    'title' => 'Image',
                    'func' => function ($item) {
                        if ($item->images->count() > 0) {
                            return $item->images[0]->href;
                        }
                        return '';
                    },
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

    public function index(Request $request)
    {
        $settings = Setting::with('images')->get()->keyBy('key')->map(function ($item) {
            return $item->images->count() > 0 ? $item->images[0]->href : $item->value;
        });
        return view('backend.settings.list')->with([
            'settings' => $settings,
        ]);
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
        $payload = $request->all(['key', 'value']);
        if (!$payload['value']) {
            $payload['value'] = 'image';
        }
        $image = $request->file('image');
        $setting = Setting::query()->create([...$payload, 'image' => $image, 'type' => 'string']);
        if ($image) {
            $this->doUpload($image, $setting->id, 'setting', false);
            $setting->update([
                'type' => 'image'
            ]);
        }

        return redirect(route('admin.settings.list'));
    }

    public function edit(Request $request)
    {
        $setting = Setting::query()->findOrFail($request->id);
        return view('backend.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $payload = $request->all(['key', 'value']);
        if (!$payload['value']) {
            $payload['value'] = 'image';
        }
        $setting = Setting::query()->where(['id' => $request->id]);
        $image = $request->file('image');
        if ($image) {
            Image::query()->where(['entity_id' => $request->id, 'entity_type' => 'setting'])->delete();
            $this->doUpload($image, $request->id, 'setting', false);
        }
        $setting->update($payload);
        return redirect(route('admin.settings.list'));
    }

    public function massUpdate(Request $request)
    {
        $request->validate([
            'home_page_title' => 'required',
            'home_page_subtitle' => 'required',
            'home_page_title2' => 'required',
            'home_page_subtitle2' => 'required',
            'home_page_title3' => 'required',
            'home_page_subtitle3' => 'required',
            'home_page_hero_image1' => 'file',
            'home_page_hero_image2' => 'file',
            'home_page_hero_image3' => 'file',
            'logo' => 'file',
        ]);
        $payload = $request->only([
            'home_page_hero_image1',
            'home_page_hero_image2',
            'home_page_hero_image3',
            'home_page_title',
            'home_page_subtitle',
            'home_page_title2',
            'home_page_subtitle2',
            'home_page_title3',
            'home_page_subtitle3',
            'logo',
        ]);

//        dd($payload);
        foreach ($payload as $key => $value) {
            if ($key == 'home_page_hero_image1' || $key == 'home_page_hero_image2' || $key == 'home_page_hero_image3' || $key == 'logo') {
                $image = $request->file($key);
                if ($image) {
                    $setting = Setting::query()->updateOrCreate(['key' => $key], ['value' => 'image']);
                    $oldImages = Image::query()->where(['entity_id' => $setting->id, 'entity_type' => 'setting'])->get();
                    foreach ($oldImages as $img) {
                        Storage::delete($img->src);
                    }
                    $this->doUpload($image, $setting->id, 'setting', false);
                    continue;
                }
            }
            Setting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

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
