<template>
    <div>
        <Slider/>
        <Choices/>
        <ProductTrend/>
        <Brands/>
    </div>
</template>
<script>
import Subscribe from "./components/Subscribe.vue";
import Footer from "./components/Footer.vue";
import Brands from "./components/Brands.vue";
import Slider from "./components/Slider.vue";
import Choices from "./components/Choices.vue";
import ProductTrend from "./components/ProductTrends.vue";

export default {
    components: {ProductTrend, Choices, Slider, Brands, Footer, Subscribe},
    setup() {
        return {
        }
    }
}
</script>
