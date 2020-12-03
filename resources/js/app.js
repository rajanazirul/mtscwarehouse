require('./bootstrap');

window.Vue = require('vue')

import router from './router'
import common from './common'

Vue.mixin(common)

Vue.component('mainapp', require('./components/mainapp.vue').default)
const dashboard = new Vue({
    el:'#dashboard',
    router
})