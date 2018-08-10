<template>
    <div class="content-detached">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group-lg">
                    <a href="#" class="media-left media-middle">
                        <img :src="notify.admin == null? null: notify.admin.avatar" class="img-rounded img-lg" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{notify.title}}</h5>
                    </div>
                </div>
                <div class="content-group-lg" v-html="notify.content">
                </div>
                <ul class="list-inline no-margin">
                    <li class="mt-5" style="float: right">
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u='+curUrl" class="btn btn-default" style="padding: 0 !important;">
                            <i class="icon-facebook position-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <h5 v-if="notify.similars != undefined && notify.similars.length > 0" class="pt-10 content-group">Các thông báo khác</h5>
        <div class="row" v-if="notify.similars != undefined">
            <div class="col-sm-6"  v-for="similar in notify.similars">
                <div class="media panel panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="#">
                            <img :src="similar.enterprise == null ? null: similar.enterprise.avatar " class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a :href="getUrlNotify(similar.id)"> {{similar.title}}</a>
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
        },
        props:['key-item'],
        data(){
            return {
                notify: [],
                config: new config(),

            }
        },
        methods:{
            getNotify(){
                let vm = this
                axios.get(vm.config.API_NOTIFIES+'/'+vm.keyItem).then(data => {
                    vm.notify = data.data
                }).catch(err => {


                    vm.config.notifyError('Có lỗi từ server')
                })
            },
            getUrlNotify(id){
                let vm = this
                return vm.config.WEB_NOTIFIES+'/'+id
            }
        },
        mounted(){
            let vm = this
            vm.getNotify()
        }
    }

</script>