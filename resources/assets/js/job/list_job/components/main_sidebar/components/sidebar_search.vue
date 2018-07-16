<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <button type="button" @click="search" class="btn bg-blue btn-block">
                    <i class="icon-search4 text-size-base position-left"></i>
                    Tìm kiếm công việc
                </button>
            </div>
        </div>

        <div class="panel-body">
            <form action="#">
                <div class="form-group">
                    <div class="has-feedback has-feedback-left">
                        <input type="search" class="form-control" v-model="keyword" placeholder="Nhập từ khóa">
                        <div class="form-control-feedback">
                            <i class="icon-reading text-size-large text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox" v-for="type_job in types_job" :key="type_job.id">
                        <label class="display-block">
                            <input type="checkbox" :value="type_job.id" class="styled" v-model="types_job_selected">
                            {{type_job.name_job_type}}
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    import axios from './../../../../../axios'
    import configUrl from './../../../../../config'
    export default {
        computed:{
            get_types_job_selected(){
                return this.types_job_selected
            },
            get_keyword(){
                return this.keyword
            }
        },
        props: [],
        data(){
            return {

                types_job : [],
                types_job_selected: [],
                keyword: '',
                configUrl:new configUrl()
            }
        },
        methods:{
          getTypesJob()
          {
              var vm = this
              axios.get(vm.configUrl.API_JOB_GET_LIST_TYPE_JOB).then(data => {
                    vm.types_job = data.data
              }).catch(err => {
                    console.dir(err)
                  new PNotify({
                      title: 'Ohh! Có lỗi xảy ra rồi!',
                      text: 'Đã có lỗi xảy ra từ server!',
                      addclass: 'bg-danger'
                  });
              })
          },
            search(){
              this.$emit('search')
            }
        },


        beforeUpdate(){

        },
        updated(){
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });
        },

        mounted(){
            this.getTypesJob()

        }
        ,
        watch:{
            get_types_job_selected: {
                handler(newValue){
                    this.$emit('change_types_job_selected',newValue)
                },
                deep: true
            },
            get_keyword:{
                handler(newValue){
                    this.$emit('change_keyword',newValue)
                },
                deep: true
            }
        }
    }
</script>