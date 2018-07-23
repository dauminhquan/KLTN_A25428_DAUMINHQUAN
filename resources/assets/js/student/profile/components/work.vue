<template>
    <div class="tab-pane fade" id="work">

        <!-- Orders history -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin về công việc</h6>
                <div class="heading-elements"><ul class="icons-list">
                    <li>
                        <button @click="showModalExcel" class="right btn btn-default">Nhập Excel</button>
                    </li>
                    <li>
                        <button @click="showModalAddWork" class="right btn btn-success">Thêm một việc</button>
                    </li>
                </ul></div>

            </div>



            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Doanh nghiệp</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Mức lương</th>
                        <th>Vị trí</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="work in work_student" :key="work.id">
                        <td class="no-padding-right avatar-user" style="width: 45px;">
                            <a :href="openInfoEnterprise(work.user_enterprise)" target="_blank">
                                <img :src="getAvatar(work.avatar_enterprise)" height="60" class="" alt="">
                            </a>
                        </td>
                        <td>
                            <a :href="openInfoEnterprise(work.user_enterprise)" class="text-semibold">{{work.name_enterprise}}</a>
                            <div class="text-muted text-size-small" style="width: 200px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                <span class="status-mark bg-grey position-left" v-html="work.introduce_enterprise"></span>

                            </div>
                        </td>
                        <td>{{work.time_start}}</td>
                        <td>{{work.time_end}}</td>
                        <td>
                            <a href="javascript:void(0)" @click="showModalEditWork(work.id)" data-toggle="tooltip"  title="Nhấn để sửa mức lương">{{showSalary(work.salary)}}</a>
                        </td>
                        <td>
                            {{work.position}}
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal-push-excel" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm công việc bằng Excel</h5>
                    </div>

                    <form v-on:submit.prevent="uploadExcelFile" class="form-inline" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input type="file"class="form-control" @change="setExcelFile($event)">
                            <div class="pace-demo" v-if="ExcelFileuploading == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Tải file lên <i class="icon-plus22"></i></button>
                            <a href="/admin/student-manage/get-excel-example-work-student" target="_blank" class="btn btn-info">Tải Excel mẫu <i class="glyphicon glyphicon-info-sign"></i></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modal-update-work" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nhập mức lương </h5>
                    </div>

                    <form v-on:submit.prevent="UpdateWork" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Thời gian bắt đầu</label>
                                        <input type="date" class="form-control" required v-model="work.started_at">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">
                                            Thời gian kết thúc
                                        </label>
                                        <input type="date" v-model="work.dropped_at" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Vị trí</label>
                                        <input type="text" required v-model="work.position" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Mức lương</label>
                                        <select class="form-control" v-model="work.id_salary">
                                            <option v-for="salary in listSalary" :key="salary.id" :value="salary.id">{{salary.about}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="pace-demo" v-if="editingWork == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Lưu <i class="glyphicon glyphicon-save"></i></button>
                            <button type="button" @click="submitDelete" class="btn btn-danger">Xóa <i class="icon-trash"></i></button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modal-add-work" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nhập mức lương </h5>
                    </div>

                    <form v-on:submit.prevent="AddWork" enctype="multipart/form-data">

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Tên doanh nghiệp</label>
                                        <select type="date" class="form-control" required v-model="newWork.email_address_enterprise">
                                            <option v-for="enterprise in listEnterprise" :key="enterprise.email_address_enterprise" :value="enterprise.user_enterprise">{{enterprise.name_enterprise}}</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Thời gian bắt đầu</label>
                                        <input type="date" class="form-control" required v-model="newWork.started_at">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">
                                            Thời gian kết thúc
                                        </label>
                                        <input type="date" v-model="newWork.dropped_at" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Vị trí</label>
                                        <input type="text" required v-model="newWork.position" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Mức lương</label>
                                        <select class="form-control" v-model="newWork.id_salary">
                                            <option v-for="salary in listSalary" :key="salary.id" :value="salary.id">{{salary.about}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="pace-demo" v-if="addingWork == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Thêm mới <i class="glyphicon glyphicon-save"></i></button>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from './../../../axios'
    import configUrl from './../../../config'
    export default {
        props: ['code_student'],
        data() {
            return {
                work_student: [],
                newSalary: '',
                editingWork: false,
                ExcelFileuploading: false,
                idEmployee: '',
                ExcelFileUpload: '',
                listSalary: [],
                work: {
                    position: '',
                    id_salary: '',
                    started_at:'',
                    dropped_at: ''
                },
                addingWork: false,
                newWork:{
                    position: '',
                    id_salary: '',
                    started_at:'',
                    dropped_at: '',
                    code_student: '',
                    email_address_enterprise: ''
                },
                listEnterprise: [],
                configUrl: new configUrl()
            }
        },
        methods: {
            getWorkStudent()
            {
                var vm = this
                axios.get(vm.configUrl.API_STUDENT_WORKS).then(data => {

                    vm.work_student = data.data
                }).catch(err => {
                    console.log(err)
                })
            },
            getAvatar(url){
                return window.location.origin+url
            },
            openInfoEnterprise(email_address_enterprise)
            {
                return null
            },
            showModalExcel()
            {
                $('#modal-push-excel').modal('show')
            },
            showModalEditWork(id){
                var vm = this
                vm.idEmployee  = id
                let work = vm.work_student.find(value=> {
                    return value.id == id
                })


                var arrDate = work.time_start.split('')
                var year = arrDate[6]+arrDate[7]+arrDate[8]+arrDate[9]
                var date = arrDate[0]+arrDate[1]
                var mounth = arrDate[3]+arrDate[4]

                vm.work.started_at = year+'-'+mounth+'-'+date

                 if(work.time_end != null && work.time_end != undefined)
                 {
                     arrDate = work.time_end.split('')
                     year = arrDate[6]+arrDate[7]+arrDate[8]+arrDate[9]
                     date = arrDate[0]+arrDate[1]
                     mounth = arrDate[3]+arrDate[4]
                     vm.work.dropped_at = year+'-'+mounth+'-'+date
                 }
                 else{
                     vm.work.dropped_at=''
                 }

                vm.work.position = work.position
                vm.work.id_salary = work.id_salary
                $('#modal-update-work').modal('show')

            },
            UpdateWork(){

                var vm = this
                vm.editingWork = true
                axios.post(vm.API_ADMIN_STUDENT_MANAGE_UPDATE_WORK_STUDENT(vm.idEmployee),vm.work).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: data.data.message,
                        addclass: 'bg-success'
                    });
                    vm.editingWork = false
                    $('#modal-update-work').modal('hide')

                    vm.getWorkStudent()
                }).catch(err => {
                    console.dir(err)
                    var htmlErr = ''
                    if(typeof err.response.data.message == 'array')
                    {
                        err.response.data.message.forEach((key,item) => {
                            html+=key+ ': '
                            item.forEach(value => {
                                html+=value+', '
                            })
                            html+='<br/>'
                        })
                    }
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: htmlErr=='' ? htmlErr: 'Lỗi từ server',
                        addclass: 'bg-danger'
                    });
                    this.editingWork = false
                    $('#modal-update-work').modal('hide')
                })
            },
            AddWork(){
                var vm = this
                vm.newWork.code_student = vm.code_student
                axios.post(vm.configUrl.API_STUDENT_ADD_WORK_STUDENT,vm.newWork).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Thêm mới thành công',
                        addclass: 'bg-success'

                    });
                    vm.getWorkStudent()
                    $('#modal-add-work').modal('hide')
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Lỗi từ server',
                        addclass: 'bg-danger'
                    });
                    $('#modal-add-work').modal('hide')
                })
            },
            getEnterprise(){
                var vm = this
                axios.get(vm.configUrl.API_STUDENT_GET_LIST_ENTERPRISE).then(data =>{
                        vm.listEnterprise = data.data
                    }).catch(err=>{
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Lỗi từ server',
                        addclass: 'bg-danger'
                    })
                })
            },
            submitDelete(){

                var vm =this
                vm.editingWork = true
                axios.delete(vm.configUrl.API_STUDENT_DELETE_WORK_STUDENT(vm.idEmployee),vm.work).then(data => {
                    vm.work_student = vm.work_student.filter(item => {
                        return item.id!= vm.idEmployee
                    })
                    vm.idEmployee = ''
                    vm.editingWork = false
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Xóa thành công',
                        addclass: 'bg-success'
                    });
                    $('#modal-update-work').modal('hide')
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Lỗi từ server',
                        addclass: 'bg-danger'
                    });
                    $('#modal-update-work').modal('hide')
                })
            },
            setExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.ExcelFileUpload = files[0]
            },
            showModalAddWork(){
              $('#modal-add-work').modal('show')
            },
            uploadExcelFile(){
                var vm = this
                this.ExcelFileuploading = true
                var formData = new FormData()
                formData.append('ExcelFileUpload',vm.ExcelFileUpload)
                axios.post(vm.API_STUDENT_ADD_WORK_STUDENT_EXCEL,formData).then(data => {
                    vm.ExcelFileuploading = false
                    if(data.data.error.length > 0 || data.data.error == null)
                    {
                        var html_err =''
                        var err = data.data.error
                        err.forEach(item => {
                            html_err+='<br>'
                            html_err+='Tên lỗi: '+item.item
                            html_err+='<br>'
                            html_err+='Message : '+item.message
                        })
                        new PNotify({
                            title: 'Cảnh báo! Thêm thành công! Một số dữ liệu trong file bị lỗi',
                            text: data.data.message + '<br> Lỗi tại các vị trí'+html_err,
                            addclass: 'bg-warning',
                            hide: false
                        });
                    }
                    else {
                        new PNotify({
                            title: 'Ohh Yeah! Thành công!',
                            text: data.data.message,
                            addclass: 'bg-success'
                        });

                        setTimeout(function () {
                            window.location.reload()
                        },1000)
                    }
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: err.response.data.message,
                        addclass: 'bg-danger'
                    });
                    this.ExcelFileuploading = false
                })
            },
            getSalary(){
                var vm =this
                axios.get(vm.configUrl.API_REQUEST_INFO_GET_LIST_SALARY).then(data => {
                    vm.listSalary = data.data
                }).catch(err =>{
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra!',
                        text: 'Lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            showSalary(salary)
            {
                if(salary == null || salary == undefined)
                {
                    return '...'
                }
                return salary;
            },

        },
        mounted(){
            this.getSalary()
            this.getEnterprise()
            this.getWorkStudent()

        }
    }
</script>
<style>
    .avatar-user{

    }
    .avatar-user img{
        border-radius: 50%;
        width: 60px;
    }


</style>