<template>

    <div>
        <h5 class="pt-10 content-group">Các việc tương tự</h5>
        <div class="row">
            <div class="col-sm-6" v-for="similar in infoSimilar" :key="similar.id">
                <div class="media panel panel-body stack-media-on-mobile">
                    <div class="media-left">
                        <a href="javascript:void(0)" >
                            <img :src="getAvatar(similar.avatar_enterprise)" class="img-rounded img-lg" alt="">
                        </a>
                    </div>

                    <div class="media-body">
                        <h6 class="media-heading text-semibold">
                            <a href="javascript:void(0)" @click="getDetailJob(similar.id)">{{similar.title_post}}</a>
                        </h6>

                        <ul class="list-inline list-inline-separate text-muted mb-10">
                            <li><a href="#" class="text-muted">{{similar.name_enterprise}}</a></li>
                            <li>{{similar.address_enterprise}}</li>
                        </ul>

                        {{similar.description_post}}
                    </div>

                    <div class="media-right text-nowrap">
                        <span class="label bg-blue">New</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

    import configUrl from './../../../../../config'
    export default {
        computed: {
            infoSimilar(){
                return this.$store.getters.getSemilar;
            }
        },
        methods:{
            getAvatar(url)
            {
                return window.location.origin+url
            },
            getDetailJob(id)
            {
                window.open(this.configUrl.WEB_JOB_JOB_DETAIL(id),'_blank')

            }
        },
        data(){
            return {
                configUrl: new configUrl()
            }
        }
    }
</script>