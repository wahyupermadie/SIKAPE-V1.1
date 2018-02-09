require('./bootstrap');

import App from './components/App'
Vue.config.productionTip = false;
import Vue from 'vue'
import router from './router'
import Meta from 'vue-meta'

const app = new Vue({
    el: '#app',
    router,
    render: h=> h(App)
});
