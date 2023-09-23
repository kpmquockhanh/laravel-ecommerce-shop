<template>
  <div class="pagination-wrap">
    <p class="result-count">Showing: 12 of 80 results</p>
    <nav class="pagination right clearfix">

      <a href="#"><i class="fa fa-angle-left"></i></a>
      <template v-for="n in pageNumber">
        <span v-if="currentPage === n" class="page-numbers current">{{ n }}</span>
        <a
            v-else
            href="#"
            @click="onChangePage(n)">{{ n }}</a>
      </template>

      <a href="#"><i class="fa fa-angle-right"></i></a>
    </nav>
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
