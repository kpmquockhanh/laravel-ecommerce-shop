<template>
    <!-- CHOICE  -->
    <div class="container mt-4 choice">
        <div class="row no-gutters">
            <div class="col-lg-4 col-md-4 col-sm-12 d-flex justify-content-center" v-for="category in categories">
                <div class="card img-fluid w-100 p-1">
                    <Image src="/img/image_placeholder.jpg" rounded />
                    <div class="mt-2">
                        <button type="button" class="btn choice-buton container">
                            <a href="mens-watches.html">{{ category.name }}</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CHOICE END -->
</template>

<script>
import {ref} from "vue";
import get from "lodash/get";
import Image from "./core/Image.vue";
import {doGet} from "../../../js/http";

export default {
    name: "Choices",
    components: {Image},
    setup() {
        const categories = ref([])
        const fetchCategories = async () => {
            const resp = await doGet('/api/categories/newest')
            categories.value = get(resp, 'data', [])
        }
        fetchCategories()
        return {
            categories,
        }
    },
}
</script>

<style scoped>

</style>
