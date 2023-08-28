<template>
  <div>
    <!-- PRODUCTS -->
    <div class="container mt-7">
      <div class="row no-gutters align-items-center pb-2">
        <div class="col-lg-8">
          <h5 class="font-weight-bold">Men's Watches</h5>
        </div>
        <div class="col-lg-4 d-flex justify-content-end">
          <Dropdown label="Sort by" :data="dropdownData" @change="onChangeSort"/>
        </div>
      </div>
      <hr>
    </div>
    <div class="container mt-1">
      <div class="row">
        <div class="col-lg-2"> <!-- Filter -->
          <div class="row p-3">
            <div class="col-lg-12 filter-title mb-3">Category</div>
            <Loading v-if="isLoadingCategory"/>
            <div v-else v-for="category in categories" class="col-lg-12 filter-category">
              <div class="filter d-flex align-items-center gap-2 pointer mb-2" @click="onClickCategory(category)">
                <div class="d-flex">
                  <input type="radio" :checked="currentCategory && currentCategory === category.id" name="radio">
                </div>
                <div class="checkmark">{{ category.name }}</div>
              </div>
            </div>
          </div>
        </div>
        <!-- Filter end -->

        <div class="col-lg-10">
          <card-skeleton v-if="isLoadingProducts"/>
          <div v-else class="row mt-5">
            <div v-for="product in products" class="col-lg-3 col-md-6 col-sm-6 col-6 product-col">
              <Product :product="product"/>
            </div>
            <Pagination :total="total" :per-page="perPage" v-model:current-page="currentPage"/>
          </div>
        </div>
      </div>
    </div>
    <!-- PRODUCTS END -->
  </div>
</template>
<script>
import {useRoute, useRouter} from "vue-router";
import ProductTrend from "./components/ProductTrends.vue";
import {computed, nextTick, onMounted, ref, watch} from "vue";
import get from "lodash/get";
import Image from "./components/core/Image.vue";
import Product from "./components/Product.vue";
import Loading from "./components/core/Loading.vue";
import Dropdown from "./components/core/Dropdown.vue";
import {buildQueryParams} from "../../js/utils";
import Pagination from "./components/core/Pagination.vue";
import {doGet} from "../../js/http";
import CardSkeleton from "./components/core/CardSkeleton.vue";

export default {
  name: "ProductList",
  components: {CardSkeleton, Pagination, Dropdown, Loading, Product, Image},
  setup() {
    const route = useRoute()
    const router = useRouter()

    const products = ref([])
    const productMeta = ref({})
    const categories = ref([])
    const currentCategory = ref(0)
    const isLoadingCategory = ref(true)
    const isLoadingProducts = ref(false)

    // Pagination
    const currentPage = ref(1)
    const perPage = 20
    const total = computed(() => {
      return get(productMeta.value, 'total', 0)
    })


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

    const queryCategory = computed(() => {
      return route.query.category || ''
    })

    const querySort = computed(() => {
      return route.query.sort || ''
    })

    const fetchProducts = async (target = '') => {
      if (isLoadingProducts.value) {
        return
      }
      scrollToTop()
      isLoadingProducts.value = true
      const queryObj = {
        sort: querySort.value,
        category: currentCategory.value,
        page: currentPage.value,
        limit: perPage,
      }
      console.log('payload', queryObj, target);
      const result = await doGet('/api/products', queryObj)
      products.value = get(result, 'data', [])
      productMeta.value = get(result, 'meta', {})
      isLoadingProducts.value = false
    }


    onMounted(() => {
      if (queryCategory.value) {
        currentCategory.value = parseInt(queryCategory.value)
      }

      fetchProducts()
      fetchCategories().then(() => {
        isLoadingCategory.value = false
      })
    })
    const fetchCategories = async () => {
      const resp = await doGet('/api/categories')
      categories.value = get(resp, 'data', [])
    }

    const onClickCategory = (category) => {
      if (currentCategory.value === category.id) {
        currentCategory.value = 0
        router.push({query: {}})
        return
      }
      currentCategory.value = category.id
      router.push({query: {category: category.id}})
    }

    watch([currentCategory, querySort], () => {
      currentPage.value = 1
      nextTick(() => {
        fetchProducts('watch')
      })
    })
    watch(currentPage, () => {
      console.log('category', currentCategory.value)
      nextTick(() => {
        fetchProducts('watch 2')
      })
    })

    watch(queryCategory, (val) => {
      if (!val) {
        return
      }
      currentCategory.value = parseInt(queryCategory.value)
    })

    const onChangeSort = (item) => {
      router.push({query: {sort: item.value}})
    }

    const scrollToTop = () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    }

    return {
      products,
      categories,
      currentCategory,
      onClickCategory,
      isLoadingProducts,
      isLoadingCategory,
      dropdownData,
      onChangeSort,
      productMeta,
      currentPage,
      total,
      perPage,
    }
  },
}

</script>

<style scoped>

</style>
