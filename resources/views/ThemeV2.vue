<template>
  <!-- Preloader -->
<!--  <Loader/>-->
  <main class="main-wrapper">
    <HeaderV2Type1/>
    <PageTitle/>
    <div class="content-wrapper oh">
      <router-view/>
    </div>
  </main>
</template>
<script>
import HeaderV2Type1 from "./frontend_v2/HeaderV2Type1.vue";
import PageTitle from "./PageTitle.vue";
import Loader from "./frontend_v2/Loader.vue";

export default {
  name: 'ThemeV2',
  components: {Loader, PageTitle, HeaderV2Type1}
}
</script>
