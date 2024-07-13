<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::query();
        $page = 50;
        if ($paginate = $request->paginate) {
            $page = $paginate;
        }

        if ($paginate = $request->search) {
            $categories->where('name', 'like', '%' . $paginate . '%');
        }
        $viewData = [
            'items' => $categories->paginate($page),
            'queries' => $request->query(),
            'route' => 'categories',
            'header' => 'Categories',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                ],
                'name' => [
                    'title' => 'Name',
                ],
                'code' => [
                    'title' => 'Code',
                ],
                'created_by' => [
                    'title' => 'Created By',
                    'func' => function ($item) {
                        return $item->admin->name;
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
                'actions' => [
                    'title' => 'Actions',
                    'items' => [
//            'active' => true,
                        'edit' => true,
//            'delete' => true,
                    ],
                ],
            ],
        ];
        return view('backend.layouts.crud.base_list_table')->with($viewData);
    }

    public function create()
    {
        return view('backend.categories.add');
    }

    public function store(CategoryRequest $request)
    {
        Category::create(array_merge($request->all(['name', 'code']), ['created_by' => Auth::guard('admin')->id()]));
        return redirect(route('admin.categories.list'));
    }

    public function edit($id)
    {
        $category = Category::query()->find($id);
        return view('backend.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request)
    {
        $category = Category::query()->find($request->id);
        $category->update($request->all(['name', 'code']));
        return view('backend.categories.edit', compact('category'));
    }

    public function delete(Request $request)
    {
        dd(123);
    }
}
