<template>
    <div class="content-wrapper">


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Thêm khóa học</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form v-on:submit.prevent="addPostCourse">


                    <fieldset class="content-group">
                        <legend class="text-bold">Chọn các mục</legend>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập tiêu đề</label>
                                    <input type="text" required v-model="title_post_course" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Nhập mô tả bài viết</label>
                                    <input type="text" required v-model="description_post_course" class="form-control">
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập địa điểm</label>
                                    <input type="text" v-model="location" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian bắt đầu nhận đăng ký</label>
                                    <input type="date" v-model="time_start" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian kết thúc đăng ký</label>
                                    <input type="date" v-model="time_end" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Chọn file đính kèm</label>
                                    <input type="file" @change="setFile" required class="form-control">
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <legend class="text-bold">Nội dung tin</legend>
                        <div class="form-group">
                            <textarea id="content-post-course" required class="form-control" v-model="content_post_course"></textarea>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <div class="pace-demo" v-if="uploading == true">
                            <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
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
        components: {


        },
        mounted(){

            this.ckeditor = CKEDITOR.replace( 'content-post-course' );
            var vm = this
            this.ckeditor.on('change',function () {
                vm.content_post_course = this.getData()
            })
        },
        data(){
            return {
                configUrl: new configUrl(),
                uploading: false,




                title_post_course:'',
                description_post_course: '',
                time_start: '',
                time_end: '',
                location: '',
                city: '',

                content_post_course: '',
                ckeditor: null,
                file: ''
            }
        },
        methods:{



            addPostCourse(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()

                formData.append('content_post_course',vm.content_post_course)

                formData.append('location',vm.location)
                formData.append('time_end',vm.time_end)
                formData.append('time_start',vm.time_start)
                formData.append('title_post_course',vm.title_post_course)
                formData.append('description_post_course',vm.description_post_course)
                formData.append('file_attach_post_course',vm.file)
                axios.post(vm.configUrl.API_ENTERPRISE_POST_COURSE,formData).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Thêm mới bài đăng thành công',
                        addclass: 'bg-success'
                    });
                    vm.uploading = false
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                    vm.uploading = false
                })
            },
            setFile(e){
                console.dir(e)
                this.file = e.target.files[0]
            }
        }
    }
</script>