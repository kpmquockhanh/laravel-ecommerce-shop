<template>
    <header class="header trans_300">
        <div class="main_nav_container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <div class="logo_container">
                            <a href="index.html">WATCH<span>SHOP</span></a>
                        </div>
                        <nav class="navbar">
                            <ul class="navbar_menu mt-3">
                                <li><a href="mens-watches.html">Man</a></li>
                                <li><a href="mens-watches.html">Woman</a></li>
                                <li><a href="mens-watches.html">Kid</a></li>
                                <li><a href="mens-watches.html">Sport</a></li>
                                <li><a href="mens-watches.html">Smart22</a></li>
                            </ul>
                            <ul class="navbar_user mt-3">
                                <li class="checkout">
                                    <a href="my-favorites.html">
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                        <span id="checkout_items" class="checkout_items">2</span>
                                    </a>
                                </li>
                                <li class="checkout">
                                    <a href="my-shopping-cart.html">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        <span id="checkout_items" class="checkout_items">3</span>
                                    </a>
                                </li>
                                <li><a href="user-login.html"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            </ul>
                            <div class="hamburger_container">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content">
            <ul class="menu_top_nav">
                <li class="menu_item"><a href="mens-watches.html">Man</a></li>
                <li class="menu_item"><a href="mens-watches.html">Woman</a></li>
                <li class="menu_item"><a href="mens-watches.html">Kid</a></li>
                <li class="menu_item"><a href="mens-watches.html">Sport</a></li>
                <li class="menu_item"><a href="mens-watches.html">Smart 123</a></li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "WatchHeader"
}
</script>

<style scoped>

</style>
