@extends('backend.layouts.master')

@section('content')
    <div class="content">
        <form method="post" action="{{route('admin.accounts.update', $account->id)}}" class="form-horizontal"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">Edit account</h4>
                        </div>
                        <div class="card-body ">
                            @csrf()
                            <input type="text" name="id" class="form-control" value="{{$account->id}}" hidden>
                            <div class="row my-2">
                                <label class="col-sm-2">ID</label>
                                <div class="col-sm-2 text-center">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-center" value="{{$account->id}}"
                                               disabled>
                                        {{--                                        <span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                <label class="col-sm-2">Email</label>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{$account->email}}"
                                               disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-2">
                                @if ($errors->has('name'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2">Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" value="{{$account->name}}">
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                @if ($errors->has('notes'))
                                    <div class="text-danger col-md-12 offset-md-2">
                                        <strong>{{ $errors->first('notes') }}</strong>
                                    </div>
                                @endif
                                <label class="col-sm-2">Notes</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="text" name="note" class="form-control"
                                               value="{{$account->notes}}">
                                        {{--<span class="form-text">A block of help text that breaks onto a new line.</span>--}}
                                    </div>
                                </div>
                            </div>

                            @can(\App\Enums\PermissionEnum::MANAGE_ACCOUNTS->value)
                                <div class="row">
                                    @if ($errors->has('status'))
                                        <div class="text-danger col-md-12 offset-md-2">
                                            <strong>{{ $errors->first('status') }}</strong>
                                        </div>
                                    @endif

                                    <label class="col-sm-2"></label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <span class="btn-group bootstrap-select p-0 col-md-3">
                                               <select class="selectpicker" data-size="7" data-style="btn btn-primary"
                                                       title="Sắp xếp theo" tabindex="-98" id="" name="status">
                                                <option class="bs-title-option" value="">Status</option>
                                                <option value="0"
                                                        {{!$account->status?'selected':''}} class="text-danger">Disabled</option>
                                                <option value="1"
                                                        {{!$account->status?'':'selected'}} class="text-success">Active</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($errors->has('roles'))
                                        <div class="text-danger col-md-12 offset-md-2">
                                            <strong>{{ $errors->first('roles') }}</strong>
                                        </div>
                                    @endif
                                    <label class="col-sm-2">Roles</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="row no-gutters py-2">
                                                @foreach(\App\Enums\RoleEnum::cases() as $role)
                                                    <div class="form-check col-sm-6">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                   value="{{$role->value}}"
                                                                   name="roles[]"
                                                                {{in_array($role->value, $account->roles->pluck('name')->toArray()) ? 'checked' : ''}}>
                                                            <span class="form-check-sign"></span>
                                                            {{$role->label()}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    @if ($errors->has('permissions'))
                                        <div class="text-danger col-md-12 offset-md-2">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </div>
                                    @endif
                                    <label class="col-sm-2">Permissions</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            @foreach($groupedPermissions as $label => $permissions)
                                                <label class="text-capitalize font-weight-bold">{{$label}}</label>
                                                <div class="row no-gutters py-2">
                                                    @foreach($permissions as $permission)
                                                        <div class="form-check col-sm-6">
                                                            <label class="form-check-label">
                                                                <input
                                                                    class="form-check-input"
                                                                    type="checkbox"
                                                                    value="{{$permission->value}}"
                                                                    name="permissions[]"
                                                                    {{in_array($permission->value, $account->permissions->pluck('name')->toArray()) ? 'checked' : ''}}
                                                                >
                                                                <span class="form-check-sign"></span>
                                                                {{$permission->label()}}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endcan
                            <div class="row">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
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
                                    @if ($errors->has('avatar'))
                                        <div class="text-danger col-md-12">
                                            <strong>{{ $errors->first('avatar') }}</strong>
                                        </div>
                                    @endif
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail">
                                            <img
                                                src="{{$account->avatar?asset('images/avatars/'.$account->avatar):asset('backend/img/image_placeholder.jpg')}}"
                                                alt="...">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                        <div>
                                            <span class="btn btn-rose btn-round btn-file">
                                                <span class="fileinput-new">Select</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image" accept="image/*">
                                            </span>
                                            <a href="#" class="btn btn-danger btn-round fileinput-exists"
                                               data-dismiss="fileinput">
                                                <i class="fa fa-times"></i>Remove
                                            </a>
                                        </div>
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
