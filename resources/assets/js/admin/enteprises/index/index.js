window.Vue = require('vue');
import datatb from './contentWrapper.vue'
Vue.component('content-wrapper',datatb)
const app = new Vue({
    el: '#page-content',
})