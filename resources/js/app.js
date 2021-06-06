require('./bootstrap');

import Vue from 'vue'
import App from './core/App'
import router from './bootstrap/router'
import store from './core/store'

Vue.prototype.config = window.config

window.Vue = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
