@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" id="form" action="{{route('admin.products.update', ['id' => $product->id])}}"
              class="form-horizontal"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Edit product</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    @include('backend.products.upload_img', ['image' => $product->thumbnail, 'name' => 'image'])
                                </div>
                            </div>
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
                            <div class="row pb-2">
                                @if ($errors->has('slug'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Slug</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="slug" class="form-control"
                                               value="{{old('slug', $product->slug)}}">
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
                                    <select class="selectpicker" data-style="btn btn-info" multiple
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
                            <div class="row mt-3">
                                <label class="col-sm-2 col-form-label">Images</label>
                                <div class="col-sm-10">
                                    <div class="row">
                                        @foreach($product->images->filter(function ($image) {return !\Illuminate\Support\Str::contains($image->src, 'origin');}) as $image)
                                            <div class="col-sm-3 mb-2 image-item">
                                                <div class="w-100 position-relative">
                                                    <img src="{{ $image->href }}" alt="img"
                                                         data-id="{{$image->id}}" class="w-100">
                                                    <button type="button" rel="tooltip"
                                                            class="btn btn-danger btn-icon btn-sm m-0 position-absolute btn-remove"
                                                            data-id="{{$image->id}}"
                                                            data-type="products"
                                                            data-action="delete-image"
                                                            data-parent-selector=".image-item"
                                                            style="right: 8px; top: 8px;">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group dropzone" id="kpm">
                                        <div class="dz-default dz-message" data-dz-message="">
                                            <span>Upload or drag your photo here</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group float-right">
                                        <button type="submit" id="submit_form" class="btn btn-success">Update</button>
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

@section('script')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        let myDropzone = new Dropzone("div#kpm", {
            url: '/admin/products/upload/{{$product->id}}',
            paramName: "file",
            maxFilesize: 10,
            acceptedFiles: "image/*",
            autoProcessQueue: false,
            complete: () => {
                $("#form").trigger("submit");
            },
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            addRemoveLinks: true
        });

        $("#submit_form").on("click", function(e) {
            e.preventDefault();
            if (myDropzone.getQueuedFiles().length) {
                myDropzone.processQueue();
                return;
            }
            $("#form").trigger("submit");
        });
    </script>
@stop
