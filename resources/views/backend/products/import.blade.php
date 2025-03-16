@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Import products</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <div class="row pb-2">
                                @if ($errors->has('file'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <div>
                                        <input type="file" name="file" accept=".xlsx, .xls, .csv">
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-2">
                                @if ($errors->has('category_id'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Categories</label>
                                <div class="col-lg-5 col-md-6 col-sm-3">
                                    <select class="selectpicker" data-style="btn btn-info btn-round"
                                            title="Categories" data-size="7" name="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-success">Import</button>
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