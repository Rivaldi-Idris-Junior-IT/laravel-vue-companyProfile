//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    {
        path: '/',
        name: 'main',
        component: () => import( /* webpackChunkName: "main" */ '../views/Main.vue')
    },    
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes // <-- routes
})

export default router