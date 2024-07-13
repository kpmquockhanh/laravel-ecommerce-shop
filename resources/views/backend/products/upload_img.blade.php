@if ($errors->has('image'))
    <div class="text-danger col-md-10">
        <strong>{{ $errors->first('image') }}</strong>
    </div>
@endif
<div class="fileinput fileinput-new text-center position-relative" data-provides="fileinput">
    <div class="fileinput-new thumbnail">
        <img src="{{$image}}" alt="...">
    </div>
    <div class="fileinput-preview fileinput-exists thumbnail"></div>
    <div class="position-absolute" style="left: 0; right: 0; bottom: 5px;">
        <span class="btn btn-rose btn-round btn-file btn-sm">
          <span class="fileinput-new">Select</span>
          <span class="fileinput-exists">Change</span>
          <input type="file" name="image" accept="image/*">
        </span>
        <a href="#" class="btn btn-danger btn-round btn-sm fileinput-exists"
           data-dismiss="fileinput"><i class="fa fa-times mr-1"></i>Cancel</a>
    </div>
</div>
