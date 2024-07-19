<template>
  <carousel
    v-if="items.length"
    :itemsToShow="numberItem"
    :items-to-scroll="itemScroll"
    :wrapAround="wrapAround"
    :transition="500"
    :breakpoints="breakpoints"
    :touch-drag="true"
    ref="controller"
  >
    <slide v-for="item in items" :key="item.id" :class="itemClass">
      <div class="carousel__item">
        <slot :item="item"></slot>
      </div>
    </slide>

    <template #addons="{ slidesCount }">
      <Navigation v-if="slidesCount > 1" />
    </template>
  </carousel>
</template>

<script>
import "vue3-carousel/dist/carousel.css";
import { Carousel, Navigation, Slide } from "vue3-carousel";
import { ref } from "vue";

export default {
  name: "CarouselComponent",
  props: {
    numberItem: {
      type: Number,
      default: 1
    },
    itemScroll: {
      type: Number,
      default: 1
    },
    items: {
      type: Array,
      required: true
    },
    itemClass: {
      type: String,
      default: ""
    },
    wrapAround: {
      type: Boolean,
      default: true,
    },
    breakpoints: {
      type: Object,
      default: () => ({})
    }
  },

  components: {
    Carousel,
    Slide,
    Navigation
  },
  setup() {
    const controller = ref(null);
    const slideTo = (index) => {
      controller.value.slideTo(index);
    };
    return {
      controller,
      slideTo
    };
  }
};
</script>

<style>
.carousel__slide {
  padding: 0;
  margin-right: 0 !important;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  margin: 0;
}
</style>
