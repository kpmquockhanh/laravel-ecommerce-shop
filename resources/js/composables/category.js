import {computed, ref, watch} from 'vue'
import {useRoute, useRouter} from "vue-router";
import {doGet} from "../http";
import get from "lodash/get";

// global state, created in module scope
const currentCategory = ref(0)
const categories = ref([])
const countCategories = ref({})
export function useCategory() {
    const route = useRoute()
    const router = useRouter()
    const isLoadingCategory = ref(true)
    const queryCategory = computed(() => {
        return route.query.category || ''
    })
    const fetchCategories = async () => {
        const resp = await doGet('/api/categories')
        categories.value = get(resp, 'data', [])
        countCategories.value = get(resp, 'count', {})
        isLoadingCategory.value = false
    }

    const onClickCategory = async (category) => {
        // Remove query q
        const query = {...route.query}
        delete query.q
        await router.push({query: {...query}})
        if (currentCategory.value === category.id) {
            currentCategory.value = 0
            return
        }
        currentCategory.value = category.id
    }

    const updateCategory = (val) => {
        currentCategory.value = val
    }

    return {
        fetchCategories,
        categories,
        countCategories,
        currentCategory,
        queryCategory,
        isLoadingCategory,
        onClickCategory,
        updateCategory,
    }
}
