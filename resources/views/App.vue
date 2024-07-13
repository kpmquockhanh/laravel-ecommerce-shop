<template>
  <!--  <Loader/>-->
  <main class="main-wrapper">
    <HeaderPage />
    <Breadcrumb v-if="currentRouteName !== '404'" />
    <div class="content-wrapper oh">
      <router-view />
    </div>
  </main>
</template>
<script>
import HeaderPage from "./frontend_v2/components/Header.vue";
import { useRoute } from "vue-router";
import { computed } from "vue";
import Breadcrumb from "./frontend_v2/components/core/Breadcrumb.vue";

export default {
  components: {
    Breadcrumb,
    HeaderPage,
  },
  setup() {
    const route = useRoute();
    const currentRouteName = computed(() => route.name);
    return { currentRouteName };
  }
};
</script>
