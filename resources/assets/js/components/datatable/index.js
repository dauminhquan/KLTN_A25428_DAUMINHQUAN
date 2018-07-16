window.Vue = require('vue');
import datatable from './datatable.vue'
const app = new Vue({
    el: '#app',
    components: {
       'datatable' : datatable
    },
})
