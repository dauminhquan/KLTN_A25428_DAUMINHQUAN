<template>
    <div class="content-wrapper">
        <form v-on:submit.prevent="submitInsert">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="row">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin Doanh nghiệp</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên doanh nghiệp:</label>
                                        <input type="text" v-model="info.name" placeholder="Tên doanh nghiệp" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên tổng giám đốc:</label>
                                        <input type="text" placeholder="Tên tổng giám đốc" v-model="info.name_president" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" placeholder="Địa chỉ" required v-model="info.address" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email #:</label>
                                        <input type="email" v-model="info.email_address" required placeholder="Example@email.com" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số điện thoại #:</label>
                                        <input type="tel" v-model="info.phone_number" required placeholder="+84" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Điền thông tin về doanh nghiệp</label>
                                <textarea id="textarea-info" rows="5" cols="5" class="form-control" v-model="info.introduce" placeholder="Điền thông tin thêm về doanh nghiệp"></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm mới doanh nghiệp <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        data(){
            return {
                info:{
                    name:'',
                    address: '',
                    name_president: '',
                    phone_number: '',
                    email_address: '',
                    introduce: '',
                },
                config : new configUrl(),
                ckeditor: null
            }
        },
        mounted(){
            let vm = this
            CKEDITOR.replace('textarea-info').on('change',function () {
                vm.info.introduce = this.getData()
            })
        },
        methods:{
            submitInsert(){
                let vm =this
                axios.post(vm.config.API_ADMIN_ENTERPRISES_RESOURCE,vm.info).then(data => {
                   vm.config.notifySuccess()
                    setTimeout(function () {
                        window.location.href = vm.config.WEB_ADMIN_ENTERPRISES
                    },2000)
                }).catch(err => {
                    console.dir(err)
                    if(err.response.status == 422)
                    {
                        let message = ''
                        message = err.response.data.message
                        message+= '<br>'
                        let errors = err.response.data.errors
                        let keys = Object.keys(errors)
                        keys.forEach(key => {
                            errors[key].forEach(item => {
                                message+=item+'<br>'
                            })
                        })
                        vm.config.notifyError(message)
                    }
                    else{
                        vm.config.notifyError()
                    }
                })
            },
        },
    }
</script>