window.Vue = require('vue');
import main_sidebar from './components/main_sidebar/main_sidebar.vue'
import main_content from './components/main_content/main_content.vue'
const app = new Vue({
    el: '#page-content',
    components: {
        'main-sidebar' : main_sidebar,
        'main-content' : main_content
    },
    mounted(){
        $(".styled, .multiselect-container input").uniform({
            radioClass: 'choice'
        });
    }
})
