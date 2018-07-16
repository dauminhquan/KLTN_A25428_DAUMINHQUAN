<template>
    <div class="tab-pane fade in active" id="profile">

        <!-- Profile info -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông doanh nghiệp </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form v-on:submit.prevent="submitUpdateEnterprise">
                    <div class="row">
                        <fieldset>
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
                                        <input type="email" placeholder="Email" disabled  :value="email_address_enterprise" :class="classEmail">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input type="password" v-model="infoEnterprise.password"  placeholder="Nhập mật khẩu" :class="classPassword">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <input type="password" v-model="infoEnterprise.rep_password"  placeholder="Nhập lại mật khẩu" :class="classOldPassword">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>Điền thông tin về doanh nghiệp</label>
                                <textarea id="content-profile" required rows="5" cols="5"  class="form-control" v-model="infoEnterprise.introduce_enterprise" placeholder="Điền thông tin thêm về doanh nghiệp"></textarea>

                            </div>
                        </fieldset>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Lưu doanh nghiệp <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>

            </div>
        </div>




    </div>
</template>
<script>

    import axios from './../../../axios'
    import configUrl from './../../../config'
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
            },

        },
        components: {

        },
        beforeUpdate()
        {

        }
        ,
        updated(){

        }
        ,
        beforeMount(){

        },
        mounted(){
            let vm = this
            this.ckeditor = CKEDITOR.replace( 'content-profile' );
            this.ckeditor.on('change',function () {

                vm.infoEnterprise.introduce_enterprise = this.getData()
            })
            this.getInforEnterprise()


        },
        created(){
        },
        data(){
            return {
                configUrl: new configUrl(),
                infoEnterprise:{

                    name_enterprise:'',
                    name_president_enterprise:'',

                    phone_number_enterprise: '',
                    email_address_enterprise: '',
                    introduce_enterprise:'',
                    avatar_enterprise: '',


                    password: '',
                    rep_password: '',

                },
                departments:[
                ],
                branches: [

                ],
                courses : [

                ],

                exist_email: false,
                classEmail : ['form-control'],
                classCodeEnterprise : ['form-control'],
                classPassword : ['form-control'],
                classOldPassword : ['form-control'],
                ckeditor: null,
            }
        },
        methods:{
            getInforEnterprise(){
                let vm =this
                axios.get(vm.configUrl.API_ENTERPRISE_INFO).then(data => {

                    vm.infoEnterprise.name_enterprise = data.data.info_enterprise.name_enterprise
                    vm.infoEnterprise.address_enterprise = data.data.info_enterprise.address_enterprise
                    vm.infoEnterprise.name_president_enterprise = data.data.info_enterprise.name_president_enterprise
                    vm.infoEnterprise.email_address_enterprise = data.data.info_enterprise.email_address_enterprise
                    vm.infoEnterprise.phone_number_enterprise = data.data.info_enterprise.phone_number_enterprise
                    vm.infoEnterprise.introduce_enterprise = data.data.info_enterprise.introduce_enterprise

                }).catch(err => {

                })
            },
            submitUpdateEnterprise(){
                let vm =this
                if(vm.infoEnterprise.password != vm.infoEnterprise.rep_password)
                {
                    if(!this.checkHasDrangerClass(this.classOldPassword))
                    {
                        this.classOldPassword = this.setDrangerClass(this.classOldPassword)
                    }
                }
                else {
                    vm.infoEnterprise.email_address_enterprise = vm.email_address_enterprise
                    axios.put(vm.configUrl.API_ADMIN_ENTERPRISE_MANAGE_UPDATE_ENTERPRISE,vm.infoEnterprise).then(data => {
                        console.log(data)
                        new PNotify({
                            title: 'Ohh Yeah! Thành công!',
                            text: 'Update thông tin doanh nghiệp thành công',
                            addclass: 'bg-success'
                        });
                        vm.infoEnterprise.email_address_enterprise = ''

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

            setDrangerClass(value)
            {
                value.push('border-danger')
                return value
            },
            upsetDrangerClass(value)
            {
                let index = value.indexOf('border-danger')
                if(index > -1)
                {
                    value.splice(index,1)
                }
                return value
            },
            checkHasDrangerClass(value)
            {
                let index = value.indexOf('border-danger')
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
            },

        },
        props: ['email_address_enterprise']
    }
</script>