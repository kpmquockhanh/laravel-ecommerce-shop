<div>
    @foreach(Arr::get($field, 'items') as $name => $f)
        @switch($name)
            @case('active')
                <button
                    class="form-check btn {{ $item->active?'btn-primary':'' }} btn-icon btn-sm trigger-change-status my-1">
                    <i class="fa fa-check " {{$item->active?'':'style="display: none"'}}></i>
                    <input class="form-check-input change-show-status" type="checkbox"
                           {{$item->active?'checked':''}} data-id="{{$item->id}}" data-type="{{ $route }}">
                </button>
                @break
            @case('edit')
                <a href="{{route("admin.$route.edit", $item->id)}}" rel="tooltip"
                   class="btn btn-success btn-icon btn-sm btn-edit my-1" data-original-title=""
                   title="">
                    <i class="fa fa-edit"></i>
                </a>
                @break
            @case('delete')
                <button type="button" rel="tooltip"
                        class="btn btn-danger btn-icon btn-sm my-1 {{ "btn-remove" }}"
                        data-id="{{$item->id}}" data-type="{{ $route }}">
                    <i class="fa fa-times"></i>
                </button>
                @break

            @case('link')
                <a href="{{$f($item)}}" rel="tooltip" target="_blank"
                   class="btn btn-success btn-icon btn-sm my-1">
                    <i class="fa fa-link"></i>
                </a>
                @break
        @endswitch
    @endforeach
</div>
