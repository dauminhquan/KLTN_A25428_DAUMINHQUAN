window.Vue = require('vue');
import content from './components/content'
const app = new Vue({
    components: {
        'web-content' : content
    },
    el: '#page-container',
})