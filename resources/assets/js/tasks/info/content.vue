<template>
    <div class="content-detached">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group-lg">
                    <a href="#" class="media-left media-middle">
                        <img :src="task.enterprise == null? null: task.enterprise.avatar" class="img-rounded img-lg" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{task.title}}</h5>
                        <ul class="list-inline list-inline-separate text-muted no-margin">
                            <li v-html="TextInfo"></li>
                        </ul>
                    </div>
                </div>
                <div class="content-group-lg" v-html="task.content">
                </div>
                <ul class="list-inline no-margin">
                    <li class="mt-5">
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u='+curUrl" class="btn btn-default">
                            <i class="icon-facebook position-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <h5 class="pt-10 content-group"><b><i>Thông tin về doanh nghiệp</i></b></h5>
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group">
                    <a href="#" class="media-left media-middle">
                        <img :src="task.enterprise == null? null: task.enterprise.avatar" class="img-rounded img-lg" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{task.enterprise == null? null: task.enterprise.name}}</h5>
                    </div>
                </div>
                <div v-html="task.enterprise == null ? null: task.enterprise.introduce"></div>
            </div>
        </div>
        <h5 v-if="task.similars != undefined && task.similars.length > 0" class="pt-10 content-group">Việc làm tường tự</h5>
        <div class="row" v-if="task.similars != undefined">
            <div class="col-sm-6"  v-for="similar in task.similars">
                <div class="media panel panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="#">
                            <img :src="similar.enterprise == null ? null: similar.enterprise.avatar " class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a :href="getUrlTask(similar.id)"> {{similar.title}}</a>
                        </h6>
                        <ul class="list-inline list-inline-separate text-muted mb-10">
                            <li><a href="#" class="text-muted">{{similar.location}}</a></li>
                            <
                        </ul>
                        {{similar.description}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from './../../axios'
    import config from './../../config'
    export default {
        computed: {
          curUrl(){
              return window.location.href
          },
            TextInfo(){
                let vm = this
                let text = ''
                if(vm.task != null)
                {
                    if( vm.task.location != undefined)
                    {
                        text+= '<mark class="bg-info">'+ vm.task.location+'</mark> '
                    }

                    if(vm.task.skills != undefined)
                    {
                        vm.task.skills.forEach(item => {
                            text+= '<mark class="bg-primary">'+item.name+'</mark> '
                        })
                    }
                    if(vm.task.positions != undefined)
                    {
                        vm.task.positions.forEach(item => {
                            text+= '<mark class="bg-slate">'+item.name+'</mark> '
                        })
                    }
                    if(vm.task.salary != undefined)
                    {
                        text+= '<mark class="bg-danger-400">'+ vm.task.salary.about+'</mark> '
                    }

                }
                return text
            },
        },
        props:['key-item'],
        data(){
            return {
                task: [],
                config: new config(),

            }
        },
        methods:{
            getTask(){
                let vm = this
                axios.get(vm.config.API_TASKS+'/'+vm.keyItem).then(data => {
                    vm.task = data.data
                }).catch(err => {


                    vm.config.notifyError('Không thể lấy được tin tuyển dụng')
                })
            },
            getUrlTask(id){
                let vm = this

                return vm.config.WEB_TASKS+'/'+id
            }
        },
        mounted(){
            let vm = this
            vm.getTask()
        }
    }

</script>