<template>
    <div class="content-wrapper">



        <!-- 2 columns form -->
        <form v-on:submit.prevent="submitAddStudent">
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="row">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin sinh viên</legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ:</label>
                                        <input type="text" v-model="infoStudent.first_name_student" placeholder="Họ" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên:</label>
                                        <input type="text" placeholder="Tên" v-model="infoStudent.last_name_student" required class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" placeholder="Địa chỉ" required v-model="infoStudent.address_student" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" placeholder="Email" @blur="checkExistEmail" required v-model="infoStudent.email_address_student" :class="classEmail">
                                        <span class="help-block text-danger" v-if="exist_email == true"><i class="icon-warning22"></i> Email đã tồn tại</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số điện thoại #:</label>
                                        <input type="text" v-model="infoStudent.phone_number_student" required placeholder="+99-99-9999-9999" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khoa:</label>
                                        <choose-info-select2 :required="true" :options="departments" v-model="code_department" data-placeholder="Chọn Khoa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chuyên ngành:</label>
                                        <choose-info-select2 :required="true" :readonly="true" :un-readonly="code_department" :options="branches" v-model="infoStudent.code_branch" data-placeholder="Chọn Ngành"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khóa:</label>
                                        <choose-info-select2 :required="true" :options="courses" v-model="infoStudent.code_course" data-placeholder="Chọn Khóa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Điền mã sinh viên:</label>
                                        <input type="text" v-model="infoStudent.code_student" @blur="checkExistCodeStudent" required placeholder="Nhập mã sinh viên" :class="classCodeStudent">
                                        <span class="help-block text-danger" v-if="exist_code_student == true"><i class="icon-warning22"></i> Tài khoản đã tồn tại</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.password" required placeholder="Nhập mật khẩu" :class="classPassword">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.rep_password" required placeholder="Nhập lại mật khẩu" :class="classOldPassword">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>Điền thông tin thêm về sinh viên</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Điền thông tin thêm về sinh viên"></textarea>
                            </div>
                        </fieldset>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm mới sinh viên <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->

    </div>
</template>
<script>
    import choose_info_select2 from './choose-info-select2'
    import axios from 'axios'
    import configUrl from './../../../../config'

    export default {
        computed: {
            getInforEmail(){
                return this.infoStudent.email_address_student
            },
            getInforCodeStudent(){
                return this.infoStudent.code_student
            },
            getPassword(){
                return this.infoStudent.password
            },
            getRepPassword(){
                return this.infoStudent.rep_password
            },

        },
        components: {
            'choose-info-select2': choose_info_select2
        },
        mounted(){
            console.log(this.configUrl)
            $(".file-styled").uniform({
                fileButtonClass: 'action btn bg-pink-400'
            });
            // lấy danh sách khóa học
            this.getCourses();
            this.getDepartments();

        },
        data(){
            return {
                code_department: '',
                infoStudent:{
                    code_course: '',
                    code_branch: '',
                    first_name_student:'',
                    last_name_student:'',
                    address_student:'',
                    phone_number_student: '',
                    email_address_student: '',
                    introduce_student:'',

                    code_student: '',
                    password: '',
                    rep_password: ''
                },
                departments:[
                ],
                branches: [

                ],
                courses : [
                   
                ],
                salaries: [],

                exist_email: false,
                exist_code_student: false,
                classEmail : ['form-control'],
                classCodeStudent : ['form-control'],
                classPassword : ['form-control'],
                classOldPassword : ['form-control'],
                configUrl: new configUrl()
            }
        },
        methods:{
            setFileAvatar(e){
                this.infoStudent.avatar_student = e.target.files[0]
            },
            getCourses()
            {
                var vm = this
                axios.get('/api/request-info/get-courses').then(data => {
                    var courses = data.data
                    vm.courses = [{id:'',text:''}]
                    courses.forEach(item => {

                        vm.courses.push({
                            id: item.code_course,
                            text: item.name_course
                        })
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getDepartments()
            {
                var vm = this
                axios.get('/api/request-info/get-departments').then(data => {
                    var courses = data.data
                    vm.departments = [{id:'',text:''}]
                    courses.forEach(item => {

                        vm.departments.push({
                            id: item.code_department,
                            text: item.name_department
                        })
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getBranches(code_department)
            {
                var vm = this
                vm.branches = [{
                    id: '',
                    text: ''
                }]
                axios.get('/api/request-info/get-branches/'+code_department).then(data => {
                    var branches = data.data;

                    branches.forEach(item => {
                        vm.branches.push({
                            id: item.code_branch,
                            text: item.name_branch
                        })
                    })
                }).catch(error => {

                })
            },

            submitAddStudent(){
                var vm =this
               if(vm.exist_email == false && vm.exist_code_student == false && vm.infoStudent.password == vm.infoStudent.rep_password)
               {
                   axios.post(vm.configUrl.API_ADMIN_STUDENT_MANAGE_ADD_STUDENT,vm.infoStudent).then(data => {
                       new PNotify({
                           title: 'Ohh Yeah! Thành công!',
                           text: 'Thêm mới sinh viên thành công',
                           addclass: 'bg-success'
                       });
                       setTimeout(function () {
                           window.location.href = window.location.origin+'/admin/student-manage'
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
                axios.post('/api/request-info/check-exist-info-student',{
                    email_address_student : vm.infoStudent.email_address_student
                }).then(data => {

                    if(data.data[0].email_address_student == 1)
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
            checkExistCodeStudent()
            {
                var vm = this
                axios.post('/api/request-info/check-exist-info-student',{
                    code_student : vm.infoStudent.code_student
                }).then(data => {

                    if(data.data[0].code_student == 1)
                    {
                        vm.exist_code_student = true
                        vm.classCodeStudent.push('border-danger')
                    }
                    else{
                        vm.exist_code_student = false
                        var index = vm.classCodeStudent.indexOf('border-danger')
                        if(index > -1)
                        {
                            vm.classCodeStudent.splice(index,1)
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
            code_department: {
                handler(newValue){
                    // console.log(newValue)
                    this.getBranches(newValue)
                },
                deep: true
            },


            getPassword:{
                handler(newValue)
                {
                    this.classPassword = this.upsetDrangerClass(this.classPassword)
                    if(newValue != this.infoStudent.rep_password)
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
                    if(newValue != this.infoStudent.password)
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