window.Vue = require('vue');
import main_sidebar from './components/main_sidebar/main_sidebar.vue'
import main_content from './components/main_content/main_content.vue'

import store from './Store'
const app = new Vue({
    store,
    el: '#page-content',
    components: {
        'main-sidebar' : main_sidebar,
        'main-content' : main_content,

    },
    mounted(){

    },
    updated(){
    },
    computed:{

    },
    methods: {


    },
})
