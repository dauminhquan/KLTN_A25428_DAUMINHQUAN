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

            <div class="form-group login-options">
                <div class="row">
                    <div class="col-sm-6">
                        <label class="checkbox-inline">
                            <div class="checker" @click="checked = checked =='checked' ? '': 'checked'"><span :class="checked"><input type="checkbox"  class="styled" checked="checked"></span></div>
                            Nhớ tài khoản
                        </label>
                    </div>

                    <div class="col-sm-6 text-right">
                        <a href="javascript:void(0)" @click="forgotPassword">Quên mật khẩu</a>
                    </div>
                </div>
            </div>
            <div class="content-divider text-muted form-group"><span>or sign in with</span></div>
            <ul class="list-inline form-group list-inline-condensed text-center">
                <li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
                <li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
                <li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
                <li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
            </ul>

            <div class="content-divider text-muted form-group"><span>Bạn là doanh nghiệp và không có tài khoản?</span></div>
            <a href="javascript:void(0)" @click="$emit('set_reg')" class="btn btn-default btn-block content-group">Đăng ký</a>
            <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>
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
                        let index = vm.styleText.findIndex(element => {
                            return 'text-danger' == element
                        })
                        vm.styleText.splice(index,1)
                        window.Cookies.set('token',data.data.token,{
                            expires: 600000
                        })
                        window.Cookies.set('reg_notify',data.data.user.notify,{
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
                checked: '',
                config: new config()
            }
        }
    }
</script>