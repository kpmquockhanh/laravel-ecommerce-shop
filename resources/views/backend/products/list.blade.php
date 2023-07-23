@extends('backend.layouts.master')
@section('title', "Products")
@section('content')
    <div class="content">
        <div class="row">
            @include('backend.layouts.search',
            [
               'queries' => $queries,
                'sorts' => [
                   'id' => 'Id',
                   'views' => 'Lượt xem',
                   'show' => 'Hiển thị',
                   'name' => 'Tên',
                   'saleoff' => 'Giảm giá',
                   'price' => 'Giá',
                   'quantity' => 'Số lượng',
                   'created_at' => 'Ngày tạo',
                ]
            ])
            @if (!count($products))
                <div class="alert alert-info w-100">
                    No products. <a href="{{route('admin.dashboard')}}" class="text-light font-weight-bold">Back to home</a>
                </div>
            @else
                <div class="row w-100 no-gutters">
                    @if (Auth::guard('admin')->user()->status)
                        <div class="col-12">
                            <div class="row">
                                <div class="col-10 d-flex justify-content-center">
                                    <a href="{{route('admin.products.create')}}"
                                       class="btn btn-success w-100 pull-right"
                                       style="display: flex;justify-content: center;">
                                        <i class="fa fa-plus-circle"></i>
                                    </a>
                                </div>
                                <div class="col-2">
                                    <a href="{{route('admin.products.list', ['list_type' => 'table'])}}"
                                       class="btn btn-info w-100 pull-right"
                                       style="display: flex;justify-content: center;">
                                        <i class="fa fa-list"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    @foreach($products as $product)
                        <div class="col-4 col-xl-3 position-relative item-flower">
                            <div class="card">
                                <div class="card-header">
                                    <h5 style="font-size: 15px">{{ Str::limit($product->title, $limit = 20, $end = '...')}}</h5>
                                </div>
                                <div class="card-body">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul id="tabs" class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="tab"
                                                       href="#home{{$product->id}}" role="tab" aria-expanded="true"
                                                       aria-selected="true">General</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                       href="#profile{{$product->id}}"
                                                       role="tab" aria-expanded="false" aria-selected="false">Description</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                       href="#messages{{$product->id}}"
                                                       role="tab" aria-expanded="false"
                                                       aria-selected="false">Details</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="my-tab-content" class="tab-content" style="min-height: 250px;">
                                        <div class="tab-pane active show" id="home{{$product->id}}" role="tabpanel"
                                             aria-expanded="true">
                                            <div class=" position-relative">
                                                <img
                                                    src="{{$product->thumbnail}}"
                                                    alt="" style="height: 250px;object-fit: cover;width: 100%">
                                            </div>
                                            <p class="mt-2">{!! $product->description?Str::limit(strip_tags($product->description), $limit = 50, $end = '...') : '' !!}</p>
                                        </div>

                                        <div class="tab-pane" id="profile{{$product->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            <p>{!! $product->message?:"No description." !!}</p>
                                        </div>
                                        <div class="tab-pane" id="messages{{$product->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            <p class="m-0">Title: <strong>{{$product->title}}</strong></p>
                                            <p class="m-0">Price: <strong>{{number_format($product->price)}}đ</strong>
                                            </p>
                                            <p class="m-0">Quantity: <strong>{{$product->quantity}}</strong></p>
                                            <p class="m-0">Created by: <strong>{{$product->admin->name}}</strong></p>
                                            <p class="m-0">Created at:
                                                <strong>{{$product->created_at->diffForHumans()}}</strong></p>
                                            <p class="m-0">Updated at:
                                                <strong>{{$product->updated_at->diffForHumans()}}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute" style="top: 0.2rem;right: 1.45rem;">

                                <button
                                    class="form-check btn {!! $product->active?'btn-primary':'' !!} btn-icon btn-sm trigger-change-status">
                                    <i class="fa fa-check " {!! $product->active?'':'style="display: none"' !!}></i>
                                    <input class="form-check-input change-show-status" type="checkbox"
                                           {{$product->active?'checked':''}} data-id="{{$product->id}}">
                                </button>

                                <a href="{{route('admin.products.edit', $product->id)}}" rel="tooltip"
                                   class="btn btn-success btn-icon btn-sm btn-edit" data-original-title="" title="">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" rel="tooltip" class="btn btn-danger btn-icon btn-sm btn-remove"
                                        data-id="{{$product->id}}" title="">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$products->appends($queries)->links()}}
        </div>
    </div>
@stop
