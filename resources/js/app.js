require('./bootstrap');

window.Vue = require('vue')

import router from './router'
import common from './common'
import VueResource from 'vue-resource';

Vue.use(VueResource)
Vue.mixin(common)

Vue.component('pagination', require('laravel-vue-pagination'))
Vue.component('product', require('./components/basics/product.vue').default)
Vue.component('mainapp', require('./components/mainapp.vue').default)
<<<<<<< HEAD
Vue.component('app', require('./components/basics/app.vue').default)
Vue.component('dashboarded', require('./components/basics/dashboard.vue').default)
=======
Vue.component('app', require('./components/app.vue').default)
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main

const dashboard = new Vue({
    el:'#dashboard',
    router
})
