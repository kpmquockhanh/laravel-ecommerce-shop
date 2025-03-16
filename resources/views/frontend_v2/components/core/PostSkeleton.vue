<template>
  <div class="">
    <div class="product-col" v-for="i in numberItem" :key="i">
      <div class="card m-1">
        <div class="card__img skeleton" :style="{
          height: height + 'px'
        }"></div>
        <div class="card__body">
          <div class="card__text skeleton"></div>
          <div class="card__text skeleton"></div>
          <div class="card__text skeleton"></div>
          <div class="card__text skeleton"></div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'PostSkeleton',
  props: {
    numberItem: {
      type: Number,
      default: 4,
    },
    height: {
      type: Number,
      default: 200,
    }
  },
}
</script>
