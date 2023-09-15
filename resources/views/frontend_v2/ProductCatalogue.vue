<template>
  <div class="col-md-4 col-xs-6 product" :class="[`product-${type}`]">
    <div class="product-item clearfix" style="opacity: 1;">
      <div class="product-img hover-trigger">
        <a href="/" @click.prevent="routeToDetail">
          <img :src="`/img_v2/shop/shop_item_${index+1}.jpg`" alt="">
          <img :src="`/img_v2/shop/shop_item_back_${index+1}.jpg`" alt="" class="back-img">
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
        <a href="#" class="product-quickview">Quick View</a>
      </div>

      <div class="product-details">
        <h3 class="product-title">
          <a href="shop-single.html">Drawstring Dress</a>
        </h3>
        <span class="category">
          <a href="catalogue-grid.html">Women</a>
        </span>
      </div>

      <span class="price">
        <del>
          <span>$730.00</span>
        </del>
        <ins>
          <span class="amount">$159.99</span>
        </ins>
      </span>

      <div class="product-description">
        <h3 class="product-title">
          <a href="shop-single.html">Drawstring Dress</a>
        </h3>
        <span class="price">
          <del>
            <span>$730.00</span>
          </del>
          <ins>
            <span class="amount">$159.99</span>
          </ins>
        </span>
        <span class="rating">
          <a href="#">3 Reviews</a>
        </span>
        <p>Zenna Shop is a very slick and clean e-commerce template with endless possibilities. Creating an
          awesome clothes store with this Theme is easy than you can imagine. Grab this theme now.</p>
        <a href="#" class="btn btn-dark btn-md left"><span>Add to Cart</span></a>
        <div class="product-add-to-wishlist">
          <a href="#"><i class="fa fa-heart"></i></a>
        </div>
      </div>

    </div>
  </div>
</template>
<script>
import {useRouter} from "vue-router";

export default {
  name: 'ProductCatalogue',
  props: {
    index: {
      type: Number,
      default: 0,
    },
    type: {
      type: String,
      default: 'grid'
    }
  },
  setup() {
    const router = useRouter()
    const routeToDetail = () => {
      router.push({name: 'product-detail-v2', params: {slug: 'sd'}})
    }
    return {
      routeToDetail
    }
  },
}
</script>
