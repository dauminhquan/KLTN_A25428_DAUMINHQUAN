<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title text-semibold">Danh sách tin tuyển dụng</h6>
        </div>

        <ul class="media-list">
            <li v-for="post in posts"  class="media panel-body stack-media-on-mobile">
                <div class="media-left">
                    <a href="javascript:void(0)">
                        <img :src="post.avatar_enterprise" class="img-rounded img-lg" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <h6 class="media-heading text-semibold">
                        <a href="javascript:void(0)" @click="getDetailJob(post.id)">{{post.title_post}}</a>
                    </h6>
                    <ul class="list-inline list-inline-separate text-muted mb-10">
                        <li><a href="#" class="text-muted">{{post.name_enterprise}}</a></li>
                        <li>{{post.address_enterprise}}</li>
                    </ul>
                    {{post.description_post}}
                </div>

                <div class="media-right text-nowrap">
                    <span class="label bg-blue" v-if="CheckNew(post.updated_at) <= 24">New</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
    import axios from './../../../../../axios'
    import store from './../../../Store'
    import configUrl from './../../../../../config'
    export default {
        store,
        computed: {
            get_key_query(){
                return this.$store.getters.getKeyQuery
            },
            get_key_query_eventSearch(){
                return this.$store.getters.getKeyQueryEventSearch
            },
            get_search(){
                return this.$store.getters.getSearch
            }
        },

        props: ['current_page'],




        data(){
            return {
                posts: [

                ],
                key_query: {},
                configUrl: new configUrl()
            }
        },

        beforeMount(){

        }
        ,
        mounted(){

            this.getPosts()
        },


        methods:{
            getPosts(){
                var vm = this

                var key_query = vm.get_key_query
                var query = {
                    params: {
                        page:vm.current_page,

                    }
                }
                if(key_query.keyword != undefined && key_query.keyword != '')
                {
                    query.params.keyword = key_query.keyword
                }
                if(key_query.types_job_selected != undefined && key_query.types_job_selected.length >0)
                {
                    query.params.types_job_selected = key_query.types_job_selected
                }
                if(key_query.cities_selected != undefined && key_query.cities_selected.length >0)
                {
                    query.params.cities_selected = key_query.cities_selected
                }
                if(key_query.positions_selected != undefined && key_query.positions_selected.length >0 )
                {
                    query.params.positions_selected = key_query.positions_selected
                }
                if(  key_query.enterprises_selected != undefined && key_query.enterprises_selected.length >0)
                {
                    query.params.enterprises_selected = key_query.enterprises_selected
                }
                if(key_query.skills_selected != undefined && key_query.skills_selected.length >0)
                {
                    query.params.skills_selected = key_query.skills_selected
                }
                if(key_query.dates_selected != undefined && key_query.dates_selected.length >0)
                {
                    query.params.dates_selected = key_query.dates_selected
                }


                axios.get(vm.configUrl.API_JOB_GET_LIST_JOB,query).then(data => {
                    vm.posts = data.data.data
                    vm.$emit('set_total_page',parseInt(data.data.total/20)+1)
                }).catch(err => {
                    console.log(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                })
            },
            CheckNew(date)
            {
               return Math.abs(new Date() - new Date(date))/1000/60/60
            },
            getDetailJob(id)
            {
                window.open(this.configUrl.WEB_JOB_JOB_DETAIL(id),'_blank');
            }
        },
        watch:{
            current_page(){
                this.getPosts()
            },
            get_key_query_eventSearch:{
                handler(newVal,oldVal){

                     this.getPosts()
                },
                deep:true
            },
            get_search:{
                handler(newVal)
                {
                    console.log(newVal)
                },deep:true
            },

        }
    }
</script>