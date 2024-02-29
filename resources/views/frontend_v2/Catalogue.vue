<template>
  <section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">
      <ShopFilter />
      <div class="row">
        <LeftSidebar />
        <div class="col-md-9 catalogue-col right mb-50">
          <div :class="['shop-catalogue', `${layout}-view`]">
            <div class="row items-grid">
              <div
                class="product"
                :class="[
                  `product-${layout}`,
                  { 'col-md-4 col-xs-6': layout === 'grid' },
                ]"
                v-for="product in products"
              >
                <ProductItem :type="layout" :product="product" />
              </div>
            </div>
          </div>
          <PaginationV2
            :total="total"
            :per-page="perPage"
            v-model:current-page="currentPage"
          />
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import ShopFilter from './ShopFilter.vue'
import { useRoute, useRouter } from 'vue-router'
import { computed, nextTick, onMounted, ref, watch } from 'vue'
import get from 'lodash/get'
import { doGet } from '../../js/http'
import { useLayout } from '../../js/composables/layout'
import LeftSidebar from './LeftSidebar.vue'
import PaginationV2 from './PaginationV2.vue'
import ProductItem from './ProductItem.vue'
import { useProduct } from '../../js/composables/product'
import { useCategory } from '../../js/composables/category'

export default {
  name: 'Catalogue',
  components: { ProductItem, PaginationV2, LeftSidebar, ShopFilter },
  props: {},
  setup() {
    const {
      products,
      productMeta,
      fetchProducts,
      isLoadingProducts,
      currentPage,
      perPage,
      total,
      onChangeSort,
      querySort,
    } = useProduct()
    const {
      fetchCategories,
      categories,
      countCategories,
      currentCategory,
      isLoadingCategory,
      onClickCategory,
    } = useCategory()

    onMounted(() => {
      fetchProducts('w5')
      fetchCategories()
    })

    const { layout } = useLayout()
    return {
      products,
      categories,
      currentCategory,
      onClickCategory,
      isLoadingProducts,
      isLoadingCategory,
      onChangeSort,
      productMeta,
      currentPage,
      total,
      perPage,
      layout,
      countCategories,
    }
  },
}
</script>
