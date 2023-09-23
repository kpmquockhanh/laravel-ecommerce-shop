<template>
    <header class="nav-type-1">
        <!-- Fullscreen search -->
        <div class="search-wrap">
            <div class="search-inner">
                <div class="search-cell">
                    <form method="get">
                        <div class="search-field-holder">
                            <input type="search" class="form-control main-search-input" placeholder="Search for">
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
                        <li>
                            Currency: <a href="#">USD<i class="fa fa-angle-down"></i></a>
                            <div class="currency-dropdown">
                                <ul>
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">EUR</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="language">
                            Language: <a href="#">ENG<i class="fa fa-angle-down"></i></a>
                            <div class="language-dropdown">
                                <ul>
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">German</a></li>
                                    <li><a href="#">Chinese</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <ul class="top-bar-acc">
                        <li class="top-bar-link"><a href="#">My Wishlist</a></li>
                        <li class="top-bar-link"><a href="#">Newsletter</a></li>
                        <li class="top-bar-link"><a href="#">Login</a></li>
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
                                        <a href="#" @click.prevent="routeToHome">Home</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#">Pages</a>
                                        <i class="fa fa-angle-down dropdown-trigger"></i>
                                        <ul class="dropdown-menu">
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="contact.html">Contact</a></li>
                                            <li><a href="faq.html">F.A.Q</a></li>
                                            <li><a href="404.html">404</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Blog</a>
                                        <i class="fa fa-angle-down dropdown-trigger"></i>
                                        <ul class="dropdown-menu">
                                            <li><a href="blog-standard.html">Standard</a></li>
                                            <li><a href="blog-single.html">Single Post</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Shop</a>
                                        <i class="fa fa-angle-down dropdown-trigger"></i>
                                        <ul class="dropdown-menu megamenu-wide"
                                            style="width: 1665px; left: -856.844px;">
                                            <li>
                                                <div class="megamenu-wrap container">
                                                    <div class="row">

                                                        <div class="col-md-3 megamenu-item">
                                                            <ul class="menu-list">
                                                                <li>
                                                                    <span>Shop Pages</span>
                                                                </li>
                                                                <li><a href="shop-catalog.html">Catalog no Sidebar</a>
                                                                </li>
                                                                <li><a href="shop-catalog-sidebar.html">Catalog With
                                                                    Sidebar</a></li>
                                                                <li><a href="shop-single.html">Single Product</a></li>
                                                                <li><a href="shop-cart.html">Cart</a></li>
                                                                <li><a href="shop-checkout.html">Checkout</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-3 megamenu-item">
                                                            <ul class="menu-list">
                                                                <li>
                                                                    <span>For Her</span>
                                                                </li>
                                                                <li><a href="catalog.html">Dresses</a></li>
                                                                <li><a href="catalog.html">Watches</a></li>
                                                                <li><a href="catalog.html">Belts</a></li>
                                                                <li><a href="catalog.html">Jackets</a></li>
                                                                <li><a href="catalog.html">Scarfs</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-3 megamenu-item">
                                                            <ul class="menu-list">
                                                                <li>
                                                                    <span>Accessories</span>
                                                                </li>
                                                                <li><a href="catalog.html">Wallets</a></li>
                                                                <li><a href="catalog.html">Watches</a></li>
                                                                <li><a href="catalog.html">Belts</a></li>
                                                                <li><a href="catalog.html">Shoes</a></li>
                                                                <li><a href="catalog.html">Scarfs</a></li>
                                                            </ul>
                                                        </div>

                                                        <div class="col-md-3 megamenu-item">
                                                            <ul class="menu-list">
                                                                <li>
                                                                    <span>For Him</span>
                                                                </li>
                                                                <li><a href="catalog.html">T-shirts</a></li>
                                                                <li><a href="catalog.html">Watches</a></li>
                                                                <li><a href="catalog.html">Belts</a></li>
                                                                <li><a href="catalog.html">Jeans</a></li>
                                                                <li><a href="catalog.html">Scarfs</a></li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href="#">Elements</a>
                                        <i class="fa fa-angle-down dropdown-trigger"></i>
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
                        </div> <!-- end col -->

                        <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
                            <ul>
                                <li class="nav-register">
                                    <a href="#">My Account</a>
                                </li>
                                <li class="nav-search-wrap style-2 hidden-sm hidden-xs">
                                    <a href="#" class="nav-search search-trigger">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </li>
                                <li class="nav-cart">
                                    <div class="nav-cart-outer">
                                        <div class="nav-cart-inner">
                                            <a href="#" class="nav-cart-icon">
                                                0
                                            </a>
                                        </div>
                                    </div>
                                    <div class="nav-cart-container">
                                        <div class="nav-cart-items">

                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-img">
                                                    <a href="#">
                                                        <img src="@assets/v2/img/shop/shop_item_1.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="nav-cart-title">
                                                    <a href="#">
                                                        Ladies Bag
                                                    </a>
                                                    <div class="nav-cart-price">
                                                        <span>1 x</span>
                                                        <span>1250.00</span>
                                                    </div>
                                                </div>
                                                <div class="nav-cart-remove">
                                                    <a href="#" class="remove"><i class="ui-close"></i></a>
                                                </div>
                                            </div>

                                            <div class="nav-cart-item clearfix">
                                                <div class="nav-cart-img">
                                                    <a href="#">
                                                        <img src="@assets/v2/img/shop/shop_item_2.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="nav-cart-title">
                                                    <a href="#">
                                                        Sequin Suit longer title
                                                    </a>
                                                    <div class="nav-cart-price">
                                                        <span>1 x</span>
                                                        <span>1250.00</span>
                                                    </div>
                                                </div>
                                                <div class="nav-cart-remove">
                                                    <a href="#" class="remove"><i class="ui-close"></i></a>
                                                </div>
                                            </div>

                                        </div> <!-- end cart items -->

                                        <div class="nav-cart-summary">
                                            <span>Cart Subtotal</span>
                                            <span class="total-price">$1799.00</span>
                                        </div>

                                        <div class="nav-cart-actions mt-20">
                                            <a href="shop-cart.html" class="btn btn-md btn-dark"><span>View Cart</span></a>
                                            <a href="shop-checkout.html"
                                               class="btn btn-md btn-color mt-10"><span>Proceed to Checkout</span></a>
                                        </div>
                                    </div>
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

export default {
    name: 'HeaderV2Type1',
    setup() {
        const router = useRouter();
        const routeToHome = () => {
            router.push({
                name: 'home',
            })
        };

        return {
            routeToHome,
        };
    },
}
</script>
