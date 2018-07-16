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

                        <span class="display-block" >{{graduated}}</span>

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
                        <li class="active"><a href="#profile" data-toggle="tab"><i class=" icon-info3"></i> Thông tin cá nhân</a></li>


                        <li><a href="#work" data-toggle="tab"><i class=" icon-office"></i> Thông tin công việc</a></li>

                    </ul>
                </div>
            </div>

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

        </div>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    export default {
        props : ['code_student'],
        mounted(){
            this.getAvatarUser()
        },
        data(){
            return {
                file_avatar: new FormData(),
                avatar_user : '',
                user_name: '',
                graduated:'',
                configUrl: new configUrl()
            }
        },
        methods:{

            getAvatarUser(){
                var vm = this
                axios.get(vm.configUrl.API_REQUEST_INFO_GET_OPTION_STUDENT+'?code_student='+vm.code_student+'&option[]=avatar_student&option[]=first_name_student&option[]=last_name_student&option[]=graduated').then(data => {
                    console.log(data)
                    vm.avatar_user = data.data.avatar_student
                    vm.user_name = data.data.first_name_student + ' ' +data.data.last_name_student
                    if(data.data.graduated == 1)
                    {
                        vm.graduated = 'Đã tốt nghiệp'
                    }
                    else{
                        vm.graduated = 'Chưa tốt nghiệp'
                    }

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
                vm.file_avatar.append('code_student',vm.code_student)
                axios.post(vm.configUrl.API_ADMIN_STUDENT_MANAGE_UPDATE_AVATAR_STUDENT,vm.file_avatar).then(data => {
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