import {createRouter, createWebHistory} from 'vue-router'
import Watch from '../views/watch/Watch.vue'
import NotFound from '../views/watch/components/core/404.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Watch
    },
    {
        path: '/products/:slug',
        name: 'product-detail',
        component: () => import('../views/watch/ProductDetail.vue')
    },
    {
        path: '/products',
        name: 'product-list',
        component: () => import('../views/watch/ProductList.vue')
    },
    // Not found
    {
        path: '/:catchAll(.*)',
        name: 'NotFound',
        component: NotFound,
    },
]

const router = createRouter({history: createWebHistory(), routes})
export default router
