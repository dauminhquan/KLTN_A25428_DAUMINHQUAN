<template>

    <div>
        <h5 class="pt-10 content-group">Thông tin doanh nghiệp</h5>
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group">
                    <a href="#" class="media-left media-middle">
                        <img :src="AvatarEnterPrise" class="img-rounded img-lg" alt="">
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{infoEnterprise == undefined ? '' : infoEnterprise.name_enterprise}}</h5>
                        <ul class="list-inline list-inline-separate text-muted no-margin">

                        </ul>
                    </div>

                </div>

                <div v-html="infoEnterprise == null ? '' :infoEnterprise.introduce_enterprise"></div>
            </div>
        </div>
    </div>

</template>
<script>
    import store from './../../../Store'

    export default {
        store,
        computed:{
            infoEnterprise(){
                return this.$store.getters.getEnterprise
            },
            AvatarEnterPrise(){
                var job_detail = this.$store.getters.getJobDetail.enterprise

                return job_detail == undefined? '':job_detail.avatar_enterprise+'?'+new Date()

            },
        }
    }
</script>