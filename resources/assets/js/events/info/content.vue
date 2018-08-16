<template>
    <div class="content-detached">
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group-lg">
                    <a href="#" class="media-left media-middle">
                        <img :src="event.admin == null? null: event.admin.avatar" class="img-rounded img-lg" alt="">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading text-semibold">
                            {{event.title}}
                            <span class="label bg-blue" v-if="event.status == 2"> Đang diễn ra</span>

                        </h5>
                        <span class="label bg-success" v-if="event.status == 1"> Chuẩn bị diễn ra</span>
                        <br>
                        <span class="text-muted">{{getDateStart(event.time_start)}} - {{event.location}}</span>
                    </div>

                    <div class="media-right media-middle text-nowrap">

                        <a href="#" class="btn bg-info" @click="regNotify" v-if="reg_notify == 0"><i class="icon-alarm position-left" ></i> Nhận thông báo</a>
                        <a href="#" class="btn bg-brown" @click="unRegNotify"  v-if="reg_notify == 1"><i class="icon-alarm position-left" ></i> Hủy nhận thông báo</a>
                        <a href="#" class="btn bg-primary" @click="joinEvent" v-if="event.joined != undefined && event.joined == 0"><i class="icon-plus3 position-left" ></i> Đăng ký tham gia</a>
                        <a href="#" class="btn bg-brown" @click="joinEvent" v-if="event.joined != undefined && event.joined == 1"><i class="icon-check2 position-left" ></i> Hủy tham gia</a>
                    </div>

                </div>
                <div class="content-group-lg" v-html="event.content">
                </div>
                <ul class="list-inline no-margin">
                    <li class="mt-5" style="float: right">
                        <a :href="'https://www.facebook.com/sharer/sharer.php?u='+curUrl" class="btn btn-default" style="padding: 0 !important;" target="_blank">
                            <i class="icon-facebook position-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <h5 v-if="event.similars != undefined && event.similars.length > 0" class="pt-10 content-group">Các thông báo khác</h5>
        <div class="row" v-if="event.similars != undefined">
            <div class="col-sm-6"  v-for="similar in event.similars">
                <div class="media panel panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="#">
                            <img :src="similar.admin == null ? null: similar.admin.avatar " class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a :href="getUrlEvent(similar.id)"> {{similar.title}}</a>
                        </h6>

                        <ul class="list-inline list-inline-separate text-muted mb-10">
                            <li>{{getDateStart(similar.time_start)}} - {{similar.location}}</li>
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
                event: [],
                config: new config(),
                reg_notify: localStorage.getItem('reg_notify')
            }
        },
        methods:{
            getDateStart(d)
            {
                d = new Date(d)
                let i = d.getMinutes()
                if(d.getMinutes() < 10)
                {
                    i = '0'+d.getMinutes()
                }

                return d.getDate()+'/'+d.getMonth()+'/'+d.getFullYear()+' '+d.getHours()+':'+i
            },
            getEvent(){
                let vm = this
                axios.get(vm.config.API_EVENTS+'/'+vm.keyItem).then(data => {
                    vm.event = data.data
                }).catch(err => {
                    vm.config.eventError('Có lỗi từ server')
                })
            },
            getUrlEvent(id){
                let vm = this
                return vm.config.WEB_EVENTS+'/'+id
            },
            regNotify(){
                let vm = this
                vm.config.notifyWarning('Đang gửi yêu cầu...')
                axios.post(vm.config.API_REGISTRATION_NOTIFY).then(data => {
                    localStorage.setItem('reg_notify',1)
                    vm.config.notifySuccess('Đăng ký thành công')
                    vm.reg_notify = 1
                }).catch(err => {
                    vm.config.notifyError()
                    console.dir(err)
                })
            },
            unRegNotify(){
                let vm = this
                vm.config.notifyWarning('Đang gửi yêu cầu...')
                axios.post(vm.config.API_UN_REGISTRATION_NOTIFY).then(data => {
                    localStorage.setItem('reg_notify',0)
                    vm.config.notifySuccess('Hủy đăng ký thành công')
                    vm.reg_notify = 0
                }).catch(err => {
                    vm.config.notifyError()
                    console.dir(err)
                })
            },
            joinEvent(){
                let vm = this
                if(vm.event.joined == 0)
                {
                    axios.post(vm.config.API_JOIN_EVENT+'/'+vm.keyItem).then(data => {
                        vm.event.joined = 1
                        vm.config.notifySuccess('Đăng ký tham gia Event thành công')
                    }).catch(err => {
                        vm.config.notifyError()
                        console.dir(err)
                    })
                }
                else{
                    axios.post(vm.config.API_UN_JOIN_EVENT+'/'+vm.keyItem).then(data => {
                        vm.event.joined = 0
                        vm.config.notifySuccess('Hủy tham gia Event thành công')
                    }).catch(err => {
                        vm.config.notifyError()
                        console.dir(err)
                    })
                }

            }
        },
        mounted(){
            let vm = this
            vm.getEvent()
        }
    }

</script>