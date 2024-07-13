@extends('backend.layouts.master')
@section('title', "Products")
@section('content')
    <div class="content">
        @if(isset($header))
            <h4 class="title">{{ $header }}</h4>
        @else
            <h4 class="title">Default</h4>
        @endif
        <div class="row no-gutters">
            @if(isset($queries))
                @include('backend.layouts.search',
                [
                   'queries' => $queries,
        //            'sorts' => [
        //               'id' => 'Id',
        //               'views' => 'Lượt xem',
        //               'show' => 'Hiển thị',
        //               'name' => 'Tên',
        //               'saleoff' => 'Giảm giá',
        //               'price' => 'Giá',
        //               'quantity' => 'Số lượng',
        //               'created_at' => 'Ngày tạo',
        //            ]
                ])
            @endif
            @if (Auth::guard('admin')->user()->status)
                <div class="col-12">
                    <div class="row">
                        <div class="col-10 d-flex justify-content-center">
                            <a href="{{route("admin.$route.create")}}"
                               class="btn btn-success w-100 pull-right"
                               style="display: flex;justify-content: center;">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="{{route("admin.$route.list", ['list_type' => 'table'])}}"
                               class="btn btn-info w-100 pull-right"
                               style="display: flex;justify-content: center;">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            @if (!isset($items) or !count($items))
                <div class="alert alert-info w-100">
                    No items. <a href="{{route('admin.dashboard')}}" class="text-light font-weight-bold">Back to
                        home</a>
                </div>
            @else
                <div class="row no-gutters">
                    @foreach($items as $item)
                        <div class="col-4 col-xl-3 mb-2">
                            <div class="card m-1">
                                <div class="card-header d-flex align-items-center justify-content-between gap-2">
                                    <a style="font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;text-decoration: none" href="{{route('admin.products.edit', $item->id)}}">{{ $item->title }}</a>
                                    <div class="d-flex gap-2">
                                        <button
                                            class="form-check btn {!! $item->active?'btn-primary':'' !!} btn-icon btn-sm trigger-change-status m-0">
                                            <i class="fa fa-check " {!! $item->active?'':'style="display: none"' !!}></i>
                                            <input class="form-check-input change-show-status" type="checkbox"
                                                   {{$item->active?'checked':''}} data-id="{{$item->id}}">
                                        </button>
                                        <a href="{{route('admin.products.edit', $item->id)}}" rel="tooltip"
                                           class="btn btn-success btn-icon btn-sm btn-edit m-0" data-original-title=""
                                           title="">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button type="button" rel="tooltip"
                                                class="btn btn-danger btn-icon btn-sm btn-remove m-0"
                                                data-id="{{$item->id}}" title="">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <ul id="tabs" class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="tab"
                                                       href="#home{{$item->id}}" role="tab" aria-expanded="true"
                                                       aria-selected="true">General</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                       href="#profile{{$item->id}}"
                                                       role="tab" aria-expanded="false" aria-selected="false">Description</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                       href="#messages{{$item->id}}"
                                                       role="tab" aria-expanded="false"
                                                       aria-selected="false">Details</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="my-tab-content" class="tab-content" style="min-height: 250px;">
                                        <div class="tab-pane active show" id="home{{$item->id}}" role="tabpanel"
                                             aria-expanded="true">
                                            <div class="position-relative">
                                                <a style="font-size: 15px" href="{{route('admin.products.edit', $item->id)}}">
                                                    <img
                                                        src="{{$item->thumbnail}}"
                                                        alt="" style="height: 250px;object-fit: cover;width: 100%">
                                                </a>
                                            </div>
                                            <p
                                                class="mt-2">{!! $item->description?Str::limit(strip_tags($item->description), $limit = 50, $end = '...') : '' !!}</p>
                                        </div>

                                        <div class="tab-pane" id="profile{{$item->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            <p>{!! $item->message?:"No description." !!}</p>
                                        </div>
                                        <div class="tab-pane" id="messages{{$item->id}}" role="tabpanel"
                                             aria-expanded="false">
                                            <p class="m-0">Title: <strong>{{$item->title}}</strong></p>
                                            <p class="m-0">Price: <strong>{{number_format($item->price)}}đ</strong>
                                            </p>
                                            <p class="m-0">Quantity: <strong>{{$item->quantity}}</strong></p>
                                            <p class="m-0">Created by: <strong>{{$item->admin->name}}</strong></p>
                                            <p class="m-0">Created at:
                                                <strong>{{$item->created_at->diffForHumans()}}</strong></p>
                                            <p class="m-0">Updated at:
                                                <strong>{{$item->updated_at->diffForHumans()}}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$items->appends($queries)->links('backend.layouts.pagination')}}
    </div>
  </div>
@stop
