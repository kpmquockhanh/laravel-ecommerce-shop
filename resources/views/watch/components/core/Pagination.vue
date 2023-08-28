<template>
  <div class="pagination-wrapper">
    <ul class="pagination">
      <li v-for="n in pageNumber" :class="{active: currentPage === n}" role="presentation" @click="onChangePage(n)">
        <button></button>
      </li>
    </ul>
  </div>
</template>
<script>
import {computed} from "vue";

export default {
  name: 'Pagination',
  props: {
    total: {
      type: Number,
      required: true,
    },
    perPage: {
      type: Number,
      required: true,
    },
    currentPage: {
      type: Number,
      required: true,
    },
  },
  emits: ['update:currentPage'],
  setup(props, {emit}) {
    const pageNumber = computed(() => {
      return Math.ceil(props.total / props.perPage)
    })
    const onChangePage = (page) => {
      emit('update:currentPage', page)
    }
    return {
      pageNumber,
      onChangePage,
    }
  }
}
</script>
