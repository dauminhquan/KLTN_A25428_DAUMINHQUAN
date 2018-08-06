<template>
    <form @submit.prevent="login">
        <div class="panel panel-body login-form">
            <div class="text-center">
                <div class="icon-object border-slate-300 text-slate-300"  v-if="processing == false"><i class="icon-reading"></i></div>
                <div class="pace-demo" v-if="processing == true" >
                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                </div>
                <h5 class="content-group">Đăng nhập <small :class="styleText" v-html="Text"></small></h5>

            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input type="text" class="form-control" v-model="infoLogin.email" placeholder="Username">
                <div class="form-control-feedback">
                    <i class="icon-user text-muted"></i>
                </div>

            </div>

            <div class="form-group has-feedback has-feedback-left">
                <input type="password" class="form-control" v-model="infoLogin.password" placeholder="Password">
                <div class="form-control-feedback">
                    <i class="icon-lock2 text-muted"></i>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login<i class="icon-circle-right2 position-right"></i></button>
            </div>

            <div class="text-center">
                <a href="javascript:void(0)" @click="forgotPassword">Quên mật khẩu?</a>
            </div>
        </div>
    </form>
</template>
<script>
    import axios from 'axios'
    import config from './../../config'
    window.Cookies = require('cookies-js');

    export default {
        mounted(){

        },
        methods:{
            forgotPassword()
            {
                this.$emit('forget_password')
            },
            login(){
                var vm = this
                    vm.processing = true
                    axios.post( vm.config.API_AUTH_LOGIN,vm.infoLogin).then(data => {
                        console.log(data);

                        let index = vm.styleText.findIndex(element => {
                            return 'text-danger' == element
                        })
                        vm.styleText.splice(index,1)
                        window.Cookies.set('token',data.data.token,{
                            expires: 600000
                        })
                        window.Cookies.set('user',data.data.user.id,{
                            expires: 600000
                        })
                        vm.Text = ''
                        vm.processing = false
                        window.location = vm.config.WEB_HOME
                    }).catch(err => {
                        console.dir(err)
                        vm.styleText.push('text-danger');
                        if(err.response.status == 422)
                        {
                            let html = ''
                            err.response.data.errors.email.forEach(item => {
                                html+=item
                                html+='<br>'
                            })
                            vm.Text = html

                        }
                        else if(err.response.status == 406)
                        {
                            vm.Text = err.response.data.password
                        }
                        vm.processing = false
                    })
            }
        },
        data(){
            return {
                infoLogin: {
                    email:'',
                    password: ''
                },
                styleText: ['display-block'],
                Text: '<br>Điền tài khoản và mật khẩu của bạn',
                processing: false,
                config: new config()
            }
        }
    }
</script>