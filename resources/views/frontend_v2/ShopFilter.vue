<template>
  <div class="shop-filter">
    <div class="view-mode hidden-xs">
      <span>View:</span>
      <a class="grid" id="grid"></a>
      <a class="list list-active" id="list"></a>
    </div>
    <div class="filter-show hidden-xs">
      <span>Show:</span>
      <a href="#" class="active">12</a>
      <a href="#">24</a>
      <a href="#">all</a>
    </div>
    <form class="ecommerce-ordering">
      <select>
        <option value="default-sorting">Default Sorting</option>
        <option value="price-low-to-high">Price: high to low</option>
        <option value="price-high-to-low">Price: low to high</option>
        <option value="by-popularity">By Popularity</option>
        <option value="date">By Newness</option>
        <option value="rating">By Rating</option>
      </select>
    </form>
  </div>
</template>
<script>
export default {
  name: 'ShopFilter'
}
</script>