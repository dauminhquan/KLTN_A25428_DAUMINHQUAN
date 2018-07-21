import Vue from 'vue'

import testTable from './components/table'
Vue.component('test-table',testTable);
const app = new Vue({
    el: '#page-content',
})