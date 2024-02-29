<template>
  <aside class="col-md-3 sidebar left-sidebar">
    <!-- Categories -->
    <div class="widget categories">
      <h3 class="widget-title heading uppercase relative bottom-line full-grey">
        {{ $t('categories') }}
      </h3>
      <ul class="list-dividers">
        <li
          v-for="category in categories"
          :class="{ 'active-cat': category.id === currentCategory }"
        >
          <a href="#" @click.prevent="onClickCategory(category)">{{
            category.name
          }}</a
          ><span>({{ countCategories[`category-${category.id}`] || 0 }})</span>
        </li>
      </ul>
    </div>

    <!--    <FilterByPrice/>-->

    <!-- Color -->
    <!--    <FilterColor/>-->

    <!-- Size -->
    <!--    <FilterSize/>-->

    <!-- Best Sellers -->
    <!--    <BestSeller/>-->

    <!-- Tags -->
    <div class="widget tags clearfix">
      <h3 class="widget-title heading uppercase relative bottom-line full-grey">
        {{ $t('tags') }}
      </h3>
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
import FilterColor from './FilterColor.vue'
import FilterSize from './FilterSize.vue'
import BestSeller from './BestSeller.vue'
import { useCategory } from '../../js/composables/category'

export default {
  name: 'LeftSidebar',
  components: { BestSeller, FilterSize, FilterColor },
  props: {},
  setup() {
    const { currentCategory, categories, countCategories, onClickCategory } =
      useCategory()
    return {
      currentCategory,
      categories,
      countCategories,
      onClickCategory,
    }
  },
}
</script>
