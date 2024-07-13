@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header">
                            <h4 class="card-title">Add a product</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            {{--<input type="text" name="id" class="form-control" value="" hidden>--}}
                            <div class="row pb-2">
                                @if ($errors->has('title'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </div>
                                @endif

                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="title" class="form-control" value="{{old('title')}}">
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('price'))
                                <div class="text-danger col-md-12 offset-md-2 p-0">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </div>
                            @endif
                            <div class="row pb-2">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input type="number" name="price" class="form-control" value="{{old('price')}}">
                                    </div>
                                </div>

                            </div>
                          @if($categories->count())
                                <div class="row">
                                    <label class="col-sm-2 col-form-label">Categories</label>
                                    <div class="col-lg-5 col-md-6 col-sm-3">
                                        <select class="selectpicker" data-style="btn btn-info btn-round" multiple
                                                title="Categories" data-size="7" name="categories[]">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                          @endif
                            <div class="row">
                                @if ($errors->has('message'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <textarea type="text" name="description"
                                                  class="form-control">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title">Image</h4>
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <div class="row">
                                <div class="col-md-12 m-auto">
                                    @include('backend.products.upload_img', ['image' => asset('backend/img/placeholder.jpg'), 'name' => 'image'])
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
    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            image_uploadtab: true,
            images_upload_url: '/admin/products/upload'
        });
    </script>
@stop
