import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/DashboardComponent';
import Users from './components/Users/UsersComponent';

Vue.use(VueRouter);

const router = new VueRouter({
    base: 'spkApp/public/v',
    mode: 'history',
    routes:[
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/user-m',
            name: 'user-m',
            component: Users
        },
        {
            path: "*",
            redirect: "/404"
        },
        {
            path: "/404",
            name: "404",
        }

    ]
})

export default router;
