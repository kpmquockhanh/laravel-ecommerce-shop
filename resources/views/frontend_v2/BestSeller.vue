<template>
  <div class="widget bestsellers">
    <div class="products-widget">
      <h3 class="widget-title heading uppercase relative bottom-line full-grey mb-30">Best Sellers</h3>
      <ul class="product-list-widget">
        <li class="clearfix">
          <a href="shop-single.html">
            <img src="@assets/v2/img/shop/shop_item_9.jpg" alt="">
            <span class="product-title">White Shirt</span>
          </a>
          <span class="price">
                        <ins>
                          <span class="amount">$120.00</span>
                        </ins>
                      </span>
        </li>
        <li class="clearfix">
          <a href="shop-single.html">
            <img src="@assets/v2/img/shop/shop_item_10.jpg" alt="">
            <span class="product-title">Street Hoddie</span>
          </a>
          <span class="price">
                        <ins>
                          <span class="amount">$179.00</span>
                        </ins>
                      </span>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: 'BestSeller'
}
</script>
