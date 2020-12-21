import Vue from 'vue'
import Router from 'vue-router'
import ViewUI from 'view-design'
import Vue2Filters from 'vue2-filters'
import 'view-design/dist/styles/iview.css'
Vue.use(Router)
Vue.use(ViewUI)
Vue.use(Vue2Filters)

import adminbutton from './components/basics/adminbutton.vue'
import AdminDeduct from './components/basics/AdminDeduct.vue'
<<<<<<< HEAD
=======
import dashboard from './components/basics/dashboard.vue'
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main

const routes = [
    //method
    {
        path: '/dmaddreturns/*',
        component: adminbutton
    },

    {
        path: '/dmform/*',
        component: AdminDeduct
    },
<<<<<<< HEAD
=======

    {
        path: '/',
        component: dashboard
    }
>>>>>>> parent of 01f98db... Merge branch 'test_vue' into main

]

export default new Router({
    mode: 'history',
    mixins: [Vue2Filters.mixin],
    routes
})