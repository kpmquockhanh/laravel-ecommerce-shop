<script>
import { nextTick, onMounted, ref } from "vue";
import BlogList from "./BlogList.vue";

export default {
  name: "CataloguePage",
  components: { BlogList },
  props: {},
  setup() {
    const owl_hero = ref();
    const initOwlCarousel= () => {
      /* Hero Slider
         -------------------------------------------------------*/
      // eslint-disable-next-line no-undef
      $(owl_hero.value).owlCarousel({
        autoPlay: 3000,
        navigation: true,
        navigationText: ["<i class='ui-left-arrow'></i>", "<i class='ui-right-arrow'></i>"],
        slideSpeed: 300,
        pagination: true,
        paginationSpeed: 400,
        singleItem: true,
        stopOnHover: true,
        addClassActive: true
      })
    };

    onMounted(() => {
      nextTick(() => {
        initOwlCarousel();
      })
    })
    return {
      owl_hero,
    };
  }
};
</script>

<template>
  <section class="section-wrap pt-80 pb-40 catalogue">
    <div class="container relative">
      <!-- Hero Slider -->
      <section class="hero-wrap text-center relative">
        <div id="owl-hero" ref="owl_hero" class="owl-carousel owl-theme light-arrows slider-animated">
          <div class="hero-slide overlay b1">
            <div class="container">
              <div class="hero-holder">
                <div class="hero-message">
                  <h1 class="hero-title nocaps">Great Fashion 2017</h1>
                  <h2 class="hero-subtitle lines">New Arrivals Collection</h2>
                  <div class="buttons-holder">
                    <a href="#" class="btn btn-lg btn-transparent"><span>Shop Now</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hero-slide overlay b2">
            <div class="container">
              <div class="hero-holder">
                <div class="hero-message">
                  <h1 class="hero-title nocaps">Exclusive Products</h1>
                  <h2 class="hero-subtitle lines">Get awesome items only in Zenna online shop</h2>
                  <div class="buttons-holder">
                    <a href="#" class="btn btn-lg btn-color"><span>Buy it Now</span></a>
                    <a href="#" class="btn btn-lg btn-transparent"><span>Learn More</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hero-slide overlay b3">
            <div class="container">
              <div class="hero-holder">
                <div class="hero-message">
                  <h1 class="hero-title nocaps">Enjoy Online Shopping</h1>
                  <h2 class="hero-subtitle lines">Zenna is perfectly responsive theme</h2>
                  <div class="buttons-holder">
                    <a href="#" class="btn btn-lg btn-transparent"><span>Shop Now</span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> <!-- end hero slider -->

      <BlogList />
    </div>
  </section>
</template>

<style lang="scss">
</style>
