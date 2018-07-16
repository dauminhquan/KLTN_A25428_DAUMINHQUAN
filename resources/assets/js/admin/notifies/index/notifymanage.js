window.Vue = require('vue');
import datatb from './contentWrapper.vue'
// import store from './store'
Vue.component('content-wrapper',datatb)
const app = new Vue({
    // store:store,
    el: '#page-content',
})