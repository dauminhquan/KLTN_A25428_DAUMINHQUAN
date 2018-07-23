window.Vue = require('vue');
import content from './content.vue'
const app = new Vue({
    components: {
        'content-wrapper' : content
    },
    el: '#page-content',
})