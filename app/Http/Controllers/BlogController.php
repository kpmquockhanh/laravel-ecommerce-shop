<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogCategoryBlog;
use App\Models\Image;
use App\Traits\ListTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    use ListTrait;
    use UploadTrait;

    public function index(Request $request)
    {
        $blogs = Blog::with('admin', 'categories');
        $page = 50;
        if ($paginate = $request->paginate) {
            $page = $paginate;
        }

        if ($paginate = $request->search) {
            $blogs->where('name', 'like', '%' . $paginate . '%');
        }
        $viewData = [
            'items' => $blogs->paginate($page),
            'queries' => $request->query(),
            'route' => 'blogs',
            'header' => 'Blogs',
            'display_fields' => [
                'id' => [
                    'title' => '#',
                ],
                'title' => [
                    'title' => 'Title',
                    'link' => function ($item) {
                        return route('admin.blogs.edit', $item->id);
                    },
                ],
                'categories' => [
                    'title' => 'Categories',
                    'func' => function ($item) {
                        return $item->categories->pluck('name')->implode(', ');
                    },
                ],
                'created_by' => [
                    'title' => 'Created by',
                    'func' => function ($item) {
                        return $item->admin->name;
                    },
                ],
                'created_at' => [
                    'title' => 'Created at',
                    'func' => function ($item) {
                        return $item->created_at->diffForHumans();
                    },
                ],
                'updated_at' => [
                    'title' => 'Updated at',
                    'func' => function ($item) {
                        return $item->updated_at->diffForHumans();
                    },
                ],
                'actions' => [
                    'title' => 'Actions',
                    'items' => [
                        'edit' => true,
                        'delete' => true,
                        'link' => function ($item) {
                            return "/posts/$item->id";
                        }
                    ],
                ],
            ],
        ];

        return $this->processListVIew($request, $viewData);
    }

    public function create()
    {
        $viewData = [
            'categories' => BlogCategory::all(),
        ];

        return view('backend.blogs.add')->with($viewData);
    }

    public function store(BlogRequest $request)
    {
        $payload = $request->all([
            'title',
            'content',
            'category_ids',
        ]);

        $blog = Blog::query()->create(array_merge($payload, ['created_by' => Auth::guard('admin')->id()]));
        if ($payload['category_ids'] && count($payload['category_ids'])) {
            foreach ($payload['category_ids'] as $category_id) {
                BlogCategoryBlog::query()->create([
                    'blog_id' => $blog->id,
                    'blog_category_id' => $category_id,
                ]);
            }
        }
        return redirect(route('admin.blogs.list'));
    }

    public function edit($id)
    {
        $viewData = [
            'item' => Blog::with('categories')->find($id),
            'categories' => BlogCategory::all(),
        ];
        return view('backend.blogs.edit')->with($viewData);
    }

    public function update(BlogRequest $request)
    {
        $blog = Blog::query()->find($request->id);
        $blog->update($request->all(['title', 'content']));
        if ($request->category_ids && count($request->category_ids)) {
            BlogCategoryBlog::query()->where('blog_id', $blog->id)->delete();
            foreach ($request->category_ids as $category_id) {
                BlogCategoryBlog::query()->create([
                    'blog_id' => $blog->id,
                    'blog_category_id' => $category_id,
                ]);
            }
        }
        return redirect(route('admin.blogs.list'));
    }

    public function uploadImg(Request $request)
    {
        if (!$request->file) {
            return response()->json([
                'status' => false,
            ]);
        }
        if ($image = $request->file) {
            try {
                $entityId = $request->id;
                if (!$entityId) {
                    $entityId = -1;
                }
                $result = $this->doUpload($image, $entityId, 'blog', false);
                return response()->json([
                    'status' => true,
                    'data' => $result,
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => $e->getMessage(),
                ]);
            }
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function imageList()
    {
        $items = Image::query()->where([
            'entity_type' => 'blog',
            'entity_id' => -1,
        ])->get();

        return response()->json($items->map(function ($item) {
            return [
                'title' => $item->src,
                'value' => $item->href,
            ];
        }));
    }

    public function delete(Request $request)
    {
        try {
            $blog = Blog::with('categories')->find($request->id);

            foreach ($blog->categories as $category) {
                BlogCategoryBlog::query()
                    ->where('blog_id', $blog->id)
                    ->where('blog_category_id', $category->id)
                    ->delete();
            }

            $blog->delete();
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'status' => true,
        ]);
    }
}
