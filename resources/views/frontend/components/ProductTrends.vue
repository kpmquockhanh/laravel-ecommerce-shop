<template>
    <!-- TRENDS PRODUCT  -->
    <div v-if="products.length > 0" class="container mt-5">
        <h3 class="section-title">{{ title }}</h3>
        <card-skeleton v-if="isLoading"/>
        <div v-else class="row mt-5 no-gutters">
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 product-col" v-for="product in products">
                <Product :product="product" :route-to-detail="routeToDetail"/>
            </div>
        </div>
    </div>
    <!-- TRENDS PRODUCT END -->
</template>

<script>
import {computed, onMounted, ref, watch} from "vue";
import get from "lodash/get";
import {useRouter} from "vue-router";
import Product from "./Product.vue";
import Loading from "./core/Loading.vue";
import {doGet} from "../../../js/http";
import CardSkeleton from "./core/CardSkeleton.vue";

export default {
    name: "ProductTrend",
    components: {CardSkeleton, Loading, Product},
    props: {
        type: {
            type: String,
            default: 'trend'
        },
        productId: {
            type: Number,
            default: 0
        }
    },
    setup(props) {
        const isLoading = ref(true)
        const products = ref([])
        const router = useRouter()
        const fetchProduct = async () => {
            let resp;
            switch (props.type) {
                case 'trend':
                    resp = await doGet('/api/products/newest')
                    products.value = get(resp, 'data', [])
                    break;
                case 'similar':
                    if (!props.productId) {
                        return
                    }
                    resp = await doGet(`/api/products/similar/${props.productId}`)
                    products.value = get(resp, 'data', [])
                    break;
            }
        }

        const routeToDetail = (product) => {
            router.push({name: 'product-detail', params: {slug: product.slug}})
        }
        const title = computed(() => {
            switch (props.type) {
                case 'trend':
                    return 'Trends'
                case 'newest':
                    return 'Newest'
                case 'similar':
                    return 'Similar Products'
            }
        })

        watch(() => props.productId, () => {
            fetchProduct()
        })


        onMounted(async () => {
            await fetchProduct()
            isLoading.value = false
        })


        return {
            products,
            routeToDetail,
            title,
            isLoading,
        }
    }
}
</script>

