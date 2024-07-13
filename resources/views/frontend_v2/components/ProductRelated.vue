<template>
  <section class="section-wrap pt-0 shop-items-slider">
    <card-skeleton v-if="isLoading" :number-item="4" class="px-5" />
    <div v-else class="container">
      <div class="row heading-row">
        <div class="col-md-12 text-center">
          <h2 class="heading bottom-line">
            {{ $t('related_products') }}
          </h2>
        </div>
      </div>
      <div class="row">
        <CarouselComponent
          v-if="products.length"
          :items="products"
          :number-item="4.5"
          class="product-grid w-100"
          wrap-around
          :breakpoints="breakpoints"
        >
          <template v-slot:default="{ item }">
            <div class="product product--carousel">
              <ProductItem :product="item" />
            </div>
          </template>
        </CarouselComponent>
        <div v-else class="center-block">Has no related product</div>
      </div>
    </div>
  </section>
</template>
<script>
import CarouselComponent from './Carousel.vue'
import { doGet } from '../../../js/http'
import get from 'lodash/get'
import { onMounted, ref, watch } from 'vue'
import ProductItem from './ProductItem.vue'
import CardSkeleton from './core/CardSkeleton.vue'

export default {
  name: 'ProductRelated',
  components: { CardSkeleton, ProductItem, CarouselComponent },
  props: {
    productId: {
      type: Number,
      required: true,
    },
  },
  setup(props) {
    const isLoading = ref(true)
    const products = ref([])
    const fetchProducts = async () => {
      if (!props.productId) {
        return
      }
      isLoading.value = true
      const result = await doGet(`/api/products/similar/${props.productId}`)
      products.value = get(result, 'data', [])
      isLoading.value = false
    }
    onMounted(() => {
      fetchProducts('w3')
    })

    watch(
      () => props.productId,
      (newValue, oldValue) => {
        if (newValue !== oldValue) {
          fetchProducts('w4')
        }
      }
    )
    const breakpoints = {
      100: {
        itemsToShow: 2,
        snapAlign: 'center',
      },
      768: {
        itemsToShow: 3,
        snapAlign: 'center',
      },
      1200: {
        itemsToShow: 4,
        snapAlign: 'center',
      },
    }
    return {
      products,
      isLoading,
      breakpoints,
    }
  },
}
</script>

<style scoped></style>
