<template>
  <section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">

      <!-- Filter -->
      <ShopFilter/>

      <div class="row">
        <div class="col-md-12 catalogue-col right mb-50">
          <div :class="['shop-catalogue', `${type}-view`]">

            <div class="row items-grid">
              <ProductCatalogue v-for="index in 10" :index="index" :type="type"/>
            </div> <!-- end row -->
          </div> <!-- end grid mode -->

          <!-- Pagination -->
          <PaginationV2/>

        </div> <!-- end col -->

      </div> <!-- end row -->
    </div> <!-- end container -->
  </section>
</template>
<script>
import ShopFilter from "./ShopFilter.vue";
import ProductCatalogue from "./ProductCatalogue.vue";
import PaginationV2 from "./PaginationV2.vue";

export default {
  name: 'Catalogue',
  components: {PaginationV2, ProductCatalogue, ShopFilter},
  props: {
    type: {
      type: String,
      default: 'grid'
    }
  }
}
</script>
