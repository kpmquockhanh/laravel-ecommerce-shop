<template>
  <header class="nav-type-1">
    <!-- Fullscreen search -->
    <div class="search-wrap">
      <div class="search-inner">
        <div class="search-cell">
          <form method="get">
            <div class="search-field-holder">
              <input type="search" class="form-control main-search-input" :placeholder="$t('search_for')">
              <i class="ui-close search-close" id="search-close"></i>
            </div>
          </form>
        </div>
      </div>
    </div> <!-- end fullscreen search -->
    <!-- Top Bar -->
    <div class="top-bar hidden-xs">
      <div class="container">
        <div class="top-bar-links flex-parent">
          <ul class="top-bar-currency-language">
<!--            <li>-->
<!--              {{ $t('currency') }}: <a href="#">USD<i class="fa fa-angle-down"></i></a>-->
<!--              <div class="currency-dropdown">-->
<!--                <ul>-->
<!--                  <li><a href="#">USD</a></li>-->
<!--                  <li><a href="#">EUR</a></li>-->
<!--                </ul>-->
<!--              </div>-->
<!--            </li>-->
            <li class="language">
              {{ $t('language') }}: <a href="#" class="uppercase">{{ current }}<i class="fa fa-angle-down"></i></a>
              <div class="language-dropdown">
                <ul>
                  <li><a href="#" @click.prevent="onChangeLocale('en')">English</a></li>
                  <li><a href="#" @click.prevent="onChangeLocale('vi')">Tiếng Việt</a></li>
                </ul>
              </div>
            </li>
          </ul>

          <ul class="top-bar-acc">
            <li class="top-bar-link"><a href="#">{{ $t('my_wishlist') }}</a></li>
            <li class="top-bar-link"><a href="#">{{ $t('new_letters') }}</a></li>
            <li class="top-bar-link"><a href="#">{{ $t('login') }}</a></li>
          </ul>

        </div>
      </div>
    </div> <!-- end top bar -->

    <nav class="navbar navbar-static-top">
      <div class="navigation" id="sticky-nav">
        <div class="container relative">
          <div class="row flex-parent">
            <div class="navbar-header flex-child">
              <!-- Logo -->
              <div class="logo-container">
                <div class="logo-wrap">
                  <a href="/" @click.prevent="routeToHome">
                    <img class="logo-dark" src="@assets/v2/img/logo_dark.png" alt="logo">
                  </a>
                </div>
              </div>
              <button type="button" class="navbar-toggle" data-toggle="collapse"
                      data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!-- Mobile cart -->
              <div class="nav-cart mobile-cart hidden-lg hidden-md">
                <div class="nav-cart-outer">
                  <div class="nav-cart-inner">
                    <a href="#" class="nav-cart-icon">
                      <span class="nav-cart-badge">2</span>
                    </a>
                  </div>
                </div>
              </div>
            </div> <!-- end navbar-header -->

            <div class="nav-wrap flex-child">
              <div class="collapse navbar-collapse text-center show" id="navbar-collapse">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="#" @click.prevent="routeToHome">{{ $t('home') }}</a>
                  </li>
<!--                  <li class="dropdown">-->
<!--                    <a href="#">Pages</a>-->
<!--                    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--                    <ul class="dropdown-menu">-->
<!--                      <li><a href="about-us.html">About Us</a></li>-->
<!--                      <li><a href="contact.html">Contact</a></li>-->
<!--                      <li><a href="faq.html">F.A.Q</a></li>-->
<!--                      <li><a href="404.html">404</a></li>-->
<!--                    </ul>-->
<!--                  </li>-->

<!--                  <li class="dropdown">-->
<!--                    <a href="#">Blog</a>-->
<!--                    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--                    <ul class="dropdown-menu">-->
<!--                      <li><a href="blog-standard.html">Standard</a></li>-->
<!--                      <li><a href="blog-single.html">Single Post</a></li>-->
<!--                    </ul>-->
<!--                  </li>-->

<!--                  <li class="dropdown">-->
<!--                    <a href="#">Shop</a>-->
<!--                    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--                    <ul class="dropdown-menu megamenu-wide"-->
<!--                        style="width: 1665px; left: -856.844px;">-->
<!--                      <li>-->
<!--                        <div class="megamenu-wrap container">-->
<!--                          <div class="row">-->

<!--                            <div class="col-md-3 megamenu-item">-->
<!--                              <ul class="menu-list">-->
<!--                                <li>-->
<!--                                  <span>Shop Pages</span>-->
<!--                                </li>-->
<!--                                <li><a href="shop-catalog.html">Catalog no Sidebar</a>-->
<!--                                </li>-->
<!--                                <li><a href="shop-catalog-sidebar.html">Catalog With-->
<!--                                  Sidebar</a></li>-->
<!--                                <li><a href="shop-single.html">Single Product</a></li>-->
<!--                                <li><a href="shop-cart.html">Cart</a></li>-->
<!--                                <li><a href="shop-checkout.html">Checkout</a></li>-->
<!--                              </ul>-->
<!--                            </div>-->

<!--                            <div class="col-md-3 megamenu-item">-->
<!--                              <ul class="menu-list">-->
<!--                                <li>-->
<!--                                  <span>For Her</span>-->
<!--                                </li>-->
<!--                                <li><a href="catalog.html">Dresses</a></li>-->
<!--                                <li><a href="catalog.html">Watches</a></li>-->
<!--                                <li><a href="catalog.html">Belts</a></li>-->
<!--                                <li><a href="catalog.html">Jackets</a></li>-->
<!--                                <li><a href="catalog.html">Scarfs</a></li>-->
<!--                              </ul>-->
<!--                            </div>-->

<!--                            <div class="col-md-3 megamenu-item">-->
<!--                              <ul class="menu-list">-->
<!--                                <li>-->
<!--                                  <span>Accessories</span>-->
<!--                                </li>-->
<!--                                <li><a href="catalog.html">Wallets</a></li>-->
<!--                                <li><a href="catalog.html">Watches</a></li>-->
<!--                                <li><a href="catalog.html">Belts</a></li>-->
<!--                                <li><a href="catalog.html">Shoes</a></li>-->
<!--                                <li><a href="catalog.html">Scarfs</a></li>-->
<!--                              </ul>-->
<!--                            </div>-->

<!--                            <div class="col-md-3 megamenu-item">-->
<!--                              <ul class="menu-list">-->
<!--                                <li>-->
<!--                                  <span>For Him</span>-->
<!--                                </li>-->
<!--                                <li><a href="catalog.html">T-shirts</a></li>-->
<!--                                <li><a href="catalog.html">Watches</a></li>-->
<!--                                <li><a href="catalog.html">Belts</a></li>-->
<!--                                <li><a href="catalog.html">Jeans</a></li>-->
<!--                                <li><a href="catalog.html">Scarfs</a></li>-->
<!--                              </ul>-->
<!--                            </div>-->

<!--                          </div>-->
<!--                        </div>-->
<!--                      </li>-->
<!--                    </ul>-->
<!--                  </li>-->

<!--                  <li class="dropdown">-->
<!--                    <a href="#">Elements</a>-->
<!--                    <i class="fa fa-angle-down dropdown-trigger"></i>-->
<!--                    <ul class="dropdown-menu">-->
<!--                      <li><a href="shortcodes.html">Shortcodes</a></li>-->
<!--                      <li><a href="typography.html">Typography</a></li>-->
<!--                    </ul>-->
<!--                  </li> &lt;!&ndash; end elements &ndash;&gt;-->

                  <li class="mobile-links hidden-lg hidden-md">
                    <a href="#">{{ $t('my_account') }}</a>
                  </li>

                  <!-- Mobile search -->
                  <li id="mobile-search" class="hidden-lg hidden-md">
                    <form method="get" class="mobile-search">
                      <input type="search" class="form-control" :placeholder="$t('search')+'...'">
                      <button type="submit" class="search-button">
                        <i class="fa fa-search"></i>
                      </button>
                    </form>
                  </li>

                </ul> <!-- end menu -->
              </div> <!-- end collapse -->
            </div> <!-- end col -->

            <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
              <ul>
                <li class="nav-register">
                  <a href="#">{{ $t('my_account') }}</a>
                </li>
                <li class="nav-search-wrap style-2 hidden-sm hidden-xs">
                  <a href="#" class="nav-search search-trigger">
                    <i class="fa fa-search"></i>
                  </a>
                </li>
                <li class="nav-cart">
                  <NavCart/>
                </li>
              </ul>
            </div>

          </div> <!-- end row -->
        </div> <!-- end container -->
      </div> <!-- end navigation -->
    </nav> <!-- end navbar -->
  </header>
</template>
<script>
import {useRouter} from "vue-router";
import {useI18n} from "vue-i18n-lite";
import NavCart from "./NavCart.vue";

export default {
  name: 'HeaderV2Type1',
  components: {NavCart},
  setup() {
    const router = useRouter();
    const i18n = useI18n();
    const { current, changeLocale } = i18n
    const routeToHome = () => {
      router.push({
        name: 'home',
      })
    };

    const onChangeLocale = (locale) => {
      localStorage.setItem('locale', locale)
      changeLocale(locale)
    }

    return {
      current,
      onChangeLocale,
      routeToHome,
    };
  },
}
</script>
