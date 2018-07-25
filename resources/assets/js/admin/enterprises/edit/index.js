window.Vue = require('vue');
import './../../../core/app'
import content from './components/content'
const app = new Vue({
    components: {
        'web-content' : content
    },
    el: '#page-container',
})