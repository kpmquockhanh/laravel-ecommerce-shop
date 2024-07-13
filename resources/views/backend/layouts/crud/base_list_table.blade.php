@extends('backend.layouts.master')
@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                @if(isset($header))
                    <h4 class="card-title">{{ $header }}</h4>
                @else
                    <h4 class="card-title">Default</h4>
                @endif
            </div>
            <div class="card-body">
                <div class="col-sm-12">
                    @if(isset($queries))
                        @include('backend.layouts.search',
                        [
                           'queries' => $queries,
                        ])
                    @endif
                    @if (Auth::guard('admin')->user()->status)
                        <div class="row">
                            <div class="col-10 d-flex justify-content-center">
                                <a href="{{route("admin.$route.create")}}"
                                   class="btn btn-success w-100 pull-right"
                                   style="display: flex;justify-content: center;">
                                    <i class="fa fa-plus-circle"></i>
                                </a>
                            </div>
                            <div class="col-2">
                                <a href="{{route("admin.$route.list", ['list_type' => 'grid'])}}"
                                   class="btn btn-info w-100 pull-right"
                                   style="display: flex;justify-content: center;">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive table-hover" style="overflow: hidden;">
                    <table class="table">
                        <thead class="text-primary">
                        <tr>
                            @foreach($display_fields as $field)
                                <th>
                                    {{ $field['title']  }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @if (!isset($items) or !count($items))
                            <tr>
                                <td class="text-center" colspan="12">
                                    <span>No items. </span>
                                    <a href="{{route('admin.dashboard')}}"
                                       class="font-weight-bold">Back to home</a>
                                </td>
                            </tr>
                        @endif
                        @foreach($items as $item)
                            <tr>
                                @foreach($display_fields as $key => $field)
                                    <td class="text-center">
                                        @switch($key)
                                            @case('image')
                                                <img
                                                    src="{{ isset($field['func']) ? $field['func']($item) : $item[$key] }}"
                                                    alt="{{$item[$key]}}" style="width: 32px">
                                                @break
                                            @case('actions')
                                                @include('backend.layouts.crud.actions')
                                                @break
                                            @default
                                                @if(isset($field['link']))
                                                    <a href="{{ $field['link']($item) }}">
                                                        {{ isset($field['func']) ? $field['func']($item) : $item[$key] }}
                                                    </a>
                                                @else
                                                    {{ isset($field['func']) ? $field['func']($item) : $item[$key] }}
                                                @endif
                                        @endswitch
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer m-auto">

            </div>
        </div>
        <div class="d-flex justify-content-center border-top pt-3">
            {{$items->appends($queries)->links('backend.layouts.pagination')}}
        </div>
    </div>
@stop
