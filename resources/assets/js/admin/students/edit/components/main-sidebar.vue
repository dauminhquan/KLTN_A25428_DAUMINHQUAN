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

                <div class="panel no-border-top no-border-radius-top">
                    <ul class="navigation">
                        <li class="navigation-header">Navigation</li>
                        <li class="active" ><a :href="null" data-toggle="tab" @click="updateActive('profile')"><i class=" icon-info3"></i> Thông tin sinh viên</a></li>
                        <li><a :href="null" data-toggle="tab" @click="updateActive('students')"><i class=" icon-office"></i> Danh sách việc làm</a></li>
                    </ul>
                </div>
            </div>
            <!-- /user details -->
        </div>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import config from './../../../../config'
    export default {
        props : ['keyItem','avatar','nameItem'],
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
        mounted(){
          this.updateActive('profile')
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
                axios.post(vm.config.API_ADMIN_ENTERPRISES_UPDATE_AVATAR+'/'+vm.keyItem,vm.formData).then(data => {
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
            updateActive(active){
                this.$emit('updateActive',active)
            }
        }
    }
</script>