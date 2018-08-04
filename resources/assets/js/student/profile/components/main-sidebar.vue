<template>
    <div class="sidebar sidebar-main sidebar-default sidebar-separate">
        <div class="sidebar-content">
            <div class="content-group">
                <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                    <div class="content-group-sm">
                        <h6 class="text-semibold no-margin-bottom">
                            {{nameItem}}
                        </h6>
                    </div>
                    <a href="javascript:void(0)"  @click="ShowFormFileAvatar" class="display-inline-block content-group-sm">

                        <img :src="urlAvatar" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>

                    <ul class="list-inline list-inline-condensed no-margin-bottom">
                        <li><input type="file" @change="uploadAvatarFile" ref="inputFileAvatar" style="display: none"></li>
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
                            <a href="#" class="media-left"><img :src="urlAvatar" class="img-sm img-circle" alt=""></a>
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
    import axios from './../../../axios'
    import config from './../../../config'
    export default {
        props : ['avatar','nameItem'],
        computed: {
          urlAvatar(){
              if((this.avatar == null || this.avatar == undefined) && (this.newAvatar ==null || this.newAvatar == undefined))
              {
                  return null
              }
              if(this.newAvatar != '' )
              {
                   return this.newAvatar+'?'+new Date()
              }
              return this.avatar+'?'+new Date()
          }
        },
        data(){
            return {
                newAvatar: '',
                formData: new FormData(),
                config: new config()
            }
        },

        methods:{

            ShowFormFileAvatar(){
                this.$refs.inputFileAvatar.click()
                this.newAvatar = this.avatar
            },
            uploadAvatarFile(e)
            {
                var vm = this
                vm.formData.append('avatar',e.target.files[0])
                axios.post(vm.config.API_STUDENT_UPDATE_AVATAR,vm.formData).then(data => {
                    vm.config.notifySuccess('Update Avatar thành công')
                    vm.newAvatar = data.data.url+'?'+new Date()
                }).catch(err => {
                    if(err.response.status == 422)
                    {
                        let message = vm.config.getError(err.response.data)
                        vm.config.notifyError(message)
                    }
                    else{
                        vm.config.notifyError()
                    }
                })
            },
        }
    }
</script>