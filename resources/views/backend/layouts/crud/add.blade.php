@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Add {{ $resource }}</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            @foreach($fields as $field)
                                <div class="row mb-2">
                                    @if ($errors->has($field))
                                        <div class="text-danger col-md-12 offset-md-2">
                                            <strong>{{ $errors->first($field) }}</strong>
                                        </div>
                                    @endif

                                    <label class="col-sm-2 col-form-label text-capitalize">{{ $field }}</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <input type="text" name="{{ $field }}" class="form-control" value="{{old($field)}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
