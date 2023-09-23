import {computed, nextTick, onMounted, ref, watch} from 'vue'
import {doGet} from "../http";
import get from "lodash/get";
import {useRoute, useRouter} from "vue-router";
import {useCategory} from "./category";

// global state, created in module scope

export function useProduct() {
    const route = useRoute()
    const router = useRouter()
    const isLoadingProducts = ref(false)
    const querySort = computed(() => {
        return route.query.sort || ''
    })
    const products = ref([])
    const productMeta = ref({})

    const { currentCategory,  } = useCategory()
    const currentPage = ref(1)
    const perPage = 20
    const total = computed(() => {
        return get(productMeta.value, 'total', 0)
    })
    watch([currentCategory, querySort], () => {
        currentPage.value = 1
        nextTick(() => {
            fetchProducts().then()
        }).then()
    })
    watch(currentPage, () => {
        nextTick(() => {
            fetchProducts().then()
        }).then()
    })
    const onChangeSort = (item) => {
        router.push({query: {sort: item.value}})
    }
    // const querySort = computed(() => {
    //     return route.query.sort || ''
    // })

    const scrollToTop = () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
    const fetchProducts = async (target = '') => {
        if (isLoadingProducts.value) {
            return
        }
        isLoadingProducts.value = true
        const queryObj = {
            sort: querySort.value,
            category: currentCategory.value,
            page: currentPage.value,
            limit: perPage,
        }

        const result = await doGet('/api/products', queryObj)
        products.value = get(result, 'data', [])
        productMeta.value = get(result, 'meta', {})
        isLoadingProducts.value = false
        await nextTick(() => {
            scrollToTop()
        })
    }
    // Watch product change
    watch(products, (val) => {
        nextTick(() => {
            const $isotopeGrid = $('#products-grid');
            $isotopeGrid.imagesLoaded(function () {
                $isotopeGrid.isotope({
                    isOriginLeft: true,
                    stagger: 30
                });
                $isotopeGrid.isotope();
            });
        }).then()
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
    }
}
