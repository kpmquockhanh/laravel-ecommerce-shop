<template>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-6 product-col" v-for="i in numberItem" :key="i">
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
  name: 'CardSkeleton',
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
