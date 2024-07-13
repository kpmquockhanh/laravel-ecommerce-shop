<template>
  <article class="entry-item">
    <div class="entry-slider">
      <div class="flexslider dots-inside" id="flexslider">

        <div class="flex-viewport" style="overflow: hidden; position: relative;">
          <ul class="slides clearfix"
              style="width: 1000%; transition-duration: 0s; transform: translate3d(-681px, 0px, 0px);">
            <li class="clone" aria-hidden="true"
                style="width: 681px; margin-right: 0px; float: left; display: block;">
              <a href="#">
                <img src="@assets/v2/img/blog/gallery_post_img_3.jpg" alt="" draggable="false">
              </a>
            </li>
            <li style="width: 681px; margin-right: 0px; float: left; display: block;" class="flex-active-slide"
                data-thumb-alt="">
              <a href="#">
                <img src="@assets/v2/img/blog/gallery_post_img_1.jpg" alt="" draggable="false">
              </a>
            </li>
            <li data-thumb-alt="" style="width: 681px; margin-right: 0px; float: left; display: block;">
              <a href="#">
                <img src="@assets/v2/img/blog/gallery_post_img_2.jpg" alt="" draggable="false">
              </a>
            </li>
            <li data-thumb-alt="" style="width: 681px; margin-right: 0px; float: left; display: block;">
              <a href="#">
                <img src="@assets/v2/img/blog/gallery_post_img_3.jpg" alt="" draggable="false">
              </a>
            </li>
            <li style="width: 681px; margin-right: 0px; float: left; display: block;" class="clone"
                aria-hidden="true">
              <a href="#">
                <img src="@assets/v2/img/blog/gallery_post_img_1.jpg" alt="" draggable="false">
              </a>
            </li>
          </ul>
        </div>
        <ol class="flex-control-nav flex-control-paging">
          <li><a href="#" class="flex-active">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
        </ol>
      </div>
    </div> <!-- end slider -->

    <div class="entry-wrap">
      <div class="entry">
        <h2 class="entry-title">
          <router-link :to="{
                    name: 'post_single',
                    params: {
                      slug: 'test'
                    }
                  }">
            Need a Business Idea? Here are 55.
          </router-link>
        </h2>
        <ul class="entry-meta">
          <li class="entry-date">
            <i class="fa fa-calendar-o"></i>
            19 September, 2016
          </li>
          <li class="entry-author">
            <i class="fa fa-user"></i>
            <a href="#">Admin</a>
          </li>
          <li class="entry-category">
            <i class="fa fa-bookmark"></i>
            <a href="#">Fashion</a>
          </li>
          <li class="entry-comments">
            <i class="fa fa-comments"></i>
            <a href="blog-single.html">15 Comments</a>
          </li>
        </ul>
        <div class="entry-content">
          <p>We possess within us two minds. So far I have written only of the conscious mind. This Theme is the
            Best theme on ThemeForest. So far I have written only of the conscious mind. I would now like to
            introduce you to your second mind, the hidden and mysterious subconscious. Our subconscious mind
            contains such power.</p>
          <router-link :to="{
                    name: 'post_single',
                    params: {
                      slug: 'test'
                    }
                  }" class="btn btn-lg btn-stroke">
            <span>Read More</span>
          </router-link>
        </div>
      </div>
    </div>
  </article>
</template>
<script>
export default {
  name: "GalleryPost"
};
</script>
