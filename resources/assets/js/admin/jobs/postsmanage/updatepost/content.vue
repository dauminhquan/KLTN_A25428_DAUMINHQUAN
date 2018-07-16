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

                <form v-on:submit.prevent="updatePost">


                    <fieldset class="content-group">
                        <legend class="text-bold">Chọn các mục</legend>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập tiêu đề</label>
                                    <input type="text" required v-model="title_post" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Mô tả ngắn gọn</label>
                                    <input type="text" v-model="description_post" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các vị trí tuyển dụng</label>
                                    <select2 :options="positions" v-model="list_positions" required="true" :data-placeholder="'Chọn các vị trí'" multiple="true"></select2>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các kỹ năng</label>
                                    <select2 :options="skills" v-model="list_skills"  required="true" multiple="true"></select2>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn các hình thức tuyển dụng</label>
                                    <select2 :options="types" v-model="list_types" required="true" multiple="true"></select2>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Chọn thành phố</label>
                                    <select2 :options="locals" v-model="city" required="true" multiple="true"></select2>
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
                                    <label class="control-label">Thời gian bắt đầu nhận hồ sơ</label>
                                    <input type="date" v-model="time_start_post" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian kết thúc nhận hồ sơ</label>
                                    <input type="date" v-model="time_end_post" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Chọn file đính kèm</label>
                                    <input type="file" @change="setFile" class="form-control">
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <legend class="text-bold">Nội dung tin</legend>
                        <div class="form-group">
                            <textarea id="content-post" required class="form-control" v-model="content_post"></textarea>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <div class="pace-demo" v-if="uploading == true">
                            <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                        </div>
                        <button type="button" v-if="accepted == 0 && updateAccept == false" @click="acceptPost" class="btn btn-success">Chấp nhận bài viết <i class="icon-check2 position-right"></i></button>
                        <button type="button" @click="deletePost" class="btn btn-danger">Xóa bài viết <i class="icon-trash-alt position-right"></i></button>
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
                        <button type="button" class="btn btn-danger" @click="acceptdeletePost">Xác định xóa</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    import select2 from './components/select2.vue'
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        components: {
            'select2': select2
        },
        props: ['id-post'],
        mounted(){
            this.getPost()
            this.getSkills()
            this.getPositions()
            this.getTypes()
            this.ckeditor = CKEDITOR.replace( 'content-post' );
            var vm = this
            this.ckeditor.on('change',function () {
                vm.content_post = this.getData()
            })
        },
        data(){
            return {
                uploading: false,
                locals : [
                    "An Giang"
                    ,"Bà Rịa - Vũng Tàu"
                    ,"Bắc Giang"
                    ,"Bắc Kạn"
                    ,"Bạc Liêu"
                    ,"Bắc Ninh"
                    ,"Bến Tre"
                    ,"Bình Định"
                    ,"Bình Dương"
                    ,"Bình Phước"
                    ,"Bình Thuận"
                    ,"Cà Mau"
                    ,"Cao Bằng"
                    ,"Đắk Lắk"
                    ,"Đắk Nông"
                    ,"Điện Biên"
                    ,"Đồng Nai"
                    ,"Đồng Tháp"
                    ,"Gia Lai"
                    ,"Hà Giang"
                    ,"Hà Nam"
                    ,"Hà Tĩnh"
                    ,"Hải Dương"
                    ,"Hậu Giang"
                    ,"Hòa Bình"
                    ,"Hưng Yên"
                    ,"Khánh Hòa"
                    ,"Kiên Giang"
                    ,"Kon Tum"
                    ,"Lai Châu"
                    ,"Lâm Đồng"
                    ,"Lạng Sơn"
                    ,"Lào Cai"
                    ,"Long An"
                    ,"Nam Định"
                    ,"Nghệ An"
                    ,"Ninh Bình"
                    ,"Ninh Thuận"
                    ,"Phú Thọ"
                    ,"Quảng Bình"
                    ,"Quảng Nam"
                    ,"Quảng Ngãi"
                    ,"Quảng Ninh"
                    ,"Quảng Trị"
                    ,"Sóc Trăng"
                    ,"Sơn La"
                    ,"Tây Ninh"
                    ,"Thái Bình"
                    ,"Thái Nguyên"
                    ,"Thanh Hóa"
                    ,"Thừa Thiên Huế"
                    ,"Tiền Giang"
                    ,"Trà Vinh"
                    ,"Tuyên Quang"
                    ,"Vĩnh Long"
                    ,"Vĩnh Phúc"
                    ,"Yên Bái"
                    ,"Phú Yên"
                    ,"Cần Thơ"
                    ,"Đà Nẵng"
                    ,"Hải Phòng"
                    ,"Hà Nội"
                    ,"TP HCM"
                ],
                accepted: -1,
                updateAccept: false,
                types: [],
                positions: [],
                skills: [],
                title_post:'',
                list_types: [],
                list_skills: [],
                list_positions: [],
                time_start_post: '',
                time_end_post: '',
                location: '',
                city: '',
                description_post: '',
                content_post: '',
                ckeditor: null,
                file: '',
                configUrl: new configUrl(),
                deleting: false,
            }
        },
        methods:{
            getSkills()
            {
                var vm = this
                axios.get(vm.configUrl.API_JOB_GET_LIST_SKILL).then(data => {
                    vm.skills = data.data
                    if(vm.skills.length > 0)
                    {
                        vm.skills = vm.skills.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_skill
                            }
                        })
                    }
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                    console.dir(err)
                })
            },
            getPositions()
            {
                var vm = this
                axios.get(vm.configUrl.API_JOB_GET_LIST_POSITION).then(data => {
                    vm.positions = data.data
                    if(vm.positions.length > 0)
                    {
                        vm.positions = vm.positions.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_position
                            }
                        })
                    }
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                })
            },
            getTypes(){
                var vm = this
                axios.get(vm.configUrl.API_JOB_GET_LIST_TYPE_JOB).then(data => {
                    vm.types = data.data
                    if(vm.types.length > 0)
                    {
                        vm.types = vm.types.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_job_type
                            }
                        })
                    }
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                })
            },
            acceptPost(){
                let vm = this
                axios.put(vm.configUrl.API_ADMIN_JOB_MANAGE_ACCEPT_POST(vm.idPost)).then(data => {
                    vm.accepted = 1
                    vm.updateAccept = true
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Chấp nhận thành công',
                        addclass: 'bg-success'
                    });
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            updatePost(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()

                formData.append('content_post',vm.content_post)
                formData.append('description_post',vm.description_post)
                vm.list_positions.forEach((item) => {
                    formData.append('list_positions[]',item)
                })

                vm.list_skills.forEach((item) => {
                    formData.append('list_skills[]',item)
                })

                vm.list_types.forEach((item) => {
                    formData.append('list_types[]',item)
                })
                vm.city.forEach((item) => {
                    formData.append('cities[]',item)
                })



                formData.append('location',vm.location)
                formData.append('time_end_post',vm.time_end_post)
                formData.append('time_start_post',vm.time_start_post)
                formData.append('title_post',vm.title_post)
                formData.append('file_attach_post',vm.file)
                axios.post(vm.configUrl.API_ENTERPRISE_POST+'/'+vm.idPost,formData).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Update bài viết thành công',
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
            deletePost(){
                $('#modal_danger').modal('show')
            },
            acceptdeletePost(){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ENTERPRISE_POST+'/'+vm.idPost).then(data => {

                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công bài viết',
                        addclass: 'bg-success'
                    });
                    setTimeout(function () {
                        window.location = vm.configUrl.WEB_ADMIN_JOB_MANAGE_JOBS
                    },1000)
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            getPost(){
                let vm = this
                axios.get(vm.configUrl.API_ADMIN_JOB_MANAGE_GET_DETAIL_POST(vm.idPost)).then(data => {
                    this.city = data.data.cities.map(item => {
                        return item.city
                    })
                    this.list_positions = data.data.positions.map(item => {
                        return item.pivot.id_position.toString()
                    })
                    this.list_skills = data.data.skills.map(item => {
                        return item.pivot.id_skill.toString()
                    })
                    this.list_types = data.data.types.map(item => {
                        return item.pivot.id_job_type.toString()
                    })
                    this.description_post = data.data.info.description_post
                    this.content_post = data.data.info.content_post
                    this.location = data.data.info.localtion
                    this.title_post = data.data.info.title_post
                    this.time_start_post = data.data.info.time_start_post
                    this.time_end_post = data.data.info.time_end_post
                    this.accepted = data.data.info.accept
                }).catch(err => {

                })
            },
            setFile(e){

                this.file = e.target.files[0]
            }
        }
    }
</script>