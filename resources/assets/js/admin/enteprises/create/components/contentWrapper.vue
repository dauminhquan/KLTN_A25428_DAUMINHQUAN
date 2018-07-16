<template>
    <div class="content-wrapper">



        <!-- 2 columns form -->
        <form v-on:submit.prevent="submitAddEnterprise">
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="row">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin Doanh nghiệp</legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên doanh nghiệp:</label>
                                        <input type="text" v-model="infoEnterprise.name_enterprise" placeholder="Tên doanh nghiệp" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên tổng giám đốc:</label>
                                        <input type="text" placeholder="Tên tổng giám đốc" v-model="infoEnterprise.name_president_enterprise" required class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" placeholder="Địa chỉ" required v-model="infoEnterprise.address_enterprise" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Số điện thoại #:</label>
                                        <input type="text" v-model="infoEnterprise.phone_number_enterprise" required placeholder="+99-99-9999-9999" class="form-control">
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" placeholder="Email" @blur="checkExistEmail" required v-model="infoEnterprise.email_address_enterprise" :class="classEmail">
                                        <span class="help-block text-danger" v-if="exist_email == true"><i class="icon-warning22"></i> Email đã tồn tại</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input type="password" v-model="infoEnterprise.password" required placeholder="Nhập mật khẩu" :class="classPassword">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <input type="password" v-model="infoEnterprise.rep_password" required placeholder="Nhập lại mật khẩu" :class="classOldPassword">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>Điền thông tin về doanh nghiệp</label>
                                <textarea rows="5" cols="5" class="form-control" v-model="infoEnterprise.introduce_enterprise" placeholder="Điền thông tin thêm về doanh nghiệp"></textarea>
                            </div>
                        </fieldset>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm mới doanh nghiệp <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->

    </div>
</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        computed: {
            getInforEmail(){
                return this.infoEnterprise.email_address_enterprise
            },
            getPassword(){
                return this.infoEnterprise.password
            },
            getRepPassword(){
                return this.infoEnterprise.rep_password
            }
        },
        components: {

        },
        mounted(){

        },
        data(){
            return {
                code_department: '',
                infoEnterprise:{

                    name_enterprise:'',
                    address_enterprise:'',
                    name_president_enterprise:'',
                    phone_number_enterprise: '',
                    introduce_enterprise: '',
                    avatar_enterprise:'',
                    email_address_enterprise: '',
                    password: '',
                    rep_password: ''
                },
                exist_email: false,
                classEmail : ['form-control'],
                classPassword : ['form-control'],
                classOldPassword : ['form-control'],
                configUrl : new configUrl()
            }
        },
        methods:{

         
            submitAddEnterprise(){
                var vm =this
               if(vm.exist_email == false && vm.infoEnterprise.password == vm.infoEnterprise.rep_password)
               {
                   axios.post(vm.configUrl.API_ADMIN_ENTERPRISE_MANAGE_ADD_ENTERPRISE,vm.infoEnterprise).then(data => {
                       new PNotify({
                           title: 'Ohh Yeah! Thành công!',
                           text: 'Thêm mới doanh nghiệp thành công',
                           addclass: 'bg-success'
                       });
                       setTimeout(function () {
                           window.location.href = window.location.origin+'/admin/enterprise-manage'
                       },2000)
                   }).catch(err => {
                       console.log(err)
                       new PNotify({
                           title: 'Ohh! Có lỗi xảy ra rồi!',
                           text: 'Đã có lỗi xảy ra từ server!',
                           addclass: 'bg-danger'
                       });
                   })
               }
            },
            checkExistEmail()
            {
                var vm = this
                axios.post(vm.configUrl.API_REQUEST_INFO_CHECK_EXIST_INFO_ENTERPRISE,{
                    email_address_enterprise : vm.infoEnterprise.email_address_enterprise
                }).then(data => {

                    if(data.data.email_address_enterprise == 1)
                    {
                        vm.exist_email = true
                        vm.classEmail.push('border-danger')
                    }
                    else{
                        vm.exist_email = false
                        var index = vm.classEmail.indexOf('border-danger')
                        if(index > -1)
                        {
                            vm.classEmail.splice(index,1)
                        }
                    }
                }).catch(error => {
                    console.log(error)
                })
            },
            setDrangerClass(value)
            {
                value.push('border-danger')
                return value
            },
            upsetDrangerClass(value)
            {
                var index = value.indexOf('border-danger')
                if(index > -1)
                {
                    value.splice(index,1)
                }
                return value
            },
            checkHasDrangerClass(value)
            {
                var index = value.indexOf('border-danger')
                if(index > -1)
                {
                    return true
                }
                return false
            }
        },
        watch: {



            getPassword:{
                handler(newValue)
                {
                    this.classPassword = this.upsetDrangerClass(this.classPassword)
                    if(newValue != this.infoEnterprise.rep_password)
                    {
                        if(!this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.setDrangerClass(this.classOldPassword)
                        }

                    }
                    else{
                        if(this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.upsetDrangerClass(this.classOldPassword)
                        }
                    }
                },
                deep: true
            },
            getRepPassword:{
                handler(newValue)
                {
                    if(newValue != this.infoEnterprise.password)
                    {
                        if(!this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.setDrangerClass(this.classOldPassword)
                        }
                    }
                    else{
                        if(this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.upsetDrangerClass(this.classOldPassword)
                        }
                    }
                },
                deep: true
            }
        }
    }
</script>