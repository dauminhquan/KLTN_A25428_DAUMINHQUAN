<template>
    <div class="page-content">
        <div class="content-wrapper">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title text-semibold">Danh sách sự kiện
                    </h6>
                </div>
                <div class="pace-demo" v-if="searching == true">
                    <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                </div>
                <ul class="media-list">
                    <li class="media panel-body stack-media-on-mobile" v-for="event in events" :key="event.id">
                        <div class="media-left">
                            <a href="#">
                                <img :src="event.admin==null?null:event.admin.avatar" class="img-rounded img-lg" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading text-semibold">
                                <a :href="getUrlEvent(event.id)">{{event.title}}</a>
                            </h6>
                            <ul v-if="event.admin != null" class="list-inline list-inline-separate text-muted mb-10">
                                <li>{{event.admin.name}}</li>
                            </ul>
                            {{event.description}}
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
                events: [],
                search: '',
                config: new config(),
                currentPage : 1,
                totalPage: null,
                searching:false
            }
        },
        methods:{
            getEvents(){
                let vm = this
                vm.events = []
                vm.searching = true
                axios.get(vm.config.API_EVENTS).then(data => {
                    vm.events = data.data.data
                    vm.totalPage = data.data.total
                    vm.currentPage = data.data.current_page
                    vm.searching = false
                }).catch(err => {
                    console.dir(err)
                    vm.searching = false

                    vm.config.notifyError('Đã có lỗi từ server')
                })
            },
            getUrlEvent(id)
            {
                return this.config.WEB_EVENTS+'/'+id
            }
        },
        mounted(){
            let vm = this
            vm.getEvents()
        }
    }

</script>