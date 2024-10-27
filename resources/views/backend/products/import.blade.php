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
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <div>
                                        <input type="file" name="file" accept=".xlsx, .xls, .csv">
                                    </div>
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