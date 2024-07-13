<button
    class="form-check btn {{ $item->active?'btn-primary':'' }} btn-icon btn-sm trigger-change-status my-1">
    <i class="fa fa-check " {{$item->active?'':'style="display: none"'}}></i>
    <input class="form-check-input change-show-status" type="checkbox"
           {{$item->active?'checked':''}} data-id="{{$item->id}}">
</button>

<a href="{{route('admin.products.edit', $item->id)}}" rel="tooltip"
   class="btn btn-success btn-icon btn-sm btn-edit my-1" data-original-title=""
   title="">
    <i class="fa fa-edit"></i>
</a>
<button type="button" rel="tooltip"
        class="btn btn-danger btn-icon btn-sm btn-remove my-1"
        data-id="{{$item->id}}" title="">
    <i class="fa fa-times"></i>
</button>
