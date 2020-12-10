import Vue from 'vue'
import Router from 'vue-router'
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(Router)
Vue.use(ViewUI);

import firstPages from './components/pages/firstPages'
import methods from './components/basics/methods.vue'
import tags from './components/basics/tags.vue'
import adminbutton from './components/basics/adminbutton.vue'
const routes = [
    {
        path: '/first',
        component: firstPages
    },
    //method
    {
        path: '/dmaddreturns',
        component: adminbutton
    }

]

export default new Router({
    mode: 'history',
    routes
})