<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title">Thông tin về công việc</h6>

        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">Doanh nghiệp</th>
                    <th>Mức lương</th>
                    <th>Vị trí</th>
                </tr>
                </thead>
                <tbody>

                  <tr v-for=" work in works" :key="work.id">
                      <td class="no-padding-right avatar-user" style="width: 45px;">
                          <a :href="null" target="_blank">
                              <img :src="urlAvatar(work.enterprise.avatar)" height="60" class="" alt="">
                          </a>
                      </td>
                      <td>
                          <a :href="null" target="_blank" class="text-semibold">{{work.enterprise.name}}</a>
                          <div class="text-muted text-size-small" style="width: 200px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                              <span class="status-mark bg-grey position-left"></span>
                              <span  style="text-transform: uppercase">{{work.enterprise.code}}</span>
                          </div>
                      </td>
                      <td>{{work.salary.about}}</td>
                      <td>{{work.rank != null ? work.rank.name : null}}</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import axios from './../../../../axios'
    import config  from './../../../../config'
    export default {

        props:["key-item"],
        data() {
            return {

                works: [],
                config: new config()
            }
        },
        methods: {
            getworks()
            {
                let vm = this
                axios.get(vm.config.API_ADMIN_STUDENTS_LIST_WORK_ID(vm.keyItem)).then(data => {
                    console.log(data.data)
                    vm.works = data.data
                }).catch(err => {
                    console.log(err)
                    vm.config.notifyError()
                })
            },
            urlAvatar(url){
                return url==null?null:window.location.origin+'/'+url.replace('public','storage')+'?'+new Date()
            },
        },
        mounted(){
            this.getworks()
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