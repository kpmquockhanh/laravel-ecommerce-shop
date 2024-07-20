<template>
  <div class="product-item position-relative" :class="{ 'd-flex': type === 'list' }">
    <div class="product-img hover-trigger aspect-square">
      <a href="/public" class="h-100" @click.prevent="routeToDetail">
        <E-Image v-if="product.thumbnail" :src="product.thumbnail" alt="" class="h-100" img-class="h-100 object-fit-cover" />
        <E-Image v-else src="@images/placeholder.jpg" alt="" />

        <E-Image
          v-if="images.length"
          :src="images[0].src"
          alt=""
          class="back-img h-100"
          img-class="h-100 object-fit-cover"
          no-loading
        />
      </a>
      <div class="product-label">
        <span class="sale">sale</span>
      </div>
      <div class="hover-2">
        <div class="product-actions">
          <a href="#" class="product-add-to-wishlist">
            <i class="fa fa-heart"></i>
          </a>
        </div>
      </div>
      <a href="#" class="product-quickview" @click.prevent="routeToDetail">
        <span v-if="!overlay">{{ $t('see_detail') }}</span>
        <div v-else>
          <div>
            {{ product.title }}
          </div>
          <div class="price d-flex gap-4 justify-content-center w-100">
            <del>
              <span>{{ formatCurrency(product.price * 1.3) }}</span>
            </del>
            <ins>
          <span class="amount">{{
              formatCurrency(parseFloat(product.price))
            }}</span>
            </ins>
          </div>
        </div>
      </a>
    </div>

    <div v-if="!overlay" class="d-flex justify-content-between">
      <div class="product-details">
        <h3 class="product-title text-truncate">
          <a href="#" @click.prevent="routeToDetail">{{ product.title }}</a>
        </h3>
        <span class="category">
          <a href="#">{{
              product.categories?.map((c) => c.name).join(', ')
            }}</a>
        </span>
      </div>

      <span class="price">
        <del>
          <span>{{ formatCurrency(product.price * 1.3) }}</span>
        </del>
        <ins>
          <span class="amount">{{
              formatCurrency(parseFloat(product.price))
            }}</span>
        </ins>
      </span>
    </div>

    <div class="product-description">
      <h3 class="product-title">
        <a href="#" @click.prevent="routeToDetail">{{ product.title }}</a>
      </h3>
      <span class="price">
        <del>
          <span>{{ formatCurrency(product.price * 1.3) }}</span>
        </del>
        <ins>
          <span class="amount">{{
              formatCurrency(parseFloat(product.price))
            }}</span>
        </ins>
      </span>
      <span class="rating">
        <a href="#">3 {{ $t('reviews') }}</a>
      </span>
      <p v-html="product.description"></p>
      <a href="#" class="btn btn-dark btn-md left"
      ><span>{{ $t('add_to_cart') }}</span></a
      >
      <div class="product-add-to-wishlist">
        <a href="#"><i class="fa fa-heart"></i></a>
      </div>
    </div>
  </div>
</template>
<script>
import { useRouter } from 'vue-router'
import EImage from './core/CoreImage.vue'
import { computed } from 'vue'
import get from 'lodash/get'
import { formatCurrency } from '../../../js/utils'

export default {
  name: 'ProductItem',
  methods: { formatCurrency },
  components: { EImage },
  props: {
    type: {
      type: String,
      default: 'grid',
    },
    product: {
      type: Object,
    },
    overlay: {
      type: Boolean,
      default: false,
    },
  },
  setup(props) {
    const router = useRouter()
    const routeToDetail = () => {
      router.push({
        name: 'product-detail',
        params: { slug: props.product.slug },
      })
    }
    const images = computed(() => get(props.product, 'images', []))
    return {
      routeToDetail,
      images,
    }
  },
}
</script>

<style scoped>
.gap-4 {
  gap: 4px;
}
.aspect-square {
  aspect-ratio: 1;
}
</style>
