<template>
  <section v-if="items.length" class="page-title text-center bg-light">
    <div class="container relative clearfix">
      <div class="title-holder">
        <div class="title-text">
          <h1 class="uppercase">catalog</h1>
          <ol class="breadcrumb">
<!--            <li>-->
<!--              <a href="#" @click.prevent="routeToHome">Home</a>-->
<!--            </li>-->
            <li v-for="(item, index) in items" :class="{active: index === items.length - 1}">
              <a href="#" @click.prevent="routeTo({name: item.name})">{{ item.label }}</a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import {useRoute, useRouter} from "vue-router";
import {computed} from "vue";
import get from "lodash/get";
import {useProduct} from "../../js/composables/product";
export default {
  name: 'Breadcrumb',
  setup() {
    const route = useRoute()
    const router = useRouter()
    const {product} = useProduct()
    const items = computed(() => {
      const matched = get(route.matched, '[0]', {})
      switch (matched.name) {
        case 'product-detail':
          return [
            {
              name: 'home',
              label: 'Home'
            },
            {
              name: 'product-detail',
              label: product.value?.title
            }
          ]
      }
      return []
    })
    const routeToHome = () => {
      router.push({
        name: 'home',
      })
    };
    const routeTo = (r) => {
      const {name, query} = r
      router.push({
        name,
        query: query || {},
      })
    };
    return {
      items,
      routeToHome,
      routeTo,
    }
  },
}
</script>
