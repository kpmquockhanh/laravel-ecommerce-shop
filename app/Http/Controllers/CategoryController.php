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
            $categories->where('name', 'like', '%'.$paginate.'%');
        }
        $viewData = [
            'categories' => $categories->paginate($page),
            'queries' => $request->query(),
        ];

        return view('backend.categories.list')->with($viewData);
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
        dd('$id', $id);
    }

    public function update(CategoryRequest $request)
    {
        dd(123);
    }

    public function delete(Request $request)
    {
       dd(123);
    }
}
