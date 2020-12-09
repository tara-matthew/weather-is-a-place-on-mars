import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/js/components/Index';

export default createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        }
    ]
})
