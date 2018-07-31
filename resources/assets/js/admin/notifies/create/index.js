window.Vue = require('vue');
import content from './components/content.vue'
Vue.component('web-content',content)
const app = new Vue({
    el: '#page-content',
})