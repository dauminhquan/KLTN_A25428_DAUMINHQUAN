import Vue from 'vue'
import './../../../core/app'
import content from './content'
Vue.component('table-content',content)
const app = new Vue({
    el: '#page-content',
})