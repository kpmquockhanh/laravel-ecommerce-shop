<template>
  <section class="page_404">
    <div class="container">
      <div class="text-center">
        <div class="four_zero_four_bg">
          <h1 class="text-center">404</h1>
        </div>
        <div class="contant_box_404">
          <h3 class="h2">Look like you're lost</h3>
          <p>the page you are looking for not available!</p>
          <a
            href="#"
            class="btn btn-lg btn-dark"
            @click.prevent="$router.push({ name: 'home' })"
            ><span>Go to Home</span></a
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
