window.Vue = require('vue');
import './../../../core/app'
import content from './components/content.vue'
Vue.component('web-content',content)
const app = new Vue({
    el: '#page-content',
})