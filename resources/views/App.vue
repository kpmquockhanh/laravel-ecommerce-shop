<template>
  <template v-if="isV2">
    <ThemeV2/>
  </template>
  <template v-else>
    <ThemeV1/>
  </template>
</template>
<script>
import {computed, defineAsyncComponent} from "vue";

export default {
  components: {
    ThemeV2: defineAsyncComponent(() =>
        import('./ThemeV2.vue')
    ),
    ThemeV1: defineAsyncComponent(() =>
      import('./ThemeV1.vue')
    ),
  },
  setup() {
    const isV2 = computed(() => {
      return window.location.pathname.includes('v2')
    })

    return {
      isV2,
    }
  }
}
</script>
