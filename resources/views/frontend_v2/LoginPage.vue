<template>
  <section class="page_404">
    <div class="container">
      <div class="text-center">
        <div class="">
          <h1 class="text-center">Login</h1>
        </div>
        <div class="">
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
