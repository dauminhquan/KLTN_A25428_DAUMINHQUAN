<template>
    <form @submit.prevent="reg">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="panel registration-form">
                    <div class="panel-body">
                        <div class="text-center">
                            <div class="icon-object border-success text-success"><i class="icon-plus3"></i></div>
                            <h5 class="content-group-lg">Tạo tài khoản <small class="display-block">Mọi trường không được để trống</small></h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" required v-model="info.name" class="form-control" placeholder="Tên doanh nghiệp">
                                    <div class="form-control-feedback">
                                        <i class="icon-user text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" required v-model="info.name_president"  class="form-control" placeholder="Tên giám đốc">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-plus text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" required v-model="info.address" class="form-control" placeholder="Địa chỉ">
                                    <div class="form-control-feedback">
                                        <i class="icon-magic-wand text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group has-feedback">
                                    <input type="text" required v-model="info.phone_number" class="form-control" placeholder="Số điện thoại">
                                    <div class="form-control-feedback">
                                        <i class="icon-phone text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="email" required v-model="info.email" class="form-control" placeholder="Điền Email">
                                    <div class="form-control-feedback">
                                        <i class="icon-mention text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="password" required v-model="info.password" class="form-control" placeholder="Nhập mật khẩu">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group has-feedback">
                                    <input type="password" required v-model="info.rep_password"  class="form-control" placeholder="Nhập lại mật khẩu">
                                    <div class="form-control-feedback">
                                        <i class="icon-user-lock text-muted"></i>
                                    </div>
                                    <span class="help-block text-danger" v-if="info.password != info.rep_password"><i class="icon-cancel-circle2 position-left"></i> Mật khẩu không khớp </span>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="button" @click="$emit('set_login')" class="btn btn-link"><i class="icon-arrow-left13 position-left"></i> Quay về đăng nhập</button>
                            <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Tạo tài khoản</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from 'axios'
    import config from './../../config'
    export default {
        data(){
            return {
                info: {
                    name:null,
                    name_president:null,
                    phone_number:null,
                    email: null,
                    password: null,
                    rep_password:null
                },
                config : new config()
            }
        },
        methods:{
            reg(){
                let vm = this
                if(vm.info.password != vm.info.rep_password)
                {
                    vm.config.notifyError('Mật khẩu nhập lại không giống nhau')
                    return
                }
                vm.config.notifyWarning('Đang đăng ký tài khoản')
                axios.post(vm.config.API_REGISTRATION_ENTERPRISE,vm.info).then(data => {
                    vm.config.notifySuccess('Đăng ký thành công.Vui lòng kiểm tra Email của bạn')
                    vm.$emit('set_login')
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422) {
                        vm.config.notifyError(vm.config.getError(err.response.data))
                    }else{
                        vm.config.notifyError('Đăng ký thất bại')
                    }
                })
            }
        }
    }
</script>