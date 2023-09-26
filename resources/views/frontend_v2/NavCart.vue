<template>
  <div class="nav-cart-outer">
    <div class="nav-cart-inner">
      <a href="#" class="nav-cart-icon">
        0
      </a>
    </div>
  </div>
  <div class="nav-cart-container">
    <div class="nav-cart-items">
      <CartItem/>
    </div> <!-- end cart items -->

    <div class="nav-cart-summary">
      <span>{{ $t('cart_subtotal') }}</span>
      <span class="total-price">$1799.00</span>
    </div>

    <div class="nav-cart-actions mt-20">
      <a href="#" class="btn btn-md btn-dark" @click="routeToCart"><span>{{ $t('view_cart') }}</span></a>
      <a href="shop-checkout.html"
         class="btn btn-md btn-color mt-10"><span>{{ $t('process_to_checkout') }}</span></a>
    </div>
  </div>
</template>
<script>
import CartItem from "./CartItem.vue"
import {useRouter} from "vue-router";

export default {
  name: 'NavCart',
  components: {CartItem},
  setup() {
    const router = useRouter()
    const routeToCart = () => {
      router.push({name: 'cart'})
    }
    return {
      routeToCart,
    }
  },
}
</script>
