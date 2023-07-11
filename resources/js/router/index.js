import { createRouter, createWebHistory } from "vue-router";

import shortenform from '../components/shortenform.vue';
import clicktracking from '../components/clicktracking.vue';

const routes = [
    { path: '/', component: shortenform },
    { path: '/urls/:shortCode/track', component: clicktracking, props: true }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router