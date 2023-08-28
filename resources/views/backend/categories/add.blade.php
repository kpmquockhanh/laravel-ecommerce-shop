@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Add category</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <div class="row">
                                @if ($errors->has('name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                @if ($errors->has('code'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="code" class="form-control"
                                               value="{{old('code')}}">
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
