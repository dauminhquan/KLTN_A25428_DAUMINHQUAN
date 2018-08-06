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
                <form v-on:submit.prevent="createTask">
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
                                    <button type="button" class="btn btn-success form-control" @click="setFile"><i class="icon icon-file-plus2"></i>{{text}}</button>
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
                        <button type="submit" class="btn btn-primary">Thêm mới bài viết <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
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
                    attachment: null
                },
                deleting: false,
                text: ' Chọn 1 file',
                config: new config(),
            }
        },
        mounted(){
            let vm = this
            vm.getTypes()
            vm.getSalaries()
            vm.getPositions()
            vm.getSkills()
            CKEDITOR.replace( 'content-post' ).on('change',function () {
                vm.info.content = this.getData()
            });
        },
        methods:{

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
            createTask(){
                let vm = this
                let formData = new FormData();
                if(vm.info.salary == null || vm.info.salary == null || vm.info.salary == null || vm.info.salary == null)
                {
                    vm.config.notifyError('Vui lòng chọn các trường còn thiếu')
                    return false
                }
                if(vm.info.attachment == null)
                {
                    vm.config.notifyError('Vui lòng chọn 1 file')
                    return false
                }
                vm.uploading = true
                if(typeof vm.info.salary =='object')
                {
                    formData.append('salary_id',vm.info.salary.id)
                }
                if(typeof vm.info.skills =='object')
                {
                    vm.info.skills.forEach(item => {
                        formData.append('skills[]',item.id)
                    })
                }
                if(typeof vm.info.positions =='object')
                {
                    vm.info.positions.forEach(item => {
                        formData.append('positions[]',item.id)
                    })
                }
                if(typeof vm.info.types =='object')
                {
                    vm.info.types.forEach(item => {
                        formData.append('types[]',item.id)
                    })
                }

                formData.append('attachment',vm.info.attachment)

                formData.append('title',vm.info.title)
                formData.append('content',vm.info.content)
                formData.append('description',vm.info.description)
                formData.append('location',vm.info.location)
                formData.append('time_end',vm.info.time_end)
                formData.append('time_start',vm.info.time_start)

                axios.post(vm.config.API_ENTERPRISE_TASKS_RESOURCE,formData).then(data => {
                    vm.uploading = false
                    vm.config.notifySuccess('Thêm việc làm thành công')
                    setTimeout(function(){
                        window.location = vm.config.WEB_ENTERPRISE_TASKS
                    },1500);
                }).catch(err => {
                    vm.config.notifyError()
                })
            },
            setFile(){
                this.$refs.inputFile.click()
            },
            uploadFile(e) {
                let vm = this
                vm.info.attachment = e.target.files[0]
                vm.text = ' '+vm.info.attachment.name
            },
            requestDeleteItem(){
                $('#modal_danger').modal('show')
            },
        },
    }
</script>