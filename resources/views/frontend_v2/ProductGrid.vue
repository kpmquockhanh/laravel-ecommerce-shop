<template>
  <div class="products-grid-wrap clearfix">
    <div id="products-grid">

      <ProductItem v-for="index in 8" :index="index"/>

    </div> <!-- end products grid -->
  </div>
</template>
<script>
import ProductItem from "./ProductItem.vue";

export default {
  name: 'ProductGrid',
  components: {ProductItem}
}
</script>
