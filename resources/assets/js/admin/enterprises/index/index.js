import Vue from 'vue'

// import testTable from './components/table'
// Vue.component('test-table',testTable);
import content from './content'
Vue.component('table-content',content)
const app = new Vue({
    el: '#page-content',
})