<template>
    <div>
        <img v-show="!isLoading && !isError" :class="[imgClass, {'rounded': rounded}]" :src="src" :alt="alt" @load="onLoaded" @error="onError">
        <div v-if="isLoading" class="loading-image">
            <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
        </div>
        <div v-if="isError" class="loading-image">Error image</div>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
  name: "Image",
  props: {
    src: {
      type: String,
      default: '',
    },
    alt: {
      type: String,
      default: ''
    },
    imgClass: {
      type: String,
      default: ''
    },
    rounded: {
      type: Boolean,
      default: false
    }
  },
  setup(props) {
    const isLoading = ref(true)
    const isError = ref(!props.src)
    const onLoaded = () => {
      isLoading.value = false
    }
    const onError = () => {
      isLoading.value = false
      isError.value = true
    }
    return {
      onLoaded,
      isLoading,
      isError,
      onError,
    }
  }
}
</script>
