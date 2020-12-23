require('./bootstrap');

import Vue from 'vue';
Vue.config.productionTip = false;

import router from './router';
import vuetify from './plugins/vuetify' // path to vuetify export
import snackbar from './plugins/snackbar' // path to vuetify export
import store from "./services/store";
import App from './App.vue'
import ApiService from './services/api.service';
import { VERIFY_AUTH } from "./services/store/auth.module";

Vue.use(snackbar, { store })

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

ApiService.init();

router.beforeEach((to, from, next) => {
    // Ensure we checked auth before each page load.
    Promise.all([store.dispatch(VERIFY_AUTH)]).then(next);

    // Scroll page to top on every route change
    setTimeout(() => {
        window.scrollTo(0, 0);
    }, 100);
});


new Vue({
    router,
    vuetify,
    store,
    el: '#app',
    render: h => h(App)
})
