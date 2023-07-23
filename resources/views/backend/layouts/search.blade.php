<form action="" class="d-flex align-items-center w-100" style="gap: 16px">
    <div class="d-flex w-100" style="gap: 16px">
       <span class="btn-group bootstrap-select m-0 d-flex align-items-center">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary"
                   title="Sắp xếp theo" tabindex="-98" id="paginate" name="paginate">
              <option class="bs-title-option" value="">Paging</option>
               @foreach ([1,4,8,12,16,100] as $page)
                   <option value="{{ $page }}" {{isset($queries['paginate'])?$queries['paginate'] == $page?'selected':'':''}}>{{ $page }} item/page</option>
               @endforeach

           </select>
       </span>
        <span class="btn-group bootstrap-select m-0 d-flex align-items-center">
           <select class="selectpicker" data-size="7" data-style="btn btn-primary" title="Sắp xếp theo" tabindex="-98" id="sort" name="sort">
              <option class="bs-title-option" value="" >Sort by</option>
              @foreach ($sorts as $col => $name)
                   <option value="{{ $col }}" {{isset($queries['sort'])?$queries['sort'] == $col?'selected':'':''}}>{{ $name }}</option>
               @endforeach
           </select>
        </span>
    </div>
    <span class="input-group no-border m-0 p-0 col-md-6 flex-grow-1">
          <input type="text" value="{{ isset($queries['search'])??$queries['search'] }}"
                 class="form-control" placeholder="Search..." name="search">
          <div class="input-group-append">
             <div class="input-group-text">
                <i class="nc-icon nc-zoom-split"></i>
             </div>
          </div>
          <button type="submit" hidden></button>
        </span>
</form>
