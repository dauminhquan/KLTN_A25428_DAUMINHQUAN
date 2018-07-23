window.Vue = require('vue');
import mainSidebar from './components/main-sidebar.vue'
import mainContent from './components/main-content'
const app = new Vue({

    components: {
        'main-sidebar' : mainSidebar,
        'main-content': mainContent
    },
    el: '#page-content',
})