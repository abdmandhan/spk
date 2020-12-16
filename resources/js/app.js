require('./bootstrap');

import Vue from 'vue';
import router from './router';
import vuetify from './vuetify' // path to vuetify export
import App from './App.vue'
import VueResource from 'vue-resource'

Vue.use(VueResource);

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//auth id
Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');
Vue.prototype.$baseUrl = document.querySelector("meta[name='base-url']").getAttribute('content');
Vue.http.options.root = 'http://localhost/spkApp/public/';

new Vue({
    router,
    vuetify,
    el: '#app',
    render: h=> h(App)
})