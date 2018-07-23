window.Vue = require('vue');
import content_wrapper from './components/contentWrapper.vue'
// import store from './store'
Vue.component('content-wrapper',content_wrapper)
const app = new Vue({
    // store:store,
    el: '#page-content',
})