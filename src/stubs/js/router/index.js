import Vue from 'vue'
import VueRouter from 'vue-router'
 
// it were plugins and vuejs itself
Vue.use(VueRouter)

import StartComponent from '../components/StartComponent.vue'

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: StartComponent }
    ]
})

export default router
