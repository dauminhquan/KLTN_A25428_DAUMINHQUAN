<template>
    <div class="container-detached">
        <div class="content-detached">
            <detail></detail>
            <enterprise-profile></enterprise-profile>
            <similar-job></similar-job>
        </div>
    </div>

</template>
<script>
    import axios from './../../../../axios'
    import configUrl from './../../../../config'
    import detail from './components/detail.vue'
    import enterprise_profile from './components/enterprise_profile.vue'
    import similar_job from  './components/similar_jobs.vue'
    export default {
        props: ['id-job'],
        beforeMount(){
            this.getData()
        },
        data(){
          return {
              configUrl: new configUrl()
          }
        },
        methods: {

            getData(){
                var vm = this
                axios.get(vm.configUrl.API_JOB_DETAIL(vm.idJob)).then(data => {
                    vm.$store.commit('setDetail',data.data)
                }).catch(err => {
                    alert('Lỗi')
                })
            }
        },
        components :{
            'detail' : detail,
            'enterprise-profile' : enterprise_profile,
            'similar-job' : similar_job
        }
    }
</script>