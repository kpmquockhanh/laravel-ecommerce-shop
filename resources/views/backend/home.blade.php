@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <div class="row">
            @foreach($labels as $key => $label)

                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5 col-md-4">
                                    <div class="d-flex icon-big text-center icon-warning">
                                        <i class="nc-icon {{ $icons[$key] }} text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-md-8">
                                    <div class="numbers">
                                        <p class="card-category">{{ $label }}</p>
                                        <p class="card-title">{{$data[$key]}}<p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-refresh"></i> Cập nhật ngay
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop
