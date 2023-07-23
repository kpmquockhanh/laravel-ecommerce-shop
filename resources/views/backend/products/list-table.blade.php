@extends('backend.layouts.master')
@section('title', "Flower list")
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

            <div class="card-body">
                @if (Auth::guard('admin')->user()->status)
                    <div class="row">
                        <div class="col-10 d-flex justify-content-center">
                            <a href="{{route('admin.products.create')}}" class="btn btn-success w-100 pull-right"
                               style="display: flex;justify-content: center;">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="col-2">
                            <a href="{{route('admin.products.list', ['list_type' => 'grid'])}}"
                               class="btn btn-info w-100 pull-right" style="display: flex;justify-content: center;">
                                <i class="fa fa-th-large"></i>
                            </a>
                        </div>
                    </div>
                @endif
                <div class="table-responsive table-hover" style="overflow: hidden;">
                    <table class="table">
                        <thead class="text-primary">
                        <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Created by
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Created at
                            </th>
                            <th>
                                Updated at
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (!count($products))
                            <tr>
                                <td class="text-center" colspan="12">
                                    No products. <a href="{{route('admin.dashboard')}}" class="text-light font-weight-bold">Back to home</a>
                                </td>
                            </tr>
                        @endif
                        @foreach($products as $product)
                            <tr>
                                <td class="text-center">
                                    {{$product->id}}
                                </td>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td width="50px">
                                    <img src="{{ '/images/'.$product->thumbnail }}" alt="">
                                </td>
                                <td>
                                    {{ $product->admin->name }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        {{ $product->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="{{ $product->active ? '': 'text-danger' }}">
                                    <div class="d-flex justify-content-center">
                                        {{ $product->updated_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="text-center">
                                   @include('backend.products.actions')
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$products->appends($queries)->links()}}
        </div>
    </div>
@stop
