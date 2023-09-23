import { ref } from 'vue'

const layout = ref('grid')

export function useLayout() {
    const setLayout = (value) => {
        layout.value = value
    }
    return {
        layout,
        setLayout,
    }
}
