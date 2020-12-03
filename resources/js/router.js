import Vue from 'vue'
import Router from 'vue-router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(Router)
Vue.use(ViewUI);

import adminbutton from './components/basics/adminbutton.vue'
import AdminDeduct from './components/basics/AdminDeduct.vue'

const routes = [
    //method
    {
        path: '/dmaddreturns/*',
        component: adminbutton
    },

    {
        path: '/dmform/*',
        component: AdminDeduct
    }

]

export default new Router({
    mode: 'history',
    routes
})