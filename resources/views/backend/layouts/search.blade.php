<form action="" class="d-flex align-items-center w-100" style="gap: 16px">
    <div class="d-flex" style="gap: 16px">
       <span class="btn-group bootstrap-select m-0 d-flex align-items-center">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary"
                   title="" tabindex="-98" id="paginate" name="paginate">
               @foreach (config('app.per_pages') as $page)
                   <option value="{{ $page }}" {{ Arr::get($queries, 'paginate') == $page ? 'selected' : '' }}>{{ $page }} items/page</option>
               @endforeach
           </select>
       </span>
        @if(isset($sorts))
            <span class="btn-group bootstrap-select m-0 d-flex align-items-center">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary" tabindex="-98"
                   id="sort" name="sort">
              <option class="bs-title-option" value="">Sort by</option>
              @foreach ($sorts as $col => $name)
                   <option
                       value="{{ $col }}" {{ Arr::get($queries, 'sort') == $page ? 'selected' : '' }}>{{ $name }}</option>
               @endforeach
           </select>
        </span>
        @endif
    </div>
    <span class="input-group no-border flex-grow-1 w-100">
          <input type="text" value="{{ Arr::get($queries, 'search') }}"
                 class="form-control" placeholder="Search..." name="search">
          <div class="input-group-append">
             <div class="input-group-text">
                <i class="nc-icon nc-zoom-split"></i>
             </div>
          </div>
          <button type="submit" hidden></button>
        </span>
</form>
