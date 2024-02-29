<template>
  <div class="widget filter-by-size">
    <h3 class="widget-title heading uppercase relative bottom-line full-grey">
      Size
    </h3>
    <ul class="size-select list-dividers">
      <li>
        <input
          type="checkbox"
          class="input-checkbox"
          id="small-size"
          name="small-size"
        />
        <label for="small-size" class="checkbox-label">S</label>
      </li>
      <li>
        <input
          type="checkbox"
          class="input-checkbox"
          id="medium-size"
          name="medium-size"
        />
        <label for="medium-size" class="checkbox-label">M</label>
      </li>
      <li>
        <input
          type="checkbox"
          class="input-checkbox"
          id="large-size"
          name="large-size"
        />
        <label for="large-size" class="checkbox-label">L</label>
      </li>
      <li>
        <input
          type="checkbox"
          class="input-checkbox"
          id="xlarge-size"
          name="xlarge-size"
        />
        <label for="xlarge-size" class="checkbox-label">XL</label>
      </li>
      <li>
        <input
          type="checkbox"
          class="input-checkbox"
          id="xxlarge-size"
          name="xxlarge-size"
        />
        <label for="xxlarge-size" class="checkbox-label">XXL</label>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'FilterSize',
}
</script>
