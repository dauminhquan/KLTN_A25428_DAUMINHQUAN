window.Vue = require('vue');
import main_sidebar from './components/main_sidebar/main_sidebar.vue'
import detail_content from './components/main_content/detail_content.vue'
import store from './Store'
const app = new Vue({
    store,
    el: '#page-content',
    components: {
        'main-sidebar' : main_sidebar,
        'detail-content' : detail_content
    },
})
