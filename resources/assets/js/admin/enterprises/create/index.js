window.Vue = require('vue');
import content_wrapper from './components/contentWrapper.vue'

Vue.component('content-wrapper',content_wrapper)
const app = new Vue({
    el: '#page-content',
})