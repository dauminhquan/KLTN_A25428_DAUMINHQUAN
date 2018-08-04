<template>
    <form v-on:submit.prevent="submitUpdate">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="row">
                    <fieldset>
                        <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin sinh viên</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tên đầy đủ:</label>
                                    <input type="text" placeholder="Tên đầy đủ" v-model="info.full_name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Họ và tên đệm</label>
                                    <input type="text" placeholder="Họ và tên đệm" required v-model="info.first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tên</label>
                                    <input type="text" v-model="info.last_name" required placeholder="Tên sinh viên" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Địa chỉ Email:</label>
                                    <input type="email" v-model="info.email_address" required placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Số điện thoại #:</label>
                                    <input type="tel" v-model="info.phone_number" required placeholder="+84" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Địa chỉ sinh sống:</label>
                                    <input type="tel" v-model="info.address" required placeholder="Địa chỉ sinh sống" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Thành phố:</label>
                                    <v-select :options="provinces" label="name" v-model="info.province" :required="true"></v-select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Điền thông tin về </label>
                            <textarea id="textarea-info" rows="5" cols="5" class="form-control" v-model="info.introduce" placeholder="Điền thông tin thêm về sinh viên"></textarea>
                        </div>
                    </fieldset>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Cập nhật thông tin <i class="icon-arrow-right14 position-right"></i></button>
                </div>
            </div>
        </div>
    </form>
</template>
<script>
    import vSelect from 'vue-select'
    import axios from './../../../axios'
    import config from './../../../config'
    export default {
        components: {
            'v-select': vSelect
        },
        data(){
            return {
                info:{
                    first_name: null,
                    last_name: null,
                    full_name: null,
                    address: null,
                    phone_number: null,
                    email_address: null,
                    province_id: null,
                    introduce: null,
                    avatar:null,
                    province: null,
                },
                provinces: [],
                config : new config(),
                ckeditor: null
            }
        },
        mounted(){
            let vm = this
            vm.getProvinces()
            vm.getInfo()
            CKEDITOR.replace('textarea-info').on('change',function () {
                vm.info.introduce = this.getData()
            })
        },
        methods:{
            submitUpdate(){
                let vm =this
                let errorMessage = ''
                if(vm.info.province == null)
                {
                    errorMessage+='Vui lòng chọn thành phố<br>'
                }
                if(errorMessage != '')
                {
                    vm.config.notifyError(errorMessage)
                    return false;
                }
                vm.info.province_id = vm.info.province.id
                axios.put(vm.config.API_STUDENT_PROFILE,vm.info).then(data => {
                    vm.config.notifySuccess()
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
            getProvinces(){
                let vm = this
                axios.get(vm.config.API_PROVINCES+'?size=-1').then(data => {
                    vm.provinces = data.data.data
                }).catch(err => {

                })
            },
            getInfo(){
                let vm = this
                axios.get(vm.config.API_STUDENT_PROFILE).then(data => {
                    vm.info = data.data
                    vm.departmentSelect = data.data.department
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
                })
            }
        },
    }
</script>