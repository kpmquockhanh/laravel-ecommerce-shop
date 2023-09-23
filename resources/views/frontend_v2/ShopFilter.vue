<template>
  <div class="shop-filter">
    <div class="view-mode hidden-xs">
      <span>View:</span>
      <a class="grid" id="grid" :class="{'grid-active': layout=== 'grid'}"  @click.prevent="setLayout('grid')"></a>
      <a class="list" :class="{'list-active': layout=== 'list'}" id="list" @click.prevent="setLayout('list')"></a>
    </div>
    <!--    <div class="filter-show hidden-xs">-->
    <!--      <span>Show:</span>-->
    <!--      <a href="#" class="active">12</a>-->
    <!--      <a href="#">24</a>-->
    <!--      <a href="#">all</a>-->
    <!--    </div>-->
    <form class="ecommerce-ordering">
      <select>
        <option value="default-sorting" v-for="item in dropdownData">{{ item.label }}</option>
<!--        <option value="price-low-to-high">Price: high to low</option>-->
<!--        <option value="price-high-to-low">Price: low to high</option>-->
<!--        <option value="by-popularity">By Popularity</option>-->
<!--        <option value="date">By Newness</option>-->
<!--        <option value="rating">By Rating</option>-->
      </select>
    </form>
  </div>
</template>
<script>

import {useLayout} from "../../js/composables/layout";

export default {
  name: 'ShopFilter',
  setup() {
    const {layout, setLayout} = useLayout()
    const dropdownData = [
      {
        value: 'desc',
        label: 'Newest',
      },
      {
        value: 'asc',
        label: 'Oldest',
      }
    ]
    return {layout, setLayout, dropdownData}


  },
}
</script>
