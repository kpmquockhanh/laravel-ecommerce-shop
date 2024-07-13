<script>
export default {
  name: "StandardPost",
  props: {
    item: Object,
  },
  setup() {
    return {}
  },
};
</script>


<template>
  <article class="entry-item">
    <div class="entry-img">
      <router-link :to="{
        name: 'post_single',
        params: {
          slug: 'test'
        }
      }" class="hover-scale">
        <img src="@assets/v2/img/blog/post_img_1.jpg" alt="">
      </router-link>
    </div>

    <div class="entry-wrap">
      <div class="entry">
        <h2 class="entry-title">
          <router-link :to="{
            name: 'post_single',
            params: {
              slug: item.id
            }
          }">
            {{ item.title }}
          </router-link>
        </h2>
        <ul class="entry-meta">
          <li class="entry-date">
            <i class="fa fa-calendar-o"></i>
            {{ item.created_at }}
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
              slug: item.id
            }
          }" class="btn btn-lg btn-stroke">
            <span>Read More</span>
          </router-link>
        </div>
      </div>
    </div>
  </article>
</template>
