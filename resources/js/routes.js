import {createRouter, createWebHistory} from 'vue-router'
import Watch from '../views/watch/Watch.vue'
import Home from '../views/Home.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Watch
    },
    {
        path: '/watch',
        name: 'watch',
        component: Watch
    },
]

const router = createRouter({history: createWebHistory(), routes})
export default router
