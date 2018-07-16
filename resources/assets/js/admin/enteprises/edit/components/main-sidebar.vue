<template>
    <div class="sidebar sidebar-main sidebar-default sidebar-separate">
        <div class="sidebar-content">

            <!-- User details -->
            <div class="content-group">
                <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                    <div class="content-group-sm">
                        <h6 class="text-semibold no-margin-bottom">
                            {{user_name}}
                        </h6>

                    </div>

                    <a href="javascript:void(0)"  @click="ShowFormFileAvatar" class="display-inline-block content-group-sm">

                        <img :src="GetAvatarWithUrlOrigin(avatar_user)" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>

                    <ul class="list-inline list-inline-condensed no-margin-bottom">
                        <li><input type="file" @change="uploadAvatarFile" ref="inputFileAvatar" style="display: none"></li>
                    </ul>
                </div>

                <div class="panel no-border-top no-border-radius-top">
                    <ul class="navigation">
                        <li class="navigation-header">Navigation</li>
                        <li class="active"><a href="#profile" data-toggle="tab"><i class=" icon-info3"></i> Thông tin doanh nghiệp</a></li>


                        <li><a href="#employee" data-toggle="tab"><i class=" icon-office"></i> Danh sách nhân viên</a></li>
                        <li><a href="#list_post" data-toggle="tab"><i class=" icon-list"></i> Danh sách bài đăng tuyển dụng</a></li>
                        <li><a href="#post_course" data-toggle="tab"><i class=" icon-book2"></i> Danh sách khóa học</a></li>
                    </ul>
                </div>
            </div>
            <!-- /user details -->
            <!-- Online users -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>Các việc làm gần nhất</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content">
                    <ul class="media-list">
                        <li class="media">
                            <a href="#" class="media-left"><img :src="avatar_user" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">James Alexander</a>
                                <span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-success"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
                                <span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-danger"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Margo Baker</a>
                                <span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-success"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
                                <span class="text-size-mini text-muted display-block">Neenah, WI.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-warning"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Richard Vango</a>
                                <span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-grey-400"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /online-users -->
        </div>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        props : ['email_address_enterprise'],
        mounted(){
            this.getAvatarUser()
        },
        data(){
            return {
                file_avatar: new FormData(),
                avatar_user : '',
                user_name: '',
                configUrl: new configUrl()
            }
        },
        methods:{

            getAvatarUser(){
                var vm = this
                axios.get(vm.configUrl.API_REQUEST_INFO_GET_OPTION_ENTERPRISE+ '?email_address_enterprise='+vm.email_address_enterprise+'&option[]=avatar_enterprise&option[]=name_enterprise').then(data => {

                    vm.avatar_user = data.data.avatar_enterprise
                    vm.user_name = data.data.name_enterprise

                }).catch(err => {

                })
            },
            ShowFormFileAvatar(){
                this.$refs.inputFileAvatar.click()
            },
            GetAvatarWithUrlOrigin(avatar){
                return window.location.origin+avatar;
            },
            uploadAvatarFile(e)
            {
                var vm = this
                vm.file_avatar.append('avatar',e.target.files[0])
                vm.file_avatar.append('email_address_enterprise',vm.email_address_enterprise)
                axios.post(vm.configUrl.API_ADMIN_ENTERPRISE_MANAGE_UPDATE_AVATAR_ENTERPRISE,vm.file_avatar).then(data => {
                        vm.avatar_user = data.data.url+'?'+new Date()
                }).catch(err => {
                    console.log(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                })
            }
        }
    }
</script>