<template>
  <div class="widget filter-by-price clearfix">
    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Filter by Price</h3>

    <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
      <div class="ui-slider-range ui-widget-header ui-corner-all"
           style="left: 10.6667%; width: 42.6667%;"></div>
      <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 10.6667%;"></span><span
        class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 53.3333%;"></span>
    </div>
    <p>
      <label for="amount">Price:</label>
      <input type="text" id="amount">
      <a href="#" class="btn btn-sm btn-stroke"><span>Filter</span></a>
    </p>
  </div>
</template>
<script>
export default {
  name: 'FilterByPrice'
}
</script>