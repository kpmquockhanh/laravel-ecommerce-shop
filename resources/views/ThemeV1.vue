<template>
  <Header/>
  <router-view/>
  <Subscribe/>
  <Footer/>
</template>
<script>
import Footer from "./frontend/components/Footer.vue"
import Header from "./frontend/components/Header.vue"
import Subscribe from "./frontend/components/Subscribe.vue"

export default {
  name: 'ThemeV1',
  components: {
    Footer,
    Header,
    Subscribe
  }
}
</script>
