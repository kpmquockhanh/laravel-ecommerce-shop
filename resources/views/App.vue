<template>
    <div>
        <WatchHeader/>
        <router-view/>
        <Subscribe/>
        <Footer/>
    </div>
</template>
<script>
import Subscribe from "./watch/components/Subscribe.vue";
import Footer from "./watch/components/Footer.vue";
import WatchHeader from "./watch/components/Header.vue";

export default {
    components: {WatchHeader, Footer, Subscribe},
    setup() {}
}
</script>
