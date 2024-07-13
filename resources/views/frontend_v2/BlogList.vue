<script setup>

import { onMounted } from "vue";
import StandardPost from "./StandardPost.vue";
import SidebarPost from "./SidebarPost.vue";
import { usePost } from "../../js/composables/post";
import GalleryPost from "./GalleryPost.vue";

const uP = usePost();

onMounted(() => {
  // eslint-disable-next-line no-undef
  $("#flexslider").flexslider({
    animation: "slide",
    controlNav: false,
    directionNav: true,
    touch: true,
    slideshow: false,
    prevText: ["<i class='ui-left-arrow'></i>"],
    nextText: ["<i class='ui-right-arrow'></i>"]
  });
  uP.fetchPosts();
});
</script>

<template>
  <section class="section-wrap blog-standard pb-50">
    <div class="container relative">
      <div class="row">

        <!-- content -->
        <div class="col-md-9 post-content mb-50">
          <div>{{ uP.posts.value.length }}</div>
          <!-- standard post -->
          <template v-if="uP.posts.value.length">
            <StandardPost v-for="post in uP.posts.value" :item="post" :key="post.id" /> <!-- end standard post -->
          </template>

          <!-- gallery post -->
          <GalleryPost /> <!-- end gallery post -->

          <!-- video post -->
          <!--          <VideoPost /> &lt;!&ndash; end video post &ndash;&gt;-->

          <!-- blockquote post -->
          <!--          <BlogQuotePost /> &lt;!&ndash; end blockquote post &ndash;&gt;-->


          <!-- Pagination -->
          <nav class="pagination">
            <span class="page-numbers current">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#"><i class="fa fa-angle-right"></i></a>
          </nav>

        </div> <!-- end col -->

        <!-- Sidebar -->
        <SidebarPost /> <!-- end sidebar -->

      </div> <!-- end row -->
    </div> <!-- end container -->
  </section>
</template>

