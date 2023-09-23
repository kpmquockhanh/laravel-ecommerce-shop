<template>
    <section class="section-wrap pt-0 shop-items-slider">
      <card-skeleton v-if="isLoading" :number-item="4" class="px-5"/>
        <div class="container">
            <div class="row heading-row">
                <div class="col-md-12 text-center">
                    <h2 class="heading bottom-line">
                        Related Products
                    </h2>
                </div>
            </div>
            <div class="row">
                <CarouselComponent v-if="products.length" :items="products" :number-item="4" class="product-grid w-100" wrap-around>
                    <template v-slot:default="{ item }">
                        <div class="product product--carousel">
                            <ProductItem :product="item"/>
                        </div>
                    </template>
                </CarouselComponent>
              <div v-else class="center-block">Has no related product</div>
            </div>
        </div>
    </section>
</template>
<script>

import CarouselComponent from "../frontend_v2/Carousel.vue";
import Image from "./components/core/Image.vue";
import {doGet} from "../../js/http";
import get from "lodash/get";
import {onMounted, ref, watch} from "vue";
import ProductItem from "../frontend_v2/ProductItem.vue";
import CardSkeleton from "./components/core/CardSkeleton.vue";

export default {
    name: "ProductRelated",
    components: {CardSkeleton, ProductItem, Image, CarouselComponent},
    props: {
        productId: {
            type: Number,
            required: true,
        }
    },
    setup(props) {
        const isLoading = ref(true)
        const products = ref([])
        const fetchProducts = async (target = '') => {
            if (!props.productId) {
                return
            }
            isLoading.value = true
            const result = await doGet(`/api/products/similar/${props.productId}`)
            products.value = get(result, 'data', [])
            isLoading.value = false
        }
        onMounted(() => {
            fetchProducts()
        })

        watch(() => props.productId, (newValue, oldValue) => {
            if (newValue !== oldValue) {
                fetchProducts()
            }
        })
        return {
            products,
            isLoading,
        }
    },
}

</script>

<style scoped>

</style>
