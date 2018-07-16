<template>

    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="media stack-media-on-mobile text-left content-group-lg">
                <a href="#" class="media-left media-middle">
                    <img :src="AvatarEnterPrise" class="img-rounded img-lg" alt="">
                </a>
                <div class="media-body">
                    <h5 class="media-heading text-semibold">{{infoDetail == undefined? '' : infoDetail.title_post}}</h5>
                    <ul class="list-inline list-inline-separate text-muted no-margin">
                        <li><a href="javascript:void(0)">{{infoEnterprise == undefined? '' : infoEnterprise.name_enterprise}}</a></li>
                        <li>{{infoEnterprise == undefined? '' : infoEnterprise.address_enterprise }}</li>
                        <li v-for="type in infoTypes" :key="type.name_job_type">
                            <span class="label label-info">{{type.name_job_type}}</span>
                        </li>
                    </ul>
                </div>

                <div class="media-right media-middle text-nowrap">
                    <a :href="MailTo" class="btn bg-blue"><i class="icon-envelop2 position-left"></i> Gửi đơn ngay</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="content-group-lg">
                        <u><h3 class="text-semibold">Địa điểm công việc:</h3></u>

                        <span v-for="location in infoCities" :key="location.city" class="label label-success">{{location.city}}</span>
                        <span> Địa chỉ tại: <b>{{infoLocation}}</b></span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="content-group-lg">
                        <u><h3 class="text-semibold">Các kỹ năng yêu cầu:</h3></u>
                        <span v-for="skill in infoSkill" :key="skill.name_skill" class="label label-primary">{{skill.name_skill}}</span>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="content-group-lg">
                        <u><h3 class="text-semibold">Các vị trí tuyển dụng:</h3></u>
                        <span v-for="position in infoPosition" :key="position.name_position" class="label label-info">{{position.name_position}}</span>

                    </div>
                </div>
            </div>






            <div class="content-group-lg">
                <h3 class="text-semibold" ><u>Chi tiết tin tuyển dụng:</u></h3>

                <div v-html="infoDetail == undefined? '' : infoDetail.content_post "></div>
            </div>

            <div class="content-group-lg">
                <h3 class="text-semibold"><u>Hạn gửi hồ sơ</u></h3>
                <p>Thời gian bắt đầu từ: <b>{{infoDetail == undefined? '' : infoDetail.time_start_post }}</b> đến <b>{{infoDetail == undefined? '' : infoDetail.time_end_post}}.</b> </p>

            </div>

            <ul class="list-inline no-margin">
                <li class="mt-5">
                    <a :href="MailTo" class="btn bg-blue">
                        <i class="icon-envelop2 position-left"></i>
                        Gửi đơn ngay
                    </a>
                </li>
                <li class="mt-5">
                    <a href="javascript:void(0)" @click="DowloadFile(infoDetail.id)" class="btn bg-brown-300">
                        <i class="icon-file-download2 position-left"></i>
                        File đính kèm
                    </a>
                </li>
            </ul>
        </div>
    </div>

</template>
<script>
    import store from './../../../Store'
    import configUrl from './../../../../../config'
    export default {
        store,
        computed: {
            infoDetail(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail == undefined? '':job_detail.info
            },
            infoEnterprise(){
                return this.$store.getters.getEnterprise
            },
            AvatarEnterPrise(){
                var job_detail = this.$store.getters.getJobDetail.enterprise

                return job_detail == undefined? '':job_detail.avatar_enterprise+'?'+new Date()

            },
            infoSkill(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail == undefined? '':job_detail.skills

            },
            infoPosition(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail == undefined? '':job_detail.positions

            },
            infoTypes(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail == undefined? '':job_detail.types

            },
            infoCities(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail == undefined? '':job_detail.cities

            },
            infoLocation(){
                return this.infoDetail == undefined ? '': this.infoDetail.localtion

            },
            MailTo(){
                var job_detail = this.$store.getters.getJobDetail
                return job_detail.enterprise == undefined? 'javascript:void(0)':('mailto:'+job_detail.enterprise.email_address_enterprise)

            },

        },
        data(){
          return {
              configUrl: new configUrl()
          }
        },
        methods:{
            DowloadFile(id){
                window.open(this.configUrl.WEB_JOB_FILE(id),'_blank')
            },

        }
    }
</script>
<style>
    .ul-skill{
        list-style-type: none;
        padding-bottom: 5px;
    }
    .ul-skill li{
        float: left;
        margin-left: 15px;

    }
</style>