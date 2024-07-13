<template>
  <aside class="col-md-3 sidebar">

    <div class="widget search">
      <form class="relative">
        <input type="search" class="searchbox mb-0" placeholder="Search">
        <button type="submit" class="search-button"><i class="fa fa-search"></i></button>
      </form>
    </div>

    <!-- Categories -->
    <div class="widget categories">
      <h3 class="widget-title heading relative bottom-line full-grey">Categories</h3>
      <ul class="list-dividers">
        <li>
          <a href="#">Women</a>
        </li>
        <li>
          <a href="#">Men</a>
        </li>
        <li>
          <a href="#">Accessories</a>
        </li>
        <li>
          <a href="#">Bags</a>
        </li>
        <li>
          <a href="#">Watches</a>
        </li>
      </ul>
    </div>

    <!-- Recent posts -->
    <div class="widget recent-posts">
      <h3 class="widget-title heading relative bottom-line full-grey">Recent Posts</h3>
      <div class="entry-list">
        <ul class="posts-list">
          <li class="entry-li">
            <article class="post-small clearfix">
              <div class="entry-img">
                <a href="blog-single.html">
                  <img src="@assets/v2/img/blog/latest_posts_1.jpg" alt="">
                </a>
              </div>
              <div class="entry">
                <h3 class="entry-title"><a href="blog-single.html">6 Ways to Be More Productive</a></h3>
                <ul class="entry-meta list-inline">
                  <li class="entry-date">
                    <i class="fa fa-calendar-o"></i>
                    19 Mar, 2016
                  </li>
                </ul>
              </div>
            </article>
          </li>
          <li class="entry-li">
            <article class="post-small clearfix">
              <div class="entry-img">
                <a href="blog-single.html">
                  <img src="@assets/v2/img/blog/latest_posts_2.jpg" alt="">
                </a>
              </div>
              <div class="entry">
                <h3 class="entry-title"><a href="blog-single.html">3 Tips to Align Your Startup</a></h3>
                <ul class="entry-meta list-inline">
                  <li class="entry-date">
                    <i class="fa fa-calendar-o"></i>
                    16 Mar, 2016
                  </li>
                </ul>
              </div>
            </article>
          </li>
          <li class="entry-li">
            <article class="post-small clearfix">
              <div class="entry-img">
                <a href="blog-single.html">
                  <img src="@assets/v2/img/blog/latest_posts_3.jpg" alt="">
                </a>
              </div>
              <div class="entry">
                <h3 class="entry-title"><a href="blog-single.html">Make more money blogging with these 6 tips</a>
                </h3>
                <ul class="entry-meta list-inline">
                  <li class="entry-date">
                    <i class="fa fa-calendar-o"></i>
                    16 Mar, 2016
                  </li>
                </ul>
              </div>
            </article>
          </li>
        </ul>
      </div>
    </div>

    <!-- Tags -->
    <div class="widget tags light clearfix">
      <h3 class="widget-title heading relative bottom-line full-grey">Tags</h3>
      <a href="#">Multi-purpose</a>
      <a href="#">Creative</a>
      <a href="#">Elegant</a>
      <a href="#">Clean</a>
      <a href="#">Modern</a>
      <a href="#">Responsive</a>
      <a href="#">E-commerce</a>
      <a href="#">WordPress</a>
      <a href="#">Woocommerce</a>
      <a href="#">Store</a>
      <a href="#">Business</a>
    </div>

  </aside>
</template>
<script>
export default {
  name: "SidebarPost"
};
</script>
