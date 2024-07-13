<script>
import { useRouter } from "vue-router";
import { useI18n } from "vue-i18n-lite";
import NavCart from "./NavCart.vue";
import { nextTick, ref, watch } from "vue";
import { onClickOutside } from "@vueuse/core";
import HeaderDropDownExt from "./HeaderDropDownExt.vue";

export default {
  name: "HeaderV2Type1",
  components: { HeaderDropDownExt, NavCart },
  setup() {
    const router = useRouter();
    const i18n = useI18n();
    const { current, changeLocale } = i18n;
    const target = ref(null);
    const routeToHome = () => {
      router.push({
        name: "home"
      });
    };



    const searchString = ref("");

    const onChangeLocale = (locale) => {
      localStorage.setItem("locale", locale);
      changeLocale(locale);
    };

    onClickOutside(target, () => {
      if (isOpenSearch.value) {
        isOpenSearch.value = false;
      }
    });

    const isOpenSearch = ref(false);

    const input = ref(null);
    watch(isOpenSearch, (value) => {
      if (value) {
        nextTick(() => {
          input.value.focus();
        });
      }
    });
    const onSubmitSearch = () => {
      router
        .push({
          name: "home",
          query: {
            q: searchString.value
          }
        })
        .then(() => {
          isOpenSearch.value = false;
        });
    };
    return {
      current,
      onChangeLocale,
      routeToHome,
      isOpenSearch,
      target,
      searchString,
      onSubmitSearch,
      input
    };
  }
};
</script>
<template>
  <header class="nav-type-1">
    <!-- Fullscreen search -->
    <div class="search-wrap" :class="{ 'd-block': isOpenSearch }">
      <div class="search-inner">
        <div class="search-cell">
          <div class="search-field-holder" ref="target">
            <input
              v-model="searchString"
              type="search"
              class="form-control main-search-input"
              :placeholder="$t('search_for')"
              ref="input"
              @keyup.esc="isOpenSearch = false"
              @keyup.enter="onSubmitSearch"
            />
            <i
              class="ui-close search-close"
              id="search-close"
              @click="isOpenSearch = false"
            ></i>
          </div>
        </div>
      </div>
    </div>
    <!-- end fullscreen search -->
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
              {{ $t("language") }}:
              <a href="#" class="uppercase"
              >{{ current }}<i class="fa fa-angle-down"></i
              ></a>
              <div class="language-dropdown">
                <ul>
                  <li>
                    <a href="#" @click.prevent="onChangeLocale('en')"
                    >English</a
                    >
                  </li>
                  <li>
                    <a href="#" @click.prevent="onChangeLocale('vi')"
                    >Tiếng Việt</a
                    >
                  </li>
                </ul>
              </div>
            </li>
          </ul>

          <ul class="top-bar-acc">
            <li class="top-bar-link">
              <a href="#">{{ $t("my_wishlist") }}</a>
            </li>
            <li class="top-bar-link">
              <a href="#">{{ $t("new_letters") }}</a>
            </li>
            <li class="top-bar-link">
              <router-link to="/login">{{ $t("login") }}</router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- end top bar -->

    <nav class="navbar navbar-static-top">
      <div class="navigation" id="sticky-nav">
        <div class="container relative">
          <div class="row flex-parent">
            <div class="navbar-header flex-child">
              <!-- Logo -->
              <div class="logo-container">
                <div class="logo-wrap">
                  <a href="/public" @click.prevent="routeToHome">
                    <img
                      class="logo-dark"
                      src="@assets/v2/img/logo_dark.png"
                      alt="logo"
                    />
                  </a>
                </div>
              </div>
              <button
                type="button"
                class="navbar-toggle"
                data-toggle="collapse"
                data-target="#navbar-collapse"
              >
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
            </div>
            <!-- end navbar-header -->

            <div class="nav-wrap flex-child">
              <div
                class="collapse navbar-collapse text-center show"
                id="navbar-collapse"
              >
                <ul class="nav navbar-nav">
                  <li>
                    <a href="#" @click.prevent="routeToHome">{{
                        $t("home")
                      }}</a>
                  </li>

                  <li>
                    <router-link :to="{name: 'product_list'}">{{$t("products")}}</router-link>
                  </li>
<!--                  <header-drop-down-ext />-->

                  <!-- Mobile search -->
                  <li id="mobile-search" class="hidden-lg hidden-md">
                    <form method="get" class="mobile-search">
                      <input
                        type="search"
                        class="form-control"
                        :placeholder="$t('search') + '...'"
                      />
                      <button type="submit" class="search-button">
                        <i class="fa fa-search"></i>
                      </button>
                    </form>
                  </li>
                </ul>
                <!-- end menu -->
              </div>
              <!-- end collapse -->
            </div>
            <!-- end col -->

            <div class="flex-child flex-right nav-right hidden-sm hidden-xs">
              <ul>
                <li class="nav-register">
                  <a href="#">{{ $t("my_account") }}</a>
                </li>
                <li class="nav-search-wrap style-2 hidden-sm hidden-xs">
                  <a
                    href="#"
                    class="nav-search search-trigger"
                    @click="isOpenSearch = true"
                  >
                    <i class="fa fa-search"></i>
                  </a>
                </li>
                <li class="nav-cart">
                  <NavCart />
                </li>
              </ul>
            </div>
          </div>
          <!-- end row -->
        </div>
        <!-- end container -->
      </div>
      <!-- end navigation -->
    </nav>
    <!-- end navbar -->
  </header>
</template>
