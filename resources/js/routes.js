import {createRouter, createWebHistory} from 'vue-router'
import {defineAsyncComponent} from "vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: defineAsyncComponent(() =>
            import('../views/frontend_v2/Catalogue.vue')
        )
    },
    {
        path: '/products/:slug',
        name: 'product-detail',
        component: () => import('../views/frontend_v2/ProductDetail.vue'),
    },
    // Not found
    {
        path: '/:catchAll(.*)?',
        name: '404',
        component: () => import('../views/frontend/components/core/404.vue'),
    },
]

const router = createRouter({history: createWebHistory(), routes})
export default router
