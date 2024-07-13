<script setup>

</script>

<template>
  <li class="dropdown">
    <a href="#">Blog</a>
    <i class="fa fa-angle-down dropdown-trigger"></i>
    <ul class="dropdown-menu">
      <li><a href="blog-standard.html">Standard</a></li>
      <li><a href="blog-single.html">Single Post</a></li>
    </ul>
  </li>

<!--  <li class="dropdown">-->
<!--    <a href="#">Shop</a>-->
<!--    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--    <ul class="dropdown-menu megamenu-wide"-->
<!--        style="width: 1665px; left: -856.844px;">-->
<!--      <li>-->
<!--        <div class="megamenu-wrap container">-->
<!--          <div class="row">-->

<!--            <div class="col-md-3 megamenu-item">-->
<!--              <ul class="menu-list">-->
<!--                <li>-->
<!--                  <span>Shop Pages</span>-->
<!--                </li>-->
<!--                <li><a href="shop-catalog.html">Catalog no Sidebar</a>-->
<!--                </li>-->
<!--                <li><a href="shop-catalog-sidebar.html">Catalog With-->
<!--                  Sidebar</a></li>-->
<!--                <li><a href="shop-single.html">Single Product</a></li>-->
<!--                <li><a href="shop-cart.html">Cart</a></li>-->
<!--                <li><a href="shop-checkout.html">Checkout</a></li>-->
<!--              </ul>-->
<!--            </div>-->

<!--            <div class="col-md-3 megamenu-item">-->
<!--              <ul class="menu-list">-->
<!--                <li>-->
<!--                  <span>For Her</span>-->
<!--                </li>-->
<!--                <li><a href="catalog.html">Dresses</a></li>-->
<!--                <li><a href="catalog.html">Watches</a></li>-->
<!--                <li><a href="catalog.html">Belts</a></li>-->
<!--                <li><a href="catalog.html">Jackets</a></li>-->
<!--                <li><a href="catalog.html">Scarfs</a></li>-->
<!--              </ul>-->
<!--            </div>-->

<!--            <div class="col-md-3 megamenu-item">-->
<!--              <ul class="menu-list">-->
<!--                <li>-->
<!--                  <span>Accessories</span>-->
<!--                </li>-->
<!--                <li><a href="catalog.html">Wallets</a></li>-->
<!--                <li><a href="catalog.html">Watches</a></li>-->
<!--                <li><a href="catalog.html">Belts</a></li>-->
<!--                <li><a href="catalog.html">Shoes</a></li>-->
<!--                <li><a href="catalog.html">Scarfs</a></li>-->
<!--              </ul>-->
<!--            </div>-->

<!--            <div class="col-md-3 megamenu-item">-->
<!--              <ul class="menu-list">-->
<!--                <li>-->
<!--                  <span>For Him</span>-->
<!--                </li>-->
<!--                <li><a href="catalog.html">T-shirts</a></li>-->
<!--                <li><a href="catalog.html">Watches</a></li>-->
<!--                <li><a href="catalog.html">Belts</a></li>-->
<!--                <li><a href="catalog.html">Jeans</a></li>-->
<!--                <li><a href="catalog.html">Scarfs</a></li>-->
<!--              </ul>-->
<!--            </div>-->

<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--    </ul>-->
<!--  </li>-->

<!--  <li class="dropdown">-->
<!--    <a href="#">Elements</a>-->
<!--    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--    <ul class="dropdown-menu">-->
<!--      <li><a href="shortcodes.html">Shortcodes</a></li>-->
<!--      <li><a href="typography.html">Typography</a></li>-->
<!--    </ul>-->
<!--  </li> &lt;!&ndash; end elements &ndash;&gt;-->

  <li class="mobile-links hidden-lg hidden-md">
    <a href="#">{{ $t("my_account") }}</a>
  </li>
</template>


