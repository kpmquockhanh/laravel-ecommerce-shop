<button
    class="form-check btn {!! $product->active?'btn-primary':'' !!} btn-icon btn-sm trigger-change-status my-1">
    <i class="fa fa-check " {!! $product->active?'':'style="display: none"' !!}></i>
    <input class="form-check-input change-show-status" type="checkbox"
           {{$product->active?'checked':''}} data-id="{{$product->id}}">
</button>

<a href="{{route('admin.products.edit', $product->id)}}" rel="tooltip"
   class="btn btn-success btn-icon btn-sm btn-edit my-1" data-original-title=""
   title="">
    <i class="fa fa-edit"></i>
</a>
<button type="button" rel="tooltip"
        class="btn btn-danger btn-icon btn-sm btn-remove my-1"
        data-id="{{$product->id}}" title="">
    <i class="fa fa-times"></i>
</button>
