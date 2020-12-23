import Vue from 'vue';
import VueRouter from 'vue-router';

import Dashboard from './components/DashboardComponent';
import Spk from './components/spk/SpkComponent';
import SpkShow from './components/spk/SpkShowComponent';
import Layout from './components/LayoutComponent';
import Login from './components/auth/LoginComponent';

Vue.use(VueRouter);

const router = new VueRouter({
    base: '/v/',
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
            component: Layout,
            children: [
                {
                    path: "/dashboard",
                    name: "dashboard",
                    component: Dashboard
                },
                {
                    path: "/spk",
                    name: "spk",
                    component: Spk
                },
                {
                    path: "/spk/:id",
                    name: "spk.show",
                    component: SpkShow
                },
            ]
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },

    ]
})

export default router;