<script setup>

import { onMounted } from "vue";
import StandardPost from "./StandardPost.vue";
import SidebarPost from "./SidebarPost.vue";
import { usePost } from "../../js/composables/post";
import CardSkeleton from './components/core/CardSkeleton.vue'
import PostSkeleton from './components/core/PostSkeleton.vue'

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
          <transition-group name="list" tag="div" class="row">
            <PostSkeleton v-if="uP.isLoadingPosts.value" :number-item="1" class="px-5" />
            <!-- standard post -->
            <template v-else-if="uP.posts.value.length">
              <StandardPost v-for="post in uP.posts.value" :item="post" :key="post.id" /> <!-- end standard post -->

              <!-- Pagination -->
              <nav class="pagination" v-if="uP.paginationPages.value.length > 1">
                <a href="#" v-if="uP.pagination.value?.links[0].url" @click.prevent="uP.changePage(uP.page.value - 1)"><i class="fa fa-angle-left"></i></a>
                <a href="#" :class="{'current': p === uP.pagination.value?.current_page}" v-for="p in uP.paginationPages.value" :key="p" @click.prevent="uP.changePage(p)">{{ p }}</a>
                <a href="#" v-if="uP.pagination.value?.links[uP.pagination.value?.links.length - 1].url" @click.prevent="uP.changePage(uP.page.value + 1)"><i class="fa fa-angle-right"></i></a>
              </nav>
            </template>
          </transition-group>


          <!-- gallery post -->
<!--          <GalleryPost /> &lt;!&ndash; end gallery post &ndash;&gt;-->

          <!-- video post -->
          <!--          <VideoPost /> &lt;!&ndash; end video post &ndash;&gt;-->

          <!-- blockquote post -->
          <!--          <BlogQuotePost /> &lt;!&ndash; end blockquote post &ndash;&gt;-->

        </div> <!-- end col -->

        <!-- Sidebar -->
        <SidebarPost /> <!-- end sidebar -->

      </div> <!-- end row -->
    </div> <!-- end container -->
  </section>
</template>

