<template>
  <div class="table-wrap mb-30">
    <table class="shop_table cart table">
      <thead>
      <tr>
        <th class="product-name" colspan="2">Product</th>
        <th class="product-price">Price</th>
        <th class="product-quantity">Quantity</th>
        <th class="product-subtotal" colspan="2">Total</th>
      </tr>
      </thead>
      <tbody>
      <CartItemDetail/>
      </tbody>
    </table>
  </div>
</template>
<script>
import CartItemDetail from "./CartItemDetail.vue";

export default {
  name: 'CartTable',
  components: {CartItemDetail}
}
</script>
