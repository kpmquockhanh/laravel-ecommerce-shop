@extends('backend.layouts.master')
@section('title', "Categories")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Categories</h4>
                        <div class="row">
                            @include('backend.layouts.search',
                             [
                                'queries' => $queries,
                                 'sorts' => [
                                    'id' => 'id',
                                    'cate_name' => 'Tên',
                                    'cate_code' => 'Mã',
                                    'created_at' => 'Ngày tạo',
                                 ]
                             ])

                            <div class="col-md-12">
                                <a href="{{route('admin.categories.create')}}" class="btn btn-success w-100">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-hover" style="overflow: hidden;">
                            <table class="table">
                                <thead class="text-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Created by</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($categories))
                                    <tr>
                                        <td class="text-center" colspan="6">Không có thể loại nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="text-center">
                                            {{$category->id}}
                                        </t>
                                        <td class="text-center">
                                            {{$category->name}}
                                        </td>
                                        <td class="text-center">
                                            {{$category->code}}
                                        </td>
                                        <td class="text-center">{{ $category->admin->name }}</td>
                                        <td class="text-center">
                                            {{$category->created_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            {{$category->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{route('admin.categories.edit', $category->id)}}" rel="tooltip"
                                               class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""
                                               title="">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" rel="tooltip"
                                                    class="btn btn-danger btn-icon btn-sm btn-remove-category"
                                                    data-id="{{$category->id}}" title="">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$categories->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
