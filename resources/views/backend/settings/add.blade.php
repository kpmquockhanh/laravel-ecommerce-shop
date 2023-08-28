@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Add setting</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <div class="row">
                                @if ($errors->has('key'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('key') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Key</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="key" class="form-control" value="{{old('key')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if ($errors->has('value'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Value</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="value" class="form-control"
                                               value="{{old('value')}}">
                                    </div>
                                </div>
                            </div>
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
