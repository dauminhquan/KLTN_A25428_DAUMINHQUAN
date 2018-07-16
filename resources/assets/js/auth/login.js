window.Vue = require('vue');
import login_form from './components/form_login.vue'
import forgot_password from './components/forgot_password.vue'
const app = new Vue({
    el: '#login',
    components: {
        'form-login' : login_form,
        'form-forgot-password': forgot_password
    },
    mounted(){

    },
    updated(){

    },
    methods: {
        forget_password(){
           this.forgetPassword = true
        }
    },
    data(){
        return {
            forgetPassword: false
        }
    }
})
