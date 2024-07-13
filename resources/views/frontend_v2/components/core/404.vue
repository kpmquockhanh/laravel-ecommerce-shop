<template>
  <section class="page_404">
    <div class="container">
      <div class="text-center">
        <div class="four_zero_four_bg">
          <h1 class="text-center">404</h1>
        </div>
        <div class="contant_box_404">
          <h3 class="h2">{{ $t("404_1")}}</h3>
          <p>{{ $t("404_2")}}</p>
          <a
            href="#"
            class="btn btn-lg btn-dark"
            @click.prevent="$router.push({ name: 'home' })"
            ><span>{{ $t('home') }}</span></a
          >
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  name: 'NotFound',
  setup() {
    return {}
  },
}
</script>
