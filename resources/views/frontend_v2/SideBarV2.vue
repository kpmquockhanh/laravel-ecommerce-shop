<template>
  <header class="nav-type-2">

    <nav class="navbar">
      <div class="container header-wrap relative">

        <div class="row">

          <div class="navbar-header">
            <!-- Logo -->
            <div class="logo-container">
              <div class="logo-wrap">
                <a href="index.html">
                  <img class="logo-dark" src="@assets/v2/img/logo_dark.png" alt="logo">
                </a>
              </div>
            </div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
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
          <div class="clear"></div>

          <div class="nav-wrap">

            <!-- Cart -->
            <div class="nav-cart clearfix hidden-sm hidden-xs">
              <div class="nav-cart-outer">
                <div class="nav-cart-inner">
                  <a href="#" class="nav-cart-icon">
                    2
                  </a>
                </div>
              </div>
              <div class="nav-cart-amount">
                <a href="#"> $1569.99</a>
              </div>
            </div> <!-- end cart -->

            <div class="collapse navbar-collapse" id="navbar-collapse">
              <ul class="nav navbar-nav">

                <li class="dropdown">
                  <a href="#">Home</a><i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="index-2.html">Home 2</a></li>
                    <li><a href="index-3.html">Home 3</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#">Pages</a><i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu">
                    <li><a href="about-us.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="coming-soon.html">Coming Soon</a></li>
                    <li><a href="404.html">404</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#">Blog</a><i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu">
                    <li><a href="blog-standard.html">Standard</a></li>
                    <li><a href="blog-masonry.html">Masonry</a></li>
                    <li><a href="blog-single.html">Single Post</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#">Shop</a><i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu">
                    <li><a href="shop-catalog.html">Catalog no Sidebar</a></li>
                    <li><a href="shop-catalog-sidebar.html">Catalog With Sidebar</a></li>
                    <li><a href="shop-single.html">Single Product</a></li>
                    <li><a href="shop-cart.html">Cart</a></li>
                    <li><a href="shop-checkout.html">Checkout</a></li>
                  </ul>
                </li>

                <li class="dropdown">
                  <a href="#">Elements</a><i class="fa fa-angle-down dropdown-trigger"></i>
                  <ul class="dropdown-menu">
                    <li><a href="shortcodes.html">Shortcodes</a></li>
                    <li><a href="typography.html">Typography</a></li>
                  </ul>
                </li> <!-- end elements -->

                <li class="mobile-links hidden-lg hidden-md">
                  <a href="#">My Account</a>
                </li>

                <!-- Mobile search -->
                <li id="mobile-search" class="hidden-lg hidden-md">
                  <form method="get" class="mobile-search">
                    <input type="search" class="form-control" placeholder="Search...">
                    <button type="submit" class="search-button">
                      <i class="fa fa-search"></i>
                    </button>
                  </form>
                </li>

              </ul> <!-- end menu -->
            </div> <!-- end collapse -->

            <!-- Search -->
            <form class="relative mt-60 hidden-sm hidden-xs">
              <input type="search" class="searchbox mb-0" placeholder="Search">
              <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
            </form>

            <div class="social-icons mt-40 nobase hidden-sm hidden-xs">
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-facebook"></i></a>
              <a href="#"><i class="fa fa-google-plus"></i></a>
            </div>

            <div class="copyright hidden-sm hidden-xs">
                <span>
                  &copy; 2017 Zenna Theme,<br> Made by <a href="http://deothemes.com">DeoThemes</a>
                </span>
            </div>

          </div> <!-- end nav-wrap -->

        </div> <!-- end row -->
      </div> <!-- end container -->
    </nav> <!-- end navbar -->
  </header>
</template>
<script>
export default {
  name: 'SideBarV2'
}
</script>
