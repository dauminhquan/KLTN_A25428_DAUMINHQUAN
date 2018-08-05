<template>
    <div class="content-detached">

        <!-- Details -->
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group-lg">
                    <a href="#" class="media-left media-middle">
                        <img :src="job.enterprise == null? null: job.enterprise.avatar" class="img-rounded img-lg" alt="">
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{job.title}}</h5>
                        <ul class="list-inline list-inline-separate text-muted no-margin">
                            <li v-html="TextInfo"></li>
                        </ul>
                    </div>

                </div>

                <div class="content-group-lg" v-html="job.content">

                </div>

                <ul class="list-inline no-margin">
                    <li class="mt-5">
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u='+curUrl" class="btn btn-default">
                            <i class="icon-facebook position-right"></i>
                            Share
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
                        <img :src="job.enterprise == null? null: job.enterprise.avatar" class="img-rounded img-lg" alt="">
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{job.enterprise == null? null: job.enterprise.name}}</h5>
                    </div>
                </div>
                <div v-html="job.enterprise == null ? null: job.enterprise.introduce"></div>
            </div>
        </div>

        <h5 v-if="job.similars != undefined && job.similars.length > 0" class="pt-10 content-group">Việc làm tường tự</h5>
        <div class="row" v-if="job.similars != undefined">
            <div class="col-sm-6"  v-for="similar in job.similars">
                <div class="media panel panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="#">
                            <img :src="similar.enterprise == null ? null: similar.enterprise.avatar " class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a href="#"> {{similar.title}}</a>
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
        <!-- /similar jobs -->

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
                if(vm.job != null)
                {
                    if( vm.job.location != undefined)
                    {
                        text+= '<mark class="bg-info">'+ vm.job.location+'</mark> '
                    }

                    if(vm.job.skills != undefined)
                    {
                        vm.job.skills.forEach(item => {
                            text+= '<mark class="bg-primary">'+item.name+'</mark> '
                        })
                    }
                    if(vm.job.positions != undefined)
                    {
                        vm.job.positions.forEach(item => {
                            text+= '<mark class="bg-slate">'+item.name+'</mark> '
                        })
                    }
                    if(vm.job.salary != undefined)
                    {
                        text+= '<mark class="bg-danger-400">'+ vm.job.salary.about+'</mark> '
                    }

                }
                return text
            },
        },
        props:['key-item'],
        data(){
            return {
                job: [],
                config: new config(),

            }
        },
        methods:{
            getJob(){
                let vm = this
                axios.get(vm.config.API_JOBS+'/'+vm.keyItem).then(data => {
                    vm.job = data.data
                }).catch(err => {


                    vm.config.notifyError('Không thể lấy được tin tuyển dụng')
                })
            },
        },
        mounted(){
            let vm = this
            vm.getJob()
        }
    }

</script>