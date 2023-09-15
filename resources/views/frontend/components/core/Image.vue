<template>
    <div>
        <img v-show="!isLoading" :class="[imgClass, {'rounded': rounded}]" :src="src" class="w-100" :alt="alt" @load="onLoaded">
        <div v-if="isLoading">
            <div class="d-flex justify-content-center align-items-center" style="height: 225px;font-size: 14px">
                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";

export default {
    name: "Image",
    props: {
        src: {
            type: String,
            required: true
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
        const onLoaded = () => {
            isLoading.value = false
        }
        return {
            onLoaded,
            isLoading,
        }
    }
}
</script>
