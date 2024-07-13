<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::query();
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
            'route' => 'blog_categories',
            'header' => 'Blog categories',
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
                    ],
                ],
            ],
        ];
        return view('backend.layouts.crud.base_list_table')->with($viewData);
    }

    public function create()
    {
        return view('backend.blogs.categories.add');
    }

    public function store(CategoryRequest $request)
    {
        BlogCategory::query()->create(array_merge($request->all(['name', 'code']), ['created_by' => Auth::guard('admin')->id()]));
        return redirect(route('admin.blog_categories.list'));
    }

    public function edit($id)
    {
        $category = BlogCategory::query()->find($id);
        return view('backend.blogs.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request)
    {
        $category = BlogCategory::query()->find($request->id);
        $category->update($request->all(['name', 'code']));
        return redirect(route('admin.blog_categories.list'));
    }

    public function delete(Request $request)
    {
        dd(123);
    }
}
