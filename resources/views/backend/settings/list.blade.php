@extends('backend.layouts.master')
@section('title', "Settings")
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12">
                            <a href="{{route('admin.settings.create')}}" class="btn btn-success w-100">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                        </div>
                        <div class="table-responsive table-hover" style="overflow: hidden;">
                            <table class="table">
                                <thead class="text-primary">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Key</th>
                                    <th>Value</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!count($items))
                                    <tr>
                                        <td class="text-center" colspan="6">Không có cài đặt nào trong cơ sở dữ
                                            liệu
                                        </td>
                                    </tr>
                                @endif
                                @foreach($items as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{$item->id}}
                                        </td>
                                        <td class="text-center">
                                            {{$item->key}}
                                        </td>
                                        <td class="text-center">
                                            {{$item->value}}
                                        </td>
                                        <td class="text-center">
                                            {{$item->created_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            {{$item->updated_at->diffForHumans()}}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.settings.edit', ['id' => $item->id]) }}" rel="tooltip"
                                               class="btn btn-success btn-icon btn-sm btn-edit" data-original-title=""
                                               title="">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{ route('admin.settings.delete', ['id' => $item->id]) }}" rel="tooltip"
                                               class="btn btn-danger btn-icon btn-sm" data-original-title=""
                                               title="">
                                                <i class="fa fa-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer m-auto">
                        {{$items->appends($queries)->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
