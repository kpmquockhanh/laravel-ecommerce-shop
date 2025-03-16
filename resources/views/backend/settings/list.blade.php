@extends('backend.layouts.master')
@section('title', "Settings")
@section('content')
    <div class="content">
        <form method="post" action="{{ route('admin.settings.mass_update') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf()
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Banner</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-2">
                                @if ($errors->first())
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first() }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        @include('backend.products.upload_img', ['image' => $settings['logo'] ?? asset('backend/img/placeholder.jpg'), 'name' => 'logo'])
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <label class="col-sm-2 col-form-label">Image 1</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        @include('backend.products.upload_img', ['image' => $settings['home_page_hero_image1'] ?? asset('backend/img/placeholder.jpg'), 'name' => 'home_page_hero_image1'])
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_title" class="form-control" value="{{old('home_page_title', $settings['home_page_title'] ?? '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label class="col-sm-2 col-form-label">Subtitle</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_subtitle" class="form-control" value="{{old('home_page_subtitle', $settings['home_page_subtitle'] ?? '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label class="col-sm-2 col-form-label">Image 2</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        @include('backend.products.upload_img', ['image' => $settings['home_page_hero_image2'] ?? asset('backend/img/placeholder.jpg'), 'name' => 'home_page_hero_image2'])
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_title2" class="form-control" value="{{old('home_page_title2', $settings['home_page_title2'] ?? '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label class="col-sm-2 col-form-label">Subtitle</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_subtitle2" class="form-control" value="{{old('home_page_subtitle2', $settings['home_page_subtitle2'] ?? '')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label class="col-sm-2 col-form-label">Image 3</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        @include('backend.products.upload_img', ['image' => $settings['home_page_hero_image3'] ?? asset('backend/img/placeholder.jpg'), 'name' => 'home_page_hero_image3'])
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_title3" class="form-control" value="{{old('home_page_title3', $settings['home_page_title3'] ?? '')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-1">
                                <label class="col-sm-2 col-form-label">Subtitle</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="home_page_subtitle3" class="form-control" value="{{old('home_page_subtitle3', $settings['home_page_subtitle3'] ?? '')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
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
