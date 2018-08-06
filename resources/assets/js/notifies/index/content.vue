<template>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title text-semibold">Danh sách thông báo
                    </h6>
                </div>
                <div class="pace-demo" v-if="searching == true">
                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                </div>
                <ul class="media-list">
                    <li class="media panel-body stack-media-on-mobile" v-for="notify in notifies" :key="notify.id">
                        <div class="media-left">
                            <a href="#">
                                <img :src="notify.admin==null?null:notify.admin.avatar" class="img-rounded img-lg" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading text-semibold">
                                <a :href="getUrlNotify(notify.id)">{{notify.title}}</a>
                            </h6>
                            <ul class="list-inline list-inline-separate text-muted mb-10">
                                <li>{{notify.admin.name}}</li>
                            </ul>
                            {{notify.description}}
                        </div>
                    </li>
                </ul>
            </div>
            <div class="text-center content-group-lg pt-20">
                <ul class="pagination">
                    <li v-if="currentPage > 1" @click="currentPage--"><a href="#"><i class="icon-arrow-small-left"></i></a></li>
                    <li v-for="inPage in listPage" @click="currentPage = inPage"><a href="#">{{inPage}}</a></li>
                    <li v-if="currentPage < totalPage" @click="currentPage++"><a href="#"><i class="icon-arrow-small-right"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import checkBox from './components/checkbox'
    import axios from './../../axios'
    import config from './../../config'
    export default {
        components: {
            'check-box' : checkBox,
        },
        watch:{
          currentPage(value){
              this.getData()
          }
        },
        computed: {
          listPage(){
              let vm  = this
              let pages = []
                  for(let i = 1;i<vm.totalPage;i++)
                  {
                      pages.push(i)
                  }
                  return pages
          },
        },
        data(){
            return {
                notifies: [],
                search: '',
                config: new config(),
                currentPage : 1,
                totalPage: null,
                searching:false
            }
        },
        methods:{
            getNotifys(){

                let vm = this
                vm.notifies = []
                vm.searching = true
                axios.get(vm.config.API_NOTIFIES).then(data => {
                    vm.notifies = data.data.data
                    vm.totalPage = data.data.total
                    vm.currentPage = data.data.current_page
                    vm.searching = false
                }).catch(err => {
                    console.dir(err)
                    vm.searching = false

                    vm.config.notifyError('Đã có lỗi từ server')
                })
            },
            getUrlNotify(id)
            {
                return this.config.WEB_NOTIFIES+'/'+id
            }
        },
        mounted(){
            let vm = this
            vm.getNotifys()
        }
    }

</script>