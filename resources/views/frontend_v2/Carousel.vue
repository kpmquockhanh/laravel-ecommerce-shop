<template>
  <carousel v-if="items.length" :itemsToShow="numberItem" :wrapAround="wrapAround" :transition="300" ref="controller">
    <slide v-for="item in items" :key="item.id" :class="itemClass">
      <slot :item="item"></slot>
    </slide>

    <template #addons="{ slidesCount }">
      <Navigation v-if="slidesCount > 1"/>
    </template>
  </carousel>
</template>

<script>
import 'vue3-carousel/dist/carousel.css'
import {Carousel, Slide, Navigation} from 'vue3-carousel'
import Image from "../frontend/components/core/Image.vue";
import {ref} from "vue";

export default {
  name: 'CarouselComponent',
  props: {
    numberItem: {
      type: Number,
      default: 1,
    },
    items: {
      type: Array,
      required: true,
    },
    itemClass: {
      type: String,
      default: '',
    },
    wrapAround: {
      type: Boolean,
    }
  },

  components: {
    Image,
    Carousel,
    Slide,
    Navigation,
  },
  setup() {
    const controller = ref(null)
    const slideTo = (index) => {
      controller.value.slideTo(index)
    }
    return {
      controller,
      slideTo,
    }
  },
}
</script>
