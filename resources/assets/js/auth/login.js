window.Vue = require('vue');
import login_form from './components/form_login.vue'
import forgot_password from './components/forgot_password.vue'
import reg from './components/reg'
const app = new Vue({
    el: '#login',
    components: {
        'form-login' : login_form,
        'form-forgot-password': forgot_password,
        'form-reg': reg
    },
    mounted(){

    },
    updated(){

    },
    methods: {
        forget_password(){
           this.forgetPassword = true
            this.login = false
            this.reg = false
        },
        set_reg(){
            this.forgetPassword = false
            this.login = false
            this.reg = true
        },
        set_login(){
            this.forgetPassword = false
            this.login = true
            this.reg = false
        }
    },
    data(){
        return {
            forgetPassword: false,
            login:true,
            reg:false
        }
    }
})

import io from 'socket.io-client'
let user = localStorage.getItem('user')
var socket = io(window.location.hostname +':3000')