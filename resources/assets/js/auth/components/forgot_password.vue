<template>
   <div>
       <form  v-if="!sended" @submit.prevent="getToken">
           <div class="panel panel-body login-form">
               <div class="text-center">
                   <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                   <h5 class="content-group">Quên mật khẩu <small class="display-block">Chúng tôi sẽ gửi mã xác nhận về email của bạn</small></h5>
               </div>

               <div class="form-group has-feedback">
                   <input type="email" class="form-control" v-model="email" placeholder="Your email">
                   <div class="form-control-feedback">
                       <i class="icon-mail5 text-muted"></i>
                   </div>
               </div>
               <div class="pace-demo" v-if="processing == true" >
                   <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
               </div>
               <button type="submit" class="btn bg-blue btn-block">Lấy mã <i class="icon-arrow-right14 position-right"></i></button>
           </div>
       </form>
       <form v-if="sended" @submit.prevent="resetPassword">
           <div class="panel panel-body login-form">
               <div class="text-center">
                   <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                   <h5 class="content-group">Quên mật khẩu <small class="display-block">Điền mật khẩu mới của bạn. Ít nhất 6 ký tự</small></h5>
               </div>

               <div class="form-group has-feedback">
                   <input type="password" class="form-control" v-model="password" placeholder="Nhập mật khẩu của bạn">
                   <div class="form-control-feedback">
                       <i class="icon-lock text-muted"></i>
                   </div>
               </div>
               <div class="form-group has-feedback">
                   <input type="password" class="form-control" v-model="rep_password" placeholder="Nhập lại mật khẩu">
                   <div class="form-control-feedback">
                       <i class="icon-lock text-muted"></i>
                   </div>
                   <h5 v-if="password != rep_password || password.length < 6" class="content-group"><small class="display-block wysiwyg-color-red">Mật khẩu không giống nhau hoặc quá ngắn</small></h5>
               </div>
               <div class="form-group has-feedback">
                   <input type="text" class="form-control" v-model="token" placeholder="Nhập mã bạn nhận được">
                   <div class="form-control-feedback">
                       <i class="icon-mail5 text-muted"></i>
                   </div>
               </div>
               <div class="pace-demo" v-if="processing == true" >
                   <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
               </div>
               <button type="submit" class="btn bg-blue btn-block">Đổi mật khẩu <i class="icon-arrow-right14 position-right"></i></button>
           </div>
       </form>
   </div>
</template>
<script>
    import axios from 'axios'
    import config from './../../config'
    export default {
        data(){
          return {
              config: new config(),
              email: '',
              sended: false,
              password:'',
              rep_password: '',
              token: '',
              processing: false
          }
        },
        methods: {
            getToken(){
                let vm = this
                vm.processing = true
                axios.post(vm.config.API_GET_TOKEN,{
                    email: vm.email
                }).then(data => {
                    vm.config.notifySuccess(data.data.message)
                    vm.processing = false
                    vm.sended = true
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422)
                    {
                        vm.config.notifyError(err.response.data.errors.email[0])
                    }
                    else{
                        vm.config.notifyError()
                    }
                    vm.processing = false
                })
            },
            resetPassword(){
                let vm = this
                if(vm.password == vm.rep_password)
                {
                    vm.processing = true
                    axios.put(vm.config.API_RESET_PASSWORD,{
                        email: vm.email,
                        password: vm.password,
                        rep_password: vm.rep_password,
                        token: vm.token

                    }).then(data => {
                        vm.config.notifySuccess(data.data.message)
                        window.location = '/login'
                        vm.processing = false
                    }).catch(err => {
                        console.dir(err)
                        if(err.response.status == 422)
                        {

                            vm.config.notifyError('Đã có lỗi xảy ra. Vui lòng kiểm tra lại')
                        }
                        else{
                            vm.config.notifyError()
                        }
                        vm.processing = false
                    })
                }
                else{
                    vm.config.notifyError('Mật khẩu nhập lại không khớp nhau')
                }
            }
        }
    }
</script>