import {createRouter, createWebHistory} from 'vue-router'
import {defineAsyncComponent} from "vue";

const routes = [
    {
        path: '/',
        name: 'home',
        component: defineAsyncComponent(() =>
            import('../views/frontend/Home.vue')
        )
    },
    {
        path: '/products/:slug',
        name: 'product-detail',
        component: () => defineAsyncComponent(() =>
            import('../views/frontend/ProductDetail.vue')
        )
    },
    {
        path: '/products',
        name: 'product-list',
        component: () => defineAsyncComponent(() =>
            import('../views/frontend/ProductList.vue')
        )
    },

    {
        path: '/v2',
        name: 'home_v2',
        component: defineAsyncComponent(() =>
            import('../views/frontend_v2/Catalogue.vue')
        ),
    },
    {
        path: '/v2/:slug',
        name: 'product-detail-v2',
        component: defineAsyncComponent(() =>
            import('../views/frontend_v2/ProductDetail.vue')
        ),
    },
    // Not found
    {
        path: '/:catchAll(.*)',
        name: '404',
        component: () => import('../views/frontend/components/core/404.vue'),
    },
]

const router = createRouter({history: createWebHistory(), routes})
export default router
