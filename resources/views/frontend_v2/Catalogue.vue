<template>
  <section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">
      <ShopFilter />
      <div class="row">
        <LeftSidebar />
        <div class="col-md-9 catalogue-col right mb-50">
          <div :class="['shop-catalogue', `${layout}-view`]">
            <div class="row" v-if="!products?.length && !isLoadingProducts">
              <div class="col-12">
                <div class="d-flex justify-content-center">{{ $t('no_products_found') }}</div>
              </div>
            </div>
            <div class="row" v-else-if="isLoadingProducts">
              <div class="col-12">
                <card-skeleton :height="150"/>
              </div>
            </div>
            <div class="row items-grid" v-else>
              <div
                class="product"
                :class="[
                  `product-${layout}`,
                  { 'col-md-4 col-6 col-lg-3': layout === 'grid' },
                ]"
                v-for="product in products"
                :key="product.id"
              >
                <ProductItem :type="layout" :product="product" />
              </div>
            </div>
          </div>
          <PaginationV2
            v-if="products?.length"
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
import ShopFilter from './components/ShopFilter.vue'
import { onMounted } from 'vue'
import { useLayout } from '../../js/composables/layout'
import LeftSidebar from './components/LeftSidebar.vue'
import PaginationV2 from './components/PaginationV2.vue'
import ProductItem from './components/ProductItem.vue'
import { useProduct } from '../../js/composables/product'
import { useCategory } from '../../js/composables/category'
import CardSkeleton from './components/core/CardSkeleton.vue'

export default {
  name: 'CataloguePage',
  components: { CardSkeleton, ProductItem, PaginationV2, LeftSidebar, ShopFilter },
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
