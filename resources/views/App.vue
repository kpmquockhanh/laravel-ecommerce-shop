<template>
  <!--  <Loader/>-->
  <main class="main-wrapper">
    <Header />
    <Breadcrumb v-if="currentRouteName !== '404'" />
    <div class="content-wrapper oh">
      <router-view />
    </div>
  </main>
</template>
<script>
import Header from './frontend_v2/Header.vue'
import Loader from './frontend_v2/Loader.vue'
import { useRoute } from 'vue-router'
import { computed } from 'vue'
import Breadcrumb from './frontend_v2/Breadcrumb.vue'

export default {
  components: {
    Breadcrumb,
    Loader,
    Header,
  },
  setup() {
    const route = useRoute()
    const currentRouteName = computed(() => route.name)
    return { currentRouteName }
  },
}
</script>
