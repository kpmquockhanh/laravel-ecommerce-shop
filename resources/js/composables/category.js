import {computed, ref, watch} from 'vue'
import {useRoute, useRouter} from "vue-router";
import {doGet} from "../http";
import get from "lodash/get";

// global state, created in module scope
export function useCategory() {
    const route = useRoute()
    const router = useRouter()
    const isLoadingCategory = ref(true)
    const queryCategory = computed(() => {
        return route.query.category || ''
    })
    const categories = ref([])
    const countCategories = ref({})
    const currentCategory = ref(0)
    const fetchCategories = async () => {
        const resp = await doGet('/api/categories')
        categories.value = get(resp, 'data', [])
        countCategories.value = get(resp, 'count', {})
        isLoadingCategory.value = false
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

    watch(queryCategory, (val) => {
        if (!val) {
            return
        }
        currentCategory.value = parseInt(queryCategory.value)
    })

    return {
        fetchCategories,
        categories,
        countCategories,
        currentCategory,
        queryCategory,
        isLoadingCategory,
        onClickCategory,
    }
}
