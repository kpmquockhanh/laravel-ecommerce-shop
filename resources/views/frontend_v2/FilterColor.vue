<template>
  <div class="widget filter-by-color">
    <h3 class="widget-title heading uppercase relative bottom-line full-grey">Color</h3>
    <ul class="color-select list-dividers">
      <li>
        <input type="checkbox" class="input-checkbox" id="green-color" name="green-color">
        <label for="green-color" class="checkbox-label">Green</label>
      </li>
      <li>
        <input type="checkbox" class="input-checkbox" id="red-color" name="red-color">
        <label for="red-color" class="checkbox-label">Red</label>
      </li>
      <li>
        <input type="checkbox" class="input-checkbox" id="blue-color" name="blue-color">
        <label for="blue-color" class="checkbox-label">Blue</label>
      </li>
      <li>
        <input type="checkbox" class="input-checkbox" id="white-color" name="white-color">
        <label for="white-color" class="checkbox-label">White</label>
      </li>
      <li>
        <input type="checkbox" class="input-checkbox" id="black-color" name="black-color">
        <label for="black-color" class="checkbox-label">Black</label>
      </li>
    </ul>
  </div>
</template>
<script>
export default {
  name: 'FilterColor'
}
</script>