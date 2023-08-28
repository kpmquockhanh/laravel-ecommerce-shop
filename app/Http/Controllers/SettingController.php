<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ];

        return view('backend.settings.list')->with($viewData);
    }

    public function create()
    {
        return view('backend.settings.add');
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
        $setting = Setting::query()->findOrFail($request->id);
        $setting->delete();
        return redirect(route('admin.settings.list'));
    }
}
