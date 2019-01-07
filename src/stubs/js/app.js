/*
 * Just get started with this.
 */

require('./bootstrap')

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import router from './router'

Vue.use(Buefy)

// now the components turn

import App from './components/App.vue'

const app = new Vue({
    el: '#app',
    components: { App },
    router
})