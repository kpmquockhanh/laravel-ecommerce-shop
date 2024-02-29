import { computed, nextTick, ref, watch } from 'vue'
import { doGet } from '../http'
import get from 'lodash/get'
import { useRoute, useRouter } from 'vue-router'
import { useCategory } from './category'
import debounce from 'lodash/debounce'

// global state, created in module scope
const isLoadingProducts = ref(false)
const products = ref([])
const productMeta = ref({})
const product = ref({})

export function useProduct() {
  const route = useRoute()
  const router = useRouter()

  const querySort = computed(() => {
    return route.query.sort || ''
  })

  const querySearch = computed(() => {
    return route.query.q || ''
  })

  const { currentCategory } = useCategory()
  const currentPage = ref(1)
  const perPage = 20
  const total = computed(() => {
    return get(productMeta.value, 'total', 0)
  })
  watch(currentCategory, () => {
    currentPage.value = 1
    nextTick(() => {
      fetchProducts('w1').then()
    }).then()
  })
  watch(currentPage, () => {
    nextTick(() => {
      fetchProducts('w2').then()
    }).then()
  })

  watch(querySearch, async () => {
    currentCategory.value = 0
    nextTick(() => {
      fetchProducts('wsearch').then()
    }).then()
  })
  const onChangeSort = (item) => {
    router.push({ query: { sort: item.value } })
  }
  // const querySort = computed(() => {
  //     return route.query.sort || ''
  // })

  const scrollToTop = () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth',
    })
  }
  const fetchProducts = async () => {
    if (isLoadingProducts.value) {
      return
    }
    isLoadingProducts.value = true
    const queryObj = {
      sort: querySort.value,
      category: currentCategory.value,
      page: currentPage.value,
      limit: perPage,
      q: querySearch.value,
    }
    const result = await doGet('/api/products', queryObj)
    products.value = get(result, 'data', [])
    productMeta.value = get(result, 'meta', {})
    isLoadingProducts.value = false
    await nextTick(() => {
      if (currentCategory.value) {
        router.push({
          query: { ...route.query, category: currentCategory.value },
        })
      } else {
        router.push({ query: { ...route.query } })
      }
      scrollToTop()
    })
  }

  const fetchProduct = async (target) => {
    if (!slug.value) {
      return
    }

    console.log('fetch product', target, slug.value)
    const resp = await doGet(`/api/products/${slug.value}`)
    if (resp.error && resp.status === 404) {
      await router.push({ name: '404' })
      return
    }
    product.value = get(resp, 'data', {})
    scrollToTop()
  }

  // Watch product change
  watch(products, () => {
    nextTick(() => {
      const $isotopeGrid = $('#products-grid')
      $isotopeGrid.imagesLoaded(function () {
        $isotopeGrid.isotope({
          isOriginLeft: true,
          stagger: 30,
        })
        $isotopeGrid.isotope()
      })
    }).then()
  })
  const slug = computed(() => route.params.slug)
  watch(slug, (val, oldVal) => {
    if (!oldVal || val === oldVal) {
      return
    }
    fetchProduct('watch').then()
  })
  return {
    products,
    productMeta,
    fetchProducts,
    currentPage,
    perPage,
    total,
    isLoadingProducts,
    onChangeSort,
    querySort,
    product,
    fetchProduct,
    slug,
    querySearch,
  }
}
