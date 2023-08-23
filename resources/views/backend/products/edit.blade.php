@extends('backend.layouts.master')
@section('style')
    <!-- Include Editor style. -->
    <link href="{{asset('floara/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('floara/css/froala_style.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        a[href="https://froala.com/wysiwyg-editor"], a[href="https://www.froala.com/wysiwyg-editor?k=u"] {
            display: none !important;
        }
    </style>
@stop


@section('content')
    <div class="content">
        <form method="post" action="{{route('admin.products.update')}}" class="form-horizontal"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Edit product</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <input type="text" name="id" class="form-control" value="{{$product->id}}" hidden>
                            <div class="row pb-2">
                                @if ($errors->has('title'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control"
                                               value="{{old('title', $product->title)}}">
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('price'))
                                <div class="text-danger col-md-12 offset-md-2 p-0">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </div>
                            @endif
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control"
                                               value="{{old('price', $product->price)}}">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Categories</label>
                                <div class="col-lg-5 col-md-6 col-sm-3">
                                    <select class="selectpicker" data-style="btn btn-info btn-round" multiple
                                            title="Select" data-size="7" name="categories[]">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"
                                                {{in_array($category->id, $listIdCate)?'selected':''}}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                @if ($errors->has('description'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea type="text" name="description"
                                                  class="form-control">{{old('description', $product->description)}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('backend.products.upload_img', ['image' => $product->thumbnail??asset('backend/img/placeholder.jpg')])
                </div>
            </div>
        </form>
    </div>
@stop

@section('script')
    <!-- Include Editor JS files. -->
    <script type="text/javascript" src="{{asset('floara/js/froala_editor.pkgd.min.js')}}"></script>

    <!-- Initialize the editor. -->
    <script>
        $('textarea').froalaEditor({
            language: 'vn',
            heightMin: 200,
            spellcheck: false
        });
    </script>

@stop
