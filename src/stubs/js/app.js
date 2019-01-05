/*
 * Just get started with this.
 */

require('./bootstrap')

import Vue from 'vue'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

import StartComponent from './components/StartComponent'

Vue.component('start', StartComponent)

const app = new Vue({
    el: '#app'
})