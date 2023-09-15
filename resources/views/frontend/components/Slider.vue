<template>
    <!-- SLİDER  -->
    <div v-if="!isLoading" class="container mt-7">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12">
                <h1 class="slide-baslik">{{ product.title }}</h1>
                <p class="slide-yazi" v-html="product.description">
                </p>

                <span class="slider-price">$ {{ product.price }}</span>
                <div class="row p-3">
                    <button type="button" class="btn add-to-favorite mr-1">ADD TO FAVORİTE</button>
                    <button type="button" class="btn add-to-card">ADD TO CARD</button>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 d-flex-justify-content-center mt-5">
                <Image v-if="product.thumbnail" img-class="rounded" :src="product.thumbnail" class="w-100" style="object-fit: contain;"/>
            </div>
        </div>
    </div>
    <!-- SLİDER END -->
</template>

<script>
import {ref} from "vue";
import get from "lodash/get";
import Image from "./core/Image.vue";
import {doGet} from "../../../js/http";

export default {
    name: "Slider",
    components: {Image},
    setup() {
        const product = ref({});
        const isLoading = ref(true);
        const fetchProduct = async () => {
            const resp = await doGet('/api/products/featured')
            product.value = get(resp, 'data', {})
        }
        fetchProduct().then(() => isLoading.value = false)

        const getThumb = (product) => {
            const src = get(product, 'images[0].src')
            if (!src) {
                return '/img/placeholder.jpg'
            }
            return `/images/${get(product, 'images[0].src')}`
        }
        return {
            product,
            getThumb,
            isLoading,
        }
    }
}
</script>

<style scoped>

</style>
