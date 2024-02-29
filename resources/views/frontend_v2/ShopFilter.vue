<template>
  <div class="shop-filter">
    <div class="view-mode hidden-xs">
      <span>{{ $t('view') }}:</span>
      <a
        class="grid"
        id="grid"
        :class="{ 'grid-active': layout === 'grid' }"
        @click.prevent="setLayout('grid')"
      ></a>
      <a
        class="list"
        :class="{ 'list-active': layout === 'list' }"
        id="list"
        @click.prevent="setLayout('list')"
      ></a>
    </div>
    <!--    <div class="filter-show hidden-xs">-->
    <!--      <span>Show:</span>-->
    <!--      <a href="#" class="active">12</a>-->
    <!--      <a href="#">24</a>-->
    <!--      <a href="#">all</a>-->
    <!--    </div>-->
    <form class="ecommerce-ordering">
      <select @change="onChange">
        <option
          :value="item.value"
          v-for="item in dropdownData"
          :selected="item.is_default"
        >
          {{ item.label }}
        </option>
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
import { useLayout } from '../../js/composables/layout'
import { useI18n } from 'vue-i18n-lite'
import { ref } from 'vue'

export default {
  name: 'ShopFilter',
  setup(props, { emit }) {
    const { layout, setLayout } = useLayout()
    const { t } = useI18n()

    const dropdownData = [
      {
        value: 'desc',
        label: t('newest'),
        is_default: true,
      },
      {
        value: 'asc',
        label: t('oldest'),
      },
    ]

    const sortBy = ref(dropdownData.find((i) => i.is_default).value)

    const onChange = (e) => {
      sortBy.value = e.target.value
    }
    return { layout, setLayout, dropdownData, sortBy, onChange }
  },
}
</script>
