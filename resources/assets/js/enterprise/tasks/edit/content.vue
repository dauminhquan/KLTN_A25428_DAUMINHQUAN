<template>
    <div class="content-wrapper">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Update thông tin tuyển dụng</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <form v-on:submit.prevent="updateTask">
                    <fieldset class="content-group">
                        <legend class="text-bold">Chọn các mục</legend>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập tiêu đề</label>
                                    <input type="text" required v-model="info.title" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Mô tả ngắn gọn</label>
                                    <input type="text" v-model="info.description" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các vị trí tuyển dụng</label>
                                    <v-select :options="Positions" label="name" v-model="info.positions" required="true" :data-placeholder="'Chọn các vị trí'" :multiple="true">
                                        <span slot="no-options">Không có mục nào để hiển thị!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các kỹ năng</label>
                                    <v-select :options="Skills" label="name" v-model="info.skills"  required="true" :multiple="true"></v-select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các hình thức tuyển dụng</label>
                                    <v-select :options="Types" label="name" v-model="info.types" required="true" value="name" :multiple="true"></v-select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn mức lương</label>
                                    <v-select :options="Salaries" label="about" v-model="info.salary" required="true" value="name"></v-select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập địa điểm</label>
                                    <input type="text" v-model="info.location" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian bắt đầu nhận hồ sơ</label>
                                    <input type="date" v-model="info.time_start" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian kết thúc nhận hồ sơ</label>
                                    <input type="date" v-model="info.time_end" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Chọn file đính kèm</label>
                                    <button type="button" class="btn btn-success form-control" @click="setFile"><i class="icon icon-file-plus2"></i>Chọn 1 file</button>
                                    <input type="file" style="display: none" ref="inputFile" @change="uploadFile" class="form-control">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <legend class="text-bold">Nội dung tin</legend>
                        <div class="form-group">
                            <textarea id="content-post" required class="form-control" v-model="info.content"></textarea>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <div class="pace-demo" v-if="uploading == true">
                            <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                        </div>
                        <button type="button" @click="requestDeleteItem" class="btn btn-danger">Xóa bài viết <i class="icon-trash-alt position-right"></i></button>
                        <button type="submit" class="btn btn-primary">Lưu chỉnh sửa <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modal_danger" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h6 class="modal-title"><i class="icon-warning"></i> Cảnh báo</h6>
                    </div>

                    <div class="modal-body">

                        <p> <i class="icon-warning"></i> Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
                        <div style="border: snow" class="panel panel-body border-top-danger text-center">
                            <div class="pace-demo" v-if="deleting == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" @click="deleteItem">Xác định xóa</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import vSelect from 'vue-select'

    import axios from './../../../axios'
    import config from './../../../config'
    export default {
        components: {
            'v-select': vSelect
        },
        props: ['keyItem'],
        data(){
            return {
                uploading: false,
                Types: [],
                Positions: [],
                Skills: [],
                Salaries: [],
                info:{
                    title: '',
                    time_start: '',
                    time_end: '',
                    location: '',
                    description: '',
                    content: '',
                    salary_id: '',
                    positions: [],
                    types: [],
                    skills : [],
                },
                deleting: false,
                file_attach: '',
                config: new config(),
            }
        },
        mounted(){
            let vm = this
            vm.getTypes()
            vm.getSalaries()
            vm.getPositions()
            vm.getSkills()
            vm.getTask()
            CKEDITOR.replace( 'content-post' ).on('change',function () {
                vm.info.content = this.getData()
            });
        },
        methods:{
            getTask(){
                let vm = this
                axios.get(vm.config.API_ENTERPRISE_TASKS_RESOURCE+'/'+vm.keyItem).then(data => {
                    vm.info = data.data
                    CKEDITOR.replace( 'content-post' ).setData(vm.info.content)
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError('Lỗi tải thông tin việc làm. Vui lòng kiềm tra lại')
                })
            },
            getTypes(){
                let vm = this
                axios.get(vm.config.API_TYPES+'?size=-1').then(data => {
                    vm.Types = data.data.data
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError('Lỗi tải thông tin các loại công việc. Vui lòng kiềm tra lại')
                })
            },
            getSkills(){
                let vm = this
                axios.get(vm.config.API_SKILLS+'?size=-1').then(data => {
                    vm.Skills = data.data.data
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError('Lỗi tải thông tin các kỹ năng. Vui lòng kiềm tra lại')
                })
            },
            getPositions(){
                let vm = this
                axios.get(vm.config.API_POSITIONS+'?size=-1').then(data => {
                    vm.Positions = data.data.data
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError('Lỗi tải thông tin việc làm. Vui lòng kiềm tra lại')
                })
            },
            getSalaries(){
                let vm = this
                axios.get(vm.config.API_SALARIES+'?size=-1').then(data => {
                    vm.Salaries = data.data.data
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError('Lỗi tải thông tin các mức lương. Vui lòng kiềm tra lại')
                })
            },
            updateTask(){
                let vm = this
                vm.uploading = true
                let pushNew = {
                    title: '',
                    time_start: '',
                    time_end: '',
                    location: '',
                    description: '',
                    content: '',
                    salary_id: '',
                    positions: [],
                    types: [],
                    skills : [],
                }
                if(typeof vm.info.salary =='object')
                {
                    pushNew.salary_id =  vm.info.salary.id
                }
                if(typeof vm.info.skills =='object')
                {
                    pushNew.skills =  vm.info.skills.map(item => {
                        return item.id
                    })
                }
                if(typeof vm.info.positions =='object')
                {
                    pushNew.positions =  vm.info.positions.map(item => {
                        return item.id
                    })
                }
                if(typeof vm.info.types =='object')
                {
                    pushNew.types =  vm.info.types.map(item => {
                        return item.id
                    })
                }
                pushNew.title = vm.info.title
                pushNew.time_start = vm.info.time_start
                pushNew.time_end = vm.info.time_end
                pushNew.location = vm.info.location
                pushNew.description = vm.info.description
                vm.info.content = CKEDITOR.instances( 'content-post' ).getData()
                pushNew.content = vm.info.content
                axios.put(vm.config.API_ENTERPRISE_TASKS_RESOURCE+'/'+vm.keyItem,pushNew).then(data => {
                    vm.uploading = false
                    vm.config.notifySuccess('Update việc làm thành công')
                    // window.location = vm.config.WEB_ENTERPRISE_TASKS
                }).catch(err => {
                    vm.config.notifyError('Lỗi trong quá trình update')
                })
            },
            setFile(){
                this.$refs.inputFile.click()
            },
            uploadFile(e) {
                let vm = this
                vm.file = e.target.files[0]
                let formData = new FormData()
                formData.append('file_attach',vm.file)
                axios.post(vm.config.API_ENTERPRISE_TASKS_UPDATE_FILE_ATTACH+'/'+vm.keyItem,formData).then(data => {
                    vm.config.notifySuccess('Update file thành công')
                })
                    .catch(err => {
                        console.log(err)
                        vm.config.notifyError('Lỗi upload file')
                    })
            },
            requestDeleteItem(){
                $('#modal_danger').modal('show')
            },
            deleteItem(){
                let vm = this
                vm.deleting = true
                axios.delete(vm.config.API_ENTERPRISE_TASKS_RESOURCE+'/'+vm.keyItem).then(data => {
                    $('#modal_danger').modal('hide')
                    vm.config.notifySuccess('Xóa thành công')
                    window.location = vm.config.WEB_ADMIN_TASKS
                    vm.deleting = false
                }).catch(err => {
                    $('#modal_danger').modal('hide')
                    vm.config.notifyError()
                    vm.deleting = false
                })
            }
        },
    }
</script>
