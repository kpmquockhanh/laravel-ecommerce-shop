<template>
  <div class="product-item hover-trigger">
    <div class="product-img">
      <a href="shop-single.html">
        <img :src="`/img_v2/shop/shop_item_${index+1}.jpg`" alt="">
      </a>
      <div class="product-label">
        <span class="sale">sale</span>
      </div>
      <div class="hover-overlay">
        <div class="product-actions">
          <a href="#" class="product-add-to-wishlist">
            <i class="fa fa-heart"></i>
          </a>
        </div>
        <div class="product-details valign">
                  <span class="category">
                    <a href="catalogue-grid.html">Women</a>
                  </span>
          <h3 class="product-title">
            <a href="shop-single.html">Drawstring Dress</a>
          </h3>
          <span class="price">
                    <del>
                      <span>$730.00</span>
                    </del>
                    <ins>
                      <span class="amount">$399.99</span>
                    </ins>
                  </span>
          <div class="btn-quickview">
            <a href="#" class="btn btn-md btn-color">
              <span>Quickview</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'ProductItem',
  props: {
    index: {
      type: Number,
      default: 0,
    }
  }
}
</script>
