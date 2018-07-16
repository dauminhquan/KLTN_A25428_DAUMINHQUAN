<template>
    <div class="content-wrapper">


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Thêm mới thông báo</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form v-on:submit.prevent="addNotify">


                    <fieldset class="content-group">
                        <legend class="text-bold">Điền thông tin vào các mục</legend>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập tiêu đề</label>
                                    <input type="text" required v-model="title_notify" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Mô tả ngắn gọn</label>
                                    <input type="text" v-model="description_notify" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-4">
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
                            <textarea id="content-notify" required class="form-control" v-model="content_notify"></textarea>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <div class="pace-demo" v-if="uploading == true">
                            <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mới thông báo <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
<script>

    import select2 from './components/select2.vue'
    import axios from './../../../axios'
    import configUrl from './../../../config'
    export default {
        components: {
            'select2': select2
        },
        props: ['id-notify'],
        mounted(){

            this.ckeditor = CKEDITOR.replace( 'content-notify' );
            var vm = this
            this.ckeditor.on('change',function () {
                vm.content_notify = this.getData()
            })
        },
        data(){
            return {
                uploading: false,

                updateAccept: false,

                title_notify:'',

                description_notify: '',
                content_notify: '',
                ckeditor: null,
                file: '',
                configUrl: new configUrl(),
                deleting: false,
            }
        },
        methods:{


            addNotify(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()

                formData.append('content_notify',vm.content_notify)
                formData.append('description_notify',vm.description_notify)




                formData.append('title_notify',vm.title_notify)
                formData.append('file_attach_notify',vm.file)
                axios.post(vm.configUrl.API_ADMIN_NOTIFY_MANAGE_ADD_NOTIFY,formData).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Thêm thông báo thành công',
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
            deleteNotify(){
                $('#modal_danger').modal('show')
            },
            acceptdeleteNotify(){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ENTERPRISE_POST+'/'+vm.idNotify).then(data => {

                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công thông báo',
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
           
            setFile(e){

                this.file = e.target.files[0]
            }
        }
    }
</script>