<template>
    <div v-if="product?.title" class="card product-item m-1">
        <div class="float-item">
            <p class="product-icon"><a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> </a>
            </p>
        </div>
        <a :href="`/${product.slug}`" @click.prevent="routeToDetail">
            <Image v-if="product.thumbnail" rounded :src="product.thumbnail"/>
        </a>
        <div class="card-body">
            <h5 class="category">{{ product.categories.map((c) => c.name).join(', ') }}</h5>
            <p class="card-text"><a href="/public" @click.prevent="routeToDetail">{{
                    product.title
                }}</a></p>
            <h5 class="card-title">${{ product.price }}</h5>
            <a href="#" class="btn btn-primary">Add to Card</a>
        </div>
    </div>
</template>
<script>
import Image from "./core/Image.vue"
import {useRouter} from "vue-router";

export default {
    name: 'Product',
    components: {Image},
    props: {
        product: {
            type: Object,
            default: () => {
            }
        },
    },
    setup(props) {
        const router = useRouter()
        const routeToDetail = () => {
            router.push({name: 'product-detail', params: {slug: props.product.slug}})
        }
        return {
            routeToDetail
        }
    },
}
</script>
